<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/_shared.php';

admin_render_page('navigation', 'Navigation', 'Atur group dan item dropdown Solutions di navbar.', 'navigation', static function (array &$updated): void {
    $updated['solutions'] = [
        'groups' => map_solution_groups(
            $_POST['solution_group_title'] ?? [],
            $_POST['solution_item_label'] ?? [],
            $_POST['solution_item_href'] ?? []
        ),
    ];
});
