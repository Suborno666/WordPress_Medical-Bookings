<?php

global $current_user;

?>


<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title><?php echo get_bloginfo('name')?></title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">

        <?php
            wp_head();
        ?>
    </head>

    <body>

        <!-- Spinner Start -->
        <div id="spinner" class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
            <div class="spinner-grow text-primary" role="status"></div>
        </div>
        <!-- Spinner End -->


        <!-- Navbar start -->
        <div class="container-fluid fixed-top">
            <div class="container topbar bg-primary d-none d-lg-block">
                <div class="d-flex justify-content-between">
                    <div class="top-info ps-2">
                        <small class="me-3"><i class="fas fa-map-marker-alt me-2 text-secondary"></i> <a href="#" class="text-white">123 Street, New York</a></small>
                        <small class="me-3"><i class="fas fa-envelope me-2 text-secondary"></i><a href="#" class="text-white">Email@Example.com</a></small>
                    </div>
                    <div class="top-link pe-2">
                        <a href="#" class="text-white"><small class="text-white mx-2">Privacy Policy</small>/</a>
                        <a href="#" class="text-white"><small class="text-white mx-2">Terms of Use</small>/</a>
                        <a href="#" class="text-white"><small class="text-white ms-2">Sales and Refunds</small></a>
                    </div>
                </div>
            </div>
            <div class="container px-0">
                <nav class="navbar navbar-light bg-white navbar-expand-xl">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="navbar-brand"><h1 class="text-primary display-6"><?php echo get_bloginfo('name')?></h1></a>
                    <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                        <span class="fa fa-bars text-primary"></span>
                    </button>
                    <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                        <div class="navbar-nav mx-auto">
                            <!---MENUS--->
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nav-item nav-link">Home</a>
                            <a href="<?php echo get_the_permalink(94);?>" class="nav-item nav-link">Shop</a>
                            <a href="shop-detail.html" class="nav-item nav-link">Shop Detail</a>
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                                <div class="dropdown-menu m-0 bg-secondary rounded-0">
                                    <a href="cart.html" class="dropdown-item">Cart</a>
                                    <a href="chackout.html" class="dropdown-item">Chackout</a>
                                    <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                                    <a href="404.html" class="dropdown-item">404 Page</a>
                                </div>
                            </div>
                            <a href="contact.html" class="nav-item nav-link">Contact</a>
                        </div>
                        <div class="d-flex m-3 me-0">
                            <button class="btn-search btn border border-secondary btn-md-square rounded-circle bg-white me-4" data-bs-toggle="modal" data-bs-target="#searchModal"><i class="fas fa-search text-primary"></i></button>
                            <a href="#" class="position-relative me-4 my-auto">
                                <i class="fa fa-shopping-bag fa-2x"></i>
                                <span class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1" style="top: -5px; left: 15px; height: 20px; min-width: 20px;">3</span>
                            </a>
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                                    <i class="fas fa-user fa-2x"></i>
                                </a>

                                <div class="dropdown-menu m-0 bg-secondary rounded-0">
                                    <?php
                                    if(!is_user_logged_in()){
                                        $current_user = wp_get_current_user();
                                    ?>
                                        <a href="<?php echo get_the_permalink(23);?>" class="dropdown-item">Register</a>
                                    <?php } else {?>
                                        <a class="dropdown-item"><?php echo $current_user->display_name;?></a>
                                        <a href="<?php echo get_the_permalink(31);?>" class="dropdown-item">Update User</a>
                                    <?php }?>
                                    <?php
                                    if ( is_user_logged_in() ) {
                                    ?>
                                        <a href="<?php echo wp_logout_url( home_url()); ?>" class="dropdown-item">Logout</a>
                                    <?php } else {?>
                                        <a href="<?php echo get_the_permalink(15);?>" class="dropdown-item">Login</a>
                                    <?php } ?>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <!-- Navbar End -->