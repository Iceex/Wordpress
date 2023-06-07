<?php $datos_informacion = get_post_meta($post->ID, 'datos_informacion', true); ?>
<li><a href="<?php echo the_permalink(); ?>">
    <div class="bghover"></div>
    <?php echo px_post_thumbnail('miniatura'); ?>
    <div class="s2">
        <span class="title"><?php the_title(); ?></span>
        <?php echo app_developer(); echo app_date();
        show_rating(0); ?>
    </div>
</a></li>