<?php
  
  include "../../../dbconfig.php";

  $sql = "SELECT users.name, users.email, profiles.bio, profiles.phone, profiles.address 
        FROM users 
        JOIN profiles ON users.id = profiles.user_id";

$result = $conn->query($sql);

// Initialize an array to store the fetched data
$data = [];

if ($result->num_rows > 0) {
    // Fetching the data and storing it in an array
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Closing the database connection
$conn->close();

include '../../frontend/profile/frontend_profile.php';



?>