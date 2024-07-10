<?php

require 'vendor/autoload.php';

use Google\Cloud\Storage\StorageClient;

// Set up Google Cloud credentials
putenv('GOOGLE_APPLICATION_CREDENTIALS=/home/verb4874/gcsk/psyched-oxide-424402-a3-38779c1a080f.json'); // Replace with the path to your service account key

// Define your directories and bucket name
$localDirectory = __DIR__ . '/videos';
$gcsBucketName = 'verfak_videos_2';

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

function findExistingFiles($localFiles, $gcsFiles) {
    $localFileNames = array_map('basename', $localFiles);
    $gcsFileNames = array_map('basename', $gcsFiles);
    return array_intersect($localFileNames, $gcsFileNames);
}

function deleteExistingFiles($existingFiles, $localDirectory) {
    foreach ($existingFiles as $file) {
        $filePath = $localDirectory . DIRECTORY_SEPARATOR . $file;
        if (file_exists($filePath)) {
            unlink($filePath);
        } else {
            echo "File not found: $file<br>";
        }
    }
}

// List files in local directory and GCS bucket
$localFiles = listLocalFiles($localDirectory);
$gcsFiles = listGcsFiles($gcsBucketName);

// Find files that exist both locally and in the GCS bucket
$existingFiles = findExistingFiles($localFiles, $gcsFiles);

// Delete existing files from the local directory
deleteExistingFiles($existingFiles, $localDirectory);

echo "Deletion complete.";

?>
