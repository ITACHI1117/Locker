<?php

// Generate a random ID
$random_id = uniqid();

// Add more uniqueness using additional characters
$random_id .= bin2hex(random_bytes(2)); // You can adjust the number of bytes for more randomness
// Connect to your MySQL database

$filename =  $_POST["filename"];
$matric =  $_POST["matric"];

$targetDirectory = "uploads/";
$uploadedFiles = [];

// Loop through each uploaded file
foreach ($_FILES as $key => $file) {
    $file_name = $file["name"];
    $file_tmp = $file["tmp_name"];
    $file_size = $file["size"];
    $targetFile = $targetDirectory . basename($file_name);


    if($file_size > 3 * 1024 * 1024){
        echo "Error: The uploaded image is too large (maximum size is 3MB).";
    }else{
if (move_uploaded_file($file_tmp, $targetFile)) {
        // File uploaded successfully, add file path to the array
        $uploadedFiles[] = $targetFile;
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
    }
    
}

$host ="localhost";
$dbname = "locker";
$username = "root";
$password = "";

$connection = mysqli_connect($host, $username, $password, $dbname);

if(mysqli_connect_error()){
    die("Connection error:" . mysqli_connect_error());
}

$sql = "INSERT INTO uploaded_file (id, filename, matric, file)
VALUES (?, ?, ?, ?)";

$stmt = mysqli_stmt_init($connection);

// Check if the SQL statement is valid
if (!mysqli_stmt_prepare($stmt, $sql)) {
die(mysqli_error($connection));
}

// Bind parameters to the SQL statement
mysqli_stmt_bind_param($stmt, "ssss", $random_id,  $filename, $matric, $uploadedFiles[0]);

// Execute the SQL statement
if (mysqli_stmt_execute($stmt)) {
    echo "Record saved";
    header("location: studentfiles.php");
} else {
    echo "Error: " . mysqli_stmt_error($stmt);
}

// Close the statement and connection
mysqli_stmt_close($stmt);
mysqli_close($connection);

?>