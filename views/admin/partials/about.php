<?php

declare(strict_types=1);

$vision = $site['about']['vision'] ?? [];
$visionItems = $vision['items'] ?? [];
$mission = $site['about']['mission'] ?? [];
$missionItems = $mission['items'] ?? [];
?>
<div class="cms-card-stack">
    <div class="form-card">
        <h2>Vision</h2>
        <p class="muted">Bagian kiri halaman About.</p>
        <div class="form-grid">
            <label class="full">Vision Copy
                <textarea name="about_vision_copy" rows="3"><?= e((string) ($vision['copy'] ?? '')) ?></textarea>
            </label>
            <label>Vision Item 1 Title
                <input type="text" name="about_vision_target_title" value="<?= e((string) ($visionItems[0]['title'] ?? '')) ?>">
            </label>
            <label>Vision Item 1 Text
                <input type="text" name="about_vision_target_body" value="<?= e((string) ($visionItems[0]['body'] ?? '')) ?>">
            </label>
            <label>Vision Item 2 Title
                <input type="text" name="about_vision_goal_title" value="<?= e((string) ($visionItems[1]['title'] ?? '')) ?>">
            </label>
            <label>Vision Item 2 Text
                <input type="text" name="about_vision_goal_body" value="<?= e((string) ($visionItems[1]['body'] ?? '')) ?>">
            </label>
            <label>Vision Item 3 Title
                <input type="text" name="about_vision_focus_title" value="<?= e((string) ($visionItems[2]['title'] ?? '')) ?>">
            </label>
            <label>Vision Item 3 Text
                <input type="text" name="about_vision_focus_body" value="<?= e((string) ($visionItems[2]['body'] ?? '')) ?>">
            </label>
        </div>
    </div>

    <div class="form-card">
        <h2>Mission</h2>
        <p class="muted">Bagian kanan halaman About.</p>
        <div class="form-grid">
            <label class="full">Mission Copy
                <textarea name="about_mission_copy" rows="3"><?= e((string) ($mission['copy'] ?? '')) ?></textarea>
            </label>
            <label>Mission Item 1 Title
                <input type="text" name="about_mission_objective_title" value="<?= e((string) ($missionItems[0]['title'] ?? '')) ?>">
            </label>
            <label>Mission Item 1 Text
                <input type="text" name="about_mission_objective_body" value="<?= e((string) ($missionItems[0]['body'] ?? '')) ?>">
            </label>
            <label>Mission Item 2 Title
                <input type="text" name="about_mission_approach_title" value="<?= e((string) ($missionItems[1]['title'] ?? '')) ?>">
            </label>
            <label>Mission Item 2 Text
                <input type="text" name="about_mission_approach_body" value="<?= e((string) ($missionItems[1]['body'] ?? '')) ?>">
            </label>
            <label>Mission Item 3 Title
                <input type="text" name="about_mission_benefit_title" value="<?= e((string) ($missionItems[2]['title'] ?? '')) ?>">
            </label>
            <label>Mission Item 3 Text
                <input type="text" name="about_mission_benefit_body" value="<?= e((string) ($missionItems[2]['body'] ?? '')) ?>">
            </label>
        </div>
    </div>
</div>
