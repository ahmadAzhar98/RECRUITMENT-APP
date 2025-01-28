<?php

include "../../../dbconfig.php";
session_start();

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_GET['usr_id'])) {
    $userId = intval($_GET['usr_id']);
    
    // Prepare the SQL query
    $query_users = "UPDATE users SET is_enable = ? WHERE user_id = ?";
    $stmt_users = $conn->prepare($query_users);
    
    // Check if the preparation was successful
    if ($stmt_users === false) {
        echo "Error preparing statement: " . $conn->error;
        exit();
    }
    
    // Bind parameters
    $isEnable = 0;
    $stmt_users->bind_param('ii', $isEnable, $userId);
    
    // Execute the statement
    if ($stmt_users->execute()) {
        echo "<script>alert('User successfully updated'); window.location.href='disable_users.php';</script>";
    } else {
        echo "Error updating profile: " . $stmt_users->error;
    }
    
    // Close the statement and connection
    $stmt_users->close();
    $conn->close();
} else {
    echo "Invalid request: User ID not provided.";
}
?>

