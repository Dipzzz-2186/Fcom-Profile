<?php

declare(strict_types=1);
?>
<div class="form-card">
    <h2>Keunggulan</h2>
    <div class="form-grid">
        <label>Judul Keunggulan
            <input type="text" name="advantages_title" value="<?= e($site['advantages']['title']) ?>" required>
        </label>
        <label class="full">Daftar Keunggulan (satu baris satu item)
            <textarea name="advantages_items" rows="8" required><?= e(implode(PHP_EOL, $site['advantages']['items'])) ?></textarea>
        </label>
    </div>
</div>
