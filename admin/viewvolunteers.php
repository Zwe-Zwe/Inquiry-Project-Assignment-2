<!DOCTYPE html>
<html lang="en">

<head>
    <title>Malaysian Sign Language</title>
    <meta charset="utf-8">
    <meta name="description" content="michael">
    <meta name="keywords" content="michael">
    <meta name="author" content="Daniel Sie, Zwe Htet Zaw, Paing Chan, Sherlyn Kok, Michael Wong">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../images/love-you-gesture-svgrepo-com.svg" type="images/svg">
    <link rel="stylesheet" href="../styles/style.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

    <main>
        <section id="viewenquiry">
            <!-- Picture and credentials section -->
            <div class="container">
                <aside class="sidebar">
                    <div class="logo"><img src="../images/logo2.png"></div>
                    <nav>
                        <ul>
                            <li><a href="index.php">User Management</a></li>
                            <li><a href="index.php?action=add">Add New User</a></li>
                            <li><a href="viewenquirytest.php">Enquiry Forms</a></li>
                            <li class="active"><a href="viewvolunteers.php">Volunteer Forms</a></li>
                            <li><a href="../index.php">Logout</a></li>
                        </ul>
                    </nav>
                </aside>
                <main>
                    <header></header>

                    <!-- search and sort goes here -->
                    <div id="top_ui">
                        <h1>View Volunteers</h1>

                        <form>
                            <table>
                                <tr>
                                    <td><input type="text" class="search-bar" name="search" value="<?php if (isset($_GET['search'])) {
                                        echo $_GET['search'];
                                    } ?>" placeholder="Search..."></td>
                                    <td class="search-td"><a><img src="../images/search_icon.png" alt="search-icon"
                                                class="search-icon"></a>
                                    </td>
                                </tr>
                            </table>
                        </form>



                    </div>


                    <br>

                    <!-- padding in between sections -->
                    <table>
                        <tr>
                            <th class="volunteer_table_header">Full Name</th>
                            <th class="volunteer_table_header">Email</th>
                            <th class="volunteer_table_header">Phone #</th>
                            <th class="volunteer_table_header">Address</th>
                            <th class="volunteer_table_header">Organization</th>
                            <th class="volunteer_table_header">Full Time / Part Time</th>
                            <th class="volunteer_table_header">Working Days & Time</th>
                            <th class="volunteer_table_header">Reason</th>
                            <th class="volunteer_table_header">Options</th>
                        </tr>

                        <?php
                        $servername = 'localhost';
                        $username = 'root';
                        $password = '';
                        $dbname = 'msl';

                        $conn = mysqli_connect($servername, $username, $password, $dbname);

                        if (!$conn) {
                            die("Connection failed: " . mysqli_connect_error());
                        }

                        if (empty($_GET['search'])) {
                            $sql = "SELECT * FROM volunteer_information";
                        } else {
                            $filtervalues = $_GET['search'];
                            $sql = "SELECT * FROM volunteer_information WHERE CONCAT(first_name,last_name,email,phone_num,street_address,city_or_town,state,postcode,organization,organization_type,days,time,message) LIKE '%$filtervalues%'";
                        }

                        $result = $conn->query($sql);

                        if (!$result) {
                            die("Invalid query!");
                        }

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>
                                    <td>{$row['first_name']} {$row['last_name']}</td>
                                    <td>{$row['email']}</td>
                                    <td>{$row['phone_num']}</td>
                                    <td>{$row['street_address']} {$row['postcode']} {$row['city_or_town']} {$row['state']}</td>
                                    <td>{$row['organization']}</td>
                                    <td>{$row['organization_type']}</td>
                                    <td>{$row['days']} {$row['time']}</td>
                                    <td>{$row['message']}</td>
                                    <td id='volunteer_options'>
                                        <a id='view-button' href='viewvolunteers.php?action=view&id={$row['id']}'>View</a>
                                        <a id='delete-button' href='viewvolunteers.php?action=delete_confirmation&id={$row['id']}'>Delete</a>
                                    </td>
                                </tr>";

                                if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['action'])) {
                                    if ($_GET['action'] == 'delete' && isset($_GET['id'])) {
                                        $id = $_GET['id'];
                                        $sql = "DELETE FROM volunteer_information WHERE id=?";
                                        $stmt = $conn->prepare($sql);
                                        $stmt->bind_param("i", $id);
                                        $stmt->execute();
                                        exit();
                                    } else if ($_GET['action'] == 'view' && isset($_GET['id'])) {
                                        // Handle view form display
                                        $id = $_GET['id'];
                                        $sql = "SELECT * FROM volunteer_information WHERE id=?";
                                        $stmt = $conn->prepare($sql);
                                        $stmt->bind_param("i", $id);
                                        $stmt->execute();
                                        $result = $stmt->get_result();
                                        $row = $result->fetch_assoc();
                                        $fullname = $row['first_name'] . " " . $row['last_name'];
                                        $email = $row['email'];
                                        $phone_num = $row['phone_num'];
                                        $street_address = $row['street_address'];
                                        $postcode = $row['postcode'];
                                        $city_or_town = $row['city_or_town'];
                                        $state = $row['state'];
                                        $organization = $row['organization'];
                                        $organization_type = $row['organization_type'];
                                        $days = $row['days'];
                                        $time = $row['time'];
                                        $message = $row['message'];
                                        $show_info = 1;
                                    }
                                }

                                if (isset($_GET['action']) && ($_GET['action'] == 'delete_confirmation' && isset($_GET['id']))) {


                                    echo "<div id='user-edit' class='pop-up' style='display: flex;'>
                                    <div class='pop-up-content'>  
                                      <div id='pop-up-header'>
                                        <p>Delete Confirmation</p>
                                      </div>
                                      
                                      <br>
                                      <a class='close-btn' href='viewvolunteers.php'>&times;</a>
                                      <p>Are you sure with deleting?</p>
                                      <a id='delete-button-v' href='viewvolunteers.php?action=delete&id={$row['id']}'>Delete</a>
                                      <a class='exit-btn' href='viewvolunteers.php'>Exit</a>
                          
                                    </div>
                                  </div>";
                                }


                            }

                            if (isset($_GET['action']) && ($_GET['action'] == 'view' && isset($_GET['id']))) {
                                echo " <div id='user-edit' class='pop-up' style='display: flex;'>
                                  <div class='pop-up-content'>
                                    <div id='pop-up-header'>
                                      <p>Full Volunteers</p>
                                    </div>
                                    <br>
                                    <a class='close-btn' href='viewvolunteers.php'>&times;</a>
                      
                                    <p>Name: <?php echo $fullname; ?></p>
                                    <p>E-mail: <?php echo $email; ?></p>
                                    <p>Phone Number: <?php echo $phone_num; ?></p>
                                    <p>Street Address: <?php echo $street_address; ?></p>
                                    <p>Postcode: <?php echo $postcode; ?></p>
                                    <p>City/Town: <?php echo $city_or_town; ?></p>
                                    <p>State: <?php echo $state; ?></p>
                                    <p>Organization:<?php echo $organization; ?></p>
                                    <p>Organization Type:<?php echo $organization_type; ?></p>
                                    <p>Working Days:<?php echo $days; ?></p>
                                    <p>Working Time:<?php echo $time; ?></p>
                                    <p>Message:<?php echo $message; ?></p>
                      
                                  </div>
                                </div>";
                            }

                        } else {
                            echo "<tr><td colspan='9'>No record found. Please search again, or reset.</td></tr>";
                        }
                        ?>

                    </table>

                    <?php
                    if (isset($_GET['action']) && ($_GET['action'] == 'view' && isset($_GET['id']))) {
                        $id = $_GET['id'];
                        $sql = "SELECT * FROM volunteer_information WHERE id=?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("i", $id);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            $fullname = $row['first_name'] . " " . $row['last_name'];
                            $email = $row['email'];
                            $phone_num = $row['phone_num'];
                            $street_address = $row['street_address'];
                            $postcode = $row['postcode'];
                            $city_or_town = $row['city_or_town'];
                            $state = $row['state'];
                            $organization = $row['organization'];
                            $organization_type = $row['organization_type'];
                            $days = $row['days'];
                            $time = $row['time'];
                            $message = $row['message'];
                            echo "<div id='user-edit' class='pop-up' style='display: flex;'>
                                    <div class='pop-up-content'>
                                        <div id='pop-up-header'>
                                            <p>Full Volunteers</p>
                                        </div>
                                        <br>
                                        <a class='close-btn' href='viewvolunteers.php'>&times;</a>
                                        <p>Name: $fullname; </p>
                                        <p>E-mail: $email; </p>
                                        <p>Phone Number: $phone_num; </p>
                                        <p>Street Address: $street_address; </p>
                                        <p>Postcode: $postcode; </p>
                                        <p>City/Town: $city_or_town; </p>
                                        <p>State: $state; </p>
                                        <p>Organization:$organization; </p>
                                        <p>Organization Type:$organization_type; </p>
                                        <p>Working Days:$days; </p>
                                        <p>Working Time:$time; </p>
                                        <p>Message:$message; </p>
                                    </div>
                                </div>";
                        }
                    }
                    ?>
                </main>
            </div>
        </section>
        <br><br>
    </main>

</body>

</html>