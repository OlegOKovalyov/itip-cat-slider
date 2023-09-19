<?php

/*
 * Plugin Name:       ITIP Product Category Slider
 * Plugin URI:        https://itipteam.com/
 * Description:       Add slider effect to category product image
 * Version:           1.0.3
 * Requires at least: 5.0
 * Requires PHP:      7.0
 * Author:            Oleg Kovalyov
 * Author URI:        https://www.linkedin.com/in/oleg-kovalyov-42312916a/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 */

// Enqueue the plugin CSS file
function itip_cat_slider_scripts() {
	if( is_product_category() ):
		wp_enqueue_style( 'slider', plugin_dir_url( __FILE__ ) . 'assets/css/slider.css', array(), '1.0', 'all' );
	endif;
}
add_action( 'wp_enqueue_scripts', 'itip_cat_slider_scripts' );

// Customize WooCommerce shop page product thumbnails
// Make slider effect on product thumbnail with additional image from ACF field 'slider_image'
function itip_replacing_template_loop_product_thumbnail() {

	function wc_template_loop_product_replaced_thumb() {

		$product_id = get_the_ID();

		$thumbnail_url = get_the_post_thumbnail_url($product_id, 'thumbnail');

		// Get additional image URL from ACF field in Edit Product page
		$additional_image_url = get_field( 'slider_image', $product_id );
		$additional_image = wp_get_attachment_image_src( $additional_image_url, 'medium' );

		if ( $additional_image_url && is_product_category() ) { // On category page only
			echo '<img width="" height="" src="' . $additional_image_url .
				'" class="overlay-content" alt="" decoding="async" loading="lazy">';
		} else {

		}
	}
	add_action( 'woocommerce_before_shop_loop_item_title', 'wc_template_loop_product_replaced_thumb', 10 );
}

add_action( 'woocommerce_init', 'itip_replacing_template_loop_product_thumbnail' );
