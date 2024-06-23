<?php

// Accept a POST request with a image/jpg content type and save the image.

if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    // Read the "Fingerprint" header.
    $fingerprint = $_SERVER['HTTP_FINGERPRINT'];
    $dir = '../files/' . $fingerprint;
    if (!file_exists($dir)) {
        mkdir($dir);
    }
    $input = file_get_contents('php://input');
    $filename = $dir . '/' . time() . '.jpg';
    file_put_contents($filename, $input);
    echo 'Saved snapshot to ' . $filename;
} else {
    echo 'Invalid request method';
}