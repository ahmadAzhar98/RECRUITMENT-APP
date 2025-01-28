<?php  
    session_start()
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HR Dashboard - Performance Pioneers HR Solutions</title>
    <link rel="stylesheet" href="../../../styles.css">
</head>
<body>
     <header>
        <div class="logo">Performance Pioneers HR Solutions</div>
        <nav>
            <ul>
                <li><a href="../login_dashboard.php">Profile</a></li>
                <li><a href="../../backend/logout_backend.php">Logout</a></li>
                <li><a href="../../backend/posting/backend_get_postings.php">Job Posting</a></li>
             <!--    <li><a href="messages/message_frontend.php">Messages</a></li> -->
                <li><a href="../../backend/offer-letter/offer-letter_backend.php">Offer Letter</a></li>
                <li><a href="../../backend/interviews/scheduled_list.php">Interviews</a></li>
                <li><a href="../../backend/applications/application_backend.php">Screening</a></li>
            </ul>
        </nav>
    </header>

 <main>
        <div class="form-wrapper">
            <h1>Send Offer Letter</h1>
            <form action="../../backend/offer-letter/post_offer-letter.php" method="POST" enctype="multipart/form-data">
                <label for="applicants">Select Applicants:</label>
                <select name="applicants" id="applicants">
                    <?php
                    if (isset($_SESSION['applicants'])) {
                        foreach ($_SESSION['applicants'] as $applicants) {
                            echo "<option value='{$applicants['application_id']}'>{$applicants['name']}</option>";
                        }
                    }
                    ?>
                </select>
               <label for="offer">Upload Offer Letter (PDF only):</label>
               <input type="file" id="offer" name="offer" accept="application/pdf" required><br><br>
  
                <input type="submit" value="Send">
            </form>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 Performance Pioneers HR Solutions. All rights reserved.</p>
    </footer>
</body>
</html>