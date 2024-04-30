<?php
require_once 'database.php'; // Include the file with database connection setup
session_start();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are provided
    if (isset($_POST["recipe_id"]) && isset($_POST["firstname"]) && isset($_POST["rating"]) && isset($_POST["revew"])) {
        // Retrieve form data
        $recipe_id = $_POST["recipe_id"];
        $username = $_POST["firstname"];
        $rating = $_POST["rating"];
        $review = $_POST["revew"];
        
        // Perform database insertion
        $sql = "INSERT INTO ratings (recipe_id, firstname, rating, revew) VALUES ('$recipe_id', '$username', '$rating', '$review')";
        if ($conn->query($sql) === TRUE) {
            echo "Rating submitted successfully";
            header("Location: home.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "All fields are required";
    }
}
?>
