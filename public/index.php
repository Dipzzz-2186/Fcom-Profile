<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/app/bootstrap.php';

$site = load_site_data();
$requestPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';

if ($requestPath === '/' || $requestPath === '') {
    render('home', ['site' => $site]);
    return;
}

if ($requestPath === '/about') {
    render('about', ['site' => $site]);
    return;
}

if (preg_match('#^/solutions/([a-z0-9-]+)$#', $requestPath, $matches) === 1) {
    $solution = find_solution_item_by_slug($site, (string) $matches[1]);

    if ($solution === null) {
        http_response_code(404);
        render('solution', ['site' => $site, 'solution' => null]);
        return;
    }

    render('solution', ['site' => $site, 'solution' => $solution]);
    return;
}

http_response_code(404);
render('solution', ['site' => $site, 'solution' => null]);
