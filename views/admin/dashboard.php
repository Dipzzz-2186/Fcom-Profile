<?php

declare(strict_types=1);
?>
<main class="dashboard-shell">
    <aside class="sidebar">
        <div>
            <span class="admin-badge">FCOM CMS</span>
            <h1>Dashboard Admin</h1>
            <p>Kelola teks utama, layanan, keunggulan, dan informasi kontak.</p>
        </div>
        <div class="sidebar-links">
            <a href="/" target="_blank" rel="noreferrer">Lihat Website</a>
            <a href="/admin/logout">Logout</a>
        </div>
    </aside>

    <section class="dashboard-content">
        <div class="dashboard-header">
            <div>
                <p class="muted">Konten website tersimpan di MySQL dan bisa dikelola langsung dari dashboard admin.</p>
            </div>
            <?php if ($message !== null): ?>
                <div class="alert success"><?= e($message) ?></div>
            <?php endif; ?>
        </div>

        <form method="post" enctype="multipart/form-data" class="cms-form">
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

            <div class="form-card">
                <h2>Tentang</h2>
                <div class="form-grid">
                    <label>Judul Tentang
                        <input type="text" name="about_title" value="<?= e($site['about']['title']) ?>" required>
                    </label>
                    <label class="full">Isi Tentang
                        <textarea name="about_content" rows="5" required><?= e($site['about']['content']) ?></textarea>
                    </label>
                </div>
            </div>

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

            <div class="form-card">
                <h2>Keunggulan</h2>
                <div class="form-grid">
                    <label>Judul Keunggulan
                        <input type="text" name="advantages_title" value="<?= e($site['advantages']['title']) ?>" required>
                    </label>
                    <label class="full">Daftar Keunggulan (satu baris satu item)
                        <textarea name="advantages_items" rows="6" required><?= e(implode(PHP_EOL, $site['advantages']['items'])) ?></textarea>
                    </label>
                </div>
            </div>

            <div class="form-card">
                <h2>Our Client</h2>
                <p class="muted">Isi nama client lalu upload file logo langsung dari komputer.</p>
                <div class="form-grid">
                    <?php for ($index = 0; $index < 8; $index++): ?>
                        <label>Nama Client <?= $index + 1 ?>
                            <input type="text" name="client_name[]" value="<?= e($site['clients']['items'][$index]['name'] ?? '') ?>">
                        </label>
                        <label>File Logo <?= $index + 1 ?>
                            <input type="file" name="client_logo[]" accept=".png,.jpg,.jpeg,.webp,.svg">
                            <input type="hidden" name="client_logo_existing[]" value="<?= e($site['clients']['items'][$index]['logo'] ?? '') ?>">
                        </label>
                    <?php endfor; ?>
                </div>
            </div>

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

            <button class="save-button" type="submit">Simpan Perubahan</button>
        </form>
    </section>
</main>
