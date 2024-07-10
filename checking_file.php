<?php

require 'vendor/autoload.php';

use Google\Cloud\Storage\StorageClient;

// Set up Google Cloud credentials
putenv('GOOGLE_APPLICATION_CREDENTIALS=/home/verb4874/gcsk/psyched-oxide-424402-a3-38779c1a080f.json'); // Replace with the path to your service account key

// Define your directories and bucket name
$localDirectory = __DIR__ . '/videos';
$gcsBucketName = 'verfak_videos_2';
$zipFilename = 'missing_files.zip';

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

function createZipFile($missingFiles, $localDirectory, $zipFilename) {
    // Initialize zip archive
    $zip = new ZipArchive();
    if ($zip->open($zipFilename, ZipArchive::CREATE) !== TRUE) {
        exit("Cannot open $zipFilename\n");
    }

    // Add each missing file to the zip archive
    foreach ($missingFiles as $file) {
        $filePath = $localDirectory . '/' . $file;
        if (file_exists($filePath)) {
            $zip->addFile($filePath, $file);
        } else {
            echo "File not found: $file<br>";
        }
    }

    // Close and save the zip archive
    $zip->close();
}

// List files in local directory and GCS bucket
$localFiles = listLocalFiles($localDirectory);
$gcsFiles = listGcsFiles($gcsBucketName);

// Find missing files
$missingFiles = findMissingFiles($localFiles, $gcsFiles);

// Create a zip file containing the missing files
createZipFile($missingFiles, $localDirectory, $zipFilename);

// Function to create download link for the zip file
function createDownloadLink($zipFilename) {
    echo '<a href="download.php?file=' . urlencode($zipFilename) . '">Download Zip File of Missing Files</a>';
}

// Output download link for the zip file
createDownloadLink($zipFilename);

?>
