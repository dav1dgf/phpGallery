<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/register.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.14.1/jquery-ui.min.js" integrity="sha512-MSOo1aY+3pXCOCdGAYoBZ6YGI0aragoQsg1mKKBHXCYPIWxamwOE7Drh+N5CPgGI5SA9IEKJiPjdfqWFWmZtRA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="assets/js/main.js"></script>
    <title>Register</title>
    <link rel="icon" href="data:;base64,iVBORw0KGgo=">
</head>
<body>
    <?php include_once('includes/header.php'); ?>
    <div class="register-container">
        <h2 class="register-title">Register</h2>

        <form action="register" method="POST" class="register-form">
            <label for="email" class="register-label">Email:</label>
            <input type="email" name="email" id="email" class="register-input" required><br>

            <label for="username" class="register-label">Username:</label>
            <input type="text" name="username" id="username" class="register-input" required><br>

            <label for="password" class="register-label">Password:</label>
            <input type="password" name="password" id="password" class="register-input" required><br>

            <label for="confirm_password" class="register-label">Confirm Password:</label>
            <input type="password" name="confirm_password" id="confirm_password" class="register-input" required><br><br>

            <input type="submit" value="Register" class="register-btn">
        </form>
        <p class="message"><?php echo htmlspecialchars($message); ?></p>
    </div>

    <?php include_once('includes/footer.php'); ?>

    <?php if (!empty($message)): ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                showDialog(`<?php echo addslashes($message); ?>`, 'Server Response');
            });
        </script>
    <?php endif; ?>
</body>
</html>
