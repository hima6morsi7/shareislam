<?php 
	/*
	 * This file is used to generate single post page.
	 */	
get_header(); ?>
<?php
		// Sidebar check and class
		$sidebar = get_post_meta($post->ID,'post-option-sidebar-template',true);
		global $default_post_sidebar;
		if( empty( $sidebar ) ){ $sidebar = $default_post_sidebar; }
		if( $sidebar == "left-sidebar" || $sidebar == "right-sidebar"){
			$sidebar_class = "sidebar-included " . $sidebar;
		}else if( $sidebar == "both-sidebar" ){
			$sidebar_class = "both-sidebar-included";
		}else{
			$sidebar_class = '';
		}

	?>

	<section class="content-separator"></section>
    
        <section class="page-body-outer">
			<section class="page-body-wrapper container mt30">
					<div class="content-wrapper <?php echo $sidebar_class; ?>">
					  <?php
							$left_sidebar = get_post_meta( $post->ID , "post-option-choose-left-sidebar", true);
							$right_sidebar = get_post_meta( $post->ID , "post-option-choose-right-sidebar", true);
							global $default_post_left_sidebar, $default_post_right_sidebar;
							if( empty( $left_sidebar )){ $left_sidebar = $default_post_left_sidebar; } 
							if( empty( $right_sidebar )){ $right_sidebar = $default_post_right_sidebar; } 
					   ?>
					<div class='cp-page-float-left'>
						<div class='cp-page-item'>
							<?php 
								if ( have_posts() ){ while (have_posts()){ the_post();

										echo '<section class="sixteen columns mt0">';	
											echo '<article class="blog_single_post">';
												// Inside Thumbnail
												if( $sidebar == "left-sidebar" || $sidebar == "right-sidebar" ){
													$item_size = "630x200";
												}else if( $sidebar == "both-sidebar" ){
													$item_size = "450x140";
												}else{
													$item_size = "930x300";
												} 
												
												$inside_thumbnail_type = get_post_meta($post->ID, 'post-option-inside-thumbnail-types', true);
												
												switch($inside_thumbnail_type){
												
													case "Image" : 
													
														$thumbnail_id = get_post_meta($post->ID,'post-option-inside-thumbnial-image', true);
														$thumbnail = wp_get_attachment_image_src( $thumbnail_id , $item_size );
														$thumbnail_full = wp_get_attachment_image_src( $thumbnail_id , 'full' );
														$alt_text = get_post_meta($thumbnail_id , '_wp_attachment_image_alt', true);
														
														if( !empty($thumbnail) ){
															echo '<div class="blog-thumbnail-image">';
																echo '<a href="' . $thumbnail_full[0] . '" data-rel="prettyPhoto" title="' . get_the_title() . '" ><img src="' . $thumbnail[0] .'" alt="'. $alt_text .'"/></a>'; 
															echo '</div>';
														}
														break;
														
													case "Video" : 
													
														$video_link = get_post_meta($post->ID,'post-option-inside-thumbnail-video', true);
														echo '<div class="blog-thumbnail-video">';
															echo get_video($video_link, cp_get_width($item_size), '400');
														echo '</div>';				
														break;
														
													case "Slider" : 
													
														$slider_xml = get_post_meta( $post->ID, 'post-option-inside-thumbnail-xml', true); 
														$slider_xml_dom = new DOMDocument();
														$slider_xml_dom->loadXML($slider_xml);
														
														echo '<div class="blog-thumbnail-slider">';
															echo print_flex_slider($slider_xml_dom->documentElement, $item_size);
														echo '</div>';					
														break;
														
												}
												
												// Single header
												echo '<h1 class="single-thumbnail-title post-title-color cp-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a><span class="h-line"></span></h1>';
												echo "<div class='blog-thumbnail-content'>";
															echo the_content();
															wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'cp_front_end' ) . '</span>', 'after' => '</div>' ) );
												echo "</div>";
												echo '<div class="single-thumbnail-info post-info-color cp-divider">';
														echo '<ul>';
															echo '<li class="single-thumbnail-date">' . get_the_time( GDL_DATE_FORMAT ) . '</li>';
															echo '<li class="single-thumbnail-author"> ' . __('by','cp_front_end') . ' ' . get_the_author_link() . '</li>';
															echo '<li class="single-thumbnail-comment">';
															comments_popup_link( __('0 Comment','cp_front_end'),
																__('1 Comment','cp_front_end'),
																__('% Comments','cp_front_end'), '',
																__('Comments are off','cp_front_end') );
															echo '</li>';
															the_tags('<li class="single-thumbnail-tag">', ', ', '</li>');
														echo '</ul>';
												echo '</div>';
												echo '<div class="clear"></div>';
										  echo '</article>';
										
										// About Author
										if(get_post_meta($post->ID, 'post-option-author-info-enabled', true) == "Yes"){
										 cp_get_author_box();
										}
										
										// Include Social Shares
										if(get_post_meta($post->ID, 'post-option-social-enabled', true) == "Yes"){
											echo "<div class='social-share-title cp-link-title cp-title'>";
												echo __('Social Share','cp_front_end');
											echo "</div>";
												include_social_shares();
											echo "<div class='clear'></div>";
										}
									
										echo '<div class="comment-wrapper">';
											comments_template(); 
										 echo '</div>';
										 
									 echo "</section>"; // sixteen-columns
										
									}
								}
							?>
					  </div> <!-- cp-page-item-end -->
					  
						   <?php 	
								get_sidebar('left');	
									echo "</div>";
								get_sidebar('right');
							?>
						
					</div> <!--cp-page-float-left-end-->
		</section>
  </section>
<?php get_footer(); ?>