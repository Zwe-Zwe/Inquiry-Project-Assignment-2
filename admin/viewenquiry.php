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
  <?php include "../header.php"; ?>

  <article>
    <!--Picture and credentials section-->
    <section id="viewenquiry">
      <br>
      <div id="viewenquiry_title">View Enquiries</div>

      <!--padding in between sections-->  
      <table>
        <tr>
          <th class="enquiry_table_header">ID</th>
          <th class="enquiry_table_header">Name</th>
          <th class="enquiry_table_header">Service Type</th>
          <th class="enquiry_table_header">Contact Method</th>
          <th class="enquiry_table_header">Appointment Option</th>
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

        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            ?>

            <tr>
              <td class="enquiry_table_row"><?php echo $row["id"]; ?></td>
              <td class="enquiry_table_row"><?php echo $row["first_name"] . " " . $row['last_name']; ?></td>
              <td class="enquiry_table_row"><?php echo $row["service_type"]; ?></td>
              <td class="enquiry_table_row"><?php echo $row["contact_method"]; ?></td>
              <td class="enquiry_table_row"><?php echo $row["appointment_option"]; ?></td>

            </tr>

            <?php
          }
        } else {
          echo "0 results";
        }
        mysqli_close($conn)
          ?>
      </table>
    </section>
    <br><br>

    

    <div id="enquiry_padding"></div>
    <?php include "../footer.php"; ?>
</body>

</html>