<?php

declare(strict_types=1);

function db(): PDO
{
    static $pdo = null;

    if ($pdo instanceof PDO) {
        return $pdo;
    }

    $dsn = sprintf('mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4', DB_HOST, DB_PORT, DB_NAME);

    $pdo = new PDO($dsn, DB_USER, DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);

    return $pdo;
}

function load_site_data(): array
{
    ensure_client_logos_table();
    ensure_solution_items_table();

    $site = default_site_data();

    $settings = db()->query('SELECT setting_key, setting_value FROM site_settings')->fetchAll();

    foreach ($settings as $setting) {
        $key = (string) $setting['setting_key'];
        $value = (string) $setting['setting_value'];

        switch ($key) {
            case 'company_name':
                $site['company']['name'] = $value;
                break;
            case 'company_tagline':
                $site['company']['tagline'] = $value;
                break;
            case 'company_headline':
                $site['company']['headline'] = $value;
                break;
            case 'company_description':
                $site['company']['description'] = $value;
                break;
            case 'company_years':
                $site['company']['years'] = $value;
                break;
            case 'company_projects':
                $site['company']['projects'] = $value;
                break;
            case 'company_clients':
                $site['company']['clients'] = $value;
                break;
            case 'about_title':
                $site['about']['title'] = $value;
                break;
            case 'about_content':
                $site['about']['content'] = $value;
                break;
            case 'products_title':
                $site['products']['title'] = $value;
                break;
            case 'advantages_title':
                $site['advantages']['title'] = $value;
                break;
            case 'contact_address':
                $site['contact']['address'] = $value;
                break;
            case 'contact_email':
                $site['contact']['email'] = $value;
                break;
            case 'contact_phone':
                $site['contact']['phone'] = $value;
                break;
            case 'contact_hours':
                $site['contact']['hours'] = $value;
                break;
        }
    }

    $services = db()->query('SELECT name, description FROM services ORDER BY sort_order ASC, id ASC')->fetchAll();
    if ($services !== []) {
        $site['products']['items'] = array_map(static fn (array $item): array => [
            'name' => (string) $item['name'],
            'description' => (string) $item['description'],
        ], $services);
    }

    $advantages = db()->query('SELECT content FROM advantages ORDER BY sort_order ASC, id ASC')->fetchAll();
    if ($advantages !== []) {
        $site['advantages']['items'] = array_map(static fn (array $item): string => (string) $item['content'], $advantages);
    }

    if (db_table_exists('solution_groups') && db_table_exists('solution_items')) {
        $solutionGroups = db()->query('SELECT id, title FROM solution_groups ORDER BY sort_order ASC, id ASC')->fetchAll();
        if ($solutionGroups !== []) {
            $itemStmt = db()->prepare('SELECT label, href, slug, content FROM solution_items WHERE group_id = :group_id ORDER BY sort_order ASC, id ASC');
            $site['solutions']['groups'] = [];

            foreach ($solutionGroups as $group) {
                $itemStmt->execute(['group_id' => (int) $group['id']]);
                $items = $itemStmt->fetchAll();

                $site['solutions']['groups'][] = [
                    'title' => (string) $group['title'],
                    'items' => array_map(static fn (array $item): array => [
                        'label' => (string) $item['label'],
                        'slug' => (string) $item['slug'],
                        'href' => (string) $item['href'],
                        'content' => (string) $item['content'],
                    ], $items),
                ];
            }
        }
    }

    if (db_table_exists('client_logos')) {
        $clientLogos = db()->query('SELECT client_name, logo_path FROM client_logos ORDER BY sort_order ASC, id ASC')->fetchAll();
        if ($clientLogos !== []) {
            $site['clients']['items'] = array_map(static fn (array $item): array => [
                'name' => (string) $item['client_name'],
                'logo' => (string) $item['logo_path'],
            ], $clientLogos);
        }
    }

    return $site;
}

