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
            <a href="/blog" class="site-desktop-link">Blog</a>
        </nav>
        <div class="topbar-actions">
            <a class="site-desktop-link" href="/blog">Kembali ke Blog</a>
        </div>
    </div>
</header>

<main class="blog-detail-page">
    <section class="blog-detail-shell">
        <?php if ($article === null): ?>
            <p class="solution-eyebrow">Blog</p>
            <h1>Artikel Tidak Ditemukan</h1>
            <p class="blog-detail-copy">Artikel yang Anda cari belum tersedia atau sudah dipindahkan.</p>
            <a class="solution-back" href="/blog">Kembali ke Blog</a>
        <?php else: ?>
            <p class="solution-eyebrow">Blog</p>
            <h1><?= e($article['title']) ?></h1>
            <div class="blog-detail-meta"><?= e(date('d M Y', strtotime((string) $article['published_at']))) ?></div>
            <div class="blog-detail-media">
                <img src="<?= e($article['image']) ?>" alt="<?= e($article['title']) ?>">
            </div>
            <p class="blog-detail-copy"><?= nl2br(e((string) $article['content'])) ?></p>
            <a class="solution-back" href="/blog">Kembali ke Blog</a>
        <?php endif; ?>
    </section>
</main>
