<?php
if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly
}

function skulls_customize_register($wp_customize) {

  // Add Section for Front Page Categories
  $wp_customize->add_section('skulls_category_section', array(
    'title'    => __('Front Page Categories', 'skullstheme'),
    'description' => __('Select categories to display on the front page', 'skullstheme'),
    'priority' => 120,
  ));

  // Add settings and controls for each category
  for ($i = 1; $i <= 12; $i++) {
    $wp_customize->add_setting("skulls_category_$i", array(
      'default' => '',
      'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control(
      new WP_Customize_Control(
        $wp_customize,
        "skulls_category_$i",
        array(
          'label'          => __("Category $i", 'skullstheme'),
          'section'        => 'skulls_category_section',
          'settings'       => "skulls_category_$i",
          'type'           => 'text',
        )
      )
    );
  }


  // Add Section for Header Carousel
  $wp_customize->add_section('skulls_carousel_section', array(
    'title'    => __('Header Carousel', 'skullstheme'),
    'description' => __('Select categories to display on the front page', 'skullstheme'),
    'priority' => 120,
  ));

  // Add settings and controls item
  for ($i = 1; $i <= 4; $i++) {
    $wp_customize->add_setting("skulls_carousel_$i", array(
      'default' => '',
      'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control(
      new WP_Customize_Control(
        $wp_customize,
        "skulls_carousel_$i",
        array(
          'label'          => __("Carousel Item $i", 'skullstheme'),
          'section'        => 'skulls_carousel_section',
          'settings'       => "skulls_carousel_$i",
          'type'           => 'text',
        )
      )
    );
  }
  
// Add settings and controls for each category link
  for ($i = 1; $i <= 4; $i++) {
    $wp_customize->add_setting("skulls_carousel_link_$i", array(
      'default'           => '',
      'sanitize_callback' => 'esc_url_raw',
    ));
	
    $wp_customize->add_control(
      new WP_Customize_Control(
        $wp_customize,
        "skulls_carousel_link_$i",
        array(
          'label'       => __("Carousel Item $i Link ", 'skullstheme'),
          'section'     => 'skulls_carousel_section',
          'settings'    => "skulls_carousel_link_$i",
          'type'        => 'url',
        )
      )
    );
  }
}

add_action('customize_register', 'skulls_customize_register');