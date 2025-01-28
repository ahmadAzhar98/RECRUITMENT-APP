<?php
   session_start() 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Performance Pioneers HR Solutions</title>
    <link rel="stylesheet" href="../../../styles.css">
</head>
<body>
    <header>
        <div class="logo">Performance Pioneers HR Solutions</div>
        <nav>
            <ul>
                <li><a href="../user_dashboard.php">Home</a></li>
                <li><a href="../../backend/applications/backend_applied.php">Applied</a></li>
                <li><a href="../../backend/offer-letter/backend_offer_letter.php"> Offer Letter </a></li>
            <!--     <li><a href="../messages/message_frontend.php"> Messages </aN></li> -->
                <li><a href="../../backend/logout_backend.php">Logout</a></li>
                <li><a href="../profile/frontend_profile.php"> Profile </a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="contact-us" id="contact"  >
            <h2>Application</h2>
            <form action="../../backend/applications/backend_application.php" method="POST" enctype="multipart/form-data" >
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value=" <?php echo $_SESSION['name']; ?> " >

                <label for="email">Email:</label>
                <input type="text" id="email" name="email" value=" <?php echo $_SESSION['email']; ?> " >


                <label for="bio">Bio:</label>
                <input type="text" id="bio" name="bio" value=" <?php echo $_SESSION['bio']; ?> " >

               <label for="phone">Phone</label>
               <input type="text" id="phone" name="phone" value=" <?php echo $_SESSION['phone']; ?> ">

               <input type="hidden" name="user_id" value=" <?php echo $_GET['user_id']; ?> ">
               <input type="hidden" name="job_id"  value=" <?php  echo $_GET['job_id']; ?> ">

               <label for="cv">Upload CV (PDF only):</label>
               <input type="file" id="cv" name="resume" accept="application/pdf" required><br><br>

                <button type="submit">Submit</button>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Performance Pioneers HR Solutions. All rights reserved.</p>
    </footer>
</body>
</html>
