<?php
session_start();

// Check if the patient is logged in
if (!isset($_SESSION['patient_id'])) {
    header("Location: patient_login.php");
    exit();
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bdms";
$conn = new mysqli($servername, $username, $password, $dbname);

// Fetch patient details from the database
$patient_id = $_SESSION['patient_id'];
$sql = "SELECT * FROM info2 WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $patient_id);
$stmt->execute();
$result = $stmt->get_result();

// Check if a patient was found
if ($result->num_rows > 0) {
    $patient = $result->fetch_assoc();
} else {
    echo "No patient found.";
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Dashboard - Blood Donation System</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
            margin-top: 70px;
        }
        
        .navbar {
            background-color: #2c3e50;
        }

        .navbar-brand {
            font-size: 24px;
            color: #fff;
        }

        .container {
            max-width: 900px;
            margin-top: 40px;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        h2 {
            font-size: 30px;
            color: #2c3e50;
            text-align: center;
            margin-bottom: 30px;
            font-weight: bold;
        }

        .list-group {
            margin-bottom: 30px;
        }

        .list-group-item {
            font-size: 18px;
            padding: 15px;
            text-align: center;
            border: none;
            background-color: #ecf0f1;
            margin-bottom: 10px;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }

        .list-group-item:hover {
            background-color: #bdc3c7;
            cursor: pointer;
        }

        .btn {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            font-weight: bold;
            border-radius: 5px;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }

        .btn-logout {
            background-color: #e74c3c;
            color: white;
            border: none;
        }

        .btn-logout:hover {
            background-color: #c0392b;
        }

        .btn-back {
            background-color: #3498db;
            color: white;
            border: none;
        }

        .btn-back:hover {
            background-color: #2980b9;
        }

        .footer {
            text-align: center;
            margin-top: 40px;
            font-size: 14px;
            color: #7f8c8d;
        }

        .card {
            margin-bottom: 20px;
        }

        .card-header {
            background-color: #2c3e50;
            color: white;
            font-weight: bold;
            text-align: center;
        }

        .card-body {
            background-color: #ecf0f1;
            padding: 20px;
            border-radius: 8px;
        }

        .card-body p {
            font-size: 18px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="#">Blood Donation System</a>
    </nav>

    <!-- Dashboard Content -->
    <section class="container">
        <h2>Welcome, <?php echo htmlspecialchars($patient['patient_name']); ?></h2>
        
        <div class="card">
            <div class="card-header">
                Patient Information
            </div>
            <div class="card-body">
                <p><strong>Name:</strong> <?php echo htmlspecialchars($patient['patient_name']); ?></p>
                <!-- <p><strong>Email:</strong> <?php echo htmlspecialchars($patient['patient_email']); ?></p> -->
                <p><strong>Contact:</strong> <?php echo htmlspecialchars($patient['patient_contact']); ?></p>
                <!-- <p><strong>Blood Type:</strong> <?php echo htmlspecialchars($patient['blood_type']); ?></p> -->
            </div>
        </div>

        <div class="list-group">
            <a href="patientprofile.php" class="list-group-item list-group-item-action">Profile</a>
            <a href="accepted_requests.php" class="list-group-item list-group-item-action">Accepted Blood Requests</a>
        </div>

        <!-- Action Buttons -->
        <a href="users.html" class="btn btn-back">Back to Users</a>
        <a href="logout.php" class="btn btn-logout">Logout</a>
    </section>

    <!-- Footer -->
    <div class="footer">
        <p>&copy; 2024 Blood Donation System. All rights reserved.</p>
    </div>

    <!-- JavaScript and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
