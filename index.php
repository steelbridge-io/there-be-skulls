<?php get_header(); ?>
<div class="container mt-5">
	<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : the_post(); ?>
            <h2><?php the_title(); ?></h2>
			<?php the_content(); ?>
		<?php endwhile; ?>
	<?php else : ?>
        <p><?php esc_html_e('No posts found.', 'your-theme-name'); ?></p>
	<?php endif; ?>
</div>
<?php get_footer(); ?>