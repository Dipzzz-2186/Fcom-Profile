<?php

declare(strict_types=1);
?>
<div class="form-card">
    <h2>Kontak</h2>
    <div class="form-grid">
        <label>Alamat
            <input type="text" name="contact_address" value="<?= e($site['contact']['address']) ?>" required>
        </label>
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
