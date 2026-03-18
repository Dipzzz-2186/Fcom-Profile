<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/app/bootstrap.php';

if (is_admin_logged_in()) {
    redirect('/admin');
}

$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim((string) ($_POST['username'] ?? ''));
    $password = trim((string) ($_POST['password'] ?? ''));

    if (authenticate_admin($username, $password)) {
        redirect('/admin');
    }

    $error = 'Username atau password tidak sesuai.';
}

render('admin/login', ['error' => $error], 'admin');
