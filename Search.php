<?php
// Start session
session_start();

// Connect to your MySQL database
$mysqli = new mysqli("localhost", "root", "", "locker");

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Retrieve user input from search form
$search_matric = $_POST['search_matric'];

// Prepare SQL statement to retrieve user details based on matric
$stmt = $mysqli->prepare("SELECT id, matric, firstname, lastname FROM user WHERE matric = ?");
$stmt->bind_param("s", $search_matric);

// Execute the statement
$stmt->execute();

// Bind the result
$stmt->bind_result($id, $matric, $firstname, $lastname);

// Fetch the result
$stmt->fetch();

// Check if user details are found
if ($matric) {
    // User details found, store data in session variables
    $_SESSION["search_result"] = true;
    $_SESSION["id"] = $id;
    $_SESSION["matric"] = $matric;
    $_SESSION["firstname"] = $firstname;
    $_SESSION["lastname"] = $lastname;

    // Redirect user to search result page
    header("location: search_result.php");
} else {

    // User details not found, redirect user back to search form with error message
    header("location: search_form.php?error=1");
}

// Close the statement and connection
$stmt->close();
$mysqli->close();
?>
