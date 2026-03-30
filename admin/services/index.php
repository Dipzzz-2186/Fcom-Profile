<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/_shared.php';

admin_render_page('services', 'Stages', 'Kelola section stages di homepage.', 'services', static function (array &$updated): void {
    $updated['products'] = [
        'title' => trim((string) ($_POST['products_title'] ?? '')),
        'items' => map_items(
            $_POST['product_name'] ?? [],
            $_POST['product_description'] ?? []
        ),
    ];
});
