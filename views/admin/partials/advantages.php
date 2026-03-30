<?php

declare(strict_types=1);
?>
<div class="cms-card-stack">
    <div class="form-card">
        <h2>Navbar Labels</h2>
        <div class="form-grid">
            <label>Label Menu Solutions
                <input type="text" name="home_nav_solutions_label" value="<?= e($site['home']['nav_solutions_label'] ?? '') ?>" required>
            </label>
            <label>Label Menu About
                <input type="text" name="home_nav_about_label" value="<?= e($site['home']['nav_about_label'] ?? '') ?>" required>
            </label>
            <label>Judul Section Clients
                <input type="text" name="home_clients_title" value="<?= e($site['home']['clients_title'] ?? '') ?>" required>
            </label>
        </div>
    </div>

    <div class="form-card">
        <h2>Footer Labels</h2>
        <div class="form-grid">
            <label>Judul Footer Kolom Company
                <input type="text" name="home_footer_company_heading" value="<?= e($site['home']['footer_company_heading'] ?? '') ?>" required>
            </label>
            <label>Label Link About
                <input type="text" name="home_footer_about_label" value="<?= e($site['home']['footer_about_label'] ?? '') ?>" required>
            </label>
            <label>Label Link Vision
                <input type="text" name="home_footer_vision_label" value="<?= e($site['home']['footer_vision_label'] ?? '') ?>" required>
            </label>
            <label>Label Link Mission
                <input type="text" name="home_footer_mission_label" value="<?= e($site['home']['footer_mission_label'] ?? '') ?>" required>
            </label>
            <label>Judul Footer Support
                <input type="text" name="home_footer_support_heading" value="<?= e($site['home']['footer_support_heading'] ?? '') ?>" required>
            </label>
            <label>Label Email Footer
                <input type="text" name="home_footer_email_label" value="<?= e($site['home']['footer_email_label'] ?? '') ?>" required>
            </label>
            <label>Label Contact Footer
                <input type="text" name="home_footer_contact_label" value="<?= e($site['home']['footer_contact_label'] ?? '') ?>" required>
            </label>
        </div>
    </div>

    <div class="form-card">
        <h2>Map Embed</h2>
        <div class="form-grid">
            <label class="full">Google Map Embed URL
                <textarea name="home_map_embed_url" rows="4" required><?= e($site['home']['map_embed_url'] ?? '') ?></textarea>
            </label>
        </div>
    </div>
</div>
