<div class="right s2">
    <?php px_breadcrumbs(); ?>
    <?php 
    $version = get_datos_info( 'version' );
    $descripcion = get_datos_info( 'descripcion' );
    $consiguelo = get_datos_info( 'consiguelo' );
    
    echo single_info_title( $version ); ?>
    
    <div class="clear"></div>

    <div class="meta-cats"><?php echo px_pay_app(); ?><?php the_category(); ?></div>

    <?php echo (!empty($descripcion)) ? '<div class="descripcion">'.$descripcion.'</div>' : ''; ?>
</div>
<div class="left s1">
    <?php 
    echo px_post_thumbnail('thumbnail', $post, true);
    $lbda = link_button_download_apk();
    if( $lbda ) {
        if( isset($consiguelo) ) {
            if( strpos($consiguelo, 'microsoft.com') !== false || empty($consiguelo)) {
                echo '<a href="'.$lbda.'" class="downloadAPK" rel="nofollow" title="'. __( 'Descargar', 'appyn' ).'"'.((is_amp_px()) ? ' on="tap:download.scrollTo(duration=400)"' : '').'><i class="fa fa-download"></i> '. __( 'Descargar', 'appyn' ).'</a>';
            } else {
                $gte = appyn_options( 'general_text_edit', true );
                $text = ( !empty($gte['bda'] ) ) ? __( $gte['bda'], 'appyn' ) : __( 'Descargar APK', 'appyn' );
                echo '<a href="'.$lbda.'" class="downloadAPK" rel="nofollow" title="'.$text.'"'.((is_amp_px()) ? ' on="tap:download.scrollTo(duration=400)"' : '').'><i class="fa fa-download"></i> '.$text.'</a>';
            }
        }

        if( $post->post_parent ) {
            echo '<a href="'.get_permalink( $post->post_parent ).'" class="downloadAPK danv" rel="nofollow" title="'. __('Última versión', 'appyn').'"'.((is_amp_px()) ? ' on="tap:download.scrollTo(duration=400)"' : '').'><i class="fa fa-refresh" aria-hidden="true"></i> '. __('Última versión', 'appyn').'</a>';
        }
    } 
    ?>

    <?php show_rating(); ?>

    <?php if( ! is_amp_px() ) { ?>
    <div class="link-report"><a href="javascript:void(0)"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> <?php echo __( 'Reportar', 'appyn' ); ?></a></div>
    <?php } ?>
</div>
<div class="right s2">
    <div class="box-data-app">
        <div class="left data-app">
            <?php echo do_action( 'px_data_app_single' ); ?>
        </div>
    </div>
</div>