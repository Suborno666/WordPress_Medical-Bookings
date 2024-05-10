<?php


function e_commerce_theme_support(){
    add_theme_support('title-tag');
}

add_action('after-setup-theme','e_commerce_theme_support');

function e_commerce_enqueue_links(){

    // **********************Header*********************

    //Jquery
    wp_enqueue_script('js-google-jquery',"https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js",[],'3.6.4',false);
    //Google Web Fonts
    wp_enqueue_style('google-apis',"https://fonts.googleapis.com",[],'',false);
    wp_enqueue_style('google-gstatic',"https://fonts.gstatic.com",[],'',false);
    wp_enqueue_style('google-fonts',"https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap",[],'',false);

    //Icon Font Stylesheet
    wp_enqueue_style('icon-fontawesome',"https://use.fontawesome.com/releases/v5.15.4/css/all.css",[],'5.15.4','',false);
    wp_enqueue_style('css-bootstrap-web',"https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css",[],'1.4.1','',false);

    //Libaries Stylesheet
    wp_enqueue_style('css-lightbox',get_template_directory_uri().'/assets/lib/lightbox/css/lightbox.min.css',[],'',false);
    wp_enqueue_style('css-owlcarousel',get_template_directory_uri().'/assets/lib/owlcarousel/assets/owl.carousel.min.css',[],'',false);

    //Bootstrap Stylesheet
    wp_enqueue_style('css-bootstrap',get_template_directory_uri().'/assets/css/bootstrap.min.css',[],'',false);
    wp_enqueue_style('css-stylesheet',get_template_directory_uri().'/assets/css/style.css',[],'',false);


    // **********************Footer*********************
    // JS Libraries
    wp_enqueue_script('js-jsdelivr-bootstrap',"https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js",[],'5.0.0',true);
    wp_enqueue_script('js-easing',get_template_directory_uri().'/assets/lib/easing/easing.min.js',[],'1.0',true);
    wp_enqueue_script('js-waypoint',get_template_directory_uri().'/assets/lib/waypoints/waypoints.min.js',[],'1.0',true);
    wp_enqueue_script('js-lightbox',get_template_directory_uri().'/assets/lib/lightbox/js/lightbox.min.js',[],'1.0',true);
    wp_enqueue_script('js-owlcarousel',get_template_directory_uri().'/assets/lib/owlcarousel/owl.carousel.min.js',[],'1.0',true);
    // JS Template
    wp_enqueue_script('js-template',get_template_directory_uri().'/assets/js/main.js',[],'1.0',true);

}

add_action('wp_enqueue_scripts','e_commerce_enqueue_links');


function e_commerce_user_create(){ 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
        $email = isset($_POST['email'])?$_POST['email']:'';
        $password = isset($_POST['password'])?$_POST['password']:'';

        $first_name     = esc_attr($_POST["first_name"]);
        $last_name   = esc_attr($_POST["last_name"]);
    
        $user = wp_create_user($email,$password);
        if($user){
            echo json_encode(['data'=>'User created successfully']);
        }else{
            echo json_encode(['data'=>'Error in field']);
        }
    }
    die();
}
add_action( 'wp_ajax_nopriv_register_user', 'e_commerce_user_create' );
add_action( 'wp_ajax_register_user', 'e_commerce_user_create' );

function e_commerce_user_login(){ 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $user_login     = esc_attr($_POST["email"]);
        $user_password  = esc_attr($_POST["password"]);  
        
        $creds = 
        [
            'user_login' => $user_login,
            'user_password' => $user_password,
            'remember' => true
        ];
        
        $meta_data = [
            'first_name' => $first_name,
            'last_name' => $last_name
        ];

        $current_user_id = get_current_user_id();
        foreach ($meta_data as $key=>$value)
        {
            add_user_meta($current_user_id,$key,$value);
        }
        $user = wp_signon( $creds, false );

        do_action( 'wp_login', $user_login );

        $user_signon = wp_signon( $creds, false );
        if ( is_wp_error($user_signon) ){
            echo json_encode(array('loggedin'=>false, 'redirect'=>'', 'message'=>__('Wrong username or password.')));
        } else{
            echo json_encode(array('loggedin'=>true,'message'=>__('SUCCESS.')));
        }
    }
    die();
}
add_action( 'wp_ajax_nopriv_custom_login', 'e_commerce_user_login' );
add_action( 'wp_ajax_custom_login', 'e_commerce_user_login' );

function e_commerce_user_update(){
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $user_login     = esc_attr($_POST["email"]);
        $user_password  = esc_attr($_POST["password"]);

        $current_user_id = get_current_user_id();

        $creds = [
            'ID'=>$current_user_id,
            'user_login' => $user_login,
            'user_pass' => $user_password,
        ];
        if(wp_update_user($creds)){
            echo json_encode(['data'=>'Updated','update'=>true]);
        }else{
            echo json_encode(['data'=>'Error in input stream.','update'=>false]);
        }
        
    }
    die();
}
add_action('wp_ajax_nopriv_update_user','e_commerce_user_update');
add_action('wp_ajax_update_user','e_commerce_user_update');
?>