<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	/**
	 * Functions hooked in to technocy_page action
	 *
	 * @see technocy_page_header          - 10
	 * @see technocy_page_content         - 20
	 *
	 */
	do_action( 'technocy_page' );
	?>
</article><!-- #post-## -->
