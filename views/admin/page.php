<?php

declare(strict_types=1);

$navItems = [
    'company' => ['label' => 'Company', 'href' => '/admin/company'],
    'about' => ['label' => 'About', 'href' => '/admin/about'],
    'services' => ['label' => 'Services', 'href' => '/admin/services'],
    'navigation' => ['label' => 'Navigation', 'href' => '/admin/navigation'],
    'advantages' => ['label' => 'Advantages', 'href' => '/admin/advantages'],
    'clients' => ['label' => 'Clients', 'href' => '/admin/clients'],
    'contact' => ['label' => 'Contact', 'href' => '/admin/contact'],
];
?>
<main class="dashboard-shell">
    <aside class="sidebar">
        <div>
            <span class="admin-badge">FCOM CMS</span>
            <h1>Dashboard Admin</h1>
            <p>Kelola konten website per bagian agar lebih rapi dan fokus.</p>
        </div>
        <nav class="sidebar-nav">
            <?php foreach ($navItems as $key => $item): ?>
                <a class="<?= $activePage === $key ? 'is-active' : '' ?>" href="<?= e($item['href']) ?>"><?= e($item['label']) ?></a>
            <?php endforeach; ?>
        </nav>
        <div class="sidebar-links">
            <a href="/" target="_blank" rel="noreferrer">Lihat Website</a>
            <a href="/admin/logout">Logout</a>
        </div>
    </aside>

    <section class="dashboard-content">
        <div class="dashboard-header">
            <div>
                <h2><?= e($pageTitle) ?></h2>
                <p class="muted"><?= e($pageDescription) ?></p>
            </div>
            <?php if ($message !== null): ?>
                <div class="alert success"><?= e($message) ?></div>
            <?php endif; ?>
        </div>

        <form method="post" enctype="multipart/form-data" class="cms-form">
            <?php require BASE_PATH . '/views/admin/partials/' . $formPartial . '.php'; ?>
            <button class="save-button" type="submit">Simpan Perubahan</button>
        </form>
    </section>
</main>
