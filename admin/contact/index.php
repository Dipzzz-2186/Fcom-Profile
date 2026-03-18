<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/_shared.php';

admin_render_page('contact', 'Contact', 'Kelola informasi kontak yang tampil di website.', 'contact', static function (array &$updated): void {
    $updated['contact'] = [
        'address' => trim((string) ($_POST['contact_address'] ?? '')),
        'email' => trim((string) ($_POST['contact_email'] ?? '')),
        'phone' => trim((string) ($_POST['contact_phone'] ?? '')),
        'hours' => trim((string) ($_POST['contact_hours'] ?? '')),
    ];
});
