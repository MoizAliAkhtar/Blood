<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bdms";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "bdms";
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get form data
    $contact = $_POST['contact'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password before storing

    // Query to insert the donor information
    $stmt = $conn->prepare("INSERT INTO info1 (fullname, city, contact, bloodType, bloodUnit, availabilitys, password) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $_POST['fullname'], $_POST['city'], $contact, $_POST['bloodType'], $_POST['bloodUnit'], $_POST['availabilitys'], $password);

    if ($stmt->execute()) {
        echo "Registration successful!";
        // Redirect to login page after successful registration
        header("Location: donorlogin.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
