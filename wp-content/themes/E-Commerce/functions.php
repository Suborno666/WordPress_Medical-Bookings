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

//***************************************** Register User *****************************************
function e_commerce_user_create(){ 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        $occupation = isset($_POST['Occupation']) ? $_POST['Occupation'] : '';

        $user_id = wp_create_user($email, $password);
        if (is_wp_error($user_id)) {
            echo json_encode(['data' => 'Error in field']);
        } else {
            // Save occupation as user meta
            update_user_meta($user_id, 'occupation', $occupation);
            echo json_encode(['data' => 'User created successfully']);
        }
    }
    die();
}
add_action('wp_ajax_nopriv_register_user', 'e_commerce_user_create');
add_action('wp_ajax_register_user', 'e_commerce_user_create');

//***************************************** Register User's Comments *****************************************
// function e_commerce_user_comment() {
//     if ($_SERVER["REQUEST_METHOD"] == "POST" && is_user_logged_in()) {
//         $comment_content = isset($_POST['textarea']) ? sanitize_text_field($_POST['textarea']) : '';
//         $rating = isset($_POST['rating']) ? floatval($_POST['rating']) : 0;
        
//         $user_id = get_current_user_id();

//         if (empty($comment_content) || empty($rating)) {
//             echo json_encode(['data' => 'Please provide both comment and rating.', 'success' => false]);
//             die();
//         }

//         // Create the comment
//         $commentdata = array(
//             'comment_post_ID' => get_the_ID(),
//             'comment_author' => wp_get_current_user()->display_name,
//             'comment_author_email' => wp_get_current_user()->user_email,
//             'comment_content' => $comment_content,
//             'user_id' => $user_id,
//             'comment_approved' => 1,
//         );

//         $comment_id = wp_new_comment($commentdata);

//         if ($comment_id) {
//             // Save rating as comment meta
//             add_comment_meta($comment_id, 'rating', $rating, true);
//             echo json_encode(['data' => 'Comment and rating submitted successfully.', 'success' => true]);
//         } else {
//             echo json_encode(['data' => 'Error submitting comment.', 'success' => false]);
//         }
//     } else {
//         echo json_encode(['data' => 'You must be logged in to submit a comment.', 'success' => false]);
//     }
//     die();
// }

// add_action('wp_ajax_nopriv_user_comments', 'e_commerce_user_comment');
// add_action('wp_ajax_user_comments', 'e_commerce_user_comment');



//***************************************** Login *****************************************
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

//***************************************** Update *****************************************
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

/**
* Register Metabox
*/
function prefix_add_meta_box(){
    $post_types = ['product'];
	add_meta_box( 'unique_mb_id', __( 'Metabox Title','text-domain' ),'prefix_mb_callback', $post_types );
}
add_action('add_meta_boxes', 'prefix_add_meta_box' );
	
