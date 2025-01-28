<?php

include "../../../dbconfig.php";
session_start();

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        // Fetch form data
        $schedule_date = $_POST['schedule'];
        $schedule_time = $_POST['schedule_time'];
        $job_id = $_POST['application'];
        $created_at = date('Y-m-d H:i:s'); // Correct date format
        $status = "scheduled";

        // Prepare the SQL insert statement
        $sql = "INSERT INTO interviews (application_id, interview_date, interview_time, status, created_at) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            throw new Exception('Prepare failed: ' . htmlspecialchars($conn->error));
        }

        // Bind the parameters to the statement
        $stmt->bind_param("issss", $job_id, $schedule_date, $schedule_time, $status, $created_at);

        // Execute the statement
        if (!$stmt->execute()) {
            throw new Exception('Execute failed: ' . htmlspecialchars($stmt->error));
        }

            $application_id = $conn->insert_id;
            $query_users = "UPDATE applications SET status = ? WHERE application_id = ?";
            $stmt_users = $conn->prepare($query_users);
            $status = 'shortlisted';
            $stmt_users->bind_param('si', $status, $job_id);


        // Redirect to a success page or display a success message
        echo "<script>
                alert('Interview scheduled successfully');
                window.location.href = '../../frontend/interviews/interview_frontend.php';
              </script>";

        // Close the statement
        $stmt_users->close();     
        $stmt->close();

    } catch (Exception $e) {
        // Handle the exception and display an error message
        echo "Error: " . $e->getMessage();
    }

    // Close the database connection
    $conn->close();
}

?>
