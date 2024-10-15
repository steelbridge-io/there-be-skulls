<?php
function therebeskulls_custom_logo_setup($wp_customize) {
  // Add a setting for the logo
  $wp_customize->add_setting('custom_logo', array(
    'default'       => '',
    'transport'     => 'refresh',
  ));

  // Add a control to upload the logo
  $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'custom_logo', array(
    'label'         => __('Upload Logo', 'mytheme'),
    'section'       => 'title_tagline',
    'settings'      => 'custom_logo',
  )));
}
add_action('customize_register', 'therebeskulls_custom_logo_setup');