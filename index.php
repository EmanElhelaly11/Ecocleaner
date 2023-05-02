<?php

include_once ('config/database.php');
include_once ('classes/Post.php');
include('includes/headerhome.php');

session_start();
?>

<body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="index.php">Ecocleaner</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto py-4 py-lg-0">
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="Pages/home.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="Pages/achievements.php">Achievements</a></li>

                    <?php if (isset($_SESSION['user_id'])) {?>
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href=""><?= $_SESSION['username'] ?></a></li>
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="Pages/logout.php">Logout</a></li>
                    <?php } ?>

                    <?php
                    if (!isset($_SESSION['user_id'])) {
                    ?>
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="Pages/login.php">LOGIN</a></li>
                    <?php } else { ?>
                    <?php } ?>

                </ul>
            </div>
        </div>
    </nav>
    
    <header class="masthead" style="background-image: url('assets/img/home.jpg')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="site-heading">
                        <h1>Ecocleaner</h1>
                        <span class="subheading">A cleaner community starts with you.</span>
                    </div>
                </div>
            </div>
        </div>
    </header>
    
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
               <p><h3>Welcome to Ecocleaner,</h3>Capture, report, and clean for a better tomorrow.</p>
                <p>We are here to help you keep the environment clean and protect our community. With our website,
                     you can easily report areas where trash and waste have accumulated, add photos and descriptions, and even mark the 
                    location on Google Maps. Together, we can make a difference and keep our city clean.</p>
                    
                    <center> 
                        <a href="Pages/register.php">
                        <button class="btn btn-success btn-block mb-4">
                        Join Us
                        </button>
                        </a>
                    </center>
                </div>
        </div>
    </div>

<?php include('includes/footerhome.php'); ?>
