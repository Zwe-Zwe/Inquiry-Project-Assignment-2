<?php

include "../connection.php";

$id = $email = $password = $error ="";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['cancel'])) {
        header("Location: index.php");
        exit();
    } else if (isset($_POST['submit']) && $_POST['submit'] == 'Update') {
        $id = $_POST["id"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        $sql = "UPDATE users SET email=?, password=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $email, $password, $id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            header("Location: index.php");
            exit();
        } else {
            $error = "Error updating user. No changes were made or the user does not exist.";
        }
        $stmt->close();
    } else if (isset($_POST['submit']) && $_POST['submit'] == 'Create') {
        $email = $_POST["email"];
        $password = $_POST["password"];

        $sql = "INSERT INTO users (email, password) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $email, $password);
        if ($stmt->execute()) {
            header("Location: index.php");
            exit();
        } else {
            $error = "Error creating user.";
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

        header('Location: index.php');
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
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    display: flex;
}

.container {
    display: flex;
    width: 100%;
}

.sidebar {
    width: 200px;
    height: 100vh;
    background-color: #f4f4f4;
    padding: 20px;
}

.sidebar .logo img{
    width: 50%;
    margin-top: 20px;
    margin-bottom: 50px;
    margin-left: 25%;
}

.sidebar nav ul {
    list-style: none;
    padding: 0;
}

.sidebar nav ul li {
    margin-bottom: 30px;
}

.sidebar nav ul li a {
    text-decoration: none;
    color: #333;
    font-size: 20px;
}

.sidebar nav ul li.active a {
    font-weight: bold;
}

main {
    flex: 1;
    padding: 20px;
}

header {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.search-container {
    display: flex;
    align-items: center;
}

.search-container input {
    padding: 5px;
    margin-right: 10px;
}

.search-container button {
    padding: 5px 10px;
    margin-right: 10px;
}

.user-icon img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
}

#table_top {
    width: 100%;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.sort_logout {
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
    background-color: white;
    color: black;
    border-radius: 10px;
    transition: 0.3s all ease;
    border: 1px solid black ;
    text-decoration: none;
}

#logout:hover{
    background-color: #333;
    color: white;
    border: 1px solid #333 ;
    
}

.user-management {
    margin-top: 20px;
}

.user-management h1 {
    margin-bottom: 20px;
}

table {
    width: 100%;
    border-collapse: collapse;
}

table th, table td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: left;
}

table th {
    background-color: #f4f4f4;
}

table .status.active {
    color: green;
}

table .status.inactive {
    color: red;
}

.pagination {
    margin-top: 20px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.pagination a {
    margin: 0 5px;
    text-decoration: none;
    color: #333;
}

.pagination span {
    margin: 0 5px;
}

    </style>
</head>
<body>
    <div class="container">
        <aside class="sidebar">
            <div class="logo"><img src="images/logo2.png"></div>
            <nav>
                <ul>
                    <li><a href="#">User Management</a></li>
                    <li><a href="index.php?action=add">Add New User</a></li>
                    <li><a href="#">Enquiry Forms</a></li> 
                    <li class="active"><a href="#">Job Volunteer Forms</a></li> 
                </ul>
            </nav>
        </aside>
        <main>
            <header>
               
                
            </header>
            <section class="user-management">
                <div id="table_top">
                    <h1>User management</h1>
                    <a class="sort_logout" href="?sort=''">Default</a> | <a class="sort_logout" href="?sort=asc">Sort Ascending</a> | <a class="sort_logout" href="?sort=desc">Sort Descending</a>
                    <a class="sort_logout" href="../index.php">Logout</a>
                </div>    
                <table>
                    
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Email</th>
                            <th>Phone Number</th>
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
                                <td>{$row['email']}</td>
                                <td>{$row['password']}</td>
                                <td>
                                    <a id='edit-button' href='index.php?action=edit&id={$row['id']}'>Edit</a>
                                    <a id='delete-btn' href='index.php?action=delete&id={$row['id']}'>Delete</a>
                                </td>
                            </tr>
                            ";
                        }
                        ?>
                    
                        <!-- Add table rows here -->
                        
        
                        <!-- Continue for other rows -->
    
                </table>
                <?php if (isset($_GET['action']) && ($_GET['action'] == 'add' || ($_GET['action'] == 'edit' && isset($_GET['id'])))): ?>
                <div id="user-edit" class="pop-up" style="display: flex;">
                    <div class="pop-up-content">
                        <a class="close-btn" href="index.php">&times;</a>
                        <form method="post">
                            <h1><?php echo $_GET['action'] == 'edit' ? 'Update User' : 'Create New User'; ?></h1>
                            <?php if ($_GET['action'] == 'edit'): ?>
                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
                            <?php endif; ?>
                            <label for="email"> EMAIL: </label>
                            <input type="text" name="email" id="email" value="<?php echo htmlspecialchars($email); ?>"> <br>
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
</body>
</html>
