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
     <!--            <li><a href="../../backend/assign/backend_assign.php">Assign</a></li> -->
                <li><a href="../../backend/user/get_user_backend.php">User</a></li>
                <li><a href="../../backend/user/disable_users.php">Disabled User </a></li>
                <li><a href="../../backend/hr/disable_hrs.php">Disabled HR </a></li>
                <li><a href="../../backend/logout_backend.php">Logout</a></li>
            </ul>
        </nav>
    </header>

 <main>
        <div class="form-wrapper">
            <h1>Select Users</h1>
            <form action="../../backend/assign/assign.php" method="post">
                <label for="hrlist">Select HR:</label>
                <select name="hrlist" id="hrlist">
                    <?php
                    if (isset($_SESSION['hrlist'])) {
                        foreach ($_SESSION['hrlist'] as $hr) {
                            echo "<option value='{$hr['user_id']}'>{$hr['name']}</option>";
                        }
                    }
                    ?>
                </select>
                <label for="userlist">Select User:</label>
                <select name="userlist" id="userlist">
                    <?php
                    if (isset($_SESSION['userlist'])) {
                        foreach ($_SESSION['userlist'] as $user) {
                            echo "<option value='{$user['user_id']}'>{$user['name']}</option>";
                        }
                    }
                    ?>
                </select>
                <input type="submit" value="Assign">
            </form>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 Performance Pioneers HR Solutions. All rights reserved.</p>
    </footer>
</body>
</html>