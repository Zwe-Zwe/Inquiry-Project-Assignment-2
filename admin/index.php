<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Admin Panel (Users)</title>
    <meta charset="utf-8" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="Daniel Sie, Zwe Htet Zaw, Paing Chan" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link
      rel="icon"
      href="images/love-you-gesture-svgrepo-com.svg"
      type="images/svg"
    />
    <link
    rel="stylesheet"
    type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    />
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <link rel="stylesheet" href="../styles/style.css" />
  </head>
<body>
  <section id="admin-index">
    <nav>
        <div>
            <div>
                <ul>
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="createUser.php">Add New</a>
                    </li>
                    <li>
                        <a href="../index.php">Logout</a>
                    </li>
                    <li>
                    <a href="?sort=''">Default</a> | <a href="?sort=asc">Sort Ascending</a> | <a href="?sort=desc">Sort Descending</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <div>
        <table>
            <tr>
                <th>ID</th>
                <th>EMAIL</th>
                <th>PASSWORD</th>
                <th>ACTIONS</th>
            </tr>
            <?php
            include "../connection.php";

            // Default sorting order
            $sortOrder = "ASC"; // Default ascending order

            // Check if sorting order is provided in the URL
            if(isset($_GET['sort']) && ($_GET['sort'] == 'asc' || $_GET['sort'] == 'desc')) {
                // If sorting order is provided and valid, set $sortOrder
                $sortOrder = ($_GET['sort'] == 'desc') ? 'DESC' : 'ASC';
                $sql = "SELECT * FROM users ORDER BY email $sortOrder";
            } else {
                // Default query without sorting
                $sql = "SELECT * FROM users";
            }
            $result = $conn->query($sql);
            if(!$result){
                die("Invalid query!");
            }
            while($row=$result->fetch_assoc()){
                echo "
                <tr>
                    <td>$row[id]</td>
                    <td>$row[email]</td>
                    <td>$row[password]</td>
                    <td>
                        <a href='editUser.php?id=$row[id]'>Edit</a>
                        <a id='delete-btn' href='deleteUser.php?id=$row[id]'>Delete</a>
                    </td>
                </tr>
                ";
            }
            ?>
        </table>
    </div>
  </section>
</body>
</html>
