<?php
ini_set('max_execution_time', 300);
error_reporting(E_ALL);

// Get real path for our folder
$path = 'folder_name';
if ( isset( $_GET['backup'] ) ) {
    $path = htmlentities( $_GET['backup'] );
}
$rootPath = realpath($path);

// Initialize archive object
$zip = new ZipArchive();
$zip->open($path . '.zip', ZipArchive::CREATE | ZipArchive::OVERWRITE);

// Create recursive directory iterator
/** @var SplFileInfo[] $files */
$files = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($rootPath),
    RecursiveIteratorIterator::LEAVES_ONLY
);

foreach ($files as $name => $file) {
    // Skip directories (they would be added automatically)
    if (!$file->isDir()) {
        // Get real and relative path for current file
        $filePath = $file->getRealPath();
        $relativePath = substr($filePath, strlen($rootPath) + 1);

        // Add current file to archive
        $zip->addFile($filePath, $relativePath);
    }
}

// Zip archive will be created only after closing object
$zip->close();
