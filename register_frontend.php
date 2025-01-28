<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Performance Pioneers HR Solutions</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div class="logo">Performance Pioneers HR Solutions</div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="#about">About Us</a></li>
                <li><a href="#contact">Contact Us</a></li>
                <li><a href="hr/frontend/login_frontend.php">Login</a></li>
                <li><a href="">Register</a></li>
            </ul>
            </ul>
        </nav>
    </header>

    <main>
        <section class="contact-us" id="contact">
            <h2>Register</h2>
            <form action="register_backend.php" method="POST">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>

                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>

                <input type="hidden" name="role" value="User"> 

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
