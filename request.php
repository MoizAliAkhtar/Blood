<?php
header('Content-Type: application/json'); // Add this line to ensure the response is JSON
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

// Fetch patient data from the database
$sql = "SELECT * FROM info2";
$result = mysqli_query($conn, $sql);

// Check if there are any results
$patients = [];
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $patients[] = $row;
    }
}

// Close the connection
mysqli_close($conn);

// Return the data as a JSON response
echo json_encode($patients);
?>
