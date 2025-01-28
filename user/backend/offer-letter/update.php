<?php

include "../../../dbconfig.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start(); 


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



if ($_SERVER['REQUEST_METHOD'] == 'GET' ) {

    $status_id = $_GET['status_id'];
    $app_id = $_GET['app_id'];


    $stmt = $conn->prepare("UPDATE applications SET  offer_letter_status = ? WHERE application_id = ?");
    $stmt->bind_param("ii", $status_id, $app_id);

    if ($stmt->execute()) {


        if($status_id == 3){
                    echo "<script>alert('You have accepted the offer '); window.location.href='../../frontend/user_dashboard.php';</script>";}
        else if($status_id == 4){
                    echo "<script>alert('You have rejected the offer '); window.location.href='../../frontend/user_dashboard.php';</script>";
            }            


    } else {
            echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
   
}
    


?>