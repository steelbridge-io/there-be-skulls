<?php
/**
 * Front Page Template.
 *
 * This is the template for the front page of the website. It includes
 * various sections such as the Hero Section, Featured Products, and
 * a Call to Action section.
 *
 * @package    ThereBeSkulls
 * @subpackage SkullsTheme
 * @since      1.0.0
 */

// Include the header template
get_header(); ?>


<!-- Hero Section -->
<section class="bg-secondary text-white py-20 position-relative">
	<div class="container text-center">
		<div class="position-relative">
			<h2 class="display-4 fw-bold mb-4 text-uppercase">Skulls for Everyone</h2>
			<p class="h5 mb-4">Where fun meets the dark side in style!</p>
			<a href="/shop" class="btn btn-danger btn-lg">Start Shopping</a>
		</div>
	</div>
	<!-- Floating Skull Icon -->
	<div class="position-absolute bottom-0 start-50 translate-middle-x">
		<img src="https://example.com/fun-skull.png" alt="Fun Skull" class="w-40 animate-bounce">
	</div>
</section>

<!-- Featured Products -->
<section class="py-5">
    <div class="container">
        <h3 class="display-5 fw-bold text-center mb-5 text-uppercase">Featured Skulls</h3>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
			<?php
			$term = get_term_by('slug', 'featured', 'product_cat');
			if ($term) {
				$category_id = $term->term_id;
			} else {
				echo '<p class="text-center">Featured category not found.</p>';
			}
			
			$args = array(
				'post_type' => 'product',
				'posts_per_page' => 12,
				'order' => 'DESC',
				'orderby' => 'date',
				'tax_query' => array(
					array(
						'taxonomy' => 'product_visibility',
						'field' => 'name',
						'terms' => 'featured',
						'operator' => 'IN'
					)
				),
			);
   
			$loop = new WP_Query($args);
			if ($loop->have_posts()) :
				while ($loop->have_posts()) :
					$loop->the_post();
					global $product; ?>
                    <div class="col">
                        <div class="card bg-dark text-light border-secondary h-100">
							<?php if (has_post_thumbnail()) : ?>
                                <img src="<?php echo get_the_post_thumbnail_url($loop->post->ID, 'large'); ?>" alt="<?php the_title(); ?>" class="card-img-top">
							<?php endif; ?>
                            <div class="card-body">
                                <h4 class="card-title text-danger"><?php the_title(); ?></h4>
                                <p class="card-text"><?php echo $product->get_price_html(); ?></p>
                                <a href="<?php the_permalink(); ?>" class="btn btn-danger w-100">View Product</a>
                            </div>
                        </div>
                    </div>
				<?php endwhile;
			else : ?>
                <p class="text-center">No featured products found.</p>
			<?php endif;
			wp_reset_postdata(); ?>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="bg-danger text-white py-5 text-center">
	<h4 class="display-6 fw-bold mb-3">Unleash Your Inner Skull</h4>
	<p class="lead mb-4">Get ready to embrace skull-inspired fashion, accessories, and decor!</p>
	<a href="/shop" class="btn btn-dark btn-lg">Shop the Collection</a>
</section>

<?php get_footer(); ?>

