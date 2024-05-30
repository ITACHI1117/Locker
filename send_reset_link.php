<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

// Database connection
$mysqli = new mysqli("localhost", "root", "", "locker");
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Retrieve user input
$email = $_POST['email'];

// Prepare SQL statement to check if the email exists
$stmt = $mysqli->prepare("SELECT id FROM user WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->bind_result($id);
$stmt->fetch();
$stmt->close();

if ($id) {
    // Generate a unique token
    $token = bin2hex(random_bytes(4));

    // Store the token in the database with an expiration date
    $expires_at = date("Y-m-d H:i:s", strtotime('+1 hour'));
    $stmt = $mysqli->prepare("INSERT INTO password_resets (email, token, expires_at) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $email, $token, $expires_at);
    $stmt->execute();
    $stmt->close();

    $_SESSION['reset_token'] = $token;
    $_SESSION['reset_email'] = $email;

    // Send the reset link to the user's email
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'ajogujoseph0317@gmail.com'; // Update with your email
    $mail->Password = 'lkgm yjrj wgxj mrmt'; // Update with your app-specific password
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
    $mail->SMTPDebug = 2; // Set to 2 to get more detailed output
    $mail->Debugoutput = 'html';
    $mail->Helo = 'ajogujoseph.netlify.app'; // Update with your domain

    $mail->setFrom('ajogujoseph0317@gmail.com', 'Locker'); // Update with your email and name
    $mail->addAddress($email);

    $mail->Subject = 'Password Reset Request';
    $mail->Body    = "This is your OTP for changing your password, do not share this information:\n\n" . $token;

    if ($mail->send()) {
        echo 'A password reset token has been sent to your email.';

        header("Location: reset_password.php");
        exit(); // Ensure the script stops after the header redirect
    } else {
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    }
} else {
    echo 'No account found with that email address.';
}

$mysqli->close();
?>
