<?php
include 'connection.php';

// sql to create table
$sql = "CREATE TABLE IF NOT EXISTS activities (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        description TEXT NOT NULL,
        photo VARCHAR(255) NOT NULL
    )";

if (mysqli_query($conn, $sql)) {
    echo "Table Activities created successfully<br>";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

$sql = "INSERT INTO activities (title, description, photo) VALUES
(
    'CHARITY FOOD FAIR 🍲 [07/04/2024]',
    'Purchasing a book of coupon which is worth RM100, you can buy varius items in the fair, while also supporting Sarawak Society of the Deaf(SSD) in gathering the goal of RM300,000. The money will be used for:-',
    'images/charity.jpg'
),
(
    'PINES SQUARE FAIR [26/01/2024 - 07/02/2024]',
    'Hi everyone! SSD is thrilled to be invited by MTPN to host our Deaf businesses at their Fair. Come check us out at Pines Square (opposite MJC Batu Kawa) - we are open from 7pm every night from 26 January until 7 February (15 days)!',
    'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.430580468989!2d110.3089454!3d1.51122!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31fb095d5241459d%3A0x7448a49d54f86631!2sPINES%20SQUARE!5e0!3m2!1sen!2smy!4v1710831506517!5m2!1sen!2smy'
),
(
    'THANK YOU FOR THE DONATION [13/01/2024]', 
    'Representatives from Kuching Buddhist Meditation handed over 30 bags of rice and one big packet of Bee Hoon to Sarawak Society for the Deaf. SSD staff Amy Lau thanked and presented a token of appreciation to them.', 
    'images/rice.jpg'
),
(
    'UNITY CHARITY AND CULTURE [13/01/2024]',
    'Sarawak Society for the Deaf (SSD) is happy and honoured to be invited by MTPN & YMLM Sarawak to attend their UNITY CHARITY AND CULTURE at the Riverine Ballroom by Lok Thian on 13 January 2024.',
    'images/eating.jpg'
)";

if (mysqli_query($conn, $sql)) {
    echo "Data inserted";
} else {
    echo "Error inserting data: " . mysqli_error($conn);
}

mysqli_close($conn);
?>