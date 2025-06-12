<?php

declare(strict_types=1);

use App\Utils;

require '../vendor/autoload.php';

session_start();
date_default_timezone_set('Asia/Kuching');
Utils::gate('parent');
if (isset($_SESSION['id'])) {
    Utils::checkSessionTimeout();
}

$suggestions = Utils::database()->prepare('SELECT * FROM checklists ORDER BY title');
$suggestions->execute();
$suggestionsLists = $suggestions->fetchAll();

 
// $checklist_p = Utils::database()->prepare('SELECT * FROM checklist_items_parent join checklist_items on checklist_items_parent.checklist_item_id =  checklist_items.id  WHERE checklist_items_parent.user_id = ? ORDER BY checklist_items_parent.created_timestamp');
$checklist_p = Utils::database()->prepare('SELECT checklist_items_parent.checklist_id as checklist_id_p, checklist_items.item,  checklist_items_parent.item as parentItem, checklist_items_parent.id, checklist_items_parent.is_done FROM checklist_items_parent LEFT JOIN checklist_items on checklist_items_parent.checklist_item_id =  checklist_items.id  WHERE checklist_items_parent.user_id = ? ORDER BY checklist_items_parent.created_timestamp');
$checklist_p->execute([$_SESSION['id']]);
$checklistParent = $checklist_p->fetchAll();

$statement = Utils::database()->prepare('SELECT DISTINCT title, id, user_id FROM checklists_parent  WHERE user_id = ?  ORDER BY title');
$statement->execute([$_SESSION['id']]);
$checklists = $statement->fetchAll();

$statement = Utils::database()->prepare('SELECT * FROM checklist_items ORDER BY created_timestamp DESC');
$statement->execute();
$checklistItems = $statement->fetchAll();


if (isset($_GET['delete'])) {
    $statement = Utils::database()->prepare('DELETE FROM checklists_parent WHERE id = ?'); 
    $statement->execute([$_GET['id']]);


    $statement = Utils::database()->prepare('DELETE FROM checklist_items_parent WHERE checklist_id = ? AND user_id = ?'); 
    $statement->execute([$_GET['id'], $_SESSION['id']]);
 
    header('Location: ./checklists.php');
}

if (isset($_GET['delete-item'])) {
    $statement = Utils::database()->prepare('DELETE FROM checklist_items_parent WHERE id = ?');
    $statement->execute([$_GET['id']]);
    header('Location: ./checklists.php');
}

if (isset($_GET['done-item'])) {
    $statement = Utils::database()->prepare('UPDATE checklist_items_parent SET is_done = 1 WHERE id = ?');
    $statement->execute([$_GET['id']]);
    header('Location: ./checklists.php');
}

if (isset($_POST['checklist'])) {
    $checklist = json_decode(base64_decode($_POST['checklist']), true);
    $database = Utils::database();
    $statement = $database->prepare("INSERT INTO checklists (user_id, title) VALUES (?, ?)");
    $statement->execute([$_SESSION['id'],  $checklist['name']]);
    $id = $database->lastInsertId();

    foreach ($checklist['items'] as $item) {
        $statement = $database->prepare("INSERT INTO checklist_items (checklist_id, item) VALUES (?, ?)");
        $statement->execute([$id, $item]);
    }

    header('Location: ./checklists.php');
} 

if (isset($_POST['add_checklist'])) {
    $database = Utils::database();
    
    $checklist_id = $_POST['checklist_id'];
    $item_ids = $_POST['item_ids']; 
    $title = $_POST['title'];

    
    $statement = $database->prepare("INSERT INTO checklists_parent (checklist_id, user_id, title) VALUES (?, ?, ?)");
    $statement->execute( [ $checklist_id, $_SESSION['id'], $title]);
    $id = $database->lastInsertId();
     
    $statement = $database->prepare("INSERT INTO checklist_items_parent (checklist_id, checklist_item_id, user_id) VALUES (?, ?, ?)");
     
    foreach ($item_ids as $item_id) {
        $statement->execute([$id, $item_id, $_SESSION['id']]);
    }

    
    header('Location: ./checklists.php');
    exit;
}

if (isset($_POST['checklist-id'])) {
    $statement = Utils::database()->prepare("INSERT INTO checklist_items_parent (checklist_id, item, user_id) VALUES (?, ?, ?)");
    $statement->execute([$_POST['checklist-id'], $_POST['item-title'], $_SESSION['id']]);
    header('Location: ./checklists.php');
}

