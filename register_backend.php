<?php

include "dbconfig.php";

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $bio = $_POST['bio'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $timestamp = date("Y-m-d H:i:s");

    $sql = "INSERT INTO users (username, password, email, name, role, created_at) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ssssss", $username, $password, $email, $name, $role, $timestamp);

        if ($stmt->execute()) {
            $user_id = $stmt->insert_id;

            // Now insert additional information using $user_id
            $sql_additional = "INSERT INTO profiles (user_id, address, bio, phone) VALUES (?, ?, ?, ?)";
            $stmt_additional = $conn->prepare($sql_additional);

            if ($stmt_additional) {
                $stmt_additional->bind_param("isss", $user_id, $address, $bio, $phone);

                if ($stmt_additional->execute()) {
                    echo "<script>
                            alert('New record created successfully');
                            window.location.href = 'index.php';
                          </script>";
                } else {
                    echo "Error: " . $sql_additional . "<br>" . $conn->error;
                }

                $stmt_additional->close();
            } else {
                echo "Error preparing additional statement: " . $conn->error;
            }
        } else {
            echo "Error executing user insert: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }

    $conn->close();
}
?>
