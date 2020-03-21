<?php if( !defined('ABSPATH') ) exit;?>
<?php get_header();
global $post, $videotube;
$guestlike = isset( $videotube['guestlike'] ) ? $videotube['guestlike'] : 1;
the_post();
$layout = get_post_meta($post->ID,'layout',true) ? get_post_meta($post->ID,'layout',true) : 'small';
$layout = apply_filters( 'mars_video_single_layout' , $layout);
?>
	<?php if( $layout == 'large' ):?>
		<div class="video-wrapper">
			<div class="container">
				<div class="video-info large">
	                <?php 
	                /**
	                 * videotube_before_video_title action.
	                 */
	                do_action( 'videotube_before_video_title' );
	                ?>				
	                <h1><?php the_title();?></h1>
	                <?php 
	                /**
	                 * videotube_after_video_title action.
	                 */
	                do_action( 'videotube_after_video_title' );
	                ?>
	                <?php if( mars_get_count_viewed() > 1 ):?>
	                	<span class="views"><i class="fa fa-eye"></i><?php print apply_filters( 'postviews' , mars_get_count_viewed() );?></span>
	                <?php endif;?>
	                <a href="#" class="likes-dislikes" data-action="like" id="<?php print get_the_ID();?>">
	                	<span class="likes"><i class="fa fa-thumbs-up"></i>
	                		<label class="like-count likevideo<?php print get_the_ID();?>">
	                			<?php if(function_exists('mars_get_like_count')) {
                            		echo apply_filters( 'postlikes' , mars_get_like_count($post->ID) );
                            	} ?>
	                		</label>
	                	</span>
	                </a>
	            </div>
                <?php 
                /**
                 * videotube_before_video action.
                 */
                do_action( 'videotube_before_video' );
                
                ?>
                <div class="player player-large <?php echo esc_attr( mars_get_video_aspect_ratio() );?>">
                	<?php 
					/**
					 * mediapress_media action.
					 * hooked mediapress_get_media_object, 10, 1
					 */
					do_action( 'mediapress_media', get_the_ID() );
					?>
                </div>
				<?php
				/**
				 * mediapress_media_pagination action.
				 * hooked mediapress_get_media_pagination, 10, 1
				 */
				do_action( 'mediapress_media_pagination', get_the_ID() );
				?>
                <?php 
                /**
                 * videotube_after_video action.
                 */
                do_action( 'videotube_after_video' );
                ?>	                
                <div id="lightoff"></div>
			</div>
		</div>
	<?php endif;?>
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-sm-12 main-content">
				<?php if( $layout == 'small' ):?>
	            	<div class="video-info small">
		                <?php 
		                /**
		                 * videotube_before_video_title action.
		                 */
		                do_action( 'videotube_before_video_title' );
		                ?>	            	
	                    <h1><?php the_title();?></h1>
		                <?php 
		                /**
		                 * videotube_after_video_title action.
		                 */
		                do_action( 'videotube_after_video_title' );
		                ?>
		                <?php if( mars_get_count_viewed() > 1 ):?>
		                	<span class="views"><i class="fa fa-eye"></i><?php print apply_filters( 'postviews' , mars_get_count_viewed() );?></span>
		                <?php endif;?>
		                <a href="#" class="likes-dislikes" data-action="like" id="<?php print $post->ID;?>">
		                	<span class="likes"><i class="fa fa-thumbs-up"></i>
		                		<label class="like-count likevideo<?php print $post->ID;?>">
                            		<?php if(function_exists('mars_get_like_count')) {
                            			echo apply_filters( 'postlikes' , mars_get_like_count($post->ID) );
                            		} ?>
		                		</label>
		                	</span>
		                </a>
	                </div>
	                <?php 
	                /**
	                 * videotube_before_video action.
	                 */
	                do_action( 'videotube_before_video' );
	                ?>		                
	                <div class="player player-small <?php echo esc_attr( mars_get_video_aspect_ratio() );?>">
	                	<?php 
						/**
						 * mediapress_media action.
						 * hooked mediapress_get_media_object, 10, 1
						 */
						do_action( 'mediapress_media', get_the_ID() );
						?>
	                </div>
					<?php
					/**
					 * mediapress_media_pagination action.
					 * hooked mediapress_get_media_pagination, 10, 1
					 */
					do_action( 'mediapress_media_pagination', get_the_ID() );
					?>	                
	                <?php 
	                /**
	                 * videotube_after_video action.
	                 */
	                do_action( 'videotube_after_video' );
	                ?>	                
	                <div id="lightoff"></div>
				<?php endif;?>
				<?php 
					$defaults = array(
						'before' => '<ul class="pagination">',
						'after' => '</ul>',
						'before_link' => '<li>',
						'after_link' => '</li>',
						'current_before' => '<li class="active">',
						'current_after' => '</li>',
						'previouspagelink' => '&laquo;',
						'nextpagelink' => '&raquo;'
					);  
					bootstrap_link_pages( $defaults );
				?>				
            	<div class="row video-options">
                    <div class="col-sm-3 col-xs-6 box-comment">
                        <a href="javascript:void(0)" class="option comments-scrolling">
                            <i class="fa fa-comments"></i>
                            <span class="option-text"><?php _e('Comments','mars')?></span>
                        </a>
                    </div>
                    
                    <div class="col-sm-3 col-xs-6 box-share">
                        <a href="javascript:void(0)" class="option share-button" id="off">
                            <i class="fa fa-share"></i>
                            <span class="option-text"><?php _e('Share','mars')?></span>
                        </a>
                    </div>
                    
                    <div class="col-sm-3 col-xs-6 box-like">
                        <a class="option likes-dislikes" href="#" data-action="like" id="<?php print $post->ID;?>" id="buttonlike" data-video="<?php print $post->ID;?>">
                            <i class="fa fa-thumbs-up"></i>
                            <span class="option-text likes-dislikes">
                            	<label class="like-count likevideo<?php print $post->ID;?>">
                            		<?php if(function_exists('mars_get_like_count')) {
                            			echo apply_filters( 'postlikes' , mars_get_like_count($post->ID) );
                            		} ?>
                            	</label>
                            </span>
                        </a>
                    </div>
                    <div class="col-sm-3 col-xs-6 box-turn-off-light">
						<!-- LIGHT SWITCH -->
						<a href="javascript:void(0)" class="option switch-button">
                            <i class="fa fa-lightbulb-o"></i>
							<span class="option-text"><?php _e('Turn off Light','mars')?></span>
                        </a>	
                    </div>
                </div>	
				<!-- IF SHARE BUTTON IS CLICKED SHOW THIS -->
				<?php
					$post_data = mars_get_post_data($post->ID); 
					$url_image = has_post_thumbnail() ? wp_get_attachment_url( get_post_thumbnail_id($post->ID)) : null;
					$current_url = get_permalink( $post->ID );
					$current_title = $post_data->post_title;
					
					$length = apply_filters( 'social_short_content_length' , 100 );
					
					if( $post_data->post_excerpt ){
						$current_short_content = wp_trim_words( $post_data->post_excerpt, $length, '' );
					}
					else{
						$current_short_content = wp_trim_words( $post_data->post_content , $length, '' );
					}
					
				?>
				<div class="row social-share-buttons">
					<div class="col-xs-12">
					
						<a target="_blank" href="<?php echo esc_url( add_query_arg( array( 'u' => $current_url ), 'https://www.facebook.com/sharer/sharer.php' ) );?>">
							<img src="<?php echo esc_url( get_template_directory_uri() );?>/img/facebook.png" alt="<?php echo esc_attr( esc_html__( 'Facebook', 'mars' ) );?>" />
						</a>
					
						<a target="_blank" href="<?php echo esc_url( add_query_arg( array( 'status' => $current_url ), 'https://twitter.com/home' ) );?>">
							<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/twitter.png" alt="<?php echo esc_attr( esc_html__( 'Twitter', 'mars' ) );?>" />
						</a>
						
						<a target="_blank" href="<?php echo esc_url( add_query_arg( array( 'url' => $current_url ), 'https://plus.google.com/share' ) );?>">
							<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/googleplus.png" alt="<?php echo esc_attr( esc_html__( 'Google plus', 'mars' ) );?>" />
						</a>
						
						<a target="_blank" href="<?php echo esc_url( add_query_arg( array( 'url' => $current_url, 'media' => $url_image, 'description' => $current_short_content ), 'https://pinterest.com/pin/create/button/' ) );?>">
							<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/pinterest.png" alt="<?php echo esc_attr( esc_html__( 'Pinterest', 'mars' ) );?>" />
						</a>
						
						<a target="_blank" href="<?php echo esc_url( add_query_arg( array( 'url' => $current_url ), 'http://www.reddit.com/submit' ) )?>">
							<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/reddit.png" alt="<?php echo esc_attr( esc_html__( 'Reddit', 'mars' ) );?>" />
						</a>
						
						<a target="_blank" href="<?php echo esc_url( add_query_arg( array( 'mini' => 'true', 'url' => $current_url, 'title' => $current_title, 'summary' => $current_short_content, 'source' => home_url('/') ), 'https://www.linkedin.com/shareArticle' ) );?>">
							<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/linkedin.png" alt="<?php echo esc_attr( esc_html__( 'Linkedin', 'mars' ) );?>" />
						</a>
						
						<a target="_blank" href="<?php echo esc_url( add_query_arg( array( 'st.cmd' => 'addShare', 'st._surl' => $current_url, 'title' => $current_title ), 'http://www.odnoklassniki.ru/dk' ) );?>">
							<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/odnok.png" alt="<?php echo esc_attr( esc_html__( 'Odnok', 'mars' ) );?>" />
						</a>
						
						<a target="_blank" href="<?php echo esc_url( add_query_arg( array( 'url' => $current_url ), 'http://vkontakte.ru/share.php' ) )?>">
							<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/vkontakte.png" alt="<?php echo esc_attr( esc_html__( 'Vkontakte', 'mars' ) );?>" />
						</a>						

						<a href="mailto:?Subject=<?php print esc_attr( $current_title );?>&Body=<?php printf( __('I saw this and thought of you! %s','mars'), esc_url( $current_url ) );?>">
							<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/email.png" alt="<?php echo esc_attr( esc_html__( 'Email', 'mars' ) );?>" />
						</a>
					</div>
				</div>
				<div class="video-details">
					<?php 
						$author = get_the_author_meta('display_name', mars_get_post_authorID($post->ID));
					?>
					<span class="date">
						<?php printf(
							__('Published on %s by %s','mars'), 
							get_the_date(), 
							'<a class="post-author" href="'.get_author_posts_url(get_the_author_meta('ID')).'">'.$author.'</a>' 
						);?>
					</span>
                    <div class="post-entry">
                    	<?php 
                    		$r = array(
                    			'embedCSS'			=>	false,
                    			'collapsedHeight'	=>	45,
                    			'moreLink'			=>	'<a class="read-more-js" href="#">
								'.esc_html__( 'Read more', 'mars' ).'
								<i class="fa fa-angle-double-down" aria-hidden="true"></i>
								</a>',
                    			'lessLink'			=>	'<a class="read-less-js" href="#">
								'.esc_html__( 'Read less', 'mars' ).'
								<i class="fa fa-angle-double-up" aria-hidden="true"></i>
								</a>'
                    		);
                    		$r = apply_filters( 'read_more_js' , $r );
                    	?>
                    	<?php if( $r ):?>
						<div class="content-more-js" data-settings="<?php echo esc_attr( json_encode( $r ) );?>">
							<?php the_content();?>
						</div>
						<?php else:?>
							<?php the_content();?>
						<?php endif;?>
                    </div>
                    
                    <?php if( mars_can_user_edit_video( get_the_ID() ) ):?>
                    	<div class="edit-post">
							<div class="btn-group">
								<a href="<?php echo esc_url( add_query_arg( array( 'action' => 'edit-video' ), get_permalink() ) );?>" class="btn btn-default btn-sm">
									<i class="fa fa-cog" aria-hidden="true"></i>
									<?php esc_html_e( 'Edit', 'mars' );?>
								</a>
							</div>
                    	</div>
                    <?php endif;?>
                    
                    <span class="meta"><?php print the_terms( $post->ID, 'categories', '<span class="meta-info">'.__('Category','mars').'</span> ', ' ' ); ?></span>
                    <span class="meta"><?php print the_terms( $post->ID, 'video_tag', '<span class="meta-info">'.__('Tag','mars').'</span> ', ' ' ); ?></span>
                </div>
				<?php dynamic_sidebar('mars-video-single-below-sidebar');?>
				<?php 
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
				?>
			</div>
			<?php get_sidebar();?>
		</div><!-- /.row -->
	</div><!-- /.container -->
<?php get_footer();?>
