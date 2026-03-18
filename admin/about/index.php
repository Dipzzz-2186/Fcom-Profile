<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/_shared.php';

admin_render_page('about', 'About', 'Ubah konten section tentang perusahaan.', 'about', static function (array &$updated): void {
    $updated['about'] = [
        'title' => trim((string) ($_POST['about_title'] ?? '')),
        'content' => trim((string) ($_POST['about_content'] ?? '')),
    ];
});