function save_site_data(array $data): bool
{
    ensure_client_logos_table();
    ensure_solution_items_table();

    $pdo = db();
    $pdo->beginTransaction();

    try {
        $settings = [
            'company_name' => $data['company']['name'],
            'company_tagline' => $data['company']['tagline'],
            'company_headline' => $data['company']['headline'],
            'company_description' => $data['company']['description'],
            'company_years' => $data['company']['years'],
            'company_projects' => $data['company']['projects'],
            'company_clients' => $data['company']['clients'],
            'about_title' => $data['about']['title'],
            'about_content' => $data['about']['content'],
            'products_title' => $data['products']['title'],
            'advantages_title' => $data['advantages']['title'],
            'contact_address' => $data['contact']['address'],
            'contact_email' => $data['contact']['email'],
            'contact_phone' => $data['contact']['phone'],
            'contact_hours' => $data['contact']['hours'],
        ];

        $settingStmt = $pdo->prepare(
            'INSERT INTO site_settings (setting_key, setting_value)
             VALUES (:setting_key, :setting_value)
             ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value)'
        );

        foreach ($settings as $key => $value) {
            $settingStmt->execute([
                'setting_key' => $key,
                'setting_value' => $value,
            ]);
        }

        $pdo->exec('DELETE FROM services');
        $serviceStmt = $pdo->prepare('INSERT INTO services (name, description, sort_order) VALUES (:name, :description, :sort_order)');
        foreach ($data['products']['items'] as $index => $item) {
            $serviceStmt->execute([
                'name' => $item['name'],
                'description' => $item['description'],
                'sort_order' => $index + 1,
            ]);
        }

        $pdo->exec('DELETE FROM advantages');
        $advantageStmt = $pdo->prepare('INSERT INTO advantages (content, sort_order) VALUES (:content, :sort_order)');
        foreach ($data['advantages']['items'] as $index => $item) {
            $advantageStmt->execute([
                'content' => $item,
                'sort_order' => $index + 1,
            ]);
        }

        if (db_table_exists('solution_groups') && db_table_exists('solution_items')) {
            $pdo->exec('DELETE FROM solution_items');
            $pdo->exec('DELETE FROM solution_groups');

            $groupStmt = $pdo->prepare('INSERT INTO solution_groups (title, sort_order) VALUES (:title, :sort_order)');
            $itemStmt = $pdo->prepare('INSERT INTO solution_items (group_id, label, href, slug, content, sort_order) VALUES (:group_id, :label, :href, :slug, :content, :sort_order)');

            foreach ($data['solutions']['groups'] as $groupIndex => $group) {
                $groupStmt->execute([
                    'title' => $group['title'],
                    'sort_order' => $groupIndex + 1,
                ]);

                $groupId = (int) $pdo->lastInsertId();

                foreach ($group['items'] as $itemIndex => $item) {
                    $itemStmt->execute([
                        'group_id' => $groupId,
                        'label' => $item['label'],
                        'href' => $item['href'],
                        'slug' => $item['slug'],
                        'content' => $item['content'],
                        'sort_order' => $itemIndex + 1,
                    ]);
                }
            }
        }

        if (db_table_exists('client_logos')) {
            $pdo->exec('DELETE FROM client_logos');
            $clientStmt = $pdo->prepare('INSERT INTO client_logos (client_name, logo_path, sort_order) VALUES (:client_name, :logo_path, :sort_order)');

            foreach ($data['clients']['items'] as $index => $item) {
                $clientStmt->execute([
                    'client_name' => $item['name'],
                    'logo_path' => $item['logo'],
                    'sort_order' => $index + 1,
                ]);
            }
        }

        $pdo->commit();
        return true;
    } catch (Throwable $exception) {
        $pdo->rollBack();
        return false;
    }
}

