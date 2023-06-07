
		</div><!-- .col-full -->
	</div><!-- #content -->

	<?php do_action( 'technocy_before_footer' );
    if (technocy_is_elementor_activated() && function_exists('hfe_init') && (hfe_footer_enabled() || hfe_is_before_footer_enabled())) {
        do_action('hfe_footer_before');
        do_action('hfe_footer');
    } else {
        ?>

        <footer id="colophon" class="site-footer" role="contentinfo">
            <?php
            /**
             * Functions hooked in to technocy_footer action
             *
             * @see technocy_footer_default - 20
             *
             *
             */
            do_action('technocy_footer');

            ?>

        </footer><!-- #colophon -->

        <?php
    }

		/**
		 * Functions hooked in to technocy_after_footer action
		 * @see technocy_sticky_single_add_to_cart 	- 999 - woo
		 */
		do_action( 'technocy_after_footer' );
	?>

</div><!-- #page -->

<?php

/**
 * Functions hooked in to wp_footer action
 * @see technocy_template_account_dropdown 	- 1
 * @see technocy_mobile_nav - 1
 * @see technocy_render_woocommerce_shop_canvas - 1 - woo
 */

wp_footer();
?>
</body>
</html>
