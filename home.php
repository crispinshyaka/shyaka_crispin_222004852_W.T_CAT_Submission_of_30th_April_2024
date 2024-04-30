<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>gkings Recipes</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <link rel="manifest" href="site.webmanifest"> -->
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="css0/bootstrap.min.css">
    <link rel="stylesheet" href="css0/owl.carousel.min.css">
    <link rel="stylesheet" href="css0/magnific-popup.css">
    <link rel="stylesheet" href="css0/font-awesome.min.css">
    <link rel="stylesheet" href="css0/themify-icons.css">
    <link rel="stylesheet" href="css0/nice-select.css">
    
    <link rel="stylesheet" href="css0/style.css">
    <!-- <link rel="stylesheet" href="css/responsive.css"> -->
    <style type="text/css">
    .header-area {
    width: 100%;
    background: none;
/*    margin-left: 200px; */
}
.main-menu {
/*    flex-grow: 1; */
    background-color: black;
    border-radius: 4px;
    margin-left: 120px;
}
.main-menu ul li ul.submenu li a {
    color: blue; 
    background-color: black; 
    padding: auto;
    border-radius: 4px;
}
.main-menu ul li a:hover,
.main-menu ul li ul.submenu li a:hover {
    background-color: skyblue; 
    color: black; 
}


#navigation {
    width: 100%;
    display: flex;
    list-style: none;
    padding-left: 0; 
    margin-left: auto;
    align-items: center;
    background-color: none;
}

#navigation li {
    margin-right: 20px;
}

#navigation li a {
    color: white;
    text-decoration: none; 
}

#navigation li a:hover {
    text-decoration: none; 
    color: #9df9ef; 
}

.search-container {
    display: flex;
    align-items: center;

}

.search-container form {
    display: flex;
    margin-left:200px;
    margin-bottom: 20px;
    flex-grow: 1;
}

.search-container input[type="text"] {
    padding: 8px;
    border: none;
    border-radius: 4px;
    margin-right: 10px;
}

.search-container button {
    background-color: #0f7c8c;
    color: white;
    border: none;
    border-radius: 4px;
    padding: 8px 10px;
    cursor: pointer;
}

.search-container button:hover {
    background-color: #09575d;
}
.search-container {
    display: flex;
    align-items: center;
}
input[type="text"], button {
    margin-right: 10px; /* Space between the input field and button */
}
sr-results {
    font-family: 'Arial', sans-serif; /* Change to any font you like */
    color: #333; /* Dark grey text color */
    background-color: #f9f9f9; /* Light grey background for results */
    padding: 10px;
    border-radius: 5px;
    margin-top: 10px;
}

.sr-results h2 {
    color: #0056b3; /* Blue for headings */
}

.sr-results p {
    color: #666; /* Lighter grey for paragraph text */
    margin: 5px 0;
}
    </style>
</head>

