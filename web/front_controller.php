<?php
require '../../vendor/autoload.php';
//change maybe the php
require_once '../dispatcher.php';
require_once '../routing.php';

ini_set('session.use_strict_mode', 1);
//only session cookie if connection via https, so we cant activate it
//ini_set('session.cookie_secure', 1);
ini_set('session.cookie_httponly', 1);

session_start();

//wybór kontrolera do wywołania:
$action_url = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_URL) ?? '/';

try {
    dispatch($routing, $action_url);
} catch (Exception $e) {
    http_response_code(500);
    echo "An error occurred: " . htmlspecialchars($e->getMessage());
   
}