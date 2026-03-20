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

$adminName = (string) ($_SESSION['admin_username'] ?? 'Admin');
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
        <header class="dashboard-dark-topbar admin-page-topbar">
            <div class="dashboard-dark-heading">
                <h1><?= e($pageTitle) ?></h1>
                <p><?= e($pageDescription) ?></p>
            </div>
            <div class="dashboard-dark-tools">
                <a class="dashboard-tool-chip" href="/#clients" target="_blank" rel="noreferrer">Preview</a>
                <a class="dashboard-tool-primary" href="/admin/clients">Manage Client</a>
            </div>
        </header>

        <?php if ($message !== null): ?>
            <div class="alert success admin-alert-dark"><?= e($message) ?></div>
        <?php endif; ?>

        <form method="post" enctype="multipart/form-data" class="cms-form cms-form-dark">
            <?php require BASE_PATH . '/views/admin/partials/' . $formPartial . '.php'; ?>
            <div class="admin-form-actions">
                <button class="save-button save-button-dark" type="submit">Simpan Perubahan</button>
            </div>
        </form>
    </section>
</main>
