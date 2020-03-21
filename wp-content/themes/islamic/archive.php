<?php
/*
 * This file is used to generate WordPress standard archive/category pages.
 */
get_header ();
?>
		<?php
		$sidebar = get_option ( THEME_NAME_S . '_search_archive_sidebar', 'no-sidebar' );
		$sidebar_class = '';
		if ($sidebar == "left-sidebar" || $sidebar == "right-sidebar") {
			$sidebar_class = "sidebar-included " . $sidebar;
		} else if ($sidebar == "both-sidebar") {
			$sidebar_class = "both-sidebar-included";
		}
		   	$left_sidebar = "Search/Archive Left Sidebar";
			$right_sidebar = "Search/Archive Right Sidebar";
		?>
			<section class="content-separator"></section>
               <section class="page-body-outer">
						<section class="page-body-wrapper container mt30"> 
							<h1 class="cp-page-title cp-divider cp-title title-color mr10">
								<?php if (is_category()) { ?>
									<?php _e('Categories', 'crunchpress'); ?> : <?php echo single_cat_title(); ?>  
									<?php } elseif (is_day()) { ?>
									<?php _e('Archive for', 'crunchpress'); ?> <?php the_time('F jS, Y'); ?>
									<?php } elseif (is_month()) { ?>
									<?php _e('Archive for', 'crunchpress'); ?> <?php the_time('F, Y'); ?>
									<?php } elseif (is_year()) { ?>
									<?php _e('Archive for', 'crunchpress'); ?> <?php the_time('Y'); ?>
									<?php } elseif (is_author()) { ?>
									<?php _e('Archive by Author', 'crunchpress'); ?></span>
									<?php } elseif (is_search()) { ?>
									<?php _e('Search results for', 'crunchpress'); ?><?php get_search_query() ?></span>
									<?php } elseif (is_tag()) { ?>
									<?php _e('Tag Archives', 'crunchpress'); ?> : <?php echo single_tag_title('', true); ?>
								<?php } ?>
							<span class="h-line"></span></h1>
						<div class="content-wrapper <?php echo $sidebar_class; ?>">
							<?php
								$item_type = get_option ( THEME_NAME_S . '_search_archive_item_size', '1/1 Full Thumbnail' );
								$num_excerpt = get_option ( THEME_NAME_S . '_search_archive_num_excerpt', 200 );
								$full_content = get_option ( THEME_NAME_S . '_search_archive_full_blog_content', 'No' );
								
								global $blog_div_size_num_class;
								$item_class = $blog_div_size_num_class [$item_type] ['class'];
								$item_index = $blog_div_size_num_class [$item_type] ['index'];
								if ($sidebar == "no-sidebar") {
									$item_size = $blog_div_size_num_class [$item_type] ['size'];
								} else if ($sidebar == "left-sidebar" || $sidebar == "right-sidebar") {
									$item_size = $blog_div_size_num_class [$item_type] ['size2'];
								} else {
									$item_size = $blog_div_size_num_class [$item_type] ['size3'];
								}
								
								echo "<div class='cp-page-float-left'>";
									echo "<div class='cp-page-item'>";
											echo '<div id="blog-item-holder" class="blog-item-holder">';
														if ($item_type == '1/1 Full Thumbnail') {
															print_blog_full ( $item_class, $item_size, $item_index, $num_excerpt, $full_content );
														} else if ($item_type == '1/1 Medium Thumbnail') {
															print_blog_medium ( $item_class, $item_size, $item_index, $num_excerpt );
														}
											echo '</div>'; // blog-item-holder
											echo '<div class="clear"></div>';
												 pagination (); // get page navigation
								    echo "</div>"; // cp-page-item
												 get_sidebar ( 'left' );
								echo "</div>"; // cp-page-float-left
							              	    get_sidebar ( 'right' );
								?>
						</div><!--content-wrapper-->
                   		  </section><!--page-body-wrapper-->
             </section>			
<?php get_footer(); ?>