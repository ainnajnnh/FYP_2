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

$statement = Utils::database()->prepare('SELECT * FROM users WHERE id = ?');
$statement->execute([$_SESSION['id']]);
$user = $statement->fetch();

$editing = isset($_GET['edit']);

if (isset($_POST['first-name'])) {
    $statement = Utils::database()->prepare('UPDATE users SET first_name = ?, last_name = ? WHERE id = ?');
    $statement->execute([strtoupper($_POST['first-name']), strtoupper($_POST['last-name']), $_SESSION['id']]);
    header('Location: ./profile.php?alert=profile-updated');
}

if (!empty($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
    $directory = "../uploads";
    $filename = time() . '_' . md5_file($_FILES['file']['tmp_name']) . '.' . pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

    if ($user['filename'] !== null) {
        if (file_exists("$directory/{$user['filename']}")) unlink("$directory/{$user['filename']}");
    }

    $statement = Utils::database()->prepare('UPDATE users SET filename = ? WHERE id = ?');
    $statement->execute([$filename, $_SESSION['id']]);
    if (!is_dir($directory)) mkdir($directory, 0777, true);
    move_uploaded_file($_FILES['file']['tmp_name'], "$directory/$filename");
    header('Location: ./profile.php?alert=profile-updated');
}

// Handle removing the profile picture
if (isset($_POST['remove-picture'])) {
    if ($user['filename'] !== null) {
        $directory = "../uploads";
        if (file_exists("$directory/{$user['filename']}")) unlink("$directory/{$user['filename']}");
    }
    $statement = Utils::database()->prepare('UPDATE users SET filename = NULL WHERE id = ?');
    $statement->execute([$_SESSION['id']]);
    header('Location: ./profile.php?alert=profile-updated');
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>User Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <link rel="stylesheet" href="../css/profile-style.css" />
</head>

<body>
    <?php include('../themes/parent/navbar.php'); ?>


    <div class="login-form">
        <div class="container">
            <h1>Welcome, <?= htmlspecialchars($user['first_name']) ?></h1>

            <?php if (isset($_GET['alert']) && $_GET['alert'] === 'profile-updated') : ?>
                <p class="success">Profile updated</p>
            <?php endif; ?>

            <br>

            <div class="main">
                <div class="form-img">
                    <?php if (!empty($user['filename'])) : ?>
                        <img id="profilePic" src="../uploads/<?= htmlspecialchars($user['filename']) ?>" alt="Profile Picture">
                    <?php else : ?>
                        <img id="profilePic" src="https://i.postimg.cc/85YMtY1m/OIP.jpg" alt="Profile Picture">
                    <?php endif; ?>
                </div>
                <div class="content">
                    <form enctype="multipart/form-data" method="post">
                        <div class="name-container">
                            <div class="field-group">
                                <label>First Name:</label>
                                <input name="first-name" value="<?= $user['first_name'] ?>" <?= $editing ? '' : 'disabled' ?> required>
                            </div>
                            <div class="field-group">
                                <label>Last Name:</label>
                                <input name="last-name" value="<?= $user['last_name'] ?>" <?= $editing ? '' : 'disabled' ?> required>
                            </div>
                        </div>
                        <label>Email: </label>
                        <input value="<?= $user['email'] ?>" disabled>
                        <?php if ($editing) : ?>
                            <label>Upload profile picture:</label>
                            <input accept="image/png, image/jpeg" name="file" type="file">
                            <button type="submit">Save</button>
                            <button type="submit" name="remove-picture">Remove Picture</button>
                        <?php else : ?>
                            <a href="./profile.php?edit=1"><button type="button">Edit</button></a>
                        <?php endif; ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<script src="../js/timeout.js"></script>

