<?php
// Database connection
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'bdms';

$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Delete patient record
if (isset($_GET['delete_id'])) {
    $id = intval($_GET['delete_id']);
    $deleteQuery = "DELETE FROM info2 WHERE id = $id";
    if ($conn->query($deleteQuery) === TRUE) {
        echo "<script>alert('Patient record deleted successfully.');</script>";
    } else {
        echo "<script>alert('Error deleting record: " . $conn->error . "');</script>";
    }
}

// Fetch patient records
$query = "SELECT * FROM info2";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Patients</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 70px;
        }
        .container {
            margin-top: 50px;
        }
        .table th, .table td {
            text-align: center;
            vertical-align: middle;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="#">Admin Panel</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>

    <div class="container">
        <h2 class="text-center text-danger mb-4">Manage Patient Records</h2>
        <a href="adminmain.html" class="btn btn-secondary" style="margin-bottom:1rem;">Back to Admin Main</a>
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Blood Group</th>
                    <th>Contact</th>
                    <th>Location</th>
                    <th>Requirements</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['patient_name']}</td>
                    <td>{$row['patient_age']}</td>
                    <td>{$row['blood_group']}</td>
                    <td>{$row['patient_contact']}</td>
                    <td>" . ($row['location'] ?? 'N/A') . "</td>
                    <td>{$row['requirements']}</td>
                    <td>
                        <a href='admin_patients.php?delete_id={$row['id']}' 
                           class='btn btn-danger btn-sm' 
                           onclick='return confirm(\"Are you sure you want to delete this record?\")'>Delete</a>
                    </td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='8' class='text-center'>No records found.</td></tr>";
    }
    ?>
</tbody>

        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php $conn->close(); ?>
