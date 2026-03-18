<?php

declare(strict_types=1);

$heroImage = '/public/assets/img/Fcom%20Company%20Profile%20.png';
$heroCards = array_slice($site['products']['items'], 0, 3);
$heroSignals = array_slice($site['advantages']['items'], 0, 4);
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
            <a href="#technology">Technology</a>
            <a href="#testimonials">Testimonials</a>
            <a href="#resources">Resources</a>
        </nav>
        <div class="topbar-actions">
            <a class="ghost-action" href="/admin/login">Log In</a>
            <a class="solid-action" href="#kontak">Get Started</a>
        </div>
    </div>
</header>

<main class="fcom-home">
    <section id="overview" class="hero-panel">
        <div class="hero-noise"></div>
        <div class="hero-arc hero-arc-top"></div>
        <div class="hero-arc hero-arc-bottom"></div>

        <div class="hero-network hero-network-left" aria-hidden="true">
            <span class="network-node node-top">FC</span>
            <span class="network-node node-bottom">CM</span>
        </div>
        <div class="hero-network hero-network-right" aria-hidden="true">
            <span class="network-node node-top">PR</span>
            <span class="network-node node-bottom">AI</span>
        </div>

        <div class="hero-copy reveal is-visible">
            <span class="hero-badge">FCOM Company Profile</span>
            <div class="hero-visual-shell">
                <div class="hero-visual">
                    <div class="hero-visual-glow"></div>
                    <img src="<?= e($heroImage) ?>" alt="Fcom Company Profile">
                    <span class="hero-visual-pill">FCOM</span>
                </div>
            </div>
            <h1><?= e($site['company']['headline']) ?></h1>
            <p class="hero-lead"><?= e($site['company']['description']) ?></p>
            <div class="hero-cta">
                <a class="hero-primary" href="#layanan">Schedule Demo</a>
                <a class="hero-secondary" href="#tentang">Learn More</a>
            </div>
            <p class="hero-caption">Company presence built to earn trust from clients, partners, and investors.</p>
        </div>

        <div class="signal-grid reveal">
            <?php foreach ($heroSignals as $signal): ?>
                <article class="signal-card">
                    <span></span>
                    <p><?= e($signal) ?></p>
                </article>
            <?php endforeach; ?>
        </div>

        <div class="hero-stats reveal delay-1">
            <article class="hero-stat">
                <span>Years Active</span>
                <strong data-count="<?= e($site['company']['years']) ?>"><?= e($site['company']['years']) ?></strong>
            </article>
            <article class="hero-stat">
                <span>Projects</span>
                <strong data-count="<?= e($site['company']['projects']) ?>"><?= e($site['company']['projects']) ?></strong>
            </article>
            <article class="hero-stat">
                <span>Clients</span>
                <strong data-count="<?= e($site['company']['clients']) ?>"><?= e($site['company']['clients']) ?></strong>
            </article>
        </div>

        <div class="hero-card-row reveal delay-1">
            <?php foreach ($heroCards as $item): ?>
                <article class="hero-mini-card">
                    <div class="card-icon">&#8599;</div>
                    <h2><?= e($item['name']) ?></h2>
                    <p><?= e($item['description']) ?></p>
                </article>
            <?php endforeach; ?>
        </div>
    </section>

    <section id="technology" class="section intro-section">
        <div class="section-head reveal">
            <span class="section-label">Technology</span>
            <h2>Presentasi bisnis yang rapi, modern, dan terasa premium sejak first impression.</h2>
            <p>Halaman ini disusun untuk menonjolkan struktur informasi, visual yang lebih tajam, dan company presence yang siap dipakai untuk pitch, partner meeting, atau showcase brand.</p>
        </div>
        <div class="intro-grid">
            <article class="intro-card reveal">
                <span>Identity</span>
                <h3><?= e($site['about']['title']) ?></h3>
                <p><?= e($site['about']['content']) ?></p>
            </article>
            <article class="intro-card reveal delay-1">
                <span>Value</span>
                <h3>Build trust through clarity</h3>
                <p>Visual yang bersih dan storytelling yang terstruktur membantu FCOM tampil lebih meyakinkan di mata calon klien.</p>
            </article>
        </div>
    </section>

    <section id="layanan" class="section services-section">
        <div class="section-head reveal">
            <span class="section-label">Overview</span>
            <h2><?= e($site['products']['title']) ?></h2>
            <p>Layanan utama ditampilkan dalam format card agar cepat dipahami tanpa kehilangan kesan premium.</p>
        </div>
        <div class="services-grid">
            <?php foreach ($site['products']['items'] as $index => $item): ?>
                <article class="service-card reveal<?= $index > 1 ? ' delay-1' : '' ?>">
                    <span class="service-index"><?= e(str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT)) ?></span>
                    <h3><?= e($item['name']) ?></h3>
                    <p><?= e($item['description']) ?></p>
                    <a href="#kontak">Consult Now</a>
                </article>
            <?php endforeach; ?>
        </div>
    </section>

    <section id="testimonials" class="section story-section">
        <div class="story-grid">
            <article class="story-card reveal">
                <span class="section-label">Testimonials</span>
                <h2>Company profile yang terasa siap tampil di level yang lebih serius.</h2>
                <p><?= e($site['company']['description']) ?></p>
            </article>
            <div class="story-points">
                <article class="story-point reveal">
                    <strong>Terstruktur</strong>
                    <p>Alur baca dibuat ringkas sehingga calon klien cepat menangkap inti bisnis dan layanan FCOM.</p>
                </article>
                <article class="story-point reveal delay-1">
                    <strong>Meyakinkan</strong>
                    <p>Tampilan visual diarahkan agar brand terasa lebih matang, profesional, dan tidak generik.</p>
                </article>
                <article class="story-point reveal delay-1">
                    <strong>Scalable</strong>
                    <p>Fondasi desainnya mudah diperluas ke portfolio, studi kasus, atau halaman produk yang lebih detail.</p>
                </article>
            </div>
        </div>
    </section>

    <section id="resources" class="section resources-section">
        <div class="section-head reveal">
            <span class="section-label">Resources</span>
            <h2><?= e($site['advantages']['title']) ?></h2>
        </div>
        <div class="resource-grid reveal delay-1">
            <?php foreach ($site['advantages']['items'] as $advantage): ?>
                <article class="resource-card">
                    <span></span>
                    <p><?= e($advantage) ?></p>
                </article>
            <?php endforeach; ?>
        </div>
    </section>

    <section id="proses" class="section process-section">
        <div class="section-head reveal">
            <span class="section-label">Process</span>
            <h2>Cara kerja yang ringkas, sistematis, dan mudah dikembangkan.</h2>
        </div>
        <div class="process-grid">
            <article class="process-card reveal">
                <strong>01</strong>
                <h3>Analisis</h3>
                <p>Memahami target audiens, tujuan presentasi, dan posisi brand yang ingin ditampilkan.</p>
            </article>
            <article class="process-card reveal delay-1">
                <strong>02</strong>
                <h3>Structure</h3>
                <p>Menyusun urutan konten yang paling kuat agar halaman terasa fokus dan tidak berantakan.</p>
            </article>
            <article class="process-card reveal">
                <strong>03</strong>
                <h3>Visual</h3>
                <p>Menggabungkan identitas FCOM dengan layout yang lebih modern, gelap, dan berkelas.</p>
            </article>
            <article class="process-card reveal delay-1">
                <strong>04</strong>
                <h3>Refinement</h3>
                <p>Merapikan detail interaksi, keterbacaan, dan kesiapan konten untuk ekspansi berikutnya.</p>
            </article>
        </div>
    </section>

    <section id="kontak" class="section contact-section">
        <div class="contact-shell reveal">
            <div>
                <span class="section-label">Get Started</span>
                <h2>Mari bangun company profile yang lebih kuat untuk FCOM.</h2>
                <p>Kalau arah visual ini sudah sesuai, tahap berikutnya bisa dilanjutkan ke halaman detail layanan, portfolio, atau versi CMS yang lebih lengkap.</p>
            </div>
            <div class="contact-meta">
                <p><strong>Alamat</strong><span><?= e($site['contact']['address']) ?></span></p>
                <p><strong>Email</strong><span><?= e($site['contact']['email']) ?></span></p>
                <p><strong>Telepon</strong><span><?= e($site['contact']['phone']) ?></span></p>
                <p><strong>Jam Operasional</strong><span><?= e($site['contact']['hours']) ?></span></p>
            </div>
        </div>
    </section>
</main>
