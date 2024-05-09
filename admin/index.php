<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Malaysian Sign Language</title>
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
    
            $sql = "select * from users";
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
