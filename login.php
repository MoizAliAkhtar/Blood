<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bdms";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data for username and cnic
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $cnic = mysqli_real_escape_string($conn, $_POST['cnic']); // Using CNIC instead of password

    // Check if user exists with the provided fullname and cnic
    $sql = "SELECT * FROM reginfo WHERE fullname='$username' AND cnic='$cnic'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // User found - proceed with login
        $_SESSION['username'] = $username;
        header("Location: indexmain.html"); // Redirect to a dashboard page after login
        exit();
    } else {
        // User not found - show error message
        echo "<div style='text-align:center; margin-top:20px;'>
                <p style='color:red;'>User not registered. Please <a href='register.html'>register here</a> first.</p>
              </div>";
    }
}
mysqli_close($conn);
?>
