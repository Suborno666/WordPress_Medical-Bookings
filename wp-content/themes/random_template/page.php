<?php
get_header();
?>

	<article class="content px-3 py-5 p-md-5">
	<?php
	if(have_posts()){
		while( have_posts()){
			$id = get_the_ID();
			the_post();
			get_template_part('template-parts/content','page');

		}
	}
	?>

	</article>
    
<?php
get_footer();
?>	

