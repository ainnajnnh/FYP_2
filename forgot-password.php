<?php

declare(strict_types=1);

use App\Utils;
use Mailgun\Mailgun;

require 'vendor/autoload.php';

session_start();
date_default_timezone_set('Asia/Kuching');
Utils::loadEnv();

if (isset($_SESSION['id'])) {
    header('Location: ./');
}

if (!empty($_POST['email'])) {
    $code = Utils::generateCode();
    $statement = Utils::database()->prepare('UPDATE users SET reset_code = ?, new_password = ? WHERE email = ?');
    $statement->execute([$code, password_hash($_POST['password'], PASSWORD_DEFAULT), $_POST['email']]);
    $url = implode('/', array_slice(explode('/', $_SERVER['HTTP_REFERER']), 0, -1));
 
    if ($statement->rowCount() > 0) { 
        $_SESSION['flash_message'] = 'New password has been updated';
        
        Mailgun::create($_ENV['MAILGUN_API_KEY'])->messages()->send($_ENV['MAILGUN_DOMAIN'], [
            'from' => $_ENV['MAILGUN_FROM'],
            'subject' => 'Baby Password Reset Link',
            'text' => "Reset link: $url/reset-password.php?code=$code",
            'to' => $_POST['email']
        ]);

        header('Location: ./login.php?alert=reset-link-sent');
    }
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head runat="server">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="css/login-style.css" />
</head>

<body>
    <div class="login-form">
        <h1>Forgot Password</h1>

        <div class="container">
            <div class="main">
                <div class="content">
                    <h2>Reset Your Password</h2>

                    <form method="post">
                        <input type="email" name="email" placeholder="Enter your email address" required />
                        <input type="password" name="password" placeholder="Enter new password" required />
                        <button class="btn" type="submit">Submit</button>
                    </form>

                    <p class="account"><a href="login.php">Back to Login</a></p>
                </div>

                <div class="form-img">
                    <img src="https://i.postimg.cc/JhLF4mmX/Forgot-password-Customizable-Isometric-Illustrations-Amico-Style.jpg" alt="" />
                </div>
            </div>
        </div>
    </div>
</body>

</html>
