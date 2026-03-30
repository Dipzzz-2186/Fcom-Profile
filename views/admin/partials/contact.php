<?php

declare(strict_types=1);
?>
<div class="cms-card-stack">
    <div class="form-card">
        <h2>Kontak Utama</h2>
        <div class="form-grid">
            <label>Email
                <input type="email" name="contact_email" value="<?= e($site['contact']['email']) ?>" required>
            </label>
            <label>Telepon
                <input type="text" name="contact_phone" value="<?= e($site['contact']['phone']) ?>" required>
            </label>
            <label>Jam Operasional
                <input type="text" name="contact_hours" value="<?= e($site['contact']['hours']) ?>" required>
            </label>
        </div>
    </div>

    <div class="form-card">
        <h2>Alamat</h2>
        <div class="form-grid">
            <label class="full">Alamat
                <input type="text" name="contact_address" value="<?= e($site['contact']['address']) ?>" required>
            </label>
        </div>
    </div>
</div>
