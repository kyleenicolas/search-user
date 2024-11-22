<?php
// Database connection details
$host = 'localhost';
$dbname = 'teacher'; 
$username = 'root'; 
$password = ''; 

try {
    // Establish a connection to the database
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    // Set error reporting mode to exception for better debugging
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Connected to the database successfully!";
} catch (PDOException $e) {
    // Handle connection error gracefully
    die("Could not connect to the database $dbname: " . $e->getMessage());
}
?>
