<?php
get_header();
?>

	<article class="content px-3 py-5 p-md-5">
	<img src="<?php the_post_thumbnail_url('thumbnail')?>" alt="image">
	<?php
	if(have_posts()){
		while( have_posts()){
			the_title();
			the_post();
			get_template_part('template-parts/content','archive');

		}
	}
	?>

	</article>
    
<?php
get_footer();
?>	

