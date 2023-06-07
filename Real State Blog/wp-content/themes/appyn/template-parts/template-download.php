<?php get_header( 'default', array('ws' => true) ); 
global $post;
$inf = get_post_meta( $post->ID, 'datos_informacion', true );
$a = get_option("appyn_download_timer");
$download_timer = ( isset($a) ) ? get_option( "appyn_download_timer" ) : 5;
?>
<div class="pxtd">
    <div class="container">
        <h3><?php the_title(); ?> <i class="fa fa-check-circle"></i></h3>
        <?php echo ads('ads_download_u_1'); ?>
        <table class="table">
            <tbody>
                <tr>
                    <td><b><?php echo __( 'Nombre del paquete', 'appyn' ) ; ?></b></td>
                    <td><?php the_title(); ?></td>
                </tr>
                <tr>
                    <td><b><?php echo __( 'Versión', 'appyn' ) ; ?></b></td>
                    <td><?php echo $inf['version']; ?></td>
                </tr>
                <tr>
                    <td><b><?php echo __( 'Tamaño', 'appyn' ) ; ?></b></td>
                    <td><?php echo $inf['tamano']; ?></td>
                </tr>
                <tr>
                    <td><b><?php echo __( 'Requerimientos', 'appyn' ) ; ?></b></td>
                    <td><?php echo $inf['requerimientos']; ?></td>
                </tr>
            </tbody>
        </table>
        <?php echo ads('ads_download_u_2'); ?>
        <div class="pxtdld">
            <?php 
            $get_download = get_query_var( 'download' );
            switch( $get_download ) { 	
                case "redirect" :
                    $datos_download = get_datos_download();
                    if( !isset( $datos_download['direct-link'] ) ) {
                        echo '<p>'.__( 'No hay enlace de redirección...', 'appyn' ).'</p>';
                    } else {
                        echo '<div class="bx-download">
                        <div class="bxt">'.__( 'Será redireccionado en unos segundos...', 'appyn' ).'</div>
                        <p>'.__( 'Si la redirección no funciona, haga clic', 'appyn' ).' <a href="'.((strlen($datos_download['direct-link'])>0) ? $datos_download['direct-link'] : 'javascript:alert_download()').'" rel="nofollow">'.__( 'aquí', 'appyn' ).'</a>.</p>
                    </div>'; 
                    }
                    echo px_info_install();
                break;

                default :
                    do_action( 'list_download_links' );
                break;
            }
            ?>
        </div>
        <?php echo ads('ads_download_u_3'); ?>
    </div>
</div>
<?php get_footer('default'); ?>
