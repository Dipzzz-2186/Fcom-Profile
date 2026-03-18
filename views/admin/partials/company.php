<?php

declare(strict_types=1);
?>
<div class="form-card">
    <h2>Informasi Utama</h2>
    <div class="form-grid">
        <label>Nama Perusahaan
            <input type="text" name="company_name" value="<?= e($site['company']['name']) ?>" required>
        </label>
        <label>Tagline
            <input type="text" name="company_tagline" value="<?= e($site['company']['tagline']) ?>" required>
        </label>
        <label class="full">Headline
            <input type="text" name="company_headline" value="<?= e($site['company']['headline']) ?>" required>
        </label>
        <label class="full">Deskripsi
            <textarea name="company_description" rows="4" required><?= e($site['company']['description']) ?></textarea>
        </label>
        <label>Tahun Pengalaman
            <input type="text" name="company_years" value="<?= e($site['company']['years']) ?>" required>
        </label>
        <label>Total Project
            <input type="text" name="company_projects" value="<?= e($site['company']['projects']) ?>" required>
        </label>
        <label>Total Klien
            <input type="text" name="company_clients" value="<?= e($site['company']['clients']) ?>" required>
        </label>
    </div>
</div>
