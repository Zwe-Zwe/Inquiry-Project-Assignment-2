<!DOCTYPE html>
<html lang="en">
<head>
    <title>Malaysian Sign Language</title>
    <meta charset="utf-8">
    <meta name="description" content="volunteer">
    <meta name="keywords" content="volunteer">
    <meta name="author" content="Daniel Sie, Zwe Htet Zaw, Paing Chan, Sherlyn Kok, Michael Wong">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="images/love-you-gesture-svgrepo-com.svg" type="images/svg">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <?php include 'header.php'; ?>

    <section class="volunteer-process-section">
        <div class="form-container">
            <h2>Volunteering Confirmation Details</h2>
            <?php
            $errors = [];
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $firstName = filter_input(INPUT_POST, "first-name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $lastName = filter_input(INPUT_POST, "last-name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
                $phoneNumber = filter_input(INPUT_POST, "phone-number", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $address = filter_input(INPUT_POST, "address", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $cityTown = filter_input(INPUT_POST, "city-town", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $state = filter_input(INPUT_POST, "state", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $postalCode = filter_input(INPUT_POST, "postal-code", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $volunteerOptions = filter_input(INPUT_POST, "volunteer-options", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $volunteerType = filter_input(INPUT_POST, "volunteer", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $message = filter_input(INPUT_POST, "message", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                // Validations
                if (!$email) {
                    $errors[] = "Invalid email address.";
                }
                if (!$firstName || !$lastName) {
                    $errors[] = "Full name is required.";
                }
                if (!preg_match('/^\+[0-9]{12}$/', $phoneNumber)) {
                    $errors[] = "Invalid phone number. Please enter 10 digits.";
                }
                if (empty($address)) {
                    $errors[] = "Address is required.";
                }
                if (empty($cityTown)) {
                    $errors[] = "City/Town is required.";
                }
                if (empty($state)) {
                    $errors[] = "State is required.";
                }
                if (!preg_match('/^\d{5}$/', $postalCode)) {
                    $errors[] = "Postal code must be 5 digits.";
                }
                if(empty($volunteerOptions)){
                    $errors[] = "Volunteer Option must be chosen";
                }
                if(empty($volunteerType)){
                    $errors[] = "Volunteer Type must be chosen";
                }
                if(empty($message)){
                    $errors[] = "Reason must be written";
                }

                if (empty($errors)) {
                    echo "<h2>Thank you for volunteering!</h2>";
                    echo "<p>Welcome {$firstName} {$lastName}</p>";
                    echo "<p>Your email address is: {$email}</p>";
                    echo "<p>Your phone number is: {$phoneNumber}</p>";
                    echo "<p>Your address is: {$address}, {$cityTown}, {$state}, {$postalCode}</p>";
                    echo "<p>You wish to volunteer with: {$volunteerOptions}</p>";

                    if ($volunteerType == "Full-time") {
                        echo "<p>You have chosen to volunteer full-time.</p>";
                        echo "<p>Your working hours are: Monday to Friday, 8am - 5pm and Saturday, 9am - 5pm</p>";
                    } elseif ($volunteerType == "Part-time") {
                        echo "<p>You have chosen to volunteer part-time.</p>";
                        $days = filter_input(INPUT_POST, "day", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                        if ($days) {
                            echo "<p>Your working days are: " . implode(", ", $days) . "</p>";
                        }
                        $time = filter_input(INPUT_POST, "time", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                        echo "<p>Your working time is: {$time}</p>";
                    }
                    echo "<p>Your reason(s) for volunteering: {$message}</p>";
                } else {
                    foreach ($errors as $error) {
                        echo "<p class='error'>" . htmlspecialchars($error) . "</p>";
                    }
                }
            }
            ?>
            <a class="volunteer-process-button" href="join-volunteer.php">CONFIRM</a>
        </div>
    </section>

    <?php include 'footer.php'; ?>
</body>
</html>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST["first-name"];
    $last_name = $_POST["last-name"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $city_or_town = $_POST["city-town"];
    $state = $_POST["state"];
    $postcode = $_POST["postal-code"];
    $phone_num = $_POST["phone-number"];
    $org = $_POST["volunteer"];

    require_once "dbh_inc.php"; // Assuming dbh_inc.php contains your database connection using mysqli

    $query = "INSERT INTO volunteer_information (first_name, last_name, email, street_address, city_or_town, state, postcode, phone_num, organization) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $mysqli->prepare($query);

    // Bind parameters
    $stmt->bind_param("sssssssss", $first_name, $last_name, $email, $address, $city_or_town, $state, $postcode, $phone_num, $org);

    // Execute statement
    $stmt->execute();

    // Close statement
    $stmt->close();

    // Close connection
    $mysqli->close();

    header("Location: ../index.php");
    exit();
} else {
    header("Location: ../index.php");
    exit();
}
?>
