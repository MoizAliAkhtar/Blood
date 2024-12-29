<?php
session_start();

// Check if the form is submitted
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

    // Get the form data
    $patient_id = $_POST['patient_id'];
    $appointment_date = $_POST['appointment_date'];

    // Sanitize inputs to prevent SQL injection
    $appointment_date = mysqli_real_escape_string($conn, $appointment_date);

    // SQL to insert appointment data (no comments field)
    $sql = "INSERT INTO appointments (patient_id, appointment_date) 
            VALUES ('$patient_id', '$appointment_date')";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        // Redirect or show success message
        echo "Appointment saved successfully!";
    } else {
        // Handle error
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the connection
    $conn->close();
} else {
    // Redirect if not a POST request
    header("Location: appointment_page.php");
    exit();
}
?>
