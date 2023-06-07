<?php
/**
 * =================================================
 * Hook technocy_page
 * =================================================
 */

/**
 * =================================================
 * Hook technocy_single_post_top
 * =================================================
 */

/**
 * =================================================
 * Hook technocy_single_post
 * =================================================
 */

/**
 * =================================================
 * Hook technocy_single_post_bottom
 * =================================================
 */

/**
 * =================================================
 * Hook technocy_loop_post
 * =================================================
 */

/**
 * =================================================
 * Hook technocy_footer
 * =================================================
 */

/**
 * =================================================
 * Hook technocy_after_footer
 * =================================================
 */
add_action('technocy_after_footer', 'technocy_sticky_single_add_to_cart', 999);

/**
 * =================================================
 * Hook wp_footer
 * =================================================
 */
add_action('wp_footer', 'technocy_render_woocommerce_shop_canvas', 1);

/**
 * =================================================
 * Hook wp_head
 * =================================================
 */

/**
 * =================================================
 * Hook technocy_before_header
 * =================================================
 */

/**
 * =================================================
 * Hook technocy_before_content
 * =================================================
 */

/**
 * =================================================
 * Hook technocy_content_top
 * =================================================
 */
add_action('technocy_content_top', 'technocy_shop_messages', 10);

/**
 * =================================================
 * Hook technocy_post_content_before
 * =================================================
 */

/**
 * =================================================
 * Hook technocy_post_content_after
 * =================================================
 */

/**
 * =================================================
 * Hook technocy_sidebar
 * =================================================
 */

/**
 * =================================================
 * Hook technocy_loop_after
 * =================================================
 */

/**
 * =================================================
 * Hook technocy_page_after
 * =================================================
 */

/**
 * =================================================
 * Hook technocy_woocommerce_before_shop_loop_item
 * =================================================
 */

/**
 * =================================================
 * Hook technocy_woocommerce_before_shop_loop_item_title
 * =================================================
 */
add_action('technocy_woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
add_action('technocy_woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);

/**
 * =================================================
 * Hook technocy_woocommerce_shop_loop_item_title
 * =================================================
 */
add_action('technocy_woocommerce_shop_loop_item_title', 'technocy_woocommerce_get_product_category', 5);
add_action('technocy_woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 5);
add_action('technocy_woocommerce_shop_loop_item_title', 'woocommerce_template_loop_rating', 10);

/**
 * =================================================
 * Hook technocy_woocommerce_after_shop_loop_item_title
 * =================================================
 */
add_action('technocy_woocommerce_after_shop_loop_item_title', 'technocy_woocommerce_get_product_description', 15);
add_action('technocy_woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 20);
add_action('technocy_woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 25);
add_action('technocy_woocommerce_after_shop_loop_item_title', 'technocy_wishlist_button', 30);
add_action('technocy_woocommerce_after_shop_loop_item_title', 'technocy_quickview_button', 35);
add_action('technocy_woocommerce_after_shop_loop_item_title', 'technocy_compare_button', 40);

/**
 * =================================================
 * Hook technocy_woocommerce_after_shop_loop_item
 * =================================================
 */
