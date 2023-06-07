<!doctype html>
<html <?php language_attributes(); ?> class="no-js" amp="">
<head>
<?php do_action( 'px_amp_template_head'); ?>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge">	
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="canonical" href="<?php echo get_bloginfo('url').strtok($_SERVER['REQUEST_URI'], '?'); ?>">
<style amp-custom>
	<?php
	ob_start();
	include (__DIR__."/style.min.css");
	$css = ob_get_clean();
	$css = str_replace(array("\n", "\t"), '', $css);
	$re = '/(\/\*.*?\*\/)|(\!important)|(  )|(@charset "utf-8";)/m';
	$result = preg_replace($re, "", str_replace("fonts/", get_template_directory_uri()."/fonts/", 
	str_replace("images/", get_template_directory_uri()."/images/", $css)));
	echo $result;
	?><?php add_color_theme();?>
</style>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
<style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
<script async src="https://cdn.ampproject.org/v0.js"></script>
<script async custom-element="amp-form" src="https://cdn.ampproject.org/v0/amp-form-0.1.js"></script>
<script async custom-element="amp-iframe" src="https://cdn.ampproject.org/v0/amp-iframe-0.1.js"></script>
<script async custom-element="amp-sidebar" src="https://cdn.ampproject.org/v0/amp-sidebar-0.1.js"></script>
<script async custom-element="amp-carousel" src="https://cdn.ampproject.org/v0/amp-carousel-0.1.js"></script>
<script async custom-element="amp-youtube" src="https://cdn.ampproject.org/v0/amp-youtube-0.1.js"></script>
<?php 
if( appyn_options( 'analytics_amp', true ) ) {
	echo '<script async custom-element="amp-analytics" src="https://cdn.ampproject.org/v0/amp-analytics-0.1.js"></script>';
}
$favicon = get_option( 'appyn_favicon' );
$favicon = ( !empty($favicon) ) ? $favicon: get_bloginfo('template_url').'/images/favicon.ico';
echo '<link rel="shortcut icon" href="'.$favicon.'">
';
$logo = get_option('appyn_logo');
$logo = ( !empty($logo) ) ? $logo: get_bloginfo('template_url').'/images/logo.png';

px_data_structure();

$header_codigos_amp = stripslashes(get_option('appyn_header_codigos_amp'));
echo $header_codigos_amp;
?>
</head>
<body <?php body_class(); ?>>
<?php
$body_codigos_amp = stripslashes(get_option('appyn_body_codigos_amp'));
echo $body_codigos_amp;
if( appyn_options( 'analytics_amp', true ) ) {
	echo '<amp-analytics type="googleanalytics">
	<script type="application/json">
	{
		"vars": {
			"account": "'.appyn_options( 'analytics_amp' ).'"
		},
		"triggers": {
			"trackPageview": {
				"on": "visible",
				"request": "pageview"
			}
		}
	}
	</script>
	</amp-analytics>
';
}
?>
	<amp-sidebar id="sidebar1" layout="nodisplay" <?php echo ( is_rtl() ) ? 'side="left"' : 'side="right"'; ?>>
		<div role="button" aria-label="close sidebar" on="tap:sidebar1.toggle" tabindex="0" class="close-sidebar">✕</div>
			<?php wp_nav_menu(array('theme_location' => 'menu', 'show_home' => true, 'container' => '') ); ?>
	</amp-sidebar>
	<div class="wrapper-page">
		<div class="wrapper-inside">
		<header id="header">
			<div class="container">
				<div class="logo">
					<a href="<?php bloginfo('url'); ?>"><?php echo px_amp_logo( $logo ); ?></a>
				</div>
				<div role="button" on="tap:sidebar1.toggle" tabindex="0" class="hamburger"><i class="fa fa-bars" aria-hidden="true"></i></div>
			</div>
		</header>
		<?php
		if( !is_404() ): ?>
		<div id="subheader" class="np">
			<div class="container">
				<div id="searchBox">
					<form action="<?php bloginfo('url'); ?>" method="get" target="_top">
						<input type="text" name="s" placeholder="<?php echo __( 'Buscar una aplicación', 'appyn' )
; ?>" required autocomplete="off" id="sbinput" aria-label="Search">
						<button type="submit" aria-label="Search"><i class="fa fa-search" aria-hidden="true"></i></button>
					</form>
					<ul></ul>
				</div>
				<?php echo px_header_social(); ?>
			</div>
		</div>
		<?php endif; 
		echo ads("ads_header"); ?> 
		<main id="main-site">