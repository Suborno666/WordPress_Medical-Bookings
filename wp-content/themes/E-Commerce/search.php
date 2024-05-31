<?php 
get_header(); 
?>
<?php
$s = get_search_query();
$args = array(
    's' => $s,
    'post_type' => 'product', // Ensure post_type is correctly set to 'product'
);

// The Query
$the_query = new WP_Query( $args );
if ( $the_query->have_posts() ) {
    echo "<h2 style='font-weight:bold;color:#000'>Search Results for: ".esc_html($s)."</h2>";
    while ( $the_query->have_posts() ) {
        $the_query->the_post();
        ?>
        <h1 class="lead" style="margin-top: 20px;"><?php the_title(); ?></h1>
        <span>
            <img src="<?php the_post_thumbnail_url('thumbnail'); ?>">
        </span>
        <p>
            <?php the_excerpt(); ?>
        </p>
        <a href="<?php the_permalink(); ?>">more >></a>
        <?php
    }
} else {
    ?>
    <h2 style='font-weight:bold;color:#000'>Nothing Found</h2>
    <div class="alert alert-info">
        <p>Sorry, but nothing matched your search criteria. Please try again with some different keywords.</p>
    </div>
    <?php 
}
wp_reset_postdata();
get_footer(); 
?>
