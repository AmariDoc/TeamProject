<?php
  $host = "localhost"; // Update if necessary
  $db = "fitness_tracker"; 
  $user = "postgres"; // PostfreSQL username
  $pass = "1234"; // PostfreSQL password
  $port = "5432"; // Default PostfreSQL port

  try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>
