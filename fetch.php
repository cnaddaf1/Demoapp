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

// Prepare and bind the parameter
$stmt = $conn->prepare("SELECT name, fname FROM user WHERE id = ?");
$stmt->bind_param("i", $id);

// Set the parameter and execute the statement
$id = $_POST['id'];
$stmt->execute();

// Bind the results
$stmt->bind_result($name, $fname);

// Fetch and display the data
if ($stmt->fetch()) {
    echo "Name: " . $name . "<br>";
    echo "Last Name: " . $fname;
} else {
    echo "No data found for the entered ID";
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
