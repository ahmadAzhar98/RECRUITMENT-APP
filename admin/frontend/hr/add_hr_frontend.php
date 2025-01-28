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
                <li><a href="../admin_dashboard.php">Home</a></li>
                <li><a href="../../backend/hr/get_hr_backend.php"> HR </a></li>
        <!--         <li><a href="../../backend/assign/backend_assign.php">Assign</a></li> -->
                <li><a href="../../backend/user/get_user_backend.php">User</a></li>
                <li><a href="../../backend/user/disable_users.php">Disabled User </a></li>
                <li><a href="../../backend/hr/disable_hrs.php">Disabled HR </a></li>
                <li><a href="../../backend/logout_backend.php">Logout</a></li>

            </ul>
        </nav>
    </header>

    <main>
        <section class="contact-us" id="contact">
            <h2>Register HR</h2>
            <form action="../../../register_backend.php" method="POST">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>

                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>

                <input type="hidden" name="role" value="Hr"> 

               <label for="">Email:</label>
               <input type="text" id="email" name="email" required>

                <label for="bio">Bio</label>
               <input type="text" id="bio" name="bio" required>

                <label for="address">Address</label>
                <input type="text" id="address" name="address" required>

                <label for="phone">Phone</label>
                <input type="text" id="phone" name="phone" required>



                <button type="submit">Register</button>
            </form>
        </section>  
    </main>

    <footer>
        <p>&copy; 2024 Performance Pioneers HR Solutions. All rights reserved.</p>
    </footer>
</body>
</html>