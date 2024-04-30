<?php 
$servername = "localhost";
$username = "shyaka";
$password = "222004852";
$dbname = "shyaka_crispin_rrs";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " .$conn->connect_error);
}

 ?>