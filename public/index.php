<?php
require_once __DIR__ . '/../config/database.php';
$routes = require __DIR__ . '/../config/routes.php';

// Simple Router
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if (array_key_exists($requestUri, $routes)) {
    list($controller, $method) = explode('@', $routes[$requestUri]);
    require_once __DIR__ . '/../app/controllers/' . $controller . '.php';
    $controllerInstance = new $controller;
    $controllerInstance->$method();
} else {
    http_response_code(404);
    echo '404 Not Found';
}
?>