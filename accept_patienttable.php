<?php
session_start();

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

// Handle form submission for accepting or declining
if (isset($_POST['action'])) {
    $patient_id = $_POST['id']; // This is the id in the info2 table
    $action = $_POST['action'];

    if ($action === 'accept') {
        // Fetch patient details from info2 table using prepared statement
        $sql = "SELECT * FROM info2 WHERE id = ?";  // Use 'id' here as per your table
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            die("Error preparing query: " . $conn->error);
        }
        $stmt->bind_param("i", $patient_id);  // Binding patient_id as an integer
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Insert the accepted patient into the appointments table using prepared statements
            $insert_sql = "INSERT INTO appointments (patient_id, patient_name, patient_age, blood_group, patient_contact, locations, requirements, status) 
                           VALUES (?, ?, ?, ?, ?, ?, ?, 'Accepted')";

            $insert_stmt = $conn->prepare($insert_sql);
            if (!$insert_stmt) {
                die("Error preparing insert query: " . $conn->error);
            }
            $insert_stmt->bind_param("issssss", 
                $row['id'],  // Use 'id' here
                $row['patient_name'], 
                $row['patient_age'], 
                $row['blood_group'], 
                $row['patient_contact'], 
                $row['locations'], 
                $row['requirements']
            );

            if ($insert_stmt->execute()) {
                echo "Patient accepted and inserted successfully.<br>";
                // Redirect to the accepted_patient.php page if insertion was successful
                header("Location: accepted_patient.php");
                exit();
            } else {
                die("Error executing insert query: " . $insert_stmt->error);
            }
        } else {
            die("No patient found with the given ID.");
        }
    } elseif ($action === 'decline') {
        // Optionally, you can handle the decline action here
        echo "Patient declined.";
    }
}

$conn->close();
?>