function default_site_data(): array
{
    return [
        'company' => [
            'name' => 'FCOM',
            'tagline' => 'Mitra solusi digital dan operasional untuk pertumbuhan bisnis modern.',
            'headline' => 'Company profile yang tampil profesional, detail, dan siap dipresentasikan ke klien.',
            'description' => 'FCOM hadir untuk membantu perusahaan membangun identitas brand, komunikasi digital, dan layanan operasional yang lebih terukur. Fokus kami adalah kualitas eksekusi, tampilan profesional, dan informasi layanan yang mudah dipahami calon pelanggan.',
            'years' => '5+',
            'projects' => '120+',
            'clients' => '60+',
        ],
        'about' => [
            'title' => 'Tentang FCOM',
            'content' => 'Kami menggabungkan pendekatan kreatif, eksekusi teknis, dan pemahaman bisnis untuk menghasilkan layanan yang relevan. Website company profile ini dirancang sebagai wajah digital perusahaan: jelas, rapi, dan meyakinkan sejak kesan pertama.',
        ],
        'products' => [
            'title' => 'Produk & Layanan',
            'items' => [
                [
                    'name' => 'Website Company Profile',
                    'description' => 'Perancangan website profesional yang menonjolkan identitas perusahaan, portofolio, dan informasi layanan secara terstruktur.',
                ],
                [
                    'name' => 'Landing Page Kampanye',
                    'description' => 'Halaman pemasaran yang fokus pada konversi dengan struktur konten yang singkat, jelas, dan kredibel.',
                ],
                [
                    'name' => 'Brand Communication Kit',
                    'description' => 'Penyusunan materi komunikasi brand untuk presentasi, profil usaha, dan kebutuhan promosi digital.',
                ],
                [
                    'name' => 'Maintenance & Content Update',
                    'description' => 'Pendampingan pembaruan konten, banner, informasi layanan, dan performa tampilan website secara berkala.',
                ],
            ],
        ],
        'solutions' => [
            'groups' => [
                [
                    'title' => 'Our Products',
                    'items' => [
                        [
                            'label' => 'Internet Of Things',
                            'slug' => 'internet-of-things',
                            'href' => '/solutions/internet-of-things',
                            'content' => 'Solusi Internet of Things untuk menghubungkan perangkat, memantau data operasional, dan membantu bisnis mengambil keputusan lebih cepat.',
                        ],
                        [
                            'label' => 'Business Software',
                            'slug' => 'business-software',
                            'href' => '/solutions/business-software',
                            'content' => 'Aplikasi bisnis terintegrasi yang membantu perusahaan mengelola proses kerja, data, dan kolaborasi secara lebih efisien.',
                        ],
                    ],
                ],
                [
                    'title' => 'Our Services',
                    'items' => [
                        [
                            'label' => 'Managed Services',
                            'slug' => 'managed-services',
                            'href' => '/solutions/managed-services',
                            'content' => 'Layanan pengelolaan sistem dan infrastruktur IT secara berkelanjutan agar operasional bisnis tetap stabil dan aman.',
                        ],
                        [
                            'label' => 'On-Demand Services',
                            'slug' => 'on-demand-services',
                            'href' => '/solutions/on-demand-services',
                            'content' => 'Dukungan teknis fleksibel sesuai kebutuhan bisnis, mulai dari konsultasi, implementasi, hingga penyesuaian solusi khusus.',
                        ],
                    ],
                ],
            ],
        ],
        'advantages' => [
            'title' => 'Kenapa Memilih FCOM',
            'items' => [
                'Tampilan profesional yang siap dipakai sebagai wajah resmi perusahaan.',
                'Detail layanan disusun jelas agar mudah dipahami calon klien.',
                'Struktur CMS sederhana sehingga admin non-teknis tetap mudah mengelola konten.',
                'Desain responsif untuk desktop maupun mobile.',
            ],
        ],
        'clients' => [
            'items' => [],
        ],
        'contact' => [
            'address' => 'Jl. Strategis Bisnis No. 18, Jakarta',
            'email' => 'hello@fcom.co.id',
            'phone' => '+62 812-0000-0000',
            'hours' => 'Senin - Jumat, 08.00 - 17.00 WIB',
        ],
    ];
}

function authenticate_admin(string $username, string $password): bool
{
    $stmt = db()->prepare('SELECT id, username, password_hash FROM admin_users WHERE username = :username LIMIT 1');
    $stmt->execute(['username' => $username]);
    $admin = $stmt->fetch();

    if (! is_array($admin)) {
        return false;
    }

    if (! password_verify($password, (string) $admin['password_hash'])) {
        return false;
    }

    $_SESSION['admin_logged_in'] = true;
    $_SESSION['admin_id'] = (int) $admin['id'];
    $_SESSION['admin_username'] = (string) $admin['username'];

    return true;
}

function render(string $view, array $data = [], string $layout = 'app'): void
{
    extract($data, EXTR_SKIP);

    ob_start();
    require BASE_PATH . '/views/' . $view . '.php';
    $content = ob_get_clean();

    require BASE_PATH . '/views/layouts/' . $layout . '.php';
}

function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function is_admin_logged_in(): bool
{
    return isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
}

function redirect(string $path): void
{
    header('Location: ' . $path);
    exit;
}

function normalize_lines(string $value): array
{
    $lines = preg_split('/\r\n|\r|\n/', trim($value)) ?: [];

    return array_values(array_filter(array_map('trim', $lines), static fn ($line) => $line !== ''));
}

