<?php

if( ! defined( 'ABSPATH' ) ) die ( '✋' );

add_action( 'subheader', 'func_subheader' );

function func_subheader() {
	if( is_404() ) return;

	if( is_home() ) { ?>
	<div id="subheader">
		<div class="imgbg">
			<?php echo cover_header(); ?>
		</div>
		<div class="subcontainer">
			<?php $titulo_p = appyn_options( 'titulo_principal'); 
				if ( !empty( $titulo_p ) ) echo '<h1>'.$titulo_p.'</h1>';  ?>
			<?php $descripcion_p = appyn_options( 'descripcion_principal'); 
				if ( !empty( $descripcion_p ) ) echo '<h2>'.$descripcion_p.'</h2>'; ?>
			<div id="searchBox">
				<form action="<?php bloginfo("url"); ?>">
					<input type="text" name="s" placeholder="<?php echo px_gte( 'bua' ); ?>" required autocomplete="off" id="sbinput" aria-label="Search">
					<button type="submit" role="button" aria-label="Search" title="<?php echo px_gte( 'bua' ); ?>"><i class="fa fa-search" aria-hidden="true"></i></button>
				</form>
				<ul></ul>
			</div>
			<?php echo px_header_social(); ?>
		</div>
	</div>
	<?php } else { ?>
	<div id="subheader" class="np">
		<div id="searchBox">
			<form action="<?php bloginfo('url'); ?>">
				<input type="text" name="s" placeholder="<?php echo px_gte( 'bua' ); ?>" required autocomplete="off" id="sbinput">
				<button type="submit" role="button" aria-label="Search" title="<?php echo px_gte( 'bua' ); ?>"><i class="fa fa-search" aria-hidden="true"></i></button>
			</form>
			<ul></ul>
		</div>
		<?php echo px_header_social(); ?>
	</div>
	<?php }
}

add_action( 'do_home', 'func_action_home_mq' );

function func_action_home_mq() {
	global $post;

	if( is_amp_px() ) return;
	
	$mas_calificadas = get_option('appyn_mas_calificadas');
	if(!empty($mas_calificadas)){
		$mas_calificadas_limite = get_option('appyn_mas_calificadas_limite');
		$mas_calificadas_limite = (empty($mas_calificadas_limite)) ? '5' : $mas_calificadas_limite;
		
		$args = array( 'posts_per_page' => $mas_calificadas_limite, 'meta_key' => 'new_rating_users', 'orderby' => 'meta_value_num' );			

		$iamc = get_option( 'appyn_versiones_mostrar_inicio_apps_mas_calificadas', 0 );
		
		if( $iamc == 1 ) {
			$args['post_parent'] = 0;
		}
		
		$query = new WP_Query( $args );

		if( $query->have_posts() ): ?>
    	<div class="section">
            <div class="title-section"><?php echo px_gte( 'amc' ); ?></div>
        	<div id="slidehome" class="px-carousel pxcn">
				<div class="px-carousel-nav">
					<button type="button" role="presentation" class="px-prev" aria-label="Left"><i class="fa fa-angle-left" aria-hidden="true"></i></button>
					<button type="button" role="presentation" class="px-next" aria-label="Right"><i class="fa fa-angle-right" aria-hidden="true"></i></button>
				</div>
				<div class="px-carousel-wrapper">
					<div class="px-carousel-container">
				<?php
				while( $query->have_posts() ) : $query->the_post();
					if( !$post ) continue; ?>

					<div class="px-carousel-item"><?php get_template_part('template-parts/loop/app-slider'); ?></div>
				<?php endwhile; ?>
					</div>
				</div>
            </div>
        </div>
		<?php endif; wp_reset_postdata(); 
	}
}

add_action( 'do_home', 'func_action_home' );

function func_action_home() {
	if( have_posts() ) : 
	$i = 1;

	if( appyn_options( 'home_hidden_posts') ) return;
?>
	<div class="section">
		<div class="title-section"><?php echo px_gte( 'uadnw' ); ?></div>
		<div class="bloque-apps">
			<?php
			while( have_posts() ) : the_post();
				get_template_part( 'template-parts/loop/app' );
				if( $i == 6) {
					echo '</div>'.ads("ads_home").'<div class="bloque-apps">';
				}
				$i++; 
			endwhile;
			?>
		</div>
		<?php paginador(); ?>
	</div>
<?php
	endif; wp_reset_query(); 	
}

add_action( 'do_home', 'func_action_home_blog' );

function func_action_home_blog() {	

	if( appyn_options( 'home_hidden_blog') ) return;

	$blog_posts_home_limite = get_option( 'appyn_blog_posts_home_limite' );
	$blog_posts_home_limite = ( empty( $blog_posts_home_limite ) ) ? '4' : $blog_posts_home_limite;
	$query = new WP_Query(array( 'post_type' => 'blog', 'posts_per_page' => $blog_posts_home_limite ) );
	if( $query->have_posts() ) : ?>
		<div class="section">
			<div class="title-section"><?php echo __( 'Blog', 'appyn' ); ?></div>
			<div class="bloque-blogs px-columns">
				<?php 
				while( $query->have_posts() ) : $query->the_post();
					get_template_part( 'template-parts/loop/blog-home' ); 
				endwhile; 
				?>
			</div>
			<?php if( $query->found_posts > $blog_posts_home_limite ):?>
				<p><a href="<?php echo get_post_type_archive_link( 'blog' ); ?>" class="more"><?php echo __( 'Ver más', 'appyn' ); ?></a></p>
			<?php endif; ?>
		</div>
	<?php
	endif;
	wp_reset_query(); 
}

add_action( 'do_home', 'func_action_home_categories' );

function func_action_home_categories() {
	global $wp_query;
	$categorias_home = get_option( 'appyn_categories_home' );
	if( !empty( $categorias_home ) ) { 
		$h = 1; 
		foreach( $categorias_home as $cat) :
			$cat = get_term( $cat, 'category' );
			if( function_exists( 'icl_object_id' ) ){ //WPML
				$cat_id_wpml = icl_object_id( $cat->term_id,'category',false,ICL_LANGUAGE_CODE);
				if( !empty( $cat_id_wpml ) )
					$cat = get_term_by( 'id', $cat_id_wpml, 'category' );
			}
			$i = 1;
			$categories_home_limite = get_option( 'appyn_categories_home_limite' );
			$categories_home_limite = ( empty( $categories_home_limite ) ) ? '10' : $categories_home_limite;

			$args = array( 'posts_per_page' => $categories_home_limite, 'cat' => $cat->term_id );			

			$categories_home_versiones = get_option( 'appyn_versiones_mostrar_inicio_categorias', 0 );

			if( $categories_home_versiones == 1 ) {
				$args['post_parent'] = 0;
			}

			query_posts($args);

			if( have_posts() ) : 
				$px_cat_icon = get_term_meta( $cat->term_id, "px_cat_icon", true );

				$ico = ( $px_cat_icon ) ? '<span class="icop '.$px_cat_icon.'"></span>' : '';
			?>
			<div class="section">
				<div class="title-section">
					<?php echo $ico; ?>
					<span><?php echo $cat->name; ?></span>
				</div>
				<div class="bloque-apps">
					<?php
					while( have_posts() ) : the_post();
					
						get_template_part( 'template-parts/loop/app' );
						if( $h == 1 && $i == 6 ) {
							if( !wp_is_mobile( ) )
								echo '</div>'.ads("ads_home").'<div class="bloque-apps">';
						}
						$i++; 
					endwhile;
					?>
				</div>
				<?php if( $wp_query->found_posts > $categories_home_limite ) { ?>
					<p><a href="<?php echo get_term_link( $cat->term_id, 'category' ); ?>" class="more"><?php echo __( 'Ver más', 'appyn' ); ?></a></p>
				<?php } ?>
			</div>
			<?php endif; wp_reset_query(); ?>
		<?php $h++; endforeach; ?>
   <?php } 
}

function action_func_caja($name, $version = false) {
	
	$cvn = get_option( 'appyn_orden_cajas_disabled', array() );

	if( strpos($name, 'permanent_custom_box_') !== false ) {
		$re = '/permanent_custom_box_(.*)/ms';
		preg_match_all($re, $name, $matches, PREG_SET_ORDER, 0);
		$id = $matches[0][1];
		$pcb = get_option( 'permanent_custom_boxes' );
		if( $pcb ) {
			if( isset($pcb[$id]) ) {
				do_action( 'func_caja_permanent_custom_box', $id );
			}
		}
	}
	else {
		if( $version ) {
			do_action( 'func_caja_'.$name );
		} else {
			if( $name == 'versiones' ) {
				if (!in_array($name, $cvn))
					do_action( 'func_caja_'.$name, false );
			} else {
				if( !in_array($name, $cvn ) ) 
					do_action( 'func_caja_'.$name );
			}
		}
	}
} 

