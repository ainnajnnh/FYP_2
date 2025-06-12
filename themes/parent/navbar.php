<?php
// Get current page name
$current_page = basename($_SERVER['PHP_SELF']);
?>

<style>
/* General navbar link style */
.navbar a {
    padding: 10px 15px;
    text-decoration: none;
    color: #666;
    border-radius: 20px;
    transition: all 0.3s ease;
}

/* Hover effect */
.navbar a:hover {
    color: #EED9C4;
    background-color: #666;
    border-radius: 20px;
}

/* Active link style */
.navbar a.active,
.dropdown.active .dropbtn,
.dropdown-content a.active {
    color: #EED9C4 !important;
    background-color: #666;
    border-radius: 20px;
    
}

/* Dropdown menu styles */
.dropdown {
    position: relative;
    display: inline-block;
}

.dropbtn {
    font-size: 2rem;
    padding: 0 1.5rem;
    color: #666;
    cursor: pointer;
    border-radius: 20px;
    transition: all 0.3s ease;
}

.dropdown:hover .dropbtn {
    color: #EED9C4;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, .1);
    z-index: 1;
    border-radius: 20px;
    padding: 10px 0;
}

.dropdown-content a {
    color: #666;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    border-radius: 20px;
    transition: background-color 0.3s ease;
}

.dropdown-content a:hover {
    background-color: #666;
    color: #fff;
}

/* Show dropdown on hover */
.dropdown:hover .dropdown-content {
    display: block;
}
</style>

<header>
    <a href="./" class="logo">First Steps<span> Parenting</span></a>

    <nav class="navbar">
        <a href="./" class="<?php echo ($current_page == 'index.php' || $current_page == '') ? 'active' : ''; ?>">Home</a>
        
        <a href="./baby-care.php" class="<?php echo ($current_page == 'baby-care.php') ? 'active' : ''; ?>">Baby Care</a>
        
        <div class="dropdown <?php echo (in_array($current_page, ['mommies-care.php', 'caesar-care.php'])) ? 'active' : ''; ?>">
            <div class="dropbtn">Mommies Care</div>
            <div class="dropdown-content">
                <a href="./mommies-care.php" class="<?php echo ($current_page == 'mommies-care.php') ? 'active' : ''; ?>">Normal Care</a>
                <a href="./caesar-care.php" class="<?php echo ($current_page == 'caesar-care.php') ? 'active' : ''; ?>">C-section Care</a>
            </div>
        </div>
        
        <a href="./checklists.php" class="<?php echo ($current_page == 'checklists.php') ? 'active' : ''; ?>">Checklists</a>
        
        <a href="./profile.php" class="logout-icon <?php echo ($current_page == 'profile.php') ? 'active' : ''; ?>">
            <i class="fas fa-user-circle"></i>
        </a>
        
        <a href="../logout.php" class="logout-icon">
            <i class="fas fa-sign-out-alt"></i>
        </a>
    </nav>
</header>
