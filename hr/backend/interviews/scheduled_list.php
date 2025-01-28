<?php

include "../../../dbconfig.php";
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    // Prepare the SQL query with joins
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
        WHERE applications.status = 'under review' ";   
    
    // Prepare the statement
    $stmt = $conn->prepare($sql);
    
    if ($stmt === false) {
        throw new Exception('Prepare failed: ' . htmlspecialchars($conn->error));
    }
    
    // Execute the statement
    if (!$stmt->execute()) {
        throw new Exception('Execute failed: ' . htmlspecialchars($stmt->error));
    }
    
    // Get the result set
    $result = $stmt->get_result();
    
    // Fetch the results into an array
    $interviewData = [];
    while ($row = $result->fetch_assoc()) {
        $interviewData[] = $row;
    }


    
    // Store the data in the session
    $_SESSION['interviewData'] = $interviewData;
    
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
