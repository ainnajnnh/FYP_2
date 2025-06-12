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
$category = 'caesar';
$statement = Utils::database()->prepare('SELECT * FROM contents WHERE category = ? ORDER BY title, created_timestamp');
$statement->execute([$category]);
$contents = $statement->fetchAll();

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head runat="server">
    <title>C-section Care Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <link rel="stylesheet" href="../css/mommies-care-style.css" />
</head>

<body>
    <?php include('../themes/parent/navbar.php'); ?>


    <section class="about" id="about">
        <div class="content">
            <h3>Caesar Care</h3>
        </div>
    </section>

    <section class="info" id="info">
        <?php if (!empty($contents)): ?>
            <div class="search-bar">
                <a href="#" class="search-icon"><i class="fas fa-search fa-3x"></i></a>
                <input type="text" id="searchInput" placeholder="Search..." onkeyup="filterContent()"style="padding: 10px; font-size: 1.6rem; border: 1px solid #ccc; border-radius: 5px; margin-left: 1rem;">
            </div>
        <?php endif; ?>

        <?php foreach ($contents as $content): ?>
            <div class="row">
                <img style="aspect-ratio: 4/3" src="../uploads/<?= $content['filename'] ?>" alt="Baby Care">

                <div class="content">
                    <h3><?= $content['title'] ?></h3>
                    <p class="short-text"><?= explode("\n", $content['description'])[0] ?></p>
                    <p class="long-text" style="white-space: pre-line"><?= $content['description'] ?></p>
                    <button class="read-more-btn">Read More</button>
                </div>
            </div>
        <?php endforeach; ?>
    </section>

    <script src="../js/app.js"></script>
</body>

</html>
<script src="../js/timeout.js"></script>

