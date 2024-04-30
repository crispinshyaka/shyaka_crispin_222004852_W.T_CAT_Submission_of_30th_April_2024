<?php
require_once 'database.php';
session_start();

$fname = $_POST['first_name'];
$user_password = $_POST['password'];

$sql = "SELECT * FROM users WHERE first_name = ? AND password = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $_POST['first_name'], $_POST['password']);

$stmt->execute();
$result = $stmt->get_result();


if ($result->num_rows > 0) {
   header("Location: home.php");
   exit();
} else {
    echo "Error: Incorrect login credentials.";
}
$stmt->close();
$conn->close();
?>