<?php

// Accept a POST request with a image/jpg content type and save the image.

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Read the "Fingerprint" header.
    $fingerprint = $_SERVER['Fingerprint'];
    $input = file_get_contents('php://input');
    $filename = '../files/' . $fingerporint . '/' . time() . '.jpg';
    file_put_contents($filename, $input);
    echo 'Saved snapshot to ' . $filename;
} else {
    echo 'Invalid request method';
}