<!-- views/gallery.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik+Iso&display=swap" rel="stylesheet">
    <link rel="icon" href="data:;base64,iVBORw0KGgo=">
</head>
<body>
    <?php include_once 'includes/header.php'; ?>

    <h1 class="rubik-iso-regular">Space Gallery</h1>
    <?php if (isset($_SESSION['username'])): ?>
        <h3>Hello, <?php echo htmlspecialchars($_SESSION['username']); ?></h3>
    <?php endif; ?>

    <form method="POST">
        <div class="gallery">
            <?php foreach ($images as $image): ?>
                <div class="gallery-item">
                    <div class="image-container">
                        <a href="view?id=<?php echo $image['_id']; ?>">
                            <img src="./uploads/thumbnails/<?php echo htmlspecialchars($image['_id'] . '.jpg'); ?>" alt="Image">
                        </a>
                    </div>
                    <div class="info-container">
                        <div class="image-info">
                            <p>
                                Title: <?php echo htmlspecialchars($image['title']); ?><br>
                                <?php if ($image['privacy'] === 'private'): ?>
                                    <em>(Private)</em>
                                <?php endif; ?>
                            </p>
                        </div>
                        <div class="checkbox-container">
                            <input type="checkbox" class="image-checkbox" name="photo[]" value="<?php echo (string)$image['_id']; ?>" 
                                <?php echo in_array((string)$image['_id'], $_SESSION['saved_photos']) ? 'checked' : ''; ?>>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <br>
        <div class="input-container">
            <input type="submit" class="remember_btn" name="remember_selected" value="Remember Selected">
        </div>
    </form>

    <a class="saved_link" href="saved">View Saved Photos</a>

    <div class="pagination">
        <?php if ($page > 1): ?>
            <a href="?page=1">&laquo; First</a>
            <a href="?page=<?php echo $page - 1; ?>">Previous</a>
        <?php endif; ?>

        <span>Page <?php echo $page; ?> of <?php echo $totalPages; ?></span>

        <?php if ($page < $totalPages): ?>
            <a href="?page=<?php echo $page + 1; ?>">Next</a>
            <a href="?page=<?php echo $totalPages; ?>">Last &raquo;</a>
        <?php endif; ?>
    </div>

    <?php include_once 'includes/footer.php'; ?>
</body>
</html>