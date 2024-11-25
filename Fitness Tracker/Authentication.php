<?php

// Start session
session_start();

// Authentication credentials
$host = "localhost";
$db = "fitness_tracker";
$user = "postgres";
$pass = "1234";
$port = "5432";

// Create connection to PostgreSQL
$conn = pg_connect("host=$host port=$port dbname=$db user=$user password=$pass");

// Validate the connection
if (!$conn) {
    die("Connection failed: " . pg_last_error());
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
    if (hash_equals($user['password'], crypt($password, $user['password']))) {
        // Store user info in the session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        echo "Login successful! Welcome, " . $_SESSION['username'];
    } else {
        echo "Invalid password.";
    }
} else {
    echo "No user found with that username.";
}

?>
