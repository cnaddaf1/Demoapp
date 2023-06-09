<?php
$servername = $_ENV['DB_HOST'];
$username = $_ENV['DB_USER'];
$password = $_ENV['DB_PASSWORD'];
$dbname = $_ENV['DB_NAME'];

// Create a new connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind the parameters
$stmt = $conn->prepare("INSERT INTO user (name, fname) VALUES (?, ?)");
$stmt->bind_param("ss", $name, $fname);

// Set the parameters and execute the statement
$name = $_POST['name'];
$fname = $_POST['fname'];
$stmt->execute();

echo "Data inserted successfully";

// Close the statement and connection
$stmt->close();
$conn->close();
?>
