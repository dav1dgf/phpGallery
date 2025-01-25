<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/login.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.14.1/jquery-ui.min.js" integrity="sha512-MSOo1aY+3pXCOCdGAYoBZ6YGI0aragoQsg1mKKBHXCYPIWxamwOE7Drh+N5CPgGI5SA9IEKJiPjdfqWFWmZtRA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="assets/js/main.js"></script>
    <link rel="icon" href="data:;base64,iVBORw0KGgo=">
    <title>Login</title>
</head>
<body>
    <?php include_once('includes/header.php'); ?>

    <div class="login-container">
        <h2 class="login-title">Login</h2>

        <form action="login" method="POST" class="login-form">
            <label for="username" class="login-label">Username:</label>
            <input type="text" name="username" id="username" class="login-input" required><br>

            <label for="password" class="login-label">Password:</label>
            <input type="password" name="password" id="password" class="login-input" required><br><br>

            <input type="submit" value="Login" class="login-btn">
        </form>

        <!-- Error Message Display -->
        <p class="error-message"><?php echo $message; ?></p>
    </div>

    <?php include_once('includes/footer.php'); ?>

    <?php if (!empty($message)): ?>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                showDialog(`<?php echo addslashes($message); ?>`, 'Server Response');
            });
        </script>
    <?php endif; ?>
</body>
</html>
