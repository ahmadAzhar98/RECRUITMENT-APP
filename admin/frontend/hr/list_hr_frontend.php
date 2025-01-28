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
    <section class="job-postings">
    <h2>HR</h2>
    <ul>
        <?php
        if (isset($_SESSION['list_hr']) && is_array($_SESSION['list_hr'])) {
            foreach ($_SESSION['list_hr'] as $hr) {
                echo '<li>';
                echo 'Name: ' . htmlspecialchars($hr['name']) . '<br>';
                echo 'Email: ' . htmlspecialchars($hr['email']) . '<br>';
                echo '<a href="../../backend/hr/disable_hr.php?hr_id='.htmlspecialchars($hr['user_id']).'">Disable</a>'; 
                echo '</li>';
            }
        } else {
            echo '<li>No job postings available.</li>';
        }
        ?>
    </ul>
    <a href="add_hr_frontend.php">Add New HR</a>

    </main>

    <footer>
        <p>&copy; 2024 Performance Pioneers HR Solutions. All rights reserved.</p>
    </footer>
</body>
</html>
