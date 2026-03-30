<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/_shared.php';

$site = load_site_data();
$clients = $site['clients']['items'] ?? [];
$services = $site['products']['items'] ?? [];
$solutionGroups = $site['solutions']['groups'] ?? [];
$home = $site['home'] ?? [];
$adminName = (string) ($_SESSION['admin_username'] ?? 'Admin');
$logoCount = count($clients);
$serviceCount = count(array_filter($services, static fn (array $item): bool => trim((string) ($item['name'] ?? '')) !== ''));
$logoReadyCount = count(array_filter($clients, static fn (array $item): bool => trim((string) ($item['logo'] ?? '')) !== ''));
$solutionCount = array_reduce(
    $solutionGroups,
    static fn (int $carry, array $group): int => $carry + count($group['items'] ?? []),
    0
);
$homeCount = count(array_filter($home, static fn ($item): bool => trim((string) $item) !== ''));

render('admin/dashboard', [
    'site' => $site,
    'activePage' => 'dashboard',
    'adminName' => $adminName,
    'stats' => [
        [
            'label' => 'Clients',
            'value' => (string) $logoCount,
            'meta' => 'Data client yang tersimpan di CMS',
        ],
        [
            'label' => 'Stages',
            'value' => (string) $serviceCount,
            'meta' => 'Item stage homepage yang sudah terisi',
        ],
        [
            'label' => 'Solutions',
            'value' => (string) $solutionCount,
            'meta' => 'Item solusi dan halaman detail aktif',
        ],
        [
            'label' => 'Homepage',
            'value' => (string) $homeCount,
            'meta' => 'Field homepage yang sudah tersambung',
        ],
    ],
], 'admin');
