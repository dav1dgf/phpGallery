<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/search.css">
    <title>Search Photos</title>
</head>
<body>
    <?php include_once('includes/header.php'); ?>
    <h2 class="title">Search Photos</h2>
    <main>
        <div class="search-bar-container">
            <input
                type="text"
                id="searchQuery"
                class="search-bar"
                placeholder="Search the galaxy for photos..."
                onkeyup="searchPhotos()"
                value = "<?php echo !empty($query) ? $query : ''; ?>";
                />
        </div>
        <div id="searchResults">
            <!-- This will be populated dynamically -->
            <?php if (!empty($images)): ?>
                <div class="gallery">
                    <?php foreach ($images as $image): ?>
                        <div class="gallery-item">
                            <div class="image-container">
                                <a href="view.php?id=<?php echo $image['_id']; ?>">
                                    <img src="./uploads/thumbnails/<?php echo $image['_id']; ?>.jpg" alt="Image" loading="lazy" />
                                </a>
                            </div>
                            <div class="info-container">
                                <p>Title: <?php echo htmlspecialchars($image['title']); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <h3>No results found.</h3>
            <?php endif; ?>
        </div>
    </main>
    <?php include_once('includes/footer.php'); ?>
    <?php if (!empty($query)) {
        echo '<script>document.addEventListener("DOMContentLoaded", function() { searchPhotos("' . addslashes($query) . '"); });</script>';    }
    ?>
    <script>
        function searchPhotos(initialQuery = '') {
            var query = initialQuery || document.getElementById('searchQuery').value;
            var xhr = new XMLHttpRequest();

            if (query.length > 0) {
                xhr.open('GET', 'api/search?q=' + encodeURIComponent(query), true);

                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        var data = JSON.parse(xhr.responseText);
                        var searchResults = document.getElementById('searchResults');
                        searchResults.innerHTML = '';

                        if (data.images && data.images.length > 0) {
                            var galleryDiv = document.createElement('div');
                            galleryDiv.className = 'gallery';

                            data.images.forEach(function (image) {
                                var galleryItem = document.createElement('div');
                                galleryItem.className = 'gallery-item';

                                var imageContainer = document.createElement('div');
                                imageContainer.className = 'image-container';

                                var anchor = document.createElement('a');
                                anchor.href = 'view?id=' + image.id;

                                var imgElement = document.createElement('img');
                                imgElement.src = './uploads/thumbnails/' + image.id + '.jpg';
                                imgElement.alt = 'Image';
                                imgElement.loading = 'lazy';

                                anchor.appendChild(imgElement);
                                imageContainer.appendChild(anchor);
                                galleryItem.appendChild(imageContainer);

                                var infoContainer = document.createElement('div');
                                infoContainer.className = 'info-container';
                                infoContainer.innerHTML = `<p>Title: ${image.title}</p>`;
                                galleryItem.appendChild(infoContainer);

                                galleryDiv.appendChild(galleryItem);
                            });

                            searchResults.appendChild(galleryDiv);
                        } else {
                            searchResults.innerHTML = '<h3>No results found.</h3>';
                        }
                    }
                };
                xhr.send();
            } else {
                document.getElementById('searchResults').innerHTML = '<h3>No results found.</h3>';
            }
        }
    </script>
</body>
</html>