<body>
    <!-- header-start -->
    <header>
       <div class="header-area ">
            <div id="sticky-header" class="main-header-area ">
                <div class="container">
                    <div class="row align-items-center">
                        
                        <div class="col-xl-6 col-lg-7">
                            <div class="main-menu   d-none d-lg-block">
                                <nav>
                                    <ul id="navigation">
                                        <li><a href="#home">home</a></li>
                                        <li><a href="about.html">about</a></li>
                                        <li><a href="Recipes.html">Recipes</a></li>
                                        <li><a href="ratings.html">explore <i class="ti-angle-down"></i></a>
                                        </li>
                                        <li><a href="contact.html">Contact</a></li>
                                        <li><a href="index.html">logout</a></li>
                                    </ul>
                                    
                                </nav>
                            </div>
                        </div>
                      
                    </div>

                </div>
            </div>
        </div>
    </header>
    <!-- header-end -->

    <!-- slider_area_start -->
    <div class="slider_area">
        <div class="single_slider  d-flex align-items-center slider_bg_1">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-xl-8 ">
                        <div class="slider_text text-center">
                            <div class="text">
                                <h3>gkings recipes</h3>
                              <div class="search-container">
                             <form id="search-form" action="home.php" method="GET">
                           <input type="text" name="query" placeholder="Search recipes..." required>
                            <button type="submit">Search</button>
        
                           <button type="button" id="back-button" style="<?php if (!isset($_GET['query'])) echo 'display: none;'; ?>">Back</button>
                           </form>
                              <?php
                             if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["query"])) {
                             $search_query = $_GET["query"];
                           $conn = new mysqli('localhost', 'shyaka', '222004852', 'shyaka_crispin_rrs');
                          if ($conn->connect_error) {
                          die("Connection failed: " . $conn->connect_error);
                                   }
                             $sql = "SELECT * FROM recipes WHERE 
                              title LIKE '%" . $search_query . "%' OR 
                              ingredient_lst LIKE '%" . $search_query . "%' OR 
                              user_rating LIKE '%" . $search_query . "%' OR 
                              preparation_time LIKE '%" . $search_query . "%'";
                              $result = $conn->query($sql);
                           if ($result->num_rows > 0) {
                            
                         while ($row = $result->fetch_assoc()) {
                    echo "<div>";
                    echo "<h2>" . $row["title"] . "</h2>";
                    echo "<p>Ingredients: " . $row["ingredient_lst"] . "</p>";
                    echo "<p>Ratings: " . $row["user_rating"] . "</p>";
                    echo "<p>Preparation Time: " . $row["preparation_time"] . "</p>";
                    // Add more fields as needed
                    echo "</div>";
                     }
                     } else {
                      echo "No recipes found matching your search query.";
                     }
                      $conn->close();
                     }
                     ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>

    <!-- slider_area_end -->
    <!-- recepie_area_start  -->
    <div class="recepie_area">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="single_recepie text-center">
                        <div class="recepie_thumb">
                            <img src="img/recepie/recpie_1.png" alt="">
                        </div>
                        <h3>Egg Manchurian</h3>
                        <span>Appetizer</span>
                        <p>Time Needs: 30 Mins</p>
                        <a href="recipe1.html" class="line_btn">View Full Recipe</a>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="single_recepie text-center">
                        <div class="recepie_thumb">
                            <img src="img/recepie/recpie_2.png" alt="">
                        </div>
                        <h3>Pure Vegetable Bowl</h3>
                        <span>Appetizer</span>
                        <p>Time Needs: 30 Mins</p>
                        <a href="recipe2.html" class="line_btn">View Recipe</a>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="single_recepie text-center">
                        <div class="recepie_thumb">
                            <img src="img/recepie/recpie_3.png" alt="">
                        </div>
                        <h3>Egg Masala Ramen</h3>
                        <span>Appetizer</span>
                        <p>Time Needs: 30 Mins</p>
                        <a href="recipe3.html" class="line_btn">View Recipe</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /recepie_area_start  -->

    <!-- dish_area start  -->
    <div class="dish_area">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="dish_wrap d-flex">
                        <div class="single_dish text-center">
                            <div class="thumb">
                                <img src="img/recepie/recpie_4.png" alt="">
                            </div>
                            <h3>wedding ceremonies</h3>
                            <p>throught us your wedding may become the most amazing event ever.</p>
                        </div>
                        <div class="single_dish text-center">
                            <div class="thumb">
                                <img src="img/recepie/recpie_5.png" alt="">
                            </div>
                            <h3>Birthday Catering</h3>
                            <p> we are here to make your birthday look special.</p>
                        </div>
                        <div class="single_dish text-center">
                            <div class="thumb">
                                <img src="img/recepie/recpie_6.png" alt="">
                            </div>
                            <h3>home sweet home</h3>
                            <p>worryless about how you can cook for your family gkings got your back.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ dish_area start  -->

    <!-- latest_trand     -->
    <div class="latest_trand_area">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="trand_info text-center">
                        <p>Thousands of recipes are waiting to be watched</p>
                        <h3>Discover latest trending recipes</h3>
                        <a href="allrecipes.html" class="boxed-btn3">View all Recipes</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ latest_trand     -->

    <!-- customer_feedback_area  -->
    <div class="customer_feedback_area">
        <div class="container">
            <div class="row justify-content-center mb-50">
                <div class="col-xl-9">
                    <div class="section_title text-center">
                         <h1>Recipe Ratings</h1>
                          <?php
                        // Connect to your database
                          $conn = new mysqli('localhost', 'shyaka', '222004852', 'shyaka_crispin_rrs');

                        // Check connection
                        if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                        }

                        // Query to fetch ratings
                       $sql = "SELECT firstname, rating, recipe_id FROM ratings";

                        // Execute the query
                       $result = $conn->query($sql);

                        // Check if there are results
                      if ($result->num_rows > 0) {
                        // Output data of each row
                       while ($row = $result->fetch_assoc()) {
                       // Fetch recipe name based on recipe ID
                      $recipe_id = $row["recipe_id"];
                      $title_sql = "SELECT title FROM recipes WHERE recipe_id = $recipe_id";
                      $title_result = $conn->query($title_sql);
                      if ($title_result && $title_result->num_rows > 0) {
                      $recipe_row = $title_result->fetch_assoc();
                      $title = $recipe_row["title"];
                      echo "<p>" . $row["firstname"] . " rated the recipe '" . $title . "' with a rating of " . $row["rating"] . "</p>";
                     } else {
                     echo "<p>" . $row["firstname"] . " rated a recipe with ID " . $row["recipe_id"] . " with a rating of " . $row["rating"] . "</p>";
                     }
                     }
                     } else {
                        echo "No ratings yet.";
                     }

    // Close the database connection
                    $conn->close();
                     ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / customer_feedback_area  -->
    

    

    <!-- footer  -->
    <footer class="footer">
            
            <div class="copy-right_text">
                <div class="container">
                    <div class="footer_border"></div>
                    <div class="row align-items-center">
                        <div class="col-xl-8 col-md-8">
                            <p class="copy_right">
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved </a>
                            </p>
                        </div>
                        <div class="col-xl-4 col-md-4">
                            <div class="socail_links">
                                <ul>
                                    <li>
                                        <a href="#">
                                            <i class="ti-facebook"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="ti-twitter-alt"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-dribbble"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-behance"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    <!--/ footer  -->

    <!-- JS here -->
    <script src="js0/vendor/modernizr-3.5.0.min.js"></script>
    <script src="js0/vendor/jquery-1.12.4.min.js"></script>
    <script src="js0/popper.min.js"></script>
    <script src="js0/bootstrap.min.js"></script>
    <script src="js0/owl.carousel.min.js"></script>
    <script src="js0/isotope.pkgd.min.js"></script>
    <script src="js0/ajax-form.js"></script>
    <script src="js0/waypoints.min.js"></script>
    <script src="js0/jquery.counterup.min.js"></script>
    <script src="js0/imagesloaded.pkgd.min.js"></script>
    <script src="js0/scrollIt.js"></script>
    <script src="js0/jquery.scrollUp.min.js"></script>
    <script src="js0/wow.min.js"></script>
    <script src="js0/nice-select.min.js"></script>
    <script src="js0/jquery.slicknav.min.js"></script>
    <script src="js0/jquery.magnific-popup.min.js"></script>
    <script src="js0/plugins.js"></script>
    <script src="js0/gijgo.min.js"></script>

    <!--contact js-->
    <script src="js0/contact.js"></script>
    <script src="js0/jquery.ajaxchimp.min.js"></script>
    <script src="js0/jquery.form.js"></script>
    <script src="js0/jquery.validate.min.js"></script>
    <script src="js0/mail-script.js"></script>

    <script src="js0/main.js"></script>
    <script type="text/javascript">
       document.getElementById('back-button').addEventListener('click', function() {
    window.history.back(); // This goes back to the last page
});

    </script>
   
</body>

</html>
