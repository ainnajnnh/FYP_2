<?php

declare(strict_types=1);

use App\Utils;

require 'vendor/autoload.php';

session_start();
date_default_timezone_set('Asia/Kuching');

if (isset($_GET['code'])) {
    session_destroy();
    $statement = Utils::database()->prepare('SELECT * FROM users WHERE reset_code = ?');
    $statement->execute([$_GET['code']]);

    if ($statement->rowCount() > 0) {
        $user = $statement->fetch();
        $statement = Utils::database()->prepare('UPDATE users SET password = ?, reset_code = NULL, new_password = NULL WHERE id = ?');
        $statement->execute([$user['new_password'], $user['id']]);
        header('Location: ./login.php?alert=reset-success');
    } else {
        header('Location: ./');
    }
} else {
    header('Location: ./');
}
