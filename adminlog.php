<?php 
require_once 'database.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query to fetch admin details from the database
    $sql = "SELECT * FROM admin WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);

    // Execute the query
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Admin authentication successful, set admin session
        $_SESSION['admin'] = true;
        
        // Redirect to the admin panel or home page
        header("Location: home.html");
        exit();
    } else {
        // Authentication failed, display error message
        echo "Error: Incorrect login credentials.";
    }

    // Close statement and database connection
    $stmt->close();
    $conn->close();
} else {
    // Redirect to the login page if accessed directly
    header("Location: login.php");
    exit();
}
?>
