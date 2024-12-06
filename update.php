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

// Fetch user details from the database
$sql = "SELECT matric, name, role FROM users WHERE matric = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $matric);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $name = $row['name'];
    $role = $row['role'];
} else {
    die("User not found.");
}

// Update user details if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_name = $_POST['name'];
    $new_role = $_POST['role'];

    // SQL to update user data
    $update_sql = "UPDATE users SET name = ?, role = ? WHERE matric = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("sss", $new_name, $new_role, $matric);
    
    if ($update_stmt->execute()) {
        echo "User updated successfully!";
        header("Location: display2.php"); // Redirect to the display page after update
        exit();
    } else {
        echo "Error updating user: " . $conn->error;
    }
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
</head>
<body>
    <h2>Update User Information</h2>
    <form method="POST">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required><br>

        <label for="role">Access Level:</label>
        <select id="role" name="role" required>
            <option value="student" <?php echo ($role == 'student') ? 'selected' : ''; ?>>Student</option>
            <option value="lecturer" <?php echo ($role == 'lecturer') ? 'selected' : ''; ?>>Lecturer</option>
        </select><br>

        <input type="submit" value="Update">
        <a href="display2.php">Cancel</a>
    </form>
</body>
</html>