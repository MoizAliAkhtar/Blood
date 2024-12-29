<?php
session_start();

// Check if the user is already logged in
if (isset($_SESSION['donor_id'])) {
    header("Location: donordashboard.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "bdms";
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get form data
    $contact = $_POST['contact'];
    $password = $_POST['password'];

    // Query to check if the donor exists
    $stmt = $conn->prepare("SELECT * FROM info1 WHERE contact = ?");
    $stmt->bind_param("s", $contact);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $donor = $result->fetch_assoc();
        // Verify the hashed password
        if (password_verify($password, $donor['password'])) {
            // Start session and store donor data
            $_SESSION['donor_id'] = $donor['id'];
            $_SESSION['donor_name'] = $donor['fullname'];
            header("Location: donordashboard.php");
            exit();
        } else {
            $error = "Invalid login credentials";
        }
    } else {
        $error = "No user found with this contact number.";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donor Login - Blood Donation System</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="#">Blood Donation System</a>
    </nav>

    <!-- Donor Login Form -->
    <section class="container mt-5 pt-5">
        <h2>Donor Login</h2>
        <?php
        if (isset($error)) {
            echo "<div class='alert alert-danger'>$error</div>";
        }
        ?>
        <form method="POST" class="mt-4">
            <div class="form-group mb-3">
                <label for="contact" class="form-label">Contact Number</label>
                <input type="text" class="form-control" id="contact" name="contact" placeholder="Enter contact number" required>
            </div>

            <div class="form-group mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
            </div>

            <button type="submit" class="btn btn-danger">Login</button>
        </form>
    </section>

    <!-- JavaScript and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
