<?php
// Check if the file parameter exists in the URL
if (isset($_GET['file'])) {
    // Get the file name from the URL parameter
    $fileName = $_GET['file'];

    // Set headers for file download
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . basename($fileName) . '"');

    // Output the file data
    readfile($fileName);
} else {
    // File parameter not provided, redirect or display error message
    echo "File not found.";
}
?>
