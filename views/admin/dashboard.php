<?php

declare(strict_types=1);

$navItems = [
    [
        'key' => 'dashboard',
        'label' => 'Dashboard',
        'href' => '/admin/dashboard',
        'icon' => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M4 13h7V4H4v9zm9 7h7V4h-7v16zM4 20h7v-5H4v5z"/></svg>',
    ],
    [
        'key' => 'clients',
        'label' => 'Our Client',
        'href' => '/admin/clients',
        'icon' => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M16 11c1.66 0 2.99-1.79 2.99-4S17.66 3 16 3s-3 1.34-3 4 1.34 4 3 4zm-8 0c1.66 0 2.99-1.79 2.99-4S9.66 3 8 3 5 4.34 5 7s1.34 4 3 4zm0 2c-2.33 0-7 1.17-7 3.5V20h14v-3.5C15 14.17 10.33 13 8 13zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.94 1.97 3.45V20h6v-3.5c0-2.33-4.67-3.5-7-3.5z"/></svg>',
    ],
    [
        'key' => 'website',
        'label' => 'Website',
        'href' => '/',
        'icon' => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2a10 10 0 100 20 10 10 0 000-20zm6.93 9h-3.03a15.6 15.6 0 00-1.38-5.01A8.03 8.03 0 0118.93 11zM12 4.06c1.13 1.46 1.94 3.99 2.12 6.94H9.88C10.06 8.05 10.87 5.52 12 4.06zM9.48 5.99A15.6 15.6 0 008.1 11H5.07a8.03 8.03 0 014.41-5.01zM4.26 13H8.1a15.6 15.6 0 001.38 5.01A8.03 8.03 0 014.26 13zm7.74 6.94c-1.13-1.46-1.94-3.99-2.12-6.94h4.24c-.18 2.95-.99 5.48-2.12 6.94zm2.52-1.93A15.6 15.6 0 0015.9 13h3.84a8.03 8.03 0 01-5.22 5.01z"/></svg>',
    ],
    [
        'key' => 'logout',
        'label' => 'Logout',
        'href' => '/admin/logout',
        'icon' => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M10 17l1.41-1.41L8.83 13H20v-2H8.83l2.58-2.59L10 7l-5 5 5 5zm10-14H4a2 2 0 00-2 2v4h2V5h16v14H4v-4H2v4a2 2 0 002 2h16a2 2 0 002-2V5a2 2 0 00-2-2z"/></svg>',
    ],
];

$clients = $site['clients']['items'] ?? [];
$latestClient = $clients[0] ?? null;
$barValues = [35, 48, 39, 56, 52, 61, 44];
$donutSegments = [
    ['label' => 'Logo active', 'value' => 42, 'color' => '#16c47f'],
    ['label' => 'Named entries', 'value' => 28, 'color' => '#f5a623'],
    ['label' => 'Homepage live', 'value' => 20, 'color' => '#1c8cff'],
    ['label' => 'Next module', 'value' => 10, 'color' => '#ff6d4d'],
];
$donutStyle = 'conic-gradient('
    . '#16c47f 0 42%, '
    . '#f5a623 42% 70%, '
    . '#1c8cff 70% 90%, '
    . '#ff6d4d 90% 100%)';
