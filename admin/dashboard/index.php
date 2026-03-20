<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/_shared.php';

$site = load_site_data();
$clients = $site['clients']['items'] ?? [];
$adminName = (string) ($_SESSION['admin_username'] ?? 'Admin');
$logoCount = count($clients);
$namedClients = count(array_filter($clients, static fn (array $item): bool => trim((string) ($item['name'] ?? '')) !== ''));
$logoReadyCount = count(array_filter($clients, static fn (array $item): bool => trim((string) ($item['logo'] ?? '')) !== ''));

render('admin/dashboard', [
    'site' => $site,
    'activePage' => 'dashboard',
    'adminName' => $adminName,
    'stats' => [
        [
            'label' => 'Client entries',
            'value' => (string) $logoCount,
            'meta' => 'Data client yang tersimpan di CMS',
        ],
        [
            'label' => 'Nama client',
            'value' => (string) $namedClients,
            'meta' => 'Entry yang sudah punya nama client',
        ],
        [
            'label' => 'Logo siap tayang',
            'value' => (string) $logoReadyCount,
            'meta' => 'Logo yang sudah terpasang di website',
        ],
        [
            'label' => 'Next module',
            'value' => 'IoT',
            'meta' => 'Internet of Things disiapkan sebagai CMS berikutnya',
        ],
    ],
], 'admin');
