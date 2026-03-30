<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/_shared.php';

admin_render_page('company', 'Home Hero', 'Kelola brand dan hero utama homepage.', 'company', static function (array &$updated): void {
    $updated['company'] = [
        'name' => trim((string) ($_POST['company_name'] ?? '')),
        'tagline' => (string) ($updated['company']['tagline'] ?? ''),
        'headline' => (string) ($updated['company']['headline'] ?? ''),
        'description' => (string) ($updated['company']['description'] ?? ''),
        'years' => (string) ($updated['company']['years'] ?? ''),
        'projects' => (string) ($updated['company']['projects'] ?? ''),
        'clients' => (string) ($updated['company']['clients'] ?? ''),
    ];

    $updated['home']['nav_tagline'] = trim((string) ($_POST['home_nav_tagline'] ?? $updated['home']['nav_tagline']));
    $updated['home']['hero_title'] = trim((string) ($_POST['home_hero_title'] ?? $updated['home']['hero_title']));
    $updated['home']['hero_button_label'] = trim((string) ($_POST['home_hero_button_label'] ?? $updated['home']['hero_button_label']));
    $updated['home']['hero_lead'] = trim((string) ($_POST['home_hero_lead'] ?? $updated['home']['hero_lead']));
    $updated['home']['hero_side_note'] = trim((string) ($_POST['home_hero_side_note'] ?? $updated['home']['hero_side_note']));
});
