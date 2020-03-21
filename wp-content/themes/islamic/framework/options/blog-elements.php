<?php

	/*
	*	CrunchPress Blog Item File
	*	---------------------------------------------------------------------
	* 	@version	1.0
	* 	@author		CrunchPress
	* 	@link		http://crunchpress.com
	* 	@copyright	Copyright (c) CrunchPress
	*	---------------------------------------------------------------------
	*	This file contains the function that can print each blog item in 
	*	different conditions.
	*	---------------------------------------------------------------------
	*/
	
	// size is when no sidebar, side2 is use when 1 sidebar, side 3 is use when 3 sidebar
	if( $cp_is_responsive ){
		$blog_div_size_num_class = array(
			"1/1 Medium Thumbnail" => array("index"=>"1", "class"=>"sixteen ", "size"=>"460x180", "size2"=>"220x150", "size3"=>"450x150"),
			"1/1 Full Thumbnail" => array("index"=>"2", "class"=>"sixteen", "size"=>"930x300", "size2"=>"630x200", "size3"=>"450x150"));

	}	
	
	// Print blog item
	function print_blog_item($item_xml){

		wp_reset_query();
		global $paged;
		global $sidebar;
		global $blog_div_size_num_class;
		
		if(empty($paged)){
			$paged = (get_query_var('page')) ? get_query_var('page') : 1; 
		}
		
		// get the item class and size from array
		$item_type = find_xml_value($item_xml, 'item-size');
		$item_class = $blog_div_size_num_class[$item_type]['class'];
		$item_index = $blog_div_size_num_class[$item_type]['index'];
		$full_content = find_xml_value($item_xml, 'show-full-blog-post');
		if( $sidebar == "no-sidebar" ){
			$item_size = $blog_div_size_num_class[$item_type]['size'];
		}else if ( $sidebar == "left-sidebar" || $sidebar == "right-sidebar" ){
			$item_size = $blog_div_size_num_class[$item_type]['size2'];
		}else{
			$item_size = $blog_div_size_num_class[$item_type]['size3'];
		}
				
		// get the blog meta value		
		$header = find_xml_value($item_xml, 'header');
		$num_fetch = find_xml_value($item_xml, 'num-fetch');
		$num_excerpt = find_xml_value($item_xml, 'num-excerpt');
		
		$category = find_xml_value($item_xml, 'category');
		$category = ( $category == 'All' )? '': $category;
		if( !empty($category) ){
			$category_term = get_term_by( 'name', $category , 'category');
			$category = $category_term->slug;
		}

		// print header
		if(!empty($header)){
			echo '<h3 class="blog-header-title title-color mb15 cp-title">' . $header . '</h3>';
		}
		
		// start fetching database
		query_posts(array('post_type'=>'post', 'paged'=>$paged,
			 'category_name'=>$category, 'posts_per_page'=>$num_fetch  ));		
		
		echo '<div id="blog-item-holder" class="blog-item-holder">';

		if( $item_type == '1/1 Full Thumbnail' ){	
			print_blog_full($item_class, $item_size, $item_index, $num_excerpt, $full_content);
		}else if( $item_type == '1/1 Medium Thumbnail' ){
			print_blog_medium($item_class, $item_size, $item_index, $num_excerpt);
		}
		/*if($item_index == 10){
			print_blog_item_slide_show($item_xml, $item_class, $item_size);			
		}*/
		
		echo '</div>';
		echo '<div class="clear"></div>';
		
		if( find_xml_value($item_xml, "pagination") == "Yes" ){	
			pagination();
		}	
	
	}	
	
	// print the blog thumbnail
	function print_blog_thumbnail( $post_id, $item_size ){
	
		$thumbnail_types = get_post_meta( $post_id, 'post-option-inside-thumbnail-types', true);
		
		if( $thumbnail_types == "Image" || empty($thumbnail_types) ){
		
			$thumbnail_id = get_post_thumbnail_id( $post_id );
			$thumbnail = wp_get_attachment_image_src( $thumbnail_id , $item_size );
			$alt_text = get_post_meta($thumbnail_id , '_wp_attachment_image_alt', true);
			if( !empty($thumbnail) ){
				echo '<div class="blog-thumbnail-image">';
				echo '<a href="' . get_permalink() . '"><img src="' . $thumbnail[0] .'" alt="'. $alt_text .'"/></a></div>';
			}
		
		}else if( $thumbnail_types == "Video" ){
			
			$video_link = get_post_meta( $post_id, 'post-option-inside-thumbnail-video', true); 
			echo '<div class="blog-thumbnail-video">';
			echo get_video($video_link, cp_get_width($item_size), cp_get_height($item_size));
			echo '</div>';
			
		}else if ( $thumbnail_types == "Slider" ){

			$slider_xml = get_post_meta( $post_id, 'post-option-inside-thumbnail-xml', true); 
			$slider_xml_dom = new DOMDocument();
			$slider_xml_dom->loadXML($slider_xml);
			
			echo '<div class="blog-thumbnail-slider">';
			echo print_flex_slider($slider_xml_dom->documentElement, $item_size);
			echo '</div>';			
		
		}	
		
	}
	
	
	// print blog medium thumbnail type
	function print_blog_medium( $item_class, $item_size, $item_index, $num_excerpt ){
	

		while( have_posts() ){
			the_post();

			echo '<div class="blog-item' . $item_index . ' cp-divider ' . $item_class . ' mt0">'; 

			print_blog_thumbnail( get_the_ID(), $item_size );
			
			echo '<div class="blog-thumbnail-context">';
			echo '<h2 class="blog-thumbnail-title post-title-color cp-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';
			echo '<div class="post-info-color cp-divider">';
			echo '<div class="blog-thumbnail-content"><p>';
			echo  mb_substr( get_the_excerpt(), 0, $num_excerpt ) ;	
			echo '</p>';
			echo '<a class="blog-continue-reading" href="' . get_permalink() . '"><em>' . __(' Continue Reading &rarr;','cp_front_end') . '</em></a>';
			echo '</a>';
			echo '</div>';
			echo '</div>';
			echo '</div>'; // blog-thumbnail-context
			echo '<div class="blog-thumbnail-info">';
			echo '<ul>';
			echo '<li class="blog-thumbnail-date">' . get_the_time( GDL_DATE_FORMAT ) . '</li>';
			echo '<li class="blog-thumbnail-author"> ' . __('by','cp_front_end') . ' ' . get_the_author_link() . '</li>';	
			echo '<li class="blog-thumbnail-comment">';
			comments_popup_link( __('0 Comment','cp_front_end'),
				__('1 Comment','cp_front_end'),
				__('% Comments','cp_front_end'), '',
				__('Comments are off','cp_front_end') );
			echo '</li>';
			the_tags('<li class="single-thumbnail-tag">', ', ', '</li>');
			echo '</ul>';
			echo '<div class="clear"></div>';
			echo '</div>';
			echo '</div>'; // blog-item
		
		}
		
	}
	
	// print blog full thumbnail type
	function print_blog_full( $item_class, $item_size, $item_index, $num_excerpt, $full_content = "No" ){
	
		if( $full_content == 'Yes' ){
			global $more;
			$more = 0;
		}
		
		while( have_posts() ){
			the_post();

			echo '<div class="blog-item' . $item_index . ' cp-divider ' . $item_class . ' mt0">'; 
			
			print_blog_thumbnail( get_the_ID(), $item_size );
			
			// Blog Thumbnil Goes here
			
			echo '<div class="blog-thumbnail-context">';
			echo '<h2 class="blog-thumbnail-title post-title-color cp-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';
			if( $full_content == "No" ){
				echo '<div class="blog-thumbnail-content"><p>' ;
				echo mb_substr( get_the_excerpt(), 0, $num_excerpt ) ;
				echo '</p>';
				echo '<a class="button" href="' . get_permalink() . '">' . __('Read More','cp_front_end') . '</a>';	
				echo '</div>';			
			}else{
				echo '<div class="blog-thumbnail-content"><p>';
				the_content('Read More');
				echo '</p></div>';	
			}
				
			echo '<div class="blog-thumbnail-info post-info-color cp-divider">';
			echo '<ul>';
			echo '<li class="blog-thumbnail-date">' . get_the_time( GDL_DATE_FORMAT ) . '</li>';
			echo '<li class="blog-thumbnail-author"> ' . __('by','cp_front_end') . ' ' . get_the_author_link() . '</li>';	
			echo '<li class="blog-thumbnail-comment">';
			comments_popup_link( __('0 Comment','cp_front_end'),
				__('1 Comment','cp_front_end'),
				__('% Comments','cp_front_end'), '',
				__('Comments are off','cp_front_end') );
			echo '</li>';
			the_tags('<li class="single-thumbnail-tag">', ', ', '</li>');
		    echo '</ul>';
			echo '<div class="clear"></div>';
			echo '</div>';
			echo '</div>';
		echo '</div>';
		}
			
	}
	
	
?>