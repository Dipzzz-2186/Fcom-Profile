<?php

declare(strict_types=1);

$blogItems = $site['blog']['items'] ?? [];
?>
<div class="form-card">
    <div class="clients-admin-head">
        <div>
            <h2>Artikel Blog</h2>
            <p class="muted">Artikel ditampilkan sebagai card. Klik detail untuk lihat dan edit isi artikel lewat modal.</p>
        </div>
        <button type="button" class="add-client-button" data-open-blog-modal>Tambah Artikel</button>
    </div>

    <div class="blog-card-grid" data-blog-list>
        <?php if ($blogItems === []): ?>
            <p class="muted clients-empty" data-blog-empty>Belum ada artikel blog.</p>
        <?php else: ?>
            <?php foreach ($blogItems as $index => $item): ?>
                <article class="blog-summary-card" data-blog-item>
                    <div class="blog-summary-media">
                        <img src="<?= e($item['image']) ?>" alt="<?= e($item['title']) ?>" data-blog-card-preview>
                    </div>
                    <div class="blog-summary-body">
                        <strong data-blog-card-title><?= e($item['title']) ?></strong>
                        <span class="blog-summary-date"><?= e($item['published_at']) ?></span>
                        <p data-blog-card-excerpt><?= e($item['excerpt']) ?></p>
                        <div class="blog-summary-flags">
                            <?php if (!empty($item['is_featured'])): ?><span>Featured</span><?php endif; ?>
                            <?php if (!empty($item['is_popular'])): ?><span>Popular</span><?php endif; ?>
                        </div>
                    </div>
                    <div class="blog-summary-actions">
                        <button type="button" class="ghost-admin-button" data-open-blog-editor>Detail</button>
                        <button type="button" class="client-remove-button" data-remove-blog>Hapus</button>
                    </div>

                    <input type="hidden" name="blog_delete[]" value="<?= e((string) $index) ?>" data-blog-delete-input disabled>

                    <div class="client-modal-backdrop" data-blog-editor-modal hidden>
                        <div class="client-modal">
                            <div class="client-modal-head">
                                <h3>Detail Artikel</h3>
                                <button type="button" class="client-modal-close" data-close-blog-editor>&times;</button>
                            </div>
                            <div class="client-modal-body">
                                <div class="form-grid">
                                    <label class="full">Judul
                                        <input type="text" name="blog_title[]" value="<?= e($item['title']) ?>" data-blog-title-input>
                                    </label>
                                    <label>Publish Date
                                        <input type="date" name="blog_published_at[]" value="<?= e($item['published_at']) ?>">
                                    </label>
                                    <div class="blog-image-editor">
                                        <span class="client-field-label">Gambar</span>
                                        <div class="client-logo-preview-card">
                                            <div class="client-logo-preview-frame blog-image-preview-frame">
                                                <?php if (($item['image'] ?? '') !== ''): ?>
                                                    <img src="<?= e($item['image']) ?>" alt="<?= e($item['title']) ?>" data-blog-preview>
                                                <?php else: ?>
                                                    <span class="client-logo-placeholder" data-blog-placeholder>Belum ada gambar</span>
                                                    <img src="" alt="" hidden data-blog-preview>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <input type="file" name="blog_image[]" accept=".png,.jpg,.jpeg,.webp" data-blog-image-input>
                                        <input type="hidden" name="blog_image_existing[]" value="<?= e($item['image']) ?>">
                                    </div>
                                    <label class="full">Excerpt
                                        <textarea name="blog_excerpt[]" rows="3" data-blog-excerpt-input><?= e($item['excerpt']) ?></textarea>
                                    </label>
                                    <label class="full">Isi Artikel
                                        <textarea name="blog_content[]" rows="6"><?= e($item['content']) ?></textarea>
                                    </label>
                                </div>
                                <div class="blog-admin-flags">
                                    <label class="blog-check">
                                        <input type="checkbox" name="blog_featured[]" value="<?= e((string) $index) ?>" <?= !empty($item['is_featured']) ? 'checked' : '' ?>>
                                        <span>Jadikan featured</span>
                                    </label>
                                    <label class="blog-check">
                                        <input type="checkbox" name="blog_popular[]" value="<?= e((string) $index) ?>" <?= !empty($item['is_popular']) ? 'checked' : '' ?>>
                                        <span>Masuk popular</span>
                                    </label>
                                </div>
                            </div>
                            <div class="client-modal-actions">
                                <button type="button" class="ghost-admin-button" data-close-blog-editor>Tutup</button>
                            </div>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<div class="client-modal-backdrop" data-blog-modal hidden>
    <div class="client-modal">
        <div class="client-modal-head">
            <h3>Tambah Artikel</h3>
            <button type="button" class="client-modal-close" data-close-blog-modal>&times;</button>
        </div>
        <div class="client-modal-body" data-blog-modal-slot></div>
        <div class="client-modal-actions">
            <button type="button" class="ghost-admin-button" data-close-blog-modal>Batal</button>
            <button type="button" class="save-button" data-save-blog-modal>Tambah Artikel</button>
        </div>
    </div>
