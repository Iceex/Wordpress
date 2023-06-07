<?php

if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('Technocy_Elementor')) :

    /**
     * The Technocy Elementor Integration class
     */
    class Technocy_Elementor {
        private $suffix = '';

        public function __construct() {
            $this->suffix = (defined('SCRIPT_DEBUG') && SCRIPT_DEBUG) ? '' : '.min';

            add_action('wp', [$this, 'register_auto_scripts_frontend']);
            add_action('elementor/init', array($this, 'add_category'));
            add_action('wp_enqueue_scripts', [$this, 'add_scripts'], 15);
            add_action('elementor/widgets/register', array($this, 'customs_widgets'));
            add_action('elementor/widgets/register', array($this, 'include_widgets'));
            add_action('elementor/frontend/after_enqueue_scripts', [$this, 'add_js']);

            // Custom Animation Scroll
            add_filter('elementor/controls/animations/additional_animations', [$this, 'add_animations_scroll']);

            // Elementor Fix Noitice WooCommerce
            add_action('elementor/editor/before_enqueue_scripts', array($this, 'woocommerce_fix_notice'));

            // Backend
            add_action('elementor/editor/after_enqueue_styles', [$this, 'add_style_editor'], 99);

            // Add Icon Custom
            add_action('elementor/icons_manager/native', [$this, 'add_icons_native']);
            add_action('elementor/controls/register', [$this, 'add_icons']);

            // Add Breakpoints
            add_action('wp_enqueue_scripts', 'technocy_elementor_breakpoints', 9999);

            if (!technocy_is_elementor_pro_activated()) {
                require trailingslashit(get_template_directory()) . 'inc/elementor/custom-css.php';
                require trailingslashit(get_template_directory()) . 'inc/elementor/sticky-section.php';
                if (is_admin()) {
                    add_action('manage_elementor_library_posts_columns', [$this, 'admin_columns_headers']);
                    add_action('manage_elementor_library_posts_custom_column', [$this, 'admin_columns_content'], 10, 2);
                }
            }

//            add_filter('elementor/fonts/additional_fonts', [$this, 'additional_fonts']);
            add_action('wp_enqueue_scripts', [$this, 'elementor_kit']);
        }

        public function elementor_kit() {
            $active_kit_id = Elementor\Plugin::$instance->kits_manager->get_active_id();
            Elementor\Plugin::$instance->kits_manager->frontend_before_enqueue_styles();
            $myvals = get_post_meta($active_kit_id, '_elementor_page_settings', true);
            if (!empty($myvals)) {
                $css = '';
                foreach ($myvals['system_colors'] as $key => $value) {
                    $css .= $value['color'] !== '' ? '--' . $value['_id'] . ':' . $value['color'] . ';' : '';
                }

                $var = "body{{$css}}";
                wp_add_inline_style('technocy-style', $var);
            }
        }

        public function additional_fonts($fonts) {
            $fonts["Technocy"] = 'system';
            return $fonts;
        }

        public function admin_columns_headers($defaults) {
            $defaults['shortcode'] = esc_html__('Shortcode', 'technocy');

            return $defaults;
        }

        public function admin_columns_content($column_name, $post_id) {
            if ('shortcode' === $column_name) {
                ob_start();
                ?>
                <input class="elementor-shortcode-input" type="text" readonly onfocus="this.select()" value="[hfe_template id='<?php echo esc_attr($post_id); ?>']"/>
                <?php
                ob_get_contents();
            }
        }

        public function add_js() {
            global $technocy_version;
            wp_enqueue_script('technocy-elementor-frontend', get_theme_file_uri('/assets/js/elementor-frontend.js'), [], $technocy_version);
        }

        public function add_style_editor() {
            global $technocy_version;
            wp_enqueue_style('technocy-elementor-editor-icon', get_theme_file_uri('/assets/css/admin/elementor/icons.css'), [], $technocy_version);
        }

        public function add_scripts() {
            global $technocy_version;
            $suffix = (defined('SCRIPT_DEBUG') && SCRIPT_DEBUG) ? '' : '.min';
            wp_enqueue_style('technocy-elementor', get_template_directory_uri() . '/assets/css/base/elementor.css', '', $technocy_version);
            wp_style_add_data('technocy-elementor', 'rtl', 'replace');

            // Add Scripts
            wp_register_script('tweenmax', get_theme_file_uri('/assets/js/vendor/TweenMax.min.js'), array('jquery'), '1.11.1');
            wp_register_script('parallaxmouse', get_theme_file_uri('/assets/js/vendor/jquery-parallax.js'), array('jquery'), $technocy_version);

            if (technocy_elementor_check_type('animated-bg-parallax')) {
                wp_enqueue_script('tweenmax');
                wp_enqueue_script('jquery-panr', get_theme_file_uri('/assets/js/vendor/jquery-panr' . $suffix . '.js'), array('jquery'), '0.0.1');
            }
        }


        public function register_auto_scripts_frontend() {
            global $technocy_version;
            wp_register_script('technocy-elementor-brand', get_theme_file_uri('/assets/js/elementor/brand.js'), array('jquery','elementor-frontend'), $technocy_version, true);
            wp_register_script('technocy-elementor-countdown', get_theme_file_uri('/assets/js/elementor/countdown.js'), array('jquery','elementor-frontend'), $technocy_version, true);
            wp_register_script('technocy-elementor-header-group', get_theme_file_uri('/assets/js/elementor/header-group.js'), array('jquery','elementor-frontend'), $technocy_version, true);
            wp_register_script('technocy-elementor-image-gallery', get_theme_file_uri('/assets/js/elementor/image-gallery.js'), array('jquery','elementor-frontend'), $technocy_version, true);
            wp_register_script('technocy-elementor-menu-carousel', get_theme_file_uri('/assets/js/elementor/menu-carousel.js'), array('jquery','elementor-frontend'), $technocy_version, true);
            wp_register_script('technocy-elementor-posts-grid', get_theme_file_uri('/assets/js/elementor/posts-grid.js'), array('jquery','elementor-frontend'), $technocy_version, true);
            wp_register_script('technocy-elementor-product-categories', get_theme_file_uri('/assets/js/elementor/product-categories.js'), array('jquery','elementor-frontend'), $technocy_version, true);
            wp_register_script('technocy-elementor-product-tab', get_theme_file_uri('/assets/js/elementor/product-tab.js'), array('jquery','elementor-frontend'), $technocy_version, true);
            wp_register_script('technocy-elementor-products', get_theme_file_uri('/assets/js/elementor/products.js'), array('jquery','elementor-frontend'), $technocy_version, true);
            wp_register_script('technocy-elementor-tabs', get_theme_file_uri('/assets/js/elementor/tabs.js'), array('jquery','elementor-frontend'), $technocy_version, true);
            wp_register_script('technocy-elementor-testimonial', get_theme_file_uri('/assets/js/elementor/testimonial.js'), array('jquery','elementor-frontend'), $technocy_version, true);
            wp_register_script('technocy-elementor-video', get_theme_file_uri('/assets/js/elementor/video.js'), array('jquery','elementor-frontend'), $technocy_version, true);
           
        }

        public function add_category() {
            Elementor\Plugin::instance()->elements_manager->add_category(
                'technocy-addons',
                array(
                    'title' => esc_html__('Technocy Addons', 'technocy'),
                    'icon'  => 'fa fa-plug',
                ),
                1);
        }

        public function add_animations_scroll($animations) {
            $animations['Technocy Animation'] = [
                'opal-move-up'    => 'Move Up',
                'opal-move-down'  => 'Move Down',
                'opal-move-left'  => 'Move Left',
                'opal-move-right' => 'Move Right',
                'opal-flip'       => 'Flip',
                'opal-helix'      => 'Helix',
                'opal-scale-up'   => 'Scale',
                'opal-am-popup'   => 'Popup',
            ];

            return $animations;
        }

        public function customs_widgets() {
            $files = glob(get_theme_file_path('/inc/elementor/custom-widgets/*.php'));
            foreach ($files as $file) {
                if (file_exists($file)) {
                    require_once $file;
                }
            }
        }

        /**
         * @param $widgets_manager Elementor\Widgets_Manager
         */
        public function include_widgets($widgets_manager) {
            $files = glob(get_theme_file_path('/inc/elementor/widgets/*.php'));
            foreach ($files as $file) {
                if (file_exists($file)) {
                    require_once $file;
                }
            }
        }

        public function woocommerce_fix_notice() {
            if (technocy_is_woocommerce_activated()) {
                remove_action('woocommerce_cart_is_empty', 'woocommerce_output_all_notices', 5);
                remove_action('woocommerce_shortcode_before_product_cat_loop', 'woocommerce_output_all_notices', 10);
                remove_action('woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 10);
                remove_action('woocommerce_before_single_product', 'woocommerce_output_all_notices', 10);
                remove_action('woocommerce_before_cart', 'woocommerce_output_all_notices', 10);
                remove_action('woocommerce_before_checkout_form', 'woocommerce_output_all_notices', 10);
                remove_action('woocommerce_account_content', 'woocommerce_output_all_notices', 10);
                remove_action('woocommerce_before_customer_login_form', 'woocommerce_output_all_notices', 10);
            }
        }

        public function add_icons( $manager ) {
            $new_icons = json_decode( '{"technocy-icon-account":"account","technocy-icon-address":"address","technocy-icon-air-conditioners":"air-conditioners","technocy-icon-angle-down":"angle-down","technocy-icon-angle-left":"angle-left","technocy-icon-angle-right":"angle-right","technocy-icon-angle-up":"angle-up","technocy-icon-calendar":"calendar","technocy-icon-cart-plus":"cart-plus","technocy-icon-cart":"cart","technocy-icon-chat":"chat","technocy-icon-check-square-solid":"check-square-solid","technocy-icon-clock":"clock","technocy-icon-compare":"compare","technocy-icon-delivery-1":"delivery-1","technocy-icon-delivery-2":"delivery-2","technocy-icon-delivery":"delivery","technocy-icon-eye":"eye","technocy-icon-filter-ul":"filter-ul","technocy-icon-gaming":"gaming","technocy-icon-heart-1":"heart-1","technocy-icon-hot-deal":"hot-deal","technocy-icon-kitchen":"kitchen","technocy-icon-laptops":"laptops","technocy-icon-mail-1":"mail-1","technocy-icon-mobile-2":"mobile-2","technocy-icon-mouse":"mouse","technocy-icon-offer":"offer","technocy-icon-payment":"payment","technocy-icon-pen":"pen","technocy-icon-phone-2":"phone-2","technocy-icon-phone":"phone","technocy-icon-quality":"quality","technocy-icon-quote2":"quote2","technocy-icon-refrigerators":"refrigerators","technocy-icon-return-1":"return-1","technocy-icon-return":"return","technocy-icon-search-1":"search-1","technocy-icon-secure":"secure","technocy-icon-smartphone":"smartphone","technocy-icon-support-2":"support-2","technocy-icon-support-phone":"support-phone","technocy-icon-tablet-1":"tablet-1","technocy-icon-tablets":"tablets","technocy-icon-tv":"tv","technocy-icon-twitte-1":"twitte-1","technocy-icon-warranty":"warranty","technocy-icon-washing-machine":"washing-machine","technocy-icon-360":"360","technocy-icon-bars":"bars","technocy-icon-caret-down":"caret-down","technocy-icon-caret-left":"caret-left","technocy-icon-caret-right":"caret-right","technocy-icon-caret-up":"caret-up","technocy-icon-cart-empty":"cart-empty","technocy-icon-check-square":"check-square","technocy-icon-circle":"circle","technocy-icon-cloud-download-alt":"cloud-download-alt","technocy-icon-comment":"comment","technocy-icon-comments":"comments","technocy-icon-contact":"contact","technocy-icon-credit-card":"credit-card","technocy-icon-dot-circle":"dot-circle","technocy-icon-edit":"edit","technocy-icon-envelope":"envelope","technocy-icon-expand-alt":"expand-alt","technocy-icon-external-link-alt":"external-link-alt","technocy-icon-file-alt":"file-alt","technocy-icon-file-archive":"file-archive","technocy-icon-filter":"filter","technocy-icon-folder-open":"folder-open","technocy-icon-folder":"folder","technocy-icon-frown":"frown","technocy-icon-gift":"gift","technocy-icon-grid":"grid","technocy-icon-grip-horizontal":"grip-horizontal","technocy-icon-heart-fill":"heart-fill","technocy-icon-heart":"heart","technocy-icon-history":"history","technocy-icon-home":"home","technocy-icon-info-circle":"info-circle","technocy-icon-instagram":"instagram","technocy-icon-level-up-alt":"level-up-alt","technocy-icon-list":"list","technocy-icon-map-marker-check":"map-marker-check","technocy-icon-meh":"meh","technocy-icon-minus-circle":"minus-circle","technocy-icon-minus":"minus","technocy-icon-mobile-android-alt":"mobile-android-alt","technocy-icon-money-bill":"money-bill","technocy-icon-pencil-alt":"pencil-alt","technocy-icon-play-circle":"play-circle","technocy-icon-play":"play","technocy-icon-plus-circle":"plus-circle","technocy-icon-plus":"plus","technocy-icon-quote":"quote","technocy-icon-random":"random","technocy-icon-reply-all":"reply-all","technocy-icon-reply":"reply","technocy-icon-search-plus":"search-plus","technocy-icon-search":"search","technocy-icon-shield-check":"shield-check","technocy-icon-shopping-basket":"shopping-basket","technocy-icon-shopping-cart":"shopping-cart","technocy-icon-sign-out-alt":"sign-out-alt","technocy-icon-smile":"smile","technocy-icon-spinner":"spinner","technocy-icon-square":"square","technocy-icon-star":"star","technocy-icon-store":"store","technocy-icon-sync":"sync","technocy-icon-tachometer-alt":"tachometer-alt","technocy-icon-th-large":"th-large","technocy-icon-th-list":"th-list","technocy-icon-thumbtack":"thumbtack","technocy-icon-ticket":"ticket","technocy-icon-times-circle":"times-circle","technocy-icon-times":"times","technocy-icon-trophy-alt":"trophy-alt","technocy-icon-truck":"truck","technocy-icon-user-headset":"user-headset","technocy-icon-user-shield":"user-shield","technocy-icon-user":"user","technocy-icon-video":"video","technocy-icon-adobe":"adobe","technocy-icon-amazon":"amazon","technocy-icon-android":"android","technocy-icon-angular":"angular","technocy-icon-apper":"apper","technocy-icon-apple":"apple","technocy-icon-atlassian":"atlassian","technocy-icon-behance":"behance","technocy-icon-bitbucket":"bitbucket","technocy-icon-bitcoin":"bitcoin","technocy-icon-bity":"bity","technocy-icon-bluetooth":"bluetooth","technocy-icon-btc":"btc","technocy-icon-centos":"centos","technocy-icon-chrome":"chrome","technocy-icon-codepen":"codepen","technocy-icon-cpanel":"cpanel","technocy-icon-discord":"discord","technocy-icon-dochub":"dochub","technocy-icon-docker":"docker","technocy-icon-dribbble":"dribbble","technocy-icon-dropbox":"dropbox","technocy-icon-drupal":"drupal","technocy-icon-ebay":"ebay","technocy-icon-facebook":"facebook","technocy-icon-figma":"figma","technocy-icon-firefox":"firefox","technocy-icon-google-plus":"google-plus","technocy-icon-google":"google","technocy-icon-grunt":"grunt","technocy-icon-gulp":"gulp","technocy-icon-html5":"html5","technocy-icon-joomla":"joomla","technocy-icon-link-brand":"link-brand","technocy-icon-linkedin":"linkedin","technocy-icon-mailchimp":"mailchimp","technocy-icon-opencart":"opencart","technocy-icon-paypal":"paypal","technocy-icon-pinterest-p":"pinterest-p","technocy-icon-reddit":"reddit","technocy-icon-skype":"skype","technocy-icon-slack":"slack","technocy-icon-snapchat":"snapchat","technocy-icon-spotify":"spotify","technocy-icon-trello":"trello","technocy-icon-twitter":"twitter","technocy-icon-vimeo":"vimeo","technocy-icon-whatsapp":"whatsapp","technocy-icon-wordpress":"wordpress","technocy-icon-yoast":"yoast","technocy-icon-youtube":"youtube"}', true );
			$icons     = $manager->get_control( 'icon' )->get_settings( 'options' );
			$new_icons = array_merge(
				$new_icons,
				$icons
			);
			// Then we set a new list of icons as the options of the icon control
			$manager->get_control( 'icon' )->set_settings( 'options', $new_icons ); 
        }

        public function add_icons_native($tabs) {
            global $technocy_version;
            $tabs['opal-custom'] = [
                'name'          => 'technocy-icon',
                'label'         => esc_html__('Technocy Icon', 'technocy'),
                'prefix'        => 'technocy-icon-',
                'displayPrefix' => 'technocy-icon-',
                'labelIcon'     => 'fab fa-font-awesome-alt',
                'ver'           => $technocy_version,
                'fetchJson'     => get_theme_file_uri('/inc/elementor/icons.json'),
                'native'        => true,
            ];

            return $tabs;
        }
    }

endif;

return new Technocy_Elementor();
