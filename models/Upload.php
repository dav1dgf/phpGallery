<?php

require_once 'DB.php'; 

class Upload
{
    private $db;
    private $collection;

    public function __construct()
    {
        $this->db = DB::getDatabase(); 
        $this->collection = $this->db->uploads; 
    }

    public function validateUpload($fileTmpPath, $fileName, $fileSize, $fileType, $privacy, $author, $authorName)
    {
        
        if ($author != $authorName && $author != '' && $privacy === 'private') {
            return "You can only upload private files for yourself";
        }

        
        $allowedMimeTypes = ['image/png', 'image/jpeg'];
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $fileTmpPath);
        finfo_close($finfo);

        if (!in_array($mimeType, $allowedMimeTypes)) {
            return "Only PNG and JPG files are allowed.";
        }

        if ($fileSize > 5 * 1024 * 1024) { 
            return "File size exceeds the 5MB limit.";
        }

        return ''; 
    }

    public function handleFileUpload($fileTmpPath, $fileName, $fileSize, $fileType, $privacy, $title, $author)
    {
        
        $uploadDir = './uploads/';
        $thumbnailsDir = './uploads/thumbnails/';
        $fullsizeDir = './uploads/originals/';
        $watermarkDir = './uploads/watermarked/';
        
        $this->createDirectories([$uploadDir, $thumbnailsDir, $fullsizeDir, $watermarkDir]);

        
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $fileTmpPath);
        finfo_close($finfo);
        
        $fileFormat = explode('/', $mimeType)[1];
        $metadata = [
            'title' => $title,
            'uploaded_at' => new MongoDB\BSON\UTCDateTime(),
            'privacy' => $privacy,
            'author' => $author,
            'filetype' => $fileFormat
        ];

        
        $insertResult = $this->collection->insertOne($metadata);
        $imageId = (string) $insertResult->getInsertedId();

        
        $destPath = $fullsizeDir . $imageId . '.' . pathinfo($fileName, PATHINFO_EXTENSION);
        if (move_uploaded_file($fileTmpPath, $destPath)) {
            $this->createThumb($destPath, $mimeType);
            $this->createWtrMark($destPath, $mimeType);
            return "File successfully uploaded and thumbnail created.";
        } else {
            return "Error moving the file to the upload directory.";
        }
    }

    
    private function createDirectories($dirs)
    {
        foreach ($dirs as $dir) {
            if (!is_dir($dir)) {
                mkdir($dir, 0755, true);
            }
        }
    }

    
    private function createThumb($sourcePath, $fileType)
    {
        $thumbHeight = 125;
        $thumbWidth = 200;
        $fileName = basename($sourcePath);
        $thumbDir = './uploads/thumbnails/';

        if (strtolower($fileType) === 'image/jpg' || strtolower($fileType) === 'image/jpeg') {
            $img = imagecreatefromjpeg($sourcePath);
        } elseif (strtolower($fileType) === 'image/png') {
            $img = imagecreatefrompng($sourcePath);
        } else {
            return;
        }

        $width = imagesx($img);
        $height = imagesy($img);
        $tmpImg = imagecreatetruecolor($thumbWidth, $thumbHeight);
        imagecopyresized($tmpImg, $img, 0, 0, 0, 0, $thumbWidth, $thumbHeight, $width, $height);
        $thumbPath = $thumbDir . $fileName;
        imagejpeg($tmpImg, $thumbPath);

        imagedestroy($img);
        imagedestroy($tmpImg);
    }

    
    private function createWtrMark($sourcePath, $fileType)
    {
        $fileName = basename($sourcePath);
        $wtrDir = './uploads/watermarked/';

        if (strtolower($fileType) === 'image/jpg' || strtolower($fileType) === 'image/jpeg') {
            $img = imagecreatefromjpeg($sourcePath);
        } elseif (strtolower($fileType) === 'image/png') {
            $img = imagecreatefrompng($sourcePath);
        } else {
            return;
        }

        $red = imagecolorallocate($img, 255, 0, 0);
        imagestring($img, 5, 25, 25, "COPYRIGHT", $red);
        $wtrPath = $wtrDir . $fileName;
        imagejpeg($img, $wtrPath);

        imagedestroy($img);
    }
}