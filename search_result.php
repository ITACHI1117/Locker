<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: "Poppins", sans-serif;
        }
        nav {
            display: flex;
            flex-direction: row;
            padding: 20px;
            justify-content: space-around;
        }
        .search-and-logout {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: space-around;
        }
        .search-and-logout ul li {
            padding: 4px;
            padding-left: 15px;
            padding-right: 15px;
            background-color: #4070f4;
            list-style: none;
            cursor: pointer;
            border-radius: 10px;
            transition: 0.1s;
            color: white;
        }
        .search-and-logout ul li:hover {
            scale: 1.05;
        }
        .search-and-logout form input {
            padding: 6px;
            border-radius: 10px;
            outline: none;
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
            column-gap: 5px;
            row-gap: 5px;
            width: 100%;
        }
        .student {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            border: 1px solid black;
            padding: 100px;
        }
    </style>
</head>
<body>
    <nav>
        <h1>All Students</h1>
        <div class="search-and-logout">
            <form action="" method="post">
                <input name="search_matric" placeholder="Search Matric Number" type="text" />
                <button type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                </svg></button>
            </form>
            <ul>
                <li>Logout</li>
            </ul>
        </div>
    </nav>
    <section>
        <div class='all-users'>
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

                // Retrieve search term from form
                $search_matric = $_POST['search_matric'];

                // SQL query to fetch user information based on search term
                $sql = "SELECT * FROM user WHERE matric = '$search_matric'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<a href='userLogin.php?id=" . $row['id'] . "&matric=" . $row['matric'] . "&firstname=" . $row['firstname'] . "&lastname=" . $row['lastname'] . "'>";
                        echo "<div class='student'>";
                        echo "<svg xmlns='http://www.w3.org/2000/svg' width='80' height='80' fill='currentColor' class='bi bi-lock' viewBox='0 0 16 16'>
                            <path d='M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2m3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2M5 8h6a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1'/>
                        </svg>";
                        echo "<p>". $row['matric'] ."</p>";
                        echo "</div>";
                        echo "</a>";
                    }
                } else {
                    echo "<p>No records found.</p>";
                }

                // Close connection
                $conn->close();
            }
            ?>
        </div>
    </section>
</body>
</html>
