<?php

include "../../../dbconfig.php";

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
    $job_id = $_POST['job_id'];
    $status = "under review";
    $applied = date("Y-m-d H:i:s");
    $file = $_FILES['resume'];


    // Check if the file was uploaded without errors
    if (isset($file) && $file['error'] == 0) {
        $uploadDirectory = 'uploads/';
        
        // Create upload directory if it doesn't exist
        if (!is_dir($uploadDirectory)) {
            if (!mkdir($uploadDirectory, 0755, true)) {
                die("Error: Failed to create upload directory.");
            }
        }
        
        // Check if file is a PDF
        $fileType = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if ($fileType != 'pdf') {
            die("Error: Only PDF files are allowed.");
        }

        // Set a unique name for the file before saving it
        $uniqueFileName = uniqid() . '_' . basename($file['name']);
        $filePath = $uploadDirectory . $uniqueFileName;

        // Move uploaded file to the server directory
        if (move_uploaded_file($file['tmp_name'], $filePath)) {
            // Save application information in the database
            $sql = "INSERT INTO applications (job_id, user_id, status, cv, applied_at) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);

            if ($stmt) {
                $stmt->bind_param("iisss", $job_id, $user_id, $status, $filePath, $applied);

                if ($stmt->execute()) {
                    echo "<script>
                            alert('Application submitted successfully');
                            window.location.href = '../../frontend/user_dashboard.php';
                          </script>";
                } else {
                    echo "Error executing insert: " . $stmt->error;
                }

                $stmt->close();
            } else {
                echo "Error preparing statement: " . $conn->error;
            }
        } else {
            echo "Error: There was an error uploading your file.";
        }
    } else {
        echo "Error: No file uploaded or there was an upload error.";
    }

    $conn->close();
}
?>
