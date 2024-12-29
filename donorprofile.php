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

// Fetch donor data
$sql = "SELECT * FROM info1 ORDER BY id DESC LIMIT 1"; // Get the most recently registered donor
$result = mysqli_query($conn, $sql);
$donor = mysqli_fetch_assoc($result);

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donor Profile</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Blood Donation System</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="users.html">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="donorProfile.php">Donor Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#appointments">Appointments</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="needblood.php">Blood Requests</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <h2 class="text-center mb-4">Donor Profile</h2>
        <?php if ($donor): ?>
            <div class="card">
                <div class="card-header bg-danger text-white">
                    <h4 class="mb-0">Donor Details</h4>
                </div>
                <div class="card-body">
                    <p><strong>Full Name:</strong> <?php echo htmlspecialchars($donor['fullname']); ?></p>
                    <p><strong>City:</strong> <?php echo htmlspecialchars($donor['city']); ?></p>
                    <p><strong>Contact:</strong> <?php echo htmlspecialchars($donor['contact']); ?></p>
                    <p><strong>Blood Type:</strong> <?php echo htmlspecialchars($donor['bloodtype']); ?></p>
                    <p><strong>Blood Unit (ml):</strong> <?php echo htmlspecialchars($donor['bloodunit']); ?></p>
                    <p><strong>Availability:</strong> <?php echo htmlspecialchars($donor['availabilitys']); ?></p>
                </div>
                <div class="card-footer text-center">
                    <a href="donate.php" class="btn btn-secondary">Register New Donor</a>
                    <a href="users.html" class="btn btn-danger">Go Back</a>
                </div>
            </div>
        <?php else: ?>
            <div class="alert alert-warning text-center">
                <p>No donor data found.</p>
                <a href="donorprofile.php" class="btn btn-danger">Register First</a>
                
            </div>
        <?php endif; ?>
    </div>

    <!-- JavaScript and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
