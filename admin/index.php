<?php

include "../connection.php";

$id = "";
$email = "";
$password = "";

// Check if delete action is requested
if(isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "DELETE FROM `users` WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();

    // Redirect back to index.php after deletion
    header('Location: index.php');
    exit();
}

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

// Check if edit button is clicked
if (isset($_GET['id']) && isset($_GET['action']) && $_GET['action'] == 'edit') {
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
        .pop-up {
            display: none;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
            -webkit-backdrop-filter: blur(5px);
            backdrop-filter: blur(5px);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .pop-up-content {
            border-radius: 10px;
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 65%;
            box-shadow: 0px 0px 10px 0px #000;
            animation: animateModal 0.4s;
        }

        @keyframes animateModal {
            from {opacity: 0;}
            to {opacity: 1;}
        }

        .close-btn {
            color: #aaa;
            float: right;
            font-size: 40px;
            font-weight: bold;
            text-decoration: none;
        }

        .close-btn:hover,
        .close-btn:focus {
            color: black;
            cursor: pointer;
        }
    </style>
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
                            <a href="index.php?action=add">Add New</a>
                        </li>
                        <li>
                            <a href="activities-HD/management.php">Activities</a>
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
            </table>
        </div>
    </section>

    <?php if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])): ?>
    <div id="user-edit" class="pop-up" style="display: flex;">
        <div class="pop-up-content">
            <a class="close-btn" href="index.php">&times;</a>
            <form method="post">
                <h1>Update User</h1>
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>"> <br>

                <label for="email"> EMAIL: </label>
                <input type="text" name="email" id="email" value="<?php echo htmlspecialchars($email); ?>"> <br>

                <label for="password"> PASSWORD: </label>
                <input type="text" name="password" id="password" value="<?php echo htmlspecialchars($password); ?>"> <br>

                <input type="submit" name="submit" value="Update">
                <input type="submit" name="cancel" value="Cancel">
            </form>
        </div>
    </div>

    <?php endif; ?>

    <?php if (isset($_GET['action']) && $_GET['action'] == 'add'): ?>
    <div id="user-create" class="pop-up" style="display: flex;">
        <div class="pop-up-content">
            <a class="close-btn" href="index.php">&times;</a>
            <form method="post">
                <h1>Create New User</h1>
                <label> EMAIL: </label>
                <input type="text" name="email"> <br>
                <label> PASSWORD: </label>
                <input type="text" name="password"> <br>
                <input type="submit" name="submit" value="Create">
                <input type="submit" name="cancel" value="Cancel">
            </form>
        </div>
    </div>
    <?php endif; ?>
</body>
</html>
