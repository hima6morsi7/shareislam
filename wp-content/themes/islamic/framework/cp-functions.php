<?php

	/*	
	*	Crunchpress Function Registered File
	*	---------------------------------------------------------------------
	* 	@version	1.0
	* 	@author		Crunchpress
	* 	@link		http://crunchpress.com
	* 	@copyright	Copyright (c) Crunchpress
	*	---------------------------------------------------------------------
	*	This file use to register the wordpress function to the framework,
	*	and also use filter to hook some necessary events.
	*	---------------------------------------------------------------------
	*/
	
	// enable and register custom sidebar
	if (function_exists('register_sidebar')){	
	
		// default sidebar array
		$sidebar_attr = array(
			'name' => '',
			'before_widget' => '<div class="custom-sidebar cp-divider">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="custom-sidebar-title">',
			'after_title' => '</h3>'
		);
		
		$sidebar_id = 0;
		$cp_sidebar = array("Search/Archive Left Sidebar", "Search/Archive Right Sidebar", "Footer 1", "Footer 2", "Footer 3", "Footer 4");
		$sidebar_attr['before_title'] = '<h3 class="custom-sidebar-title footer-title-color cp-title">';
		
		foreach( $cp_sidebar as $sidebar_name ){
			$sidebar_attr['name'] = $sidebar_name;
			$sidebar_attr['id'] = 'custom-sidebar' . $sidebar_id++ ;
			register_sidebar($sidebar_attr);
		}

		$cp_sidebar = array("Site Map 1", "Site Map 2", "Site Map 3");
		$sidebar_attr['before_title'] = '<h1 class="custom-sidebar-title sidebar-title-color cp-title"><span class="h-line"></span>';
		
		foreach( $cp_sidebar as $sidebar_name ){
			$sidebar_attr['name'] = $sidebar_name;
			$sidebar_attr['id'] = 'custom-sidebar' . $sidebar_id++ ;
			register_sidebar($sidebar_attr);
		}
		
		$cp_sidebar = get_option( THEME_NAME_S.'_create_sidebar' );
		$sidebar_attr['before_title'] = '<h1 class="custom-sidebar-title sidebar-title-color cp-title"><span class="h-line"></span>';
		
		if(!empty($cp_sidebar)){
			$xml = new DOMDocument();
			$xml->loadXML($cp_sidebar);
			foreach( $xml->documentElement->childNodes as $sidebar_name ){
				$sidebar_attr['name'] = $sidebar_name->nodeValue;
				$sidebar_attr['id'] = 'custom-sidebar' . $sidebar_id++ ;
				register_sidebar($sidebar_attr);
			}
		}
		
	}
	
	// enable featured image
	if(function_exists('add_theme_support')){
		add_theme_support('post-thumbnails');
	}
	
	// enable editor style
	add_editor_style('custom-editor-style.css');
	
	// enable navigation menu
	if(function_exists('add_theme_support')){
		add_theme_support('menus');
		register_nav_menus(array('main_menu' => 'Main Navigation Menu'));
	}
	
	// add filter to hook when user press "insert into post" to include the attachment id
	add_filter('media_send_to_editor', 'add_para_media_to_editor', 20, 2);
	function add_para_media_to_editor($html, $id){

		if(strpos($html, 'href')){
			$pos = strpos($html, '<a') + 2;
			$html = substr($html, 0, $pos) . ' attid="' . $id . '" ' . substr($html, $pos);
		}
		
		return $html ;
		
	}
	
	// enable theme to support the localization
	add_action('init', 'cp_word_translation');
	
	function cp_word_translation(){
		
		global $cp_admin_translator;
		
		     load_theme_textdomain( 'crunchpress', CP_PATH_SER . '/languages/' );
			  load_theme_textdomain( 'cp_front_end', CP_PATH_SER . '/languages/' );
		
	}
	// excerpt filter
	add_filter('excerpt_length','cp_excerpt_length');
	function cp_excerpt_length(){
		return 1000;
	}
	
	// Google Analytics
	$cp_enable_analytics = get_option(THEME_NAME_S.'_enable_analytics','disable');
	if( $cp_enable_analytics == 'enable' ){
		add_action('wp_footer', 'add_google_analytics_code');
	}
	function add_google_analytics_code(){
		
		echo get_option(THEME_NAME_S.'_analytics_code','');
	
	}
	
	// Custom Post type Feed
	add_filter('request', 'myfeed_request');
	function myfeed_request($qv) {
		if (isset($qv['feed']) && !isset($qv['post_type']))
		$qv['post_type'] = array('post', 'portfolio');
		return $qv;
	}

	// Translate the wpml shortcode
	// [wpml_translate lang=es]LANG 1[/wpml_translate]
	// [wpml_translate lang=en]LANG 2[/wpml_translate]

	function webtreats_lang_test( $atts, $content = null ) {
		extract(shortcode_atts(array( 'lang' => '' ), $atts));
		
		$lang_active = ICL_LANGUAGE_CODE;
		
		if($lang == $lang_active){
			return $content;
		}
	}
	
	
	
	//Get custom post type shown in archive
	/* function include_custom_post_types( $query ) { 
		global $wp_query;
		if ( is_category() || is_tag() || is_date()	) {
			$query->set( 'post_type' , 'portfolio' );
		}
		return $query;
	}
	add_filter( 'pre_get_posts' , 'include_custom_post_types' ); */
	
	// Add Another theme support
	add_filter('widget_text', 'do_shortcode');
	add_theme_support( 'automatic-feed-links' );	
	
	if ( ! isset( $content_width ) ){ $content_width = 980; }
	
	/* Flush rewrite rules for custom post types. */
	add_action( 'load-themes.php', 'cp_flush_rewrite_rules' );
	function cp_flush_rewrite_rules() {
		global $pagenow, $wp_rewrite;
		if ( 'themes.php' == $pagenow && isset( $_GET['activated'] ) )
			$wp_rewrite->flush_rules();
	}
	

        // Funtion to display twitter scrooling feed in footer
		function twitter_feed_ticker () {
		$twittername = get_option(THEME_NAME_S.'_twitter_id');
		echo '<div id="twitter">';
    	echo '<a href="http://www.twitter.com/'.$twittername.'" target="_blank" ><h2><span id="twitname">'.$twittername.'</span></h2></a>';
    	echo '<p>'.__('Loading...','crunchpress') .'</p>';
    	echo '<noscript>'.__('This feature requires JavaScript','crunchpress') .'</noscript>';
		echo '</div>';
	}
	

        //Funtion to display feedburner subscription in footer
 	    function cp_feedburner () { $feedId = get_option(THEME_NAME_S.'_feedburner_id','crunchpress'); ?>
	 					<section class="feedemail-form eight columns mt0">
                            <form action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit=
                            "window.open('http://feedburner.google.com/fb/a/mailverify?uri=<?php echo $feedId ?>', 'popupwindow', 'scrollbars=yes,width=600,height=550');return true">
                              <h3 class="newsletter-heading"><?php _e('Newsletter Signup','crunchpress')?></h3>
                              <div class="newsletter-wrapper">
                                <div class="newsletter-box">
                                  <input type="text" class="feedemail-input" name="email" onblur="this.value=this.value==''?'Enter your email':this.value;" onfocus="this.value=this.value=='Enter your email'?'':this.value" maxlength="150" value="Enter your email" />
                                  <input type="hidden" value="<?php echo $feedId ?>" name="uri"/>
                                  <input type="hidden" name="loc" value="en_US"/>
                                  <input type="submit" value="<?php _e('Submit','crunchpress')?>" class="newsletter-button"/>
                                </div>
                              </div>
                            </form>
                          </section>
<?php }