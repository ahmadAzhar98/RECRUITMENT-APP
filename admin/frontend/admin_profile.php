<?php  
    session_start()
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HR Dashboard - Performance Pioneers HR Solutions</title>
    <link rel="stylesheet" href="../../styles.css">
</head>
<body>
    <header>
        <div class="logo">Performance Pioneers HR Solutions</div>
        <nav>
            <ul>
                <li><a href="admin_dashboard.php">Home</a></li>
                <li><a href="../backend/hr/get_hr_backend.php"> HR </a></li>
                <li><a href="../backend/assign/backend_assign.php">Assign</a></li>
                <li><a href="../backend/user/get_user_backend.php">User</a></li>
               <li><a href="../backend/logout_backend.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main>
       <?php 
        $username = $_SESSION['name'];
        $name = $_SESSION['name'];
        $email = $_SESSION['email'];
        ?>
        <h1>Welcome, <?php echo htmlspecialchars($username); ?></h1>

         <section class="contact-us" id="contact">
            <h2> Profile </h2>
            <form action="../backend/update_profile.php" method="POST">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value=" <?php echo $_SESSION['name']; ?> " >

                <label for="email">Email:</label>
                <input type="text" id="email" name="email" value=" <?php echo $_SESSION['email']; ?> " >


                <label for="bio">Bio:</label>
                <input type="text" id="bio" name="bio" value=" <?php echo $_SESSION['bio']; ?> " >

               <label for="phone">Phone</label>
               <input type="text" id="phone" name="phone" value=" <?php echo $_SESSION['phone']; ?> ">

                <label for="address">Address:</label>
                <input type="text" id="address" name="address" value=" <?php echo $_SESSION['address']; ?> " >


                <button type="submit">Update</button>
            </form>
        </section>

    
        
    </main>

    <footer>
        <p>&copy; 2024 Performance Pioneers HR Solutions. All rights reserved.</p>
    </footer>
</body>
</html>