function map_items(array $names, array $descriptions): array
{
    $items = [];
    $count = max(count($names), count($descriptions));

    for ($index = 0; $index < $count; $index++) {
        $name = trim((string) ($names[$index] ?? ''));
        $description = trim((string) ($descriptions[$index] ?? ''));

        if ($name === '' && $description === '') {
            continue;
        }

        $items[] = [
            'name' => $name,
            'description' => $description,
        ];
    }

    return $items;
}

function map_solution_groups(array $titles, array $labelsByGroup, array $contentsByGroup): array
{
    $groups = [];
    $groupCount = count($titles);

    for ($groupIndex = 0; $groupIndex < $groupCount; $groupIndex++) {
        $title = trim((string) ($titles[$groupIndex] ?? ''));
        $labels = $labelsByGroup[$groupIndex] ?? [];
        $contents = $contentsByGroup[$groupIndex] ?? [];
        $items = [];
        $itemCount = max(count($labels), count($contents));

        for ($itemIndex = 0; $itemIndex < $itemCount; $itemIndex++) {
            $label = trim((string) ($labels[$itemIndex] ?? ''));
            $content = trim((string) ($contents[$itemIndex] ?? ''));

            if ($label === '' && $content === '') {
                continue;
            }

            $slug = slugify($label !== '' ? $label : ('solution-' . ($itemIndex + 1)));

            $items[] = [
                'label' => $label,
                'slug' => $slug,
                'href' => '/solutions/' . $slug,
                'content' => $content !== '' ? $content : 'Konten solusi ini akan segera diperbarui.',
            ];
        }

        if ($title === '' && $items === []) {
            continue;
        }

        $groups[] = [
            'title' => $title !== '' ? $title : 'Group ' . ($groupIndex + 1),
            'items' => $items,
        ];
    }

    return $groups;
}

function map_logo_items(array $names, array $logos): array
{
    $items = [];
    $count = max(count($names), count($logos));

    for ($index = 0; $index < $count; $index++) {
        $name = trim((string) ($names[$index] ?? ''));
        $logo = trim((string) ($logos[$index] ?? ''));

        if ($name === '' && $logo === '') {
            continue;
        }

        $items[] = [
            'name' => $name,
            'logo' => $logo,
        ];
    }

    return $items;
}

function handle_logo_uploads(array $files, array $existingPaths = []): array
{
    $normalized = [];
    $names = $files['name'] ?? [];
    $tmpNames = $files['tmp_name'] ?? [];
    $errors = $files['error'] ?? [];
    $count = max(count($names), count($existingPaths));

    $uploadDir = BASE_PATH . '/public/assets/img/clients';

    if (! is_dir($uploadDir)) {
        mkdir($uploadDir, 0775, true);
    }

    for ($index = 0; $index < $count; $index++) {
        $existing = trim((string) ($existingPaths[$index] ?? ''));
        $error = (int) ($errors[$index] ?? UPLOAD_ERR_NO_FILE);
        $tmpName = (string) ($tmpNames[$index] ?? '');
        $originalName = (string) ($names[$index] ?? '');

        if ($error === UPLOAD_ERR_NO_FILE) {
            $normalized[] = $existing;
            continue;
        }

        if ($error !== UPLOAD_ERR_OK || $tmpName === '' || ! is_uploaded_file($tmpName)) {
            $normalized[] = $existing;
            continue;
        }

        $extension = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
        $allowedExtensions = ['png', 'jpg', 'jpeg', 'webp', 'svg'];

        if (! in_array($extension, $allowedExtensions, true)) {
            $normalized[] = $existing;
            continue;
        }

        $baseName = preg_replace('/[^a-z0-9]+/i', '-', pathinfo($originalName, PATHINFO_FILENAME));
        $baseName = trim((string) $baseName, '-');
        $baseName = $baseName !== '' ? strtolower($baseName) : 'client-logo';
        $fileName = $baseName . '-' . bin2hex(random_bytes(4)) . '.' . $extension;
        $targetPath = $uploadDir . '/' . $fileName;

        if (! move_uploaded_file($tmpName, $targetPath)) {
            $normalized[] = $existing;
            continue;
        }

        $normalized[] = '/public/assets/img/clients/' . $fileName;
    }

    return $normalized;
}

function db_table_exists(string $tableName): bool
{
    static $cache = [];

    if (array_key_exists($tableName, $cache)) {
        return $cache[$tableName];
    }

    $stmt = db()->prepare('SHOW TABLES LIKE :table_name');
    $stmt->execute(['table_name' => $tableName]);

    $cache[$tableName] = $stmt->fetchColumn() !== false;

    return $cache[$tableName];
}

