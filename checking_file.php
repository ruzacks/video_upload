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

function findMissingFiles($localFiles, $gcsFiles) {
    $localFileNames = array_map('basename', $localFiles);
    $gcsFileNames = array_map('basename', $gcsFiles);
    return array_diff($localFileNames, $gcsFileNames);
}

function uploadMissingFiles($missingFiles, $localDirectory, $bucketName, $limit = 20) {
    $storage = new StorageClient();
    $bucket = $storage->bucket($bucketName);

    $count = 0;
    foreach ($missingFiles as $file) {
        if ($count >= $limit) {
            break;
        }

        $filePath = $localDirectory . '/' . $file;
        if (file_exists($filePath)) {
            $bucket->upload(fopen($filePath, 'r'), [
                'name' => $file,
                'resumable' => true,
                'predefinedAcl' => 'publicRead' // Optional: Set the ACL for the uploaded object
            ]);
            $count++;
        } else {
            echo "File not found: $file<br>";
        }
    }
}

// List files in local directory and GCS bucket
$localFiles = listLocalFiles($localDirectory);
$gcsFiles = listGcsFiles($gcsBucketName);

// Find missing files
$missingFiles = findMissingFiles($localFiles, $gcsFiles);

// Upload missing files to Google Cloud Storage, limited to 300 files
uploadMissingFiles($missingFiles, $localDirectory, $gcsBucketName, 300);

echo "Upload complete.";

?>
