<?php

declare(strict_types=1);

use App\Utils;

require 'vendor/autoload.php';

session_start();
date_default_timezone_set('Asia/Kuching');

if (isset($_SESSION['id'])) {
    header('Location: ./');
}

if (!empty($_POST['password'])) {
    $statement = Utils::database()->prepare('SELECT * FROM users WHERE email = ?');
    $statement->execute([$_POST['email']]);

    if ($user = $statement->fetch()) {
        $passwordToVerify = !empty($user['new_password']) ? $user['new_password'] : $user['password'];
        
        
        if (password_verify($_POST['password'], $passwordToVerify) && $user['is_enabled'] === 1) {
            $_SESSION['id'] = $user['id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['login_time'] = time();
            header('Location: ./');
        } else {

            if($user['is_enabled'] === 0){
                header('Location: ./login.php?alert=account-not-exist');
            }else{
                header('Location: ./login.php?alert=wrong-password');
            }
            
        }
    } else {
        header('Location: ./login.php?alert=wrong-password');
    }
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head runat="server">
    <title>Log In</title>
    <link rel="stylesheet" href="css/login-style.css" />
</head>


<style>
    /* Base Alert Styles */
.alert {
    padding: 12px 16px;
    margin: 10px 0;
    border: 1px solid transparent;
    border-radius: 6px;
    font-size: 14px;
    line-height: 1.4;
    position: relative;
    display: block;
}

/* Success Alert */
.alert-success {
    color: #155724;
    background-color: #d4edda;
    border-color: #c3e6cb;
}

/* Info Alert */
.alert-info {
    color: #0c5460;
    background-color: #d1ecf1;
    border-color: #bee5eb;
}

/* Warning Alert */
.alert-warning {
    color: #856404;
    background-color: #fff3cd;
    border-color: #ffeaa7;
}
 
.alert-danger {
    color: #721c24;
    background-color: #f8d7da;
    border-color: #f5c6cb;
} 
.alert-modern {
    padding: 16px 20px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    border-left: 4px solid;
    font-weight: 500;
}

.alert-modern.alert-success {
    border-left-color: #28a745;
    background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
}

.alert-modern.alert-info {
    border-left-color: #17a2b8;
    background: linear-gradient(135deg, #d1ecf1 0%, #bee5eb 100%);
}

.alert-modern.alert-warning {
    border-left-color: #ffc107;
    background: linear-gradient(135deg, #fff3cd 0%, #ffeaa7 100%);
}

.alert-modern.alert-danger {
    border-left-color: #dc3545;
    background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
}

/* Dismissible Alert (with close button) */
.alert-dismissible {
    padding-right: 40px;
}
 

.alert .close:hover {
    opacity: 1;
}

/* Fade in animation */
.alert {
    animation: fadeIn 0.3s ease-in;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}

</style>
<body>
    <div class="login-form">
        <h1>Log In</h1>

        <div class="container">
            <div class="main">
                <div class="content">
                    <?php 
                    if (isset($_SESSION['flash_message'])) {
                        $flashMessage = $_SESSION['flash_message'];
                        unset($_SESSION['flash_message']);  ?>
                        <div class="alert alert-success">
                            New password has been updated 
                        </div>
                    <?php }
                    ?>
                    <h2>Log In</h2>

                    <?php if (isset($_GET['alert'])): ?>
                        <?php if ($_GET['alert'] === 'registration-success'): ?>
                            <p class="success">Registration successful! Please log in.</p>
                        <?php endif; ?>

                        <!-- <//?php if ($_GET['alert'] === 'reset-link-sent'): ?>
                            <p class="success">Reset link sent. Please check your email.</p>
                        <?//php endif; ?> -->

                        <?php if ($_GET['alert'] === 'reset-success'): ?>
                            <p class="success">Reset success! Please log in with your new password.</p>
                        <?php endif; ?>
                        
                        <?php if ($_GET['alert'] === 'account-not-exist'): ?>
                             <div class="alert alert-success">
                            This account doesn't exist!
                        </div>
                        <?php endif; ?>

                        <?php if ($_GET['alert'] === 'wrong-password'): ?>
                            <p class="error">Wrong email and/or password</p>
                        <?php endif; ?>

                        <?php if ($_GET['alert'] === 'session-expired'): ?>
                            <div class="alert alert-warning">
                                Your session has expired. Please log in again.
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>

                    <form method="post">
                        <input type="text" name="email" placeholder="Email" required autofocus="" />
                        <input type="password" name="password" placeholder="Password" required autofocus="" />
                        <button class="btn" type="submit">Login</button>
                    </form>

                    <p class="account">Don't Have An Account? <a href="register.php">Register</a></p>
                    <p class="account"><a href="forgot-password.php">Forgot Password?</a></p>
                </div>

                <div class="form-img">
                    <img src="https://i.postimg.cc/Gt5S3QfH/parents-Icon.jpg" alt="" />
                </div>
            </div>
        </div>
    </div>
</body>

</html>
