<?php
// import Config File
require_once('./config/config.php');

// set FALSE to AUTH_ACTIVE SESSION VARIABLE
if (isset($_SESSION)) {
    session_start();
    $_SESSION['auth_active'] = FALSE;
} else {
    session_start();
    $_SESSION['auth_active'] = FALSE;
}

?>
<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="container d-flex">
        <div class="d-flex align-items-center justify-content-between">
            <a href="index.php" class="logo d-flex align-items-center">
                <img src="assets/img/logo.png" alt="">
                <span class="d-none d-lg-block">PremierAdvertising</span>
            </a>
        </div><!-- End Logo -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">
                <?php
                if (isset($_SESSION['auth_active']) && (isset($_SESSION['role']) == 'USER')) {
                    echo '<li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <img src="assets/img/default-img.jpg" alt="Profile" class="rounded-circle">
                        <span class="d-none d-md-block dropdown-toggle ps-2">' . $_SESSION['names'] . '</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6>' . $_SESSION['names'] . '</h6>
                            <span>(User)</span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="index.php">
                                <i class="bi bi-newspaper"></i>
                                <span>Home</span>
                            </a>
                        </li>                       
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="spaces-listing.php">
                                <i class="bi bi-grid-3x3-gap-fill"></i>
                                <span>Available Spaces</span>
                            </a>
                        </li> 
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="./auth/logout.php">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                        </li>
                    </ul>
                </li>';
                } else {
                    echo '<li><a href="user-login.php" class="btn btn-primary rounded-pill">Login</a></li><li><a href="user-register.php" class="btn btn-outline-primary rounded-pill mx-3">Create Account</a></li>';
                }
                ?>



            </ul>
        </nav><!-- End Icons Navigation -->
    </div>

</header><!-- End Header -->