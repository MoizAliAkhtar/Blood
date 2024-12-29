<?php
session_start();

// Sample database connection (adjust to your DB details)
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'bdms';

$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize error message variable
$error = '';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user input
    $contact = $_POST['contact'];
    $password = $_POST['password'];

    // Query to check the credentials
    $sql = "SELECT * FROM info2 WHERE patient_contact = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $contact);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // User exists, verify password
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            // Password matches, login successful
            $_SESSION['patient_id'] = $user['id'];
            $_SESSION['patient_name'] = $user['patient_name'];
            header("Location: patientdashboard.php"); // Redirect to the dashboard
            exit;
        } else {
            // Password doesn't match
            $error = "Invalid contact number or password.";
        }
    } else {
        // User not found
        $error = "Invalid contact number or password.";
    }
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: #2c3e50;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            border-radius: 15px;
            padding: 30px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.3);
        }

        .login-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .login-header h2 {
            color: #ffffff;
            margin-bottom: 5px;
        }

        .login-header p {
            font-size: 14px;
            color: #bdc3c7;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            color: #ecf0f1;
            font-weight: 500;
            margin-bottom: 5px;
        }

        input {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.6);
            font-size: 14px;
            color: #2c3e50;
            outline: none;
        }

        input::placeholder {
            color: #7f8c8d;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #2980b9;
            border: none;
            border-radius: 8px;
            color: white;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #1c5985;
        }

        .error-message {
            color: #e74c3c;
            background-color: rgba(231, 76, 60, 0.1);
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-header">
            <h2>Patient Login</h2>
            <p>Access your account</p>
        </div>
        <?php if (!empty($error)): ?>
            <div class="error-message"><?php echo $error; ?></div>
        <?php endif; ?>
        <form action="" method="POST">
            <div class="form-group">
                <label for="contact">Contact Number</label>
                <input type="text" id="contact" name="contact" placeholder="Enter your contact number" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <button type="submit">Login</button>
        </form>
    </div>
</body>

</html>
