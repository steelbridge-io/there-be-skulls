<?php
/**
 * The template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Your_Theme_Name
 * @since Your_Theme_Version
 */

get_header();
?>

  <div class="container single-container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <?php
        while ( have_posts() ) :
          the_post();
          ?>
          <div class="post">
            <h1 class="post-title"><?php the_title(); ?></h1>
            <div class="post-meta mb-3">
              <span class="post-date"><?php echo get_the_date(); ?></span>
              <span class="post-author"><?php echo get_the_author(); ?></span>
            </div>
            <div class="post-thumbnail mb-3">
              <?php
              if ( has_post_thumbnail() ) {
                the_post_thumbnail('large', ['class' => 'img-fluid']);
              }
              ?>
            </div>
            <div class="post-content">
              <?php the_content(); ?>
            </div>
            <div class="post-navigation mt-5">
              <div class="row">
                <div class="col-6">
                  <?php previous_post_link('%link', '<i class="bi bi-arrow-left"></i> Previous Post'); ?>
                </div>
                <div class="col-6 text-end">
                  <?php next_post_link('%link', 'Next Post <i class="bi bi-arrow-right"></i>'); ?>
                </div>
              </div>
            </div>
          </div>
          <?php
          // If comments are open or we have at least one comment, load up the comment template.
          if ( comments_open() || get_comments_number() ) :
            comments_template();
          endif;
        endwhile; // End of the loop.
        ?>
      </div>
    </div>
  </div>

<?php
get_footer();
?>