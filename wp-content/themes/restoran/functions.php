<?php

function restoran_register_styles(){

    $version = wp_get_theme()->get('Version');
    wp_enqueue_style('css_template',get_template_directory_uri().'/assets/css/style.css',$version,'all');
    

}



?>