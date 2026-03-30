<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/_shared.php';

admin_render_page('blog', 'Blog', 'Tambah, edit, dan hapus artikel blog dari CMS admin.', 'blog', static function (array &$updated): void {
    $updated['blog'] = [
        'items' => map_blog_items(
            $_POST['blog_title'] ?? [],
            $_POST['blog_excerpt'] ?? [],
            $_POST['blog_content'] ?? [],
            handle_blog_image_uploads($_FILES['blog_image'] ?? [], $_POST['blog_image_existing'] ?? []),
            $_POST['blog_featured'] ?? [],
            $_POST['blog_popular'] ?? [],
            $_POST['blog_published_at'] ?? [],
            $_POST['blog_delete'] ?? []
        ),
    ];
});
