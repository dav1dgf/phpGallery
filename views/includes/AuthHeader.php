<?php

class AuthHeader{
public static function isLoggedIn() {
        return isset($_SESSION['username']) && !empty($_SESSION['username']);
    }

}