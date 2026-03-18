<?php

declare(strict_types=1);
?>
<div class="form-card">
    <h2>Navbar Solutions</h2>
    <p class="muted">Atur dropdown `Solutions` di navbar beserta item turunannya.</p>
    <?php for ($groupIndex = 0; $groupIndex < 2; $groupIndex++): ?>
        <div class="form-grid solution-admin-grid">
            <label class="full">Judul Group <?= $groupIndex + 1 ?>
                <input
                    type="text"
                    name="solution_group_title[]"
                    value="<?= e($site['solutions']['groups'][$groupIndex]['title'] ?? '') ?>"
                >
            </label>
            <?php for ($itemIndex = 0; $itemIndex < 3; $itemIndex++): ?>
                <label>Label Item <?= $groupIndex + 1 ?>.<?= $itemIndex + 1 ?>
                    <input
                        type="text"
                        name="solution_item_label[<?= $groupIndex ?>][]"
                        value="<?= e($site['solutions']['groups'][$groupIndex]['items'][$itemIndex]['label'] ?? '') ?>"
                    >
                </label>
                <label>Link Item <?= $groupIndex + 1 ?>.<?= $itemIndex + 1 ?>
                    <input
                        type="text"
                        name="solution_item_href[<?= $groupIndex ?>][]"
                        value="<?= e($site['solutions']['groups'][$groupIndex]['items'][$itemIndex]['href'] ?? '') ?>"
                        placeholder="#layanan atau /services"
                    >
                </label>
            <?php endfor; ?>
        </div>
    <?php endfor; ?>
</div>
