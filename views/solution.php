<?php

declare(strict_types=1);
?>
<header class="site-header site-header-static is-scrolled">
    <div class="hero-topbar">
        <a class="nav-center-brand nav-center-brand-left" href="/" aria-label="<?= e($site['company']['name']) ?>">
            <img src="/public/assets/img/fcom.png" alt="<?= e($site['company']['name']) ?>">
        </a>
        <nav class="site-desktop-nav" aria-label="Primary navigation">
            <a href="/" class="site-desktop-link">Home</a>
            <a href="/about" class="site-desktop-link">About Us</a>
        </nav>
        <div class="topbar-actions">
            <a class="site-desktop-link" href="/#location">Contact</a>
        </div>
    </div>
</header>

<main class="solution-page">
    <section class="solution-hero">
        <div class="solution-hero-shell reveal is-visible">
            <?php if ($solution === null): ?>
                <p class="solution-eyebrow">Solutions</p>
                <h1>Page Not Found</h1>
                <p class="solution-copy">Halaman solusi yang Anda cari belum tersedia atau sudah dipindahkan.</p>
                <a class="solution-back" href="/">Kembali ke Home</a>
            <?php else: ?>
                <p class="solution-eyebrow"><?= e($solution['group_title']) ?></p>
                <h1><?= e($solution['label']) ?></h1>
                <p class="solution-copy"><?= nl2br(e($solution['content'])) ?></p>
                <a class="solution-back" href="/#overview">Kembali ke Home</a>
            <?php endif; ?>
        </div>
    </section>
</main>
