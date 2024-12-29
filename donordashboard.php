<?php
session_start();

// Check if donor is logged in
if (!isset($_SESSION['donor_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donor Dashboard - Blood Donation System</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
            max-width: 800px;
            background-color: #ffffff;
            padding: 30px;
            margin-top: 50px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        h2 {
            font-size: 32px;
            color: #2c3e50;
            margin-bottom: 30px;
            font-weight: bold;
        }

        .list-group-item {
            font-size: 18px;
            padding: 15px;
            text-align: center;
        }

        .list-group-item a {
            color: #3498db;
            text-decoration: none;
            font-weight: bold;
        }

        .list-group-item a:hover {
            text-decoration: underline;
        }

        .btn-logout {
            background-color: #e74c3c;
            color: white;
            border: none;
            width: 150px;
            padding: 12px;
            font-size: 16px;
            font-weight: bold;
            border-radius: 5px;
        }

        .btn-logout:hover {
            background-color: #c0392b;
        }

        .btn-back {
            background-color: #3498db;
            color: white;
            border: none;
            width: 150px;
            padding: 12px;
            font-size: 16px;
            font-weight: bold;
            border-radius: 5px;
            margin-top: 20px;
        }

        .btn-back:hover {
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
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="#">Blood Donation System</a>
    </nav>

    <!-- Donor Dashboard -->
    <section class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Welcome, <?php echo htmlspecialchars($_SESSION['donor_name']); ?>!</h2>
            <form method="POST" action="logout.php">
                <button type="submit" class="btn btn-logout">Logout</button>
            </form>
        </div>

        <div class="mt-4">
            <ul class="list-group">
                <li class="list-group-item"><a href="donorprofile.php">Profile</a></li>
                <li class="list-group-item"><a href="accepted_patient.php">Appointments</a></li>
                <li class="list-group-item"><a href="needblood.php">Blood Requests</a></li>
            </ul>
        </div>

        <!-- Back Button -->
        <div class="text-center mt-4">
            <a href="users.html" class="btn btn-back">Back</a>
        </div>
    </section>

    <!-- Footer -->
    <div class="footer">
        <p>&copy; 2024 Blood Donation System. All rights reserved.</p>
    </div>

    <!-- JavaScript and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
