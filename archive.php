<?php
/**
 * The template for displaying archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
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
			<header class="archive-header mb-4">
				<?php
				the_archive_title('<h1 class="archive-title">', '</h1>');
				the_archive_description('<div class="archive-description">', '</div>');
				?>
			</header>
			
			<?php if (have_posts()) : ?>
				<?php while (have_posts()) : the_post(); ?>
					<div class="post-preview mb-4">
						<h2 class="post-title">
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</h2>
						<p class="post-meta text-muted">
							Posted on <?php echo get_the_date(); ?> by <?php the_author(); ?>
						</p>
						<div class="post-excerpt">
							<?php the_excerpt(); ?>
						</div>
						<a href="<?php the_permalink(); ?>" class="btn btn-primary">Read More</a>
					</div>
					<hr>
				<?php endwhile; ?>
				
				<!-- Pagination -->
				<div class="pagination">
					<?php
					the_posts_pagination(array(
						'mid_size' => 2,
						'prev_text' => '<i class="bi bi-arrow-left"></i> Previous',
						'next_text' => 'Next <i class="bi bi-arrow-right"></i>',
					));
					?>
				</div>
			<?php else : ?>
				<p><?php esc_html_e('No posts found.', 'your-theme-name'); ?></p>
			<?php endif; ?>
		</div>
	</div>
</div>

<?php get_footer(); ?>
