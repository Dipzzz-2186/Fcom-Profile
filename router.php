<?php

declare(strict_types=1);

$requestPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
$documentRoot = __DIR__;
$filePath = $documentRoot . $requestPath;

if ($requestPath !== '/' && is_file($filePath)) {
    return false;
}

$routes = [
    '/' => '/index.php',
    '/admin' => '/admin/index.php',
    '/admin/login' => '/admin/login.php',
    '/admin/logout' => '/admin/logout.php',
];

if (isset($routes[$requestPath])) {
    require $documentRoot . $routes[$requestPath];
    return true;
}

$normalizedPhpPath = $documentRoot . $requestPath . '.php';

if (is_file($normalizedPhpPath)) {
    require $normalizedPhpPath;
    return true;
}

http_response_code(404);
echo '404 Not Found';
