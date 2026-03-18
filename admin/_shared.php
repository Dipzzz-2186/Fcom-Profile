<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/app/bootstrap.php';

if (! is_admin_logged_in()) {
    redirect('/admin/login');
}

function admin_render_page(
    string $activePage,
    string $pageTitle,
    string $pageDescription,
    string $formPartial,
    callable $mutator
): void {
    $site = load_site_data();
    $message = null;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $updated = $site;
        $mutator($updated);

        if (save_site_data($updated)) {
            $site = load_site_data();
            $message = 'Konten berhasil diperbarui.';
        } else {
            $message = 'Konten gagal disimpan.';
        }
    }

    render('admin/page', [
        'site' => $site,
        'message' => $message,
        'activePage' => $activePage,
        'pageTitle' => $pageTitle,
        'pageDescription' => $pageDescription,
        'formPartial' => $formPartial,
    ], 'admin');
}
