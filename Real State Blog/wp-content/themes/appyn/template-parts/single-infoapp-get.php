<?php 
$get_download = get_query_var( 'download' );
$get_opt = get_query_var( 'opt' );
$adl = get_option( 'appyn_download_links', null );
$version = get_datos_info( 'version' );
?>
<div class="right s2">
    <?php px_breadcrumbs(); ?>
    <?php echo single_info_title( $version ); ?>
    <div class="clear"></div>
    <?php 
    $a = get_option("appyn_download_timer");
    $download_timer = ( isset($a) ) ? get_option( "appyn_download_timer" ) : 5;

    switch( $get_download ) { 	
        case "redirect" :
            echo ads('ads_download_1');
            $get_dl 	= get_query_var( 'download' ) ? get_query_var( 'download' ) : 0;
            if( $adl == 2 && !$get_opt ) {
                echo '<div class="bx-download">
                    <div class="bxt">'.__( 'Enlace de descarga', 'appyn' ).'</div>
                    <ul id="list-downloadlinks">
                        <li><a href="'.add_query_arg('opt', 1, remove_query_arg('amp') ).'" class="downloadAPK dapk_b"><i class="fa fa-download"></i>'.__( 'Descargar', 'appyn' ).'</a></li>
                    </ul>
                </div>';
            } 
            if( ($adl == 2 && $get_opt == 1) || ($adl == 1 && !$get_opt) ) {
                $datos_download = get_datos_download();
                if( !isset( $datos_download['direct-link'] ) ) {
                    echo '<p>'.__( 'No hay enlace de redirección...', 'appyn' ).'</p>';
                } else {
                    echo '<div class="bx-download">
                    <div class="bxt">'.__( 'Será redireccionado en unos segundos...', 'appyn' ).'</div>
                    <p>'.__( 'Si la redirección no funciona, haga clic', 'appyn' ).' <a href="'.((strlen($datos_download['direct-link'])>0) ? $datos_download['direct-link'] : 'javascript:alert_download()').'" rel="nofollow">'.__( 'aquí', 'appyn' ).'</a>.</p>
                </div>'; 
                echo px_info_install();
                }
            }
            echo ads('ads_download_2');
        break;

        default :
            echo ads('ads_download_1');
            echo '<div class="bx-download">';

            do_action( 'list_download_links' );

            echo '</div>';
            echo ads('ads_download_2');
        break;
    }
    ?>
</div>
<div class="left s1">
    <?php echo px_post_thumbnail( 'thumbnail', $post, true ); ?>   
    <?php show_rating(); ?>
    <?php if( !is_amp_px() ) { ?>
    <div class="link-report"><a href="javascript:void(0)"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> <?php echo __( 'Reportar', 'appyn' ); ?></a></div>
    <?php } ?>
</div>