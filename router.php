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
    '/admin/dashboard' => '/admin/dashboard/index.php',
    '/admin/company' => '/admin/company/index.php',
    '/admin/about' => '/admin/about/index.php',
    '/admin/services' => '/admin/services/index.php',
    '/admin/navigation' => '/admin/navigation/index.php',
    '/admin/advantages' => '/admin/advantages/index.php',
    '/admin/clients' => '/admin/clients/index.php',
    '/admin/contact' => '/admin/contact/index.php',
    '/admin/blog' => '/admin/blog/index.php',
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

$directoryIndexPath = rtrim($documentRoot . $requestPath, '/') . '/index.php';

if (is_file($directoryIndexPath)) {
    require $directoryIndexPath;
    return true;
}

http_response_code(404);
echo '404 Not Found';
