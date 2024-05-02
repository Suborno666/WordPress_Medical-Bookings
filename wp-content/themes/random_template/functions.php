<?php

function random_template_theme_support(){
    
    // Add dynamic title tags
    add_theme_support('title-tag');

    // Add dynamic logo
    add_theme_support('custom-logo');

    // Add thumbnails for posts
    add_theme_support('post-thumbnails');

}

// register_nav_menus(
//     array(
//         'footer_our_services' => esc_html__( 'Footer our services', 'medical_support' ),
//         'footer_useful_link' => esc_html__( 'Footer useful link menu', 'medical_support' ),
//         'header_menu' => esc_html__( 'Header menu', 'medical_support' ),
//     )
// );

add_action('after_setup_theme','random_template_theme_support');

function random_template_menus(){
    $location = [
        'primary'=>'Desktop Primary Left Sidebar',
        'footer'=>'Footer Menu Items'
    ];

    register_nav_menus($location);

}
add_action('init','random_template_menus');


function random_template_register_styles(){

    $version = wp_get_theme()->get('Version');
    wp_enqueue_style('css-template',get_template_directory_uri().'/assets/css/style.css',array('css-bootstrap'),$version,'all');
    wp_enqueue_style('css-bootstrap',"https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css",array(),'4.4.1','all');
    wp_enqueue_style('css-fontawesome',"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css",array(),'5.13.0','all');

}

add_action('wp_enqueue_scripts','random_template_register_styles');


function random_template_register_scripts(){

    wp_enqueue_script('css-bootstrap',"https://code.jquery.com/jquery-3.4.1.slim.min.js",array(),'3.4.1',true);
    wp_enqueue_script('css-popper',"https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js",array(),'1.16.0',true);
    wp_enqueue_script('css-stackpath-bootstrap',"https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js",array(),'3.4.1',true);
    wp_enqueue_script('css-jquery',get_template_directory_uri().'/assets/js/main.js',array(),'1.0',true);

}

add_action('wp_enqueue_scripts','random_template_register_scripts');


function random_template_widget_areas(){

    register_sidebar(
        [
            'before_title'=>'',
            'after_title'=>'',
            'before_widget'=>'',
            'after_widget'=>'',
            'name'=>'Sidebar Area',
            'id'=>'sidebar-1',
            'description'=>'Sidebar Widget Area'
        ]
    );

    register_sidebar(
        [
            'before_title'=>'',
            'after_title'=>'',
            'before_widget'=>'',
            'after_widget'=>'',
            'name'=>'footer Area',
            'id'=>'footer-1',
            'description'=>'Footer Widget Area'
        ]
    );
    
}
add_action('widgets_init','random_template_widget_areas');
?>