</div>

<template data-blog-item-template>
    <article class="blog-summary-card" data-blog-item data-blog-is-new="true">
        <div class="blog-summary-media">
            <img src="/public/assets/img/wallpaper1.jpg" alt="Artikel Baru" data-blog-card-preview>
        </div>
        <div class="blog-summary-body">
            <strong data-blog-card-title>Artikel Baru</strong>
            <span class="blog-summary-date"><?= e(date('Y-m-d')) ?></span>
            <p data-blog-card-excerpt>Artikel belum diisi.</p>
        </div>
        <div class="blog-summary-actions">
            <button type="button" class="ghost-admin-button" data-open-blog-editor>Detail</button>
            <button type="button" class="client-remove-button" data-remove-blog>Hapus</button>
        </div>

        <div class="client-modal-backdrop" data-blog-editor-modal hidden>
            <div class="client-modal">
                <div class="client-modal-head">
                    <h3>Detail Artikel</h3>
                    <button type="button" class="client-modal-close" data-close-blog-editor>&times;</button>
                </div>
                <div class="client-modal-body">
                    <div class="form-grid">
                        <label class="full">Judul
                            <input type="text" name="blog_title[]" value="" data-blog-title-input>
                        </label>
                        <label>Publish Date
                            <input type="date" name="blog_published_at[]" value="<?= e(date('Y-m-d')) ?>">
                        </label>
                        <div class="blog-image-editor">
                            <span class="client-field-label">Gambar</span>
                            <div class="client-logo-preview-card">
                                <div class="client-logo-preview-frame blog-image-preview-frame">
                                    <span class="client-logo-placeholder" data-blog-placeholder>Belum ada gambar</span>
                                    <img src="" alt="" hidden data-blog-preview>
                                </div>
                            </div>
                            <input type="file" name="blog_image[]" accept=".png,.jpg,.jpeg,.webp" data-blog-image-input>
                            <input type="hidden" name="blog_image_existing[]" value="/public/assets/img/wallpaper1.jpg">
                        </div>
                        <label class="full">Excerpt
                            <textarea name="blog_excerpt[]" rows="3" data-blog-excerpt-input></textarea>
                        </label>
                        <label class="full">Isi Artikel
                            <textarea name="blog_content[]" rows="6"></textarea>
                        </label>
                    </div>
                    <div class="blog-admin-flags">
                        <label class="blog-check">
                            <input type="checkbox" name="blog_featured[]" value="__BLOG_INDEX__">
                            <span>Jadikan featured</span>
                        </label>
                        <label class="blog-check">
                            <input type="checkbox" name="blog_popular[]" value="__BLOG_INDEX__">
                            <span>Masuk popular</span>
                        </label>
                    </div>
                </div>
                <div class="client-modal-actions">
                    <button type="button" class="ghost-admin-button" data-close-blog-editor>Tutup</button>
                </div>
            </div>
        </div>
    </article>
</template>
