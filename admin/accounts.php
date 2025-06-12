<?php

declare(strict_types=1);

use App\Utils;

require '../vendor/autoload.php';

session_start();
date_default_timezone_set('Asia/Kuching');
Utils::gate();


if (isset($_SESSION['id'])) {
    Utils::checkSessionTimeout();
}

$counter = 1;
$statement = Utils::database()->prepare('SELECT * FROM users ORDER BY role, first_name');
$statement->execute();
$users = $statement->fetchAll();

if (isset($_GET['switch'])) {
    $statement = Utils::database()->prepare('SELECT is_enabled FROM users WHERE id = ?');
    $statement->execute([$_GET['id']]);
    $isEnabled = (bool) $statement->fetchColumn();
    $statement = Utils::database()->prepare('UPDATE users SET is_enabled = ? WHERE id = ?');
    $statement->execute([(int) !$isEnabled, $_GET['id']]);
    header('Location: ./accounts.php');
}

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head runat="server">
    <title>Admin Account Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <link rel="stylesheet" href="../css/admin-style.css" />
    <link rel="stylesheet" href="../css/sidebar-style.css" /> 
</head>
 

    <body>
    
    <?php include('../themes/admin/sidebar.php'); ?>

    <!-- Main Content Area -->
    <div class="main-content">
        <section class="about" id="about">
            <div class="content">
                <h3>Admin Account Management</h3>
            </div>
        </section>

        <section class="info" id="info">
            <div class="row">
                <div class="content">
                    <h3>User Accounts</h3>

                    <table>
                        <thead>
                            <tr>
                                <th>№</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($users as $user): ?>
                                <tr>
                                    <th scope="row"><?= $counter++ ?></th>
                                    <td><?= $user['first_name'] ?></td>
                                    <td><?= $user['last_name'] ?></td>
                                    <td><?= $user['email'] ?></td>
                                    <td><?= ucfirst($user['role']) ?></td>

                                    <td class="text-end">
                                        <?php if ($user['role'] !== 'admin'): ?>
                                            <?php if ($user['is_enabled'] === 1): ?>
                                                <a class="btn btn-danger btn-sm" href="./accounts.php?switch&id=<?= $user['id'] ?>" role="button">Disable account</a>
                                            <?php else: ?>
                                                <a class="btn btn-success btn-sm" href="./accounts.php?switch&id=<?= $user['id'] ?>" role="button">Enable account</a>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>

</body>

</html>
<script src="../js/timeout.js"></script>
