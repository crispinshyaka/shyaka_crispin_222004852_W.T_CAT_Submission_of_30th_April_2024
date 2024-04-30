<?php

include database.php


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the ingredients submitted by the user
    $title = $_POST['title'];

    // Query to find recipes containing similar ingredients
    $sql = "SELECT title, ingredient_lst, instructions,user_rating FROM recipes WHERE title LIKE '%$title%'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Display matching recipes
        echo "<h2>Matching Recipes:</h2>";
        while ($row = $result->fetch_assoc()) {
            echo "<div class='recipe'>";
            echo "<h3>" . $row["title"] . "</h3>";
            echo "<p><strong>Ingredients:</strong> " . $row["ingredient_lst"] . "</p>";
            echo "<p><strong>Instructions:</strong> " . $row["instructions"] . "</p>";
            echo "<p><strong>ratings:</strong>". $row["user_rating"]."</p>";
            echo "</div>";
        }
    } else {
        echo "No matching recipes found.";
    }
}

$conn->close();
?>