<?php

declare(strict_types=1);

require 'vendor/autoload.php';

session_start();
date_default_timezone_set('Asia/Kuching');

session_destroy();

$message = isset($_GET['auto']) ? 'session-expired' : 'logged-out';
header("Location: login.php?alert=$message"); 
