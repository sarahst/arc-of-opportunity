<?php
/**
 * Single post template: no sidebar, content centered at max-width 8xl.
 *
 * @package Arc of Opportunity
 */

get_header();
?>
<div class="peacefulthemes-contain-area">
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<div class="container acr-single-post">
				<?php
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/post/content', get_post_format() );
				endwhile;
				?>
			</div>
		</main>
	</div>
</div>
<?php
get_footer();
