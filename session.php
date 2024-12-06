<?php
session_start(); // Start session

// Check if user is logged in
if (!isset($_SESSION['matric'])) {
    // Redirect to login page if session is not set
    header("Location: login.php");
    exit();
}
?>