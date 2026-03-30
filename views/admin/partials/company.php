<?php

declare(strict_types=1);
?>
<div class="cms-card-stack">
    <div class="form-card">
        <h2>Brand</h2>
        <p class="muted">Identitas utama yang tampil di homepage.</p>
        <div class="form-grid">
            <label>Nama Perusahaan
                <input type="text" name="company_name" value="<?= e($site['company']['name']) ?>" required>
            </label>
            <label>Tagline Atas
                <input type="text" name="home_nav_tagline" value="<?= e($site['home']['nav_tagline'] ?? '') ?>" required>
            </label>
        </div>
    </div>

    <div class="form-card">
        <h2>Hero</h2>
        <p class="muted">Konten utama hero section homepage.</p>
        <div class="form-grid">
            <label>Judul Hero
                <input type="text" name="home_hero_title" value="<?= e($site['home']['hero_title'] ?? '') ?>" required>
            </label>
            <label>Label Tombol Hero
                <input type="text" name="home_hero_button_label" value="<?= e($site['home']['hero_button_label'] ?? '') ?>" required>
            </label>
            <label class="full">Hero Lead
                <textarea name="home_hero_lead" rows="3" required><?= e($site['home']['hero_lead'] ?? '') ?></textarea>
            </label>
            <label class="full">Hero Side Note
                <textarea name="home_hero_side_note" rows="4" required><?= e($site['home']['hero_side_note'] ?? '') ?></textarea>
            </label>
        </div>
    </div>
</div>
