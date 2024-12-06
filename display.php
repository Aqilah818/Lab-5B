<!DOCTYPE html>
<html>
<body>
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

    // Query to fetch data
    $sql = "SELECT matric, name, role AS accessLevel FROM users";
    $result = $conn->query($sql);

    // Check if there are results
    if ($result->num_rows > 0) {
        // Start table
        echo "<table border='1'>";
        echo "<tr><th>Matric</th><th>Name</th><th>Level</th></tr>";

        // Fetch and display rows
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . htmlspecialchars($row['matric']) . "</td>
                    <td>" . htmlspecialchars($row['name']) . "</td>
                    <td>" . htmlspecialchars($row['accessLevel']) . "</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<p style='text-align: center;'>No users found in the database.</p>";
    }

    // Close connection
    $conn->close();
    ?>
</body>
</html>