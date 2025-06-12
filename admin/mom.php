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
$category = 'mom';
$counter = 1;
$statement = Utils::database()->prepare('SELECT * FROM contents WHERE category = ? ORDER BY title, created_timestamp');
$statement->execute([$category]);
$contents = $statement->fetchAll();

$editContent = null;
if (isset($_GET['id'])) {
    $statement = Utils::database()->prepare('SELECT * FROM contents WHERE id = ?');
    $statement->execute([$_GET['id']]);
    $editContent = $statement->fetch();
}

if (isset($_GET['delete'])) {
    $statement = Utils::database()->prepare('SELECT filename FROM contents WHERE id = ?');
    $statement->execute([$_GET['id']]);
    $filename = $statement->fetchColumn();

    if ($filename) {
        unlink("../uploads/$filename");
    }

    $statement = Utils::database()->prepare('DELETE FROM contents WHERE id = ?');
    $statement->execute([$_GET['id']]);
    header('Location: ./mom.php');
}

if (!empty($_POST['title']) && !empty($_POST['description'])) {
    if (!empty($_POST['id'])) {
        $query = 'UPDATE contents SET title = ?, description = ? WHERE id = ?';
        $params = [$_POST['title'], $_POST['description'], $_POST['id']];

        if (!empty($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $statement = Utils::database()->prepare('SELECT filename FROM contents WHERE id = ?');
            $statement->execute([$_POST['id']]);
            $oldFilename = $statement->fetchColumn();

            if ($oldFilename && file_exists("../uploads/$oldFilename")) {
                unlink("../uploads/$oldFilename");
            }

            $directory = "../uploads";
            $newFilename = time() . '_' . md5_file($_FILES['image']['tmp_name']) . '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            move_uploaded_file($_FILES['image']['tmp_name'], "$directory/$newFilename");

            $query = 'UPDATE contents SET title = ?, description = ?, filename = ? WHERE id = ?';
            $params = [$_POST['title'], $_POST['description'], $newFilename, $_POST['id']];
        }

        $statement = Utils::database()->prepare($query);
        $statement->execute($params);
    } else {
        $directory = "../uploads";
        $filename = time() . '_' . md5_file($_FILES['image']['tmp_name']) . '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        move_uploaded_file($_FILES['image']['tmp_name'], "$directory/$filename");

        $statement = Utils::database()->prepare('INSERT INTO contents (title, description, filename, category) VALUES (?, ?, ?, ?)');
        $statement->execute([$_POST['title'], $_POST['description'], $filename, $category]);
    }

    header('Location: ./mom.php');
}

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head runat="server">
    <title>Admin Mommies</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <link rel="stylesheet" href="../css/admin-style.css" />
    <link rel="stylesheet" href="../css/sidebar-style.css" /> 
 

    <body>
    
    <?php include('../themes/admin/sidebar.php'); ?>

    <!-- Main Content Area -->
    <div class="main-content">
        <section class="about" id="about">
            <div class="content">
                <h3>Admin Mommy Info</h3>
            </div>
        </section>

        <section class="info" id="info">
            <div class="row">
                <div class="content">
                    <table>
                        <thead>
                            <tr>
                                <th>№</th>
                                <th>Picture</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($contents as $content): ?>
                                <tr>
                                    <form method="get">
                                        <th scope="row"><?= $counter++ ?></th>
                                        <td><img src="../uploads/<?= $content['filename'] ?>"></td>
                                        <td><input type="text" name="title-edit" value="<?= $content['title'] ?>"></td>
                                        <td><textarea name="description-edit" rows="8"><?= $content['description'] ?></textarea></td>

                                        <td class="text-end">
                                            <input type="hidden" name="id" value="<?= $content['id'] ?>">
                                            <button type="submit">Edit</button>
                                            <a class="btn btn-success btn-sm" href="./mom.php?delete&id=<?= $content['id'] ?>" role="button">Delete</a>
                                        </td>
                                    </form>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <form class="upload-section" enctype="multipart/form-data" method="post">
            <h3><?= isset($editContent) ? 'Edit Entry' : 'Add New Entry' ?></h3>
            <input type="hidden" name="id" value="<?= $editContent['id'] ?? '' ?>">
            <input type="file" name="image" accept="image/*">
            <input type="text" placeholder="Enter Title" name="title" value="<?= $editContent['title'] ?? '' ?>">
            <textarea placeholder="Enter Description" name="description"><?= $editContent['description'] ?? '' ?></textarea>
            <button class="add-btn" type="submit"><?= isset($editContent) ? 'Update' : 'Add' ?></button>
        </form>
    </div>
</body>

</html>

<script src="../js/timeout.js"></script>

