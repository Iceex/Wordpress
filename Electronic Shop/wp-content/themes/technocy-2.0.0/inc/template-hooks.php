<?php
/**
 * =================================================
 * Hook technocy_page
 * =================================================
 */
add_action('technocy_page', 'technocy_page_header', 10);
add_action('technocy_page', 'technocy_page_content', 20);

/**
 * =================================================
 * Hook technocy_single_post_top
 * =================================================
 */
add_action('technocy_single_post_top', 'technocy_post_thumbnail', 10);

/**
 * =================================================
 * Hook technocy_single_post
 * =================================================
 */
add_action('technocy_single_post', 'technocy_post_header', 10);
add_action('technocy_single_post', 'technocy_post_content', 30);

/**
 * =================================================
 * Hook technocy_single_post_bottom
 * =================================================
 */
add_action('technocy_single_post_bottom', 'technocy_post_taxonomy', 5);
add_action('technocy_single_post_bottom', 'technocy_post_nav', 10);
add_action('technocy_single_post_bottom', 'technocy_display_comments', 20);

/**
 * =================================================
 * Hook technocy_loop_post
 * =================================================
 */
add_action('technocy_loop_post', 'technocy_post_header', 15);
add_action('technocy_loop_post', 'technocy_post_content', 30);

/**
 * =================================================
 * Hook technocy_footer
 * =================================================
 */
add_action('technocy_footer', 'technocy_footer_default', 20);

/**
 * =================================================
 * Hook technocy_after_footer
 * =================================================
 */

/**
 * =================================================
 * Hook wp_footer
 * =================================================
 */
add_action('wp_footer', 'technocy_template_account_dropdown', 1);
add_action('wp_footer', 'technocy_mobile_nav', 1);

/**
 * =================================================
 * Hook wp_head
 * =================================================
 */
add_action('wp_head', 'technocy_pingback_header', 1);

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
add_action('technocy_sidebar', 'technocy_get_sidebar', 10);

/**
 * =================================================
 * Hook technocy_loop_after
 * =================================================
 */
add_action('technocy_loop_after', 'technocy_paging_nav', 10);

/**
 * =================================================
 * Hook technocy_page_after
 * =================================================
 */
add_action('technocy_page_after', 'technocy_display_comments', 10);

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

/**
 * =================================================
 * Hook technocy_woocommerce_shop_loop_item_title
 * =================================================
 */

/**
 * =================================================
 * Hook technocy_woocommerce_after_shop_loop_item_title
 * =================================================
 */

/**
 * =================================================
 * Hook technocy_woocommerce_after_shop_loop_item
 * =================================================
 */
