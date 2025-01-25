<?php

require_once '../models/Search.php'; 

class SearchController
{
    private $searchModel;

    public function __construct()
    {
        $this->searchModel = new Search(); 
    }

    public function search()
    {
        $query = isset($_GET['q']) ? $_GET['q'] : '';
        require '../views/search.php';
    }
    public function search_img()
    {
        
        $imageData=[];
        $query = isset($_GET['q']) ? htmlspecialchars($_GET['q']) : '';
        if (!empty($query)){
            $imageData = $this->searchModel->searchImages($query);
        }
        

        header('Content-Type: application/json');
        echo json_encode(['images' => $imageData]);

    }
}