?>
<main class="dashboard-shell dashboard-shell-modern dashboard-shell-dark">
    <aside class="sidebar dashboard-sidebar-modern dashboard-sidebar-dark">
        <div class="dashboard-brand dashboard-brand-fcom">
            <img src="/public/assets/img/fcom.png" alt="FCOM">
            <div>
                <strong>FCOM CMS</strong>
                <span>Admin dashboard</span>
            </div>
        </div>

        <nav class="sidebar-nav sidebar-nav-dark">
            <?php foreach ($navItems as $item): ?>
                <?php $isActive = $activePage === $item['key']; ?>
                <a class="<?= $isActive ? 'is-active' : '' ?>" href="<?= e($item['href']) ?>">
                    <span class="nav-icon"><?= $item['icon'] ?></span>
                    <span><?= e($item['label']) ?></span>
                </a>
            <?php endforeach; ?>
        </nav>

        <div class="dashboard-user-card">
            <div class="dashboard-user-avatar"><?= e(strtoupper(substr($adminName, 0, 1))) ?></div>
            <div>
                <strong><?= e($adminName) ?></strong>
                <span>Kelola section Our Client</span>
            </div>
        </div>
    </aside>

    <section class="dashboard-content dashboard-dark-board">
        <header class="dashboard-dark-topbar">
            <div class="dashboard-dark-heading">
                <h1>Dashboard Admin</h1>
                <p>Pusat kontrol CMS untuk section `Our Client` dan persiapan halaman `Internet of Things`.</p>
            </div>
            <div class="dashboard-dark-tools">
                <a class="dashboard-tool-chip" href="/#clients" target="_blank" rel="noreferrer">Preview</a>
                <a class="dashboard-tool-primary" href="/admin/clients">Manage Client</a>
            </div>
        </header>

        <section class="dashboard-dark-hero-grid">
            <article class="dashboard-dark-hero-card">
                <span class="hero-emoji">👋</span>
                <h2>Hello <?= e($adminName) ?>,</h2>
                <p>Monitor logo client yang aktif, cek progress CMS, dan siapkan struktur konten untuk modul Internet of Things berikutnya.</p>
                <a class="dashboard-hero-button" href="/admin/clients">Start Edit</a>
            </article>

            <article class="dashboard-side-idea-card">
                <div class="panel-head panel-head-dark">
                    <div>
                        <span class="panel-kicker">Next Module</span>
                        <h3>Internet of Things</h3>
                    </div>
                </div>
                <p>Halaman IoT bisa jadi modul CMS berikutnya setelah struktur judul, deskripsi, CTA, dan visual final sudah ditentukan.</p>
                <a class="panel-link-dark" href="/admin/clients">Lanjut Kelola Client</a>
            </article>
        </section>

        <section class="dashboard-dark-kpi-grid">
            <?php foreach ($stats as $index => $item): ?>
                <article class="dashboard-dark-kpi-card">
                    <div class="dashboard-dark-kpi-head">
                        <span><?= e($item['label']) ?></span>
                        <strong><?= e((string) ['O', 'R', 'C', 'N'][$index]) ?></strong>
                    </div>
                    <div class="dashboard-dark-kpi-value"><?= e($item['value']) ?></div>
                    <div class="dashboard-dark-kpi-foot">
                        <span><?= e($item['meta']) ?></span>
                        <small><?= $index === 3 ? '+1.2%' : '+2.8%' ?></small>
                    </div>
                </article>
            <?php endforeach; ?>
        </section>

        <section class="dashboard-dark-main-grid">
            <article class="dashboard-panel dashboard-revenue-panel">
                <div class="panel-head panel-head-dark">
                    <div>
                        <span class="panel-kicker">Overview</span>
                        <h3>Our Client Performance</h3>
                    </div>
                </div>

                <div class="revenue-stat-row">
                    <div class="revenue-stat-box">
                        <span>Total client</span>
                        <strong><?= e((string) count($clients)) ?></strong>
                    </div>
                    <div class="revenue-stat-box">
                        <span>Client terbaru</span>
                        <strong><?= e((string) ($latestClient['name'] ?? 'No data')) ?></strong>
                    </div>
                </div>

                <div class="dark-line-chart">
                    <?php foreach ($barValues as $index => $value): ?>
                        <div class="dark-line-chart-item">
                            <span class="dark-line-chart-bar" style="height: <?= e((string) $value) ?>%"></span>
                            <small><?= e((string) ['MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT', 'SUN'][$index]) ?></small>
                        </div>
                    <?php endforeach; ?>
                </div>
            </article>

            <article class="dashboard-panel dashboard-sales-panel">
                <div class="panel-head panel-head-dark">
                    <div>
                        <span class="panel-kicker">Status</span>
                        <h3>Client Distribution</h3>
                    </div>
                </div>

                <div class="dark-donut-card">
                    <div class="dark-donut" style="--donut-bg: <?= e($donutStyle) ?>">
                        <div class="dark-donut-core">
                            <strong><?= e((string) count($clients)) ?></strong>
                            <span>Entries</span>
                        </div>
                    </div>
                </div>

                <div class="dark-donut-legend">
                    <?php foreach ($donutSegments as $segment): ?>
                        <div class="dark-legend-row">
                            <span class="dark-legend-label">
                                <i style="background: <?= e($segment['color']) ?>"></i>
                                <?= e($segment['label']) ?>
                            </span>
                            <strong><?= e((string) $segment['value']) ?>%</strong>
                        </div>
                    <?php endforeach; ?>
                </div>
            </article>
        </section>
    </section>
</main>
