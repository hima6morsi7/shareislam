<?php if( !defined('ABSPATH') ) exit;?>
<?php get_header(); ?>
	<div class="container">
		<?php if ( function_exists('yoast_breadcrumb') ) {
			yoast_breadcrumb('<p id="breadcrumbs">','</p>');
		} ?>	
		<div class="row">
			<div class="col-md-8 col-sm-12 main-content">
  
				<?php if( have_posts() ):?>
				<div class="row video-section meta-maxwidth-230">	
	          		<div class="section-header">
						<?php the_archive_title( '<h1 class="page-title">', '</h1>' )?>
	                    <?php do_action('mars_orderblock_videos');?>
	                </div>				
					<?php 
						while ( have_posts() ) : the_post();
						
							get_template_part( 'loop', 'video' );
						
						endwhile;
					?>
				</div>
				<?php do_action( 'mars_pagination', null );?>
                <?php else:?>
                	<div class="alert alert-info"><?php _e('Oops...nothing.','mars')?></div>
                <?php endif;?>
			</div>
			<?php get_sidebar();?>
		</div><!-- /.row -->
	</div><!-- /.container -->
<?php get_footer();?>