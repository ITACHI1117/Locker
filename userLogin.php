<?php
    // Retrieve user details from query parameters
    $id = $_GET['id'];
    $matric = $_GET['matric'];
    $firstname = $_GET['firstname'];
    $lastname = $_GET['lastname'];

    // // Display user details
    // echo "<h2>User Details</h2>";
    // echo "<p>ID: " . $id . "</p>";
    // echo "<p>Matric: " . $matric . "</p>";
    // echo "<p>Firstname: " . $firstname . "</p>";
    // echo "<p>Lastname: " . $lastname . "</p>";
    ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
  <section class="wrapper">
 
  <div class="form signup">
        <header>Login</header>
        
        <form
          action="checkUserHod.php"
          method="post"
          enctype="multipart/form-data"
        >
        <select name="status">
        <option value="">Select Status</option>
        <option value="student">Student</option>
        <option value="Head of Department">Head Of Department</option>
        </select>
          <input
            type="tel"
            name="matric"
            placeholder="Matric Number"
            value=<?php echo $matric  ?>
            required
            
          />
          <input type="password" name="password" placeholder="Password" required />

          <input type="submit" value="Login" />
          <a style="color: white" href="forgotPassword.html">Forgot Password?</a>
        </form>
      </div>

</section>

  </body>
</html>
