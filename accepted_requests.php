<?php
session_start();
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

$patient_id = $_SESSION['patient_id'];
$sql = "SELECT * FROM info1 WHERE id IN (SELECT donor_id FROM accepted_requests WHERE patient_id = $patient_id)";
$result = $conn->query($sql);
$donors = $result->fetch_all(MYSQLI_ASSOC);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accepted Blood Requests - Blood Donation System</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="#">Blood Donation System</a>
    </nav>

    <!-- Accepted Blood Requests -->
    <section class="container mt-5 pt-5">
        <h2>Accepted Blood Requests</h2>
        <ul class="list-group mt-4">
            <?php foreach ($donors as $donor): ?>
                <li class="list-group-item"><?php echo $donor['name']; ?> - <?php echo $donor['blood_group']; ?></li>
            <?php endforeach; ?>
        </ul>
    </section>

    <!-- JavaScript and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
