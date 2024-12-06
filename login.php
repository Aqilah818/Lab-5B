<?php
session_start(); // Start session

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Database connection details
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "lab_5b";

    // Get form data
    $matric = $_POST['matric'];
    $password = $_POST['password'];

    // Establish connection
    $conn = new mysqli($servername, $username, "", $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL query to fetch user data
    $sql = "SELECT matric, name, password, role FROM users WHERE matric = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $matric);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verify password
        if (password_verify($password, $row['password'])) {
            // Successful login
            $_SESSION['matric'] = $row['matric'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['role'] = $row['role'];
    
            // Redirect to the display page
            header("Location: display.php");
            exit();
        }
    }
    
    // If no match for either matric number or password
    $error = "Invalid username or password, try login again.";

    // Close connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<body>
    <div class="form-container">
        <table border="1">
            <tr>
            <td>
            <h3>Login</h3>
        <?php
        // Display error message if any
        if (isset($error)) {
            echo "<p class='error'>" . htmlspecialchars($error) . "</p>";
        }
        ?>
        <form method="POST" action="">
            <label for="matric">Matric Number:</label>
            <input type="text" id="matric" name="matric" value="<?php echo isset($_POST['matric']) ? htmlspecialchars($_POST['matric']) : ''; ?>" required>
            <br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <br>
            <input type="submit" value="Login">
        </form>

        <!-- Link to Registration Page -->
        <a href="question3.php">Register</a>
        <a>here if you have not.</a>
        </td>
            </tr>
        </table>
    </div>
</body>
</html>
