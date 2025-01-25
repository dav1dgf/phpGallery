<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/view.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.14.1/jquery-ui.min.js" integrity="sha512-MSOo1aY+3pXCOCdGAYoBZ6YGI0aragoQsg1mKKBHXCYPIWxamwOE7Drh+N5CPgGI5SA9IEKJiPjdfqWFWmZtRA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="assets/js/main.js"></script>
    <title>View Image</title>
</head>
<body class="view-image-body">
    <?php include_once('includes/header.php'); ?>

    <?php if (!empty($message)): ?>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                showDialog(`<?php echo addslashes($message); ?>`, 'Server Response');
            });
        </script>
    <?php endif; ?>

    <?php if (isset($image)): ?>
        <h1 class="view-image-heading"><?php echo htmlspecialchars($image['title']); ?></h1>
        <img src="<?php echo htmlspecialchars($imgPath); ?>" alt="<?php echo htmlspecialchars($image['title']); ?>" loading="lazy" class="view-image-img"><br>
        <table class="view-image-table">
            <tr><th class="view-image-th">Author</th><td class="view-image-td"><?php echo htmlspecialchars($image['author'] ?? 'Unknown'); ?></td></tr>
            <tr><th class="view-image-th">Privacy</th><td class="view-image-td"><?php echo ($image['privacy'] ?? 'Unknown') === 'private' ? 'Private' : 'Public'; ?></td></tr>
            <tr><th class="view-image-th">Uploaded At</th><td class="view-image-td"><?php echo isset($image['uploaded_at']) && $image['uploaded_at'] instanceof MongoDB\BSON\UTCDateTime ? $image['uploaded_at']->toDateTime()->format('F j, Y, g:i a') : 'Not specified'; ?></td></tr>
        </table>
        <a href="index.php" class="view-image-link">Back to Gallery</a>
    <?php endif; ?>

    <?php include_once('includes/footer.php'); ?>
</body>
</html>
