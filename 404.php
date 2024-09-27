<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package WordPress
 * @subpackage Your_Theme_Name
 * @since Your_Theme_Version
 */

get_header();
?>

<div class="container mt-5 text-center">
	<div class="row">
		<div class="col-lg-8 col-md-10 mx-auto">
			<div class="error-404">
				<h1 class="display-1">404</h1>
				<h2 class="mb-4"><?php esc_html_e( 'Oops! That page can’t be found.', 'your-theme-name' ); ?></h2>
				<p class="lead mb-5">
					<?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'your-theme-name' ); ?>
				</p>
				<?php get_search_form(); ?>
				<a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary mt-4">
					<?php esc_html_e( 'Return to Home', 'your-theme-name' ); ?>
				</a>
			</div>
		</div>
	</div>
</div>

<?php get_footer();
?>
