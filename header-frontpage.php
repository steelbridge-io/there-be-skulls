<?php
/**
 * WordPress Header for front-page.php
 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport"
        content="width=device-width, initial-scale=1.0">
  <title><?php wp_title('|', true, 'right'); ?></title>

  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php if (is_front_page()) : ?>
    <div class="overlay"></div>
<?php endif; ?>
<div class="site-wrapper">

<!-- Header -->
<header id="masthead" class="site-header"></header>
<div class="site-content">
<?php if ( !empty(get_theme_mod( 'skulls_carousel_item_1'))) { ?>
<div id="navbar-header" class="navbar-logo container-fluid no-padding-container navigation d-flex justify-content-between align-items-center
sticky-top">
    <div class="container-fluid no-padding-container header-carousel">
        <div id="carouselExampleIndicators"
             class="container carousel slide"
             data-bs-ride="carousel">
            <div class="carousel-inner" style="height: 100%;">
				<?php
				// Include file to define $carousel_items and $carousel_links
				include_once( get_template_directory() . '/customizer/carousel-items-links.php' );

				// Check if $carousel_items and $carousel_links are arrays
				if ( !empty( $carousel_items ) && is_array( $carousel_items ) && !empty( $carousel_links ) && is_array( $carousel_links ) ) {
					foreach ( $carousel_items as $key => $value ) {
						if ( ! empty( $value ) ) {
							// Add 'active' class to the first carousel item
							$active_class = ( $key === 0 ) ? ' active' : '';
							?>
                <div class="carousel-item<?php echo esc_attr( $active_class ); ?>" id="carousel_item_wrapper_<?php echo esc_attr($key + 1); ?>">
                    <a href="<?php echo esc_url( $carousel_links[ $key ] ); ?>" id="skulls_carousel_link_<?php echo esc_attr($key + 1); ?>">
                        <span class="header-carousel-text" id="skulls_carousel_item_<?php echo esc_attr($key + 1); ?>"><?php echo esc_html( $value ); ?></span>
                    </a>
                </div>
							<?php
						}
					}
				}
				?>
            </div>
        </div>
    </div>
    <?php } else { ?>
    <div id="navbar-header" class="navbar-logo container-fluid navigation d-flex justify-content-between
    align-items-center
    sticky-top no-theme-mod">
    <?php } ?>
    <div class="container d-flex justify-content-between align-items-center logo-animation">
      <?php
      $custom_logo_id = get_theme_mod('custom_logo');
      if ($custom_logo_id) {
        echo '<a href="/" title="Home"><img class="logo" src="' . esc_url($custom_logo_id) . '" alt="' . get_bloginfo('name') . '"></a>';
      } else {
        echo '<h1 class="nav-title trade-winds-regular text-align-center logo"><a href="/" title="Home">' . get_bloginfo('name') . '</a></h1>';
      }
      ?>
    <nav class="navbar navbar-expand-xl navbar-dark">
        <div class="container">
            <!--<a class="navbar-brand" href="#">Navbar</a> -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="main-menu">
                <button type="button" class="close-menu" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
				<?php
				wp_nav_menu(array(
					'theme_location' => 'main-menu',
					'container' => false,
					'menu_class' => '',
					'fallback_cb' => '__return_false',
					'items_wrap' => '<ul id="%1$s" class="navbar-nav me-auto mb-2 mb-md-0 %2$s">%3$s</ul>',
					'depth' => 3,
					'walker' => new bootstrap_5_wp_nav_menu_walker()
				));
				?>
            </div>
        </div>
    </nav>
  </div>
</div>
<div class="container-wrapper">

