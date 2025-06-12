<?php

declare(strict_types=1);

namespace App;

use Dotenv\Dotenv;
use PDO;

class Utils
{

    public static function checkSessionTimeout() {
        $timeout_duration = 1800; // 30 minutes in seconds (30 * 60)
        
        if (isset($_SESSION['login_time'])) {
            if (time() - $_SESSION['login_time'] > $timeout_duration) {
                // Session has expired
                session_unset();
                session_destroy();
                header('Location: ../login.php?alert=session-expired');
                exit();
            } else { 
                $_SESSION['login_time'] = time();
            }
        }
    }


    static function database(): PDO
{
    $host = $_ENV['DB_HOST'];
    $database = $_ENV['DB_NAME'];
    $user = $_ENV['DB_USER'];
    $password = $_ENV['DB_PASS'];

    $dsn = "mysql:host=$host;dbname=$database;charset=utf8";
    return new PDO($dsn, $user, $password, [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
}


    static function gate(string $role = 'admin'): void
    {
        if (!isset($_SESSION['id'])) {
            header('Location: ../login.php');
            exit;
        }
    
        self::checkSessionTimeout();

        if ($_SESSION['role'] !== $role) {
            header('Location: ../logout.php');
            exit;
        }
    }
    

    static function generateCode(int $size = 8): string
    {
        return bin2hex(random_bytes($size / 2));
    }

    static function getName(int $id, array $users): string
    {
        $filtered = array_filter($users, function ($user) use ($id) {
            return $user['id'] === $id;
        });

        return reset($filtered)['name'];
    }

    static function loadEnv(string $dir = __DIR__ . '/..'): void
    {
        $dotenv = Dotenv::createImmutable($dir);
        $dotenv->load();
    }
}
