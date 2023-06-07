<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="single-content">
            <?php
            /**
             * Functions hooked in to technocy_single_post_top action
             *
             * @see technocy_post_thumbnail        - 10
             */
            do_action('technocy_single_post_top');

            /**
             * Functions hooked in to technocy_single_post action
             * @see technocy_post_header         - 10
             * @see technocy_post_content         - 30
             */
            do_action('technocy_single_post');

            /**
             * Functions hooked in to technocy_single_post_bottom action
             *
             * @see technocy_post_taxonomy      - 5
             * @see technocy_post_nav            - 10
             * @see technocy_display_comments    - 20
             */
            do_action('technocy_single_post_bottom');
            ?>

    </div>

</article><!-- #post-## -->
