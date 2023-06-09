<?php

$blog_style = technocy_get_theme_option( 'blog_style' );
$class      = has_post_thumbnail() ? 'article-default has-thumbnail' : 'article-default';
$class_grid = has_post_thumbnail() ? 'column-item article-default has-thumbnail' : 'column-item article-default';

if ( $blog_style == 'grid' && ! is_single() ): ?>
<article id="post-<?php the_ID(); ?>" <?php post_class( $class_grid ); ?>>
	<?php else: ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class( $class ); ?>>
		<?php endif;
		technocy_post_thumbnail();
		?>
        <div class="post-content">


			<?php
			/**
			 * Functions hooked in to technocy_loop_post action.
			 *
			 * @see technocy_post_header          - 15
			 * @see technocy_post_content         - 30
			 */
			do_action( 'technocy_loop_post' );
			?>
        </div>

    </article><!-- #post-## -->

