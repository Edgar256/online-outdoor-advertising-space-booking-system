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
<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <a href="dashboard.php" class="logo d-flex align-items-center">
            <img src="assets/img/logo.png" alt="">
            <span class="d-none d-lg-block">PremierAdvertising</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <div class="search-bar">
        <form class="search-form d-flex align-items-center" method="POST" action="#">
            <input type="text" name="query" placeholder="Search" title="Enter search keyword">
            <button type="submit" title="Search"><i class="bi bi-search"></i></button>
        </form>
    </div><!-- End Search Bar -->

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">

            <li class="nav-item d-block d-lg-none">
                <a class="nav-link nav-icon search-bar-toggle " href="#">
                    <i class="bi bi-search"></i>
                </a>
            </li><!-- End Search Icon-->

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
                            <span>(Admin)</span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="dashboard.php">
                                <i class="bi bi-grid"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>                       
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="users.php">
                                <i class="bi bi-people"></i>
                                <span>Users</span>
                            </a>
                        </li> 
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="admins.php">
                                <i class="bi bi-person-dash-fill"></i>
                                <span>Admins</span>
                            </a>
                        </li> 
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="locations.php">
                                <i class="bi bi-pin-map-fill"></i>
                                <span>Locations</span>
                            </a>
                        </li> 
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li class"px-3">
                            <strong>SPACES</strong>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="create-a-space.php">
                                <i class="bi bi-ui-radios-grid"></i>
                                <span>Create New Space</span>
                            </a>
                        </li> 
                        <li class"px-3">
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="spaces.php">
                                <i class="bi bi-ui-radios-grid"></i>
                                <span>Spaces</span>
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

</header>