<?php
if( !defined('ABSPATH') ) exit;
$item_classes = array( 'item', 'responsive-height' );
$item_classes[] = 'col-md-' . mars_get_columns( 'desktop' );
$item_classes[] = 'col-sm-' . mars_get_columns( 'tablet' );
$item_classes[] = 'col-xs-' . mars_get_columns( 'mobile' );
?>

<div class="<?php echo esc_attr( join(" ", $item_classes) ); ?>">
	<div class="item-img">
		<?php 
			if( has_post_thumbnail() ){
				$thumbnail_size = mars_convert_columns_to_thumbnail_size();
				print '<a href="'.get_permalink(get_the_ID()).'">'. get_the_post_thumbnail(null,$thumbnail_size, array('class'=>'img-responsive')) . '</a>';
			}
		?>
		<?php if( get_post_type() == 'video' ):?>
			<a href="<?php echo get_permalink(get_the_ID()); ?>"><div class="img-hover"></div></a>
		<?php endif;?>
	</div>
	<h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
	<?php do_action( 'mars_video_meta' );?>
</div>