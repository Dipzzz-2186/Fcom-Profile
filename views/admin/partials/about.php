<?php

declare(strict_types=1);
?>
<div class="form-card">
    <h2>Tentang</h2>
    <div class="form-grid">
        <label>Judul Tentang
            <input type="text" name="about_title" value="<?= e($site['about']['title']) ?>" required>
        </label>
        <label class="full">Isi Tentang
            <textarea name="about_content" rows="6" required><?= e($site['about']['content']) ?></textarea>
        </label>
    </div>
</div>
