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

<main>


  <section id="viewenquiry">
    <!--Picture and credentials section-->
    <div class="container">

      <aside class="sidebar">
        <div class="logo"><img src="../images/logo2.png"></div>
        <nav>
          <ul>
            <li><a href="index.php">User Management</a></li>
            <li><a href="index.php?action=add">Add New User</a></li>
            <li><a href="#">Enquiry Forms</a></li>
            <li class="active"><a href="#">Volunteer Forms</a></li>
          </ul>
        </nav>
      </aside>
      <main>
        <header>

        </header>

        <!-- search and sort goes here -->
        <div id="top_ui">
          <h1>View Enquiries</h1>

          <div>
            <form id="search-form">
              <input type="text" name="search" value="<?php if(isset($_GET['search'])){echo $_GET['search']}" class="search-bar" placeholder="Search...">
              <br>
              <div class="search-submit">
                <a><img src="../images/search_icon.svg" alt="search_icon" title="Continue searching"></a>
              </div>

            </form>
          </div>
        </div>

        <br>

        <!--padding in between sections-->
        <table>
          <tr>
            <th class="enquiry_table_header">No.</th>
            <th class="enquiry_table_header">Name</th>
            <th class="enquiry_table_header">Service Type</th>
            <th class="enquiry_table_header">Contact Method</th>
            <th class="enquiry_table_header">Appointment Option</th>
            <th class="enquiry_table_header">Options</th>
          </tr>

          <?php
          $servername = 'localhost';
          $username = 'root';
          $password = '';
          $dbname = 'msl';

          $count = 1;

          $conn = mysqli_connect($servername, $username, $password, $dbname);

          if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
          }

          $sql = "SELECT * FROM enquiry_information";
          $result = $conn->query($sql);


          if (!$result) {
            die("Invalid query!");
          }
          while ($row = $result->fetch_assoc()) {
            echo "
          <tr>
              <td>$count</td>
              <td>{$row['first_name']} {$row['last_name']}</td>
              <td>{$row['service_type']}</td>
              <td>{$row['contact_method']}</td>
              <td>{$row['appointment_option']}</td>";
            echo "
              <td>
                  <a id='view-button' href='viewenquiry.php?action=view&id={$row['id']}'>View</a>
                  <a id='delete-button' href='viewenquiry.php?action=delete_confirmation&id={$row['id']}'>Delete</a>
              </td>
          </tr>

          
          ";
            $count = $count + 1;

            if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['action'])) {
              if ($_GET['action'] == 'delete' && isset($_GET['id'])) {
                $id = $_GET['id'];
                $sql = "DELETE FROM enquiry_information WHERE id=?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $id);
                $stmt->execute();
                header("Location: viewenquiry.php");
                exit();
              } else if ($_GET['action'] == 'view' && isset($_GET['id'])) {
                // Handle view form display
                $id = $_GET['id'];
                $sql = "SELECT * FROM enquiry_information WHERE id=?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                $fullname = $row['first_name'] . " " . $row['last_name'];
                $email = $row['email'];
                $countryCode = $row['countryCode'];
                $phoneNumber = $row['phoneNumber'];
                $service_type = $row['service_type'];
                $contact_method = $row['contact_method'];
                $appointment_option = $row['appointment_option'];
                $appointment_date = $row['appointment_date'];
                $appointment_time = $row['appointment_time'];
                $show_info = 1;
              }
            }
            if (isset($_GET['submit'])) {
              $search = $_GET['search'];

            }

            if (isset($_GET['action']) && ($_GET['action'] == 'delete_confirmation' && isset($_GET['id']))) {


              echo "<div id='user-edit' class='pop-up' style='display: flex;'>
                <div class='pop-up-content'>  
                  <div id='pop-up-header'>
                    <p>Delete Confirmation</p>
                  </div>
                  
                  <br>
                  <a class='close-btn' href='viewenquiry.php'>&times;</a>
                  <p>Are you sure with deleting?</p>
                  <a id='delete-button' href='viewenquiry.php?action=delete&id={$row['id']}'>Delete</a>
                  <a class='exit-btn' href='viewenquiry.php'>Exit</a>
  
                </div>
              </div>";
            }

          }


          ?>
        </table>
        <?php if (isset($_GET['action']) && ($_GET['action'] == 'view' && isset($_GET['id']))): ?>
          <div id="user-edit" class="pop-up" style="display: flex;">
            <div class="pop-up-content">
              <div id="pop-up-header">
                <p>Full Enquiry</p>
              </div>
              <br>
              <a class="close-btn" href="viewenquiry.php">&times;</a>

              <p>Name: <?php echo $fullname; ?></p>
              <p>E-mail: <?php echo $email; ?></p>
              <p>Country Code: <?php echo $countryCode; ?></p>
              <p>Phone Number: <?php echo $phoneNumber; ?></p>
              <p>Service Type: <?php echo $service_type; ?></p>
              <p>Contact Method: <?php echo $contact_method; ?></p>
              <p>Appointment Option: <?php echo $appointment_option; ?></p>
              <p>Appointment Date: <?php echo $appointment_date; ?></p>
              <p>Appointment Time:<?php echo $appointment_time; ?></p>

            </div>
          </div>
        <?php endif; ?>


  </section>
  <br><br>
</main>



<div id="enquiry_padding"></div>

</body>

</html>