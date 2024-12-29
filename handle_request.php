<?php
session_start();

// Check if the action is 'accept'
if (isset($_POST['action']) && $_POST['action'] == 'accept') {
    // Connect to the database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "bdms";
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get the patient ID
    $patient_id = $_POST['patient_id'];

    // Fetch patient data based on the ID
    $sql = "SELECT * FROM info2 WHERE id = $patient_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Store the patient data in session
        $patient_data = $result->fetch_assoc();
        $_SESSION['accepted_patient'] = $patient_data;

        // Redirect to the appointment page
        header("Location: appointments.php");
        exit();
    } else {
        echo "Patient not found.";
    }

    // Close the connection
    $conn->close();
}
?>
