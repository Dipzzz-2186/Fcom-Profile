<?php

declare(strict_types=1);

$heroCards = array_slice($site['products']['items'], 0, 3);
$heroSignals = array_slice($site['advantages']['items'], 0, 3);
$profileImage = '/public/assets/img/Fcom%20Company%20Profile%20.png';
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
        <a class="brand-mark" href="/" aria-label="<?= e($site['company']['name']) ?>">
            <img src="/public/assets/img/fcom.png" alt="<?= e($site['company']['name']) ?>">
        </a>
        <nav class="nav">
            <a href="#overview">Overview</a>
            <div class="nav-item nav-item-has-dropdown">
                <button class="nav-link-button" type="button" data-solutions-toggle aria-expanded="false">Solutions</button>
                <div class="solutions-dropdown" data-solutions-menu>
                    <div class="solutions-dropdown-grid">
                        <?php foreach ($site['solutions']['groups'] as $group): ?>
                            <div class="solutions-group">
                                <h3><?= e($group['title']) ?></h3>
                                <?php foreach ($group['items'] as $item): ?>
                                    <a href="<?= e($item['href']) ?>"><?= e($item['label']) ?></a>
                                <?php endforeach; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </nav>
        <div class="topbar-actions">
            <a class="solid-action" href="#vision">Get Started</a>
        </div>
    </div>
</header>

<main class="fcom-home">
    <section id="overview" class="hero-panel">
        <div class="hero-noise"></div>
        <div class="hero-arc hero-arc-top"></div>
        <div class="hero-arc hero-arc-bottom"></div>
        <div class="hero-grid-lines" aria-hidden="true"></div>

        <div class="hero-copy reveal is-visible">
            <h1>Your Trusted IT Partner</h1>
            <p class="hero-lead">Empowering Businesses Through Integrated Technology Solutions</p>
            <div class="hero-cta">
                <a class="hero-primary" href="#vision">Get Started</a>
            </div>
        </div>
    </section>

    <section id="vision" class="section statement-section statement-section-vision">
        <div class="statement-shell reveal">
            <div class="statement-media">
                <img src="<?= e($profileImage) ?>" alt="FCOM team collaboration">
            </div>
            <div class="statement-body">
                <div class="statement-brand">
                    <img src="/public/assets/img/fcom.png" alt="FCOM">
                </div>
                <h2>Vision</h2>
                <p class="statement-lead">Menyediakan solusi IT untuk membantu bisnis di Indonesia menuju era digital.</p>
                <div class="statement-accent" aria-hidden="true"></div>
                <div class="statement-points">
                    <article>
                        <h3>Target Audience</h3>
                        <p>Perusahaan dan pelaku bisnis di Indonesia.</p>
                    </article>
                    <article>
                        <h3>Goal</h3>
                        <p>Membantu perusahaan dan bisnis beralih ke teknologi dan sistem digital.</p>
                    </article>
                    <article>
                        <h3>Focus</h3>
                        <p>Menyediakan solusi IT yang mendukung dan mempermudah transformasi digital.</p>
                    </article>
                </div>
            </div>
        </div>
    </section>

    <section id="mission" class="section statement-section statement-section-mission">
        <div class="statement-shell statement-shell-reverse reveal">
            <div class="statement-body">
                <div class="statement-brand">
                    <img src="/public/assets/img/fcom.png" alt="FCOM">
                </div>
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
            <div class="statement-media statement-media-angled">
                <div class="statement-angle statement-angle-top" aria-hidden="true"></div>
                <img src="<?= e($profileImage) ?>" alt="FCOM technical support">
                <div class="statement-angle statement-angle-bottom" aria-hidden="true"></div>
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

    <?php if (($site['clients']['items'] ?? []) !== []): ?>
        <section id="clients" class="section clients-section">
            <div class="clients-shell reveal">
                <div class="section-head clients-head">
                    <h2>Our Client</h2>
                    <p>Kepercayaan dari berbagai partner dan client yang telah bekerja bersama FCOM.</p>
                </div>
                <div class="clients-marquee">
                    <div class="clients-track">
                        <?php for ($loop = 0; $loop < 2; $loop++): ?>
                            <?php foreach ($site['clients']['items'] as $client): ?>
                                <article class="client-logo-card">
                                    <img src="<?= e($client['logo']) ?>" alt="<?= e($client['name']) ?>">
                                </article>
                            <?php endforeach; ?>
                        <?php endfor; ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>
</main>
