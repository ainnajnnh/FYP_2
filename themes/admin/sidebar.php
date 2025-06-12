 <nav class="sidebar">
    <a href="./" class="logo">First Steps<span>Parenting</span></a>
    
    <ul class="sidebar-nav">
        <li>
            <a href="./" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'index.php' || basename($_SERVER['PHP_SELF']) == '') ? 'active' : ''; ?>">Home</a>
        </li>
        <li>
            <a href="./baby.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'baby.php') ? 'active' : ''; ?>">Baby Care</a>
        </li>
        <li class="dropdown">
            <div class="dropbtn <?php echo (basename($_SERVER['PHP_SELF']) == 'mom.php' || basename($_SERVER['PHP_SELF']) == 'caesar.php') ? 'active' : ''; ?>">Mommies Care</div>
            <div class="dropdown-content">
                <a href="./mom.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'mom.php') ? 'active' : ''; ?>">Normal Care</a>
                <a href="./caesar.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'caesar.php') ? 'active' : ''; ?>">C-section Care</a>
            </div>
        </li>
        <li>
            <a href="./checklists.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'checklists.php') ? 'active' : ''; ?>">Checklists</a>
        </li>
        <li>
            <a href="./accounts.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'accounts.php') ? 'active' : ''; ?>">Manage Accounts</a>
        </li>
    </ul>

    <div class="logout-btn">
        <a href="../logout.php"><i class="fas fa-sign-out-alt"></i></a>
    </div>
</nav>