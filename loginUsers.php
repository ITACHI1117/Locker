<?php
// Start session
session_start();



// Connect to your MySQL database
$mysqli = new mysqli("localhost", "root", "", "locker");

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Retrieve user input
$matric = $_POST['matric'];
$password = $_POST['password'];

// Prepare SQL statement to retrieve hashed password
$stmt = $mysqli->prepare("SELECT id, matric, firstname, lastname, password FROM user WHERE matric = ?");
$stmt->bind_param("s", $matric);

// Execute the statement
$stmt->execute();

// Bind the result
$stmt->bind_result($id, $matric, $firstname, $lastname, $hashed_password);

// Fetch the result
$stmt->fetch();

// Verify the password
if (password_verify($password, $hashed_password)) {
    // Password is correct, start a new session
    session_start();

    // Store data in session variables
    $_SESSION["loggedin"] = true;
    $_SESSION["id"] = $id;
    $_SESSION["matric"] = $matric;
    $_SESSION["firstname"] = $firstname;
    $_SESSION["lastname"] = $lastname;

    // Redirect user to home page
    header("location: index.php");
} else {
    // Redirect user back to login page with error message
    header("location: index.html?error=1");
    // echo "<p>wrong details</p>";
}

// Close the statement and connection
$stmt->close();
$mysqli->close();
?>
