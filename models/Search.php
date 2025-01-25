<?php

require_once 'DB.php'; 

class Search
{
    private $db;
    private $uploadsCollection;

    public function __construct()
    {
        $this->db = DB::getDatabase(); 
        $this->uploadsCollection = $this->db->uploads; 
    }

    public function searchImages($query)
    {
        $username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
$searchQuery = [
    '$and' => [
        ['title' => new MongoDB\BSON\Regex($query, 'i')], 
        [
            '$or' => [
                ['privacy' => 'public'], 
                ['privacy' => 'private', 'author' => $username] 
            ]
        ]
    ]
];


$images = $this->uploadsCollection->find($searchQuery);

$imageData = [];
foreach ($images as $image) {
    $imageData[] = [
        'id' => (string) $image['_id'], 
        'title' => $image['title'] ?? 'Untitled' 
    ];
}
return $imageData;
    }

}