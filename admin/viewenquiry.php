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
    <!--Picture and credentials section-->
    <div class="container">

      <aside class="sidebar">
        <div class="logo"><img src="../images/logo2.png"></div>
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

        <!-- search and sort goes here -->
        <div id="top_ui">
          <h1>View Enquiries</h1>


        </div>


        <!--padding in between sections-->
        <table>
          <tr>
            <th class="enquiry_table_header">ID</th>
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
              <td>{$row['id']}</td>
              <td>{$row['first_name']} {$row['last_name']}</td>
              <td>{$row['service_type']}</td>
              <td>{$row['contact_method']}</td>
              <td>{$row['appointment_option']}</td>";
            echo "
              <td>
                  <a id='view-button' href='viewenquiry.php?action=view&id={$row['id']}'>View</a>
                  <a id='delete-button' href='viewenquiry.php?action=delete&id={$row['id']}'>Delete</a>
              </td>
          </tr>
          ";

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
                $title = $row['title'];
                $date = $row['date'];
                $description = $row['description'];
                $photo = $row['photo'];
                $show_info = 1;
              }
            }
            if (isset($_GET['submit'])) {
              $search = $_GET['search'];

            }
          }
          ?>
        </table>
  </section>
  <br><br>



  <div id="enquiry_padding"></div>
  <?php include "../footer.php"; ?>
</body>

</html>