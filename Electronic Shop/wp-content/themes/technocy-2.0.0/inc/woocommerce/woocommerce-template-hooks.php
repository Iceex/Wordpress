<?php
/**
 * Technocy WooCommerce hooks
 *
 * @package technocy
 */

/**
 * Layout
 *
 * @see  technocy_before_content()
 * @see  technocy_after_content()
 * @see  woocommerce_breadcrumb()
 * @see  technocy_shop_messages()
 */

remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

add_action('woocommerce_before_main_content', 'technocy_before_content', 10);
add_action('woocommerce_after_main_content', 'technocy_after_content', 10);

add_action('woocommerce_before_shop_loop', 'technocy_sorting_wrapper', 19);
add_action('woocommerce_before_shop_loop', 'technocy_button_shop_canvas', 19);
add_action('woocommerce_before_shop_loop', 'technocy_button_shop_dropdown', 19);
add_action('woocommerce_before_shop_loop', 'technocy_button_grid_list_layout', 25);
add_action('woocommerce_before_shop_loop', 'technocy_sorting_wrapper_close', 40);
if (technocy_get_theme_option('woocommerce_archive_layout') == 'dropdown') {
    add_action('woocommerce_before_shop_loop', 'technocy_render_woocommerce_shop_dropdown', 35);
}

//Position label onsale
remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);
add_action('technocy_single_product_video_360', 'woocommerce_show_product_sale_flash', 30);

//Wrapper content single
add_action('woocommerce_before_single_product_summary', 'technocy_woocommerce_single_content_wrapper_start', 0);
add_action('woocommerce_single_product_summary', 'technocy_woocommerce_single_content_wrapper_end', 99);
add_action('woocommerce_before_single_product_summary', 'technocy_woocommerce_single_content_title', 0);
// Legacy WooCommerce columns filter.
if (defined('WC_VERSION') && version_compare(WC_VERSION, '3.3', '<')) {
    add_filter('loop_shop_columns', 'technocy_loop_columns');
    add_action('woocommerce_before_shop_loop', 'technocy_product_columns_wrapper', 40);
    add_action('woocommerce_after_shop_loop', 'technocy_product_columns_wrapper_close', 40);
}

/**
 * Products
 *
 * @see technocy_upsell_display()
 * @see technocy_single_product_pagination()
 */


