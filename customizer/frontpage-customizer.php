<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

function skulls_customize_register( $wp_customize ) {
	// Add Section for Front Page Categories
	$wp_customize->add_section( 'skulls_category_section', array(
		'title'       => __( 'Front Page Categories', 'skullstheme' ),
		'description' => __( 'Select categories to display on the front page', 'skullstheme' ),
		'priority'    => 120,
	) );
	
	// Add settings and controls for each category
	for ( $i = 1; $i <= 12; $i++ ) {
		$wp_customize->add_setting( "skulls_category_$i", array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				"skulls_category_$i",
				array(
					'label'    => __( "Category $i", 'skullstheme' ),
					'section'  => 'skulls_category_section',
					'settings' => "skulls_category_$i",
					'type'     => 'text',
				)
			)
		);
	}
	
	/**
	 * Carousel Section
	 * The carousel renders at the top of the header. A rotation CTA.
	 */
  function sanitize_text_length($input) {
    if (strlen($input) > 40) {
      $input = substr($input, 0, 40);
    }
    return sanitize_text_field($input);
  }

  if (class_exists('WP_Customize_Control')) {
    class Skulls_Custom_Title_Link_Control extends WP_Customize_Control {
      public $type = 'custom_title';  // Control type

      public function render_content() {
        if (!empty($this->label)) {
          echo '<div class="skulls-custom-title-control">';
          echo '<h2>' . esc_html($this->label) . '</h2>';
          echo '<p>' . esc_html($this->description) . '</p>';
          echo '</div>';
        }
      }
    }

    class Skulls_Custom_Item_Title_Control extends WP_Customize_Control {
      public $type = 'custom_title';  // Control type

      public function render_content() {
        if (!empty($this->label)) {
          echo '<div class="skulls-custom-title-control">';
          echo '<h2>' . esc_html($this->label) . '</h2>';
          echo '<p>' . esc_html($this->description) . '</p>';
          echo '</div>';
        }
      }
    }
  }

  $wp_customize->add_section('skulls_carousel_section', array(
    'title'       => __('Header Carousel', 'skullstheme'),
    'description' => __('This section allows you to add items and links to the header rotating carousel. The column below is split between item names and links. In the Carousel Item Name add the product name and/or short call to action. In the Carousel Item Link column that follows, add the associated link or URL.', 'skullstheme'),
    'priority'    => 120,
  ));

  $wp_customize->add_setting('skulls_carousel_item_title', array(
    'sanitize_callback' => 'sanitize_text_field',
    'transport'         => 'postMessage',
  ));

  $wp_customize->add_control(new Skulls_Custom_Item_Title_Control(
    $wp_customize,
    'skulls_carousel_item_title',
    array(
      'label'       => __('Carousel Items', 'skullstheme'),
      'description' => __('Add the item name or call to action below.', 'skullstheme'),
      'section'     => 'skulls_carousel_section',
      'settings'    => 'skulls_carousel_item_title',
    )
  ));

  for ($i = 1; $i <= 4; $i++) {
    $wp_customize->add_setting("skulls_carousel_item_$i", array(
      'default'           => '',
      'sanitize_callback' => 'sanitize_text_length',
      'transport'         => 'postMessage',
    ));

    $wp_customize->add_control(new WP_Customize_Control(
      $wp_customize,
      "skulls_carousel_item_$i",
      array(
        'label'    => __("Carousel Item $i Name", 'skullstheme'),
        'section'  => 'skulls_carousel_section',
        'settings' => "skulls_carousel_item_$i",
        'type'     => 'text',
      )
    ));

    $wp_customize->selective_refresh->add_partial("skulls_carousel_item_$i", array(
      'selector'        => "#skulls_carousel_item_$i", // Update with your actual selector
      'render_callback' => function() use ($i) {
        return get_theme_mod("skulls_carousel_item_$i");
      }
    ));
  }

  $wp_customize->add_setting('skulls_carousel_link', array(
    'sanitize_callback' => 'sanitize_text_field',
    'transport'         => 'postMessage',
  ));

  $wp_customize->add_control(new Skulls_Custom_Title_Link_Control(
    $wp_customize,
    'skulls_carousel_link',
    array(
      'label'       => __('Carousel Links', 'skullstheme'),
      'description' => __('Add links or URLs associated with the items previously listed. Make sure the Item link/URL matches the associated item name by number. Ex: Carousel Item 1 Link will be associated with Carousel Item 1 Name.', 'skullstheme'),
      'section'     => 'skulls_carousel_section',
      'settings'    => 'skulls_carousel_link',
    )
  ));

  for ($i = 1; $i <= 4; $i++) {
    $wp_customize->add_setting("skulls_carousel_link_$i", array(
      'default'           => '',
      'sanitize_callback' => 'esc_url_raw',
      'transport'         => 'postMessage',
    ));

    $wp_customize->add_control(new WP_Customize_Control(
      $wp_customize,
      "skulls_carousel_link_$i",
      array(
        'label'    => __("Carousel Item $i Link ", 'skullstheme'),
        'section'  => 'skulls_carousel_section',
        'settings' => "skulls_carousel_link_$i",
        'type'     => 'url',
      )
    ));

    $wp_customize->selective_refresh->add_partial("skulls_carousel_link_$i", array(
      'selector'        => "#skulls_carousel_link_$i", // Update with your actual selector
      'render_callback' => function() use ($i) {
        return get_theme_mod("skulls_carousel_link_$i");
      }
    ));
  }

  $wp_customize->add_section('woocommerce_settings', array(
    'title'    => __('WooCommerce Category', 'skullstheme'),
    'priority' => 120,
  ));

  $wp_customize->add_setting('selected_woocommerce_category', array(
    'default'           => '',
    'sanitize_callback' => 'sanitize_text_field',
  ));

  $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'selected_woocommerce_category', array(
    'label'    => __('Select WooCommerce Category', 'mytheme'),
    'section'  => 'woocommerce_settings',
    'settings' => 'selected_woocommerce_category',
    'type'     => 'select',
    'choices'  => mytheme_get_woocommerce_categories(),
  )));

  $wp_customize->add_section('front_page_cta', array(
    'title'    => __('Front Page CTA', 'skullstheme'),
    'priority' => 120,
  ));

  $wp_customize->add_setting('fp_call_to_action', array(
    'default'           => 'Unleash Your Inner Skull',
    'sanitize_callback' => 'sanitize_text_field',
    'transport'         => 'postMessage',
  ));

  $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'fp_call_to_action', array(
    'label'    => __('Call To Action', 'mytheme'),
    'section'  => 'front_page_cta',
    'settings' => 'fp_call_to_action',
    'type'     => 'text',
  )));

  if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial('fp_call_to_action',
      array('selector' => '.fp_call_to_action', 'render_callback' => function () {
        return get_theme_mod('fp_call_to_action', 'Get ready to embrace skull-inspired fashion, accessories, and decor!');
      },));
  }

  $wp_customize->add_setting('fp_call_to_action_desc', array(
    'default'           => 'Get ready to embrace skull-inspired fashion, accessories, and decor!',
    'sanitize_callback' => 'sanitize_text_field',
    'transport'         => 'postMessage',
  ));

  $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'fp_call_to_action_desc', array(
    'label'    => __('Call To Action Description', 'mytheme'),
    'section'  => 'front_page_cta',
    'settings' => 'fp_call_to_action_desc',
    'type'     => 'text',
  )));

  if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial('fp_call_to_action_desc', array('selector' => '.fp_call_to_action_desc', // CSS selector of the element to refresh
      'render_callback' => function () {
        return get_theme_mod('fp_call_to_action_desc', 'Get ready to embrace skull-inspired fashion, accessories, and decor!');
      },));
  }

  $wp_customize->add_setting('fp_cta_button', array(
    'default'           => 'Shop the Collection',
    'sanitize_callback' => 'sanitize_text_field',
    'transport'         => 'postMessage',
  ));

  $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'fp_cta_button', array(
    'label'    => __('Button Label', 'mytheme'),
    'section'  => 'front_page_cta',
    'settings' => 'fp_cta_button',
    'type'     => 'text',
  )));

  if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial('fp_cta_button', array(
      'selector' => '.fp_cta_button', // CSS selector of the element to refresh
      'render_callback' => function() {
        return get_theme_mod('fp_cta_button', 'Shop the Collection');
      },
    ));
  }

  $wp_customize->add_setting('fp_cta_button_link', array(
    'default'           => '/shop',
    'sanitize_callback' => 'esc_url_raw',
    'transport'         => 'postMessage',
  ));

  $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'fp_cta_button_link', array(
    'label'    => __('Button Link', 'mytheme'),
    'section'  => 'front_page_cta',
    'settings' => 'fp_cta_button_link',
    'type'     => 'url',
  )));

  if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial('fp_cta_button_link', array(
      'selector' => '.fp-cta-button-link', // CSS selector of the element to refresh
      'render_callback' => function() {
        return get_theme_mod('fp_cta_button_link', '/shop');
      },
    ));
  }
}
add_action( 'customize_register', 'skulls_customize_register' );

// Helper function to get WooCommerce categories
function mytheme_get_woocommerce_categories() {
  $terms = get_terms(array(
    'taxonomy'   => 'product_cat',
    'hide_empty' => false,
  ));
  $choices = array();
  foreach ($terms as $term) {
    $choices[$term->slug] = $term->name;
  }
  return $choices;
}