<?php

include "../../../dbconfig.php";
session_start();

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    $filterjoinedData = [];
    $user_id = $_SESSION['user_id']; 

    // Get filter values from GET parameters
    $job_title_filter = isset($_GET['job_title']) ? $_GET['job_title'] : '';
    $user_name_filter = isset($_GET['name']) ? $_GET['name'] : '';

    // Base SQL query
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

    // Initialize an array to hold query parameters
    $params = [$user_id];
    $types = "i"; // Type for the first parameter (hr_id)

    // Add conditions based on filters
    if ($job_title_filter) {
        $sql_join .= " AND jobpostings.job_title LIKE ?";
        $params[] = '%' . $job_title_filter . '%';
        $types .= "s"; // Add type for job_title
    }

    if ($user_name_filter) {
        $sql_join .= " AND users.name LIKE ?";
        $params[] = '%' . $user_name_filter . '%';
        $types .= "s"; // Add type for user_name
    }

    $stmt_join = $conn->prepare($sql_join);

    if ($stmt_join === false) {
        throw new Exception('Prepare failed for join query: ' . htmlspecialchars($conn->error));
    }

    // Bind parameters dynamically
    $stmt_join->bind_param($types, ...$params);
    $stmt_join->execute();
    $result = $stmt_join->get_result();

    // Fetch all rows into an array
    while ($row = $result->fetch_assoc()) {
        $filterjoinedData[] = $row;
    }

    $stmt_join->close();
    $conn->close();

    // Store joined data in session
    $_SESSION['filterjoinedData'] = $filterjoinedData;

    header("Location: ../../frontend/applications/application_frontend.php");
    exit();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
    $conn->close();
    exit();
}

?>
