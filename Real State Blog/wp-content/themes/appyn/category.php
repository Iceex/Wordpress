<?php get_header(); ?>
	<div class="container">
        <div class="section">
            <div class="title-section">
                <?php
                $cat = get_queried_object();
				$px_cat_icon = get_term_meta( $cat->term_id, "px_cat_icon", true );
				$ico = ( $px_cat_icon ) ? '<span class="icop '.$px_cat_icon.'"></span>' : '';
			    echo $ico; 
                ?>
                <span><?php echo single_cat_title("", false); ?></span>
            </div>
            <div class="ct_description"><?php echo @category_description(); ?></div>
            <?php
            $i = 1;
            if( have_posts() ):
            ?> 
            <div class="bloque-apps">
                <?php
				while( have_posts() ) : the_post();
                    get_template_part( 'template-parts/loop/app' );
                    if( $i == 6) {
                        if( !wp_is_mobile( ) )
                            echo '</div>'.ads("ads_home").'<div class="bloque-apps">';
                    }
                    $i++; 
                endwhile;
                ?>
            </div>
            <?php paginador();
            else: 
                echo '<div class="no-entries"><p>'.__( 'No hay entradas', 'appyn' ).'</p></div>';
            endif; ?>
        </div>
   </div>
<?php get_footer(); ?>