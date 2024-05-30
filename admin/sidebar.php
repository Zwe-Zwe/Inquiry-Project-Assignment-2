<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php
function isActive($page) {
    $current_page = basename($_SERVER['PHP_SELF']);
    return $current_page == $page ? 'active' : '';
}
?>

<aside class="sidebar">
    <div class="logo"><img src="../images/logo2.png"></div>
    <nav id="admin-nav">
        <ul>
            <li class="<?php echo isActive('user_management.php'); ?>"><a href="user_management.php">User Management</a></li>
            <li><a href="user_management.php?action=add">Add New User</a></li>
            <li class="<?php echo isActive('viewenquiries.php'); ?>"><a href="viewenquiries.php">Enquiry Forms</a></li>
            <li class="<?php echo isActive('viewvolunteers.php'); ?>"><a href="viewvolunteers.php">Volunteer Forms</a></li>
            <li><a href="../index.php">Logout</a></li> 
        </ul>
    </nav>
</aside>

    
</body>
</html>