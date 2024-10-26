<?php

remove_action('woocommerce_after_shop_loop', 'woocommerce_pagination', 10);

// Add custom pagination
function custom_woocommerce_pagination() {
  global $wp_query;
  if ($wp_query->max_num_pages <= 1) return;

  $big = 999999999; // A large number for replacing.

  $pagination_args = array(
    'base'      => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
    'format'    => '?paged=%#%',
    'current'   => max(1, get_query_var('paged')),
    'total'     => $wp_query->max_num_pages,
    'prev_text' => __('« Previous', 'woocommerce'),
    'next_text' => __('Next »', 'woocommerce'),
    'type'      => 'array',
    'end_size'  => 3,
    'mid_size'  => 3,
  );

  $paginate_links = paginate_links($pagination_args);

  if (is_array($paginate_links)) {
    echo '<ul class="custom-pagination">';
    foreach ($paginate_links as $link) {
      echo "<li class='page-item'>$link</li>";
    }
    echo '</ul>';
  }
}
add_action('woocommerce_after_shop_loop', 'custom_woocommerce_pagination');