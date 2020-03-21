<?php

	/*	
	*	CrunchPress Include Script File
	*	---------------------------------------------------------------------
	* 	@version	1.1
	*   @ Package   The Church Theme
	* 	@author		CrunchPress
	* 	@link		http://crunchpress.com
	* 	@copyright	Copyright (c) CrunchPress
	*	---------------------------------------------------------------------
	*	This file manage to embed the stylesheet and javascript to each page
	*	based on the content of that page.
	*	---------------------------------------------------------------------
	*/
	
	add_action('init', 'register_all_cp_scripts');
	function register_all_cp_scripts(){
	
		if( $GLOBALS['pagenow'] != 'wp-login.php' ){
			if(is_admin()){
			
				wp_enqueue_style('cp-back-office', CP_PATH_URL.'/framework/stylesheet/cp-backend.css');
				add_action('add_meta_boxes', 'register_meta_script');
				
			}else{
				
				wp_enqueue_style('style-custom', CP_PATH_URL.'/stylesheet/style-custom.php');
				 add_action('wp_print_styles','register_non_admin_styles');
				 add_action('wp_print_scripts','register_non_admin_scripts');
				
			}
		}
		
	}
		
		$option_exists = get_option(THEME_NAME_S.'_create_sidebar');
		
		if (empty ($option_exists)) {
			update_option(THEME_NAME_S.'_create_sidebar', '<sidebar><name>Right Sidebar</name><name>Left Sidebar</name></sidebar>');
		} 	

	
	
	/* 	---------------------------------------------------------------------
	*	This section include the back-end script
	*	---------------------------------------------------------------------
	*/ 
	
	function register_meta_script(){
		global $post_type;
		
		wp_enqueue_style('ie-style',CP_PATH_URL . '/stylesheet/ie-style.php?path=' . CP_PATH_URL);		
		
		// register style and script when access to the "page" post_type page
		if( $post_type == 'page' ){
		
			wp_enqueue_style('meta-css',CP_PATH_URL.'/framework/stylesheet/meta-css.css');
			wp_enqueue_style('page-dragging',CP_PATH_URL.'/framework/stylesheet/page-dragging.css');
			wp_enqueue_style('image-picker',CP_PATH_URL.'/framework/stylesheet/image-picker.css');
			wp_enqueue_style('confirm-dialog',CP_PATH_URL.'/framework/stylesheet/jquery.confirm.css');

			wp_deregister_script('image-picker');
			wp_register_script('image-picker', CP_PATH_URL.'/framework/javascript/image-picker.js', false, '1.0', true);
			wp_enqueue_script('image-picker');
		
			wp_deregister_script('page-dragging');
			wp_register_script('page-dragging', CP_PATH_URL.'/framework/javascript/page-dragging.js', false, '1.0', true);
			wp_enqueue_script('page-dragging');
			
			wp_deregister_script('edit-box');
			wp_register_script('edit-box', CP_PATH_URL.'/framework/javascript/edit-box.js', false, '1.0', true);
			wp_enqueue_script('edit-box');

			wp_deregister_script('confirm-dialog');
			wp_register_script('confirm-dialog', CP_PATH_URL.'/framework/javascript/jquery.confirm.js', false, '1.0', true);
			wp_enqueue_script('confirm-dialog');
			
		// register style and script when access to the "post" post_type page
		}else if( $post_type == 'event' || $post_type == 'post' || $post_type == 'portfolio' || $post_type == 'gallery'){
		
			wp_enqueue_style('meta-css',CP_PATH_URL.'/framework/stylesheet/meta-css.css');
			wp_enqueue_style('image-picker',CP_PATH_URL.'/framework/stylesheet/image-picker.css');
			wp_enqueue_style('confirm-dialog',CP_PATH_URL.'/framework/stylesheet/jquery.confirm.css');
			
			wp_deregister_script('post-effects');
			wp_register_script('post-effects', CP_PATH_URL.'/framework/javascript/post-effects.js', false, '1.0', true);
			wp_enqueue_script('post-effects');
			
			wp_deregister_script('image-picker');
			wp_register_script('image-picker', CP_PATH_URL.'/framework/javascript/image-picker.js', false, '1.0', true);
			wp_localize_script( 'image-picker', 'URL', array('crunchpress' => CP_PATH_URL ));
			wp_enqueue_script('image-picker');
			
			wp_deregister_script('confirm-dialog');
			wp_register_script('confirm-dialog', CP_PATH_URL.'/framework/javascript/jquery.confirm.js', false, '1.0', true);
			wp_enqueue_script('confirm-dialog');
		
		// register style and script when access to the "testimonial" post_type page		
		}else if( $post_type == 'testimonial' ){
		
			wp_enqueue_style('meta-css',CP_PATH_URL.'/framework/stylesheet/meta-css.css');
		
		}else if( $post_type == 'price_table' ){
		
			wp_enqueue_style('meta-css',CP_PATH_URL.'/framework/stylesheet/meta-css.css');
			
			wp_deregister_script('price-table-script');
			wp_register_script('price-table-script', CP_PATH_URL.'/framework/javascript/price-table-script.js', false, '1.0', true);
			wp_enqueue_script('price-table-script');
		
		}
		
	}
	
	
		// register script in CrunchPress panel
	function register_crunchpress_panel_scripts($hook_suffix){

		//wp_enqueue_style('ie-style',CP_THEME_PATH_URL . 'stylesheet/ie-style.php?path=' . CP_THEME_PATH_URL);	
	    if($hook_suffix == 'toplevel_page_options') {
		wp_enqueue_style('ie-style',CP_PATH_URL . '/stylesheet/ie-style.php?path=' . CP_PATH_URL);	
	   
	   
		wp_register_script('jquery',  CP_PATH_URL.'/javascript/jquery-1.7.2.min.js', false, '1.0', false);
		wp_enqueue_scripts('jquery');
		
		wp_register_script('jquery-ui',  CP_PATH_URL.'/javascript/jquery-ui.js', false, '1.0', false);
		wp_enqueue_script('jquery-ui');
	
		//wp_register_script('cufon', CP_PATH_URL.'/javascript/cufon.js', false, '1.0', false);
		//wp_enqueue_script('cufon');
	
		wp_register_script('cp-panel', CP_PATH_URL.'/framework/javascript/cp-panel.js', false, '1.0', true);
		wp_localize_script( 'cp-panel', 'URL', array('crunchpress' => CP_PATH_URL, 'sample_text' => FONT_SAMPLE_TEXT ));
		wp_enqueue_script('cp-panel');
		
		wp_register_script('mini-color', CP_PATH_URL.'/framework/javascript/jquery.miniColors.js', false, '1.0', true);
		wp_enqueue_script('mini-color');

		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
		
		wp_register_script('confirm-dialog', CP_PATH_URL.'/framework/javascript/jquery.confirm.js', false, '1.0', true);
		wp_enqueue_script('confirm-dialog');
	
		wp_enqueue_style('jquery-ui',CP_PATH_URL.'/framework/stylesheet/jquery-ui-1.8.16.custom.css');
		wp_enqueue_style('cp-panel',CP_PATH_URL.'/framework/stylesheet/cp-panel.css');
		wp_enqueue_style('mini-color',CP_PATH_URL.'/framework/stylesheet/jquery.miniColors.css');
		wp_enqueue_style('thickbox');
		wp_enqueue_style('confirm-dialog',CP_PATH_URL.'/framework/stylesheet/jquery.confirm.css');
		
     	}
	
	}

	
	/* 	---------------------------------------------------------------------
	*	this section include the front-end script
	*	---------------------------------------------------------------------
	*/ 
	
	// Register all stylesheet

	function register_non_admin_styles(){
	
		global $post;
				
		// Navigation Menu
		wp_enqueue_style('prettyPhoto',CP_PATH_URL.'/stylesheet/prettyPhoto.css');
		
		if( is_search() || is_archive() ){
		
			wp_enqueue_style('flex-slider',CP_PATH_URL.'/stylesheet/flexslider.css');
	
		// Post post_type
		}else if( isset($post) && $post->post_type == 'post' || 
			isset($post) && $post->post_type == 'portfolio' ){
		
			// If using slider (flex slider)	
			global $cp_post_thumbnail;
			$cp_post_thumbnail = get_post_meta($post->ID,'post-option-inside-thumbnail-types', true);
			
			
			if( $cp_post_thumbnail == 'Slider'){
			
				wp_enqueue_style('flex-slider',CP_PATH_URL.'/stylesheet/flexslider.css');
				
			}
			
		// Page post_type
		}else if( isset($post) && $post->post_type == 'page' ){
		
			global $cp_page_xml, $cp_top_slider_type, $cp_top_slider_xml;
			$cp_page_xml = get_post_meta($post->ID,'page-option-item-xml', true);
			
			$cp_top_slider_type = get_post_meta($post->ID,'page-option-top-slider-types', true);
			
			$cp_top_slider_xml = get_post_meta($post->ID,'page-option-top-slider-xml', true);
			
			// If using carousel slider
			if(	strpos($cp_page_xml,'<slider-type>Carousel Slider</slider-type>') > -1 ){
				wp_enqueue_style('picachoose', CP_PATH_URL.'/stylesheet/pikachoose.css');
			}
			
			// If using nivo slider
			if( strpos($cp_page_xml,'<slider-type>Nivo Slider</slider-type>') > -1 ||
				$cp_top_slider_type == 'Nivo Slider' ){
			   
				wp_enqueue_style('nivo-slider',CP_PATH_URL.'/stylesheet/nivo-slider.css');
				wp_enqueue_style('nivo-slider-style',CP_PATH_URL.'/stylesheet/nivo-slider-style.css');
				
			}
			// If using refine slider
			if( strpos($cp_page_xml,'<slider-type>Refine Slider</slider-type>') > -1 ||
				$cp_top_slider_type == 'Refine Slider' ){
			
				wp_enqueue_style('refine-slider',CP_PATH_URL.'/stylesheet/refineslider.css');
				
			}				
			
			if(	strpos($cp_page_xml,'<slider-type>Flex Slider</slider-type>') > -1 || 
				strpos($cp_page_xml, '<Portfolio>') > -1 ||
				strpos($cp_page_xml, '<Blog>') > -1 ||
				$cp_top_slider_type == 'Flex Slider'){
				
				wp_enqueue_style('flex-slider',CP_PATH_URL.'/stylesheet/flexslider.css');
				
			}
			
		}
	}
		 
		function google_jquery() {
		if (!is_admin()) {
			// comment out the next two lines to load the local copy of jQuery
			wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js', false, '1.7.1');
			wp_enqueue_script('jquery');
			}
		}
		add_action('init', 'google_jquery');
	
	// Register all scripts
	
	
	function register_non_admin_scripts(){
	    global $post;
		global $cp_is_responsive;
		global $crunchpress_element;		
         		
         
        wp_register_script('focus', CP_PATH_URL.'/javascript/focus.js', false, '1.0', true);
		wp_enqueue_script('focus');
        
		global $wp_scripts;
		wp_register_script('html5shiv','http://html5shiv.googlecode.com/svn/trunk/html5.js',array(),'1.5.1');
		wp_enqueue_script('html5shiv');
		$wp_scripts->add_data( 'html5shiv', 'conditional', 'lt IE 9' );
		
		wp_register_script('superfish', CP_PATH_URL.'/javascript/superfish.js', false, '1.0', true);
		wp_enqueue_script('superfish');
		
		wp_register_script('supersub', CP_PATH_URL.'/javascript/supersub.js', false, '1.0', true);
		wp_enqueue_script('supersub');
		
		$twittername = get_option(THEME_NAME_S.'_twitter_id');
		if( !empty($twittername) ) {
		wp_register_script('twitter-scroller', CP_PATH_URL.'/javascript/jquery.twitter-scroller.js', false, '1.0', true);
		wp_enqueue_script('twitter-scroller');
		}
		
		wp_register_script('cp-scripts', CP_PATH_URL.'/javascript/cp-scripts.js', false, '1.0', true);
		wp_enqueue_script('cp-scripts');
		
		wp_register_script('easing', CP_PATH_URL.'/javascript/jquery.easing.js', false, '1.0', true);
		wp_enqueue_script('easing');
		
		wp_register_script('prettyPhoto', CP_PATH_URL.'/javascript/jquery.prettyPhoto.js', false, '1.0', true);
		wp_enqueue_script('prettyPhoto');
		
		wp_register_script('jcarousellite', CP_PATH_URL.'/javascript/jquery.jcarousellite.js', false, '1.0', true);
		wp_enqueue_script('jcarousellite');
		 
		 
		// if choosing the responsive option
		if( $cp_is_responsive ){
			wp_deregister_script('fitvids');
			wp_register_script('fitvids', CP_PATH_URL.'/javascript/jquery.fitvids.js', false, '1.0', false);
			//wp_enqueue_script('fitvids');		
		}
		
		
		// Search and archive page
		if( is_search() || is_archive() ){

			$flex_setting = get_cp_slider_option_array($crunchpress_element['cp_panel_flex_slider']);
			$flex_setting = array_merge($flex_setting, array('controlsContainer'=>'.flexslider'));
		
			wp_deregister_script('flex-slider');
			wp_register_script('flex-slider', CP_PATH_URL.'/javascript/jquery.flexslider.js', false, '1.0', true);
			wp_localize_script( 'flex-slider', 'FLEX', $flex_setting);
			wp_enqueue_script('flex-slider');	
		
		// Post post_type
		}else if( isset($post) &&  $post->post_type == 'post' || 
			isset($post) &&  $post->post_type == 'portfolio'  ){
		
			// If using slider (flex slider)
			global $cp_post_thumbnail;

			if( $cp_post_thumbnail == 'Slider'){

				$flex_setting = get_cp_slider_option_array($crunchpress_element['cp_panel_flex_slider']);
				$flex_setting = array_merge($flex_setting, array('controlsContainer'=>'.slider-wrapper'));

				wp_deregister_script('flex-slider');
				wp_register_script('flex-slider', CP_PATH_URL.'/javascript/jquery.flexslider.js', false, '1.0', true);
				wp_localize_script( 'flex-slider', 'FLEX', $flex_setting);
				wp_enqueue_script('flex-slider');
				
			}
		
		// Page post_type
		}else if( isset($post) &&  $post->post_type == 'page' ){
			
			global $cp_page_xml, $cp_top_slider_type, $cp_top_slider_xml;
			
			//  If using jcarousellite
			if( strpos($cp_page_xml,'<display-type>Testimonial Category</display-type>') > -1 ){
				wp_deregister_script('jcarousellite');
				wp_register_script('jcarousellite', CP_PATH_URL.'/javascript/jquery.jcarousellite.js', false, '1.0', true);
				wp_enqueue_script('jcarousellite');
			}
			
			
			// If using carousel slider
			if(	strpos($cp_page_xml,'<slider-type>Carousel Slider</slider-type>') > -1 ){
				$pikachoose_setting = get_cp_slider_option_array($crunchpress_element['cp_panel_carousel_slider']);
			
				wp_deregister_script('pikachoose');
				wp_register_script('pikachoose', CP_PATH_URL.'/javascript/jquery.pikachoose.js', false, '1.0', false);
				wp_localize_script( 'pikachoose', 'PIKACHOOSE', $pikachoose_setting);
				wp_enqueue_script('pikachoose');
			}
			
			// If using nivo slider
			if( strpos($cp_page_xml,'<slider-type>Nivo Slider</slider-type>') > -1 || $cp_top_slider_type == 'Nivo Slider' ){
			
				$nivo_setting = get_cp_slider_option_array($crunchpress_element['cp_panel_nivo_slider']);
				
				wp_deregister_script('nivo-slider');
				wp_register_script('nivo-slider', CP_PATH_URL.'/javascript/jquery.nivo.slider.pack.js', false, '1.0', true);
				wp_localize_script( 'nivo-slider', 'NIVO', $nivo_setting);
				wp_enqueue_script('nivo-slider');
				
			}
			
			// If using refine slider
			if( strpos($cp_page_xml,'<slider-type>Refine Slider</slider-type>') > -1 ||
				$cp_top_slider_type == 'Refine Slider' ){
			
				$refine_setting = get_cp_slider_option_array($crunchpress_element['cp_panel_refine_slider']);
				
				wp_register_script('myjquery', CP_PATH_URL.'/javascript/jquery_71.js', false, '1.0', false);
				wp_enqueue_script('myjquery');
				
				wp_deregister_script('refine-slider');
				wp_register_script('refine-slider', CP_PATH_URL.'/javascript/jquery.refineslider.js', false, '1.0', true);
				wp_localize_script( 'refine-slider', 'REFINE', $refine_setting);
				wp_enqueue_script('refine-slider');
				
			}
			
			
			// If using flex slider
			if( strpos($cp_page_xml, '<slider-type>Flex Slider</slider-type>') > -1 ||
				strpos($cp_page_xml, '<Portfolio>') > -1 ||
				strpos($cp_page_xml, '<Blog>') > -1 ||
				$cp_top_slider_type == 'Flex Slider'){
			
				$flex_setting = get_cp_slider_option_array($crunchpress_element['cp_panel_flex_slider']);
				$flex_setting = array_merge($flex_setting, array('controlsContainer'=>'.flexslider'));
			
				wp_deregister_script('flex-slider');
				wp_register_script('flex-slider', CP_PATH_URL.'/javascript/jquery.flexslider.js', false, '1.0', true);
				wp_localize_script( 'flex-slider', 'FLEX', $flex_setting);
				wp_enqueue_script('flex-slider');	
					
			}
		
			// If using filterable plugin
			if( strpos($cp_page_xml,'<filterable>Yes</filterable>') > -1 ){
			
				wp_deregister_script('filterable');
				wp_register_script('filterable', CP_PATH_URL.'/javascript/jquery.filterable.js', false, '1.0', true);
				wp_enqueue_script('filterable');
			
			}
			
			// If use contact-form
			if( strpos($cp_page_xml,'<Contact-Form>') > -1 ){
			
				wp_deregister_script('contact-form');
				wp_register_script('contact-form', CP_PATH_URL.'/javascript/cp-contactform.js', false, '1.0', true);
				wp_localize_script( 'contact-form', 'MyAjax', array( 'ajaxurl' => AJAX_URL ) );
				wp_enqueue_script('contact-form');
						
			}
			
		}
	
		// Comment Script
		if(is_singular() && comments_open() && get_option('thread_comments')){
		
			wp_enqueue_script( 'comment-reply' ); 
			
		}
		
	}
	