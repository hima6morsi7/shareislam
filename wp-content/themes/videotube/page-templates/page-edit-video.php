<?php if( !defined('ABSPATH') ) exit;?>
<?php get_header(); ?>
	<div class="container">
		<?php if ( function_exists('yoast_breadcrumb') ) {
			yoast_breadcrumb('<p id="breadcrumbs">','</p>');
		} ?>	
		<div class="row">
			<div class="col-md-8">
				 <div <?php post_class();?>>
				 	<?php 
				 		echo do_shortcode( '[videotube_upload id="'.get_the_ID().'"]' );
				 	?>
                </div><!-- /.post -->	
			</div>
			<?php get_sidebar();?>
		</div><!-- /.row -->
	</div><!-- /.container -->
<?php get_footer();?>