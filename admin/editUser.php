<?php
    include "../connection.php";
    $id="";
    $email="";
    $password="";

    $error="";
    $success="";

    if($_SERVER["REQUEST_METHOD"]=='GET'){
        if(!isset($_GET['id'])){
            header("location:index/index.php");
            exit;
        }
        $id = $_GET['id'];
        $sql = "select * from users where id=$id";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        while(!$row){
            header("location: index/index.php");
            exit;
        }
        $email=$row["email"];
        $password=$row["password"];

    } else if(isset($_POST['cancel'])){
            header("Location: index.php");
            exit();
    } else {
        $id = $_POST["id"];
        $email=$_POST["email"];
        $password=$_POST["password"];

        $sql = "update users set email='$email', password='$password' where id='$id'";
        $result = $conn->query($sql);

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
  <section id="user-edit">
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
    
    <div id="user-edit-form">
        <form method="post">
            <h1>Update User</h1>
            
            <input type="hidden" name="id" value="<?php echo $id; ?>"> <br>
    
            <label> EMAIL: </label>
            <input type="text" name="email" value="<?php echo $email; ?>"> <br>
    
            <label> PASSWORD: </label>
            <input type="text" name="password" value="<?php echo $password; ?>"> <br>

            <input type="submit" name="submit" value="Submit"></input>
            <input type="submit" name="cancel" href="index.php" value="Cancel"></a>
        </form>
    </div>
  </section>
</body>
</html>
