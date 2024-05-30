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
        <section id="viewenquiry">
            <!-- Picture and credentials section -->
            <div class="container">
            <input type="checkbox" id="menu-toggle" class="menu-toggle">
            <label for="menu-toggle" class="menu-toggle-label">☰</label>
            <?php include "sidebar.php"; ?>
                <main>
                    <!-- search and sort goes here -->
                    <div id="top_ui">
                        <h1>View Volunteers</h1>

                        <form method="GET">
                            <table>
                                <tr>
                                    <td><input type="text" class="search-bar" name="search" value="<?php if (isset($_GET['search'])) {
                                        echo $_GET['search'];
                                    } ?>" placeholder="Search..."></td>
                                    <td class="search-td"><button type="submit" class="search-btn"><img
                                                src="../images/search_icon.png" alt="search-icon"
                                                class="search-icon"></button>
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

                            <th class="volunteer_table_header">Phone #</th>

                            <th class="volunteer_table_header">Organization</th>
                            <th class="volunteer_table_header">Full Time / Part Time</th>

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
                            $sql = "SELECT * FROM volunteer_information WHERE CONCAT(first_name,last_name,phone_num,organization,organization_type) LIKE '%$filtervalues%'";
                        }

                        $result = $conn->query($sql);

                        if (!$result) {
                            die("Invalid query!");
                        }

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>
                                    <td>{$row['first_name']} {$row['last_name']}</td>
                                    
                                    <td>{$row['phone_num']}</td>
                                    
                                    <td>{$row['organization']}</td>
                                    <td>{$row['organization_type']}</td>
                                    
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
                                    } 
                                }

                                if (isset($_GET['action']) && ($_GET['action'] == 'delete_confirmation' && isset($_GET['id']))) {


                                    echo "<div id='user-edit' class='pop-up'>
                                    <div class='pop-up-content'>  
                                      <div id='pop-up-header'>
                                        <p>Delete Confirmation</p>
                                      </div>
                                      
                                      <br>
                                      <a class='close-btn' href='viewvolunteers.php'>&times;</a>
                                      <p>Are you sure with deleting?</p>
                                      <br>
                                      <a class='delete-button' href='viewvolunteers.php?action=delete&id={$row['id']}'>Delete</a>
                                      <a class='exit-button' href='viewvolunteers.php'>Exit</a>
                          
                                    </div>
                                  </div>";
                                }


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
                            echo "<div id='user-edit' class='pop-up'>
                                    <div class='pop-up-content'>
                                        <div id='pop-up-header'>
                                            <p>Full Volunteers</p>
                                        </div>
                                        <br>
                                        <a class='close-btn' href='viewvolunteers.php'>&times;</a>
                                        <p>Name: $fullname </p>
                                        <p>E-mail: $email</p>
                                        <p>Phone Number: $phone_num</p>
                                        <p>Street Address: $street_address</p>
                                        <p>Postcode: $postcode</p>
                                        <p>City/Town: $city_or_town</p>
                                        <p>State: $state</p>
                                        <p>Organization: $organization</p>
                                        <p>Organization Type: $organization_type</p>
                                        <p>Working Days: $days</p>
                                        <p>Working Time: $time</p>
                                        <p>Message: $message</p>
                                    </div>
                                </div>";
                        }
                    }
                    ?>
                </main>
            </div>
        </section>
        <br><br>
</body>

</html>