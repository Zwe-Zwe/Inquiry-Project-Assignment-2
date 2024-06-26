<?php

include "../connection.php";

$id = $userid = $email = $password = $error ="";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['cancel'])) {
        header("Location: user_management.php");
        exit();
    }

    $userid = trim($_POST["userid"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    // Validate inputs
    if (empty($userid)) {
        $error = "User ID is required";
    } elseif (empty($email)) {
        $error = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format";
    } elseif (empty($password)) {
        $error = "Password is required";
    } elseif (strlen($password) < 6) {
        $error = "Password must be at least 6 characters long";
    }

    if (empty($error)) {
        $password_hashed = password_hash($password, PASSWORD_BCRYPT);
        if (isset($_POST['submit']) && $_POST['submit'] == 'Create') {
            $sql = "INSERT INTO users (userid, email, password) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $userid, $email, $password_hashed);
            if ($stmt->execute()) {
                header("Location: user_management.php?success=New user created");
                exit();
            } else {
                $error = "Error creating user.";
            }
        } elseif (isset($_POST['submit']) && $_POST['submit'] == 'Update') {
            $id = $_POST["id"];
            $sql = "UPDATE users SET userid=?, email=?, password=? WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssi", $userid, $email, $password_hashed, $id);
            if ($stmt->execute()) {
                header("Location: user_management.php?success=User updated");
                exit();
            } else {
                $error = "No changes were made or the user does not exist.";
            }
        }
        $stmt->close();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['action'])) {
    if ($_GET['action'] == 'delete' && isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "DELETE FROM users WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();

        header('Location: user_management.php');
        exit();
    } else if ($_GET['action'] == 'edit' && isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM users WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        if ($row) {
            $userid = $row["userid"];
            $email = $row["email"];
            $password = $row["password"];
        }
        $stmt->close();
    }
}



// Default sorting order
$sortOrder = "ASC"; // Default ascending order

// Check if sorting order is provided in the URL
if (isset($_GET['sort']) && ($_GET['sort'] == 'asc' || $_GET['sort'] == 'desc')) {
    $sortOrder = ($_GET['sort'] == 'desc') ? 'DESC' : 'ASC';
    $sql = "SELECT * FROM users ORDER BY email $sortOrder";
} else {
    $sql = "SELECT * FROM users";
}
$result = $conn->query($sql);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Panel (Users)</title>
    <meta charset="utf-8" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="Daniel Sie, Zwe Htet Zaw, Paing Chan" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" href="images/love-you-gesture-svgrepo-com.svg" type="images/svg" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="../styles/style.css" />
</head>
<body>
    <section id="management">
    <div class="container">
        <input type="checkbox" id="menu-toggle" class="menu-toggle">
        <label for="menu-toggle" class="menu-toggle-label">☰</label>
        <?php include "sidebar.php"; ?>
        <main>
            <section class="user-management">
                <h1>User management</h1>
                <div id="table_top">
                    <a class="sort_logout" href="?sort=''">Default</a>  <a class="sort_logout" href="?sort=asc">Sort Ascending</a>  <a class="sort_logout" href="?sort=desc">Sort Descending</a>
                    <a class="sort_logout" href="../index.php">Logout</a>
                </div>    
                <table>
                    
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                        
                        <?php
                        if (!$result) {
                            die("Invalid query!");
                        }
                        while ($row = $result->fetch_assoc()) {
                        
                            
                            echo "
                            <tr>
                                <td>{$row['id']}</td>
                                <td>{$row['userid']}</td>
                                <td>{$row['password']}</td>
                                <td>{$row['email']}</td>  <td>  ";

                                if ($row['userid'] != 'admin') {
                                echo "
                                    <a id='edit-button' href='user_management.php?action=edit&id={$row['id']}'>Edit</a>
                                    <a id='delete-button' href='user_management.php?action=delete_confirmation&id={$row['id']}'>Delete</a>";
                                }
                                echo"
                                </td>
                            </tr>
                            ";

                            if (isset($_GET['action']) && ($_GET['action'] == 'delete_confirmation' && isset($_GET['id']))) {


                                echo "<div id='user-edit' class='pop-up'>
                                <div class='pop-up-content'>  
                                  <div id='pop-up-header'>
                                    <p>Delete Confirmation</p>
                                  </div>
                                  
                                  <br>
                                  <a class='close-btn' href='viewenquiries.php'>&times;</a>
                                  <p>Are you sure with deleting?</p>
                                  <br>
                                  <a class='delete-button' href='user_mangement.php?action=delete&id={$row['id']}'>Delete</a>
                                  <a class='exit-button' href='user_mangement.php'>Back</a>
                            
                                </div>
                              </div>";
                            }
                            
                    }


                    

                        ?>
                    
                        <!-- Add table rows here -->
                        
        
                        <!-- Continue for other rows -->
    
                </table>
                <?php if (isset($_GET['action']) && ($_GET['action'] == 'add' || ($_GET['action'] == 'edit' && isset($_GET['id'])))): ?>
                <div id="user-edit" class="pop-up">
                    <div class="pop-up-content">
                        <a class="close-btn" href="user_management.php">&times;</a>
                        <form method="post">
                            <h1><?php echo $_GET['action'] == 'edit' ? 'Update User' : 'Create New User'; ?></h1>
                            <?php if ($_GET['action'] == 'edit'): ?>
                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
                            <?php endif; ?>
                            <?php
                                if (!empty($error)) {
                                    echo "<p class='user_error'>". $error ."</p>";
                                }
                            ?>
                            <label for="userid"> USER ID: </label>
                            <input type="text" name="userid" id="userid" value="<?php echo htmlspecialchars($userid); ?>"> <br>
                            <label for="email1"> EMAIL: </label>
                            <input type="text" name="email" id="email1" value="<?php echo htmlspecialchars($email); ?>"> <br>
                            <label for="password"> PASSWORD: </label>
                            <input type="text" name="password" id="password" value="<?php echo htmlspecialchars($password); ?>"> <br>
                            <input type="submit" name="submit" value="<?php echo $_GET['action'] == 'edit' ? 'Update' : 'Create'; ?>">
                            <input type="submit" name="cancel" value="Cancel">
                        </form>
                    </div>
                </div>
                <?php endif; ?>
            </section>
        </main>
    </div>
    </section>
</body>
</html>
