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

include get_template_directory() . '/customizer/category-slugs.php';
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

<section class="py-5">
  <div class="container category-container">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-6 row-cols-lg-6 g-4 justify-content-center">
      <!-- Category Sections -->
      <?php foreach ($category_slugs as $category_slug) : ?>
        <?php
        $category = get_term_by('slug', $category_slug, 'product_cat');
        if ($category) :
          $category_id = $category->term_id;
          $thumbnail_id = get_term_meta($category_id, 'thumbnail_id', true);
          $image_url = wp_get_attachment_url($thumbnail_id);
          $category_link = get_term_link($category_id, 'product_cat');
          ?>
          <div class="col">
            <div class="card bg-dark text-light border-secondary h-100">
              <?php if ($image_url): ?>
                <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($category->name); ?>">
              <?php endif; ?>
              <div class="card-body">
                <h4 class="card-title text-danger"><?php echo esc_html($category->name); ?></h4>
                <p class="card-text"><?php echo esc_html($category->description); ?></p>
                <a href="<?php echo esc_url($category_link); ?>" class="btn btn-danger w-100">
                  View All Items in <?php echo esc_html($category->name); ?>
                </a>
              </div>
            </div>
          </div>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php get_footer(); ?>
