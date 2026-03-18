<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/_shared.php';

admin_render_page('services', 'Services', 'Kelola judul section layanan dan daftar layanan utama.', 'services', static function (array &$updated): void {
    $updated['products'] = [
        'title' => trim((string) ($_POST['products_title'] ?? '')),
        'items' => map_items(
            $_POST['product_name'] ?? [],
            $_POST['product_description'] ?? []
        ),
    ];
});
