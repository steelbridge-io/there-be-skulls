<?php
/**
 * The template for displaying search results pages
 *
 * @package WordPress
 * @subpackage Your_Theme_Name
 * @since Your_Theme_Version
 */

get_header();
?>

  <div class="container search-wrapper">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <?php if ( have_posts() ) : ?>
          <header class="search-header mb-4">
            <h1 class="search-title">
              <?php printf( esc_html__( 'Search Results for: %s', 'your-theme-name' ), '<span>' . get_search_query() . '</span>' ); ?>
            </h1>
          </header>

          <?php while ( have_posts() ) : the_post(); ?>
            <div class="post-preview mb-4 row">
              <?php if ( has_post_thumbnail() ) : ?>
                <div class="search-result post-thumbnail col-sm-4">
                  <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail('medium'); ?>
                  </a>
                </div>
              <?php endif; ?>
              <div class="col-sm-8">
              <h2 class="post-title">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
              </h2>
              <div class="post-excerpt">
                <?php the_excerpt(); ?>
              </div>
              <a href="<?php the_permalink(); ?>" class="btn btn-primary">Read More</a>
            </div>
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
          <header class="search-header mb-4">
            <h1 class="search-title">
              <?php esc_html_e( 'Nothing Found', 'your-theme-name' ); ?>
            </h1>
          </header>
          <p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'your-theme-name'); ?></p>
          <?php get_search_form(); ?>
        <?php endif; ?>
      </div>
    </div>
  </div>

<?php get_footer(); ?>