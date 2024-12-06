<?php
require 'session.php';
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

// Capture form data
$matric = $_POST['matric'];
$name = $_POST['name'];
$password = $_POST['password']; // Get the plain text password
$role = $_POST['role'];

// Hash the password for storage (using PASSWORD_DEFAULT)
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// SQL to insert data
$sql = "INSERT INTO users (matric, name, password, role) VALUES (?, ?, ?, ?)";

// Prepare and bind
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die("Error preparing statement: " . $conn->error);
}

$stmt->bind_param("ssss", $matric, $name, $hashed_password, $role);

// Execute the prepared statement
if ($stmt->execute()) {
    echo "New user registered successfully!";
} else {
    echo "Error: " . $stmt->error;
}

// Close connection
$stmt->close();
$conn->close();
?>