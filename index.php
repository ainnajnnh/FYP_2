<?php

declare(strict_types=1);

require 'vendor/autoload.php';

session_start();
date_default_timezone_set('Asia/Kuching');

if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] === 'admin') {
        header('Location: ./admin');
    }

    if ($_SESSION['role'] === 'parent') {
        header('Location: ./parent');
    }
}

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head runat="server">
    <title>Landing Page</title>
    <a href="https://indah.ump.edu.my/RC23199/babyweb2/">PTA Project</a>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <link rel="stylesheet" href="css/style-copy.css" />
</head>

<body>
    <header>
        <a href="#" class="logo">First Steps<span> Parenting .</span></a>

        <nav class="navbar">
            <a href="./register.php">Register</a>
            <a href="./login.php">Login</a>
        </nav>
    </header>

    <section class="home landing-page" id="home">
        <div class="content">
            <h3>We Care</h3>
            <h3>Your Baby</h3>
            <br>
            <span>Welcome to the </span>
            <br>
            <span>First Steps Parenting Portal</span>
            <p>
                <a href="register.php" class="btn">Register</a>
                <a href="login.php" class="btn">Login</a> </p>
        </div>
    </section>
</body>

</html>
