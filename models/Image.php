<?php
require_once 'DB.php';
use MongoDB\BSON\ObjectID;

class Image
{
    private $uploadsCollection;

    public function __construct()
    {
        $db = DB::getDatabase();
        $this->uploadsCollection = $db->uploads;
    }

    public function getImages($page, $imagesPerPage, $username)
    {
        $imagesQuery = [
            '$or' => [
                ['privacy' => 'public'],
                ['privacy' => 'private', 'author' => $username]
            ]
        ];

        $skip = ($page - 1) * $imagesPerPage;

        return $this->uploadsCollection->find($imagesQuery, [
            'skip' => $skip,
            'limit' => $imagesPerPage,
        ]);
    }

    public function getTotalImages($username)
    {
        $imagesQuery = [
            '$or' => [
                ['privacy' => 'public'],
                ['privacy' => 'private', 'author' => $username]
            ]
        ];

        return $this->uploadsCollection->count($imagesQuery);
    }

    public function getSavedImages($savedPhotoIds)
    {
        $objectIds = array_map(function ($id) {
            return new ObjectID($id);
        }, $savedPhotoIds);

        $images = [];
        if (!empty($objectIds)) {
            foreach ($objectIds as $objectId) {
                $result = $this->uploadsCollection->findOne(['_id' => $objectId]);
                if ($result) {
                    $images[] = $result;
                }
            }
        }
        return $images;
    }

    public function getImageById($id)
    {
        try {
            return $this->uploadsCollection->findOne(['_id' => new ObjectID($id)]);
        } catch (Exception $e) {
            return null;
        }
    }
}