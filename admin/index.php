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
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head runat="server">
    <title>Home Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <link rel="stylesheet" href="../css/style.css" /> 
    <link rel="stylesheet" href="../css/sidebar-style.css" /> 
</head>
 

    <body>
    
    <?php include('../themes/admin/sidebar.php'); ?>

    <!-- Main Content Area -->
    <div class="main-content">
        <section class="home admin" id="home">
            <div class="content2">
                <h2>Admin Dashboard</h2>
                <div class="dashboard-grid">
                    <a href="baby.php" class="dashboard-card"><i class="fas fa-baby"></i>
                        <p>Baby Care</p>
                        <h4>Information for baby care (0–3 months)</h4></a>
                    <a href="mom.php" class="dashboard-card"><i class="fas fa-female"></i>
                        <p>Mom Normal Care</p>
                        <h4>Postpartum care for moms</h4></a>
                    <a href="caesar.php" class="dashboard-card"><i class="fas fa-bed"></i>
                        <p>C-Section Care</p>
                        <h4>Recovery tips and care after C-section</h4></a>
                    <a href="checklists.php" class="dashboard-card"><i class="fas fa-clipboard-check"></i>
                        <p>Checklists</p>
                        <h4>Checklists for newborns and moms</p></h4>
                    <a href="accounts.php" class="dashboard-card"><i class="fas fa-users-cog"></i>
                        <p>Manage Accounts</p>
                        <h4>Admin user account control</h4></a>
                    </div>

            </div>
        </section>
    </div>
</body>

</html>
 
<script src="../js/timeout.js"></script>
