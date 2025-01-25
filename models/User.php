<?php

require_once 'DB.php'; 

class User
{
    private $db;
    private $collection;

    
    public function __construct()
    {
        $this->db = DB::getDatabase(); 
        $this->collection = $this->db->users; 
    }

    
    public function loginUser($username, $password)
    {
        $user = $this->getUserByUsername($username);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['username'] = $username; 
            return true;
        }

        return false;
    }

    
    public function userExists($email, $username)
    {
        return $this->getUserByEmailOrUsername($email, $username) !== null;
    }

    
    public function registerUser($email, $username, $password)
    {
        if ($this->userExists($email, $username)) {
            return false; 
        }

        
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        
        $insertResult = $this->collection->insertOne([
            'email' => $email,
            'username' => $username,
            'password' => $hashedPassword,
        ]);

        return $insertResult->getInsertedCount() === 1;
    }

    private function getUserByUsername($username)
    {
        return $this->collection->findOne(['username' => $username]);
    }

    
    private function getUserByEmailOrUsername($email, $username)
    {
        return $this->collection->findOne([
            '$or' => [
                ['username' => $username],
                ['email' => $email]
            ]
        ]);
    }
    
    public static function isLoggedIn()
    {
        return isset($_SESSION['username']);
    }



}