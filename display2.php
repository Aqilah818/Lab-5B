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

// Fetch users' data
$sql = "SELECT matric, name, role FROM users";
$result = $conn->query($sql);

// Check if there are users in the database
if ($result->num_rows > 0) {
    echo "<table border='1'>
            <tr>
                <th>Matric</th>
                <th>Name</th>
                <th>Access Level</th>
                <th>Actions</th>
            </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . htmlspecialchars($row['matric']) . "</td>
                <td>" . htmlspecialchars($row['name']) . "</td>
                <td>" . htmlspecialchars($row['role']) . "</td>
                <td>
                    <a href='update.php?matric=" . $row['matric'] . "'>Update</a> |
                    <a href='delete.php?matric=" . $row['matric'] . "' onclick='return confirm(\"Are you sure you want to delete?\")'>Delete</a>
                </td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No users found.";
}

// Close connection
$conn->close();
?>