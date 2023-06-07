<?php

class Technocy_Merlin_Config {

	private $wizard;

	public function __construct() {
		$this->init();
		add_filter( 'merlin_import_files', [ $this, 'import_files' ] );
		add_action( 'merlin_after_all_import', [ $this, 'after_import_setup' ], 10, 1 );
		add_filter( 'merlin_generate_child_functions_php', [ $this, 'render_child_functions_php' ] );

		add_action( 'import_start', function () {
			add_filter( 'wxr_importer.pre_process.post_meta', [ $this, 'fiximport_elementor' ], 10, 1 );
		} );
	}

	public function fiximport_elementor( $post_meta ) {
		if ( '_elementor_data' === $post_meta['key'] ) {
			$post_meta['value'] = wp_slash( $post_meta['value'] );
		}

		return $post_meta;
	}

	public function import_files(){
            return array(
            array(
                'import_file_name'           => 'home 1',
                'home'                       => 'home-1',
                'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
                'homepage'                   => get_theme_file_path('/dummy-data/homepage/home-1.xml'),
                'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
                'import_rev_slider_file_url' => 'http://source.wpopal.com/technocy/dummy_data/revsliders/home-1/slider-1.zip',
                'import_more_revslider_file_url' => [],
                'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_1.jpg'),
                'preview_url'                => 'https://demo2.pavothemes.com/technocy/home-1',
                'themeoptions'               => '{}',
            ),

            array(
                'import_file_name'           => 'home 2',
                'home'                       => 'home-2',
                'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
                'homepage'                   => get_theme_file_path('/dummy-data/homepage/home-2.xml'),
                'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
                'import_rev_slider_file_url' => 'http://source.wpopal.com/technocy/dummy_data/revsliders/home-2/slider-2.zip',
                'import_more_revslider_file_url' => [],
                'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_2.jpg'),
                'preview_url'                => 'https://demo2.pavothemes.com/technocy/home-2',
                'themeoptions'               => '{}',
            ),

