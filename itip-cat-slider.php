<?php

/*
 * Plugin Name:       ITIP Product Category Slider
 * Plugin URI:        https://itipteam.com/
 * Description:       Add slider effect to category product image
 * Version:           1.0.0
 * Requires at least: 5.0
 * Requires PHP:      7.0
 * Author:            Oleg Kovalyov
 * Author URI:        https://www.linkedin.com/in/oleg-kovalyov-42312916a/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 */

function itip_cat_slider_scripts() {

	if( is_product_category() ):
		// wp_enqueue_style( 'style', get_stylesheet_uri() );

		wp_enqueue_style( 'slider', plugin_dir_url( __FILE__ ) . 'assets/css/slider.css', array(), '1.0', 'all' );

		// wp_enqueue_style( 'slick-css', plugin_dir_url( __FILE__ ) . 'assets/css/slick.css', array(), '1.8', 'all' );

		// wp_enqueue_script( 'script', get_template_directory_uri() . '/assets/js/script.js', array( 'jquery' ), 1.0, true );
		// wp_enqueue_script( 'script', plugin_dir_url( __FILE__ ) . 'assets/js/script.js', array( 'jquery' ), 1.0, true );
		// wp_enqueue_script( 'slick-js', plugin_dir_url( __FILE__ ) . 'assets/js/slick.min.js', array( 'jquery' ), 1.8, true );
		wp_enqueue_script( 'script', plugin_dir_url( __FILE__ ) . 'assets/js/script.js', array( 'jquery' ), 1.0, true );

		// if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		// 	wp_enqueue_script( 'comment-reply' );
		// }
	endif;
}
add_action( 'wp_enqueue_scripts', 'itip_cat_slider_scripts' );

// function itip_slider_images_field() {
//
// 	// Get the ACF additional image URL.
// 	$product_id = get_the_ID();
// 	$additional_image_url =  get_field( 'slider_images', $product_id );
//
// 	// Output the additional image if it's available.
//     if ( $additional_image_url ) {
//         echo '<img src="' . esc_url($additional_image_url) . '" alt="Additional Image">';
//     }
// }
// add_action('woocommerce_before_shop_loop_item_title', 'itip_slider_images_field', 10);
// add_action( 'woocommerce_single_product_summary', 'itip_slider_images_field', 3 );

// function woocommerce_template_loop_product_thumbnail(){
//   echo "apple";
// }

// function vchuy_second_thumb_product() {
//
// 	$product = new WC_Product( get_the_ID() );
// 	$attachment_ids = $product->get_gallery_image_ids();
// 	$product_id = get_the_ID();
// 	$additional_image_url =  get_field( 'slider_images', $product_id );
//
// 	if ( !empty( $additional_image_url ) ) {
// 		$first_image_url = wp_get_attachment_url( $attachment_ids[0] );
// 		echo '<img class=\"overlay-content\" src=' . $additional_image_url;
// 	}
//
// }
// add_action('woocommerce_before_shop_loop_item_title', 'vchuy_second_thumb_product', 20 );

// function itip_add_featured_image() {
//
//     // $imageID = 48; // Image ID
// 	// $post_id = 95; //Product ID
// 	$product_id = 95; //Product ID
// 	$additional_image_url = get_field('slider_images', $product_id);
//
// 	// Set the main image URL to the ACF image URL.
// 	update_post_meta( $product_id, '_thumbnail_id', 0); // Remove existing featured image.
// 	update_post_meta($product_id, '_product_image_gallery', ''); // Clear product gallery.
//
// 	// Set the product's main image to the ACF image URL.
// 	update_post_meta($product_id, '_product_image_gallery', $additional_image_url);
//     // set_post_thumbnail( $post_id, $imageID );
// }
// add_action('init', 'itip_cat_slider_scripts');

// Customize WooCommerce shop page product thumbnails
// Make slider on product thumbnail with additional image from ACF field slider_image
// function custom_woocommerce_shop_thumbnail($html, $post_id) {
//
//     // Get the post thumbnail (featured image) URL
//     $thumbnail_url = get_the_post_thumbnail_url($post_id, 'thumbnail'); // You can change 'thumbnail' to your desired image size
//
//     // Check if there's an additional image URL from an ACF field (replace 'additional_image' with your ACF field name)
//     $additional_image_url = get_field('slider_images', $post_id);
//
//     // Use the additional image URL if available, otherwise, use the post thumbnail
//     if ($additional_image_url) {
//         $html = '<img src="' . esc_url($additional_image_url) . '" alt="' . esc_attr(get_the_title($post_id)) . '">';
//     } elseif ($thumbnail_url) {
//         $html = '<img src="' . esc_url($thumbnail_url) . '" alt="' . esc_attr(get_the_title($post_id)) . '">';
//     }
//
//     return $html;
// }
// add_filter('woocommerce_get_product_thumbnail', 'custom_woocommerce_shop_thumbnail', 10, 2);

// Customize WooCommerce shop page product thumbnails
// Make slider on product thumbnail with additional image from ACF field slider_image
function replacing_template_loop_product_thumbnail() {

	// remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );

	function wc_template_loop_product_replaced_thumb() {
		$product_id = get_the_ID();

// 		$post_thumbnail_id = get_post_thumbnail_id( $product_id );
// 		$attachment = wp_get_attachment_image_src( $post_thumbnail_id );
// error_log('$attachment');error_log(print_r($attachment,1));
// 		$width=$attachment[1];
// 		$height=$attachment[2];

error_log('$product_id');error_log($product_id);
		$thumbnail_url = get_the_post_thumbnail_url($product_id, 'thumbnail');
		$additional_image_url = get_field( 'slider_image', $product_id );
error_log('$additional_image_url');error_log($additional_image_url);
		// size can be: (thumbnail, medium, large, full or custom size)
		$additional_image = wp_get_attachment_image_src( $additional_image_url, 'medium' );
error_log('$additional_image');error_log(print_r($additional_image,1));

		// $attachment_id = get_field('icon', $termid_kategorie);
// error_log('$thumbnail_url');error_log($thumbnail_url);
// error_log('$additional_image_url');error_log($additional_image);

		if ( $additional_image_url ) {
			echo '<img width="285" height="300" src="' . $additional_image_url . '" class="overlay-content" alt="" decoding="async" loading="lazy">';
		} else {
			// echo '<img width="285" height="300" src="' . $thumbnail_url . '" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail"
			// 	alt="" decoding="async" loading="lazy">';
		}
		// echo '<img width="285" height="300" src="http://itipglib.local/wp-content/uploads/2022/02/pottery.webp"
			// class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail"
			// alt="" decoding="async" loading="lazy">';
	}
	add_action( 'woocommerce_before_shop_loop_item_title', 'wc_template_loop_product_replaced_thumb', 10 );
}

add_action( 'woocommerce_init', 'replacing_template_loop_product_thumbnail' );
