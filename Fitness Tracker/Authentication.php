<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Invalid request method.");
}

// Start session
session_start();

include './functions/activity_log.php';

// Authentication credentials
$host = "localhost";
$db = "fitness_tracker";
$user = "postgres";
$pass = "1234";
$port = "5432";

// Create connection to PostgreSQL
$conn = pg_connect("host=$host port=$port dbname=$db user=$user password=$pass");

// Check connection
if (!$conn) {
    die("Connection failed: " . pg_last_error());
} else {
    echo "Connection successful."; // For debugging purposes only
}

// Get User Account Information
$username = $_POST['username'];
$password = $_POST['password'];

// SQL Query
$sql = "SELECT * FROM users WHERE username = $1";
$result = pg_query_params($conn, $sql, array($username));

// Check if a user exists
if (pg_num_rows($result) > 0) {
    $user = pg_fetch_assoc($result);

// Use crypt() to verify the password
    if (hash_equals($user['password'], crypt($password, $user['password']))) {
        // Password is correct, create session and redirect
        $_SESSION['username'] = $user['username'];
        logActivity($username, 'login', 'Logged in successfully');
        header("Location: Welcome.php");
    } else {
        // Invalid password
        // logUserActivity($username, 'login', 'Logged failed');
        logActivity($username, 'login', 'Logged in failed');
        echo "Invalid password.";
    }
} else {
    echo "No user found with that username!";
}

// Close connection
pg_close($conn);
?>