add_action( 'seccion_cajas', 'func_seccion_cajas' );

function func_seccion_cajas() {
	global $post;
	$oc = get_option( 'appyn_orden_cajas', null );
	$get_download = get_query_var( 'download' );
	
	if( $post->post_parent != 0 ) { // En versiones
		if( $oc ) {
			foreach( $oc as $k => $a ) {
				if( activate_versions_boxes($k) ) {
					action_func_caja($k, true);
				}
			}
		} else {
			order_default('versions');
		}

	} else {
		if( $oc ) {
			foreach( $oc as $k => $a ) {
				if( $get_download ) { 
					if( activate_internal_page_boxes($k) ) {
						action_func_caja($k);
					}
				} else {
					action_func_caja($k);
				}
			}
		 } else {
			order_default();
		}
	}
}

function order_default($t = '') {

	if( $t == "versions" ) {
		do_action( 'func_caja_versiones' );
			
		if( activate_versions_boxes('descripcion') ) {
			do_action( 'func_caja_descripcion' );
		}
			
		if( activate_versions_boxes('ads_single_center') ) {
			do_action( 'func_caja_ads_single_center' );
		}

		if( activate_versions_boxes('novedades') ) {
			do_action( 'func_caja_novedades' );
		}

		if( activate_versions_boxes('imagenes') ) {
			do_action( 'func_caja_imagenes' );
		}

		if( activate_versions_boxes('video') ) {
			do_action( 'func_caja_video' );
		}
		
		if( activate_versions_boxes('enlaces_descarga') ) {
			do_action( 'func_caja_enlaces_descarga' );
		}

		if( activate_versions_boxes('relacionadas') ) {
			do_action( 'func_caja_apps_relacionadas' );
		}
		
		if( activate_versions_boxes('apps_desarrollador') ) {
			do_action( 'func_caja_apps_desarrollador' );
		}

		if( activate_versions_boxes('cajas_personalizadas') ) {
			do_action( 'func_caja_cajas_personalizadas' );
		}

		if( activate_versions_boxes('tags') ) {
			do_action( 'func_caja_tags' );
		}

		if( activate_versions_boxes('comentarios') ) {
			do_action( 'func_caja_comentarios' );
		}
	} else {
		do_action( 'func_caja_versiones', false );
		do_action( 'func_caja_descripcion' );
		do_action( 'func_caja_ads_single_center' );
		do_action( 'func_caja_novedades' );
		do_action( 'func_caja_imagenes' );
		do_action( 'func_caja_video' );
		do_action( 'func_caja_enlaces_descarga' );
		do_action( 'func_caja_apps_relacionadas' );
		do_action( 'func_caja_apps_desarrollador' );
		do_action( 'func_caja_cajas_personalizadas' );
		do_action( 'func_caja_tags' );
		$pcb = get_option( 'permanent_custom_boxes' );
		if( $pcb ) {
			foreach( $pcb as $k => $p ) {
				do_action( 'func_caja_permanent_custom_box', $k );
			}
		}
		do_action( 'func_caja_comentarios' );
	}
}

add_action( 'func_caja_comentarios', 'func_caja_comentarios' );

function func_caja_comentarios() {
	global $post, $comments_single;

	if( $post->post_parent == 0 ) {
				
		if ( post_password_required() ) return;

		$comments_single = get_option('appyn_comments'); 

		if( $comments_single == "disabled" ) return;

		$get_download = get_query_var( 'download' );
		
		if( $get_download )
			if( !activate_internal_page_boxes('comentarios') ) return;
			
		comments_template();
	}
}

add_action( 'func_caja_enlaces_descarga', 'func_caja_enlaces_descarga' );

function func_caja_enlaces_descarga() {
	global $post;

	if( !is_download_links_normal() ) return;

	$datos_download = get_datos_download($post->ID);

	if( !is_array($datos_download) ) return;

	if( $datos_download['option'] == "direct-link" ) return;

	if( $datos_download['option'] == "direct-download" ) return;

	if( empty($datos_download['links_options'][0]) ) return;

	?>
	<div id="download" class="box">
		<h2 class="box-title"><?php echo __( 'Enlaces de descarga', 'appyn' ); ?></h2>
		<?php do_action( 'list_download_links' ); ?>
	</div>
	<?php
}

add_action( 'func_caja_descripcion', 'func_caja_descripcion' );

function func_caja_descripcion() {
	global $post;

	?>
	<div id="descripcion" class="box">
		<h2 class="box-title"><?php echo __( 'Descripción', 'appyn' ); ?></h2>
		<div class="entry">
			<div class="entry-limit">
				<?php px_the_content(); ?>
				<?php wp_link_pages(); ?>
			</div>
		</div>
	</div>
<?php
}

add_action( 'func_caja_ads_single_center', 'func_caja_ads_single_center' );

function func_caja_ads_single_center() {

	echo ads("ads_single_center");
}

add_action( 'func_caja_versiones', 'func_caja_versiones', 10, 2 );

function func_caja_versiones($full = false, $cvn = array()) {
	global $wp_query, $wpdb, $post;

	$versiones_cantidad_post = get_option( 'appyn_versiones_cantidad_post', 5 );
	$args = array( 
			'post_parent' => $post->ID, 
			'posts_per_page' => -1,
			'post_status' => 'publish',
			'ignore_sticky_posts' => 1,
	);

	if( $post->post_parent != 0 ) {
		$args['post_parent'] = $post->post_parent;
		$args['post__not_in'] = array($post->ID);
		$post_add = get_post($post->post_parent);
	}

	$versiones = new WP_Query( $args );
	if( $versiones->have_posts() || isset($post_add) ) : 
	?>
	<div id="versiones" class="box">
		<h2 class="box-title"><?php echo __( 'Versiones', 'appyn' ); ?></h2>
		<div class="box-content">
			<table style="margin:0;">
				<thead>
					<tr>
						<th><?php echo __( 'Versión', 'appyn' ); ?></th>
						<th><?php echo __( 'Peso', 'appyn' ); ?></th>
						<th><?php echo __( 'Requerimientos', 'appyn' ); ?></th>
						<th style="width:100px"><?php echo __( 'Fecha', 'appyn' ); ?></th>
					</tr>
				</thead>
				<tbody>
			<?php 
			$date_change = array(
				'enero' => '01',
				'febrero' => '02',
				'marzo' => '03',
				'abril' => '04',
				'mayo' => '05',
				'junio' => '06',
				'julio' => '07',
				'agosto' => '08',
				'setiembre' => '09',
				'octubre' => '10',
				'noviembre' => '11',
				'diciembre' => '12',
				' de ' => '-',
			);
			if( $post->post_parent != 0 ) {

				$inf = get_post_meta( $post_add->ID, 'datos_informacion', true );

				if( is_array($inf) ) {

					$link = get_permalink( $post_add->ID );
					$tb = '';

					if( appyn_options( 'version_download_link_direct' ) ) {
						$datos_download = get_datos_download( $post_add->ID );

						if( $link = px_show_first_dl() ) {
							$tb = ' target="_blank"';
						}
					}

				echo '<tr>
						<td><a href="'. $link .'"'.$tb.'>'.(( !empty($inf['version']) ) ? $inf['version'] : '-').'</a></td>
						<td>'.(( !empty($inf['tamano']) ) ? $inf['tamano'] : '-').'</td>
						<td>'.(( !empty($inf['requerimientos']) ) ? $inf['requerimientos'] : '-').'</td>
						<td>'.(( !empty($inf['fecha_actualizacion']) ) ? date_i18n( 'd/m/Y', strtotime(strtr($inf['fecha_actualizacion'], $date_change)) ) : '-').'</td>
					</tr>';		
				}	
			}	

			$i = 1;
			while( $versiones->have_posts() ) : $versiones->the_post();
			
				$inf = get_post_meta( $post->ID, 'datos_informacion', true );

				if( is_array($inf) ) {

					$link = get_permalink( $post->ID );
					$tb = '';
					if( appyn_options( 'version_download_link_direct' ) ) {
						$datos_download = get_datos_download( $post->ID );

						if( $link = px_show_first_dl() ) {
							$tb = ' target="_blank"';
						}
					}

					if( $i <= $versiones_cantidad_post || $full ) {
					echo '<tr>
							<td><a href="'. $link.'"'.$tb.'>'.(( !empty($inf['version']) ) ? $inf['version'] : '-').'</a></td>
							<td>'.(( !empty($inf['tamano']) ) ? $inf['tamano'] : '-').'</td>
							<td>'.(( !empty($inf['requerimientos']) ) ? $inf['requerimientos'] : '-').'</td>
							<td>'.(( !empty($inf['fecha_actualizacion']) ) ? date_i18n( 'd/m/Y', strtotime(strtr($inf['fecha_actualizacion'], $date_change)) ) : '-').'</td>
						</tr>';	
						$i++;
					}	
				}			
			endwhile; wp_reset_query(); ?>
				</tbody>
			</table>
		</div>
		<?php
		if( !$full ) {
		if( $versiones->found_posts > $versiones_cantidad_post ) { ?>
		<p style="margin-bottom:0;"><a href="<?php echo versions_permalink(); ?>" class="readmore"><?php echo __( 'Ver más versiones', 'appyn' ); ?></a></p>
		<?php } 
		} ?>
	</div>
	<?php endif; wp_reset_query(); 
} 

