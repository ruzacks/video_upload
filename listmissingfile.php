<?php

require 'vendor/autoload.php';

use Google\Cloud\Storage\StorageClient;

// Set up Google Cloud credentials
putenv('GOOGLE_APPLICATION_CREDENTIALS=/home/verb4874/gcsk/psyched-oxide-424402-a3-38779c1a080f.json'); // Replace with the path to your service account key

// Define your directories and bucket name
$localDirectory = __DIR__ . '/videos';
$txtFilename = 'missing_files.txt';
function getCurrentDomain() {
    return $_SERVER['HTTP_HOST'];
}

// Determine the bucket name based on the current domain
$currentDomain = getCurrentDomain();
if ($currentDomain === 'baru.verfak.my.id') {
    $gcsBucketName = 'verfak_videos_new_2';
} else {
    $gcsBucketName = 'verfak_videos_2';
}

function listLocalFiles($directory) {
    $files = array_diff(scandir($directory), ['.', '..']);
    return array_filter($files, function($file) use ($directory) {
        return is_file($directory . DIRECTORY_SEPARATOR . $file);
    });
}

function listGcsFiles($bucketName) {
    $storage = new StorageClient();
    $bucket = $storage->bucket($bucketName);
    $objects = $bucket->objects();

    $files = [];
    foreach ($objects as $object) {
        $files[] = $object->name();
    }

    return $files;
}

function findMissingFiles($localFiles, $gcsFiles) {
    $localFileNames = array_map('basename', $localFiles);
    $gcsFileNames = array_map('basename', $gcsFiles);
    return array_diff($localFileNames, $gcsFileNames);
}

function createTxtFile($missingFiles, $txtFilename) {
    file_put_contents($txtFilename, implode(PHP_EOL, $missingFiles));
}

function createDownload($txtFilename) {
    if (file_exists($txtFilename)) {
        header('Content-Type: text/plain');
        header('Content-Disposition: attachment; filename="' . basename($txtFilename) . '"');
        header('Content-Length: ' . filesize($txtFilename));

        flush();
        readfile($txtFilename);

        // Delete the text file after download
        unlink($txtFilename);
        exit();
    } else {
        exit("Failed to create text file $txtFilename\n");
    }
}

// List files in local directory and GCS bucket
$localFiles = listLocalFiles($localDirectory);
$gcsFiles = listGcsFiles($gcsBucketName);

// Find missing files
$missingFiles = findMissingFiles($localFiles, $gcsFiles);

// Create a text file with the list of missing files
createTxtFile($missingFiles, $txtFilename);

// Create a downloadable text file
createDownload($txtFilename);

?>
