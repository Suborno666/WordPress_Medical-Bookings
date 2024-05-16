<?php 
get_header(); 
?>
<?php
$s=get_search_query();
print_r($s);
$args = array(
                's' =>$s,
                'post_type' => ['fruit','vegetable','bread','meat'],
            );
    // The Query
$the_query = new WP_Query( $args );
if ( $the_query->have_posts() ) {
        _e("<h2 style='font-weight:bold;color:#000'>Search Results for: ".get_query_var('s')."</h2>");
        while ( $the_query->have_posts() ) {
           $the_query->the_post();?>

           <h1 class="lead" style="margin-top: 204px;"><?php the_title();?></h1>
           <span>
               <img src="<?php the_post_thumbnail_url('thumbnail');?>">
           </span>
           <p><?php the_content();?></p>
           
           <?php
        }
    }else{
?>
        <h2 style='font-weight:bold;color:#000'>Nothing Found</h2>
        <div class="alert alert-info">
          <p>Sorry, but nothing matched your search criteria. Please try again with some different keywords.</p>
        </div>
<?php } ?>

<?php 
get_footer(); 
?>