<?php

declare(strict_types=1);
?>
<div class="cms-card-stack">
    <div class="form-card">
        <h2>Stages Homepage</h2>
        <p class="muted">Judul section stages di homepage.</p>
        <div class="form-grid">
            <label class="full">Judul Section
                <input type="text" name="products_title" value="<?= e($site['products']['title']) ?>" required>
            </label>
        </div>
    </div>

    <?php for ($index = 0; $index < 4; $index++): ?>
        <div class="form-card">
            <h2>Stage <?= $index + 1 ?></h2>
            <div class="form-grid">
                <label>Nama Stage
                    <input type="text" name="product_name[]" value="<?= e($site['products']['items'][$index]['name'] ?? '') ?>" required>
                </label>
                <label class="full">Deskripsi Stage
                    <textarea name="product_description[]" rows="3" required><?= e($site['products']['items'][$index]['description'] ?? '') ?></textarea>
                </label>
            </div>
        </div>
    <?php endfor; ?>
</div>
