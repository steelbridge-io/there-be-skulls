<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Your_Theme_Name
 * @since Your_Theme_Version
 */

get_header();
?>
	
	<div class="container mt-5">
		<div class="row">
			<div class="col-lg-8 col-md-10 mx-auto">
				<?php
				while ( have_posts() ) :
					the_post();
					?>
					<div class="post">
						<h1 class="post-title"><?php the_title(); ?></h1>
						<div class="post-content">
							<?php the_content(); ?>
						</div>
					</div>
				<?php
				endwhile; // End of the loop.
				?>
			</div>
		</div>
	</div>

<?php
get_footer();
?>