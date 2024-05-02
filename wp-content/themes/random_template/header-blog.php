<!DOCTYPE html>
<html lang="en"> 
<head>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Blog Site Template">
    <meta name="author" content="https://youtube.com/FollowAndrew">    
    <link rel="shortcut icon" href="/wp-content/themes/random_template/assets/images/logo.png"> 
    
    <?php
    get_search_form();
    ?>
</head> 

<body>
    
    <header class="header text-center">	    
	    <a class="site-title pt-lg-4 mb-0" href="#"><?php echo get_bloginfo('name')?></a>
        
	    <nav class="navbar navbar-expand-lg navbar-dark" >
           
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
			</button>

			<div id="navigation" class="collapse navbar-collapse flex-column" >

                <?php
                    if(function_exists('the_custom_logo')){
                        $custom_logo_id = get_theme_mod('custom_logo');
                        $logo = wp_get_attachment_image_src($custom_logo_id);
                        // print_r($logo);
                    }
                ?>
				<img class="mb-3 mx-auto logo" 
                src="
                <?php
                if(isset($logo)&&is_array($logo)){
                    $LogoImg = $logo[0];
                    echo $LogoImg;
                }else{
                    $LogoImg = "/wordpress/wp-content/themes/random_template/assets/images/logo.png";
                    echo $LogoImg;
                }

                ?>" 
                
                alt="logo">
			
                <?php 
                    wp_nav_menu(
                        [
                            'menu'=>'primary',
                            'container'=>'',
                            'theme_location'=>'primary',
                            'items_wrap'=>'<ul id="" class="navbar-nav flex-column text-sm-center text-md-left">%3$s</ul>'
                        ]
                    );
                

                // wp_nav_menu( array( 
                //     'menu' => 'Header menu', 
                //     'menu_class' => 'main-nav__navigation-box',
                //     //'container_class' => 'menu-class'
                //     //'fallback_cb' => ‘wp_page_menu’ 
                // ) ); 
        
                ?>

				<hr>
                <?php
                dynamic_sidebar('sidebar-1')
                ?>
				

			</div>
		</nav>
    </header>
        
    <div class="main-wrapper">
	    <header class="page-title theme-bg-light text-center gradient py-5">
			<h1 class="heading"><?php the_title()?></h1>
		</header>