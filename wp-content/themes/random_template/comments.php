<div class="comments-wrapper">


<div class="comments" id="comments">


    <div class="comments-header">

        <h2 class="comment-reply-title">
            <?php
            if(have_comments()){
                get_comments_number()." comments";
            }else{
                echo "";
            }
            ?>
        </h2><!-- .comments-title -->

    </div><!-- .comments-header -->

    <div class="comments-inner">

    <?php
    wp_list_comments(
        [
            'avatar_size'=>120,
            'style'=>'div'
        ]
    );
    ?>

    </div><!-- .comments-inner -->

</div><!-- comments -->

<hr class="" aria-hidden="true">
<?php
if(comments_open()){
    comment_form(
        [
            'class_form'=>'',
            'title_reply_before'=>'<h2 id="reply-title" class="comment-reply-title">',
            'title_reply_after'=>'</h2>'
        ]
    );
}else{

}
?>

</div>