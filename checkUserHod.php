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
$status = $_POST['status']; // Assuming the status is sent from the frontend

// Initialize variables to store user details
$id = $matric;
$firstname = "";
$lastname = "";

// Prepare SQL statement based on the user status
if ($status === "student") {
    $sql = "SELECT id, matric, firstname, lastname, password FROM user WHERE matric = ?";
    // Prepare SQL statement to retrieve hashed password
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $matric);
} elseif ($status === "Head of Department") {
    // Directly retrieve the password for Head of Department
    $sql = "SELECT password FROM hod WHERE id = 1";
    $result = $mysqli->query($sql);
    if ($result) {
        $row = $result->fetch_assoc();
        $hashed_password = $row['password'];
        // Verify the password
        if ($password === $password) {
            // Password is correct, start a new session
            $_SESSION["loggedin"] = true;
            $_SESSION["status"] = "Head of Department";
            $_SESSION["matric"] = $matric;
            echo $matric;
            echo $firstname;
            echo $lastname;
            // Redirect Head of Department to their dashboard
            header("location: studentfiles.php");
            exit();
        } else {
            // Redirect user back to login page with error message
            header("location: userLogin.php?error=invalid_credentials");
            exit();
        }
    } else {
        // Handle database query error
        header("location: userLogin.php?error=db_error");
        exit();
    }
} else {
    // Handle invalid status
    header("location: loginError.html?error=invalid_credentials");
    exit();
}

// Execute the statement
$stmt->execute();

// Bind the result
$stmt->bind_result($id, $matric, $firstname, $lastname, $hashed_password);

// Fetch the result
$stmt->fetch();

// Verify the password
if ($status === "student" && password_verify($password, $hashed_password)) {
    // Password is correct, start a new session

    // Store data in session variables
    $_SESSION["loggedin"] = true;
    $_SESSION["status"] = "Student";
    $_SESSION["id"] = $id;
    $_SESSION["matric"] = $matric;
    $_SESSION["firstname"] = $firstname;
    $_SESSION["lastname"] = $lastname;

    echo $id;
    echo $matric;
    echo $firstname;
    echo $lastname;

    // Redirect user to home page
    header("location: studentfiles.php");
} else {
    // Redirect user back to login page with error message
    header("location: loginError.html?error=invalid_credentials");
}

// Close the statement and connection
$stmt->close();
$mysqli->close();
?>
