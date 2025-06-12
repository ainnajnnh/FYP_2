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
$statement = Utils::database()->prepare('SELECT * FROM checklists ORDER BY title');
$statement->execute();
$checklists = $statement->fetchAll();

$statement = Utils::database()->prepare('SELECT * FROM checklist_items ORDER BY created_timestamp DESC');
$statement->execute();
$checklistItems = $statement->fetchAll();

if (isset($_GET['delete'])) {
    $statement = Utils::database()->prepare('DELETE FROM checklists WHERE id = ?');
    $statement->execute([$_GET['id']]);
    header('Location: ./checklists.php');
}

if (isset($_GET['delete-item'])) {
    $statement = Utils::database()->prepare('DELETE FROM checklist_items WHERE id = ?');
    $statement->execute([$_GET['id']]);
    header('Location: ./checklists.php');
}

if (isset($_GET['done-item'])) {
    $statement = Utils::database()->prepare('UPDATE checklist_items SET is_done = 1 WHERE id = ?');
    $statement->execute([$_GET['id']]);
    header('Location: ./checklists.php');
}

if (isset($_POST['checklist-id'])) {
    $statement = Utils::database()->prepare("INSERT INTO checklist_items (checklist_id, item) VALUES (?, ?)");
    $statement->execute([$_POST['checklist-id'], $_POST['item-title']]);
    header('Location: ./checklists.php');
}

if (isset($_POST['title'])) {
    $statement = Utils::database()->prepare("INSERT INTO checklists (user_id, title) VALUES (?, ?)");
    $statement->execute([$_SESSION['id'], $_POST['title']]);
    header('Location: ./checklists.php');
}

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head runat="server">
    <title>Admin Checklists</title>
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
                <h3>Admin Checklists</h3>
            </div>
        </section>
 

        <div class="container" >
            <h1>Checklist Manager</h1>

            <form class="input-container" method="post">
                <input type="text" name="title" placeholder="Enter checklist title" required>
                <button type="submit">Add Checklist</button>
            </form>

            <div id="checklist-container">
                <?php foreach ($checklists as $checklist): ?>
                    <div class="checklist">
                        <h2>
                            <span><?= $checklist['title'] ?></span>
                            <a href="./checklists.php?delete&id=<?= $checklist['id'] ?>" class="delete">Delete</a>
                        </h2>

                        <ul class="checklist-items">
                            <?php foreach ($checklistItems as $item): ?>
                                <?php if ($item['checklist_id'] === $checklist['id']): ?>
                                    <li class="list-item" style="display: flex; align-items: center; justify-content: space-between;">
                                        <div style="display: flex; align-items: center;">
                                            <form method="get" style="margin-right: 10px;">
                                                <input type="hidden" name="done-item" value="1">
                                                <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                                <input type="checkbox" onchange="this.form.submit()" <?= $item['is_done'] ? 'checked disabled' : '' ?>>
                                            </form>
                                            <span class="<?= $item['is_done'] === 0 ? '' : 'done' ?>"><?= $item['item'] ?></span>
                                        </div>
                                        <a href="./checklists.php?delete-item&id=<?= $item['id'] ?>" class="delete" style="color: red; text-decoration: none;">🗑️</a>
                                    </li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>

                        <form class="add-item" method="post">
                            <input type="text" name="item-title" placeholder="Add new item...">
                            <input type="hidden" name="checklist-id" value="<?= $checklist['id'] ?>">
                            <button type="submit" style="margin-top:10px">Add Item</button>
                        </form>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div> 
</body>

</html>

<script src="../js/timeout.js"></script>

