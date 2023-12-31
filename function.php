/**
 * Put this code in you themes' function.php
 */


add_filter('woocommerce_available_payment_gateways', 'allow_payment_method_for_shipping', 10, 1);

function allow_payment_method_for_shipping($available_gateways) {
    if (!is_admin() && is_checkout()) {
        $chosen_methods = WC()->session->get('chosen_shipping_methods');
        $chosen_shipping = $chosen_methods[0];

        // Set your desired shipping method ID and payment method ID
        $desired_shipping_method_id = 'flat_rate:3';
        $desired_payment_method_id = 'jetpack_custom_gateway_2';
/**
 * edit `flat_rate:3` with you shipping method id (you will get it by inspect element, that showing as value="flat_rate:3"), 
 * edit `jetpack_custom_gateway_2` with your desired payment gateway that you want to allow.
*/

        if ($chosen_shipping !== $desired_shipping_method_id && isset($available_gateways[$desired_payment_method_id])) {
            unset($available_gateways[$desired_payment_method_id]);
        }
    }

    return $available_gateways;
}
