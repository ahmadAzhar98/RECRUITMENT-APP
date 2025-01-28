<?php

include "../../../dbconfig.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();  // Ensure the session is started

$sql = "
    SELECT users.name, applications.application_id
    FROM users
    JOIN applications ON users.user_id = applications.user_id
    WHERE applications.status = 'accepted' AND applications.offer_letter_status = 1";

$result = $conn->query($sql);

$applicants = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $applicants[] = $row;
    }
} else {
    echo "0 results";
}

$_SESSION['applicants'] = $applicants;



$conn->close();

header("Location: ../../frontend/offer-letter/frontend_offer-letter.php");
exit();

?>
