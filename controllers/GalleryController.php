<?php

require_once '../models/Image.php';

class GalleryController
{
    private $imageModel;

    public function __construct()
    {
        $this->imageModel = new Image();
    }
    public function index()
    {
        $username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
        $imagesPerPage = 8;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

        
        $totalImages = $this->imageModel->getTotalImages($username);

        $totalPages = ceil($totalImages / $imagesPerPage);
        
        
        if ($page > $totalPages){
            $page = 1;
        }

        $images = $this->imageModel->getImages($page, $imagesPerPage, $username);

        if (!isset($_SESSION['saved_photos'])) {
            $_SESSION['saved_photos'] = [];
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remember_selected'])) {
            
            
            if (isset($_POST['photo'])){
                
                $_SESSION['saved_photos'] = array_unique(array_merge($_SESSION['saved_photos'], (array)$_POST['photo']));
            } 
        }

        
        require '../views/gallery.php';
    }

    public function saved()
    {

        
        if (!isset($_SESSION['saved_photos'])) {
            $_SESSION['saved_photos'] = [];
        }

        
        $savedPhotoIds = $_SESSION['saved_photos'];

        
        $images = $this->imageModel->getSavedImages($savedPhotoIds);

        
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_selected'])) {
            $selectedPhotos = $_POST['photo'] ?? [];

            
            $_SESSION['saved_photos'] = array_diff($_SESSION['saved_photos'], $selectedPhotos);

            
            header("Location: index.php?action=saved");
            exit;
        }

        
        require '../views/saved.php'; 
    }

    public function view()
    {
        $message = '';
        $id = htmlspecialchars($_GET['id']) ?? null;
        if (!$id) {
            $message = "Invalid image ID.";
            require 'views/view_image.php';
            return; 
        }

        
        $image = $this->imageModel->getImageById($id);

        if (!$image) {
            $message = "Error fetching image details or image not found.";
            require 'views/view_image.php';
            return; 
        }

        
        $dateTime = $image['uploaded_at']->toDateTime();
        $formattedDateTime = $dateTime->format('Y-m-d H:i:s');
        $imgPath = "./uploads/watermarked/" . $id . ".jpg"; 

        
        require '../views/view.php';
    }
}