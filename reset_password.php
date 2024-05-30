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

// Check if the token is valid and not expired
$stmt = $mysqli->prepare("SELECT email FROM password_resets WHERE token = ? AND expires_at > NOW()");
$stmt->bind_param("s", $token);
$stmt->execute();
$stmt->bind_result($email);
$stmt->fetch();
$stmt->close();

if ($email) {
    $_SESSION['reset_email'] = $email;
    $_SESSION['reset_token'] = $token;
} else {
    die('Invalid or expired token');
}
?>
<!-- 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
</head>
<body>
    <h2>Reset Password</h2>
    <form action="update_password.php" method="post">
        <label for="new_password">New Password:</label>
        <input type="password" id="new_password" name="new_password" required>
        <button type="submit">Reset Password</button>
    </form>
</body>
</html> -->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="style.css" />

    
  </head>
  <body>
    <nav>
      <img src="assets/logo.png" alt="" />
    </nav>
    <section class="wrapper">
    <div class="form signup">
    <header>Enter Token </header>
    <div class="form_container">
    <form action="update_password.php" method="post">
          <input type="text" id="new_password" name="token" placeholder="Token" required>
          <input type="password" id="new_password" name="new_password" placeholder=" New Password" required>
            <input type="submit" value="Submit"/>
          </form>
    </div>
    </div>
    </section>
  </body>
</html>

