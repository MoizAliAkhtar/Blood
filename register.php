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

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $cnic = mysqli_real_escape_string($conn, $_POST['cnic']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    
    // Insert data into reginfo table
    $sql = "INSERT INTO reginfo (fullname, cnic, contact, email) VALUES ('$fullname', '$cnic', '$contact', '$email')";

    if (mysqli_query($conn, $sql)) {
        header("Location: index.html"); // Redirect to a dashboard page after login
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    
}

// Close connection
mysqli_close($conn);
?>
