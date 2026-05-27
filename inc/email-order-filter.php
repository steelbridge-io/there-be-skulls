<?php


add_filter('woocommerce_email_recipient_new_order', 'restrict_new_order_email_for_confirmed_payments', 10, 2);
function restrict_new_order_email_for_confirmed_payments($recipient, $order) {
 // Check if $order is valid
 if (!is_a($order, 'WC_Order')) {
  error_log('New Order Email: Invalid order object');
  return $recipient;
 }

 // Get the order status
 $status = $order->get_status();
 error_log('New Order Email: Order ID ' . $order->get_id() . ' Status: ' . $status);

 // Only send New Order email for 'processing' or 'completed' statuses
 if (!in_array($status, array('processing', 'completed'))) {
  error_log('New Order Email: Blocked for Order ID ' . $order->get_id() . ' (Status: ' . $status . ')');
  return '';
 }

 error_log('New Order Email: Allowed for Order ID ' . $order->get_id() . ' (Status: ' . $status . ')');
 return $recipient;
}

// Prevent Failed Order email
/*add_filter('woocommerce_email_recipient_failed_order', 'disable_admin_failed_order_email', 10, 2);
function disable_admin_failed_order_email($recipient, $order) {
 return '';
}*/