<?php

declare(strict_types=1);

$clientItems = $site['clients']['items'] ?? [];
$profileImage = '/public/assets/img/Fcom%20Company%20Profile%20.png';
$heroWallpaper = '/public/assets/img/wallpaper2.jpg';
$home = $site['home'] ?? [];
$mapEmbedUrl = (string) ($home['map_embed_url'] ?? '');
$rawStages = $site['products']['items'] ?? [];
$stageKeys = ['gather', 'analyze', 'deploy', 'design'];
$problemStages = [];
foreach ($stageKeys as $index => $key) {
    $problemStages[] = [
        'key' => $key,
        'label' => (string) ($rawStages[$index]['name'] ?? ''),
        'title' => (string) ($rawStages[$index]['name'] ?? ''),
        'body' => (string) ($rawStages[$index]['description'] ?? ''),
    ];
}
$defaultStage = $problemStages[1] ?? ($problemStages[0] ?? ['title' => '', 'body' => '']);
?>
<header class="site-header">
    <div class="hero-topbar">
        <div class="nav-tagline"><?= e((string) ($home['nav_tagline'] ?? '')) ?></div>
        <a class="nav-center-brand" href="/" aria-label="<?= e($site['company']['name']) ?>">
            <img src="/public/assets/img/fcom.png" alt="<?= e($site['company']['name']) ?>">
        </a>
        <div class="topbar-actions">
            <nav class="site-desktop-nav" aria-label="Primary navigation">
                <div class="site-desktop-dropdown" data-solutions-dropdown>
                    <button class="site-desktop-link site-desktop-dropdown-toggle" type="button" data-solutions-toggle aria-expanded="false">
                        <?= e((string) ($home['nav_solutions_label'] ?? 'Solutions')) ?>
                    </button>
                    <div class="site-desktop-dropdown-panel" data-solutions-panel>
                        <?php foreach ($site['solutions']['groups'] as $group): ?>
                            <div class="site-desktop-dropdown-group">
                                <h3><?= e($group['title']) ?></h3>
                                <?php foreach ($group['items'] as $item): ?>
                                    <a href="<?= e($item['href']) ?>"><?= e($item['label']) ?></a>
                                <?php endforeach; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <a href="/about" class="site-desktop-link"><?= e((string) ($home['nav_about_label'] ?? 'About Us')) ?></a>
            </nav>
        </div>
    </div>
</header>

<main class="fcom-home">
    <section id="overview" class="hero-panel">
        <div class="hero-photo" style="background-image: url('<?= e($heroWallpaper) ?>');" aria-hidden="true"></div>

        <div class="hero-copy reveal is-visible">
            <div class="hero-cta">
                <a class="hero-primary" href="#clients"><?= e((string) ($home['hero_button_label'] ?? 'Get Started')) ?></a>
            </div>
            <h1><?= e((string) ($home['hero_title'] ?? $site['company']['name'])) ?></h1>
            <p class="hero-lead"><?= e((string) ($home['hero_lead'] ?? '')) ?></p>
            <div class="hero-side-note">
                <p><?= e((string) ($home['hero_side_note'] ?? '')) ?></p>
            </div>
        </div>
    </section>

    <?php if ($clientItems !== []): ?>
        <section id="clients" class="section clients-section clients-section-compact">
            <div class="clients-shell clients-shell-compact reveal">
                <div class="clients-compact-head">
                    <div class="clients-compact-title-group">
                        <h2><?= e((string) ($home['clients_title'] ?? 'Our Clients')) ?></h2>
                    </div>
                </div>
                <div class="clients-compact-marquee" aria-label="Partner logos">
                    <div class="clients-compact-track">
                        <?php foreach ($clientItems as $client): ?>
                            <article class="client-logo-card client-logo-card-compact">
                                <img src="<?= e($client['logo']) ?>" alt="<?= e($client['name']) ?>">
                            </article>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <section id="problems" class="section problem-section">
        <div class="problem-section-shell reveal delay-1">
            <header class="problem-section-head">
                <h2><?= e((string) ($site['products']['title'] ?? $home['stages_title'] ?? '')) ?></h2>
            </header>
            <div class="problem-stage-grid">
            <div class="problem-stage-visual">
                <?php foreach ($problemStages as $stage): ?>
                    <button
                        class="stage-word stage-word-<?= e($stage['key']) ?><?= $stage['key'] === 'analyze' ? ' is-active' : '' ?>"
                        type="button"
                        data-problem-stage
                        data-stage-key="<?= e($stage['key']) ?>"
                        data-stage-title="<?= e($stage['title']) ?>"
                        data-stage-body="<?= e($stage['body']) ?>"
                    >
                        <span class="stage-word-label"><?= e($stage['label']) ?></span>
                        <img src="/public/assets/img/logo1.png" alt="" aria-hidden="true" draggable="false">
                    </button>
                <?php endforeach; ?>
            </div>
            <article class="problem-stage-card" data-problem-panel>
                <div class="problem-stage-card-head" data-problem-title><?= e((string) ($defaultStage['title'] ?? '')) ?></div>
                <div class="problem-stage-card-body" data-problem-body>
                    <?= e((string) ($defaultStage['body'] ?? '')) ?>
                </div>
            </article>
            </div>
        </div>
    </section>

    <section id="location" class="section location-section">
        <div class="location-map-shell">
            <iframe
                src="<?= e($mapEmbedUrl) ?>"
                title="FCOM Location Map"
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
                allowfullscreen
            ></iframe>
        </div>

        <div class="location-footer">
            <div class="location-footer-grid">
                <div class="location-footer-column">
                    <h3><?= e((string) ($home['footer_company_heading'] ?? 'Company')) ?></h3>
                    <a href="/about"><?= e((string) ($home['footer_about_label'] ?? 'About Us')) ?></a>
                    <a href="/about#vision"><?= e((string) ($home['footer_vision_label'] ?? 'Vision')) ?></a>
                    <a href="/about#mission"><?= e((string) ($home['footer_mission_label'] ?? 'Mission')) ?></a>
                </div>
                <div class="location-footer-column">
                    <h3><?= e((string) ($home['footer_support_heading'] ?? 'Contact & Support')) ?></h3>
                    <a href="mailto:<?= e($site['contact']['email']) ?>"><?= e((string) ($home['footer_email_label'] ?? 'Email Us')) ?></a>
                    <a href="tel:<?= e(preg_replace('/\s+/', '', (string) $site['contact']['phone'])) ?>"><?= e($site['contact']['phone']) ?></a>
                    <p><?= e($site['contact']['hours']) ?></p>
                </div>
                <div class="location-footer-column location-footer-column-wide">
                    <h3><?= e($site['company']['name']) ?></h3>
                    <p><?= e($site['contact']['address']) ?></p>
                    <p><a href="mailto:<?= e($site['contact']['email']) ?>"><?= e($site['contact']['email']) ?></a></p>
                </div>
            </div>

            <div class="location-footer-bottom">
                <div class="location-footer-brand">
                    <img src="/public/assets/img/fcom.png" alt="FCOM">
                </div>
                <div class="location-footer-meta">
                    <span>&copy; <?= date('Y') ?> FCOM</span>
                    <span><?= e((string) ($home['footer_contact_label'] ?? 'Contact us')) ?></span>
                    <span><?= e($site['contact']['phone']) ?></span>
                </div>
            </div>
        </div>
    </section>

</main>