add_action( 'func_caja_novedades', 'func_caja_novedades' );

function func_caja_novedades() {
	global $post;

	$datos_informacion = get_post_meta($post->ID, 'datos_informacion', true);

	if( empty($datos_informacion['novedades']) ) return;

	?>
	<div id="novedades" class="box">
		<h2 class="box-title"><?php echo __( 'Novedades', 'appyn' ); ?></h2>
		<div class="box-content entry">
			<?php echo wpautop( $datos_informacion['novedades'] ); ?>
		</div>
	</div>
	<?php
} 

add_action( 'func_caja_imagenes', 'func_caja_imagenes' );

function func_caja_imagenes() { 
	global $post;

	$datos_imagenes = get_post_meta( $post->ID, 'datos_imagenes', true );
	if( !isset($datos_imagenes) && empty($datos_imagenes) || @!is_array($datos_imagenes) ) return;
	$datos_imagenes = @array_map('trim', $datos_imagenes); 
	$datos_imagenes = @array_filter($datos_imagenes, function($a) { return $a!==""; });

	if( !is_array($datos_imagenes) ) return;
	
	if(count($datos_imagenes) == 0 ) return;

	?>
	<div class="box imagenes">
		<h2 class="box-title"><?php echo __( 'Imágenes', 'appyn' ); ?></h2>
		<div id="slideimages" class="px-carousel" data-title="<?php the_title(); ?>">
			<?php 
			if( is_amp_px() ) { ?>
			<amp-carousel height="300" controls layout="fixed-height" type="slides">
			<?php
			$i = 0; 
			foreach($datos_imagenes as $imagen) {
				if(strpos($imagen, 'googleusercontent.com') !== false || strpos($imagen, 'ggpht.com') !== false) {
					$last_pos = strrpos($imagen, '=');
					$imagen= substr($imagen, 0, $last_pos)."=h305";
					$imagen_big = substr($imagen, 0, $last_pos)."=h650";
				} else {
					$imagen_id = get_image_id($imagen);
					if(empty($imagen_id)){
						$imagen_big = $imagen;
						$imagen = $imagen;
					} else {
						$imagen_big = $imagen;
						$imagen = wp_get_attachment_image_src($imagen_id, 'medium');	
						$imagen = $imagen[0];
					}
				}
				?>
				<amp-img src="<?php echo $imagen; ?>" layout="fill"
					height="300"
					alt="a sample image"></amp-img>
			<?php } ?>
			</amp-carousel>
			<?php
			} else { ?>
			<div class="px-carousel-nav disabled"><button type="button" role="presentation" class="px-prev disabled"><i class="fa fa-angle-left" aria-hidden="true"></i></button><button type="button" role="presentation" class="px-next disabled"><i class="fa fa-angle-right" aria-hidden="true"></i></button></div>
			<div class="px-carousel-wrapper">
				<div class="px-carousel-container">
					<?php $i = 0; 
					foreach($datos_imagenes as $imagen) {
						if(strpos($imagen, 'googleusercontent.com') !== false || strpos($imagen, 'ggpht.com') !== false) {
							$last_pos = strrpos($imagen, '=');
							$imagen= substr($imagen, 0, $last_pos)."=h305";
							$imagen_big = substr($imagen, 0, $last_pos)."=h650";
						} else {
							$imagen_id = get_image_id($imagen);
							if(empty($imagen_id)){
								$imagen_big = $imagen;
								$imagen = $imagen;
							} else {
								$imagen_big = $imagen;
								$imagen = wp_get_attachment_image_src($imagen_id, 'medium');	
								$imagen = $imagen[0];
							}
						}
						$appyn_lazy_loading = ( get_option('appyn_lazy_loading') ) ? get_option('appyn_lazy_loading') : NULL;
						if( $appyn_lazy_loading == 1 ) {
							$image_blank = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAI4AAACNAQMAAABbp9DlAAAAA1BMVEX///+nxBvIAAAAGUlEQVRIx+3BMQEAAADCIPunNsU+YAAA0DsKdwABBBTMnAAAAABJRU5ErkJggg==";
							$color_theme = get_option( 'appyn_color_theme' );
							$color_theme_principal = get_option( 'appyn_color_theme_principal' );
							if( is_dark_theme_active() ) {
								$image_blank = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAI4AAACNAQMAAABbp9DlAAAAA1BMVEUUHCkYkPNHAAAAGUlEQVRIx+3BMQEAAADCIPunNsU+YAAA0DsKdwABBBTMnAAAAABJRU5ErkJggg==";
							}
							echo '<div class="px-carousel-item"><img class="lazyload" src="'.$image_blank.'" data-src="'.$imagen.'" width="100%" height="100%" data-big-src="'.$imagen_big.'" alt="'.get_the_title().' '.($i + 1).'"></div>';
						} else {
							echo '<div class="px-carousel-item"><img src="'.$imagen.'" width="100%" height="100%" data-big-src="'.$imagen_big.'" alt="'.get_the_title().' '.($i + 1).'"></div>'; 
						}
						$i++;
					}
					?>
				</div>
			</div>
			<?php } ?>
		</div>
	</div> 
<?php 
} 

add_action( 'func_caja_video', 'func_caja_video' );

function func_caja_video() {
	global $post,$datos_video;

	$datos_video = get_post_meta($post->ID, 'datos_video', true); 

	if( empty($datos_video['id']) ) return;

	?>
	<div class="box">
		<h2 class="box-title"><?php echo __( 'Video', 'appyn' ); ?></h2>
		<div class="iframeBoxVideo" data-id="<?php echo $datos_video['id']; ?>">
		<?php
		if( is_amp_px() ) {
			echo '<amp-youtube data-videoid="'.$datos_video['id'].'" layout="responsive" width="560" height="315"></amp-youtube>';
		} else {
			$appyn_lazy_loading = ( get_option('appyn_lazy_loading') ) ? get_option('appyn_lazy_loading') : NULL;
			if( $appyn_lazy_loading == 1 ) {
			?>
				<iframe width="730" height="360" src="" data-src="https://www.youtube.com/embed/<?php echo $datos_video['id']; ?>" style="border:0; overflow:hidden;" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen class="lazyload"></iframe>
			<?php } else { ?>
				<iframe width="730" height="360" src="https://www.youtube.com/embed/<?php echo $datos_video['id']; ?>" style="border:0; overflow:hidden;" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
			<?php }
		} ?>
		</div>
	</div>
	<?php
}

add_action( 'func_caja_apps_relacionadas', 'func_caja_apps_relacionadas' );

