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

// Fetch the accepted patient data from the appointments table
$sql = "SELECT * FROM appointments WHERE status = 'Accepted'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accepted Patient - Blood Donation System</title>
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
                <li class="nav-item"><a class="nav-link" href="users.html">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="">Donor Profile</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Appointments</a></li>
            </ul>
        </div>
    </nav>

    <!-- Accepted Patient Section -->
    <section class="container mt-5 pt-5">
        <h2 class="text-center">Accepted Patient Information</h2>

        <?php
        if ($result->num_rows > 0) {
            // Display the accepted patient info
            while ($row = $result->fetch_assoc()) {
                echo "<h3>Patient Name: " . $row['patient_name'] . "</h3>";
                echo "<p><strong>Age:</strong> " . $row['patient_age'] . "</p>";
                echo "<p><strong>Blood Group:</strong> " . $row['blood_group'] . "</p>";
                echo "<p><strong>Contact:</strong> " . $row['patient_contact'] . "</p>";
                echo "<p><strong>Location:</strong> " . $row['locations'] . "</p>";
                echo "<p><strong>Specific Requirements:</strong> " . $row['requirements'] . "</p>";
            }
        } else {
            echo "<p>No accepted patients found.</p>";
        }

        $conn->close();
        ?>
    </section>

    <!-- JavaScript and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
