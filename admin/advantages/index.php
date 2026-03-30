<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/_shared.php';

admin_render_page('advantages', 'Homepage Labels', 'Kelola label dan embed map di homepage.', 'advantages', static function (array &$updated): void {
    $updated['home']['nav_solutions_label'] = trim((string) ($_POST['home_nav_solutions_label'] ?? $updated['home']['nav_solutions_label']));
    $updated['home']['nav_about_label'] = trim((string) ($_POST['home_nav_about_label'] ?? $updated['home']['nav_about_label']));
    $updated['home']['clients_title'] = trim((string) ($_POST['home_clients_title'] ?? $updated['home']['clients_title']));
    $updated['home']['footer_company_heading'] = trim((string) ($_POST['home_footer_company_heading'] ?? $updated['home']['footer_company_heading']));
    $updated['home']['footer_about_label'] = trim((string) ($_POST['home_footer_about_label'] ?? $updated['home']['footer_about_label']));
    $updated['home']['footer_vision_label'] = trim((string) ($_POST['home_footer_vision_label'] ?? $updated['home']['footer_vision_label']));
    $updated['home']['footer_mission_label'] = trim((string) ($_POST['home_footer_mission_label'] ?? $updated['home']['footer_mission_label']));
    $updated['home']['footer_support_heading'] = trim((string) ($_POST['home_footer_support_heading'] ?? $updated['home']['footer_support_heading']));
    $updated['home']['footer_email_label'] = trim((string) ($_POST['home_footer_email_label'] ?? $updated['home']['footer_email_label']));
    $updated['home']['footer_contact_label'] = trim((string) ($_POST['home_footer_contact_label'] ?? $updated['home']['footer_contact_label']));
    $updated['home']['map_embed_url'] = trim((string) ($_POST['home_map_embed_url'] ?? $updated['home']['map_embed_url']));
});
