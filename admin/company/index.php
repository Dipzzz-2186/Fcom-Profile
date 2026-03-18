<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/_shared.php';

admin_render_page('company', 'Company', 'Kelola identitas utama perusahaan dan angka ringkas yang tampil di website.', 'company', static function (array &$updated): void {
    $updated['company'] = [
        'name' => trim((string) ($_POST['company_name'] ?? '')),
        'tagline' => trim((string) ($_POST['company_tagline'] ?? '')),
        'headline' => trim((string) ($_POST['company_headline'] ?? '')),
        'description' => trim((string) ($_POST['company_description'] ?? '')),
        'years' => trim((string) ($_POST['company_years'] ?? '')),
        'projects' => trim((string) ($_POST['company_projects'] ?? '')),
        'clients' => trim((string) ($_POST['company_clients'] ?? '')),
    ];
});
