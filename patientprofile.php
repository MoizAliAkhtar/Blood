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
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
            margin-top: 70px;
        }

        .container {
            max-width: 800px;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        h2 {
            font-size: 32px;
            color: #2c3e50;
            text-align: center;
            margin-bottom: 30px;
            font-weight: bold;
        }

        .profile-info p {
            font-size: 18px;
            color: #34495e;
            margin-bottom: 15px;
        }

        .profile-info strong {
            color: #2c3e50;
        }

        .btn {
            width: 200px;
            padding: 12px;
            font-size: 16px;
            font-weight: bold;
            border-radius: 5px;
            margin-top: 30px;
            transition: background-color 0.3s ease;
        }

        .btn-secondary {
            background-color: #3498db;
            color: white;
            border: none;
        }

        .btn-secondary:hover {
            background-color: #2980b9;
        }

        .footer {
            text-align: center;
            margin-top: 50px;
            font-size: 14px;
            color: #7f8c8d;
        }

        .footer p {
            margin-bottom: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Patient Profile</h2>
        <div class="profile-info">
            <?php if ($patient): ?>
                <p><strong>Name:</strong> <?php echo htmlspecialchars($patient['patient_name']); ?></p>
                <p><strong>Age:</strong> <?php echo htmlspecialchars($patient['patient_age']); ?></p>
                <p><strong>Blood Group:</strong> <?php echo htmlspecialchars($patient['blood_group']); ?></p>
                <p><strong>Contact:</strong> <?php echo htmlspecialchars($patient['patient_contact']); ?></p>
                <p><strong>Location:</strong> <?php echo htmlspecialchars($patient['locations']); ?></p>
                <p><strong>Requirements:</strong> <?php echo htmlspecialchars($patient['requirements']); ?></p>
            <?php else: ?>
                <p>No patient data found.</p>
            <?php endif; ?>
        </div>

        <!-- Go Back Button -->
        <div class="text-center">
            <a href="patientdashboard.php" class="btn btn-secondary">Go Back</a>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>&copy; 2024 Blood Donation System. All rights reserved.</p>
    </div>

</body>
</html>
