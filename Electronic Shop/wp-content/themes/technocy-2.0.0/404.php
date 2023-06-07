<?php
get_header(); ?>

    <div id="primary" class="content">
        <main id="main" class="site-main" role="main">
            <div class="error-404 not-found">
                <div class="error-img404">
                    <img src="<?php echo get_theme_file_uri('assets/images/404/404.png') ?>" alt="<?php echo esc_attr__('404 Page', 'technocy') ?>">
                </div>
                <div class="page-content">
                    <header class="page-header">
                        <h1 class="page-title"><?php esc_html_e('Oops!', 'technocy'); ?></h1>
                        <h3 class="sub-title"><?php esc_html_e('That Links Is Broken.', 'technocy'); ?></h3>
                    </header><!-- .page-header -->

                    <div class="error-text">
                        <span><?php esc_html_e("Page does not exist or some other error occured. Go to our", 'technocy') ?></span>
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="return-home c-secondary">
                            <?php esc_html_e('Home page', 'technocy'); ?>
                        </a>
                    </div>
                    <a href="javascript: history.go(-1)" class="go-back"><?php esc_html_e('Go back', 'technocy'); ?><i aria-hidden="true" class="fas fa-chevron-right"></i></a>
                </div><!-- .page-content -->
            </div><!-- .error-404 -->
        </main><!-- #main -->
    </div><!-- #primary -->
<?php
get_footer();
