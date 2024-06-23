<?php

require_once '../config.php';

global $tokens, $max_images_per_camera;

$max_images_per_camera ?? 200;

// Accept a POST request with a image/jpg content type and save the image.

if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    // Read the "Fingerprint" header.
    $fingerprint = $_SERVER['HTTP_FINGERPRINT'];
    $token = $_SERVER['HTTP_TOKEN'];
    if (!in_array($token, $tokens)) {
        // Return a 401 Unauthorized response.
        http_response_code(401);
        echo 'Invalid token';
        exit;
    }
    $dir = 'files/' . $fingerprint;
    if (!file_exists($dir)) {
        mkdir($dir);
    }
    $input = file_get_contents('php://input');
    $filename = $dir . '/' . time() . '.jpg';
    file_put_contents($filename, $input);
    echo 'Saved snapshot to ' . $filename;

    // Now delete the oldest file if there are more than the specified amount.
    $files = scandir($dir);
    if (count($files) > $max_images_per_camera + 2) {
        sort($files);
        array_unshift($files); // Remove '.'.
        array_unshift($files); // Remove '..'.
        $to_delete = array_splice($files, 0, $max_images_per_camera - 2);
        foreach ($to_delete as $file) {
            unlink($dir . '/' . $file);
        }
    }
} else {
    http_response_code(405);
    echo 'Invalid request method';
}