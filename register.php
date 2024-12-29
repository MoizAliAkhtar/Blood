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
    // Retrieve form data
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $cnic = mysqli_real_escape_string($conn, $_POST['cnic']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);  // Capture the selected role (Donor or User)

    // Insert data into reginfo table
    $sql = "INSERT INTO reginfo (fullname, cnic, contact, email, role) 
            VALUES ('$fullname', '$cnic', '$contact', '$email', '$role')";

    if (mysqli_query($conn, $sql)) {
        // Redirect to a specific page based on the role
        if ($role == 'admin') {
            header("Location: Adminmain.html");  // Redirect to Donor dashboard
        } else {
            header("Location:  indexmain.html");  // Redirect to User dashboard
        }
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Close connection
mysqli_close($conn);
?>
