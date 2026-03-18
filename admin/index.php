<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/app/bootstrap.php';

if (! is_admin_logged_in()) {
    redirect('/admin/login');
}

$site = load_site_data();
$message = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $updated = [
        'company' => [
            'name' => trim((string) ($_POST['company_name'] ?? '')),
            'tagline' => trim((string) ($_POST['company_tagline'] ?? '')),
            'headline' => trim((string) ($_POST['company_headline'] ?? '')),
            'description' => trim((string) ($_POST['company_description'] ?? '')),
            'years' => trim((string) ($_POST['company_years'] ?? '')),
            'projects' => trim((string) ($_POST['company_projects'] ?? '')),
            'clients' => trim((string) ($_POST['company_clients'] ?? '')),
        ],
        'about' => [
            'title' => trim((string) ($_POST['about_title'] ?? '')),
            'content' => trim((string) ($_POST['about_content'] ?? '')),
        ],
        'products' => [
            'title' => trim((string) ($_POST['products_title'] ?? '')),
            'items' => map_items(
                $_POST['product_name'] ?? [],
                $_POST['product_description'] ?? []
            ),
        ],
        'solutions' => [
            'groups' => map_solution_groups(
                $_POST['solution_group_title'] ?? [],
                $_POST['solution_item_label'] ?? [],
                $_POST['solution_item_href'] ?? []
            ),
        ],
        'advantages' => [
            'title' => trim((string) ($_POST['advantages_title'] ?? '')),
            'items' => normalize_lines((string) ($_POST['advantages_items'] ?? '')),
        ],
        'contact' => [
            'address' => trim((string) ($_POST['contact_address'] ?? '')),
            'email' => trim((string) ($_POST['contact_email'] ?? '')),
            'phone' => trim((string) ($_POST['contact_phone'] ?? '')),
            'hours' => trim((string) ($_POST['contact_hours'] ?? '')),
        ],
    ];

    if (save_site_data($updated)) {
        $site = load_site_data();
        $message = 'Konten berhasil diperbarui.';
    } else {
        $message = 'Konten gagal disimpan.';
    }
}

render('admin/dashboard', ['site' => $site, 'message' => $message], 'admin');
