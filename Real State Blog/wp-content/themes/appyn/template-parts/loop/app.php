<?php 
$version = get_datos_info( 'version' ); 
if(!$version) $version = '--'; else $version = $version; ?>
<div class="bloque-app">
	<a href="<?php the_permalink(); ?>">
		<?php echo px_post_thumbnail(); ?>
		<span class="title"><?php the_title(); ?></span>
		<?php echo app_developer(); ?>
		<?php echo app_date(); ?>
        <div class="px-postmeta">
        	<span class="version"><?php echo __( 'Versión', 'appyn' ); ?> <?php echo $version; ?></span>
            <?php show_rating(0); ?>
        </div>
	</a>
</div>