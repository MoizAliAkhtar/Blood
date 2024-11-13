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

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $request_id = mysqli_real_escape_string($conn, $_POST['request_id']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    // Update the request status
    $sql = "UPDATE requests SET status = '$status' WHERE request_id = '$request_id'";

    if (mysqli_query($conn, $sql)) {
        // Redirect to the pending requests page after updating
        header("Location: pending_requests.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Close connection
mysqli_close($conn);
?>
