<?php

function logActivity($userId, $activityType, $activityDesription) {

    // Create a db connection
$host = "localhost"; // Update if necessary
$db = "fitness_tracker"; 
$user = "postgres"; // PostfreSQL username
$pass = "1234"; // PostfreSQL password
$port = "5432"; // Default PostfreSQL port


$conn = pg_connect("host=$host port=$port dbname=$db user=$user password=$pass");
// Validate the connection works
if(!$conn){
    die("connection failed:" . pg_last_error());
}

// Capture IP Addresses
$ipAddress = $_SERVER['REMOTE_ADDR'];
$userAgent = $_SERVER['HTTP_USER_AGENT'];

// Add tracking information to the database
$sql = "insert into user_activity_logging(user_id,activity_type,activity_description,ip_address,user_agent) VALUES ($1, $2, $3, $4, $5)";

// Execute the SQL for the INSERT into the table
$result = pg_query_params($conn, $sql, array($userId, $activityType, $activityDesription, $ipAddress, $userAgent));

if (!$result) {
    echo "Error in query execution: " . pg_last_error($conn);
} else {
    echo "Activity logged successfully";
}

// Close the connection to the database
pg_close($conn);
}

?>
