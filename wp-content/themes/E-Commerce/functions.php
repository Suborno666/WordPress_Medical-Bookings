<?php


function e_commerce_theme_support(){
    
    // Add Title Tag
    add_theme_support('title-tag');

    // Add dynamic logo
    add_theme_support('custom-logo');

    // Add thumbnails for posts
    add_theme_support('post-thumbnails');
}

add_action('after_setup_theme','e_commerce_theme_support');

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

//*****************************************Register*****************************************
function e_commerce_user_create(){ 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
        $email = isset($_POST['email'])?$_POST['email']:'';
        $password = isset($_POST['password'])?$_POST['password']:'';
    
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


//*****************************************Login*****************************************
function e_commerce_user_login(){ 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $user_login     = esc_attr($_POST["email"]);
        $user_password  = esc_attr($_POST["password"]);
        
        
        $creds = array();
        $creds['user_login'] = $user_login;
        $creds['user_password'] = $user_password;
        $creds['remember'] = true;

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

//*****************************************Update*****************************************
function e_commerce_user_update(){
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $user_login     = esc_attr($_POST["email"]);
        $user_password  = esc_attr($_POST["password"]);

        $current_user_id = get_current_user_id();

        $creds = [
            'ID'=>$current_user_id,
            'user_login' => $user_login,
            'user_password' => $user_password,
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

 

//Adding Post Content of Fruit

// Our custom post type function
function e_commerce_create_posttype_fruit() {
    $supports = 
    [
        'title', // post title
        'editor', // post content
        'thumbnail', // post thumbnail
        'excerpt', // post excerpt
        'revisions'// post revision
    ];

    register_post_type( 'fruit',
        array(

            'labels' => [
                'name' => __( 'Fruits' ),
                'singular_name' => __( 'Fruit' ),
                'add_new' => _x('Add Fruit', 'add fruit'),
                'add_new_item' => __('Add New Fruits'),
                'new_item' => __('New Fruits'),
            
            ],
            'supports'=>$supports,
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'fruit'),
            'show_in_rest' => true,
  
        )
    );
}
// Hooking up our function to theme setup
add_action( 'init', 'e_commerce_create_posttype_fruit' );

// Our custom post type function
function e_commerce_create_posttype_vegetable() {
    $supports = 
    [
        'title', // post title
        'editor', // post content
        'thumbnail', // post thumbnail
        'excerpt', // post excerpt
        'revisions'// post revision
    ];

    register_post_type( 'vegetable',
        array(

            'labels' => [
                'name' => __( 'Vegetables' ),
                'singular_name' => __( 'Vegetable' ),
                'add_new' => _x('Add Vegetable', 'add vegetable'),
                'add_new_item' => __('Add New Vegetables'),
                'new_item' => __('New Vegetables'),
            
            ],
            'supports'=>$supports,
            'public' => true,
            'has_archive' => true,
            'rewrite' => ['slug' => 'vegetable'],
            'show_in_rest' => true,
  
        )
    );
}
// Hooking up our function to theme setup
add_action( 'init', 'e_commerce_create_posttype_vegetable' );

// Our custom post type function
function e_commerce_create_posttype_bread() {
    $supports = 
    [
        'title', // post title
        'editor', // post content
        'thumbnail', // post thumbnail
        'excerpt', // post excerpt
        'revisions'// post revision
    ];

    register_post_type( 'bread',
        array(

            'labels' => [
                'name' => __( 'Breads' ),
                'singular_name' => __( 'Bread' ),
                'add_new' => _x('Add Bread', 'add bread'),
                'add_new_item' => __('Add New Breads'),
                'new_item' => __('New Breads'),
            
            ],
            'supports'=>$supports,
            'public' => true,
            'has_archive' => true,
            'rewrite' => ['slug' => 'bread'],
            'show_in_rest' => true,
  
        )
    );
}
// Hooking up our function to theme setup
add_action( 'init', 'e_commerce_create_posttype_bread' );

// Our custom post type function
function e_commerce_create_posttype_meat() {
    $supports = 
    [
        'title', // post title
        'editor', // post content
        'thumbnail', // post thumbnail
        'excerpt', // post excerpt
        'revisions'// post revision
    ];

    register_post_type( 'meat',
        array(

            'labels' => [
                'name' => __( 'Meats' ),
                'singular_name' => __( 'Meat' ),
                'add_new' => _x('Add Meat', 'add meat'),
                'add_new_item' => __('Add New Meats'),
                'new_item' => __('New Meats'),
            
            ],
            'supports'=>$supports,
            'public' => true,
            'has_archive' => true,
            'rewrite' => ['slug' => 'meat'],
            'show_in_rest' => true,
  
        )
    );
}
// Hooking up our function to theme setup
add_action( 'init', 'e_commerce_create_posttype_meat' );

/**
* Register Metabox
*/
function prefix_add_meta_boxes(){
    $post_types = ['fruit','vegetable','bread','meat'];
	add_meta_box( 'unique_mb_id', __( 'Metabox Title','text-domain' ),'prefix_mb_callback', $post_types );
}
add_action('add_meta_boxes', 'prefix_add_meta_boxes' );
	
/**
* Meta field callback function
*/
function prefix_mb_callback($post_id){
    global $post; ?>
	<label for="mb_id"><?php echo esc_html('Price: ','text-domain'); ?></label>
	<input type="text" class="regular-text" value="<?php echo get_post_meta($post->ID,'unique_mb_id',true); ?>" name="unique_mb_id" id="mb_id">
<?php }


/**
* Save metabox data
*/
function prefix_save_meta_data( $post_id ){

    if ( isset( $_POST['unique_mb_id'] ) ) {       
      
        $meta_value = sanitize_text_field( $_POST['unique_mb_id'] );
        update_post_meta( $post_id, 'unique_mb_id', $meta_value );

    }
  }
  add_action( 'save_post', 'prefix_save_meta_data' );
?>