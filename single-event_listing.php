<?php
/**
 * Single event listing template.
 *
 * Uses WP Event Manager content without blog post chrome
 * (post meta, prev/next navigation, and author box).
 *
 * @package Arc of Opportunity
 */

get_header();
?>
<div class="peacefulthemes-contain-area">
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<div class="container acr-single-event">
				<?php
				while ( have_posts() ) :
					the_post();
					the_content();
				endwhile;
				?>
			</div>
		</main>
	</div>
</div>
<?php
get_footer();
