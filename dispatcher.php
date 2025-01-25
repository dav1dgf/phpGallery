<?php

const REDIRECT_PREFIX = 'redirect:';


function dispatch($routing, $action_url)
{
    $action_url = '/' . ltrim($action_url, '/');
    if (!isset($routing[$action_url])) {
        http_response_code(404);
        echo "404 - Page not found- $action_url";
        return;
    }

    $controllerAction = $routing[$action_url];
    list($controllerName, $methodName) = explode('@', $controllerAction);
    require_once "../controllers/{$controllerName}.php";

    if (class_exists($controllerName)) {
        $controller = new $controllerName();

        if (method_exists($controller, $methodName)) {
            $controller->$methodName();
        } else {
            http_response_code(500);
            echo "500 - Method $methodName not found in $controllerName";
        }
    } else {
        http_response_code(500);
        echo "500 - Controller $controllerName not found";
    }
}
function build_response($view, $model)
{
    if (strpos($view, REDIRECT_PREFIX) === 0) {
        $url = substr($view, strlen(REDIRECT_PREFIX));
        header("Location: " . $url);
        exit;

    } else {
        render($view, $model);
    }
}

function render($view_name, $model)
{
    global $routing;
    extract($model);
    include 'views/' . $view_name . '.php';
}
