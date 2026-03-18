CREATE TABLE IF NOT EXISTS client_logos (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    client_name VARCHAR(150) NOT NULL,
    logo_path VARCHAR(255) NOT NULL,
    sort_order INT UNSIGNED NOT NULL DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO client_logos (client_name, logo_path, sort_order) VALUES
('FCOM Partner A', '/public/assets/img/fcom.png', 1),
('FCOM Partner B', '/public/assets/img/logo1.png', 2),
('FCOM Partner C', '/public/assets/img/logo2.png', 3);
