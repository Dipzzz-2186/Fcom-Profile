<?php

declare(strict_types=1);

$clientItems = $site['clients']['items'] ?? [];
?>
<div class="form-card clients-admin-card">
    <div class="clients-admin-head">
        <div>
            <h2>Our Client</h2>
            <p class="muted">Client ditampilkan sebagai card. Klik detail untuk edit nama dan logo lewat modal.</p>
        </div>
        <button type="button" class="add-client-button" data-open-client-modal>Tambah Client</button>
    </div>

    <div class="client-card-grid" data-client-list>
        <?php if ($clientItems === []): ?>
            <p class="muted clients-empty" data-client-empty>Belum ada client yang ditambahkan.</p>
        <?php else: ?>
            <?php foreach ($clientItems as $index => $client): ?>
                <article class="client-summary-card" data-client-item>
                    <div class="client-summary-media">
                        <?php if (($client['logo'] ?? '') !== ''): ?>
                            <img src="<?= e($client['logo']) ?>" alt="<?= e($client['name'] !== '' ? $client['name'] : 'Client logo') ?>" data-client-card-preview>
                        <?php else: ?>
                            <span class="client-logo-placeholder">Belum ada logo</span>
                        <?php endif; ?>
                    </div>
                    <div class="client-summary-body">
                        <strong data-client-card-title><?= e($client['name'] !== '' ? $client['name'] : 'Client tanpa nama') ?></strong>
                        <p><?= e($client['logo'] !== '' ? $client['logo'] : 'Belum ada logo tersimpan.') ?></p>
                    </div>
                    <div class="client-summary-actions">
                        <button type="button" class="ghost-admin-button" data-open-client-editor>Detail</button>
                        <button type="button" class="client-remove-button" data-remove-client>Hapus</button>
                    </div>

                    <div class="client-modal-backdrop" data-client-editor-modal hidden>
                        <div class="client-modal">
                            <div class="client-modal-head">
                                <h3>Detail Client</h3>
                                <button type="button" class="client-modal-close" data-close-client-editor>&times;</button>
                            </div>
                            <div class="client-modal-body">
                                <div class="form-grid client-item-grid">
                                    <label class="client-name-field">Nama Client
                                        <input type="text" name="client_name[]" value="<?= e($client['name']) ?>" data-client-name-input>
                                    </label>
                                    <div class="client-logo-editor">
                                        <span class="client-field-label">Logo Client</span>
                                        <div class="client-logo-preview-card">
                                            <div class="client-logo-preview-frame">
                                                <?php if (($client['logo'] ?? '') !== ''): ?>
                                                    <img
                                                        src="<?= e($client['logo']) ?>"
                                                        alt="<?= e($client['name'] !== '' ? $client['name'] : 'Client logo') ?>"
                                                        data-logo-preview
                                                    >
                                                <?php else: ?>
                                                    <span class="client-logo-placeholder" data-logo-placeholder>Belum ada logo</span>
                                                    <img src="" alt="" hidden data-logo-preview>
                                                <?php endif; ?>
                                            </div>
                                            <div class="client-logo-actions">
                                                <button type="button" class="ghost-admin-button" data-toggle-logo-edit>Edit Gambar</button>
                                                <span class="muted">Klik edit kalau mau ganti logo client.</span>
                                            </div>
                                        </div>
                                        <div class="client-logo-input-wrap" data-logo-input-wrap hidden>
                                            <input type="file" name="client_logo[]" accept=".png,.jpg,.jpeg,.webp,.svg" data-client-logo-input>
                                            <input type="hidden" name="client_logo_existing[]" value="<?= e($client['logo']) ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="client-modal-actions">
                                <button type="button" class="ghost-admin-button" data-close-client-editor>Tutup</button>
                            </div>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<div class="client-modal-backdrop" data-client-modal hidden>
    <div class="client-modal">
        <div class="client-modal-head">
            <h3>Tambah Client</h3>
            <button type="button" class="client-modal-close" data-close-client-modal>&times;</button>
        </div>
        <div class="client-modal-body" data-client-modal-slot></div>
        <div class="client-modal-actions">
            <button type="button" class="ghost-admin-button" data-close-client-modal>Batal</button>
            <button type="button" class="save-button" data-save-client-modal>Tambah Client</button>
        </div>
    </div>
</div>

<template data-client-item-template>
    <article class="client-summary-card" data-client-item data-client-is-new="true">
        <div class="client-summary-media">
            <span class="client-logo-placeholder">Belum ada logo</span>
            <img src="" alt="" hidden data-client-card-preview>
        </div>
        <div class="client-summary-body">
            <strong data-client-card-title>Client Baru</strong>
            <p>Belum ada logo tersimpan.</p>
        </div>
        <div class="client-summary-actions">
            <button type="button" class="ghost-admin-button" data-open-client-editor>Detail</button>
            <button type="button" class="client-remove-button" data-remove-client>Hapus</button>
        </div>

        <div class="client-modal-backdrop" data-client-editor-modal hidden>
            <div class="client-modal">
                <div class="client-modal-head">
                    <h3>Detail Client</h3>
                    <button type="button" class="client-modal-close" data-close-client-editor>&times;</button>
                </div>
                <div class="client-modal-body">
                    <div class="form-grid client-item-grid">
                        <label class="client-name-field">Nama Client
                            <input type="text" name="client_name[]" value="" data-client-name-input>
                        </label>
                        <div class="client-logo-editor">
                            <span class="client-field-label">Logo Client</span>
                            <div class="client-logo-preview-card">
                                <div class="client-logo-preview-frame">
                                    <span class="client-logo-placeholder" data-logo-placeholder>Belum ada logo</span>
                                    <img src="" alt="" hidden data-logo-preview>
                                </div>
                                <div class="client-logo-actions">
                                    <button type="button" class="ghost-admin-button" data-toggle-logo-edit>Edit Gambar</button>
                                    <span class="muted">Upload logo untuk client baru.</span>
                                </div>
                            </div>
                            <div class="client-logo-input-wrap" data-logo-input-wrap hidden>
                                <input type="file" name="client_logo[]" accept=".png,.jpg,.jpeg,.webp,.svg" data-client-logo-input>
                            </div>
                            <input type="hidden" name="client_logo_existing[]" value="">
                        </div>
                    </div>
                </div>
                <div class="client-modal-actions">
                    <button type="button" class="ghost-admin-button" data-close-client-editor>Tutup</button>
                </div>
            </div>
        </div>
    </article>
</template>