remove_action('woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20);
remove_action('woocommerce_single_product_summary', 'wooscp_add_button');
add_action('woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 21);
add_action('yith_quick_view_custom_style_scripts', function () {
    wp_enqueue_script('flexslider');
});
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
add_action('woocommerce_single_product_summary', 'technocy_stock_label', 10);
add_action('woocommerce_single_product_summary', 'technocy_woocommerce_deal_progress', 11);
add_action('woocommerce_single_product_summary', 'technocy_woocommerce_time_sale', 12);

add_action('technocy_woocommerce_single_content_title', 'woocommerce_template_single_title', 5);
add_action('technocy_woocommerce_single_content_title', 'technocy_woocommerce_single_brand', 10);
add_action('technocy_woocommerce_single_content_title', 'woocommerce_template_single_rating', 15);
add_action('technocy_woocommerce_single_content_title', 'woocommerce_template_single_meta', 20);

add_filter('woosc_button_position_single', '__return_false');
add_filter('woosw_button_position_single', '__return_false');

add_action('woocommerce_after_add_to_cart_button', 'technocy_compare_button', 20);
add_action('woocommerce_after_add_to_cart_button', 'technocy_wishlist_button', 10);

if(technocy_is_elementor_activated()){
	add_action('woocommerce_share', 'technocy_social_share', 10);
}

$product_single_style = technocy_get_theme_option('single_product_gallery_layout', 'horizontal');

add_theme_support('wc-product-gallery-lightbox');
if ($product_single_style === 'horizontal' || $product_single_style === 'vertical') {
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-slider');
}

add_filter('woocommerce_gallery_thumbnail_size', function () {
    return ['100', '150'];
}, 10);

add_action('technocy_single_product_video_360', 'technocy_single_product_video_360', 10);


/**
 * Cart fragment
 *
 * @see technocy_cart_link_fragment()
 */
if (defined('WC_VERSION') && version_compare(WC_VERSION, '2.3', '>=')) {
    add_filter('woocommerce_add_to_cart_fragments', 'technocy_cart_link_fragment');
} else {
    add_filter('add_to_cart_fragments', 'technocy_cart_link_fragment');
}

remove_action('woocommerce_cart_collaterals', 'woocommerce_cross_sell_display');
add_action('woocommerce_after_cart', 'woocommerce_cross_sell_display');

add_action('woocommerce_checkout_order_review', 'woocommerce_checkout_order_review_start', 5);
add_action('woocommerce_checkout_order_review', 'woocommerce_checkout_order_review_end', 15);

add_filter('woocommerce_get_script_data', function ($params, $handle) {
    if ($handle == "wc-add-to-cart") {
        $params['i18n_view_cart'] = '';
    }
    return $params;
}, 10, 2);

/*
 *
 * Layout Product
 *
 * */

add_filter('woosc_button_position_archive', '__return_false');
add_filter('woosq_button_position', '__return_false');
add_filter('woosw_button_position_archive', '__return_false');

function technocy_include_hooks_product_blocks() {

    remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
    remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
    remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
    remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);

    remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
    remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);

    add_action('woocommerce_before_shop_loop_item', 'technocy_woocommerce_product_loop_start', -1);
    add_action('woocommerce_shop_loop_item_title', 'technocy_woocommerce_product_caption_start', -1);
    /**
     * Integrations
     *
     * @see technocy_template_loop_product_thumbnail()
     *
     */
    add_action('woocommerce_shop_loop_item_title', 'technocy_woocommerce_product_caption_end', 998);
    add_action('woocommerce_after_shop_loop_item', 'technocy_woocommerce_product_loop_end', 999);

    // product-transition
    add_action('woocommerce_before_shop_loop_item_title', 'technocy_woocommerce_product_loop_image', 10);
    add_action('technocy_woocommerce_product_loop_image', 'technocy_woocommerce_get_product_label_stock', 9);
    add_action('technocy_woocommerce_product_loop_image', 'technocy_template_loop_product_thumbnail', 10);
    add_action('technocy_woocommerce_product_loop_image', 'woocommerce_template_loop_product_link_open', 99);
    add_action('technocy_woocommerce_product_loop_image', 'woocommerce_template_loop_product_link_close', 99);
    add_action('technocy_woocommerce_product_loop_image', 'technocy_woocommerce_product_loop_action', 15);

    // Wishlist
    add_action('technocy_woocommerce_product_loop_action', 'technocy_wishlist_button', 10);

    // Compare
    add_action('technocy_woocommerce_product_loop_action', 'technocy_compare_button', 20);

    // QuickView
    add_action('technocy_woocommerce_product_loop_action', 'technocy_quickview_button', 30);

    //content-product-imagin
    add_action('woocommerce_before_shop_loop_item', 'technocy_woocommerce_product_content_product_imagin', 10);

    //categories
    add_action('woocommerce_shop_loop_item_title', 'technocy_woocommerce_get_product_category', 5);

    //rating
    add_action('woocommerce_shop_loop_item_title', 'technocy_woocommerce_template_loop_rating', 16);

    //price
    add_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_price', 20);

    // product-caption-bottom
    add_action('woocommerce_after_shop_loop_item_title', 'technocy_woocommerce_product_loop_bottom_start', -1);
    add_action('woocommerce_after_shop_loop_item_title', 'technocy_woocommerce_product_loop_bottom_end', 999);
    add_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 50);

}

if (isset($_GET['action']) && $_GET['action'] === 'elementor') {
    return;
}

technocy_include_hooks_product_blocks();

