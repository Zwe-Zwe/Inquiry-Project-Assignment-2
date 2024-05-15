<!DOCTYPE html>
<html lang="en">
<head>
    <title>Malaysian Sign Language</title>
    <meta charset="utf-8">
    <meta name="description" content="enquiry">
    <meta name="keywords" content="enquiry">
    <meta name="author" content="Daniel Sie, Zwe Htet Zaw, Paing Chan, Sherlyn Kok, Michael Wong">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="images/love-you-gesture-svgrepo-com.svg" type="images/svg">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <?php include 'header.php'; ?>

    <section class="enquiry_process_section">
        <div class="form_container">
            <h2>Enquiry Form Confirmation</h2>

            <?php
            include 'connection.php'; 

            $errors = [];
            $confirmed = false;

            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirm'])) {

                $confirmed = true;
                $email = $_POST['email'];
                $phNum = $_POST['phoneNumber'];
                
                $email_exist = mysqli_query($conn, "SELECT email FROM enquiry_information WHERE email = '$email'");
                $phNum_exist = mysqli_query($conn, "SELECT phone_num FROM enquiry_information WHERE phone_num = '$phNum'");
                if (mysqli_num_rows($email_exist) > 0) $errors['email'] = "EMAIL ALREADY EXISTS.";
                if (mysqli_num_rows($phNum_exist) > 0) $errors['phNum'] = "PHONE NUMBER ALREADY EXISTS.";
                
                if (empty($errors)) {
                    $stmt = $conn->prepare("INSERT INTO enquiry_information (first_name, last_name, email, country_code, phone_num, service_type, contact_method, appointment, date, time) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                    $stmt->bind_param("ssssssssss", $_POST['first_name'], $_POST['last_name'], $email, $_POST['countryCode'], $phNum, $_POST['service'], $_POST['contact_method'], $_POST['appointment_option'], $_POST['appointmentDate'], $_POST['appointmentTime']);

                    if ($stmt->execute()) {
                        header("Location: enquiry-service.php");
                        exit();
                    } else {
                        echo "Error: " . $stmt->error;
                    }

                    $stmt->close();
                } else {
                    foreach ($errors as $key => $error) {
                        echo "<p>Error in $key: $error</p>";
                    }
                }
            } else {
                if ($_SERVER["REQUEST_METHOD"] == "POST" && !$confirmed) {
                    // Initial process: validate data and display for confirmation
                    $firstName = filter_input(INPUT_POST, "first_name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    $lastName = filter_input(INPUT_POST, "last_name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
                    $countryCode = filter_input(INPUT_POST, "countryCode", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    $phNum = filter_input(INPUT_POST, "phoneNumber", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    $service = filter_input(INPUT_POST, "service", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    $contactMethod = isset($_POST['contact_method']) ? implode(", ", $_POST['contact_method']) : '';
                    $appointment = filter_input(INPUT_POST, "appointment_option", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    $date = filter_input(INPUT_POST, "appointmentDate", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    $time = filter_input(INPUT_POST, "appointmentTime", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                    if (empty($firstName)) $errors['first_name'] = "First name is required.";
                    if (empty($lastName)) $errors['last_name'] = "Last name is required.";
                    if (!$email) $errors['email'] = "Invalid or empty email.";
                    if (empty($countryCode)) $errors['countryCode'] = "Country Code is required.";
                    if (empty($phNum)) $errors['phoneNumber'] = "Phone Number is required.";
                    if (empty($service)) $errors['service'] = "Service Option is required.";
                    if (empty($contactMethod)) $errors['contact_method'] = "Contact Method option is required.";
                    if (empty($appointment)) $errors['appointment_option'] = "Appointment option is required.";
                    if (empty($date)) $errors['appointmentDate'] = "Date is required.";
                    if (empty($time)) $errors['appointmentTime'] = "Time is required.";

                    if (!preg_match('/^\+[0-9]{12}$/', $phNum)) $errors['phoneNumber'] = "Invalid phone number. Please enter 12 digits including country code.";

                    if (empty($errors)) {
                        echo "<h3> Please confirm your details!</h3>";
                        echo "<p> Name: " . htmlspecialchars($firstName) . " " . htmlspecialchars($lastName) . "</p>";
                        echo "<p> Email: " . htmlspecialchars($email) . "</p>";
                        echo "<p> Country Code: " . htmlspecialchars($countryCode) . "</p>";
                        echo "<p> Phone Number: " . htmlspecialchars($phNum) . "</p>";
                        echo "<p> Service: " . htmlspecialchars($service) . "</p>";
                        echo "<p> Contact Method: " . htmlspecialchars($contactMethod) . "</p>";
                        echo "<p> Appointment Type: " . htmlspecialchars($appointment) . "</p>";
                        echo "<p> Date: " . htmlspecialchars($date) . "</p>";
                        echo "<p> Time: " . htmlspecialchars($time) . "</p>";

                        echo '<form action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '" method="post">';
                        foreach ($_POST as $key => $value) {
                            if (is_array($value)) {
                                foreach ($value as $item) {
                                    echo '<input type="hidden" name="' . htmlspecialchars($key) . '[]" value="' . htmlspecialchars($item) . '">';
                                }
                            } else {
                                echo '<input type="hidden" name="' . htmlspecialchars($key) . '" value="' . htmlspecialchars($value) . '">';
                            }
                        }
                        echo '<input type="hidden" name="confirm" value="1">';
                        echo '<input class="volunteer-process-button" type="submit" value="CONFIRM"></input>';
                        echo '</form>';
                    } else {
                        foreach ($errors as $key => $error) {
                            echo "<p>Error in $key: $error</p>";
                        }
                        echo '<a class="volunteer-process-button" href="join-volunteer.php">RETURN</a>';
                    }
                }
            }

            mysqli_close($conn);
            ?>
        </div>
    </section>

    <?php include 'footer.php'; ?>

</body>
</html>
