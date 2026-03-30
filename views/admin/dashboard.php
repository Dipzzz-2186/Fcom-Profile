<?php

declare(strict_types=1);

$dashboardItem = ['key' => 'dashboard', 'label' => 'Dashboard', 'href' => '/admin/dashboard', 'icon' => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M4 13h7V4H4v9zm9 7h7V4h-7v16zM4 20h7v-5H4v5z"/></svg>'];
$navGroups = [
    [
        'label' => 'Homepage',
        'items' => [
            ['key' => 'company', 'label' => 'Home Hero', 'href' => '/admin/company', 'icon' => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M3 21h18v-2H3v2zm2-4h4V7H5v10zm5 0h4V3h-4v14zm5 0h4v-7h-4v7z"/></svg>'],
            ['key' => 'services', 'label' => 'Stages', 'href' => '/admin/services', 'icon' => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M4 6h16v2H4V6zm0 5h16v2H4v-2zm0 5h10v2H4v-2z"/></svg>'],
            ['key' => 'clients', 'label' => 'Clients', 'href' => '/admin/clients', 'icon' => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M16 11c1.66 0 2.99-1.79 2.99-4S17.66 3 16 3s-3 1.34-3 4 1.34 4 3 4zm-8 0c1.66 0 2.99-1.79 2.99-4S9.66 3 8 3 5 4.34 5 7s1.34 4 3 4zm0 2c-2.33 0-7 1.17-7 3.5V20h14v-3.5C15 14.17 10.33 13 8 13zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.94 1.97 3.45V20h6v-3.5c0-2.33-4.67-3.5-7-3.5z"/></svg>'],
        ],
    ],
    [
        'label' => 'Profile',
        'items' => [
            ['key' => 'about', 'label' => 'About', 'href' => '/admin/about', 'icon' => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M11 7h2V5h-2v2zm0 12h2V9h-2v10zm1-17C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"/></svg>'],
            ['key' => 'blog', 'label' => 'Blog', 'href' => '/admin/blog', 'icon' => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M4 5h16v2H4V5zm0 4h16v2H4V9zm0 4h10v2H4v-2zm0 4h10v2H4v-2zm12 0h4V9h-4v8z"/></svg>'],
        ],
    ],
    [
        'label' => 'Contact',
        'items' => [
            ['key' => 'contact', 'label' => 'Contact', 'href' => '/admin/contact', 'icon' => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M21 8V7l-3 2-2-1-3 2-2-1-3 2-2-1-4 2v9h20V8zM1 5v2l4-2 2 1 3-2 2 1 3-2 2 1 3-2v2l-3 2-2-1-3 2-2-1-3 2-2-1-4 2V5z"/></svg>'],
            ['key' => 'advantages', 'label' => 'Footer', 'href' => '/admin/advantages', 'icon' => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2l2.39 7.26H22l-6.1 4.43 2.33 7.31L12 16.9 5.77 21l2.33-7.31L2 9.26h7.61L12 2z"/></svg>'],
        ],
    ],
];
$utilityItems = [
    ['key' => 'website', 'label' => 'Website', 'href' => '/', 'icon' => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2a10 10 0 100 20 10 10 0 000-20zm6.93 9h-3.03a15.6 15.6 0 00-1.38-5.01A8.03 8.03 0 0118.93 11zM12 4.06c1.13 1.46 1.94 3.99 2.12 6.94H9.88C10.06 8.05 10.87 5.52 12 4.06zM9.48 5.99A15.6 15.6 0 008.1 11H5.07a8.03 8.03 0 014.41-5.01zM4.26 13H8.1a15.6 15.6 0 001.38 5.01A8.03 8.03 0 014.26 13zm7.74 6.94c-1.13-1.46-1.94-3.99-2.12-6.94h4.24c-.18 2.95-.99 5.48-2.12 6.94zm2.52-1.93A15.6 15.6 0 0015.9 13h3.84a8.03 8.03 0 01-5.22 5.01z"/></svg>'],
    ['key' => 'logout', 'label' => 'Logout', 'href' => '/admin/logout', 'icon' => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M10 17l1.41-1.41L8.83 13H20v-2H8.83l2.58-2.59L10 7l-5 5 5 5zm10-14H4a2 2 0 00-2 2v4h2V5h16v14H4v-4H2v4a2 2 0 002 2h16a2 2 0 002-2V5a2 2 0 00-2-2z"/></svg>'],
];

$clients = $site['clients']['items'] ?? [];
$services = $site['products']['items'] ?? [];
$advantages = $site['advantages']['items'] ?? [];
$solutionGroups = $site['solutions']['groups'] ?? [];
$company = $site['company'] ?? [];
$home = $site['home'] ?? [];
$about = $site['about'] ?? [];
$contact = $site['contact'] ?? [];
$blogItems = $site['blog']['items'] ?? [];

$serviceCount = count(array_filter($services, static fn (array $item): bool => trim((string) ($item['name'] ?? '')) !== ''));
$clientWithLogoCount = count(array_filter($clients, static fn (array $item): bool => trim((string) ($item['logo'] ?? '')) !== ''));
$homeFieldCount = count(array_filter($home, static fn ($value): bool => trim((string) $value) !== ''));
$blogCount = count(array_filter($blogItems, static fn (array $item): bool => trim((string) ($item['title'] ?? '')) !== ''));
$aboutFilledCount = 0;
$aboutVisionItems = $about['vision']['items'] ?? [];
$aboutMissionItems = $about['mission']['items'] ?? [];
$aboutFilledCount += trim((string) ($about['vision']['copy'] ?? '')) !== '' ? 1 : 0;
$aboutFilledCount += trim((string) ($about['mission']['copy'] ?? '')) !== '' ? 1 : 0;
foreach (array_merge($aboutVisionItems, $aboutMissionItems) as $item) {
    $aboutFilledCount += trim((string) ($item['title'] ?? '')) !== '' || trim((string) ($item['body'] ?? '')) !== '' ? 1 : 0;
}
$solutionCount = 0;
foreach ($solutionGroups as $group) {
    $solutionCount += count($group['items'] ?? []);
}

$cmsSections = [
    ['title' => 'Home Hero', 'description' => 'Brand, topbar, tombol, dan hero utama homepage.', 'href' => '/admin/company', 'count' => 6, 'status' => 'Aktif', 'statusClass' => 'is-complete'],
    ['title' => 'About', 'description' => 'Konten Vision dan Mission halaman about.', 'href' => '/admin/about', 'count' => $aboutFilledCount, 'status' => $aboutFilledCount > 0 ? 'Aktif' : 'Kosong', 'statusClass' => $aboutFilledCount > 0 ? 'is-complete' : 'is-pending'],
    ['title' => 'Stages', 'description' => 'Section Our IT Solution Services Stages di homepage.', 'href' => '/admin/services', 'count' => $serviceCount, 'status' => $serviceCount > 0 ? 'Aktif' : 'Kosong', 'statusClass' => $serviceCount > 0 ? 'is-complete' : 'is-pending'],
    ['title' => 'Solutions Nav', 'description' => 'Dropdown Solutions dan isi halaman detail.', 'href' => '/admin/navigation', 'count' => $solutionCount, 'status' => $solutionCount > 0 ? 'Aktif' : 'Kosong', 'statusClass' => $solutionCount > 0 ? 'is-complete' : 'is-pending'],
    ['title' => 'Homepage Labels', 'description' => 'Label navbar, footer, judul clients, dan embed map.', 'href' => '/admin/advantages', 'count' => $homeFieldCount, 'status' => $homeFieldCount > 0 ? 'Aktif' : 'Kosong', 'statusClass' => $homeFieldCount > 0 ? 'is-complete' : 'is-pending'],
    ['title' => 'Clients', 'description' => 'Logo dan nama client yang tampil di website.', 'href' => '/admin/clients', 'count' => count($clients), 'status' => $clientWithLogoCount > 0 ? 'Aktif' : 'Kosong', 'statusClass' => $clientWithLogoCount > 0 ? 'is-complete' : 'is-pending'],
    ['title' => 'Contact', 'description' => 'Alamat, email, telepon, dan jam operasional.', 'href' => '/admin/contact', 'count' => count(array_filter($contact, static fn ($value): bool => trim((string) $value) !== '')), 'status' => trim((string) ($contact['email'] ?? '')) !== '' ? 'Lengkap' : 'Perlu isi', 'statusClass' => trim((string) ($contact['email'] ?? '')) !== '' ? 'is-complete' : 'is-pending'],
    ['title' => 'Blog', 'description' => 'Artikel blog publik yang dikelola admin.', 'href' => '/admin/blog', 'count' => $blogCount, 'status' => $blogCount > 0 ? 'Aktif' : 'Kosong', 'statusClass' => $blogCount > 0 ? 'is-complete' : 'is-pending'],
];
?>
<main class="dashboard-shell dashboard-shell-modern dashboard-shell-dark dashboard-shell-classic">
    <aside class="sidebar dashboard-sidebar-modern dashboard-sidebar-dark dashboard-sidebar-classic">
        <div class="dashboard-brand dashboard-brand-fcom">
            <img src="/public/assets/img/fcom.png" alt="FCOM">
            <div>
                <strong>FCOM CMS</strong>
                <span>Admin dashboard</span>
            </div>
        </div>

        <nav class="sidebar-nav sidebar-nav-dark sidebar-nav-foldered">
            <div class="sidebar-nav-section">
                <span class="sidebar-nav-title">Menu</span>
                <div class="sidebar-nav-list">
                    <?php $isDashboardActive = $activePage === $dashboardItem['key']; ?>
                    <a class="<?= $isDashboardActive ? 'is-active' : '' ?>" href="<?= e($dashboardItem['href']) ?>">
                        <span class="nav-link-main">
                            <span class="nav-icon"><?= $dashboardItem['icon'] ?></span>
                            <span><?= e($dashboardItem['label']) ?></span>
                        </span>
                        <span class="nav-caret" aria-hidden="true">
                            <svg viewBox="0 0 24 24"><path d="M7 10l5 5 5-5z"/></svg>
                        </span>
                    </a>

                    <?php foreach ($navGroups as $group): ?>
                        <div class="sidebar-folder">
                            <div class="sidebar-folder-label">
                                <span class="nav-link-main">
                                    <span class="nav-icon">
                                        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M10 4l2 2h8a2 2 0 012 2v8a4 4 0 01-4 4H6a4 4 0 01-4-4V6a2 2 0 012-2h6z"/></svg>
                                    </span>
                                    <span><?= e($group['label']) ?></span>
                                </span>
                                <span class="nav-caret" aria-hidden="true">
                                    <svg viewBox="0 0 24 24"><path d="M7 10l5 5 5-5z"/></svg>
                                </span>
                            </div>
                            <div class="sidebar-folder-items">
                                <?php foreach ($group['items'] as $item): ?>
                                    <?php $isActive = $activePage === $item['key']; ?>
                                    <a class="sidebar-folder-link <?= $isActive ? 'is-active' : '' ?>" href="<?= e($item['href']) ?>">
                                        <span class="nav-link-main">
                                            <span class="nav-icon"><?= $item['icon'] ?></span>
                                            <span><?= e($item['label']) ?></span>
                                        </span>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="sidebar-nav-section">
                <span class="sidebar-nav-title">Support</span>
                <div class="sidebar-nav-list">
                    <?php foreach ($utilityItems as $item): ?>
                        <?php $isActive = $activePage === $item['key']; ?>
                        <a class="<?= $isActive ? 'is-active' : '' ?>" href="<?= e($item['href']) ?>">
                            <span class="nav-link-main">
                                <span class="nav-icon"><?= $item['icon'] ?></span>
                                <span><?= e($item['label']) ?></span>
                            </span>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </nav>

        <div class="dashboard-user-card">
            <div class="dashboard-user-avatar"><?= e(strtoupper(substr($adminName, 0, 1))) ?></div>
            <div>
                <strong><?= e($adminName) ?></strong>
                <span>Kelola seluruh konten website</span>
            </div>
        </div>
    </aside>

    <section class="dashboard-content dashboard-dark-board dashboard-board-classic">
        <header class="dashboard-dark-topbar dashboard-topbar-classic">
            <div class="dashboard-dark-heading">
                <h1>Dashboard CMS</h1>
                <p>Semua section website bisa diubah admin dari modul CMS di bawah ini.</p>
            </div>
            <div class="dashboard-dark-tools">
                <a class="dashboard-tool-chip" href="/" target="_blank" rel="noreferrer">Preview Website</a>
                <a class="dashboard-tool-primary" href="/admin/company">Mulai Edit</a>
            </div>
        </header>

        <section class="dashboard-dark-kpi-grid">
            <?php foreach ($stats as $index => $item): ?>
                <article class="dashboard-dark-kpi-card">
                    <div class="dashboard-dark-kpi-head">
                        <span><?= e($item['label']) ?></span>
                        <strong><?= e((string) ['C', 'S', 'N', 'A'][$index]) ?></strong>
                    </div>
                    <div class="dashboard-dark-kpi-value"><?= e($item['value']) ?></div>
                    <div class="dashboard-dark-kpi-foot">
                        <span><?= e($item['meta']) ?></span>
                        <small><?= $index === 2 ? '+1.2%' : '+2.8%' ?></small>
                    </div>
                </article>
            <?php endforeach; ?>
        </section>

        <section class="dashboard-panels">
            <article class="dashboard-panel dashboard-panel-lte">
                <div class="panel-head">
                    <div>
                        <h3>Semua Modul CMS</h3>
                        <p>Setiap section website punya halaman edit terpisah seperti CMS.</p>
                    </div>
                </div>
                <div class="status-list">
                    <?php foreach ($cmsSections as $section): ?>
                        <a class="status-item status-item-lte <?= e($section['statusClass']) ?>" href="<?= e($section['href']) ?>">
                            <div>
                                <strong><?= e($section['title']) ?></strong>
                                <p><?= e($section['description']) ?></p>
                            </div>
                            <span><?= e($section['status']) ?></span>
                        </a>
                    <?php endforeach; ?>
                </div>
            </article>

            <article class="dashboard-panel dashboard-sales-panel">
                <div class="panel-head panel-head-dark">
                    <div>
                        <span class="panel-kicker">Quick Access</span>
                        <h3>Edit Section Cepat</h3>
                    </div>
                </div>
                <div class="dashboard-lte-quick-grid">
                    <?php foreach ($cmsSections as $section): ?>
                        <a href="<?= e($section['href']) ?>" class="dashboard-lte-quick-card">
                            <strong><?= e($section['title']) ?></strong>
                            <span><?= e((string) $section['count']) ?> item / field terdeteksi</span>
                        </a>
                    <?php endforeach; ?>
                </div>
            </article>
        </section>

        <section class="snapshot-grid">
            <article class="snapshot-card snapshot-card-lte">
                <span>Company</span>
                <strong><?= e((string) ($company['name'] ?? 'FCOM')) ?></strong>
                <p class="muted"><?= e((string) ($company['tagline'] ?? '-')) ?></p>
            </article>
            <article class="snapshot-card snapshot-card-lte">
                <span>About</span>
                <strong><?= e((string) ($about['title'] ?? '-')) ?></strong>
                <p class="muted">Section profil perusahaan.</p>
            </article>
            <article class="snapshot-card snapshot-card-lte">
                <span>Solutions</span>
                <strong><?= e((string) $solutionCount) ?></strong>
                <p class="muted">Item navigasi dan halaman solusi aktif.</p>
            </article>
            <article class="snapshot-card snapshot-card-lte">
                <span>Clients</span>
                <strong><?= e((string) $clientWithLogoCount) ?></strong>
                <p class="muted">Logo client yang sudah siap tampil.</p>
            </article>
        </section>
    </section>
</main>
