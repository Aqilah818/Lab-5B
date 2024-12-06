<!DOCTYPE html>
<html>
<body>
    <table border="1">
        <tr>
        <td>
    <form action="insert.php" method="post">
        <label for="matric">Matric:</label>
        <input type="text" id="matric" name="matric" required><br>

        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>

        <label for="role">Role:</label>
        <select id="role" name="role" required>
            <option value="">Please select</option>
            <option value="student">Student</option>
            <option value="lecturer">Lecturer</option>
        </select><br><br>

        <button type="submit">Submit</button>
    </form>
    </td>
    </tr>
    </table>
</body>
</html>