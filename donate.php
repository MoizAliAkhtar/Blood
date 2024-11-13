<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bdms";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'];
    $city = $_POST['city'];
    $contact = $_POST['contact'];
    $bloodType = $_POST['bloodType'];
    $bloodUnit = $_POST['bloodUnit'];
    $availabilitys = $_POST['availabilitys'];

    $sql = "INSERT INTO info1 (fullname, city, contact, bloodType, bloodUnit, availabilitys)
            VALUES ('$fullname', '$city', '$contact', '$bloodType', '$bloodUnit', '$availabilitys')";

if (mysqli_query($conn, $sql)) {
    header("Location: donorlink.html");
    exit();
    } else {
        echo "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
    }
}

// Close the connection
$conn->close();
?>


