<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet"
    />
    <style>
body {
  font-family: "Poppins", sans-serif;
  background-color: #f0faff;
}
nav {
  display: flex;
  flex-direction: row;
  padding: 20;
  justify-content: space-around;
  color: #4070f4;
}

.search-and-logout {
  width: 400px;
  display: flex;
  flex-direction: row;
  align-items: center;
  justify-content: space-around;
}

.search-and-logout a {
  padding: 4px;
  padding-left: 15px;
  padding-right: 15px;
  background-color: #4070f4;
  list-style: none;
  cursor: pointer;
  border-radius: 10px;
  transition: 0.1s;
  color: white;
  text-decoration: none;
}
.search-and-logouta:hover {
  scale: 1.05;
}
.search-and-logout form input {
  padding: 6px;
  border-radius: 10px;
  outline: none;
  border: 1px solid #4070f4;
}
.level_links{
  width: 50%;
  justify-content: space-around;
}
.level_links a{
  text-decoration: none;
  font-weight: 500;
  padding: 5px;
  background-color: #4070f4;
  border-radius: 10px;
  color: white;
}
section {
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
}
.all-users {
  padding: 30px;
  display: grid;
  grid-template-columns: auto auto auto auto;
  column-gap: 20px;
  row-gap: 20px;
  width: 100%;
  
}
@media screen and (min-width: 768px) and (max-width:1023) {
  .all-users {
  padding: 10px;
  display: grid;
  grid-template-columns: auto auto  ;
  column-gap: 20px;
  row-gap: 20px;
  width: 100%;
  
}
.student {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  border: 3px solid #4070f4;
  background-color: #4070f4;
  padding:20px;
  border-radius: 20px;
  transition: 0.5s;
}
}
.student {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  border: 3px solid #4070f4;
  background-color: #4070f4;
  padding: 20px;
  border-radius: 20px;
  transition: 0.5s;
}
.student:hover{
  scale: 0.9;
}
.student img{
  width: 250px;
  height: 250px;
}
.student p{
  position: absolute;
  margin-left: 90px;
  margin-top: 90px;
  color: black;
}
.student_a{
  text-decoration: none;
}
.searchButton{
  background-color: #4070f4;
  padding-left: 20px;
  padding-right: 20px;
  padding-top: 2px;
  padding-bottom: 3px;
  margin-top: 10px;
  border-radius: 10px;
  border: none;
  cursor: pointer;
}
.search_matric{
  margin-top: -20px;
}

    </style>
</head>
<body>
<nav>
      <h1>All Students</h1>
      <div class="search-and-logout">
        <form  action="search_result.php"
          method="post"
          enctype="multipart/form-data">
          <input class="search_matric" name="search_matric" placeholder="Search Matric Number" type="text" />
          <button class="searchButton" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="white" class="bi bi-search" viewBox="0 0 16 16">
  <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
</svg></button>

        </form>
        <a href="signUp.html">Signup</a>
      </div>
    </nav>
    <section class="level_links">
<a href="index.php">All</a>
<a href="hundredLevel.php">100 Level</a> 
<a href="TwoHundredLevel.php">200 Level</a>
<a href="ThreeHundredLevel.php">300 Level</a>
<a href="FourHundredLevel.php">400 Level</a>
    </section>
    <section>
    <div class='all-users'>
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

            // SQL query to fetch user information
            $sql = "SELECT * FROM `user` WHERE LEVEL = 300";
            $result = $conn->query($sql);

            while($row = $result->fetch_assoc()) {
                
                echo "<a class='student_a' href='userLogin.php?id=" . $row['id'] . "&matric=" . $row['matric'] . "&firstname=" . $row['firstname'] . "&lastname=" . $row['lastname'] . "'>
                  <div class='student'>
                  <img src='locker.png'>
                    ";
                   echo "<p>". $row['matric'] ."</p>";
                 echo "</div>
                </a>
              ";
            }
           
      
      ?>
      </div>

</body>
</html>