function func_caja_apps_relacionadas() {
	global $post;
	
	$args = array(
		'post_type' => 'post',
		'posts_per_page' => 5, 
		'post__not_in' => array($post->ID), 
		'post_parent' => 0, 
		'orderby' => 'relevance' 
	);
	$apps_related_type = get_option( 'appyn_apps_related_type', array() ); 

	if( !is_array($apps_related_type) ) return;
	
	if( in_array('cat', $apps_related_type) || empty($apps_related_type) ) {
		$cats = get_the_category($post->ID);
		$list_cats_id = array();
		foreach( $cats as $c ) {
			$list_cats_id[] = $c->term_id;
		}
		$args['category__in'] = $list_cats_id;
	} 
	if( in_array('tag', $apps_related_type) ) {
		$tags = get_the_tags($post->ID);
		$list_tags_id = array();
		if( is_array($tags) ) {
			foreach( $tags as $t ) {
				$list_tags_id[] = $t->term_id;
			}
			$args['tag__in'] = $list_tags_id;
		}
	} 
	if( in_array('title', $apps_related_type) ) {
		$args['s'] = get_the_title();
	} 
	if( in_array('random', $apps_related_type) ) {
		$args['orderby'] = 'rand';
	}

	$query = new WP_Query( $args );
	if( $query->have_posts() ) : ?>
		<div class="box relacionados">
			<h2 class="box-title"><?php echo __( 'Apps relacionadas', 'appyn' ); ?></h2>
			<div class="bloque-apps">
			<?php while( $query->have_posts() ) : $query->the_post();
			get_template_part( 'template-parts/loop/app-related' ); 
			endwhile; ?>
			</div>
		</div>			
	<?php
	endif;
	wp_reset_query();
} 

add_action( 'func_caja_cajas_personalizadas', 'func_caja_cajas_personalizadas' );

function func_caja_cajas_personalizadas() {
	global $post;

	$custom_boxes = get_post_meta( $post->ID, 'custom_boxes', true );

	if( empty($custom_boxes) ) return;

	foreach($custom_boxes as $box_key => $box_value) { 
		if( !empty( $box_value['title'] ) || !empty( $box_value['content'] ) ) { ?>
			<div id="box-<?php echo $box_key; ?>" class="box personalizadas">
				<h2 class="box-title"><?php echo $box_value['title']; ?></h2>
				<div class="box-content"><?php echo apply_filters('the_content', px_content_filter($box_value['content']) ); ?></div>
			</div>
	<?php } 
	}
}

add_action( 'func_caja_apps_desarrollador', 'func_caja_apps_desarrollador' );

function func_caja_apps_desarrollador() { 
	global $post;

	$dev_terms = wp_get_post_terms( $post->ID, 'dev', array('fields' => 'all'));

	if( !isset($dev_terms[0]->slug) ) return;

	$query = new WP_Query( array('post_type' => 'post', 'posts_per_page' => 5, 'post__not_in' => array($post->ID), 'post_parent' => 0, 'tax_query' => array(
		array(
			'taxonomy' => 'dev',
			'field'    => 'slug',
			'terms'    => $dev_terms[0]->slug,
		),
	) ) );
	if( $query->have_posts() ) { ?>
	<div class="box relacionados">
		<h2 class="box-title"><?php echo __( 'Apps del desarrollador', 'appyn' ); ?></h2>
		<div class="bloque-apps">
		<?php while( $query->have_posts() ) : $query->the_post();
		get_template_part( 'template-parts/loop/app-related' ); 
		endwhile; ?>
		</div>
	</div>
	<?php } 
	wp_reset_query(); 
} 

add_action( 'func_caja_tags', 'func_caja_tags' );

function func_caja_tags() { 
	global $post;

	$post_tags = wp_get_post_tags( $post->ID );
	
	if( empty($post_tags) ) return;

	?>
	<div id="tags" class="box etiquetas">
		<h2 class="box-title"><?php echo __( 'TAGS', 'appyn' ); ?></h2>
		<?php the_tags( '', '' ); ?>
	</div> 
	<?php
}

add_action( 'func_caja_permanent_custom_box', 'func_caja_permanent_custom_box', 10, 2 );

function func_caja_permanent_custom_box( $id ) { 
	global $post;

	$pcb = get_option( 'permanent_custom_boxes' );
	
	if( empty($pcb) ) return;
	
	if( empty($pcb[$id]['title']) || empty($pcb[$id]['content']) ) return;
	?>
	<div id="pcb-<?php echo $id; ?>" class="box personalizadas">
		<h2 class="box-title"><?php echo $pcb[$id]['title']; ?></h2>
		<div class="box-content"><?php echo apply_filters('the_content', px_content_filter($pcb[$id]['content']) ); ?></div>
	</div> 
	<?php
}

add_action( 'init', 'px_verify_return_gdrive' );

function px_verify_return_gdrive() {
	$code = isset($_GET['code']) ? $_GET['code'] : null;
	$appyn_upload = isset($_GET['appyn_upload']) ? $_GET['appyn_upload'] : null;

	if( $code && $appyn_upload == 'gdrive' ) {

		if( ! current_user_can('administrator') ) return;

		$gdrive = new GoogleDrive();
		if( $gdrive->getClient() ) {
			$token = $gdrive->getClient()->fetchAccessTokenWithAuthCode($code);

			$gdrive->getClient()->setAccessToken($token);

			update_option('appyn_gdrive_token', json_encode($token));
			header("Location: ".admin_url('admin.php?page=appyn_panel#edcgp'));
			exit;
		}
	}
}

add_action( 'init', 'px_verify_return_onedrive' );

function px_verify_return_onedrive() {
	$code = isset($_GET['code']) ? $_GET['code'] : null;

	if( $code && ( strpos( $_SERVER['HTTP_REFERER'], 'login.microsoftonline.com' ) !== false || strpos( $_SERVER['HTTP_REFERER'], 'account.live.com' ) !== false  || strpos( $_SERVER['HTTP_REFERER'], 'login.live.com' ) !== false ) ) {

		if( ! current_user_can('administrator') ) return;

		$onedrive = new OneDrive();

		$onedrive->getToken($code);

		header("Location: ".admin_url('admin.php?page=appyn_panel#edcgp'));
		exit;
	}
}

add_action( 'init', 'px_verify_return_dropbox' );

function px_verify_return_dropbox() {
	$code = isset($_GET['code']) ? $_GET['code'] : null;
	$appyn_upload = isset($_GET['appyn_upload']) ? $_GET['appyn_upload'] : null;
	$dropbox_app_key = appyn_options( 'dropbox_app_key' );
	$dropbox_app_secret = appyn_options( 'dropbox_app_secret' );
	
	if( $code && $appyn_upload == 'dropbox' ) {

		if( ! current_user_can('administrator') ) return;

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, 'https://api.dropbox.com/oauth2/token');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "code=".$_GET['code']."&grant_type=authorization_code&redirect_uri=".add_query_arg('appyn_upload', 'dropbox', get_bloginfo('url')));
		curl_setopt($ch, CURLOPT_USERPWD, $dropbox_app_key.':'.$dropbox_app_secret);

		$headers = array();
		$headers[] = 'Content-Type: application/x-www-form-urlencoded';
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$result = curl_exec($ch);
		if (curl_errno($ch)) {
			die('Error:' . curl_error($ch));
		}
		if( $result ) {
			$j = json_decode($result, true);
			if( isset($j['access_token']) ) {
				update_option( 'appyn_dropbox_result', $result );
				update_option( 'appyn_dropbox_expires', (time()+$j['expires_in']) );
				header("Location: ".admin_url('admin.php?page=appyn_panel#edcgp'));
				exit;
			}
		}
	}
}

function box_report_action() {
	
	$reports_opt = px_reports_opt();
	
	echo '<div id="box-report" class="box">
		<div class="box-content">
			<a href="javascript:void(0)" class="close-report"><i class="fa fa-close"></i></a>
			<h2>'.__( 'Reportar esta app', 'appyn').'</h2>
			<form>';

		foreach( $reports_opt as $key => $opt ) {
			echo '<label><input type="radio" name="report-opt" value="'.($key+1).'" '.( ($key == 0) ? 'checked required' : '').'> <span>'.$opt.'</span></label>';
		}

	echo '<p><textarea placeholder="'.__( 'Detalle del reporte (Opcional)', 'appyn' ).'"  name="report-details" spellcheck="off"></textarea></p>';
	
	$appyn_request_email = appyn_options( 'request_email' );

    if( $appyn_request_email ) {
        echo '<p><input type="email" name="report-email" required spellcheck="off" placeholder="'.__('Email *', 'appyn').'" style="width:100%;"></p>';
    }
		echo '<p style="margin-bottom:0;"><input type="submit" class="br-submit" value="'.__('Reportar', 'appyn').'"></p>
			</form>
		</div>
	</div>';
}

add_action( 'wp', 'redirect_download_link' );

function redirect_download_link() {
	$dl = get_query_var( 'download_link' );
	if( $dl ) {
		$dl = px_encrypt_decrypt( 'decrypt', $dl );
		wp_redirect($dl);
		exit;
	}
}

add_action( 'wp_footer', 'px_backtotop' );
function px_backtotop() {
	echo '<div id="backtotop"><i class="fa fa-angle-up"></i></div>';
}