            array(
                'import_file_name'           => 'home 3',
                'home'                       => 'home-3',
                'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
                'homepage'                   => get_theme_file_path('/dummy-data/homepage/home-3.xml'),
                'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
                'import_rev_slider_file_url' => 'http://source.wpopal.com/technocy/dummy_data/revsliders/home-3/Slider-3.zip',
                'import_more_revslider_file_url' => [],
                'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_3.jpg'),
                'preview_url'                => 'https://demo2.pavothemes.com/technocy/home-3',
                'themeoptions'               => '{}',
            ),

            array(
                'import_file_name'           => 'home 4',
                'home'                       => 'home-4',
                'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
                'homepage'                   => get_theme_file_path('/dummy-data/homepage/home-4.xml'),
                'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
                'import_rev_slider_file_url' => 'http://source.wpopal.com/technocy/dummy_data/revsliders/home-4/slider-2.zip',
                'import_more_revslider_file_url' => [],
                'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_4.jpg'),
                'preview_url'                => 'https://demo2.pavothemes.com/technocy/home-4',
                'themeoptions'               => '{}',
            ),

            array(
                'import_file_name'           => 'home 5',
                'home'                       => 'home-5',
                'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
                'homepage'                   => get_theme_file_path('/dummy-data/homepage/home-5.xml'),
                'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
                'import_rev_slider_file_url' => 'http://source.wpopal.com/technocy/dummy_data/revsliders/home-5/slider-4.zip',
                'import_more_revslider_file_url' => [],
                'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_5.jpg'),
                'preview_url'                => 'https://demo2.pavothemes.com/technocy/home-5',
                'themeoptions'               => '{}',
            ),

            array(
                'import_file_name'           => 'home 6',
                'home'                       => 'home-6',
                'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
                'homepage'                   => get_theme_file_path('/dummy-data/homepage/home-6.xml'),
                'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
                'import_rev_slider_file_url' => 'http://source.wpopal.com/technocy/dummy_data/revsliders/home-6/slider-2.zip',
                'import_more_revslider_file_url' => [],
                'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_6.jpg'),
                'preview_url'                => 'https://demo2.pavothemes.com/technocy/home-6',
                'themeoptions'               => '{}',
            ),

            array(
                'import_file_name'           => 'home 7',
                'home'                       => 'home-7',
                'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
                'homepage'                   => get_theme_file_path('/dummy-data/homepage/home-7.xml'),
                'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
                'import_rev_slider_file_url' => 'http://source.wpopal.com/technocy/dummy_data/revsliders/home-7/slider-home7.zip',
                'import_more_revslider_file_url' => [],
                'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_7.jpg'),
                'preview_url'                => 'https://demo2.pavothemes.com/technocy/home-7',
                'themeoptions'               => '{}',
            ),

            array(
                'import_file_name'           => 'home 8',
                'home'                       => 'home-8',
                'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
                'homepage'                   => get_theme_file_path('/dummy-data/homepage/home-8.xml'),
                'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
                'import_rev_slider_file_url' => 'http://source.wpopal.com/technocy/dummy_data/revsliders/home-8/slider-home8.zip',
                'import_more_revslider_file_url' => [],
                'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_8.jpg'),
                'preview_url'                => 'https://demo2.pavothemes.com/technocy/home-8',
                'themeoptions'               => '{}',
            ),

            array(
                'import_file_name'           => 'home 9',
                'home'                       => 'home-9',
                'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
                'homepage'                   => get_theme_file_path('/dummy-data/homepage/home-9.xml'),
                'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
                'import_rev_slider_file_url' => 'http://source.wpopal.com/technocy/dummy_data/revsliders/home-9/slider-home7.zip',
                'import_more_revslider_file_url' => [],
                'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_9.jpg'),
                'preview_url'                => 'https://demo2.pavothemes.com/technocy/home-9',
                'themeoptions'               => '{}',
            ),

            array(
                'import_file_name'           => 'home 10',
                'home'                       => 'home-10',
                'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
                'homepage'                   => get_theme_file_path('/dummy-data/homepage/home-10.xml'),
                'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
                'import_rev_slider_file_url' => 'http://source.wpopal.com/technocy/dummy_data/revsliders/home-10/slider-home10.zip',
                'import_more_revslider_file_url' => [],
                'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_10.jpg'),
                'preview_url'                => 'https://demo2.pavothemes.com/technocy/home-10',
                'themeoptions'               => '{}',
            ),
            );           
        }

	public function after_import_setup( $selected_import ) {
		$selected_import = ( $this->import_files() )[ $selected_import ];
		$check_oneclick  = get_option( 'technocy_check_oneclick', [] );

		$this->set_demo_menus();

		if ( ! isset( $check_oneclick[ $selected_import['home'] ] ) ) {
			$this->wizard->importer->import( get_parent_theme_file_path( 'dummy-data/homepage/' . $selected_import['home'] . '.xml' ) );
			$check_oneclick[ $selected_import['home'] ] = true;
		}

		// setup Home page
		$home = get_page_by_path( $selected_import['home'] );
		if ( $home ) {
			update_option( 'show_on_front', 'page' );
			update_option( 'page_on_front', $home->ID );
		}

		// Setup Options
		$options = $this->get_all_options();

		// Elementor
		if ( ! isset( $check_oneclick['elementor-options'] ) ) {
			$active_kit_id = Elementor\Plugin::$instance->kits_manager->get_active_id();
			update_post_meta( $active_kit_id, '_elementor_page_settings', $options['elementor'] );
			$check_oneclick['elementor-options'] = true;
		}

		// Options
		$theme_options = $options['options'];
		foreach ( $theme_options as $key => $option ) {
			update_option( $key, $option );
		}

		//Mailchimp
		if ( ! isset( $check_oneclick['mailchip'] ) ) {
			$mailchimp = $this->get_mailchimp_id();
			if ( $mailchimp ) {
				update_option( 'mc4wp_default_form_id', $mailchimp );
			}
			$check_oneclick['mailchip'] = true;
		}

		// Header Footer Builder
		$this->reset_header_footer();
		$this->set_hf( $selected_import['home'] );

		// WooCommerce
		if ( ! isset( $check_oneclick['woocommerce'] ) ) {
			update_option( 'woocommerce_single_image_width', 800 );
			update_option( 'woocommerce_thumbnail_image_width', 450 );
			update_option( 'woocommerce_thumbnail_cropping', 'uncropped' );
			$check_oneclick['woocommerce'] = true;
		}

		if ( ! isset( $check_oneclick['logo'] ) ) {
			set_theme_mod( 'custom_logo', $this->get_attachment( '_logo' ) );
			$check_oneclick['logo'] = true;
		}

		update_option( 'technocy_check_oneclick', $check_oneclick );

		\Elementor\Plugin::instance()->files_manager->clear_cache();

        update_option( 'woosc_quick_table_enable', 'no' );
	}

	private function get_mailchimp_id() {
		$params = array(
			'post_type'      => 'mc4wp-form',
			'posts_per_page' => 1,
		);
		$post   = get_posts( $params );

		return isset( $post[0] ) ? $post[0]->ID : 0;
	}

	private function get_attachment( $key ) {
		$params = array(
			'post_type'      => 'attachment',
			'post_status'    => 'inherit',
			'posts_per_page' => 1,
			'meta_key'       => $key,
		);
		$post   = get_posts( $params );
		if ( $post ) {
			return $post[0]->ID;
		}

		return 0;
	}

	private function init() {
		$this->wizard = new Merlin(
			$config = array(
				// Location / directory where Merlin WP is placed in your theme.
				'merlin_url'         => 'merlin',
				// The wp-admin page slug where Merlin WP loads.
				'parent_slug'        => 'themes.php',
				// The wp-admin parent page slug for the admin menu item.
				'capability'         => 'manage_options',
				// The capability required for this menu to be displayed to the user.
				'dev_mode'           => true,
				// Enable development mode for testing.
				'license_step'       => false,
				// EDD license activation step.
				'license_required'   => false,
				// Require the license activation step.
				'license_help_url'   => '',
				'directory'          => '/inc/merlin',
				// URL for the 'license-tooltip'.
				'edd_remote_api_url' => '',
				// EDD_Theme_Updater_Admin remote_api_url.
				'edd_item_name'      => '',
				// EDD_Theme_Updater_Admin item_name.
				'edd_theme_slug'     => '',
				// EDD_Theme_Updater_Admin item_slug.
			),
			$strings = array(
				'admin-menu'          => esc_html__( 'Theme Setup', 'technocy' ),

				/* translators: 1: Title Tag 2: Theme Name 3: Closing Title Tag */
				'title%s%s%s%s'       => esc_html__( '%1$s%2$s Themes &lsaquo; Theme Setup: %3$s%4$s', 'technocy' ),
				'return-to-dashboard' => esc_html__( 'Return to the dashboard', 'technocy' ),
				'ignore'              => esc_html__( 'Disable this wizard', 'technocy' ),

				'btn-skip'                 => esc_html__( 'Skip', 'technocy' ),
				'btn-next'                 => esc_html__( 'Next', 'technocy' ),
				'btn-start'                => esc_html__( 'Start', 'technocy' ),
				'btn-no'                   => esc_html__( 'Cancel', 'technocy' ),
				'btn-plugins-install'      => esc_html__( 'Install', 'technocy' ),
				'btn-child-install'        => esc_html__( 'Install', 'technocy' ),
				'btn-content-install'      => esc_html__( 'Install', 'technocy' ),
				'btn-import'               => esc_html__( 'Import', 'technocy' ),
				'btn-license-activate'     => esc_html__( 'Activate', 'technocy' ),
				'btn-license-skip'         => esc_html__( 'Later', 'technocy' ),

				/* translators: Theme Name */
				'license-header%s'         => esc_html__( 'Activate %s', 'technocy' ),
				/* translators: Theme Name */
				'license-header-success%s' => esc_html__( '%s is Activated', 'technocy' ),
				/* translators: Theme Name */
				'license%s'                => esc_html__( 'Enter your license key to enable remote updates and theme support.', 'technocy' ),
				'license-label'            => esc_html__( 'License key', 'technocy' ),
				'license-success%s'        => esc_html__( 'The theme is already registered, so you can go to the next step!', 'technocy' ),
				'license-json-success%s'   => esc_html__( 'Your theme is activated! Remote updates and theme support are enabled.', 'technocy' ),
				'license-tooltip'          => esc_html__( 'Need help?', 'technocy' ),

				/* translators: Theme Name */
				'welcome-header%s'         => esc_html__( 'Welcome to %s', 'technocy' ),
				'welcome-header-success%s' => esc_html__( 'Hi. Welcome back', 'technocy' ),
				'welcome%s'                => esc_html__( 'This wizard will set up your theme, install plugins, and import content. It is optional & should take only a few minutes.', 'technocy' ),
				'welcome-success%s'        => esc_html__( 'You may have already run this theme setup wizard. If you would like to proceed anyway, click on the "Start" button below.', 'technocy' ),

				'child-header'         => esc_html__( 'Install Child Theme', 'technocy' ),
				'child-header-success' => esc_html__( 'You\'re good to go!', 'technocy' ),
				'child'                => esc_html__( 'Let\'s build & activate a child theme so you may easily make theme changes.', 'technocy' ),
				'child-success%s'      => esc_html__( 'Your child theme has already been installed and is now activated, if it wasn\'t already.', 'technocy' ),
				'child-action-link'    => esc_html__( 'Learn about child themes', 'technocy' ),
				'child-json-success%s' => esc_html__( 'Awesome. Your child theme has already been installed and is now activated.', 'technocy' ),
				'child-json-already%s' => esc_html__( 'Awesome. Your child theme has been created and is now activated.', 'technocy' ),

				'plugins-header'         => esc_html__( 'Install Plugins', 'technocy' ),
				'plugins-header-success' => esc_html__( 'You\'re up to speed!', 'technocy' ),
				'plugins'                => esc_html__( 'Let\'s install some essential WordPress plugins to get your site up to speed.', 'technocy' ),
				'plugins-success%s'      => esc_html__( 'The required WordPress plugins are all installed and up to date. Press "Next" to continue the setup wizard.', 'technocy' ),
				'plugins-action-link'    => esc_html__( 'Advanced', 'technocy' ),

				'import-header'      => esc_html__( 'Import Content', 'technocy' ),
				'import'             => esc_html__( 'Let\'s import content to your website, to help you get familiar with the theme.', 'technocy' ),
				'import-action-link' => esc_html__( 'Advanced', 'technocy' ),

				'ready-header'      => esc_html__( 'All done. Have fun!', 'technocy' ),

				/* translators: Theme Author */
				'ready%s'           => esc_html__( 'Your theme has been all set up. Enjoy your new theme by %s.', 'technocy' ),
				'ready-action-link' => esc_html__( 'Extras', 'technocy' ),
				'ready-big-button'  => esc_html__( 'View your website', 'technocy' ),
				'ready-link-1'      => sprintf( '<a href="%1$s" target="_blank">%2$s</a>', 'https://wordpress.org/support/', esc_html__( 'Explore WordPress', 'technocy' ) ),
				'ready-link-2'      => sprintf( '<a href="%1$s" target="_blank">%2$s</a>', 'https://themebeans.com/contact/', esc_html__( 'Get Theme Support', 'technocy' ) ),
				'ready-link-3'      => sprintf( '<a href="%1$s">%2$s</a>', admin_url( 'customize.php' ), esc_html__( 'Start Customizing', 'technocy' ) ),
			)
		);
		if ( technocy_is_elementor_activated() ) {

			add_action( 'widgets_init', [ $this, 'widgets_init' ] );

		}
	}

	public function widgets_init() {
		require_once get_parent_theme_file_path( '/inc/merlin/includes/recent-post.php' );
		register_widget( 'Technocy_WP_Widget_Recent_Posts' );
		if ( technocy_is_woocommerce_activated() ) {
			require_once get_parent_theme_file_path( '/inc/merlin/includes/class-wc-widget-layered-nav.php' );
			register_widget( 'Technocy_Widget_Layered_Nav' );
		}
	}

	private function get_all_header_footer() {
		return [
			'home-1'  => [
				'header' => [
					[
						'slug'                         => 'header-1',
						'ehf_target_include_locations' => [ 'rule' => [ 'basic-global' ], 'specific' => [] ],
					]
				],
				'footer' => [
					[
						'slug'                         => 'footer-5',
						'ehf_target_include_locations' => [ 'rule' => [ 'basic-global' ], 'specific' => [] ],
					]
				]
			],
			'home-2'  => [
				'header' => [
					[
						'slug'                         => 'header-2',
						'ehf_target_include_locations' => [ 'rule' => [ 'basic-global' ], 'specific' => [] ],
					]
				],
				'footer' => [
					[
						'slug'                         => 'footer-2',
						'ehf_target_include_locations' => [ 'rule' => [ 'basic-global' ], 'specific' => [] ],
					]
				]
			],
			'home-3'  => [
				'header' => [
					[
						'slug'                         => 'header-3',
						'ehf_target_include_locations' => [ 'rule' => [ 'basic-global' ], 'specific' => [] ],
					]
				],
				'footer' => [
					[
						'slug'                         => 'footer-3',
						'ehf_target_include_locations' => [ 'rule' => [ 'basic-global' ], 'specific' => [] ],
					]
				]
			],
			'home-4'  => [
				'header' => [
					[
						'slug'                         => 'header-1',
						'ehf_target_include_locations' => [ 'rule' => [ 'basic-global' ], 'specific' => [] ],
					]
				],
				'footer' => [
					[
						'slug'                         => 'footer-4',
						'ehf_target_include_locations' => [ 'rule' => [ 'basic-global' ], 'specific' => [] ],
					]
				]
			],
			'home-5'  => [
				'header' => [
					[
						'slug'                         => 'header-1',
						'ehf_target_include_locations' => [ 'rule' => [ 'basic-global' ], 'specific' => [] ],
					]
				],
				'footer' => [
					[
						'slug'                         => 'footer-5',
						'ehf_target_include_locations' => [ 'rule' => [ 'basic-global' ], 'specific' => [] ],
					]
				]
			],
			'home-6'  => [
				'header' => [
					[
						'slug'                         => 'header-1',
						'ehf_target_include_locations' => [ 'rule' => [ 'basic-global' ], 'specific' => [] ],
					]
				],
				'footer' => [
					[
						'slug'                         => 'footer-5',
						'ehf_target_include_locations' => [ 'rule' => [ 'basic-global' ], 'specific' => [] ],
					]
				]
			],
            'home-7'  => [
                'header' => [
                    [
                        'slug'                         => 'header-2',
                        'ehf_target_include_locations' => [ 'rule' => [ 'basic-global' ], 'specific' => [] ],
                    ]
                ],
                'footer' => [
                    [
                        'slug'                         => 'footer-2',
                        'ehf_target_include_locations' => [ 'rule' => [ 'basic-global' ], 'specific' => [] ],
                    ]
                ]
            ],
            'home-8'  => [
                'header' => [
                    [
                        'slug'                         => 'header-4',
                        'ehf_target_include_locations' => [ 'rule' => [ 'basic-global' ], 'specific' => [] ],
                    ]
                ],
                'footer' => [
                    [
                        'slug'                         => 'footer-7',
                        'ehf_target_include_locations' => [ 'rule' => [ 'basic-global' ], 'specific' => [] ],
                    ]
                ]
            ],
            'home-9'  => [
                'header' => [
                    [
                        'slug'                         => 'header-1',
                        'ehf_target_include_locations' => [ 'rule' => [ 'basic-global' ], 'specific' => [] ],
                    ]
                ],
                'footer' => [
                    [
                        'slug'                         => 'footer-3',
                        'ehf_target_include_locations' => [ 'rule' => [ 'basic-global' ], 'specific' => [] ],
                    ]
                ]
            ],
            'home-10'  => [
                'header' => [
                    [
                        'slug'                         => 'header-1',
                        'ehf_target_include_locations' => [ 'rule' => [ 'basic-global' ], 'specific' => [] ],
                    ]
                ],
                'footer' => [
                    [
                        'slug'                         => 'footer-6',
                        'ehf_target_include_locations' => [ 'rule' => [ 'basic-global' ], 'specific' => [] ],
                    ]
                ]
            ],
		];
	}

	private function reset_header_footer() {
		$footer_args = array(
			'post_type'      => 'elementor-hf',
			'posts_per_page' => - 1,
			'meta_query'     => array(
				array(
					'key'     => 'ehf_template_type',
					'compare' => 'IN',
					'value'   => [ 'type_footer', 'type_header' ]
				),
			)
		);
		$footer      = new WP_Query( $footer_args );
		while ( $footer->have_posts() ) : $footer->the_post();
			update_post_meta( get_the_ID(), 'ehf_target_include_locations', [] );
			update_post_meta( get_the_ID(), 'ehf_target_exclude_locations', [] );
		endwhile;
		wp_reset_postdata();
	}

	public function set_demo_menus() {
		$main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );

		set_theme_mod(
			'nav_menu_locations',
			array(
				'primary'  => $main_menu->term_id,
				'handheld' => $main_menu->term_id,
			)
		);
	}

	private function set_hf( $home ) {
		$all_hf = $this->get_all_header_footer();
		$datas  = $all_hf[ $home ];
		foreach ( $datas as $item ) {
			foreach ( $item as $object ) {
				$hf = get_page_by_path( $object['slug'], OBJECT, 'elementor-hf' );
				if ( $hf ) {
					update_post_meta( $hf->ID, 'ehf_target_include_locations', $object['ehf_target_include_locations'] );
					if ( isset( $object['ehf_target_exclude_locations'] ) ) {
						update_post_meta( $hf->ID, 'ehf_target_exclude_locations', $object['ehf_target_exclude_locations'] );
					}
				}
			}
		}
	}

	public function render_child_functions_php() {
		$output
			= "<?php
/**
 * Theme functions and definitions.
 */
		 ";

		return $output;
	}

	public function get_all_options(){
        $options = [];
        $options['options']   = json_decode('{"technocy_options_blog_style":"standard","technocy_options_single_product_gallery_layout":"horizontal"}', true);
        $options['elementor']   = json_decode('{"system_colors":[{"_id":"primary","title":"Primary","color":"#F02757"},{"_id":"primary_hover","title":"Primary Hover","color":"#ea1044"},{"_id":"text","title":"Text","color":"#666666"},{"_id":"accent","title":"Heading","color":"#000000"},{"_id":"lighter","title":"Lighter","color":"#999999"},{"_id":"border","title":"Border","color":"#E4E4E4"}],"custom_colors":[],"system_typography":[{"_id":"heading_title","title":"Heading Title","typography_typography":"custom","typography_font_family":"Poppins","typography_font_weight":"700","typography_font_size":{"unit":"px","size":24,"sizes":[]},"typography_line_height":{"unit":"px","size":30,"sizes":[]}},{"_id":"heading_sub","title":"Heading Sub","typography_typography":"custom","typography_font_family":"Poppins","typography_font_weight":"500","typography_text_transform":"uppercase","typography_font_size":{"unit":"px","size":12,"sizes":[]},"typography_line_height":{"unit":"px","size":14,"sizes":[]}},{"_id":"heading_footer","title":"heading Footer","typography_typography":"custom","typography_font_family":"Poppins","typography_font_weight":"500","typography_text_transform":"uppercase","typography_font_size":{"unit":"px","size":16,"sizes":[]},"typography_line_height":{"unit":"px","size":18,"sizes":[]}}],"custom_typography":[],"default_generic_fonts":"Sans-serif","site_name":"Technocy","site_description":"Multi-store WooCommerce Theme","page_title_selector":"h1.entry-title","activeItemIndex":1,"container_width":{"unit":"px","size":1190,"sizes":[]},"space_between_widgets":{"unit":"px","size":10,"sizes":[]},"viewport_md":768,"viewport_lg":1025,"active_breakpoints":["viewport_mobile","viewport_mobile_extra","viewport_tablet","viewport_tablet_extra","viewport_laptop"]}', true);
        return $options;
    } // end get_all_options
}

return new Technocy_Merlin_Config();
