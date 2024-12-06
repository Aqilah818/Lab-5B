<?php
require 'session.php';

// Check if user is logged in
if (!isset($_SESSION['matric'])) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit();
}

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lab_5b";

// Establish connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the matric number from query string
$matric = $_GET['matric'];

// SQL to delete user
$delete_sql = "DELETE FROM users WHERE matric = ?";
$stmt = $conn->prepare($delete_sql);
$stmt->bind_param("s", $matric);

if ($stmt->execute()) {
    echo "User deleted successfully!";
    header("Location: display2.php"); // Redirect to the display page after deletion
    exit();
} else {
    echo "Error deleting user: " . $conn->error;
}

// Close connection
$conn->close();
?>