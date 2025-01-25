<nav class="navbar">
    <div class="navbar-a">
        <a href="gallery" class="nav-link">Photo Gallery</a>
        <a href="upload" class="nav-link">Upload Photo</a>
        <a href="saved" class="nav-link">Saved</a>
        <a href="search" class="nav-link">Search</a>
        <?php 
        if (isset($_SESSION['username'])): ?>
            <a href="logout" class="nav-link">Logout</a>
        <?php else: ?>
            <a href="register" class="nav-link">Register</a>
            <a href="login" class="nav-link">Login</a>
        <?php endif; ?>

        
    </div>

    <div class="navbar-b">
        <form action="search" method="get" class="search-form">
            <input type="text" name="q" placeholder="Search..." class="search-input" />
            <button type="submit" class="search-button">Search</button>
        </form>
    </div>
</nav>

<?php
// Check if the flash message is set in the session and display it
if (isset($_SESSION['flash_message'])):
?>
    <div class="flash-message-container">
        <div class="flash-message">
            <?php
                // Escape the flash message to prevent XSS
                echo htmlspecialchars($_SESSION['flash_message'], ENT_QUOTES, 'UTF-8');
                unset($_SESSION['flash_message']);
            ?>
        </div>
    </div>
<?php endif; ?>
