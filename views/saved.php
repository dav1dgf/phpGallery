<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/saved.css">
    <title>Saved Photos</title>
    <link rel="icon" href="data:;base64,iVBORw0KGgo=">
</head>

<body>
    <?php include_once('includes/header.php'); ?>
    <h2 class="saved-title">Saved Photos</h2>
    <main>
        <form method="POST" action="saved">
            <div>
                <?php if (empty($images)): ?>
                    <h3>No saved photos found.</h3>
                <?php else: ?>
                    <div class="gallery">
                        <?php foreach ($images as $image): ?>
                            <div class="gallery-item">
                                <div class="image-container">
                                    <a href="view.php?id=<?php echo $image['_id']; ?>">
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
                                        <input type="checkbox" class="image-checkbox" name="photo[]" value="<?php echo (string)$image['_id']; ?>">
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
            <br>

            <div class="input-container">
                <input type="submit" name="remove_selected" class="remember-btn" value="Remove Selected from Saved">
            </div>
        </form>
    </main>
    <?php include_once('includes/footer.php'); ?>
</body>

</html>
