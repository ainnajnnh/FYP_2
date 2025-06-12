<?php

declare(strict_types=1);

use App\Utils;

require 'vendor/autoload.php';

session_start();
date_default_timezone_set('Asia/Kuching');

if (isset($_SESSION['id'])) {
    header('Location: ./');
}

if (!empty($_POST['email'])) {
    $statement = Utils::database()->prepare('INSERT INTO users (email, first_name, last_name, password, role) VALUES (?, ?, ?, ?, ?)');
    $statement->execute([$_POST['email'], strtoupper($_POST['first_name']), strtoupper($_POST['last_name']), password_hash($_POST['password'], PASSWORD_DEFAULT), $_POST['role']]);
    header('Location: ./login.php?alert=registration-success');
}

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head runat="server">
    <title>Register</title>
    <link rel="stylesheet" href="css/login-style.css" />
</head>

<body>
    <div class="login-form">
        <h1>Register</h1>

        <div class="container">
            <div class="main">
                <div class="content">
                    <form method="post">
                        <input type="text" name="first_name" placeholder="First Name" required />
                        <input type="text" name="last_name" placeholder="Last Name" required />
                        <input type="email" name="email" placeholder="Email" required />
                        <input type="password" name="password" placeholder="Password" required />

                        <select name="role" required>
                            <option value="" disabled selected>Choose Role</option>
                            <option value="parent">Parent</option>
                            <option value="admin">Admin</option>
                        </select>

                        <button class="btn" type="submit">Register</button>
                    </form>

                    <p class="account">Already Have An Account? <a href="login.php">Login Here</a></p>
                </div>

                <div class="form-img">
                    <img src="https://i.postimg.cc/kG4pdZf0/momIcon.jpg" alt="" />
                </div>
            </div>
        </div>
    </div>
</body>

</html>
