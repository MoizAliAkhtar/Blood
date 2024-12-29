<?php
$servername = "localhost";  // Change if your database is on a different server
$username = "root";         // Your MySQL username
$password = "";             // Your MySQL password
$dbname = "bdms";           // Your database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch donor data
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "SELECT * FROM info1";  // Change the table name as per your database
    $result = $conn->query($sql);
    
    $donors = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $donors[] = $row;
        }
    }

    // Return the data as JSON
    echo json_encode($donors);
}

// Delete a donor
if ($_SERVER['REQUEST_METHOD'] === 'DELETE' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM info1 WHERE id = $id";  // Change 'info1' if necessary
    
    if ($conn->query($sql) === TRUE) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $conn->error]);
    }
}

$conn->close();
?>