function db_column_exists(string $tableName, string $columnName): bool
{
    static $cache = [];
    $cacheKey = $tableName . '.' . $columnName;

    if (array_key_exists($cacheKey, $cache)) {
        return $cache[$cacheKey];
    }

    $stmt = db()->prepare(
        'SELECT COUNT(*) FROM information_schema.COLUMNS
         WHERE TABLE_SCHEMA = :schema_name AND TABLE_NAME = :table_name AND COLUMN_NAME = :column_name'
    );
    $stmt->execute([
        'schema_name' => DB_NAME,
        'table_name' => $tableName,
        'column_name' => $columnName,
    ]);

    $cache[$cacheKey] = (int) $stmt->fetchColumn() > 0;

    return $cache[$cacheKey];
}

function ensure_client_logos_table(): void
{
    static $initialized = false;

    if ($initialized) {
        return;
    }

    db()->exec(
        'CREATE TABLE IF NOT EXISTS client_logos (
            id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            client_name VARCHAR(150) NOT NULL,
            logo_path VARCHAR(255) NOT NULL,
            sort_order INT UNSIGNED NOT NULL DEFAULT 1,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )'
    );

    $initialized = true;
}

function ensure_solution_items_table(): void
{
    static $initialized = false;

    if ($initialized) {
        return;
    }

    db()->exec(
        'CREATE TABLE IF NOT EXISTS solution_groups (
            id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            title VARCHAR(150) NOT NULL,
            sort_order INT UNSIGNED NOT NULL DEFAULT 1,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )'
    );

    db()->exec(
        'CREATE TABLE IF NOT EXISTS solution_items (
            id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            group_id INT UNSIGNED NOT NULL,
            label VARCHAR(150) NOT NULL,
            href VARCHAR(255) NOT NULL DEFAULT \'#\',
            slug VARCHAR(180) NOT NULL DEFAULT \'\',
            content TEXT NOT NULL,
            sort_order INT UNSIGNED NOT NULL DEFAULT 1,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            CONSTRAINT fk_solution_items_group
                FOREIGN KEY (group_id) REFERENCES solution_groups(id)
                ON DELETE CASCADE
        )'
    );

    if (! db_column_exists('solution_items', 'slug')) {
        db()->exec('ALTER TABLE solution_items ADD COLUMN slug VARCHAR(180) NOT NULL DEFAULT \'\' AFTER href');
    }

    if (! db_column_exists('solution_items', 'content')) {
        db()->exec('ALTER TABLE solution_items ADD COLUMN content TEXT NOT NULL AFTER slug');
    }

    if (db_column_exists('solution_items', 'slug') && db_column_exists('solution_items', 'content')) {
        $items = db()->query('SELECT id, label, slug, content FROM solution_items')->fetchAll();
        $updateStmt = db()->prepare('UPDATE solution_items SET slug = :slug, href = :href, content = :content WHERE id = :id');

        foreach ($items as $item) {
            $slug = trim((string) ($item['slug'] ?? ''));
            $content = trim((string) ($item['content'] ?? ''));
            $label = (string) ($item['label'] ?? '');

            if ($slug === '') {
                $slug = slugify($label);
            }

            if ($content === '') {
                $content = 'Konten solusi ini akan segera diperbarui.';
            }

            $updateStmt->execute([
                'id' => (int) $item['id'],
                'slug' => $slug,
                'href' => '/solutions/' . $slug,
                'content' => $content,
            ]);
        }
    }

    $initialized = true;
}

function slugify(string $value): string
{
    $normalized = preg_replace('/[^a-z0-9]+/i', '-', strtolower(trim($value))) ?? '';
    $normalized = trim($normalized, '-');

    return $normalized !== '' ? $normalized : 'solution';
}

function find_solution_item_by_slug(array $site, string $slug): ?array
{
    foreach ($site['solutions']['groups'] ?? [] as $group) {
        foreach ($group['items'] ?? [] as $item) {
            if (($item['slug'] ?? '') === $slug) {
                return [
                    'group_title' => (string) ($group['title'] ?? ''),
                    'label' => (string) ($item['label'] ?? ''),
                    'slug' => (string) ($item['slug'] ?? ''),
                    'href' => (string) ($item['href'] ?? ''),
                    'content' => (string) ($item['content'] ?? ''),
                ];
            }
        }
    }

    return null;
}
