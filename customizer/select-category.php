<?php

function mytheme_customize_register($wp_customize) {
  // Add a new section for WooCommerce settings
  $wp_customize->add_section('woocommerce_settings', array(
    'title'    => __('WooCommerce Settings', 'mytheme'),
    'priority' => 120,
  ));

  // Add setting to choose a WooCommerce category
  $wp_customize->add_setting('selected_woocommerce_category', array(
    'default'           => '',
    'sanitize_callback' => 'sanitize_text_field',
  ));

  // Add a control to choose a WooCommerce category
  $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'selected_woocommerce_category', array(
    'label'    => __('Select WooCommerce Category', 'mytheme'),
    'section'  => 'woocommerce_settings',
    'settings' => 'selected_woocommerce_category',
    'type'     => 'select',
    'choices'  => mytheme_get_woocommerce_categories(),
  )));
}
add_action('customize_register', 'mytheme_customize_register');

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
