<?php

declare(strict_types=1);

$heroCards = array_slice($site['products']['items'], 0, 3);
$heroSignals = array_slice($site['advantages']['items'], 0, 3);
$clientItems = $site['clients']['items'] ?? [];
$clientPreviewCount = min(4, count($clientItems));
$profileImage = '/public/assets/img/Fcom%20Company%20Profile%20.png';
$heroWallpaper = '/public/assets/img/wallpaper2.jpg';
$mapEmbedUrl = 'https://www.google.com/maps?q=PT.%20Fcom%20Inti%20Teknologi%2C%20Jl.%20Tanjung%20Duren%20Barat%203%20No.%2012b%2C%20Jakarta%20Barat&output=embed';
$problemStages = [
    [
        'key' => 'gather',
        'label' => 'Gather',
        'title' => 'Gather',
        'body' => 'Mengumpulkan informasi bisnis, hambatan operasional, dan kebutuhan utama agar arah solusi yang dibangun benar-benar relevan.',
    ],
    [
        'key' => 'analyze',
        'label' => 'Analyze',
        'title' => 'Analyze',
        'body' => 'Informasi yang terkumpul dianalisis secara menyeluruh untuk menyusun rencana solusi IT yang tepat bagi kebutuhan bisnis Anda.',
    ],
    [
        'key' => 'deploy',
        'label' => 'Deploy',
        'title' => 'Deploy',
        'body' => 'Solusi yang sudah dirancang diterapkan secara terstruktur agar proses implementasi berjalan efisien dan minim gangguan.',
    ],
    [
        'key' => 'design',
        'label' => 'Design',
        'title' => 'Design',
        'body' => 'Merancang struktur solusi, alur sistem, dan pengalaman penggunaan agar teknologi yang dibangun mudah dipakai dan dikembangkan.',
    ],
];
?>
<header class="site-header">
    <div class="hero-topbar">
        <div class="nav-tagline">Your Trusted IT Partner</div>
        <a class="nav-center-brand" href="/" aria-label="<?= e($site['company']['name']) ?>">
            <img src="/public/assets/img/fcom.png" alt="<?= e($site['company']['name']) ?>">
        </a>
        <div class="topbar-actions">
            <button class="menu-toggle" type="button" data-menu-toggle aria-expanded="false" aria-controls="site-sidebar">
                <strong>Menu</strong>
            </button>
        </div>
    </div>
</header>

<aside class="site-sidebar" id="site-sidebar" data-site-sidebar aria-hidden="true">
    <div class="site-sidebar-panel">
        <div class="site-sidebar-head">
            <p>Navigation</p>
            <button class="site-sidebar-close" type="button" data-menu-close aria-label="Close menu">Close</button>
        </div>
        <nav class="site-sidebar-nav">
            <a href="#overview">Overview</a>
            <a href="#vision">Vision</a>
            <a href="#mission">Mission</a>
            <button class="site-sidebar-group-toggle" type="button" data-sidebar-solutions-toggle aria-expanded="false">Solutions</button>
            <div class="site-sidebar-solutions" data-sidebar-solutions>
                <?php foreach ($site['solutions']['groups'] as $group): ?>
                    <div class="site-sidebar-group">
                        <h3><?= e($group['title']) ?></h3>
                        <?php foreach ($group['items'] as $item): ?>
                            <a href="<?= e($item['href']) ?>"><?= e($item['label']) ?></a>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            </div>
            <a href="#clients">Clients</a>
            <a href="#problems">Process</a>
        </nav>
    </div>
</aside>

