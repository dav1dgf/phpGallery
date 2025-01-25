<?php

require_once '../models/User.php'; 

class AuthController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();

    }

    
    public function login()
    {
        $message = '';

        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            
            $username = htmlspecialchars($username);
            $password = htmlspecialchars($password);

            
            if ($this->userModel->loginUser($username, $password)) {
                
                session_regenerate_id(true);
                $_SESSION['flash_message'] = 'You have logged in successfully!';
                header("Location: index"); 
                
                exit();
            } else {
                $message = "Invalid username or password.";
            }
        }

        
        require '../views/login.php';
    }

    
    public function register()
    {
        $message = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            $confirmPassword = $_POST['confirm_password'] ?? '';

            
            $email = filter_var($email, FILTER_SANITIZE_EMAIL);
            $username = htmlspecialchars($username);
            $password = htmlspecialchars($password);
            $confirmPassword = htmlspecialchars($confirmPassword);

            
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $message = "Invalid email format.";
            } elseif ($password !== $confirmPassword) {
                $message = "Passwords do not match.";
            } elseif (strlen($password) < 6) {
                $message = "Password must be at least 6 characters long.";
            } else {
                
                if ($this->userModel->userExists($email, $username)) {
                    $message = "Username or email already exists.";
                } else {
                    
                    $result = $this->userModel->registerUser($email, $username, $password);

                    if ($result) {
                        
                        
                        $_SESSION['flash_message'] = 'You have registered successfully!';
                        header("Location: login");
                        
                        exit();
                    } else {
                        $message = "An error occurred. Please try again.";
                    }
                }
            }
        }

        
        require '../views/register.php';
    }

    
    public function logout()
    {
        
        setcookie(session_name(), '', time() - 3600, '/'); 
        session_unset(); 
        session_destroy(); 
        //redundant $_SESSION = array(); 
        header("Location: index");
        

        exit(); 
    }

    public function isLoggedIn() {
        return isset($_SESSION['username']) && !empty($_SESSION['username']);
    }
    
}