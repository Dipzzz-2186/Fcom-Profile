CREATE DATABASE IF NOT EXISTS fcom_company_profile
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE fcom_company_profile;

CREATE TABLE IF NOT EXISTS site_settings (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    setting_key VARCHAR(100) NOT NULL UNIQUE,
    setting_value TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS services (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    description TEXT NOT NULL,
    sort_order INT UNSIGNED NOT NULL DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS advantages (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    content TEXT NOT NULL,
    sort_order INT UNSIGNED NOT NULL DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS solution_groups (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(150) NOT NULL,
    sort_order INT UNSIGNED NOT NULL DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS solution_items (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    group_id INT UNSIGNED NOT NULL,
    label VARCHAR(150) NOT NULL,
    href VARCHAR(255) NOT NULL DEFAULT '#',
    sort_order INT UNSIGNED NOT NULL DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_solution_items_group
        FOREIGN KEY (group_id) REFERENCES solution_groups(id)
        ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS client_logos (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    client_name VARCHAR(150) NOT NULL,
    logo_path VARCHAR(255) NOT NULL,
    sort_order INT UNSIGNED NOT NULL DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS admin_users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO site_settings (setting_key, setting_value) VALUES
('company_name', 'FCOM'),
('company_tagline', 'Mitra solusi digital dan operasional untuk pertumbuhan bisnis modern.'),
('company_headline', 'Company profile yang tampil profesional, detail, dan siap dipresentasikan ke klien.'),
('company_description', 'FCOM hadir untuk membantu perusahaan membangun identitas brand, komunikasi digital, dan layanan operasional yang lebih terukur. Fokus kami adalah kualitas eksekusi, tampilan profesional, dan informasi layanan yang mudah dipahami calon pelanggan.'),
('company_years', '5+'),
('company_projects', '120+'),
('company_clients', '60+'),
('about_title', 'Tentang FCOM'),
('about_content', 'Kami menggabungkan pendekatan kreatif, eksekusi teknis, dan pemahaman bisnis untuk menghasilkan layanan yang relevan. Website company profile ini dirancang sebagai wajah digital perusahaan: jelas, rapi, dan meyakinkan sejak kesan pertama.'),
('products_title', 'Produk & Layanan'),
('advantages_title', 'Kenapa Memilih FCOM'),
('contact_address', 'Jl. Strategis Bisnis No. 18, Jakarta'),
('contact_email', 'hello@fcom.co.id'),
('contact_phone', '+62 812-0000-0000'),
('contact_hours', 'Senin - Jumat, 08.00 - 17.00 WIB')
ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value);

INSERT INTO services (id, name, description, sort_order) VALUES
(1, 'Website Company Profile', 'Perancangan website profesional yang menonjolkan identitas perusahaan, portofolio, dan informasi layanan secara terstruktur.', 1),
(2, 'Landing Page Kampanye', 'Halaman pemasaran yang fokus pada konversi dengan struktur konten yang singkat, jelas, dan kredibel.', 2),
(3, 'Brand Communication Kit', 'Penyusunan materi komunikasi brand untuk presentasi, profil usaha, dan kebutuhan promosi digital.', 3),
(4, 'Maintenance & Content Update', 'Pendampingan pembaruan konten, banner, informasi layanan, dan performa tampilan website secara berkala.', 4)
ON DUPLICATE KEY UPDATE
name = VALUES(name),
description = VALUES(description),
sort_order = VALUES(sort_order);

INSERT INTO advantages (id, content, sort_order) VALUES
(1, 'Tampilan profesional yang siap dipakai sebagai wajah resmi perusahaan.', 1),
(2, 'Detail layanan disusun jelas agar mudah dipahami calon klien.', 2),
(3, 'Struktur CMS sederhana sehingga admin non-teknis tetap mudah mengelola konten.', 3),
(4, 'Desain responsif untuk desktop maupun mobile.', 4)
ON DUPLICATE KEY UPDATE
content = VALUES(content),
sort_order = VALUES(sort_order);

INSERT INTO solution_groups (id, title, sort_order) VALUES
(1, 'Our Products', 1),
(2, 'Our Services', 2)
ON DUPLICATE KEY UPDATE
title = VALUES(title),
sort_order = VALUES(sort_order);

INSERT INTO solution_items (id, group_id, label, href, sort_order) VALUES
(1, 1, 'Internet Of Things', '#layanan', 1),
(2, 1, 'Business Software', '#layanan', 2),
(3, 2, 'Managed Services', '#proses', 1),
(4, 2, 'On-Demand Services', '#kontak', 2)
ON DUPLICATE KEY UPDATE
group_id = VALUES(group_id),
label = VALUES(label),
href = VALUES(href),
sort_order = VALUES(sort_order);

INSERT INTO client_logos (id, client_name, logo_path, sort_order) VALUES
(1, 'FCOM Partner A', '/public/assets/img/fcom.png', 1),
(2, 'FCOM Partner B', '/public/assets/img/logo1.png', 2),
(3, 'FCOM Partner C', '/public/assets/img/logo2.png', 3)
ON DUPLICATE KEY UPDATE
client_name = VALUES(client_name),
logo_path = VALUES(logo_path),
sort_order = VALUES(sort_order);

INSERT INTO admin_users (username, password_hash) VALUES
('admin', '$2y$10$eIMUEhqolEfl0hNIMdV4eej64VBQJIGqC2p5GbGMPTBFGPM1nk1Ky')
ON DUPLICATE KEY UPDATE password_hash = VALUES(password_hash);
