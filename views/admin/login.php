<?php

declare(strict_types=1);
?>
<main class="auth-wrapper">
    <section class="auth-card">
        <div>
            <span class="admin-badge">FCOM CMS</span>
            <h1>Login Admin</h1>
            <p>Masuk ke dashboard untuk mengubah konten company profile.</p>
        </div>
        <?php if ($error !== null): ?>
            <div class="alert error"><?= e($error) ?></div>
        <?php endif; ?>
        <form method="post" class="auth-form">
            <label>
                Username
                <input type="text" name="username" required>
            </label>
            <label>
                Password
                <input type="password" name="password" required>
            </label>
            <button type="submit">Masuk</button>
        </form>
        <p class="login-note">Default login: `admin` / `fcom123`</p>
    </section>
</main>
