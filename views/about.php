<?php

declare(strict_types=1);
?>
<header class="site-header site-header-about">
    <div class="hero-topbar">
        <div class="nav-tagline">Your Trusted IT Partner</div>
        <a class="nav-center-brand" href="/" aria-label="<?= e($site['company']['name']) ?>">
            <img src="/public/assets/img/fcom.png" alt="<?= e($site['company']['name']) ?>">
        </a>
        <div class="topbar-actions">
            <nav class="site-desktop-nav" aria-label="Primary navigation">
                <div class="site-desktop-dropdown" data-solutions-dropdown>
                    <button class="site-desktop-link site-desktop-dropdown-toggle" type="button" data-solutions-toggle aria-expanded="false">
                        Solutions
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
                <a href="/about" class="site-desktop-link">About Us</a>
            </nav>
        </div>
    </div>
</header>

<main class="fcom-home about-page">
    <section id="vision" class="section statement-section statement-section-combined">
        <div class="statement-combined-shell reveal is-visible">
            <article class="statement-combined-panel statement-combined-panel-vision">
                <div class="statement-combined-icon statement-combined-icon-eye" aria-hidden="true"></div>
                <p class="statement-combined-eyebrow">Our</p>
                <h2>Vision</h2>
                <p class="statement-combined-copy">Menyediakan solusi IT untuk membantu bisnis di Indonesia menuju era digital.</p>
                <div class="statement-combined-detail-list statement-combined-detail-list-vision">
                    <article class="statement-detail-item">
                        <span class="statement-detail-icon statement-detail-icon-audience" aria-hidden="true"></span>
                        <div class="statement-detail-copy">
                            <h3>Target Audience</h3>
                            <p>Perusahaan dan pelaku bisnis di Indonesia.</p>
                        </div>
                    </article>
                    <article class="statement-detail-item">
                        <span class="statement-detail-icon statement-detail-icon-goal" aria-hidden="true"></span>
                        <div class="statement-detail-copy">
                            <h3>Goal</h3>
                            <p>Membantu perusahaan dan bisnis beralih ke teknologi dan sistem digital.</p>
                        </div>
                    </article>
                    <article class="statement-detail-item">
                        <span class="statement-detail-icon statement-detail-icon-focus" aria-hidden="true"></span>
                        <div class="statement-detail-copy">
                            <h3>Focus</h3>
                            <p>Menyediakan solusi IT yang mendukung dan mempermudah transformasi digital.</p>
                        </div>
                    </article>
                </div>
            </article>

            <article id="mission" class="statement-combined-panel statement-combined-panel-mission">
                <div class="statement-combined-icon statement-combined-icon-target" aria-hidden="true"></div>
                <p class="statement-combined-eyebrow">Our</p>
                <h2>Mission</h2>
                <p class="statement-combined-copy">Menyederhanakan kompleksitas IT</p>
                <div class="statement-combined-detail-list">
                    <article class="statement-detail-item">
                        <span class="statement-detail-icon statement-detail-icon-objective" aria-hidden="true"></span>
                        <div class="statement-detail-copy">
                            <h3>Objective</h3>
                            <p>Mengurangi kesulitan dalam pengelolaan teknologi informasi.</p>
                        </div>
                    </article>
                    <article class="statement-detail-item">
                        <span class="statement-detail-icon statement-detail-icon-approach" aria-hidden="true"></span>
                        <div class="statement-detail-copy">
                            <h3>Approach</h3>
                            <p>Berfokus pada penyederhanaan proses dan teknologi IT agar lebih mudah dipahami dan dikelola.</p>
                        </div>
                    </article>
                    <article class="statement-detail-item">
                        <span class="statement-detail-icon statement-detail-icon-benefit" aria-hidden="true"></span>
                        <div class="statement-detail-copy">
                            <h3>Benefit</h3>
                            <p>Membantu bisnis menghadapi tantangan IT secara lebih efisien dan efektif.</p>
                        </div>
                    </article>
                </div>
            </article>
        </div>
    </section>

    <section class="section location-section">
        <div class="location-footer">
            <div class="location-footer-grid">
                <div class="location-footer-column">
                    <h3>Company</h3>
                    <a href="/about">About Us</a>
                    <a href="/about#vision">Vision</a>
                    <a href="/about#mission">Mission</a>
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
