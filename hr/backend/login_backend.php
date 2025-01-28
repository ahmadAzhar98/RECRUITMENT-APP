<?php
session_start();

include "../../dbconfig.php";

// Enable error reporting for better debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$total_open_positions = 0;
$total_applications = 0;
$total_hires = 0;
$time_to_fill = 0;

try {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Use prepared statements to avoid SQL injection
        $stmt = $conn->prepare("
            SELECT users.user_id, users.name, users.email, users.role, profiles.bio, profiles.phone, profiles.address 
            FROM users 
            JOIN profiles ON users.user_id = profiles.user_id 
            WHERE users.username = ? AND users.password = ? AND users.is_enable = 1
        ");
        if ($stmt === false) {
            throw new Exception('Prepare failed: ' . htmlspecialchars($conn->error));
        }

        $stmt->bind_param("ss", $username, $password);

        // Execute the statement
        $stmt->execute();

        // Bind result variables
        $stmt->bind_result($user_id, $name, $email, $role, $bio, $phone, $address);

        // Fetch the result
        $stmt->fetch();

        // Store user data in session variables
        $_SESSION['user_id'] = $user_id;
        $_SESSION['name'] = $name;
        $_SESSION['email'] = $email;
        $_SESSION['role'] = $role;
        $_SESSION['bio'] = $bio;
        $_SESSION['phone'] = $phone;
        $_SESSION['address'] = $address;

        // Close statement
        $stmt->close();

        // Prepare and execute jobposting query
        $jobpostings = [];
        $jobstmt = $conn->prepare("SELECT * FROM jobpostings WHERE soft_delete = 0");
        if ($jobstmt === false) {
            throw new Exception('Prepare failed for jobpostings: ' . htmlspecialchars($conn->error));
        }

        $jobstmt->execute();
        $jobresult = $jobstmt->get_result();

        // Fetch all jobpostings into an array
        while ($row = $jobresult->fetch_assoc()) {
            $jobpostings[] = $row;
        }

        // Store jobpostings array in session
        $_SESSION['jobpostings'] = $jobpostings;

        switch ($role) {
            case 'user':
                 $assignments = [];
                 $assignStmt = $conn->prepare("SELECT * FROM assign WHERE user_id = '$user_id' ");
             if ($assignStmt === false) {
                  throw new Exception('Prepare failed for assignments: ' . htmlspecialchars($conn->error));
                 }

                 $assignStmt->execute();
                 $assignResult = $assignStmt->get_result();

                while ($row = $assignResult->fetch_assoc()) {
                      $assignments[] = $row;
                    }

                 $_SESSION['sender_id'] = $assignments[0]['user_id'];
                 $_SESSION['receiver_id'] = $assignments[0]['hr_id'];

                header("Location: ../../user/frontend/user_dashboard.php");
                exit();

            case 'hr':
                 $assignments = [];
                 $assignStmt = $conn->prepare("SELECT * FROM assign WHERE hr_id = '$user_id' ");
                 if ($assignStmt === false) {
                  throw new Exception('Prepare failed for assignments: ' . htmlspecialchars($conn->error));
                  }

                 $assignStmt->execute();
                 $assignResult = $assignStmt->get_result();

                while ($row = $assignResult->fetch_assoc()) {
                      $assignments[] = $row;
                    }

                 $_SESSION['sender_id'] = $assignments[0]['hr_id'];
                 $_SESSION['receiver_id'] = $assignments[0]['user_id'];



                header("Location: ../frontend/login_dashboard.php");
                exit();

            case 'admin':

                   $sql_open_positions = "SELECT COUNT(*) AS total_open_positions FROM jobpostings WHERE soft_delete = '0'";
                   $result_open_positions = $conn->query($sql_open_positions);
                   if ($result_open_positions) {
                         $row = $result_open_positions->fetch_assoc();
                         $total_open_positions = $row['total_open_positions'];
                       }


                    $sql_hires = "SELECT COUNT(*) AS total_hires FROM applications WHERE status = 'accepted'";
                    $result_hires = $conn->query($sql_hires);
                   if ($result_hires) {
                       $row = $result_hires->fetch_assoc();
                       $total_hires = $row['total_hires'];
                      }

                    $sql_rejected = "SELECT COUNT(*) AS total_reject FROM applications WHERE status = 'rejected'";
                    $result_rejected = $conn->query($sql_rejected);
                   if ($result_rejected) {
                       $row = $result_rejected->fetch_assoc();
                       $total_reject = $row['total_reject'];
                      }  


                    $sql_review = "SELECT COUNT(*) AS total_review FROM applications WHERE status = 'under review'";
                    $result_review = $conn->query($sql_review);
                   if ($result_review) {
                       $row = $result_review->fetch_assoc();
                       $total_review = $row['total_review'];
                      }


                        $sql_applications_per_month = "
                        SELECT 
                        DATE_FORMAT(applied_at, '%Y-%m') AS month, 
                        COUNT(*) AS applications_count 
                        FROM 
                        applications 
                        GROUP BY 
                        month 
                        ORDER BY 
                        month DESC 
                       LIMIT 6";
                       $result_applications_per_month = $conn->query($sql_applications_per_month);
                       $applications_per_month = [];
                      if ($result_applications_per_month) {
                           while ($row = $result_applications_per_month->fetch_assoc()) {
                           $applications_per_month[] = $row;
                           }
                         }
        


  
                $_SESSION['total_open_positions'] = $total_open_positions;
                $_SESSION['total_hires'] =  $total_hires;
                $_SESSION['total_reject'] = $total_reject;
                $_SESSION['total_review'] =  $total_review;
                $_SESSION['applications_per_month'] = $applications_per_month;


                header("Location: ../../admin/frontend/admin_dashboard.php");
                exit();

            default:
                header("Location: ../frontend/login_frontend.php?login=failed");
                exit();
        }
    } else {
        $showError = true;
        header("Location: ../frontend/login_frontend.php?login=failed");
        exit();
    }
} catch (Exception $e) {
    // Log the error or display it
    echo 'Error: ' . $e->getMessage();
}

// Close connection
$conn->close();
?>
