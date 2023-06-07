<header id="masthead" class="site-header header-1" role="banner">
    <div class="header-container">
        <div class="container header-main">
            <div class="header-left">
                <?php
                technocy_site_branding();
                if (technocy_is_woocommerce_activated()) {
                    ?>
                    <div class="site-header-cart header-cart-mobile">
                        <?php technocy_cart_link(); ?>
                    </div>
                    <?php
                }
                ?>
                <?php technocy_mobile_nav_button(); ?>
            </div>
            <div class="header-center">
                <?php technocy_primary_navigation(); ?>
            </div>
            <div class="header-right desktop-hide-down">
                <div class="header-group-action">
                    <?php
                    technocy_header_account();
                    if (technocy_is_woocommerce_activated()) {
                        technocy_header_wishlist();
                        technocy_header_cart();
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</header><!-- #masthead -->
