<?php

function mytheme_register_footer_widgets() {
  register_sidebar(array(
    'name' => 'Footer Column 1',
    'id' => 'footer-1',
    'before_widget' => '<div class="footer-widget footer-column-1">',
    'after_widget'  => '</div>',
    'before_title'  => '<h4>',
    'after_title'   => '</h4>',
  ));

  register_sidebar(array(
    'name' => 'Footer Column 2',
    'id' => 'footer-2',
    'before_widget' => '<div class="footer-widget footer-column-2">',
    'after_widget'  => '</div>',
    'before_title'  => '<h4>',
    'after_title'   => '</h4>',
  ));

  register_sidebar(array(
    'name' => 'Footer Column 3',
    'id' => 'footer-3',
    'before_widget' => '<div class="footer-widget footer-column-3">',
    'after_widget'  => '</div>',
    'before_title'  => '<h4>',
    'after_title'   => '</h4>',
  ));
}
add_action('widgets_init', 'mytheme_register_footer_widgets');
