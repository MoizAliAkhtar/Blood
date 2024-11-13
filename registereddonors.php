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

// Fetch donor data from the database
$sql = "SELECT * FROM info1";
$result = mysqli_query($conn, $sql);

// Check if there are any results
if (mysqli_num_rows($result) > 0) {
    // Create an array to store the fetched data
    $donors = [];
    while($row = mysqli_fetch_assoc($result)) {
        $donors[] = $row;
    }
} else {
    $donors = [];
}

// Close the connection
mysqli_close($conn);

// Return the data as a JSON response
echo json_encode($donors);
?>