if (isset($_POST['title'])) {
    $statement = Utils::database()->prepare("INSERT INTO checklists_parent (user_id, title) VALUES (?, ?)");
    $statement->execute([$_SESSION['id'], $_POST['title']]);
    header('Location: ./checklists.php');
}

?>



<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head runat="server">
    <title>Baby Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <link rel="stylesheet" href="../css/checklists-style.css" />
</head>

<body>
    <?php include('../themes/parent/navbar.php'); ?>


    <section class="about" id="about">
        <div class="content">
            <h3>Your Checklists</h3>
        </div>
    </section>

    <div class="container">
        <h1>Checklist Suggestions</h1>

        <div id="checklist-container" style="margin-top:20px">
            <?php foreach ($suggestionsLists as $suggestionsLists): ?>
                <div class="checklist">
                    <h2><span><?= $suggestionsLists['title'] ?></span></h2>

                    <form method="post">
                        <ul class="checklist-items">
                            <?php foreach ($checklistItems as $item): ?>
                                <?php if ($item['checklist_id'] === $suggestionsLists['id']): ?> 
                                    <input type="hidden" name="item_ids[]" value="<?= $item['id'] ?>">
                                    <input type="hidden" name="items[]" value="<?= $item['item'] ?>">
                                    <li><span><?= $item['item'] ?></span></li>
                                <?php endif; ?>
                            <?php endforeach; ?> 
                        </ul>

                        <br><br>
                   
                        <input type="hidden" name="checklist_id" value="<?= $suggestionsLists['id'] ?>">
                        <input type="hidden" name="title" value="<?= $suggestionsLists['title'] ?>">
                        <button type="submit" name="add_checklist">Add to Checklist</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    
<div class="container"> 
 
        <br><br>
        <h1>My Checklists</h1>

        <form class="input-container" method="post">
            <input type="text" name="title" placeholder="Enter checklist title" required>
            <button type="submit">Add Checklist</button>
        </form>

        <div id="checklist-container">
            <?php foreach ($checklists as $checklist): ?>
                <?php 
                    // Calculate progress for this checklist
                    $totalItems = 0;
                    $completedItems = 0;
                    
                    foreach ($checklistParent as $item) {
                        if ($item['checklist_id_p'] === $checklist['id']) {
                            $totalItems++;
                            if ($item['is_done']) {
                                $completedItems++;
                            }
                        }
                    }
                    
                    $progressPercentage = $totalItems > 0 ? round(($completedItems / $totalItems) * 100) : 0;
                ?>
                
                <div class="checklist">
                    <h2>
                        <span><?= $checklist['title'] ?></span>
                        <a href="./checklists.php?delete&id=<?= $checklist['id'] ?>" class="delete">Delete </a>
                    </h2>

                    <!-- Progress Bar Section -->
                    <div class="progress-container" style="margin: 15px 0; background-color: #f0f0f0; border-radius: 10px; overflow: hidden; height: 20px; position: relative;">
                        <div class="progress-bar" style="
                            width: <?= $progressPercentage ?>%; 
                            height: 100%; 
                            background: linear-gradient(90deg, #4CAF50 0%, #45a049 100%);
                            transition: width 0.3s ease;
                            border-radius: 10px;
                        "></div>
                        <div class="progress-text" style="
                            position: absolute; 
                            top: 50%; 
                            left: 50%; 
                            transform: translate(-50%, -50%); 
                            font-size: 12px; 
                            font-weight: bold; 
                            color: <?= $progressPercentage > 50 ? 'white' : '#333' ?>;
                        ">
                            <?= $completedItems ?>/<?= $totalItems ?> (<?= $progressPercentage ?>%)
                        </div>
                    </div>

                    <ul class="checklist-items">
                        <?php foreach ($checklistParent as $item): ?> 
                            <?php if ($item['checklist_id_p'] === $checklist['id']): ?>
                                <li class="list-item" style="display: flex; align-items: center; justify-content: space-between;">
                                    <div style="display: flex; align-items: center;">
                                        <form method="get" style="margin-right: 10px;">
                                            <input type="hidden" name="done-item" value="1">
                                            <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                            <input type="checkbox" onchange="this.form.submit()" <?= $item['is_done'] ? 'checked disabled' : '' ?>>
                                        </form>
                                        <span class="<?= $item['is_done'] === 0 ? '' : 'done' ?>">
                                            <?php if($item['item'] == NULL) {
                                                    echo $item['parentItem']; }
                                                else {
                                                    echo $item['item']; } 
                                            ?>
                                        </span>
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
</body>

</html>
<script src="../js/timeout.js"></script>

