<?php

declare(strict_types=1);
?>
<div class="form-card">
    <h2>Produk & Layanan</h2>
    <div class="form-grid">
        <label class="full">Judul Section
            <input type="text" name="products_title" value="<?= e($site['products']['title']) ?>" required>
        </label>
        <?php for ($index = 0; $index < 4; $index++): ?>
            <label>Nama Layanan <?= $index + 1 ?>
                <input type="text" name="product_name[]" value="<?= e($site['products']['items'][$index]['name'] ?? '') ?>">
            </label>
            <label>Deskripsi Layanan <?= $index + 1 ?>
                <textarea name="product_description[]" rows="3"><?= e($site['products']['items'][$index]['description'] ?? '') ?></textarea>
            </label>
        <?php endfor; ?>
    </div>
</div>
