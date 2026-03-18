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
