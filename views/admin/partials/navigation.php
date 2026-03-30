<?php

declare(strict_types=1);
?>
<div class="cms-card-stack">
    <div class="form-card">
        <h2>Navbar Solutions</h2>
        <p class="muted">Atur dropdown `Solutions` dan halaman detail turunannya.</p>
    </div>
    <?php for ($groupIndex = 0; $groupIndex < 2; $groupIndex++): ?>
        <div class="form-card">
            <h2>Group <?= $groupIndex + 1 ?></h2>
            <div class="form-grid solution-admin-grid">
                <label class="full">Judul Group
                    <input
                        type="text"
                        name="solution_group_title[]"
                        value="<?= e($site['solutions']['groups'][$groupIndex]['title'] ?? '') ?>"
                    >
                </label>
                <?php for ($itemIndex = 0; $itemIndex < 5; $itemIndex++): ?>
                    <label class="full">Label Item <?= $itemIndex + 1 ?>
                        <input
                            type="text"
                            name="solution_item_label[<?= $groupIndex ?>][]"
                            value="<?= e($site['solutions']['groups'][$groupIndex]['items'][$itemIndex]['label'] ?? '') ?>"
                        >
                    </label>
                    <label class="full">Konten Halaman <?= $itemIndex + 1 ?>
                        <textarea
                            name="solution_item_content[<?= $groupIndex ?>][]"
                            rows="3"
                            placeholder="Deskripsi yang akan tampil di halaman detail item ini."
                        ><?= e($site['solutions']['groups'][$groupIndex]['items'][$itemIndex]['content'] ?? '') ?></textarea>
                    </label>
                <?php endfor; ?>
            </div>
        </div>
    <?php endfor; ?>
</div>
