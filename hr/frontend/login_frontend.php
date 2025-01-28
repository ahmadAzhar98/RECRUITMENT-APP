<?php  
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Performance Pioneers HR Solutions</title>
    <link rel="stylesheet" href="../../styles.css">
</head>
<body>
    <header>
        <div class="logo">Performance Pioneers HR Solutions</div>
        <nav>
            <ul>
                <li><a href="../../index.php">Home</a></li>
                <li><a href="#about">About Us</a></li>
                <li><a href="#contact">Contact Us</a></li>
                <li><a href="">Login</a></li>
                <li><a href="../../register_frontend.php">Register</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="login-form">
            <h2> Login</h2>
            <form action="../backend/login_backend.php" method="POST">
                <label for="hr-username">Username:</label>
                <input type="text" id="hr-username" name="username" required>

                <label for="hr-password">Password:</label>
                <input type="password" id="hr-password" name="password" required>

                <button type="submit">Login</button>
            </form>
        </section>    
    </main>
        <div class="container">
        <?php
        if (isset($_GET['login']) && $_GET['login'] === 'failed') {
            echo '<div class="alert">';
            echo '<span class="alert-close" onclick="this.parentElement.style.display=\'none\';">&times;</span>';
            echo 'Login unsuccessful. Please check your credentials or check with admin';
            echo '</div>';
        }
        ?>

    <footer>
        <p>&copy; 2024 Performance Pioneers HR Solutions. All rights reserved.</p>
    </footer>
</body>
</html>
