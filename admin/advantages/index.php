<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/_shared.php';

admin_render_page('advantages', 'Advantages', 'Kelola daftar keunggulan yang ditampilkan pada website.', 'advantages', static function (array &$updated): void {
    $updated['advantages'] = [
        'title' => trim((string) ($_POST['advantages_title'] ?? '')),
        'items' => normalize_lines((string) ($_POST['advantages_items'] ?? '')),
    ];
});
