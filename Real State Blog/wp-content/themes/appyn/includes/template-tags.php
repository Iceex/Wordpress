<?php

if( ! defined( 'ABSPATH' ) ) die ( '✋' );

function px_breadcrumbs() {
    global $post;
    ?>
    <ol id="breadcrumbs">
    <?php 
    $separador = " / ";
    $list_cats = category_parents();
    ?>
    <li><a href="<?php bloginfo('url'); ?>" title="<?php echo bloginfo('title'); ?>">Home</a> <?php echo $separador; ?> </li>
    <?php
    if( !empty($list_cats) ) { 
        foreach($list_cats as $cat) {
            echo "<li>$cat ".(end($list_cats) != $cat ? $separador : '' )."</li>";
        }
        if( $post->post_parent ) {
            echo '<li><a href="'.get_the_permalink( $post->post_parent ).'">'.$separador.''.get_the_title( $post->post_parent ).'</a></li>';
        }
    }
    ?>
</ol>
<?php 
}

function px_botones_sociales() {
    $color_botones_sociales = get_option('appyn_social_single_color');

    $output = '';
    
    $output .= '<ul class="botones_sociales' . ( ($color_botones_sociales == "color") ? ' color' : '' ) .' ">';
    
    if( is_amp_px() ) {
        $output .= '<li><a target="_blank" href="http://www.facebook.com/sharer/sharer.php?u=' . get_the_permalink() . '" class="facebook" rel="noopener"><i class="fa fa-facebook" aria-hidden="true"></i> Facebook</a></li>';

        $output .= '<li><a target="_blank" href="http://www.twitter.com/share?url=' . get_the_title() . ': ' . get_the_permalink() . '" class="twitter" rel="noopener"><i class="fa fa-twitter" aria-hidden="true"></i> Twitter</a></li>';
        
        $output .= '<li><a target="_blank" href="http://pinterest.com/pin/create/button/?url=' . get_the_permalink() . '" class="pinterest" rel="noopener"><i class="fa fa-pinterest" aria-hidden="true"></i> Pinterest</a></li>';
        
        $output .= '<li class="tg"><a href="tg://msg_url?url=' . get_the_permalink() . '" class="telegram" rel="noopener"><i class="fa fa-telegram" aria-hidden="true"></i> Telegram</a></li>';
        
        $output .= '<li class="ws"><a href="whatsapp://send?text=' . urlencode(get_the_title().': '.get_permalink()) . '" data-action="share/whatsapp/share" class="whatsapp" rel="noopener"><i class="fa fa-whatsapp" aria-hidden="true"></i> Whatsapp</a></li>';

    } else {
         $output .= '<li><a href="javascript:void(0)" data-href="http://www.facebook.com/sharer/sharer.php?u=' . get_the_permalink() . '"  data-width="700" data-height="550" class="facebook" rel="noopener"><i class="fa fa-facebook" aria-hidden="true"></i> Facebook</a></li>';

        $output .= '<li><a href="javascript:void(0)" data-href="http://www.twitter.com/share?url=' . get_the_title() . ': ' . get_the_permalink() . '" data-width="645" data-height="573" class="twitter"><i class="fa fa-twitter" aria-hidden="true"></i> Twitter</a></li>';

        $output .= '<li><a href="javascript:void(0)" data-href="http://pinterest.com/pin/create/button/?url=' . get_the_permalink() . '" data-width="770" data-height="573" class="pinterest"><i class="fa fa-pinterest" aria-hidden="true"></i> Pinterest</a></li>';

        $output .= '<li class="tg"><a href="tg://msg_url?url=' . get_the_permalink() . '" class="telegram"><i class="fa fa-telegram" aria-hidden="true"></i> Telegram</a></li>';

        $output .= '<li class="ws"><a href="whatsapp://send?text=' . urlencode(get_the_title().': '.get_permalink()) .'" data-action="share/whatsapp/share" class="whatsapp"><i class="fa fa-whatsapp" aria-hidden="true"></i> Whatsapp</a></li>';
    }
    $output .= '</ul>';

    return $output;
}

function px_header_social() {

    $output = '<ul class="social">';

	$px_social_facebook = px_social('facebook');
    $output .= ( !empty( $px_social_facebook ) ? '<li><a href="'.$px_social_facebook.'" class="facebook" title="Facebook" target="_blank" rel="noopener"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>': $px_social_facebook );
		
	$px_social_twitter = px_social('twitter');
    $output .= ( !empty( $px_social_twitter ) ? '<li><a href="'.$px_social_twitter.'" class="twitter" title="Twitter" target="_blank" rel="noopener"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>': $px_social_twitter );
		
	$px_social_instagram = px_social('instagram');
    $output .= ( !empty( $px_social_instagram ) ? '<li><a href="'.$px_social_instagram.'" class="instagram" title="Instagram" target="_blank" rel="noopener"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>': $px_social_instagram );
		           
	$px_social_youtube = px_social('youtube');
    $output .= ( !empty( $px_social_youtube ) ? '<li><a href="'.$px_social_youtube.'" class="youtube" title="YouTube" target="_blank" rel="noopener"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>': $px_social_youtube );     
		    
	$px_social_pinterest = px_social('pinterest');
    $output .= ( !empty( $px_social_pinterest ) ? '<li><a href="'.$px_social_pinterest.'" class="pinterest" title="Pinterest" target="_blank" rel="noopener"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>': $px_social_pinterest );
    
    $output .= '</ul>';

    return $output;
}