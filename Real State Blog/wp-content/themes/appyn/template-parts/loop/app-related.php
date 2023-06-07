<?php $datos_informacion = get_post_meta($post->ID, 'datos_informacion', true); ?>
<div class="bloque-app">
	<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
		<?php echo px_post_thumbnail(); ?>
        <span class="title"><?php the_title(); ?></span>
        <?php echo app_developer(); ?>
        <?php echo app_date(); ?>
	</a>
</div>