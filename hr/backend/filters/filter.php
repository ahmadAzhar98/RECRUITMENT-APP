<?php

include "../../../dbconfig.php";
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    // Get filter values from GET parameters
    $name_filter = isset($_GET['name']) ? $_GET['name'] : '';
    $job_title_filter = isset($_GET['job_title']) ? $_GET['job_title'] : '';
    $interview_date_filter = isset($_GET['interview_date']) ? $_GET['interview_date'] : '';
    $interview_time_filter = isset($_GET['interview_time']) ? $_GET['interview_time'] : '';

    // Base SQL query
    $sql = "
        SELECT 
            users.name, 
            jobpostings.job_title, 
            interviews.interview_date, 
            interviews.interview_time,
            applications.application_id
        FROM 
            users
        JOIN 
            applications ON users.user_id = applications.user_id
        JOIN 
            interviews ON applications.application_id = interviews.application_id
        JOIN 
            jobpostings ON applications.job_id = jobpostings.job_id
        WHERE 
            applications.status = 'under review'
    ";

    // Initialize an array to hold query parameters
    $params = [];
    $types = "";

    // Add conditions based on filters
    if ($name_filter) {
        $sql .= " AND users.name LIKE ?";
        $params[] = '%' . $name_filter . '%';
        $types .= "s"; // Add type for name
    }

    if ($job_title_filter) {
        $sql .= " AND jobpostings.job_title LIKE ?";
        $params[] = '%' . $job_title_filter . '%';
        $types .= "s"; // Add type for job title
    }

    if ($interview_date_filter) {
        $sql .= " AND interviews.interview_date = ?";
        $params[] = $interview_date_filter;
        $types .= "s"; // Add type for interview date
    }

    if ($interview_time_filter) {
        $sql .= " AND interviews.interview_time = ?";
        $params[] = $interview_time_filter;
        $types .= "s"; // Add type for interview time
    }

    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        throw new Exception('Prepare failed: ' . htmlspecialchars($conn->error));
    }

    // Bind parameters dynamically
    if (!empty($params)) {
        $stmt->bind_param($types, ...$params);
    }

    // Execute the statement
    if (!$stmt->execute()) {
        throw new Exception('Execute failed: ' . htmlspecialchars($stmt->error));
    }

    // Get the result set
    $result = $stmt->get_result();


    $filterinterviewData = [];
    while ($row = $result->fetch_assoc()) {
        $filterinterviewData[] = $row;
    }

    // Store the data in the session
    $_SESSION['filterinterviewData'] = $filterinterviewData;

    // Close the statement and connection
    $stmt->close();
    $conn->close();

    // Redirect to the frontend page
    header("Location: ../../frontend/interviews/interview_frontend.php");
    exit();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
    exit();
}

?>
