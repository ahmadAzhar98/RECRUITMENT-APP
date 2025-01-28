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

    $list_hr = [];

    // Check database connection
    if ($conn->connect_error) {
        throw new Exception('Database connection failed: ' . htmlspecialchars($conn->connect_error));
    }

    // Prepare the SQL statement with placeholders to prevent SQL injection
    $hr_stmt = $conn->prepare("SELECT * FROM users WHERE role = 'hr' AND is_enable = 1 ");
    if ($hr_stmt === false) {
        throw new Exception('Prepare failed for hr: ' . htmlspecialchars($conn->error));
    }

    // Bind the session variable to the prepared statement
    

    // Execute the statement
    if (!$hr_stmt->execute()) {
        throw new Exception('Execute failed for hr: ' . htmlspecialchars($hr_stmt->error));
    }

    $hr_result = $hr_stmt->get_result();

    // Fetch all jobpostings into an array
    while ($row = $hr_result->fetch_assoc()) {
        $list_hr[] = $row;
    }

    // Store jobpostings array in session
    $_SESSION['list_hr'] = $list_hr;

    // Redirect to the specified page
    header("Location: ../../frontend/hr/list_hr_frontend.php");
    exit();
} catch (Exception $e) {
    // Handle the exception and display an error message
    echo "Error: " . $e->getMessage();
}

// Close the database connection
$conn->close();
?>
