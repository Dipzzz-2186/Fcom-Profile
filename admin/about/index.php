<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/_shared.php';

admin_render_page('about', 'About', 'Kelola konten halaman About yang tampil di section Vision dan Mission.', 'about', static function (array &$updated): void {
    $updated['about']['vision']['copy'] = trim((string) ($_POST['about_vision_copy'] ?? $updated['about']['vision']['copy']));
    $updated['about']['vision']['items'][0]['title'] = trim((string) ($_POST['about_vision_target_title'] ?? $updated['about']['vision']['items'][0]['title']));
    $updated['about']['vision']['items'][0]['body'] = trim((string) ($_POST['about_vision_target_body'] ?? $updated['about']['vision']['items'][0]['body']));
    $updated['about']['vision']['items'][1]['title'] = trim((string) ($_POST['about_vision_goal_title'] ?? $updated['about']['vision']['items'][1]['title']));
    $updated['about']['vision']['items'][1]['body'] = trim((string) ($_POST['about_vision_goal_body'] ?? $updated['about']['vision']['items'][1]['body']));
    $updated['about']['vision']['items'][2]['title'] = trim((string) ($_POST['about_vision_focus_title'] ?? $updated['about']['vision']['items'][2]['title']));
    $updated['about']['vision']['items'][2]['body'] = trim((string) ($_POST['about_vision_focus_body'] ?? $updated['about']['vision']['items'][2]['body']));

    $updated['about']['mission']['copy'] = trim((string) ($_POST['about_mission_copy'] ?? $updated['about']['mission']['copy']));
    $updated['about']['mission']['items'][0]['title'] = trim((string) ($_POST['about_mission_objective_title'] ?? $updated['about']['mission']['items'][0]['title']));
    $updated['about']['mission']['items'][0]['body'] = trim((string) ($_POST['about_mission_objective_body'] ?? $updated['about']['mission']['items'][0]['body']));
    $updated['about']['mission']['items'][1]['title'] = trim((string) ($_POST['about_mission_approach_title'] ?? $updated['about']['mission']['items'][1]['title']));
    $updated['about']['mission']['items'][1]['body'] = trim((string) ($_POST['about_mission_approach_body'] ?? $updated['about']['mission']['items'][1]['body']));
    $updated['about']['mission']['items'][2]['title'] = trim((string) ($_POST['about_mission_benefit_title'] ?? $updated['about']['mission']['items'][2]['title']));
    $updated['about']['mission']['items'][2]['body'] = trim((string) ($_POST['about_mission_benefit_body'] ?? $updated['about']['mission']['items'][2]['body']));
});
