<?php
/*
Plugin Name: star-rating-comment
Plugin URI: https://www.wppagebuilders.com
Description: Custom Plugin for adding custom code
Version: 1.0.0
Author: WPPagebuilders
Author URI: https://www.wppagebuilders.com/
License: GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

// Enqueue the plugin's styles.
add_action('wp_enqueue_scripts', 'wpp_comment_rating_styles');
function wpp_comment_rating_styles()
{
    wp_register_style('wpp-comment-rating-styles', plugins_url('/', __FILE__) . 'assets/style.css');
    wp_enqueue_style('dashicons');
    wp_enqueue_style('wpp-comment-rating-styles');
}

// Create the rating interface.
add_action('comment_form_logged_in_after', 'wpp_comment_rating_rating_field');
add_action('comment_form_after_fields', 'wpp_comment_rating_rating_field');
function wpp_comment_rating_rating_field()
{
    $is_reply = isset($_GET['replytocom']) ? true : false;

    // Only display the rating field for top-level comments
    if (!$is_reply) {
        ?>
        <label for="rating">Rating<span class="required">*</span></label>
        <fieldset class="comments-rating">
            <span class="rating-container">
                <?php for ($i = 5; $i >= 1; $i--) : ?>
                    <input type="radio" id="rating-<?php echo esc_attr($i); ?>" name="rating" value="<?php echo esc_attr($i); ?>" /><label for="rating-<?php echo esc_attr($i); ?>"><?php echo esc_html($i); ?></label>
                <?php endfor; ?>
                <input type="radio" id="rating-0" class="star-cb-clear" name="rating" value="0" /><label for="rating-0">0</label>
            </span>
        </fieldset>
        <?php
    }
}

// Save the rating submitted by the user.
add_action('comment_post', 'wpp_comment_rating_save_comment_rating');
function wpp_comment_rating_save_comment_rating($comment_id)
{
    // Initialize the rating variable
    $rating = 0;

    if ((isset($_POST['rating'])) && ('' !== $_POST['rating'])) {
        $rating = intval($_POST['rating']);
    }
    
    add_comment_meta($comment_id, 'rating', $rating);
}

// Make the rating required.
add_filter('preprocess_comment', 'wpp_comment_rating_require_rating');
function wpp_comment_rating_require_rating($commentdata)
{
    // Check if this is a reply
    $is_reply = isset($_POST['comment_parent']) && $_POST['comment_parent'] != 0;

    // Only require the rating for top-level comments
    if (!$is_reply && !is_admin() && (!isset($_POST['rating']) || 0 === intval($_POST['rating']))) {
        wp_die(__('Error: You did not add a rating. Hit the Back button on your Web browser and resubmit your comment with a rating.'));
    }
    return $commentdata;
}

// Display the rating on a submitted comment.
add_filter('comment_text', 'wpp_comment_rating_display_rating');
function wpp_comment_rating_display_rating($comment_text)
{
    if ($rating = get_comment_meta(get_comment_ID(), 'rating', true)) {
        $stars = '<p class="stars">';
        for ($i = 1; $i <= $rating; $i++) {
            $stars .= '<span class="dashicons dashicons-star-filled"></span>';
        }
        $stars .= '</p>';
        $comment_text = $comment_text . $stars;
        return $comment_text;
    } else {
        return $comment_text;
    }
}
