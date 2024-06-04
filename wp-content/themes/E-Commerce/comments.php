<div class="tab-pane" id="nav-mission" role="tabpanel" aria-labelledby="nav-mission-tab">
    <?php
    function my_custom_comments_callback($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment; 
    ?>
    <div <?php comment_class('d-flex'); ?> id="comment-<?php comment_ID(); ?>">
        <img src="<?php echo get_avatar_url($comment, ['size' => 100]); ?>" class="img-fluid rounded-circle p-3" style="width: 100px; height: 100px;" alt="">
        <div class="">
            <p class="mb-2" style="font-size: 14px;"><?php echo get_comment_date(); ?></p>
            <div class="d-flex justify-content-between">
                <h5><?php comment_author(); ?></h5>

            </div>
            <p><?php comment_text(); ?></p>
            <div class="reply">
                <?php
                comment_reply_link(array_merge($args, [
                    'add_below' => 'comment',
                    'depth' => $depth,
                    'max_depth' => $args['max_depth'],
                    'reply_text' => 'Reply'
                ]));
                ?>
            </div>
        </div>
    </div>
    <?php
}

    

    if (!have_comments()) {
        ?>
        <div class="d-flex">
            <img src="img/avatar.jpg" class="img-fluid rounded-circle p-3" style="width: 100px; height: 100px;" alt="">
            <div class="">
                <p class="mb-2" style="font-size: 14px;">	
                    <?php echo date(get_option('date_format')); ?>
                </p>
                <div class="d-flex justify-content-between">
                    <h5>There are no Comments</h5>
                </div>
            </div>
        </div>
        <?php
    } else {
        wp_list_comments([
            'callback' => 'my_custom_comments_callback',
        ]);
    }
    ?>

    </div>
        <div class="tab-pane" id="nav-vision" role="tabpanel">
            <p class="text-dark">Tempor erat elitr rebum at clita. Diam dolor diam ipsum et tempor sit. Aliqu diam
                amet diam et eos labore. 3</p>
            <p class="mb-0">Diam dolor diam ipsum et tempor sit. Aliqu diam amet diam et eos labore.
                Clita erat ipsum et lorem et sit</p>
        </div>
    </div>
</div>

<div class="row g-4">
    <?php
        $commenter = wp_get_current_commenter();
        $req = get_option('require_name_email');
        $aria_req = ($req ? " aria-required='true'" : '');
        $fields =  [
            'author' => '<div class="col-lg-6"><div class="border-bottom rounded"><input id="author" name="author" type="text" class="form-control border-0 me-4" placeholder="Your Name *" value="' . esc_attr($commenter['comment_author']) . '" size="30"' . $aria_req . ' /></div></div>',
            'email' => '<div class="col-lg-6"><div class="border-bottom rounded"><input id="email" name="email" type="email" class="form-control border-0" placeholder="Your Email *" value="' . esc_attr($commenter['comment_author_email']) . '" size="30"' . $aria_req . ' /></div></div>',
        ];

        $comments_args = [
            'fields' => apply_filters('comment_form_default_fields', $fields),
            'comment_field' => '<div class="col-lg-12"><div class="border-bottom rounded my-4"><textarea id="comment" name="comment" class="form-control border-0" cols="30" rows="8" placeholder="Your Review *" spellcheck="false" aria-required="true"></textarea></div></div>',
            'logged_in_as' => '<p class="logged-in-as">' . sprintf(__('Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>'), admin_url('profile.php'), $user_identity, wp_logout_url(apply_filters('the_permalink', get_permalink()))) . '</p>',
            // ''=>,
            'title_reply' => '<h4 class="mb-5 fw-bold">Leave a Reply</h4>',
            'class_submit' => 'btn border border-secondary text-primary rounded-pill px-4 py-3',
            'label_submit' => __('Post Comment'),
            'submit_field' => '<div class="col-lg-12"><div class="d-flex justify-content-between py-3 mb-5">%1$s %2$s</div></div>',
        ];

        comment_form($comments_args);
    ?>
</div>


