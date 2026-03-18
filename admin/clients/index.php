<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/_shared.php';

admin_render_page('clients', 'Clients', 'Tambah atau ganti logo client yang tampil pada section Our Client.', 'clients', static function (array &$updated): void {
    $updated['clients'] = [
        'items' => map_logo_items(
            $_POST['client_name'] ?? [],
            handle_logo_uploads($_FILES['client_logo'] ?? [], $_POST['client_logo_existing'] ?? [])
        ),
    ];
});
