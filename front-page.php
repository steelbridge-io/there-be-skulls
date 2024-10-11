<?php
/**
 * Front Page.
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
get_header('frontpage');

// Ensure WordPress and WooCommerce are available
if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly
}

include get_template_directory() . '/customizer/category-slugs.php';

?>
  <section class="py-5">
    <div class="container category-container">
      <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-2 g-4 justify-content-center">
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

  <!-- Featured Products -->
  <section class="py-5">
    <div class="container">
      <h3 class="display-5 fw-bold text-center mb-5 text-uppercase">Featured</h3>
      <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-4 g-4 justify-content-center">
        <?php
        $args = array(
          'post_type' => 'product',
          'posts_per_page' => 24,
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

  <!-- Featured Category -->
  <section class="py-5">
    <div class="container">
      <?php
      // Fetch the term object by its slug
      $term = get_term_by('slug', 'accessories', 'product_cat');

      // Check if the term is valid and exists
      $category_name = $term ? $term->name : 'Featured Skulls';
      ?>
      <h3 class="display-5 fw-bold text-center mb-5 text-uppercase"><?php echo htmlspecialchars($category_name, ENT_QUOTES, 'UTF-8'); ?></h3>
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 justify-content-center">
        <!--<h3 class="display-5 fw-bold text-center mb-5 text-uppercase">Featured Skulls</h3>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 justify-content-center">-->
        <?php

        $args = array(
          'post_type' => 'product',
          'posts_per_page' => 4,
          'order' => 'DESC',
          'orderby' => 'date',
          'tax_query' => array(
            array(
              'taxonomy' => 'product_cat',  // Change this to 'product_cat' for product categories
              'field' => 'slug',            // Use 'slug' to specify category by its slug
              'terms' => 'accessories', // Provide the slug of the desired category
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