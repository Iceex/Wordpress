<?php get_header(); ?>
	<div class="container">
		<div class="aplication-single" style="width: 100%;">
			<?php 
			if ( have_posts() ) : while ( have_posts() ) : the_post(); 	
				$get_download = get_query_var( 'download' );
			?>
				<div class="box<?php echo ($get_download == "true" || $get_download == "redirect" || $get_download == "links") ? ' box-download': ''; ?>">
					<?php
					if( $get_download ) { 
						get_template_part( 'template-parts/single-infoapp-get' );
					} else {
						get_template_part( 'template-parts/single-infoapp' );
					} 
					?>
					<div class="right s2 box-social">
						<?php echo px_botones_sociales(); ?>
					</div>
				</div>
				<?php 
				echo ads("ads_single_top"); 
				echo do_action( 'seccion_cajas' );
				wp_reset_query();
			endwhile; endif; ?>
		</div>
	</div>
<?php get_footer(); ?>