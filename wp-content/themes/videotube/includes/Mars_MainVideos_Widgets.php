<?php
/**
 * VideoTube Main Videos Widget
 * Add Main Videos Widget in Home Page, 2-3 column a other options is supported.
 * @author 		Toan Nguyen
 * @category 	Core
 * @version     1.0.0
 */
if( !defined('ABSPATH') ) exit;
if( !function_exists('Mars_MainVideos_Widgets') ){
	function Mars_MainVideos_Widgets() {
		register_widget('Mars_MainVideos_Widgets_Class');
	}
	add_action('widgets_init', 'Mars_MainVideos_Widgets');
}
class Mars_MainVideos_Widgets_Class extends WP_Widget{
	
	function __construct(){
		$widget_ops = array( 'classname' => 'mars-mainvideo-widgets', 'description' => __('VT Main Videos Widget', 'mars') );
	
		parent::__construct( 'mars-mainvideo-widgets' , __('VT Main Videos Widget', 'mars') , $widget_ops);
	}
	
	function widget( $args, $instance ){

		$title = !empty( $instance['title'] ) ? apply_filters('widget_title', $instance['title'] ) : '';
		$video_category = isset( $instance['video_category'] ) ? $instance['video_category'] : null;
		$video_tag = isset( $instance['video_tag'] ) ? $instance['video_tag'] : null;
		$video_date = isset( $instance['date'] ) ? $instance['date'] : null;
		$today = isset( $instance['today'] ) ? $instance['today'] : null;
		$thisweek = isset( $instance['thisweek'] ) ? $instance['thisweek'] : null;		
		$video_orderby = isset( $instance['video_orderby'] ) ? $instance['video_orderby'] : 'ID';
		$video_order = isset( $instance['video_order'] ) ? $instance['video_order'] : 'DESC';
		$widget_column = isset( $instance['widget_column'] ) ? absint( $instance['widget_column'] ) : 3;
		
		$tablet_columns = isset( $instance['tablet_columns'] ) ? (int)$instance['tablet_columns'] : 2;
		
		$tablet_columns = ceil(12/$tablet_columns);
		
		$mobile_columns = isset( $instance['mobile_columns'] ) ? (int)$instance['mobile_columns'] : 1;
		
		$mobile_columns = ceil(12/$mobile_columns);
		
		$thumbnail_size = isset( $instance['thumbnail_size'] ) ? $instance['thumbnail_size'] : 'video-category-featured';
		
		if( empty( $thumbnail_size ) ){
			$thumbnail_size  = 'video-category-featured';
		}
		
		$class_columns = ( 12%$widget_column == 0 ) ? 12/$widget_column : 4; 
		
		$video_rows = isset( $instance['rows'] ) ? absint( $instance['rows'] ) : 1;
		$autoplay = isset( $instance['auto'] ) ? $instance['auto'] : null;		
		$video_shows = isset( $instance['video_shows'] ) ? (int)$instance['video_shows'] : 16;  
		$icon	= isset( $instance['icon'] ) && !empty( $instance['icon'] ) ? esc_attr( $instance['icon'] ) : 'fa-play';
		$i=0;
		$videos_query = array(
			'post_type'	=>	'video',
			'showposts'	=>	$video_shows,
			'posts_per_page'	=>	$video_shows,
			'no_found_rows'	=>	true
		);
                       	
		if( $video_category ){
			$videos_query['tax_query'] = array(
				array(
					'taxonomy' => 'categories',
					'field' => 'id',
					'terms' => $video_category
				)		                       		
			);
		}
		if( $video_tag ){
			$videos_query['tax_query'][] = array(
				'taxonomy' => 'video_tag',
				'field' => 'slug',
				'terms' => explode(",", $video_tag)
			);
		}
		if( $video_orderby ){
			if( $video_orderby == 'views' ){
				$videos_query['meta_key'] = 'count_viewed';
				$videos_query['orderby']	=	'meta_value_num';
			}
			elseif( $video_orderby == 'likes' ){
				$videos_query['meta_key'] = 'like_key';
				$videos_query['orderby']	=	'meta_value_num';
			}			
			else{
				$videos_query['orderby'] = $video_orderby;	
			}
		}
		if( $video_order ){
			$videos_query['order']	=	$video_order;
		}
		if( $video_date ){
			$dateime = explode("-", $video_date);
			$videos_query['date_query'] = array(
				array(
					'year'  => isset( $dateime[0] ) ? $dateime[0] : null,
					'month' => isset( $dateime[1] ) ? $dateime[1] : null,
					'day'   => isset( $dateime[2] ) ? $dateime[2] : null,
				)
			);
		}
		
		if( !empty( $today ) ){
			$is_today = getdate();
			$videos_query['date_query'][]	= array(
				'year'  => $is_today['year'],
				'month' => $is_today['mon'],
				'day'   => $is_today['mday']
			);
		}
		if( !empty( $thisweek ) ){
			$videos_query['date_query'][]	= 	array(
				'year' => date( 'Y' ),
				'week' => date( 'W' )
			);
		}
		
		// Do not show the empty image.
		$videos_query['meta_query'][] = array(
			'key'	=>	'_thumbnail_id',
			'compare'	=>	'EXISTS'
		);
		
		$videos_query	=	apply_filters( 'mars_main_widget_args' , $videos_query, $this->id);
		$wp_query = new WP_Query( $videos_query );
		$colum = $widget_column;
		?>
			<?php if( $widget_column == 3 ):?>
          		<div id="carousel-latest-<?php print $this->id; ?>" class="carousel carousel-<?php print $this->id; ?> slide video-section video-section<?php print is_rtl() ? '-rtl' : 'ltr';?>" data-ride="carousel">
          	<?php elseif ( $widget_column == 2 ):?>
          		<div class="video-section">
          	<?php else:?>
          		<div id="carousel-latest-<?php print $this->id; ?>" class="carousel carousel-<?php print $this->id; ?> slide video-section video-section<?php print is_rtl() ? '-rtl' : 'ltr';?>" <?php if($video_shows>3):?> data-ride="carousel"<?php endif;?>>
          	<?php endif;?>
					<div class="section-header">
	          			<?php if( ! empty( $title ) ):?>
	          				<?php if( ! empty( $instance['view_more'] ) ):?>
                        		<h3><?php if( $icon != 'none'):?><i class="fa <?php print $icon;?>"></i><?php endif;?> <a href="<?php print esc_url( $instance['view_more'] );?>"><?php print $title;?></a></h3>
                        	<?php else:?>
                        		<h3><?php if( $icon != 'none'):?><i class="fa <?php print $icon;?>"></i><?php endif;?> <?php print $title;?></h3>
                        	<?php endif;?>
                        <?php endif;?>
                        <?php if( $widget_column != 2 ):?>
				            <?php if( $video_shows >= $wp_query->post_count && $video_shows > $colum*$video_rows ):?>
					            <ol class="carousel-indicators section-nav">
					            	<li data-target="#carousel-latest-<?php print $this->id; ?>" data-slide-to="0" class="bullet active"></li>
					                <?php 
					                	$c = 0;
					                	for ($j = 1; $j < $wp_query->post_count; $j++) {
					                		if ( $j % ($colum*$video_rows) == 0 && $j < $video_shows ){
						                    	$c++;
						                    	print '<li data-target="#carousel-latest-'.$this->id.'" data-slide-to="'.$c.'" class="bullet"></li> '; 
						                    }
					                	}
					                ?>				          
					            </ol>
				            <?php endif;?>
	                    <?php else:?>
	                    	<?php if( $instance['view_more'] ):?>
								<div class="section-nav">
									<a href="<?php print esc_url( $instance['view_more'] );?>" class="viewmore"><?php _e('View More','mars');?> <i class="fa fa-angle-double-right"></i></a>
								</div>
							<?php endif;?>
	                    <?php endif;?>
                    </div>
					<!-- 2 columns -->
                   	<?php if( $widget_column == 2 ):?>
                   		<div class="row">
	                   		<div class="col-md-12">
		                   		<?php if( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post();?>                	
								<div class="col-md-<?php echo esc_attr( $class_columns );?> col-sm-<?php echo esc_attr( $tablet_columns );?> col-xs-<?php echo esc_attr( $mobile_columns );?> item responsive-height">
									<div class="item-img">
									<?php 
										if(has_post_thumbnail()){
											print '<a href="'.get_permalink().'" title="'.get_the_title().'">'. get_the_post_thumbnail(null,$thumbnail_size, array('class'=>'img-responsive')) . '</a>';
										}
		                                ?>
										<a href="<?php echo get_permalink(get_the_ID()); ?>"><div class="img-hover"></div></a>
									</div>                                
									<h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
									<?php do_action( 'mars_video_meta' );?>
								</div>
								<?php endwhile;endif;?>
							</div>
						</div>
                    <?php elseif ( $widget_column ==1 ):?>
					<!-- 1 colum -->
                    <div class="gaming-wrapper">
                       	<div class="carousel-inner carousel-<?php print $this->id;?>">
	                       	<?php
	                       	if( $wp_query->have_posts() ) : 
		                       	while ( $wp_query->have_posts() ) : $wp_query->the_post();
		                       	$i++;
		                       	?>
		                       	<?php if( $i ==1 ):?>
		                       		<div class="item active">
		                       	<?php endif;?>
                                    <div class="row">
                                        <div class="col-md-5 item list">
                                        	 <div class="item-img">
                                        	<?php 
                                        		if( has_post_thumbnail() ){
                                        			print '<a href="'.get_permalink().'" title="'.get_the_title().'">'. get_the_post_thumbnail(null,$thumbnail_size, array('class'=>'img-responsive')) . '</a>';
                                        		}
                                        	?>
                                        		<a href="<?php echo get_permalink(get_the_ID()); ?>"><div class="img-hover"></div></a>
                                        	</div>                                        	
                                        </div>
                                        <div class="col-md-7 item list <?php print $this->id; ?>-<?php print get_the_ID();?>">
                                            <h3><a title="<?php the_title();?>" href="<?php the_permalink();?>"><?php the_title();?></a></h3>
											<?php do_action( 'mars_video_meta' );?>
                                            <?php the_excerpt();?> 
                                            <p>
                                            	<?php if( !is_rtl() ):?>
                                            		<a href="<?php the_permalink();?>"><i class="fa fa-play-circle"></i><?php _e('Watch Video','mars')?></a>
                                            	<?php else:?>
                                            		<a href="<?php the_permalink();?>"><?php _e('Watch Video','mars')?> <i class="fa fa-play-circle"></i></a>
                                            	<?php endif;?>
                                            </p>
                                        </div>
                                    </div>
				                    <?php
				                    if ( $i % $video_rows == 0 && $i < $video_shows ){
				                    	?></div><div class="item"><?php 
				                    } 
			                       	endwhile;
				                      ?></div>
				             <?php endif;?>
				             </div>
			         </div>
					<!-- end 1 colum -->
				  <!-- 4/6 columns -->
                   <?php else:?>
	                    <div class="latest-wrapper">
	                    	<div class="row">
	                    		<div class="col-md-12">
				                     <div class="carousel-inner">
				                       	<?php
				                       	if( $wp_query->have_posts() ) : 
				                       		$i =0;
					                       	while ( $wp_query->have_posts() ) : $wp_query->the_post();
					                       	$i++;
					                       	?>
					                       	<?php if( $i == 1 ):?>
					                       		<div class="item active">
					                       	<?php endif;?>	
					                       		<div id="video-main-<?php print $this->id; ?>-<?php the_ID();?>" class="col-md-<?php print $class_columns;?> col-sm-<?php echo esc_attr( $tablet_columns );?> col-xs-<?php echo esc_attr( $mobile_columns );?> item responsive-height video-<?php print get_the_ID();?>">
					                                <div class="item-img">
														<?php 
															if(has_post_thumbnail()){
																print '<a title="'.get_the_title().'" href="'.get_permalink(get_the_ID()).'">'. get_the_post_thumbnail(null,$thumbnail_size, array('class'=>'img-responsive')) .'</a>';
															}
														?>
														<a href="<?php echo get_permalink(get_the_ID()); ?>"><div class="img-hover"></div></a>
													</div>
		                                            <h3><a title="<?php the_title();?>" href="<?php the_permalink();?>"><?php the_title();?></a></h3>
													<?php do_action( 'mars_video_meta' );?>
			                                     </div> 
						                    <?php
						                    if ( $i % ($widget_column*$video_rows) == 0 && $i < $video_shows ){
						                    	?></div><div class="item"><?php 
						                    }
					                       	endwhile;
					                      ?></div><?php 
				                       	endif;
				                       	?> 
				                	</div>
				                </div>
							</div>
	                    </div>
					
                    <?php endif;?>
                </div><!-- /#carousel-->
				<?php if( $autoplay == 'on' ):?>
				<script>
					(function($) {
					  "use strict";
					  	jQuery(document).ready(function() {
						  try {
							  jQuery('#carousel-latest-<?php print $this->id; ?>').carousel({
									 pause: false
								});
							  }
							  catch (e) {
								 console.log('Main Video carousel is not working');
							 }
						 })
					})(jQuery);
				</script>
				<?php endif;?>
		<?php 
		wp_reset_postdata();wp_reset_query();
	}
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['video_category'] = strip_tags( $new_instance['video_category'] );
		$instance['video_tag'] = strip_tags( $new_instance['video_tag'] );
		$instance['date'] = strip_tags( $new_instance['date'] );
		$instance['today']	=	esc_attr( $new_instance['today'] );
		$instance['thisweek']	=	esc_attr( $new_instance['thisweek'] );		
		$instance['video_orderby'] = strip_tags( $new_instance['video_orderby'] );
		$instance['video_order'] = strip_tags( $new_instance['video_order'] );
		$instance['widget_column'] = strip_tags( $new_instance['widget_column'] );
		$instance['tablet_columns'] = strip_tags( $new_instance['tablet_columns'] );
		$instance['mobile_columns'] = strip_tags( $new_instance['mobile_columns'] );
		$instance['thumbnail_size'] = strip_tags( $new_instance['thumbnail_size'] );
		$instance['video_shows'] = strip_tags( $new_instance['video_shows'] );
		$instance['rows'] = strip_tags( $new_instance['rows'] );
		$instance['auto'] = strip_tags( $new_instance['auto'] );
		$instance['view_more'] = strip_tags( $new_instance['view_more'] );
		return $instance;		
		
	}
	function form( $instance ){
		$defaults = array( 
			'title' => __('Latest Videos', 'mars'),
			'view_more'	=>	'',
			'today'		=>	'',
			'thisweek'	=>	'',
			'tablet_columns'	=>	2,
			'mobile_columns'	=>	1,
			'thumbnail_size'	=>	''
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'mars'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>			
		<p>  
		    <label for="<?php echo $this->get_field_id( 'video_category' ); ?>"><?php _e('Video Category:', 'mars'); ?></label>
		    	<?php 
					wp_dropdown_categories($args = array(
							'show_option_all'    => 'All',
							'orderby'            => 'ID', 
							'order'              => 'ASC',
							'show_count'         => 1,
							'hide_empty'         => 1, 
							'child_of'           => 0,
							'echo'               => 1,
							'selected'           => isset( $instance['video_category'] ) ? $instance['video_category'] : null,
							'hierarchical'       => 0, 
							'name'               => $this->get_field_name( 'video_category' ),
							'id'                 => $this->get_field_id( 'video_category' ),
							'taxonomy'           => 'categories',
							'hide_if_empty'      => true,
							'class'              => 'postform mars-dropdown',
			    		)
		    		);
		    	?>
		</p>
		<p>  
		    <label for="<?php echo $this->get_field_id( 'video_tag' ); ?>"><?php _e('Video Tag:', 'mars'); ?></label>
		    <input placeholder="<?php _e('Eg: tag1,tag2,tag3','mars');?>" id="<?php echo $this->get_field_id( 'video_tag' ); ?>" name="<?php echo $this->get_field_name( 'video_tag' ); ?>" value="<?php echo ( isset( $instance['video_tag'] ) ? $instance['video_tag'] : null ); ?>" style="width:100%;" />
		</p>
		<p>  
		    <label for="<?php echo $this->get_field_id( 'date' ); ?>"><?php _e('Date (Show posts associated with a certain time, (yyyy-mm-dd)):', 'mars'); ?></label>
		    <input class="vt-datetime" id="<?php echo $this->get_field_id( 'date' ); ?>" name="<?php echo $this->get_field_name( 'date' ); ?>" value="<?php echo ( isset( $instance['date'] ) ? $instance['date'] : null ); ?>" style="width:100%;" />
		</p>
		<p>  
			<label><?php _e('Display the post today','mars')?></label>
			<input <?php checked( 'on', $instance['today'], true );?> type="checkbox" id="<?php echo $this->get_field_id( 'today' ); ?>" name="<?php echo $this->get_field_name( 'today' ); ?>"/>
			<label><?php _e('Or this week','mars')?></label>
			<input <?php checked( 'on', $instance['thisweek'], true );?> type="checkbox" id="<?php echo $this->get_field_id( 'thisweek' ); ?>" name="<?php echo $this->get_field_name( 'thisweek' ); ?>"/>
			<br/>
			<small><?php _e('Do not choose two options.','mars')?></small>
		</p>		
		<p>  
		    <label for="<?php echo $this->get_field_id( 'video_orderby' ); ?>"><?php _e('Orderby:', 'mars'); ?></label>
		    <select style="width:100%;" id="<?php echo $this->get_field_id( 'video_orderby' ); ?>" name="<?php echo $this->get_field_name( 'video_orderby' ); ?>">
		    	<?php 
		    		foreach ( post_orderby_options('video') as $key=>$value ){
		    			$selected = ( $instance['video_orderby'] == $key ) ? 'selected' : null;
		    			?>
		    				<option <?php print $selected; ?> value="<?php print $key;?>"><?php print $value;?></option>
		    			<?php 
		    		}
		    	?>
		    </select>  
		</p>
		<p>  
		    <label for="<?php echo $this->get_field_id( 'video_order' ); ?>"><?php _e('Order:', 'mars'); ?></label>
		    <select style="width:100%;" id="<?php echo $this->get_field_id( 'video_order' ); ?>" name="<?php echo $this->get_field_name( 'video_order' ); ?>">
		    	<?php 
		    		foreach ( $this->widget_video_order() as $key=>$value ){
		    			$selected = ( $instance['video_order'] == $key ) ? 'selected' : null;
		    			?>
		    				<option <?php print $selected; ?> value="<?php print $key;?>"><?php print $value;?></option>
		    			<?php 
		    		}
		    	?>
		    </select>  
		</p>								 
		<p>  
		    <label for="<?php echo $this->get_field_id( 'widget_column' ); ?>"><?php _e('Desktop Columns:', 'mars'); ?></label>
		    <select style="width:100%;" id="<?php echo $this->get_field_id( 'widget_column' ); ?>" name="<?php echo $this->get_field_name( 'widget_column' ); ?>">
		    	<?php 
		    		foreach ( $this->widget_video_column() as $key=>$value ){
		    			$selected = ( $instance['widget_column'] == $key ) ? 'selected' : null;
		    			?>
		    				<option <?php print $selected; ?> value="<?php print $key;?>"><?php print $value;?></option>
		    			<?php 
		    		}
		    	?>
		    </select>
		</p>
		<p>  
		    <label for="<?php echo $this->get_field_id( 'tablet_columns' ); ?>"><?php _e('Tablet Columns:', 'mars'); ?></label>
		    <select style="width:100%;" id="<?php echo $this->get_field_id( 'tablet_columns' ); ?>" name="<?php echo $this->get_field_name( 'tablet_columns' ); ?>">
		    	<?php 
		    		foreach ( $this->widget_video_column() as $key=>$value ){
		    			$selected = ( $instance['tablet_columns'] == $key ) ? 'selected' : null;
		    			?>
		    				<option <?php print $selected; ?> value="<?php print $key;?>"><?php print $value;?></option>
		    			<?php 
		    		}
		    	?>
		    </select>
		</p>		
		<p>  
		    <label for="<?php echo $this->get_field_id( 'mobile_columns' ); ?>"><?php _e('Mobile Columns:', 'mars'); ?></label>
		    <select style="width:100%;" id="<?php echo $this->get_field_id( 'mobile_columns' ); ?>" name="<?php echo $this->get_field_name( 'mobile_columns' ); ?>">
		    	<?php 
		    		foreach ( $this->widget_video_column() as $key=>$value ){
		    			$selected = ( $instance['mobile_columns'] == $key ) ? 'selected' : null;
		    			?>
		    				<option <?php print $selected; ?> value="<?php print $key;?>"><?php print $value;?></option>
		    			<?php 
		    		}
		    	?>
		    </select>
		</p>
		<p>  
		    <label for="<?php echo $this->get_field_id( 'thumbnail_size' ); ?>"><?php _e('Thumbnail Size:', 'mars'); ?></label>
		    <input id="<?php echo $this->get_field_id( 'thumbnail_size' ); ?>" name="<?php echo $this->get_field_name( 'thumbnail_size' ); ?>" value="<?php echo esc_attr( $instance['thumbnail_size'] );?>" style="width:100%;" />
		    <span class="description">
		    	<?php 
		    		esc_html_e( 'Enter the custom image size of leave blank for default.', 'mars' );
		    	?>
		    </span>
		</p>		
		<p>  
		    <label for="<?php echo $this->get_field_id( 'video_shows' ); ?>"><?php _e('Shows:', 'mars'); ?></label>
		    <input id="<?php echo $this->get_field_id( 'video_shows' ); ?>" name="<?php echo $this->get_field_name( 'video_shows' ); ?>" value="<?php echo (isset( $instance['video_shows'] )) ? (int)$instance['video_shows'] : 16; ?>" style="width:100%;" />
		</p>
		<p>  
		    <label for="<?php echo $this->get_field_id( 'rows' ); ?>"><?php _e('Rows (Available with 3 or 1 Column):', 'mars'); ?></label>
		    <input id="<?php echo $this->get_field_id( 'rows' ); ?>" name="<?php echo $this->get_field_name( 'rows' ); ?>" value="<?php echo (isset( $instance['rows'] )) ? (int)$instance['rows'] : 1; ?>" style="width:100%;" />
		</p>
		<p>  
		    <label for="<?php echo $this->get_field_id( 'auto' ); ?>"><?php _e('Auto Carousel:', 'mars'); ?></label>
		    <input type="checkbox" id="<?php echo $this->get_field_id( 'auto' ); ?>" name="<?php echo $this->get_field_name( 'auto' ); ?>" <?php  print isset( $instance['auto'] ) && $instance['auto'] =='on' ? 'checked' : null;?> />
		</p>		
		<p>  
		    <label for="<?php echo $this->get_field_id( 'view_more' ); ?>"><?php _e('View more link', 'mars'); ?></label>
		    <input id="<?php echo $this->get_field_id( 'view_more' ); ?>" name="<?php echo $this->get_field_name( 'view_more' ); ?>" value="<?php echo ( isset( $instance['view_more'] ) ? $instance['view_more'] : null ); ?>" style="width:100%;" />
		</p>
	<?php
	}
	function widget_video_column(){
		return array(
			'6'	=>	__('6 Columns','mars'),
			'4'	=>	__('4 Columns','mars'),
			'3'	=>	__('3 Columns','mars'),
			'2'	=>	__('2 Columns','mars'),
			'1'	=>	__('1 Column','mars'),
		);
	}
	function widget_video_order(){
		return array(
			'DESC'	=>	__('DESC','mars'),
			'ASC'	=>	__('ASC','mars')
		);
	}	
}