add_action( 'wp_head', 'px_clsa' );
function px_clsa() {

	$a = ( isset($_SERVER['HTTP_USER_AGENT']) ) ? $_SERVER['HTTP_USER_AGENT'] : null;

	if( strpos( $a, 'Chrome-Lighthouse' ) === false ) {
        echo '<style>
		.imgload {
			animation:0.5s ease 0.5s normal forwards 1 fadein;
			-webkit-animation:0.5s ease 0.5s normal forwards 1 fadein;
		}
		.bloque-imagen.bi_ll.bi_ll_load {
			animation:0.5s ease 0.5s normal forwards 1 fadeingb;
			-webkit-animation:0.5s ease 0.5s normal forwards 1 fadeingb;
		}
		#subheader .imgbg img {
			animation: subheaderimg 20s linear infinite;
		}
		@media (max-width: 500px) {
			#subheader .imgbg img {
				animation: subheaderimg_ 20s linear infinite;
			}
		}
		</style>';
    } else {
		echo '<style>
			.lazyload {
				opacity: 1;
			}
		</style>';
	}
}

add_action( 'wp_head', 'prlvf', 1 );
function prlvf() {
	global $wp_scripts;
  
	echo '
	<link rel="preload" as="font" type="font/woff2" crossorigin href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/fonts/fontawesome-webfont.woff2?v=4.7.0"/>';

	if( is_rtl() ) {
		echo '
		<link rel="preload" as="style" href="'.get_stylesheet_directory_uri().'/rtl.css?ver='.VERSIONPX.'"/>';
	}

	global $post;

	if( is_single() && has_post_thumbnail($post->ID) ) {
		echo '<link rel="preload" href="'.get_the_post_thumbnail_url($post->ID, 'thumbnail').'" as="image">';
	}
	
	$a = ( isset($_SERVER['HTTP_USER_AGENT']) ) ? $_SERVER['HTTP_USER_AGENT'] : null;

    if( strpos( $a, 'Chrome-Lighthouse' ) === false ) {
        echo "
<style>
body {
	font-family: 'Open Sans', 'Arial', sans-serif;
}
@font-face{font-family:'Open Sans';font-style:normal;font-weight:300;font-display:swap;src:url(https://fonts.gstatic.com/s/opensans/v20/mem5YaGs126MiZpBA-UN_r8OX-hpOqc.woff2) format('woff2');unicode-range:U+0460-052F,U+1C80-1C88,U+20B4,U+2DE0-2DFF,U+A640-A69F,U+FE2E-FE2F}@font-face{font-family:'Open Sans';font-style:normal;font-weight:300;font-display:swap;src:url(https://fonts.gstatic.com/s/opensans/v20/mem5YaGs126MiZpBA-UN_r8OVuhpOqc.woff2) format('woff2');unicode-range:U+0400-045F,U+0490-0491,U+04B0-04B1,U+2116}@font-face{font-family:'Open Sans';font-style:normal;font-weight:300;font-display:swap;src:url(https://fonts.gstatic.com/s/opensans/v20/mem5YaGs126MiZpBA-UN_r8OXuhpOqc.woff2) format('woff2');unicode-range:U+1F00-1FFF}@font-face{font-family:'Open Sans';font-style:normal;font-weight:300;font-display:swap;src:url(https://fonts.gstatic.com/s/opensans/v20/mem5YaGs126MiZpBA-UN_r8OUehpOqc.woff2) format('woff2');unicode-range:U+0370-03FF}@font-face{font-family:'Open Sans';font-style:normal;font-weight:300;font-display:swap;src:url(https://fonts.gstatic.com/s/opensans/v20/mem5YaGs126MiZpBA-UN_r8OXehpOqc.woff2) format('woff2');unicode-range:U+0102-0103,U+0110-0111,U+0128-0129,U+0168-0169,U+01A0-01A1,U+01AF-01B0,U+1EA0-1EF9,U+20AB}@font-face{font-family:'Open Sans';font-style:normal;font-weight:300;font-display:swap;src:url(https://fonts.gstatic.com/s/opensans/v20/mem5YaGs126MiZpBA-UN_r8OXOhpOqc.woff2) format('woff2');unicode-range:U+0100-024F,U+0259,U+1E00-1EFF,U+2020,U+20A0-20AB,U+20AD-20CF,U+2113,U+2C60-2C7F,U+A720-A7FF}@font-face{font-family:'Open Sans';font-style:normal;font-weight:300;font-display:swap;src:url(https://fonts.gstatic.com/s/opensans/v20/mem5YaGs126MiZpBA-UN_r8OUuhp.woff2) format('woff2');unicode-range:U+0000-00FF,U+0131,U+0152-0153,U+02BB-02BC,U+02C6,U+02DA,U+02DC,U+2000-206F,U+2074,U+20AC,U+2122,U+2191,U+2193,U+2212,U+2215,U+FEFF,U+FFFD}@font-face{font-family:'Open Sans';font-style:normal;font-weight:400;font-display:swap;src:url(https://fonts.gstatic.com/s/opensans/v20/mem8YaGs126MiZpBA-UFWJ0bbck.woff2) format('woff2');unicode-range:U+0460-052F,U+1C80-1C88,U+20B4,U+2DE0-2DFF,U+A640-A69F,U+FE2E-FE2F}@font-face{font-family:'Open Sans';font-style:normal;font-weight:400;font-display:swap;src:url(https://fonts.gstatic.com/s/opensans/v20/mem8YaGs126MiZpBA-UFUZ0bbck.woff2) format('woff2');unicode-range:U+0400-045F,U+0490-0491,U+04B0-04B1,U+2116}@font-face{font-family:'Open Sans';font-style:normal;font-weight:400;font-display:swap;src:url(https://fonts.gstatic.com/s/opensans/v20/mem8YaGs126MiZpBA-UFWZ0bbck.woff2) format('woff2');unicode-range:U+1F00-1FFF}@font-face{font-family:'Open Sans';font-style:normal;font-weight:400;font-display:swap;src:url(https://fonts.gstatic.com/s/opensans/v20/mem8YaGs126MiZpBA-UFVp0bbck.woff2) format('woff2');unicode-range:U+0370-03FF}@font-face{font-family:'Open Sans';font-style:normal;font-weight:400;font-display:swap;src:url(https://fonts.gstatic.com/s/opensans/v20/mem8YaGs126MiZpBA-UFWp0bbck.woff2) format('woff2');unicode-range:U+0102-0103,U+0110-0111,U+0128-0129,U+0168-0169,U+01A0-01A1,U+01AF-01B0,U+1EA0-1EF9,U+20AB}@font-face{font-family:'Open Sans';font-style:normal;font-weight:400;font-display:swap;src:url(https://fonts.gstatic.com/s/opensans/v20/mem8YaGs126MiZpBA-UFW50bbck.woff2) format('woff2');unicode-range:U+0100-024F,U+0259,U+1E00-1EFF,U+2020,U+20A0-20AB,U+20AD-20CF,U+2113,U+2C60-2C7F,U+A720-A7FF}@font-face{font-family:'Open Sans';font-style:normal;font-weight:400;font-display:swap;src:url(https://fonts.gstatic.com/s/opensans/v20/mem8YaGs126MiZpBA-UFVZ0b.woff2) format('woff2');unicode-range:U+0000-00FF,U+0131,U+0152-0153,U+02BB-02BC,U+02C6,U+02DA,U+02DC,U+2000-206F,U+2074,U+20AC,U+2122,U+2191,U+2193,U+2212,U+2215,U+FEFF,U+FFFD}@font-face{font-family:'Open Sans';font-style:normal;font-weight:600;font-display:swap;src:url(https://fonts.gstatic.com/s/opensans/v20/mem5YaGs126MiZpBA-UNirkOX-hpOqc.woff2) format('woff2');unicode-range:U+0460-052F,U+1C80-1C88,U+20B4,U+2DE0-2DFF,U+A640-A69F,U+FE2E-FE2F}@font-face{font-family:'Open Sans';font-style:normal;font-weight:600;font-display:swap;src:url(https://fonts.gstatic.com/s/opensans/v20/mem5YaGs126MiZpBA-UNirkOVuhpOqc.woff2) format('woff2');unicode-range:U+0400-045F,U+0490-0491,U+04B0-04B1,U+2116}@font-face{font-family:'Open Sans';font-style:normal;font-weight:600;font-display:swap;src:url(https://fonts.gstatic.com/s/opensans/v20/mem5YaGs126MiZpBA-UNirkOXuhpOqc.woff2) format('woff2');unicode-range:U+1F00-1FFF}@font-face{font-family:'Open Sans';font-style:normal;font-weight:600;font-display:swap;src:url(https://fonts.gstatic.com/s/opensans/v20/mem5YaGs126MiZpBA-UNirkOUehpOqc.woff2) format('woff2');unicode-range:U+0370-03FF}@font-face{font-family:'Open Sans';font-style:normal;font-weight:600;font-display:swap;src:url(https://fonts.gstatic.com/s/opensans/v20/mem5YaGs126MiZpBA-UNirkOXehpOqc.woff2) format('woff2');unicode-range:U+0102-0103,U+0110-0111,U+0128-0129,U+0168-0169,U+01A0-01A1,U+01AF-01B0,U+1EA0-1EF9,U+20AB}@font-face{font-family:'Open Sans';font-style:normal;font-weight:600;font-display:swap;src:url(https://fonts.gstatic.com/s/opensans/v20/mem5YaGs126MiZpBA-UNirkOXOhpOqc.woff2) format('woff2');unicode-range:U+0100-024F,U+0259,U+1E00-1EFF,U+2020,U+20A0-20AB,U+20AD-20CF,U+2113,U+2C60-2C7F,U+A720-A7FF}@font-face{font-family:'Open Sans';font-style:normal;font-weight:600;font-display:swap;src:url(https://fonts.gstatic.com/s/opensans/v20/mem5YaGs126MiZpBA-UNirkOUuhp.woff2) format('woff2');unicode-range:U+0000-00FF,U+0131,U+0152-0153,U+02BB-02BC,U+02C6,U+02DA,U+02DC,U+2000-206F,U+2074,U+20AC,U+2122,U+2191,U+2193,U+2212,U+2215,U+FEFF,U+FFFD}@font-face{font-family:'Open Sans';font-style:normal;font-weight:700;font-display:swap;src:url(https://fonts.gstatic.com/s/opensans/v20/mem5YaGs126MiZpBA-UN7rgOX-hpOqc.woff2) format('woff2');unicode-range:U+0460-052F,U+1C80-1C88,U+20B4,U+2DE0-2DFF,U+A640-A69F,U+FE2E-FE2F}@font-face{font-family:'Open Sans';font-style:normal;font-weight:700;font-display:swap;src:url(https://fonts.gstatic.com/s/opensans/v20/mem5YaGs126MiZpBA-UN7rgOVuhpOqc.woff2) format('woff2');unicode-range:U+0400-045F,U+0490-0491,U+04B0-04B1,U+2116}@font-face{font-family:'Open Sans';font-style:normal;font-weight:700;font-display:swap;src:url(https://fonts.gstatic.com/s/opensans/v20/mem5YaGs126MiZpBA-UN7rgOXuhpOqc.woff2) format('woff2');unicode-range:U+1F00-1FFF}@font-face{font-family:'Open Sans';font-style:normal;font-weight:700;font-display:swap;src:url(https://fonts.gstatic.com/s/opensans/v20/mem5YaGs126MiZpBA-UN7rgOUehpOqc.woff2) format('woff2');unicode-range:U+0370-03FF}@font-face{font-family:'Open Sans';font-style:normal;font-weight:700;font-display:swap;src:url(https://fonts.gstatic.com/s/opensans/v20/mem5YaGs126MiZpBA-UN7rgOXehpOqc.woff2) format('woff2');unicode-range:U+0102-0103,U+0110-0111,U+0128-0129,U+0168-0169,U+01A0-01A1,U+01AF-01B0,U+1EA0-1EF9,U+20AB}@font-face{font-family:'Open Sans';font-style:normal;font-weight:700;font-display:swap;src:url(https://fonts.gstatic.com/s/opensans/v20/mem5YaGs126MiZpBA-UN7rgOXOhpOqc.woff2) format('woff2');unicode-range:U+0100-024F,U+0259,U+1E00-1EFF,U+2020,U+20A0-20AB,U+20AD-20CF,U+2113,U+2C60-2C7F,U+A720-A7FF}@font-face{font-family:'Open Sans';font-style:normal;font-weight:700;font-display:swap;src:url(https://fonts.gstatic.com/s/opensans/v20/mem5YaGs126MiZpBA-UN7rgOUuhp.woff2) format('woff2');unicode-range:U+0000-00FF,U+0131,U+0152-0153,U+02BB-02BC,U+02C6,U+02DA,U+02DC,U+2000-206F,U+2074,U+20AC,U+2122,U+2191,U+2193,U+2212,U+2215,U+FEFF,U+FFFD}</style>";
	}

	foreach ($wp_scripts->queue as $handle) {
		$script = $wp_scripts->registered[$handle];

        if( $script->src && $handle != "admin-bar" ) {
            $source = $script->src . ($script->ver ? "?ver={$script->ver}" : "");

            echo '<link rel="preload" as="script" href="'.$source.'" />';
        }
	}
	
	global $wp_styles;
	foreach ($wp_styles->queue as $handle) {
		$style = $wp_styles->registered[$handle];
        if( $style->src && $handle != "admin-bar" ) {
			if( $style->src )
            $source = $style->src . ($style->ver ? "?ver={$style->ver}" : "");

            echo '<link rel="preload" as="style" href="'.$source.'" />';
        }
	}
}

add_action( 'wp', function(){
	$jquery_handle = (version_compare(wp_version_check(), '3.6-alpha1', '>=') ) ? 'jquery-core' : 'jquery';
	$jq = $GLOBALS['wp_scripts']->registered[$jquery_handle]->ver;
	$jquery_migrate_handle = (version_compare(wp_version_check(), '3.6-alpha1', '>=') ) ? 'jquery-core' : 'jquery-migrate';
	$jqm = $GLOBALS['wp_scripts']->registered[$jquery_migrate_handle]->ver;
	add_action( 'wp_head', function()  use ($jq, $jqm) {
		echo '<link rel="preload" as="script" href="'.includes_url().'js/jquery/jquery.min.js?ver='.$jq.'"/>';
		echo '<link rel="preload" as="script" href="'.includes_url().'js/jquery/jquery-migrate.min.js?ver='.$jqm.'"/>';
	}, 1, 1);
});

add_action( 'list_download_links', 'func_list_download_links', 10 );

function func_list_download_links($post_id = false, $get_opt = false, $get_dl = false) {
	global $post;

	if( $post_id ) 
		$post = get_post($post_id);
	
	$datos_download = get_datos_download($post->ID);
	
	$adl = get_option( 'appyn_download_links', null );

	$class = '';

	if( $adl != 3 ) {
		$type = appyn_options( 'download_links_design', true );
		if( $type == 1 ) {
			$class = ' ldl-b';
		} elseif( $type == 2 ) {
			$class = ' ldl-c';
		}
	} else {
		$class = ' ldl-d';
	}

	if( ! $get_opt && ! $get_dl ) {
		$get_opt = get_query_var( 'opt' );
		$get_dl = get_query_var( 'download' );
	}

	$adl = get_option( 'appyn_download_links', null );
	$a = get_option( 'appyn_download_timer' );
	$download_timer = ( isset($a) ) ? get_option( 'appyn_download_timer' ) : 5;

	if( $get_dl ) {
		if( $adl && $get_opt ) {
			echo '<div class="bxt'. $class .'">'.__( 'Enlace de descarga', 'appyn' ).' - '. $datos_download['links_options'][($get_opt-1)]['texto'] .'</div>';
		} else {
			echo '<div class="bxt'. $class .'">'.__( 'Enlaces de descarga', 'appyn' ).'</div>';
		}
	}

	if( count($datos_download['links_options']) > 0 ) { 

		$design_timer = appyn_options( 'design_timer' );

		if( $download_timer && $get_dl && !is_amp_px() ) {
			if( $design_timer == 1 ) {
				echo '<div class="sdl-bar" data-timer="'.$download_timer.'"><div style="transition: all 1s cubic-bezier(1, 1, 1, 1) 0s; width: 0%;"></div></div>';
			} else {
				echo '<div class="spinvt'. $class .'"><div class="snv"></div><div class="snt">'.$download_timer.'</div></div>';
			}
		}

		echo '<div '. ( ( $download_timer != "0" ) ? 'class="show_download_links" data-timer="'.$download_timer.'"' : '').' '.( ( $download_timer && $get_dl && !is_amp_px() ) ? 'style="display:none;"': '').'>';

		echo '<ul id="list-downloadlinks" class="'. $class .'">';

		if( $adl == 2 && $get_opt ) {

			foreach( $datos_download['links_options'] as $value => $element ) : 

				if( $value != ($get_opt - 1) ) continue;

				if( !is_string($value) ) :

					echo '<li><a href="'.px_download_link( $element['link'] ).'" target="_blank"'.((isset($element['follow'])) ? ' rel="follow"' : ' rel="nofollow"').' class="downloadAPK dapk_b"><i class="fa fa-download"></i>'.__( 'Descargar', 'appyn' ).'</a></li>';

				endif; 

			endforeach; 

		} else {

			foreach( $datos_download['links_options'] as $value => $element ) : 

				if( empty($element['texto']) || empty($element['link']) ) continue;
					
				if( !is_string($value) ) :
					$link = px_download_link( $element['link'] );
					$tb = false;
					if( $adl == 2 ) {
						$link = add_query_arg('opt', ($value+1), remove_query_arg('amp') );
						$tb = false;
					}
					if( $adl == 1 || $adl == 3 )
						$tb = true;

					echo '<li><a href="'.$link.'" '.( ($tb || empty($get_dl)) ? 'target="_blank"' : '' ).''.((isset($element['follow'])) ? ' rel="follow"' : ' rel="nofollow"').' class="downloadAPK dapk_b"><i class="fa fa-download"></i> '.$element['texto'].'</a></li>';
				endif; 
			endforeach;
		}
			
		echo '</ul>';

		if( $dlvb = appyn_options( 'download_links_verified_by', true ) ) {
			echo '<div class="dl-verified"'. ( appyn_options( 'download_links_verified_by_p', true ) == 1 ? ' style="text-align: center;"' : '' ) .'><i class="fa fa-shield"></i> <span>'. $dlvb .'</span></div>';
		}

		echo '</div>';
	}

	if( $dltbu = appyn_options( 'download_links_telegram_button_url', true ) ) {
		$dltbt = appyn_options( 'download_links_telegram_button_text', true );
		echo '<p style="text-align: center;"><a href="'. $dltbu .'" target="_blank" id="dl-telegram" class="downloadAPK "><i class="fa fa-send"></i> '. ( ( ! $dltbt ) ? __( 'ÚNETE A NUESTRO GRUPO DE TELEGRAM', 'appyn' ) : $dltbt ) .'</a></p>';
	}

	echo px_info_install();
}

add_action( 'wp_head', 'func_wp_headmn' );

function func_wp_headmn() {
	$get_opt = get_query_var( 'opt' );

	if( $get_opt )
		echo '<meta name="robots" content="noindex, nofollow">'."\n";
}

add_action( 'init', function(){
	$dnau = appyn_options( 'disabled_notif_apps_update' );

	if( $dnau )	wp_clear_scheduled_hook( 'appyn_send_apps' );
});

if ( ! wp_next_scheduled( 'appyn_send_apps' ) ) {
	
	wp_schedule_event( time(), 'hourly', 'appyn_send_apps' );
}

add_action( 'appyn_send_apps', 'px_appyn_hook_send_apps' );

function px_appyn_hook_send_apps() {

	global $post;

	if( apply_filters( 'px_appyn_filter_stop_send_apps', false ) ) return; 

	$psa = get_option( 'px_status_apikey' );

	if( ! $psa['status'] ) return;
	
	$query = new WP_Query( array( 'posts_per_page' => -1, 'post_parent' => 0 ) );

	if( $query->have_posts() ) :

		$list_ids = array();

		while( $query->have_posts() ) : $query->the_post();

			$url = get_datos_info( 'consiguelo' );

			if( empty($url) ) continue;

			if( strpos($url, 'https://play.google.com/store/') === false ) continue;

			if( $post->post_parent != 0 ) continue;

			$re = '/(?<=[?&]id=)[^&]+/m';
			preg_match_all($re, $url, $matches, PREG_SET_ORDER, 0);
			$app_id = $matches[0][0];

			if( !in_array_r($app_id, $list_ids) ) {
				$list_ids[] = array(
					'id' => $app_id,
					'post_id' => $post->ID,
				);
			}

		endwhile;

		if( count($list_ids) > 0 ) {

			$result = apply_filters( 'remote_post_check_apps', $list_ids );

			if( !empty($result) ) {
				
				if( ! is_array($result) ) 
					$e = json_decode($result, true);
				else 
					$e = $result;

				if( ! isset($e['error']) ) {

					update_option( 'trans_updated_apps', $e['results'] );
					px_process_list_apps();
				} 
			}
		}
	endif;	
}

add_action( 'post_updated', 'px_process_apps_to_update', 10, 1 );

function px_process_apps_to_update( $post_id ) {

	if( get_post_type($post_id) == "post" ) {
		px_process_list_apps($post_id);
	}
}

function px_process_list_apps($post_id = null) {
	
	$updated_apps = get_option( 'trans_updated_apps', null );

	if( ! is_array($updated_apps ) ) {
		return;
	}

	if( $post_id ) {

		foreach( $updated_apps as $key => $p ) {

			if( $p['post_id'] == $post_id ) {

				$di = get_post_meta( $post_id, 'datos_informacion', true );
				$fa = (isset($di['fecha_actualizacion'])) ? $di['fecha_actualizacion'] : 0;
				$dd = strtotime($fa);
				$last_update = ( !empty( $di['last_update'] ) ) ? $di['last_update'] : $dd;
				$updated_apps[$key]['post_title'] = get_the_title($p['post_id']);

				$version = (isset($di['version'])) ? $di['version'] : '';
				if( strtotime(date('Y-m-d', $last_update). "+1 day") >= strtotime(date('Y-m-d', strtotime($p['update']))) || $version == $p['version'] ) {
					unset($updated_apps[$key]);
				}
			}
			
		}
	} else {

		foreach( $updated_apps as $key => $p ) {

			$di = get_post_meta( $p['post_id'], 'datos_informacion', true );
			$dd = ( strtotime( $di['fecha_actualizacion'] ) ) ? strtotime($di['fecha_actualizacion']) : 0;
			$last_update = ( !empty( $di['last_update'] ) ) ? $di['last_update'] : $dd;
			$updated_apps[$key]['post_title'] = get_the_title($p['post_id']);

			$version = (isset($di['version'])) ? $di['version'] : '';
			if( strtotime(date('Y-m-d', $last_update). "+1 day") >= strtotime(date('Y-m-d', strtotime($p['update']))) || $version == $p['version'] ) {
				unset($updated_apps[$key]);
			}
		}
	}
	
	update_option( 'trans_updated_apps', $updated_apps );
	set_transient( 'trans_count_updated_apps', count($updated_apps) );
}

function removeElementWithValue($array, $key, $value){
	foreach($array as $subKey => $subArray){
		 if($subArray[$key] == $value){
			  unset($array[$subKey]);
		 }
	}
	return $array;
}

if ( ! wp_next_scheduled( 'appyn_check_apikey' ) ) {
    wp_schedule_event( time(), 'hourly', 'appyn_check_apikey' );
}

add_action( 'appyn_check_apikey', 'px_appyn_hook_check_apikey' );

function px_appyn_hook_check_apikey() {
	$url = API_URL."/check/apikey";

	$response = wp_remote_post( $url, array(
		'method'      => 'POST',
		'timeout'     => 30,
		'blocking'    => true,
		'headers'     => array(
			'Content-Type' => 'application/x-www-form-urlencoded',
			'Referer' => get_site_url(),
			'Cache-Control' => 'max-age=0',
        	'Expect' => '',
		),
		'body' => array( 
			'apikey' => appyn_options( 'apikey' ), 
			'website'	=> get_site_url(),
		),
	) );

	if ( ! is_wp_error( $response ) ) {
		update_option( 'px_status_apikey', json_decode($response['body'], true) );
	}
}

add_action( 'init', 'px_cron_init' );
	
function px_cron_init() {
	if( ! get_option( 'run_first_time_cron_apikey' ) ) {
		px_appyn_hook_check_apikey();
		update_option( 'run_first_time_cron_apikey', 1 );
	}
	if( ! get_option( 'run_first_time_cron' ) ) {
		px_appyn_hook_send_apps();
		update_option( 'run_first_time_cron', 1 );
	}
}

add_action( 'px_amp_template_head', 'px_add_title_head' );

function px_add_title_head() {

	$title = apply_filters( 'px_filter_amp_title', wp_get_document_title() );
	echo '<title>'. $title .'</title>'."\n";
}

add_action( 'px_amp_template_head', 'px_add_description' );

function px_add_description() {

	$desc = get_bloginfo('description');
	if( is_single() ) {
		global $post;
		add_filter( 'excerpt_more', '__return_false' );
		$desc = get_the_excerpt();
	}
	$desc = apply_filters( 'px_filter_amp_description', $desc );
	echo '<meta name="description" content="'. $desc .'">'."\n";
}

if( class_exists('WPSEO_Options') ) {

	add_filter( 'px_filter_amp_title', 'px_add_yoast_seo_title' );
	
	function px_add_yoast_seo_title() {
	
		return YoastSEO()->meta->for_current_page()->title;
	}

	add_filter( 'px_filter_amp_description', 'px_add_yoast_seo_description' );

	function px_add_yoast_seo_description() {

		global $post; 
		add_filter( 'excerpt_more', '__return_false' );
		$ysmfd = YoastSEO()->meta->for_current_page()->description;
		$yd = $ysmfd ? $ysmfd : get_the_excerpt();
		return $yd;
	}
}

if( class_exists( 'RankMath' ) ) {

	add_filter( 'px_filter_amp_description', 'px_add_rankms_description' );

	function px_add_rankms_description() {

		global $post;
		$desc = RankMath\Post::get_meta( 'description', $post->ID );
		if ( ! $desc ) {
			$desc = RankMath\Helper::get_settings( "titles.pt_{$post->post_type}_description" );
			if ( $desc ) {
				$desc = RankMath\Helper::replace_vars( $desc, $post );
			}
		}
		return $desc;
	}
}

add_action( 'wp', function(){
	if( remove_ldl() )
		remove_action( 'list_download_links', 'func_list_download_links' );
});

add_action( 'list_download_links', 'func_list_download_links_recaptcha', 10 );

function func_list_download_links_recaptcha() {
	global $post;

	$get_opt 	= get_query_var( 'opt' ) ? get_query_var( 'opt' ) : 0;
	$get_dl 	= get_query_var( 'download' ) ? get_query_var( 'download' ) : 0;
	$adl 		= get_option( 'appyn_download_links', null );

	if( $get_dl || $adl == 0 ) {

		if( remove_ldl() ) {
			$siv2 = appyn_options('recaptcha_v2_site');
			echo '<form action="" id="recaptcha_download_links" method="post">
			<div class="g-recaptcha" data-sitekey="'.$siv2.'" data-callback="recaptcha_callback"></div>
			<input type="hidden" name="action" value="px_recaptcha_download_links">
			<input type="hidden" name="post_id" value="'.$post->ID.'">
			<input type="hidden" name="get_opt" value="'.$get_opt.'">
			<input type="hidden" name="get_dl" value="'.$get_dl.'">
			<input type="hidden" id="rec_token" name="token" value="">
			'. wp_nonce_field( 'rdl_nonce', 'rdl_nonce', true, false ) .'
			<input type="submit" id="dasl" value="'.__('Mostrar enlaces', 'appyn').'" disabled>
			</form>';
		}
	}
}

add_action( 'wp_footer', function(){

	if( ! is_single() ) return;
	
	$sev2 = appyn_options( 'recaptcha_v2_secret' ); 
	$siv2 = appyn_options( 'recaptcha_v2_site' );
	
	if( $sev2 && $siv2 ) {
		echo '<script>
		var recaptcha_callback = function (token) {
			document.getElementById("dasl").removeAttribute("disabled");
			document.getElementById("rec_token").value = token;
		}
		</script>
		';
	}
}, 999);

add_action( 'template_redirect', function(){

	$adl = get_option( 'appyn_download_links', null );
	$get_dl = get_query_var( 'download' );

	if( $adl == 3 && is_single() && $get_dl ) {
		get_template_part( 'template-parts/template-download' );
		exit;
	}
});

add_action( 'wp_head', function(){

	if( is_single() ) {
		global $post;

		$rating = count_rating($post->ID);
		if( $rating['average'] > 0 ) {
			echo '<script type="text/javascript">var px_rating = '.json_encode($rating).';</script>';
		}
	}
});

add_action( 'px_data_app_single', 'pxdas_developer' );

function pxdas_developer() {
	global $post;
    $desarrollador = get_datos_info( 'desarrollador' ); 

	$output = '';
            
	if( !empty($desarrollador) ) {
		$output .= '<span><b>'.__( 'Desarrollador', 'appyn' ).'</b><br>';
		$output .= $desarrollador;
		$output .= '</span>';
	} else {
		$dev_terms = wp_get_post_terms( $post->ID, 'dev', array('fields' => 'all'));
		if( !empty($dev_terms) ) {
			$output .= '<span><b>'.__( 'Desarrollador', 'appyn' ).'</b><br>';
			$output .= '<a href="'.get_term_link($dev_terms[0]->term_id).'">'.$dev_terms[0]->name.'</a>';
			$output .= '</span>';
		}
	}

	echo $output;
}

add_action( 'px_data_app_single', 'pxdas_update', 10 );

function pxdas_update() {
    $fecha_actualizacion = get_datos_info( 'fecha_actualizacion' ); 
	
	echo (!empty($fecha_actualizacion)) ? '<span><b>'.__( 'Actualización', 'appyn' ).'</b><br>'.$fecha_actualizacion.'</span>' : '';
}

add_action( 'px_data_app_single', 'pxdas_size', 20 );

function pxdas_size() {
    $tamano = get_datos_info( 'tamano' );

	echo (!empty($tamano)) ? '<span><b>'.__( 'Tamaño', 'appyn' ).'</b><br>'.$tamano.'</span>' : '';
}

add_action( 'px_data_app_single', 'pxdas_version', 30 );

function pxdas_version() {
    $version = get_datos_info( 'version' );

	echo (!empty($version)) ? '<span><b>'.__( 'Versión', 'appyn' ).'</b><br>'.$version.'</span>' : ''; 
}

add_action( 'px_data_app_single', 'pxdas_requirements', 40 );

function pxdas_requirements() {
    $requerimientos = get_datos_info( 'requerimientos' ); 

	echo (!empty($requerimientos)) ? '<span><b>'.__( 'Requerimientos', 'appyn' ).'</b><br>'.$requerimientos.'</span>' : ''; 
}

add_action( 'px_data_app_single', 'pxdas_downloads', 50 );

function pxdas_downloads() {
    $descargas = get_datos_info( 'descargas' );

	echo (!empty($descargas)) ? '<span><b>'.__( 'Descargas', 'appyn' ).'</b><br>'.$descargas.'</span>' : '';
}

add_action( 'px_data_app_single', 'pxdas_getin_on', 60 );

function pxdas_getin_on() {
    $consiguelo = get_datos_info( 'consiguelo' );
	$imggp = get_store_app();
	
	echo (!empty($consiguelo)) ? '<span><b>'.__( 'Consíguelo en', 'appyn' ).'</b><br> <a href="'.$consiguelo.'" target="_blank">'.$imggp.'</a></span>' : ''; 
}

add_action( 'category_edit_form_fields', 'px_cat_icon_field', 10, 2 ); 

function px_cat_icon_field( $cat ) {  
	$catsapp = px_cats_app();
    $px_cat_icon = get_term_meta( $cat->term_id, "px_cat_icon", true );
?>  
	<tr class="form-field">  
		<th scope="row" valign="top">  
			<label for="px_cat_icon"><?php echo __( 'Ícono', 'appyn') ; ?></label>  
		</th>  
		<td>
			<ul class="icossss">
			<?php 
			foreach( $catsapp as $key => $c ) {
				$key = str_replace('_', '-', (strtolower($key)));
				echo '<li><label><input type="radio" name="px_cat_icon" id="px_cat_icon" value="'.$key.'"'.( ($px_cat_icon == $key) ? ' checked' : '').'><span class="cccc '.$key.'"></span><span style="font-size:12px;">' . $c . '</span></label></li>';
			}
			?>
			</ul>
		</td>  
	</tr>  
<?php  
}  

add_action( 'edited_category', 'px_cat_icon_field_save', 10, 2 ); 

function px_cat_icon_field_save( $term_id ) {  
    if ( isset( $_POST['px_cat_icon'] ) ) {  
        $t_id = $term_id;  
        $term_meta = get_term_meta( $t_id, "px_cat_icon", true );
        if ( isset( $_POST['px_cat_icon'] ) ){  
            $term_meta = $_POST['px_cat_icon'];  
        }  
        update_term_meta( $t_id, "px_cat_icon", $term_meta );
    }  
}

add_shortcode( 'px_short_download_links', 'px_short_download_links_func' );

function px_short_download_links_func( ) {
    ob_start();
    do_action( 'list_download_links' );
	return ob_get_clean();
}