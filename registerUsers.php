<?php

// Generate a random ID
$random_id = uniqid();

// Add more uniqueness using additional characters
$random_id .= bin2hex(random_bytes(2)); // You can adjust the number of bytes for more randomness
// Connect to your MySQL database

$host ="localhost";
$dbname = "locker";
$username = "root";
$password = "";

$connection = mysqli_connect($host, $username, $password, $dbname);
// Check connection
if(mysqli_connect_error()){
    die("Connection error:" . mysqli_connect_error());
}

// Retrieve user input
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$matric = $_POST['matric'];
$password = $_POST['password'];
$email = $_POST['email'];
$level = $_POST['level'];

// Hash the password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Prepare SQL statement
$sql = "INSERT INTO user (id, firstname, lastname, matric, email, level, password) VALUES (?, ?, ?, ?, ?, ?, ?)";

$stmt = mysqli_stmt_init($connection);

// Check if the SQL statement is valid
if (!mysqli_stmt_prepare($stmt, $sql)) {
    die(mysqli_error($connection));
}

mysqli_stmt_bind_param($stmt,"sssssss", $random_id, $firstname, $lastname, $matric, $email, $level, $hashed_password);

// Execute the statement
if ($stmt->execute()) {
    echo "User registered successfully.";
     // Redirect user to home page
     header("location: index.php");
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and connection

mysqli_stmt_close($stmt);
mysqli_close($connection);
?>