<main class="fcom-home">
    <section id="overview" class="hero-panel">
        <div class="hero-photo" style="background-image: url('<?= e($heroWallpaper) ?>');" aria-hidden="true"></div>

        <div class="hero-copy reveal is-visible">
            <div class="hero-cta">
                <a class="hero-primary" href="#vision">Get Started</a>
            </div>
            <h1>FCOM</h1>
            <p class="hero-lead">Integrated technology solutions for businesses ready to move faster.</p>
            <div class="hero-side-note">
                <p>Empowering businesses through integrated technology solutions that are practical, modern, and ready to scale.</p>
            </div>
        </div>
    </section>

    <?php if ($clientItems !== []): ?>
        <section id="clients" class="section clients-section clients-section-compact">
            <div class="clients-shell clients-shell-compact reveal">
                <div class="clients-compact-head">
                    <div class="clients-compact-title-group">
                        <p>Big companies that have partnered with us</p>
                    </div>
                    <span class="clients-compact-count"><?= str_pad((string) $clientPreviewCount, 2, '0', STR_PAD_LEFT) ?> of <?= str_pad((string) count($clientItems), 2, '0', STR_PAD_LEFT) ?> Partner</span>
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

    <section id="vision" class="section statement-section statement-section-vision">
        <div class="statement-shell reveal">
            <div class="statement-media">
                <img src="<?= e($profileImage) ?>" alt="FCOM Company Profile">
            </div>
            <div class="statement-body">
                <div class="statement-brand">
                    <img src="/public/assets/img/fcom.png" alt="FCOM">
                </div>
                <p class="statement-eyebrow">Our Vision</p>
                <h2>Vision</h2>
                <p class="statement-lead">Menjadi partner teknologi yang membantu bisnis di Indonesia beradaptasi, tumbuh, dan bergerak lebih siap di era digital.</p>
                <div class="statement-accent" aria-hidden="true"></div>
                <div class="statement-points">
                    <article>
                        <h3>Target Audience</h3>
                        <p>Perusahaan dan pelaku bisnis di Indonesia yang ingin memperkuat sistem kerja dan transformasi digitalnya.</p>
                    </article>
                    <article>
                        <h3>Goal</h3>
                        <p>Mendorong bisnis beralih ke teknologi dan sistem digital yang lebih efisien, relevan, dan mudah dijalankan.</p>
                    </article>
                    <article>
                        <h3>Focus</h3>
                        <p>Menyediakan solusi IT yang praktis, terarah, dan benar-benar mendukung proses transformasi digital.</p>
                    </article>
                </div>
            </div>
        </div>
    </section>

    <section id="mission" class="section statement-section statement-section-mission">
        <div class="statement-shell statement-shell-reverse reveal">
            <div class="statement-media">
                <img src="<?= e($profileImage) ?>" alt="FCOM Company Profile">
            </div>
            <div class="statement-body">
                <div class="statement-brand">
                    <img src="/public/assets/img/fcom.png" alt="FCOM">
                </div>
                <p class="statement-eyebrow">Our Mission</p>
                <h2>Missions</h2>
                <p class="statement-lead">Menyederhanakan kompleksitas IT agar perusahaan dapat bergerak lebih cepat dan efisien.</p>
                <div class="statement-points statement-points-single">
                    <article>
                        <h3>Objective</h3>
                        <p>Mengurangi kesulitan dalam pengelolaan teknologi informasi.</p>
                    </article>
                    <article>
                        <h3>Approach</h3>
                        <p>Berfokus pada penyederhanaan proses dan teknologi IT agar lebih mudah dipahami dan dikelola.</p>
                    </article>
                    <article>
                        <h3>Benefit</h3>
                        <p>Membantu bisnis menghadapi tantangan IT secara lebih efisien dan efektif.</p>
                    </article>
                </div>
            </div>
        </div>
    </section>

    <section id="problems" class="section problem-section">
        <div class="problem-stage-grid reveal delay-1">
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
                        <img src="/public/assets/img/logo1.png" alt="" aria-hidden="true">
                    </button>
                <?php endforeach; ?>
            </div>
            <article class="problem-stage-card" data-problem-panel>
                <div class="problem-stage-card-head" data-problem-title>Analyze</div>
                <div class="problem-stage-card-body" data-problem-body>
                    Informasi yang terkumpul dianalisis secara menyeluruh untuk menyusun rencana solusi IT yang tepat bagi kebutuhan bisnis Anda.
                </div>
            </article>
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
                    <h3>Company</h3>
                    <a href="#overview">About Us</a>
                    <a href="#vision">Vision</a>
                    <a href="#mission">Mission</a>
                </div>
                <div class="location-footer-column">
                    <h3>Contact &amp; Support</h3>
                    <a href="mailto:<?= e($site['contact']['email']) ?>">Email Us</a>
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
                    <span>Contact us</span>
                    <span><?= e($site['contact']['phone']) ?></span>
                </div>
            </div>
        </div>
    </section>

</main>
