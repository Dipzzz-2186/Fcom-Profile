<?php

declare(strict_types=1);

$clientItems = $site['clients']['items'] ?? [];
?>
<div class="form-card clients-admin-card">
    <div class="clients-admin-head">
        <div>
            <h2>Our Client</h2>
            <p class="muted">Kelola daftar client yang tampil di website. Tambah client baru lewat modal, lalu klik `Simpan Perubahan` di bawah halaman agar benar-benar tersimpan.</p>
        </div>
        <button type="button" class="add-client-button" data-open-client-modal>Tambah Client</button>
    </div>

    <div class="clients-admin-list" data-client-list>
        <?php if ($clientItems === []): ?>
            <p class="muted clients-empty" data-client-empty>Belum ada client yang ditambahkan.</p>
        <?php else: ?>
            <?php foreach ($clientItems as $index => $client): ?>
                <article class="client-admin-item">
                    <div class="client-admin-item-head">
                        <strong>Client <?= $index + 1 ?></strong>
                        <button type="button" class="client-remove-button" data-remove-client>Hapus</button>
                    </div>
                    <div class="form-grid">
                        <label>Nama Client
                            <input type="text" name="client_name[]" value="<?= e($client['name']) ?>">
                        </label>
                        <label>Ganti Logo
                            <input type="file" name="client_logo[]" accept=".png,.jpg,.jpeg,.webp,.svg">
                            <input type="hidden" name="client_logo_existing[]" value="<?= e($client['logo']) ?>">
                        </label>
                    </div>
                    <p class="muted current-logo-note">Logo saat ini: <?= e($client['logo']) ?></p>
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
            <button type="button" class="save-button" data-save-client-modal>Tambah ke Daftar</button>
        </div>
    </div>
</div>

<template data-client-item-template>
    <article class="client-admin-item">
        <div class="client-admin-item-head">
            <strong>Client Baru</strong>
            <button type="button" class="client-remove-button" data-remove-client>Hapus</button>
        </div>
        <div class="form-grid">
            <label>Nama Client
                <input type="text" name="client_name[]" value="">
            </label>
            <label>Logo Client
                <input type="file" name="client_logo[]" accept=".png,.jpg,.jpeg,.webp,.svg">
                <input type="hidden" name="client_logo_existing[]" value="">
            </label>
        </div>
        <p class="muted current-logo-note">Belum ada logo tersimpan.</p>
    </article>
</template>
