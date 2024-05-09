<?php
    include "../connection.php";
    if(isset($_POST['submit'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
        $q = "INSERT INTO `users`(`email`, `password`) VALUES ('$email', '$password')";

        $query = mysqli_query($conn,$q);

        header("Location: index.php");
        exit();
    } else if(isset($_POST['cancel'])){
        header("Location: index.php");
        exit();
    }
?>

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
    <link rel="stylesheet" href="../styles/style.css" />
    <link
      rel="stylesheet"
      type="text/css"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
  </head>

<body>
  <section id="user-create">
    <nav>
        <div>
            <div>
                <ul>
                    <li>
                        <a aria-current="page" href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="createUser.php"><span>Add New</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <div id="user-create-form">
        <form method="post">
    
            <h1>Create New User</h1>
    
            <label> EMAIL: </label>
            <input type="text" name="email"> <br>
    
            <label> PASSWORD: </label>
            <input type="text" name="password"> <br>
    
            <input type="submit" name="submit" value="Submit"></input>
            <input type="submit" name="cancel" href="index.php" value="Cancel"></input>
        </form>
    </div>
  </section>
</body>
</html> 
