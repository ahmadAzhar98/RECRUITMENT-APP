<?php

include "../../../dbconfig.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start(); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $file = $_FILES['offer'];
    $app_id = $_POST['applicants'];



    

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['offer']) && $_FILES['offer']['error'] == UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['offer']['tmp_name'];
    $fileName = $_FILES['offer']['name'];
    $fileSize = $_FILES['offer']['size'];
    $fileType = $_FILES['offer']['type'];


    $destPath = $uploadDir . $fileName;

    if (move_uploaded_file($fileTmpPath, $destPath)) {
        

        $stmt = $conn->prepare("UPDATE applications SET offer_letter = ?, offer_letter_status = '2' WHERE application_id = ?");
        $stmt->bind_param("si", $fileName, $app_id);

        if ($stmt->execute()) {
                 echo "<script>alert('Offer letter successfully sent'); window.location.href='../../frontend/login_dashboard.php';</script>";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "There was an error moving the uploaded file.";
    }

    $conn->close();
} else {
    echo "No file uploaded or there was an upload error.";
}

}
    


?>