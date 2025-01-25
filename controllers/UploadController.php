<?php
//FIX THIS, BD interactions...
require_once '../models/Upload.php';
require_once '../models/User.php';

class UploadController
{
    private $upload;

    public function __construct()
    {
        $this->upload = new Upload();
    }
    public function upload()
    {
        $message = '';
        $authorName = User::isLoggedIn() ? htmlspecialchars($_SESSION['username']) : '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file']) && $_FILES['file']['error'] === 0) {
            $fileTmpPath = $_FILES['file']['tmp_name'];
            $fileName = $_FILES['file']['name'];
            $fileSize = $_FILES['file']['size'];
            $fileType = $_FILES['file']['type'];
            $privacy = isset($_POST['privacy']) ? $_POST['privacy'] : 'public';
            $title = htmlspecialchars($_POST['title']);
            $author = htmlspecialchars($_POST['author']);
            
            $message = $this->upload->validateUpload($fileTmpPath, $fileName, $fileSize, $fileType, $privacy, $author, $authorName);

            if ($message === '') {
                $this->upload->handleFileUpload($fileTmpPath, $fileName, $fileSize, $fileType, $privacy, $title, $author);
                header("Location: index");
                $_SESSION['flash_message'] = 'You have uploaded an image successfully!';
                exit();
            }
        } else if ($_SERVER['REQUEST_METHOD'] === 'GET'){
            $message = "";
        }
        else { 
            $message = "No file uploaded or there was an upload error.";

        }

        require '../views/upload.php'; 
    }

}