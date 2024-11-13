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

// Fetch the latest patient data
$sql = "SELECT * FROM info2 ORDER BY id DESC LIMIT 1"; // Assuming 'id' is a unique identifier with auto-increment
$result = mysqli_query($conn, $sql);
$patient = mysqli_fetch_assoc($result);

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Patient Profile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Patient Profile</h2>
        <?php if ($patient): ?>
            <p><strong>Name:</strong> <?php echo $patient['patient_name']; ?></p>
            <p><strong>Age:</strong> <?php echo $patient['patient_age']; ?></p>
            <p><strong>Blood Group:</strong> <?php echo $patient['blood_group']; ?></p>
            <p><strong>Contact:</strong> <?php echo $patient['patient_contact']; ?></p>
            <p><strong>Location:</strong> <?php echo $patient['locations']; ?></p>
            <p><strong>Requirements:</strong> <?php echo $patient['requirements']; ?></p>
        <?php else: ?>
            <p>No patient data found.</p>
        <?php endif; ?>

        <!-- Go Back Button -->
        <div class="text-center mt-4">
            <a href="patientlink.html" class="btn btn-secondary">Go Back</a>
        </div>
    </div>
</body>
</html>
