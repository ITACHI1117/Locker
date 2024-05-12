<?php
// Start session
session_start();

// Check if the user is logged in
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    // Redirect user to the login page
    header("location: userLogin.php");
    exit();
}

// Check the status of the user
$status = isset($_SESSION["status"]) ? $_SESSION["status"] : "";
$matric = isset($_SESSION["matric"]) ? $_SESSION["matric"] : "";
$firstname = isset($_SESSION["firstname"]) ? $_SESSION["firstname"] : "";
$lastname = isset($_SESSION["lastname"]) ? $_SESSION["lastname"] : "";







// // Use the retrieved data as needed
// if ($status === "Student") {
//     // Display student's details
//     echo "<!DOCTYPE html>
//     <html lang='en'>
//     <head>
//         <meta charset='UTF-8'>
//         <meta name='viewport' content='width=device-width, initial-scale=1.0'>
//         <title>Document</title>
//     </head>
//     <body>
//        <p> ". $matric ." </p>
//     </body>
//     </html>";
// } elseif ($status === "Head of Department") {
//     // Display Head of Department's details
//     echo "Welcome, Head of Department ($matric)";
// } else {
//     // Handle invalid status
//     echo "Invalid status!";
// }

// Destroy the session after retrieving the data if needed
// session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Files</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet" />

</head>
<style>
          body {
            font-family: "Poppins", sans-serif;
        }
        .centerDetails{
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
     table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 2px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #4070f4;
        }
        a{
            background: blue;
            padding: 10px;
            text-decoration: none;
            border-radius: 10px;
            color:#dddddd
        }
        /* .center-form{
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        } */
        form{
            width: 100%;
            height: 300px;
            display: flex;
            flex-direction: column;
        }
        input{
            width: 50%;
            justify-content: space-around;
            margin-bottom: 20px;
            padding: 10px;
            border-radius: 10px;
            border: 1px solid black;
        }
        .submitButton{
            background-color: #4070f4;
            color: white;
            outline: none;
            border: none;
            border-radius: 10px;
        }
</style>
<body>
    <div class="centerDetails">
    <!-- <h1>Student Name: <?php echo $firstname; ?> <?php echo $lastname; ?></h1> -->
    <h1>Matric Number: <?php echo $matric; ?> </h1>
    </div>
    
    <?php 
    if ($status === "Student") {
    // Display student's details
    echo "<section class='center-form'>
    <h1>Upload Files</h1>
    <form 
    action='UploadFiles.php'
      method='post'
      enctype='multipart/form-data'
    >
    <input hidden type='text' value=" . $matric ." name='matric' placeholder='matric'>
        <label for='fileName'>FileName</label>
        <input type='text' name='filename' placeholder='Filename'>
        <label for='fileName'>File</label>
        <input type='file' name='file' placeholder='File'>
        <input class='submitButton' type='submit'>
    </form>
</section>
<section>";
}
    
    ?>
   
    <table>
        <thead>
            <tr>
                <th>File Name</th>
                <th>File</th>
    </tr>
    </thead>
        <tbody>   
            <?php  

            // Database connection details
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "locker";

 // Create connection
 $conn = new mysqli($servername, $username, $password, $dbname);

 // Check connection
 if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
 }
 $sql = "SELECT *  FROM uploaded_file WHERE matric = $matric";
            $result = $conn->query($sql);

             while($row = $result->fetch_assoc()) {
                $file = $row["file"];
                echo " <tr>
                <td>". $row["filename"] ."</td>
                <td><p><a href='download.php?file=$file'>Download</a></p></td>
                </tr>";
             }
            
            ?>     
            
        </tbody>
</table>
    </section>
    
</body>
</html>
