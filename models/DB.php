<?php

require '../../vendor/autoload.php'; 

class DB
{
    public static function getDatabase() {
        try {
        $mongo = new MongoDB\Client(
            "mongodb://localhost:27017/XXX",
            [
                'username' => 'XXX',
                'password' => 'XXX',
            ]);
        $db = $mongo->gallery_app;
        return $db;

        } catch (Exception $e) {
            die("Error connecting to MongoDB: " . $e->getMessage());
        }
    }

}