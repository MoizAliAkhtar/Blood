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
    $patient_name = mysqli_real_escape_string($conn, $_POST['patient_name']);
    $patient_age = mysqli_real_escape_string($conn, $_POST['patient_age']);
    $blood_group = mysqli_real_escape_string($conn, $_POST['blood_group']);
    $patient_contact = mysqli_real_escape_string($conn, $_POST['patient_contact']);
    $locations = mysqli_real_escape_string($conn, $_POST['locations']);
    $requirements = mysqli_real_escape_string($conn, $_POST['requirements']);

    
    $sql = "INSERT INTO info2 (patient_name, patient_age, blood_group, patient_contact, locations, requirements) 
            VALUES ('$patient_name', '$patient_age', '$blood_group', '$patient_contact', '$locations', '$requirements')";

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        header("Location: patientlink.html");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Close connection
mysqli_close($conn);
?>
