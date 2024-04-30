<?php
require_once 'database.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $user_password = $_POST["password"];
    
    
    // Insert user into the database
    $sql = "INSERT INTO users (first_name, last_name, email, password) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $first_name, $last_name, $email, $user_password);

    // Execute the prepared statement
    if ($stmt->execute()) {
        // Registration successful, redirect to homepage
        header("Location: home.php");
        exit();
    } else {
        // Registration failed, handle error
        echo "Error: " . $conn->error;
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>


















 