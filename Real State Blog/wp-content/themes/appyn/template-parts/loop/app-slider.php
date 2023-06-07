<?php 
$datos_informacion = get_post_meta($post->ID, 'datos_informacion', true);
$version = (isset($datos_informacion['version'])) ? $datos_informacion['version'] : '';
?>
<div class="bloque-app-second">
    <a href="<?php the_permalink(); ?>" aria-label="<?php the_title(); ?>"></a>
    <?php echo px_post_thumbnail('miniatura'); ?>
    <div class="bap-c">
        <div class="title"><?php the_title(); ?></div>
        <?php echo app_developer(); ?>
        <?php echo app_date(); ?>
        <div class="px-postmeta">
            <span class="version"><?php echo __( 'Versión', 'appyn' ); ?> <?php if(!$version) echo '--'; else echo $version; ?></span>
            <?php show_rating(0); ?>
        </div>
    </div>
</div>