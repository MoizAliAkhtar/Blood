<?php
// Start session
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

// Fetch all patients' information who need blood
$sql = "SELECT id AS patient_id, patient_name, patient_age, blood_group, patient_contact, locations, requirements FROM info2";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patients in Need of Blood - Blood Donation System</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="#">Blood Donation System</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="donordashboard.php">Home</a></li>
                <!-- <li class="nav-item"><a class="nav-link" href="">Donor Profile</a></li> -->
                <li class="nav-item"><a class="nav-link" href="accepted_patient.php">Appointments</a></li>
            </ul>
        </div>
    </nav>

    <!-- Patients in Need of Blood Section -->
    <section class="container mt-5 pt-5">
        <h2 class="text-center">Patients in Need of Blood</h2>
        
        <?php
        if ($result->num_rows > 0) {
            // Display the patient list in a table
            echo "<table class='table table-striped mt-4'>
                    <thead>
                        <tr>
                            <th scope='col'>Patient Name</th>
                            <th scope='col'>Age</th>
                            <th scope='col'>Blood Group</th>
                            <th scope='col'>Contact</th>
                            <th scope='col'>Location</th>
                            <th scope='col'>Specific Requirements</th>
                            <th scope='col'>Actions</th>
                        </tr>
                    </thead>
                    <tbody>";

            // Output data of each patient
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row['patient_name'] . "</td>
                        <td>" . $row['patient_age'] . "</td>
                        <td>" . $row['blood_group'] . "</td>
                        <td>" . $row['patient_contact'] . "</td>
                        <td>" . $row['locations'] . "</td>
                        <td>" . $row['requirements'] . "</td>
                        <td>
                            <form method='post' action='accepted_patient.php'>
                                <input type='hidden' name='patient_id' value='" . $row['patient_id'] . "'>
                                <button type='submit' name='action' value='accept' class='btn btn-success'>Accept</button>
                                <button type='submit' name='action' value='decline' class='btn btn-danger'>Decline</button>
                            </form>
                        </td>
                      </tr>";
            }

            echo "</tbody></table>";
        } else {
            echo "<p>No patients are currently in need of blood.</p>";
        }

        // Close the connection
        $conn->close();
        ?>
    </section>

    <!-- JavaScript and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
