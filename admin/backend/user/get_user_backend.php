<?php

include "../../../dbconfig.php";
session_start();

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    if (!isset($_SESSION['user_id'])) {
        throw new Exception('User ID is not set in the session.');
    }

    $user_list = [];

    // Check database connection
    if ($conn->connect_error) {
        throw new Exception('Database connection failed: ' . htmlspecialchars($conn->connect_error));
    }

    // Prepare the SQL statement with placeholders to prevent SQL injection
    $user_stmt = $conn->prepare("SELECT * FROM users WHERE role = 'user' AND is_enable = 1 ");
    if ($user_stmt === false) {
        throw new Exception('Prepare failed for user ' . htmlspecialchars($conn->error));
    }

    // Bind the session variable to the prepared statement
    

    // Execute the statement
    if (!$user_stmt->execute()) {
        throw new Exception('Execute failed for user: ' . htmlspecialchars($user_stmt->error));
    }

    $user_result = $user_stmt->get_result();

    // Fetch all jobpostings into an array
    while ($row = $user_result->fetch_assoc()) {
        $user_list[] = $row;
    }

    // Store jobpostings array in session
    $_SESSION['user_list'] = $user_list;

    // Redirect to the specified page
    header("Location: ../../frontend/user/list_user_frontend.php");
    exit();
} catch (Exception $e) {
    // Handle the exception and display an error message
    echo "Error: " . $e->getMessage();
}

// Close the database connection
$conn->close();
?>
