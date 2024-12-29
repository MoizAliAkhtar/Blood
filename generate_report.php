<?php
header('Content-Type: application/json');

// Database connection
$host = 'localhost';
$db = 'blood_donation_system';
$user = 'root';
$pass = '';
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die(json_encode(['error' => 'Database connection failed']));
}

$data = json_decode(file_get_contents('php://input'), true);
$reportType = $data['reportType'];
$startDate = $data['startDate'];
$endDate = $data['endDate'];

$query = '';
if ($reportType == 'donors') {
    $query = "SELECT date, 'Donor' AS type, name AS details, status FROM info1 WHERE date BETWEEN '$startDate' AND '$endDate'";
} elseif ($reportType == 'patients') {
    $query = "SELECT date, 'Patient' AS type, name AS details, status FROM info2 WHERE date BETWEEN '$startDate' AND '$endDate'";
} elseif ($reportType == 'inventory') {
    $query = "SELECT date, 'Blood Inventory' AS type, details, status FROM inventory WHERE date BETWEEN '$startDate' AND '$endDate'";
}

$result = $conn->query($query);
$data = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

echo json_encode($data);
$conn->close();
?>
