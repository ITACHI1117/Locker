<?php
session_start();
if (isset($_SESSION['reset_email']) && isset($_SESSION['reset_token'])) {
    $email = $_SESSION['reset_email'];
    $token = $_SESSION['reset_token'];
} else {
    die('Invalid session');
}

// Database connection
$mysqli = new mysqli("localhost", "root", "", "locker");
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Retrieve user input
$new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
$token = $_POST['token'];

// Update the password in the users table
$stmt = $mysqli->prepare("SELECT token FROM password_resets WHERE email = ?");
$stmt->bind_param("s",   $email);
$stmt->execute();
$stmt->bind_result($new_token);
$stmt->fetch();
$stmt->close();


if($token == $new_token){

// Update the password in the users table
$stmt = $mysqli->prepare("UPDATE user SET password = ? WHERE email = ?");
$stmt->bind_param("ss", $new_password, $email);
$stmt->execute();
$stmt->close();

// Delete the used token
$stmt = $mysqli->prepare("DELETE FROM password_resets WHERE token = ?");
$stmt->bind_param("s", $token);
$stmt->execute();
$stmt->close();

$mysqli->close();


}
echo 'Your password has been reset successfully. You can now <a href="index.php">login</a>.';
?>
