<?php

include "../../../dbconfig.php";
session_start();

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    $joinedData = [];
    $user_id = $_SESSION['user_id']; 

    $sql_join = "
        SELECT 
            users.name AS user_name,
            users.user_id, 
            jobpostings.job_title,
            applications.application_id,
            applications.cv, 
            applications.applied_at
        FROM 
            applications
        JOIN 
            jobpostings ON applications.job_id = jobpostings.job_id
        JOIN 
            users ON applications.user_id = users.user_id
        WHERE 
            jobpostings.hr_id = ? AND applications.status = 'under review'
    ";

    $stmt_join = $conn->prepare($sql_join);

    if ($stmt_join === false) {
        throw new Exception('Prepare failed for join query: ' . htmlspecialchars($conn->error));
    }

    $stmt_join->bind_param("i", $_SESSION['user_id']);
    $stmt_join->execute();
    $result = $stmt_join->get_result();

    // Fetch all rows into an array
    while ($row = $result->fetch_assoc()) {
        $joinedData[] = $row;
    }

    $stmt_join->close();
    $conn->close();

    // Store joined data in session
    $_SESSION['joinedData'] = $joinedData;

    // print_r($_SESSION['joinedData']);
    // die();

    
    header("Location: ../../frontend/applications/application_frontend.php");
    exit();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
    $conn->close();
    exit();
}


?>
