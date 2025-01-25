<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Upload a photo with additional details">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/upload.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.14.1/jquery-ui.min.js" integrity="sha512-MSOo1aY+3pXCOCdGAYoBZ6YGI0aragoQsg1mKKBHXCYPIWxamwOE7Drh+N5CPgGI5SA9IEKJiPjdfqWFWmZtRA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="assets/js/main.js"></script>
    
    <title>Upload Photo</title>
</head>

<body>

    <?php include_once('includes/header.php'); ?>

    <div class="upload-container">
        <h2 class="upload-title">Upload a Photo</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <label for="file">Choose a photo:</label>
            <input type="file" name="file" id="file" accept=".png, .jpg" required>
            </br>
            <label for="titleImg">Image Title:</label>
            <input type="text" name="title" id="titleImg" placeholder="Enter image title" required>
            </br>
            <label for="authorImg">Author Name:</label>
            <input type="text" name="author" id="authorImg" value="<?php echo htmlspecialchars($authorName); ?>"
                placeholder="Author's name" required>
                </br>
            <?php if (isset($_SESSION['username'])): ?>
                <div class="radio-group">
                    <label for="privacy">Privacy:</label>
                    <div>
                        <input type="radio" id="public" name="privacy" value="public" checked>
                        <label for="public">Public</label>
                    </div>
                    <div>
                        <input type="radio" id="private" name="privacy" value="private">
                        <label for="private">Private</label>
                    </div>
                </div>
            <?php endif; ?>
            
            <button type="submit" class="submit-btn">Upload</button>
        </form>
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
