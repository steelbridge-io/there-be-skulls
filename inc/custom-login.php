<?php

// Change the login logo URL
function custom_login_logo_url() {
  return home_url();
}
add_filter('login_headerurl', 'custom_login_logo_url');

// Change the login logo title
function custom_login_logo_url_title() {
  return 'There Be Skulls';
}
add_filter('login_headertext', 'custom_login_logo_url_title');

// Custom background SVG
function custom_login_content() {
  ?>
  <style type="text/css">
      body.login {
          background-color: #232526 !important;
          background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/img/skull-pattern.svg) !important;
          background-repeat: repeat !important;
      }
      #login h1 a, .login h1 a {
          background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/img/there-be-skulls-logo.webp);
          height:65px;
          width:320px;
          background-size: contain;
          background-repeat: no-repeat;
          padding-bottom: 30px;
      }
  </style>
  <?php
}
add_action('login_enqueue_scripts', 'custom_login_content');
