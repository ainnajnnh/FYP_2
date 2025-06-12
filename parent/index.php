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
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head runat="server">
    <title>Home Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <link rel="stylesheet" href="../css/style-copy.css" />
</head>

<body>
    <?php include('../themes/parent/navbar.php'); ?>


    <section class="home" id="home">
        <div class="content">
            <h3>We Care</h3>
            <h3>Your Baby</h3>
            <br>
            <span>Welcome to the </span><br>
            <span>First Steps Parenting Portal</span><br>
            <span>that focus on how to take</span><br>
            <span>care of your baby on the </span><br>
            <span>first 0-3 months .</span>
             
        </div>
    </section>

    <section class="home2" id="home">
        <div class="content2-parent">
        <h2 style="font-size: 3rem; color: #333; text-align: center; margin-top: 4rem;">Explore Our Resources</h2>
 
            <div class="dashboard-grid">
                <a href="baby-care.php" class="dashboard-card"> 
                    <img src="https://i.postimg.cc/JnPVM857/600c44dc3d006bc3f4c6701122a79a73-1.jpg" 
                        alt="Baby Care" 
                        class="card-image"><br>
                    <p>Baby Care</p><br>
                    <h4>Information for baby care (0–3 months)</h4>
                </a>
                <a href="mommies-care.php" class="dashboard-card"> 
                    <img src="https://i.postimg.cc/FsvWG8yD/hero-postpartum-care-5689153282541429286.jpg" 
                        alt="Baby Care" 
                        class="card-image"><br>
                    <p>Normal Delivery Care</p><br>
                    <h4>Postpartum care for moms</h4></a>
                <a href="caesar-care.php" class="dashboard-card">
                    
                    <img src="https://i.postimg.cc/TYPmRcfT/mother-smiles-as-she-holds-newborn-baby-while-resting-in-bed.jpg" 
                        alt="Baby Care" 
                        class="card-image"><br>
                    <p>C-Section Delivery Care</p><br>
                    <h4>Recovery tips and care after C-section</h4>
                </a>  
            </div>

        </div>
    </section>
</body>

</html>

<script src="../js/timeout.js"></script>
