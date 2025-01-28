<?php


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hr_recruitment";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$uploadDir = '/Applications/XAMPP/xamppfiles/htdocs/recruitment-app/hr/offer-letters/';

?>