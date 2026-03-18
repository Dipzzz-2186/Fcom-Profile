<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/app/bootstrap.php';

if (! is_admin_logged_in()) {
    redirect('/admin/login');
}

redirect('/admin/company');