/**
* Meta field callback function
*/
function prefix_mb_callback($post_id){
    global $post; ?>

	<label for="mb_id"><?php echo esc_html('Price: ','text-domain'); ?></label>
	<input type="text" class="regular-text" value="<?php echo get_post_meta($post->ID,'unique_mb_id',true); ?>" name="unique_mb_id" id="mb_id"><br><br>

    <label for="mb_id"><?php echo esc_html('Weight: ','text-domain'); ?></label>
	<input type="text" class="regular-text" value="<?php echo get_post_meta($post->ID,'unique_mb_id',true); ?>" name="unique_mb_id" id="mb_id"><br><br>

    <label for="mb_id"><?php echo esc_html('Country of Origin: ','text-domain'); ?></label>
	<input type="text" class="regular-text" value="<?php echo get_post_meta($post->ID,'unique_mb_id',true); ?>" name="unique_mb_id" id="mb_id"><br><br>

    <label for="mb_id"><?php echo esc_html('Quality: ','text-domain'); ?></label>
	<input type="text" class="regular-text" value="<?php echo get_post_meta($post->ID,'unique_mb_id',true); ?>" name="unique_mb_id" id="mb_id"><br><br>

    <label for="mb_id"><?php echo esc_html('Check: ','text-domain'); ?></label>
	<input type="text" class="regular-text" value="<?php echo get_post_meta($post->ID,'unique_mb_id',true); ?>" name="unique_mb_id" id="mb_id"><br><br>

    <label for="mb_id"><?php echo esc_html('Min Weight: ','text-domain'); ?></label>
	<input type="text" class="regular-text" value="<?php echo get_post_meta($post->ID,'unique_mb_id',true); ?>" name="unique_mb_id" id="mb_id"><br><br>
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

// In your theme's functions.php or any other theme file

// Define the custom action hook
function my_custom_action_hook() {
    do_action('my_custom_action');
}

// In your theme's functions.php

// Function to be executed when the custom action is triggered
function my_custom_action_function() {
    echo "My custom action has been triggered!";
}

// Hook the custom function to the custom action
add_action('my_custom_action', 'my_custom_action_function');

/**
 * Add Image Meta field
 */
function create_custom_meta_box() {
    add_meta_box(
        'custom_image_field', // Unique ID
        'Custom Page Image', // Title displayed
        'display_custom_image_box', // Callback function to display field
        'page', // Post type where the field will show (adjust for other types)
        'normal', // Context where the field appears ('normal', 'advanced', or 'side')
        'high' // Priority within the context ('high', 'default', 'low')
    );
}
add_action('add_meta_boxes', 'create_custom_meta_box');

/**
 * Display Image Meta field
 */
function display_custom_image_box($post) {
    $custom_image_id = get_post_meta($post->ID, 'custom_image_id', true); // Get existing image ID
    $custom_image_url = wp_get_attachment_image_url($custom_image_id, 'thumbnail'); // Get image URL

    ?>
    <p>
        <label for="custom_image_id">Upload Custom Image:</label><br>
        <input type="hidden" name="custom_image_id" id="custom_image_id" value="<?php echo esc_attr($custom_image_id); ?>">
        <button type="button" class="upload_image_button">Select Image</button><br>
        <img id="custom_image_preview" src="<?php echo esc_url($custom_image_url); ?>" style="max-width: 300px;">
    </p>
    <script>
        jQuery(document).ready(function($) {
            $('.upload_image_button').click(function() {
                var custom_uploader = wp.media({
                    title: 'Select Custom Image',
                    button: {
                        text: 'Select'
                    },
                    multiple: false
                });

                custom_uploader.on('select', function() {
                    var attachment = custom_uploader.state().get('selection').first().toJSON();
                    $('#custom_image_id').val(attachment.id);
                    $('#custom_image_preview').attr('src', attachment.url);
                });

                custom_uploader.open();
            });
        });
    </script>
    <?php
}

/**
 * Save Image Meta field
 */
function save_custom_image_meta($post_id) {
    if (isset($_POST['custom_image_id'])) {
        // Sanitize image ID
        $custom_image_id = sanitize_text_field($_POST['custom_image_id']);

        // Update meta data
        update_post_meta($post_id, 'custom_image_id', $custom_image_id);
    }
}
add_action('save_post', 'save_custom_image_meta');

// function e_commerce_user_testimonials(){
//     $supports = [
//         'title',
//         'thumbnail',
//         'editor',
//         'revisions'
//     ];
//     register_post_type('testimonials',[
//             'labels'=>[
//                 'name'=>__('Testimonials'),
//                 'singular_name'=>__('Testimonial'),
//                 'add_new'=>_x('Add Testimonials','add Testimonial'),
//                 'add_new_item'=>__('Add New Testimonials'),
//                 'new_item'=>__('New Testimonials')
//             ],
//             'supports'=>$supports,
//             'public'=>true,
//             'has_archive'=>true,
//             'rewrite'=>['slug'=>'testimonial'],
//             'show_in_rest'=>true
//         ]
//     );
// }

// add_action('init','e_commerce_user_testimonials');


/**
 * Register Testimonials Metabox
 */
function e_commerce_create_testimonials_meta_box(){
    $post_type = 'testimonials';
    add_meta_box('unique_tm_id',__('Metabox Title','text-domain'),'tm_callback',$post_type);
}
add_action('add_meta_boxes','e_commerce_create_testimonials_meta_box');

/**
 * Testimonials Callback Function
 */
function tm_callback($post_id){
    global $post;
    ?>
    <h1><?php print_r($_POST); ?></h1>
    <label for="tm_email_id"><?php echo esc_html('Email:','text-domain');?></label>
    <input type="text" class="regular-text" value="<?php echo wp_get_current_user()->user_email?>" name="unique_tm_email" id="tm_email_id"><br><br>
    
    <label for="tm_ratings"><?php echo esc_html('Ratings (Out of 5):','text-domain');?></label>
    <input type="text" class="regular-text" value="<?php echo get_post_meta($post->ID,'unique_tm_ratings',true); ?>" name="unique_tm_ratings" id="tm_ratings"><br><br>

    <label for="tm_profession"><?php echo esc_html('Profession:','text-domain');?></label>
    <input type="text" class="regular-text" value="<?php echo get_post_meta($post->ID,'unique_tm_profession',true); ?>" name="unique_tm_profession" id="tm_profession">

<?php }

/**
 * Save Testimonials Metabox
 */
function tm_save_meta_data($post_id){
    if(isset($_POST['unique_tm_email'])){
        $meta_value = sanitize_email($_POST['unique_tm_email']);
        update_post_meta($post_id,'unique_tm_email',$meta_value);
    }
    if(isset($_POST['unique_tm_ratings'])){
        $meta_value = $_POST['unique_tm_ratings'];
        update_post_meta($post_id,'unique_tm_ratings',$meta_value);
    }
    if(isset($_POST['unique_tm_profession'])){
        $meta_value = $_POST['unique_tm_profession'];
        update_post_meta($post_id,'unique_tm_profession',$meta_value);
    }
}
add_action('save_post','tm_save_meta_data');

/*****************************Add Custom Taxonomy***************************************/
function add_custom_taxonomies() {
    // Add new "Locations" taxonomy to Products
    register_taxonomy('product category', 'product', array(
        // Hierarchical taxonomy (like categories)
        'hierarchical' => true,
        // This array of options controls the labels displayed in the WordPress Admin UI
        'labels' => [
            'name' => _x('Product Categories', 'taxonomy general name'),
            'singular_name' => _x('Product Category', 'taxonomy singular name'),
            'search_items' => __('Search Product Categories'),
            'all_items' => __('All Product Categories'),
            'parent_item' => __('Parent Product Category'),
            'parent_item_colon' => __('Parent Product Category:'),
            'edit_item' => __('Edit Product Category'),
            'update_item' => __('Update Product Category'),
            'add_new_item' => __('Add New Product Category'),
            'new_item_name' => __('New Product Category Name'),
            'menu_name' => __('Product Category'),
        ],
        // Control the slugs used for this taxonomy
        'rewrite' => [
            'slug' => 'locations', // This controls the base slug that will display before each term
            'with_front' => false, // Don't display the category base before "/locations/"
            'hierarchical' => true // This will allow URLs like "/locations/boston/cambridge/"
        ],
    ));
}
add_action('init', 'add_custom_taxonomies', 0);

   
// Our custom post type function
function e_commerce_create_posttype_product() {
    $supports = 
    [
        'title', 
        'editor',
        'thumbnail', 
        'excerpt', 
        'revisions'
    ];

    register_post_type( 'product',
        [

            'labels' => [
                'name' => __( 'Products' ),
                'singular_name' => __( 'Product' ),
                'add_new' => _x('Add Product', 'add product'),
                'add_new_item' => __('Add New Products'),
                'new_item' => __('New Products'),
            
            ],
            'supports'=>$supports,
            'public' => true,
            'has_archive' => true,
            'rewrite' => 
            [
                'slug' => 'products', 
                'with_front' => false, 
                'hierarchical' => false
            ],
            'show_in_rest' => true,
  
        ]
    );
}
// Hooking up our function to theme setup
add_action( 'init', 'e_commerce_create_posttype_product' );
?>