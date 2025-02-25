<?php
/*
Plugin Name:  product slider variation
Plugin URI:   https://swarnatek.com/
Description:  A slider for  product post_type
Version:      1.0
Author:       Swarnatek
Author URI:   https://www.swarnatek.com
License:      GPL2
License URI:  https://www.swarnatek.com
*/

(defined('ABSPATH') || exit );

register_activation_hook(__FILE__, "activate_myplugin");
register_deactivation_hook(__FILE__, "deactivate_myplugin");

function product_category_repeater_variation()
{
    wp_enqueue_script('jquery');
    wp_enqueue_script('slider.min.js', plugin_dir_url(__FILE__) . '/assets/js/slick.min.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('slick.slider.js', plugin_dir_url(__FILE__) . '/assets/js/slick.slider.js', array('jquery'), '1.0.0', true);
    wp_enqueue_style('slick-theme.css', plugin_dir_url(__FILE__) . '/assets/css/slick-theme.css');
    wp_enqueue_style('slider.css', plugin_dir_url(__FILE__) . '/assets/css/slider.css');
    wp_enqueue_style('slider.style.css', plugin_dir_url(__FILE__) . '/assets/css/style.css');
}
add_action('wp_enqueue_scripts', 'product_category_repeater_variation');



/**
 * Replace add to cart button in the loop.
 */
function iconic_change_loop_add_to_cart() {
    remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
    add_action( 'woocommerce_after_shop_loop_item', 'iconic_template_loop_add_to_cart', 10 );
}

add_action( 'init', 'iconic_change_loop_add_to_cart', 10 );

/**
 * Use single add to cart button for variable products.
 */
function iconic_template_loop_add_to_cart() {
    global $product;

    if ( ! $product->is_type( 'variable' ) ) {
        woocommerce_template_loop_add_to_cart();
        return;
    }

    remove_action( 'woocommerce_single_variation', 'woocommerce_single_variation_add_to_cart_button', 20 );
    add_action( 'woocommerce_single_variation', 'iconic_loop_variation_add_to_cart_button', 20 );

    woocommerce_template_single_add_to_cart();
}

/**
 * Customise variable add to cart button for loop.
 *
 * Remove qty selector and simplify.
 */
function iconic_loop_variation_add_to_cart_button() {
    global $product;

    ?>
    <div class="woocommerce-variation-add-to-cart variations_button">
        <button type="submit" class="single_add_to_cart_button button"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>
        <input type="hidden" name="add-to-cart" value="<?php echo absint( $product->get_id() ); ?>" />
        <input type="hidden" name="product_id" value="<?php echo absint( $product->get_id() ); ?>" />
        <input type="hidden" name="variation_id" class="variation_id" value="0" />
    </div>
    <?php
}

add_shortcode('simpleshortcode', 'iconic_loop_variation_add_to_cart_button');


?>