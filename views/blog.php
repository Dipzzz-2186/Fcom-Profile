<?php

declare(strict_types=1);

$articles = $site['blog']['items'] ?? [];

usort($articles, static fn (array $left, array $right): int => strcmp((string) ($right['published_at'] ?? ''), (string) ($left['published_at'] ?? '')));

$featured = null;
foreach ($articles as $item) {
    if (($item['is_featured'] ?? false) === true) {
        $featured = $item;
        break;
    }
}

if ($featured === null) {
    $featured = $articles[0] ?? null;
}

$popular = array_values(array_filter(
    $articles,
    static fn (array $item): bool => (($item['is_popular'] ?? false) === true) && (($item['slug'] ?? '') !== ($featured['slug'] ?? ''))
));

if ($popular === []) {
    $popular = array_values(array_filter(
        $articles,
        static fn (array $item): bool => ($item['slug'] ?? '') !== ($featured['slug'] ?? '')
    ));
}

$latest = array_values(array_filter(
    $articles,
    static fn (array $item): bool => ($item['slug'] ?? '') !== ($featured['slug'] ?? '')
));
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
            <a class="site-desktop-link" href="/#location">Contact</a>
        </div>
    </div>
</header>

<main class="blog-page">
    <section class="blog-shell">
        <div class="blog-heading">
            <h1>BLOG</h1>
        </div>

        <?php if ($featured !== null): ?>
            <section class="blog-block">
                <h2>Artikel Terpopuler</h2>
                <div class="blog-featured-layout">
                    <a class="blog-featured-card" href="/blog/<?= e($featured['slug']) ?>">
                        <div class="blog-featured-media">
                            <img src="<?= e($featured['image']) ?>" alt="<?= e($featured['title']) ?>">
                        </div>
                        <div class="blog-featured-copy">
                            <h3><?= e($featured['title']) ?></h3>
                            <p><?= e($featured['excerpt']) ?></p>
                        </div>
                    </a>

                    <aside class="blog-popular-list">
                        <?php foreach (array_slice($popular, 0, 5) as $item): ?>
                            <a class="blog-popular-item" href="/blog/<?= e($item['slug']) ?>">
                                <img src="<?= e($item['image']) ?>" alt="<?= e($item['title']) ?>">
                                <span><?= e($item['title']) ?></span>
                            </a>
                        <?php endforeach; ?>
                    </aside>
                </div>
            </section>
        <?php endif; ?>

        <section class="blog-block">
            <h2>Artikel Terbaru</h2>
            <div class="blog-latest-grid">
                <?php foreach (array_slice($latest, 0, 8) as $item): ?>
                    <a class="blog-latest-card" href="/blog/<?= e($item['slug']) ?>">
                        <div class="blog-latest-media">
                            <img src="<?= e($item['image']) ?>" alt="<?= e($item['title']) ?>">
                        </div>
                        <div class="blog-latest-copy">
                            <h3><?= e($item['title']) ?></h3>
                            <p><?= e($item['excerpt']) ?></p>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </section>
    </section>
</main>
