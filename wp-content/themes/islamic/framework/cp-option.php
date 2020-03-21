<?php

	/*	
	*	CrunchPress Options File
	*	---------------------------------------------------------------------
	* 	@version	1.0
	* 	@author		CrunchPress
	* 	@link		http://crunchpress.com
	* 	@copyright	Copyright (c) CrunchPress
	*	---------------------------------------------------------------------
	*	This file contains the CrunchPress panel elements and create the 
	*	CrunchPress panel at the back-end of the framework
	*	---------------------------------------------------------------------
	*/
	
	// CrunchPress panel navigation elements
	$crunchpress_menu = array(			
		__('General', 'crunchpress') => array(
		    __('Logo', 'crunchpress')=>'cp_panel_logo',
			__('Favicon', 'crunchpress')=>'cp_panel_favicon',
			__('Social Shares', 'crunchpress')=>'cp_panel_social_shares',
			__('Google Analytics', 'crunchpress')=>'cp_panel_google_analytics',
			__('RTL', 'crunchpress')=>'cp_panel_rtl',
			__('Copyright Area', 'crunchpress')=>'cp_panel_copyright_area'
			),
		__('Layout', 'crunchpress') => array(
			__('Page Style', 'crunchpress')=>'cp_panel_page_style',
			__('Footer Style', 'crunchpress')=>'cp_panel_footer_style',
			),
			
			//__('Dummy Data', 'crunchpress')=>'cp_panel_dummy_data' ),		
		__('Styling', 'crunchpress') => array(
			__('Color Schemes', 'crunchpress')=>'cp_panel_load_color_scheme',
			__('Background Style', 'crunchpress')=>'cp_panel_background',
			__('Header', 'crunchpress')=>'cp_panel_navigation',
			__('Body', 'crunchpress')=>'cp_panel_body',
			__('Footer', 'crunchpress')=>'cp_panel_footer',
			__('Blog', 'crunchpress')=>'cp_panel_blog_port',
			__('Contact/Comments', 'crunchpress')=>'cp_panel_contact_form',
			__('Text Widget', 'crunchpress')=>'cp_panel_text_widget',
			__('Misc Elements', 'crunchpress')=>'cp_panel_misc_elements',
			),	
			
		__('Sidebar','crunchpress')=> array(
			__('Sidebar Generator', 'crunchpress')=>'cp_panel_sidebar',
				),	
		__('Typography', 'crunchpress') => array(
			__('Font Family', 'crunchpress')=>'cp_panel_font',
			__('Font Size', 'crunchpress')=>'cp_panel_font_size',
			__('Upload Font', 'crunchpress')=>'cp_panel_upload_font'),
		__('Sliders', 'crunchpress') => array(
			__('Nivo Slider', 'crunchpress')=>'cp_panel_nivo_slider',
			__('Flex Slider', 'crunchpress')=>'cp_panel_flex_slider',
			__('Refine Slider', 'crunchpress')=>'cp_panel_refine_slider'),
		
	);

		
	// CrunchPress panel elements ( the head of array links to the menu of navigation elements )
	$crunchpress_element = array(
		//General
		'cp_panel_page_style' => array(
		   __('SEARCH/ARCHIVE SIDEBAR', 'crunchpress')=>array(
				'type'=>'radioimage',
				'name'=>THEME_NAME_S.'_search_archive_sidebar',
				'default'=>'no-sidebar',
				'options'=>array(
					'1'=>array('value'=>'right-sidebar','default'=>'selected','image'=>'/framework/images/right-sidebar.png'),
					'2'=>array('value'=>'left-sidebar','image'=>'/framework/images/left-sidebar.png'),
					'3'=>array('value'=>'both-sidebar','image'=>'/framework/images/both-sidebar.png'),
					'4'=>array('value'=>'no-sidebar','image'=>'/framework/images/no-sidebar.png'))),
			__('SEARCH/ARCHIVE FULL BLOG CONTENT', 'crunchpress')=>array(
				'type'=>'combobox',
				'name'=>THEME_NAME_S.'_search_archive_full_blog_content',
				'options'=>array('No', 'Yes'),
				'description'=>'Use this to show full content of the blog in search/archive page. Only use with 1/1 Full Thumbnail'),
			
			__('SEARCH/ARCHIVE ELEMENT SIZE', 'crunchpress')=>array(
				'type'=>'combobox',
				'name'=>THEME_NAME_S.'_search_archive_item_size',
				'options'=>array('1/1 Full Thumbnail', '1/1 Medium Thumbnail')),
				
			__('SEARCH/ARCHIVE EXCERPT NUM', 'crunchpress')=>array(
				'type'=>'inputtext',
				'name'=>THEME_NAME_S.'_search_archive_num_excerpt',
				'default'=>'285',
				'description'=>'Input the number of characters you want for the length of excerpt of search and archive page.'),
			
			__('DEFAULT DATE FORMAT', 'crunchpress')=>array(
				'type'=>'inputtext',
				'name'=>THEME_NAME_S.'_default_date_format',
				'default'=>'F d, Y'),			
			__('DEFAULT WIDGET DATE FORMAT', 'crunchpress')=>array(
				'type'=>'inputtext',
				'name'=>THEME_NAME_S.'_default_widget_date_format',
				'default'=>'M d, Y'),										
				
			__('USE PORTFOLIO PAGE AS', 'crunchpress')=>array(
				'type'=>'combobox',
				'name'=>THEME_NAME_S.'_use_portfolio_as',
				'options'=>array('1'=>'portfolio style', '2'=>'blog style'),
				'description'=>'You can choose the portfolio page style to be the portfolio style or the same as blog style.'),
			__('CHANGE PORTFOLIO SLUG', 'crunchpress')=>array(
				'type'=>'inputtext',
				'name'=>THEME_NAME_S.'_cp_portfolio_slug',
				'default'=>'portfolio',
				'description'=>'Change/Rewrite the permalink when you use the permalink type as %postname%.'
			),			
		),
		'cp_panel_sidebar' => array(
			__('CREATE SIDEBAR', 'crunchpress')=>array('type'=>'sidebar','name'=>THEME_NAME_S.'_create_sidebar')
		),
		
		'cp_panel_rtl' => array(
		__('RIGHT TO LEFT TEXT SUPPORT', 'crunchpress')=>array('type'=>'radioenabled', 'name'=> THEME_NAME_S.'_rtl','default'=>'disable','description'=>'Enable Right-to-Left Language Support (Support for Arabic, Urdu, Persion etc).'),
		),
		'cp_panel_footer_style' => array(
			__('CHOOSE FOOTER STYLE', 'crunchpress')=>array(
				'type'=>'radioimage',
				'name'=>THEME_NAME_S.'_footer_style', 
				'default'=>'footer-style1',
				'options'=>array(
					'1'=>array('value'=>'footer-style1','image'=>'/framework/images/footer-style1.png'),
					'2'=>array('value'=>'footer-style2','image'=>'/framework/images/footer-style2.png'),
					'3'=>array('value'=>'footer-style3','image'=>'/framework/images/footer-style3.png'),
					'4'=>array('value'=>'footer-style4','image'=>'/framework/images/footer-style4.png'),
					'5'=>array('value'=>'footer-style5','image'=>'/framework/images/footer-style5.png'),
					'6'=>array('value'=>'footer-style6','image'=>'/framework/images/footer-style6.png'),
			)),
			__('SHOW FOOTER', 'crunchpress')=>array('type'=>'radioenabled', 'name'=> THEME_NAME_S.'_show_footer'),
			__('FEED BURNER SUBSCRIPTION FOOTER', 'crunchpress')=>array('type'=>'radioenabled', 'name'=> THEME_NAME_S.'show_feedburner','default'=> 'enable'),
			__('FEED BURNER ID', 'crunchpress')=>array('type'=>'inputtext','name'=>THEME_NAME_S.'_feedburner_id',
				'description'=>'Put your google feedburner id here.','default'=> 'crunchpress'),
		),
		
		'cp_panel_google_analytics' => array(
			__('ENABLE / DISABLE GOOGLE ANALYTICS', 'crunchpress')=>array('type'=>'radioenabled', 'name'=> THEME_NAME_S.'_enable_analytics', 'default'=>'disable'),
			__('GOOGLE ANALYTICS CODE', 'crunchpress')=>array('type'=>'textarea', 'name'=> THEME_NAME_S.'_analytics_code',
				'description'=>'Place your google analytics code here. This should be something like <br>' . 
				htmlspecialchars('<script type="text/javascript">') . '<br> ... <br>' .
				htmlspecialchars('</script>'))
		),
		
		'cp_panel_favicon' => array(
			__('ENABLE / DISABLE FAVICON', 'crunchpress')=>array('type'=>'radioenabled','name'=> THEME_NAME_S.'_enable_favicon', 'default'=>'disable'),
			__('UPLOAD FAVICON ICON', 'crunchpress')=>array('type'=>'upload','name'=> THEME_NAME_S.'_favicon_image'),
		),
		
		//Theme Style
		'cp_panel_font_size' => array(
			__('H1 SIZE', 'crunchpress')=>array('type'=>'sliderbar','name'=>THEME_NAME_S.'_h1_size','default'=>'30'),
			__('H2 SIZE', 'crunchpress')=>array('type'=>'sliderbar','name'=>THEME_NAME_S.'_h2_size','default'=>'25'),
			__('H3 SIZE', 'crunchpress')=>array('type'=>'sliderbar','name'=>THEME_NAME_S.'_h3_size','default'=>'20'),
			__('H4 SIZE', 'crunchpress')=>array('type'=>'sliderbar','name'=>THEME_NAME_S.'_h4_size','default'=>'18'),
			__('H5 SIZE', 'crunchpress')=>array('type'=>'sliderbar','name'=>THEME_NAME_S.'_h5_size','default'=>'16'),
			__('H6 SIZE', 'crunchpress')=>array('type'=>'sliderbar','name'=>THEME_NAME_S.'_h6_size','default'=>'15'),
			__('CONTENT SIZE', 'crunchpress')=>array('type'=>'sliderbar','name'=>THEME_NAME_S.'_content_size','default'=>'12')
		),

		'cp_panel_font' => array(
			__('HEADER FONT', 'crunchpress')=>array('type'=>'font-combobox','name'=>THEME_NAME_S.'_header_font', 'default'=>'- Droid Serif',
				'description'=>'Choose the header font of this theme. This font will be used in all title and header elements including the slider title.'),
			__('CONTENT FONT', 'crunchpress')=>array('type'=>'font-combobox','name'=>THEME_NAME_S.'_content_font',
				'description'=>'Choose the font to be used within content. We highly recommended NOT to use CUFON as a content font.'),
			__('TEXT WIDGET FONT', 'crunchpress')=>array('type'=>'font-combobox','name'=>THEME_NAME_S.'_text_widget_font', 'default'=>'- Museo Sans',
				'description'=>'Choose the font to use with text widget title.')
		),
				
			
		'cp_panel_upload_font' => array(
			__('UPLOAD FONT', 'crunchpress')=>array(
				'type'=>'uploadfont',
				'name'=>THEME_NAME_S.'_upload_font',
				'file'=>THEME_NAME_S.'_upload_font_file')
		),
		
		//Overall Elements
		'cp_panel_logo' => array( 
			__('LOGO', 'crunchpress')=>array('type'=>'upload','name'=>THEME_NAME_S.'_logo', ),
			
		),

		'cp_panel_background' => array(
			__('BACKGROUND TYPE', 'crunchpress')=>array('type'=>'combobox', 'id'=>'cp_background_style','name'=>THEME_NAME_S.'_background_style','options'=>array('0'=>'Pattern','1'=>'Custom Image','2'=>'None'),
				'description'=>'You can choose the background you want between our pre-provided petterns and your custom image.'),
			__('CHOOSE PATTERN','crunchpress')=>array(
				'type'=>'radioimage',
				'body_class'=>'cp_background_pattern',
				'name'=>THEME_NAME_S.'_background_pattern',
				'default'=>'1',
				'options'=>array(
					'1'=>array('value'=>'1', 'image'=>'/images/pattern/pattern-1.png'),
					'2'=>array('value'=>'2','image'=>'/images/pattern/pattern-2.png'),
					'3'=>array('value'=>'3','image'=>'/images/pattern/pattern-3.png'),
					'4'=>array('value'=>'4','image'=>'/images/pattern/pattern-4.png'),
					'5'=>array('value'=>'5','image'=>'/images/pattern/pattern-5.png'),
					'6'=>array('value'=>'6','image'=>'/images/pattern/pattern-6.png'),
					'7'=>array('value'=>'7','image'=>'/images/pattern/pattern-7.png'),
					'8'=>array('value'=>'8','image'=>'/images/pattern/pattern-8.png'),
					'9'=>array('value'=>'9','image'=>'/images/pattern/pattern-9.png'),
					'10'=>array('value'=>'10','image'=>'/images/pattern/pattern-10.png'),
					'11'=>array('value'=>'11','image'=>'/images/pattern/pattern-11.png'),
					'12'=>array('value'=>'12','image'=>'/images/pattern/pattern-12.png'),
					'13'=>array('value'=>'13','image'=>'/images/pattern/pattern-13.png'),
					'14'=>array('value'=>'14','image'=>'/images/pattern/pattern-14.png'),
					'15'=>array('value'=>'15','image'=>'/images/pattern/pattern-15.png'),
					'16'=>array('value'=>'16','image'=>'/images/pattern/pattern-16.png'),
					'17'=>array('value'=>'17','image'=>'/images/pattern/pattern-17.png'),
					'18'=>array('value'=>'18','image'=>'/images/pattern/pattern-18.png'),
					'19'=>array('value'=>'19','image'=>'/images/pattern/pattern-19.png'),
					'20'=>array('value'=>'20','image'=>'/images/pattern/pattern-20.png'),
					'21'=>array('value'=>'21','image'=>'/images/pattern/pattern-21.png'),
					'22'=>array('value'=>'22','image'=>'/images/pattern/pattern-22.png'),
				)
			),
			__('CUSTOM BACKGROUND', 'crunchpress')=>array(
				'type'=>'upload',
				'name'=>THEME_NAME_S.'_background_custom',
				'body_class'=>'cp_background_custom'), 
		),
		
		'cp_panel_load_color_scheme' => array(
			__('CHOOSE SKIN','crunchpress')=>array(
				'type'=>'radioimage',
				'body_class'=>'cp_color_scheme',
				'name'=>THEME_NAME_S.'_color_scheme',
				'default'=>'default',
				'options'=>array(
					'1'=>array('value'=>'color_scheme_1','image'=>'/framework/images/color-schemes/scheme-1.png'),
					'2'=>array('value'=>'color_scheme_2','image'=>'/framework/images/color-schemes/scheme-2.png'),
					'3'=>array('value'=>'color_scheme_3','image'=>'/framework/images/color-schemes/scheme-3.png'),
					'4'=>array('value'=>'color_scheme_4','image'=>'/framework/images/color-schemes/scheme-4.png'),
				)
			),
		),		
		
		'cp_panel_social_shares' => array(
			__('FACEBOOK', 'crunchpress')=>array('type'=>'radioenabled','name'=>THEME_NAME_S.'_facebook_share',
				'description'=>'Toggle to enable/disable the facebook shares in blog and portfolio page.'),
			__('TWITTER', 'crunchpress')=>array('type'=>'radioenabled','name'=>THEME_NAME_S.'_twitter_share',
				'description'=>'Toggle to enable/disable the twitter shares in blog and portfolio page.'),
			__('GOOGLE', 'crunchpress')=>array('type'=>'radioenabled','name'=>THEME_NAME_S.'_google_share',
				'description'=>'Toggle to enable/disable the google shares in blog and portfolio page.'),
			__('STUMBLE UPON', 'crunchpress')=>array('type'=>'radioenabled','name'=>THEME_NAME_S.'_stumble_upon_share',
				'description'=>'Toggle to enable/disable the stumble upon shares in blog and portfolio page.'),
			__('MY SPACE', 'crunchpress')=>array('type'=>'radioenabled','name'=>THEME_NAME_S.'_my_space_share',
				'description'=>'Toggle to enable/disable the my spce shares in blog and portfolio page.'),
			__('DELICIOUS', 'crunchpress')=>array('type'=>'radioenabled','name'=>THEME_NAME_S.'_delicious_share',
				'description'=>'Toggle to enable/disable the delicious shares in blog and portfolio page.'),
			__('DIGG', 'crunchpress')=>array('type'=>'radioenabled','name'=>THEME_NAME_S.'_digg_share',
				'description'=>'Toggle to enable/disable the digg shares in blog and portfolio page.'),
			__('LINKEDIN', 'crunchpress')=>array('type'=>'radioenabled','name'=>THEME_NAME_S.'_linkedin_share',
				'description'=>'Toggle to enable/disable the linkedin shares in blog and portfolio page.'),
			__('GOOGLE PLUS', 'crunchpress')=>array('type'=>'radioenabled','name'=>THEME_NAME_S.'_google_plus_share',
				'description'=>'Toggle to enable/disable the linkedin shares in blog and portfolio page.'),				
				
		),
			
		'cp_panel_copyright_area' => array( 
			__('SHOW COPYRIGHT', 'crunchpress')=>array('type'=>'radioenabled', 'name'=> THEME_NAME_S.'_show_copyright'),
			__('COPYRIGHT LEFT AREA', 'crunchpress')=>array('type'=>'textarea','name'=>THEME_NAME_S.'_copyright_left_area','default'=>'Copyright &copy; 2014. Designed by
<a href="http://crunchpress.com/">CrunchPress.com</a>'), 
		),
			
		// Elements Color
		
		'cp_panel_navigation' => array(
		    __('MAIN NAVIGATION BACKGROUND', 'crunchpress')=>array('type'=>'colorpicker','name'=>THEME_NAME_S.'_main_navigation_background','color_scheme_1'=>'#2E1308','color_scheme_2'=>'#2E1308','color_scheme_3'=>'#2D3247','color_scheme_4'=>'#2E1308','description'=>'This is the background color of menu'),
			__('BUTTON HOVER COLOR', 'crunchpress')=>array('type'=>'colorpicker','name'=>THEME_NAME_S.'_main_navigation_background_hover','color_scheme_1'=>'#FCBF9F','color_scheme_2'=>'#AF857E','color_scheme_3'=>'#5E6890','color_scheme_4'=>'#72651C','description'=>'This is the hover color of button in menu'),
			__('BUTTON TEXT COLOR', 'crunchpress')=>array('type'=>'colorpicker','name'=>THEME_NAME_S.'_main_navigation_text','color_scheme_1'=>'#ffffff','color_scheme_2'=>'#ffffff','color_scheme_3'=>'#ffffff','color_scheme_4'=>'#ffffff',
				'description'=>'This is the text color of the main navigation in the normal state.'),
			__('BUTTON TEXT HOVER COLOR', 'crunchpress')=>array('type'=>'colorpicker','name'=>THEME_NAME_S.'_main_navigation_text_hover','color_scheme_1'=>'#2E1308','color_scheme_2'=>'#2E1308','color_scheme_3'=>'#2E1308','color_scheme_4'=>'#2E1308',
				'description'=>'This is the text color of the main navigation in "hover" state.'),
			__('BUTTON TEXT CURRENT COLOR', 'crunchpress')=>array('type'=>'colorpicker','name'=>THEME_NAME_S.'_main_navigation_text_current','color_scheme_1'=>'#2E1308','color_scheme_2'=>'#2E1308','color_scheme_3'=>'#2E1308','color_scheme_4'=>'#2E1308','description'=>'This is the text color of the main navigation in "current page" state.'),	
			__('BUTTON CURRENT COLOR', 'crunchpress')=>array('type'=>'colorpicker','name'=>THEME_NAME_S.'_main_navigation_text_background_current','color_scheme_1'=>'#FCBF9F','color_scheme_2'=>'#AF857E','color_scheme_3'=>'#5E6890','color_scheme_4'=>'#72651C','description'=>'This is the text color of the main navigation in "current page" state.'),	
	
		),		
		
		'cp_panel_body' => array(	
			__('SIDEBAR TITLE COLOR', 'crunchpress')=>array('type'=>'colorpicker','name'=>THEME_NAME_S.'_sidebar_title_color','color_scheme_1'=>'#2E1308','color_scheme_2'=>'#2E1308','color_scheme_3'=>'#2E1308','color_scheme_4'=>'#2E1308','description'=>'This option will change heading color of sidebar'),
			__('SIDEBAR INFO COLOR', 'crunchpress')=>array('type'=>'colorpicker','name'=>THEME_NAME_S.'_sidebar_info_color','color_scheme_1'=>'#2E1308','color_scheme_2'=>'#2E1308','color_scheme_3'=>'#2E1308','color_scheme_4'=>'#2E1308'),
			__('SIDEBAR INFO HOVER COLOR', 'crunchpress')=>array('type'=>'colorpicker','name'=>THEME_NAME_S.'_sidebar_info_hover_color','color_scheme_1'=>'#C45C27','color_scheme_2'=>'#AF857E','color_scheme_3'=>'#5E6890','color_scheme_4'=>'#72651C'),
			__('TITLE COLOR', 'crunchpress')=>array('type'=>'colorpicker','name'=>THEME_NAME_S.'_title_color','color_scheme_1'=>'#2E1308','color_scheme_2'=>'#2E1308','color_scheme_3'=>'#2E1308','color_scheme_4'=>'#2E1308','description'=>'This option will change color of heading used in body',
				'description'=>'Changing will effect all title colors in theme except footer title, sidebar title, blog thumbnail title and portolio thumbnail title color.'),
			__('CONTENT COLOR', 'crunchpress')=>array('type'=>'colorpicker','name'=>THEME_NAME_S.'_content_color','color_scheme_1'=>'#5F5F5F','color_scheme_2'=>'#5F5F5F','color_scheme_3'=>'#5F5F5F','color_scheme_4'=>'#5F5F5F','description'=>'This option will change content color'),
	
			__('LINK COLOR', 'crunchpress')=>array('type'=>'colorpicker','name'=>THEME_NAME_S.'_link_color','color_scheme_1'=>'#C45C27','color_scheme_2'=>'#AF857E','color_scheme_3'=>'#5E6890','color_scheme_4'=>'#72651C',
				'description'=>'This color effects all of the link color in this theme.'),
			__('LINK HOVER COLOR', 'crunchpress')=>array('type'=>'colorpicker','name'=>THEME_NAME_S.'_link_hover_color','color_scheme_1'=>'#FCBF9F','color_scheme_2'=>'#AF857E','color_scheme_3'=>'#5E6890','color_scheme_4'=>'#72651C',
				'description'=>'This color effects all of the link color on "hover" state in this theme.'),
			__('ELEMENTS SHADOW', 'crunchpress')=>array('type'=>'colorpicker','name'=>THEME_NAME_S.'_elements_shadow','color_scheme_1'=>'#dddddd','color_scheme_2'=>'#dddddd','color_scheme_3'=>'#dddddd','color_scheme_4'=>'#dddddd',
				'description'=>'This color changes the elements shadow color in the container, including button, post and portfolio frame and sidebar shadow.'),
			),
		
		'cp_panel_footer' => array(	
			__('FOOTER TITLE COLOR', 'crunchpress')=>array('type'=>'colorpicker','name'=>THEME_NAME_S.'_footer_title_color','color_scheme_1'=>'#ffffff','color_scheme_2'=>'#ffffff','color_scheme_3'=>'#ffffff','color_scheme_4'=>'#ffffff','description'=>'This option will change heading color of footer'),	
			__('FOOTER CONTENT COLOR', 'crunchpress')=>array('type'=>'colorpicker','name'=>THEME_NAME_S.'_footer_content_color','color_scheme_1'=>'#ffffff','color_scheme_2'=>'#ffffff','color_scheme_3'=>'#ffffff','color_scheme_4'=>'#ffffff','description'=>'This option will change text color of footer widghets'),
			__('FOOTER CONTENT INFO COLOR', 'crunchpress')=>array('type'=>'colorpicker','name'=>THEME_NAME_S.'_footer_content_info_color','color_scheme_1'=>'#C7C7C7','color_scheme_2'=>'#C7C7C7','color_scheme_3'=>'#C7C7C7','color_scheme_4'=>'#C7C7C7',
				'description' =>'The content info is the color of the post date( in post/portfolio widget ) and twitter widget'),	
	       __('FOOTER LINK COLOR', 'crunchpress')=>array('type'=>'colorpicker','name'=>THEME_NAME_S.'_footer_link_color','color_scheme_1'=>'#ffffff','color_scheme_2'=>'#ffffff','color_scheme_3'=>'#ffffff','color_scheme_4'=>'#ffffff',
				'description'=>'This color changes all of the link color inside footer in normal state.'),
			__('FOOTER LINK HOVER COLOR', 'crunchpress')=>array('type'=>'colorpicker','name'=>THEME_NAME_S.'_footer_link_hover_color','color_scheme_1'=>'#C45C27','color_scheme_2'=>'#AF857E','color_scheme_3'=>'#5E6890','color_scheme_4'=>'#72651C',
				'description'=>'This is the link color of footer frame in "hover" state.'),	
		),
			
		'cp_panel_blog_port' => array(
			__('BLOG TITLE COLOR', 'crunchpress')=>array('type'=>'colorpicker','name'=>THEME_NAME_S.'_post_title_color','color_scheme_1'=>'#32302C','color_scheme_2'=>'#32302C','color_scheme_3'=>'#32302C','color_scheme_4'=>'#32302C',
				'description'=>'This is the blog thumbnail title color except the blog in WIDGET style.'),
			__('BLOG TITLE HOVER COLOR', 'crunchpress')=>array('type'=>'colorpicker','name'=>THEME_NAME_S.'_post_title_hover_color','color_scheme_1'=>'#818181','color_scheme_2'=>'#818181','color_scheme_3'=>'#818181','color_scheme_4'=>'#818181',
				'description'=>'This is the blog thumbnail title color in "hover" state.'),
			__('BLOG INFO COLOR', 'crunchpress')=>array('type'=>'colorpicker','name'=>THEME_NAME_S.'_post_info_color','color_scheme_1'=>'#818181','color_scheme_2'=>'#818181','color_scheme_3'=>'#818181','color_scheme_4'=>'#818181',
				'description'=>"This is the blog information color. It includes the color of blog date, blog comments number and blog author."),
			__('BLOG INFO HOVER COLOR', 'crunchpress')=>array('type'=>'colorpicker','name'=>THEME_NAME_S.'_post_info_hover_color','color_scheme_1'=>'#C45C27','color_scheme_2'=>'#AF857E','color_scheme_3'=>'#5E6890','color_scheme_4'=>'#72651C',
				'description'=>"This is the blog information color. It includes the hover color of blog date, blog comments number and blog author."),
			),			
		
		'cp_panel_contact_form' => array(
			__('CONTACT FORM/COMMENT BACKGROUND COLOR', 'crunchpress')=>array('type'=>'colorpicker','name'=>THEME_NAME_S.'_contact_form_background_color','color_scheme_1'=>'#ffffff','color_scheme_2'=>'#ffffff','color_scheme_3'=>'#ffffff','color_scheme_4'=>'#ffffff',
				'description'=>'This is a background color of textbox and textarea in contact form and comments area.'),
			__('CONTACT FORM/COMMENT TEXT COLOR', 'crunchpress')=>array('type'=>'colorpicker','name'=>THEME_NAME_S.'_contact_form_text_color','color_scheme_1'=>'#888888','color_scheme_2'=>'#888888','color_scheme_3'=>'#888888','color_scheme_4'=>'#888888',
				'description'=>'This is a text color of textbox and textarea in contact form and comments area.'),
			__('CONTACT FORM/COMMENT BORDER COLOR', 'crunchpress')=>array('type'=>'colorpicker','name'=>THEME_NAME_S.'_contact_form_border_color','color_scheme_1'=>'#cfcfcf','color_scheme_2'=>'#cfcfcf','color_scheme_3'=>'#cfcfcf','color_scheme_4'=>'#cfcfcf'),
			__('CONTACT FORM/COMMENT FRAME COLOR', 'crunchpress')=>array('type'=>'colorpicker','name'=>THEME_NAME_S.'_contact_form_frame_color','color_scheme_1'=>'#f8f8f8','color_scheme_2'=>'#f8f8f8','color_scheme_3'=>'#f8f8f8','color_scheme_4'=>'#f8f8f8'),
			__('CONTACT FORM/COMMENT INNER SHADOW', 'crunchpress')=>array('type'=>'colorpicker','name'=>THEME_NAME_S.'_contact_form_inner_shadow','color_scheme_1'=>'#ececec','color_scheme_2'=>'#ececec','color_scheme_3'=>'#ececec','color_scheme_4'=>'#ececec',
				'description'=>'An inner shadow of the textbox and textarea in contact form and comments area.'),
		),			
	
		'cp_panel_text_widget' => array(
			__('TEXT WIDGET TITLE COLOR', 'crunchpress')=>array('type'=>'colorpicker','name'=>THEME_NAME_S.'_text_widget_title_color','color_scheme_1'=>'#C45C27','color_scheme_2'=>'#AF857E','color_scheme_3'=>'#5E6890','color_scheme_4'=>'#72651C','description'=>'This option will change title color of text widget'),
			__('TEXT WIDGET CAPTION COLOR', 'crunchpress')=>array('type'=>'colorpicker','name'=>THEME_NAME_S.'_text_widget_caption_color','color_scheme_1'=>'#818181','color_scheme_2'=>'#818181','color_scheme_3'=>'#818181','color_scheme_4'=>'#818181','description'=>'This option will change caption color of text widget'),
			__('TEXT WIDGET BUTTON TEXT COLOR', 'crunchpress')=>array('type'=>'colorpicker','name'=>THEME_NAME_S.'_text_widget_button_color','color_scheme_1'=>'#F6F6F4','color_scheme_2'=>'#F6F6F4','color_scheme_3'=>'#F6F6F4','color_scheme_4'=>'#F6F6F4',
				'description'=>'If the button exists, this will be the text color of the button in text widget item.'),
			__('TEXT WIDGET BUTTON BACKGROUND', 'crunchpress')=>array('type'=>'colorpicker','name'=>THEME_NAME_S.'_text_widget_button_background','color_scheme_1'=>'#C45C27','color_scheme_2'=>'#AF857E','color_scheme_3'=>'#5E6890','color_scheme_4'=>'#72651C',
				'description'=>'If the button exists, this will be the background color of the button in text widget item.'),
		),	
		
		'cp_panel_misc_elements' => array(	
			__('TAB BACKGROUND', 'crunchpress')=>array('type'=>'colorpicker','name'=>THEME_NAME_S.'_tab_background_color','color_scheme_1'=>'#ffffff','color_scheme_2'=>'#ffffff','color_scheme_3'=>'#ffffff','color_scheme_4'=>'#ffffff',
				'description'=>'This is the tab header background in "non-active" state.'),
			__('TAB TEXT COLOR', 'crunchpress')=>array('type'=>'colorpicker','name'=>THEME_NAME_S.'_tab_text_color','color_scheme_1'=>'#848484','color_scheme_2'=>'#848484','color_scheme_3'=>'#848484','color_scheme_4'=>'#848484'),
			__('TAB ACTIVE BACKGROUND', 'crunchpress')=>array('type'=>'colorpicker','name'=>THEME_NAME_S.'_tab_active_background_color','color_scheme_1'=>'#f5f5f5','color_scheme_2'=>'#f5f5f5','color_scheme_3'=>'#f5f5f5','color_scheme_4'=>'#f5f5f5',
				'description'=>'This is the tab header background in "active" state.'),		
			__('TAB ACTIVE TEXT COLOR', 'crunchpress')=>array('type'=>'colorpicker','name'=>THEME_NAME_S.'_tab_active_text_color','color_scheme_1'=>'#353535','color_scheme_2'=>'#353535','color_scheme_3'=>'#353535','color_scheme_4'=>'#353535'),
			__('TAB BORDER COLOR', 'crunchpress')=>array('type'=>'colorpicker','name'=>THEME_NAME_S.'_tab_border_color','color_scheme_1'=>'#dddddd','color_scheme_2'=>'#dddddd','color_scheme_3'=>'#dddddd','color_scheme_4'=>'#dddddd'),
			__('BUTTON BACKGROUND COLOR', 'crunchpress')=>array('type'=>'colorpicker','name'=>THEME_NAME_S.'_button_background_color','color_scheme_1'=>'#C45C27','color_scheme_2'=>'#AF857E','color_scheme_3'=>'#5E6890','color_scheme_4'=>'#72651C',
				'description'=>'This color will changes all of the button background color in this theme except the button from shortcode and text widget.'),			
			__('BUTTON BORDER COLOR', 'crunchpress')=>array('type'=>'colorpicker','name'=>THEME_NAME_S.'_button_border_color','color_scheme_1'=>'','color_scheme_2'=>'#dddddd','color_scheme_3'=>'#dddddd','color_scheme_4'=>'#dddddd',
				'description'=>'This color will changes all of the button border color in this theme except the button from shortcode and text widget.'),			
			__('BUTTON TEXT COLOR', 'crunchpress')=>array('type'=>'colorpicker','name'=>THEME_NAME_S.'_button_text_color','color_scheme_1'=>'#ffffff','color_scheme_2'=>'#ffffff','color_scheme_3'=>'#ffffff','color_scheme_4'=>'#ffffff',
				'description'=>'This color will changes all of the button text color in this theme except the button from shortcode and text widget.'),			
			__('BUTTON TEXT HOVER COLOR', 'crunchpress')=>array('type'=>'colorpicker','name'=>THEME_NAME_S.'_button_text_hover_color','color_scheme_1'=>'#700000','color_scheme_2'=>'#628600','color_scheme_3'=>'#8e2b08','color_scheme_4'=>'#72651C',
				'description'=>'This color will changes all of the button text color of "hover" state in this theme except the button from shortcode and text widget.'),

__('ITEM PRICE COLOR', 'crunchpress')=>array('type'=>'colorpicker','name'=>THEME_NAME_S.'_price_item_price_color','color_scheme_1'=>'#3a3a3a','color_scheme_2'=>'#3a3a3a','color_scheme_3'=>'#3a3a3a','color_scheme_4'=>'#3a3a3a',
				'description'=>'This color will changes item price color'),

__('BEST PRICE ITEM COLOR', 'crunchpress')=>array('type'=>'colorpicker','name'=>THEME_NAME_S.'_price_item_best_price_color','color_scheme_1'=>'#C45C27','color_scheme_2'=>'#AF857E','color_scheme_3'=>'#5E6890','color_scheme_4'=>'#72651C',
				'description'=>'This color will changes best item price color'),
		__('PORTFOLIO HOVER COLOR', 'crunchpress')=>array('type'=>'colorpicker','name'=>THEME_NAME_S.'portfolio_hover_color','color_scheme_1'=>'#C45C27','color_scheme_2'=>'#AF857E','color_scheme_3'=>'#5E6890','color_scheme_4'=>'#72651C',
				'description'=>'This color will changes hover effect of portfolio'),
		),
		
		// Slider Setting
		'cp_panel_nivo_slider' => array(
			__('SLIDER EFFECTS', 'crunchpress')=>array(
				'type'=>'combobox',
				'oldname'=>'effect',
				'name'=>THEME_NAME_S.'_nivo_slider_effect',
				'options'=>array(
					'0'=>'sliceDown', '1'=>'sliceDownLeft', '2'=>'sliceUp',
					'3'=>'sliceUpLeft', '4'=>'sliceUpDown', '5'=>'sliceUpDownLeft',
					'6'=>'fold', '7'=>'fade', '8'=>'random',
					'9'=>'slideInRight', '10'=>'slideInLeft', '11'=>'boxRandom',
					'12'=>'boxRain', '13'=>'boxRainReverse', '14'=>'boxRainGrow',
					'15'=>'boxRainGrowReverse')),
			__('PAUSE ON HOVER', 'crunchpress')=>array('type'=>'radioenabled','oldname'=>'pauseOnHover','name'=>THEME_NAME_S.'_nivo_slider_pause_on_hover',
				'description'=>'Pause the nivo slider when user hover at the slider.'),
			__('SHOW BULLETS', 'crunchpress')=>array('type'=>'radioenabled','oldname'=>'controlNav','name'=>THEME_NAME_S.'_nivo_slider_show_bullets',
				'description'=>'Enable to show the nivo slider navigation bullets.'),
			__('SHOW LEFT/RIGHT NAVIGATION', 'crunchpress')=>array('type'=>'radioenabled','oldname'=>'directionNav','name'=>THEME_NAME_S.'_nivo_slider_show_navigation',
				'description'=>'Enable left/right navigation of the nivo slider.'),
			__('ONLY SHOW NAVIGATION WHEN HOVER', 'crunchpress')=>array('type'=>'radioenabled','oldname'=>'directionNavHide','name'=>THEME_NAME_S.'_nivo_slider_hover_navigation',
				'description'=>'If the left/right navigation is enabled, enabling this option will hide the left/right navigation when the mouse cursor is outside of the slider frame.'),
			__('ANIMATION SPEED', 'crunchpress')=>array('type'=>'inputtext','oldname'=>'animSpeed','name'=>THEME_NAME_S.'_nivo_slider_animation_speed','default'=>'500',
				'description'=>'This is the animation speed during the change of each slide.'),
			__('PAUSE TIME', 'crunchpress')=>array('type'=>'inputtext','oldname'=>'pauseTime','name'=>THEME_NAME_S.'_nivo_slider_pause_time','default'=>'3000',
				'description'=>'This option is the pause time of each slider.'),
			__('CAPTION OPACITY', 'crunchpress')=>array('type'=>'inputtext','oldname'=>'captionOpacity','name'=>THEME_NAME_S.'_nivo_slider_caption_opacity','default'=>'0.8'),
		),
		
		'cp_panel_flex_slider' => array(
			__('SLIDER EFFECTS', 'crunchpress')=>array('type'=>'combobox','oldname'=>'animation'
				,'name'=>THEME_NAME_S.'_flex_slider_effect', 'options'=>array('0'=>'fade', '1'=>'slide')),
			__('PAUSE ON HOVER', 'crunchpress')=>array('type'=>'radioenabled','oldname'=>'pauseOnHover','name'=>THEME_NAME_S.'_flex_slider_pause_on_hover','default'=>'disable',
				'description'=>'Pause the flex slider when user hover at the slider.'),
			__('SHOW BULLETS', 'crunchpress')=>array('type'=>'radioenabled','oldname'=>'controlNav','name'=>THEME_NAME_S.'_flex_slider_show_bullets',
				'description'=>'Enable to show the flex slider navigation bullets.'),
			__('SHOW NAVIGATION', 'crunchpress')=>array('type'=>'radioenabled','oldname'=>'directionNav','name'=>THEME_NAME_S.'_flex_slider_show_navigation',
				'description'=>'Enable left/right navigation of the flex slider.'),
			__('ANIMATION SPEED', 'crunchpress')=>array('type'=>'inputtext','oldname'=>'animationDuration','name'=>THEME_NAME_S.'_flex_slider_animation_speed','default'=>'600',
				'description'=>'This is the animation speed during the change of each slide.'),
			__('PAUSE TIME', 'crunchpress')=>array('type'=>'inputtext','oldname'=>'slideshowSpeed','name'=>THEME_NAME_S.'_flex_slider_pause_time','default'=>'7000',
				'description'=>'This option is the pause time of each slider.'),
			__('PAUSE ON ACTION', 'crunchpress')=>array('type'=>'radioenabled','oldname'=>'pauseOnAction','name'=>THEME_NAME_S.'_flex_slider_pause_on_action','default'=>'false'),
		),
	
				 
		'cp_panel_refine_slider' => array(
			__('SLIDER EFFECTS', 'crunchpress')=>array(
				'type'=>'combobox',
				'oldname'=>'transition',
				'name'=>THEME_NAME_S.'_refine_slider_effect',
				'options'=>array(
					'0'=>'fade', '1'=>'random', '2'=>'sliceH',
					'3'=>'sliceV', '4'=>'slideH', '5'=>'slideV',
					'6'=>'scale', '7'=>'fan', '8'=>'blockScale',
					'9'=>'kaleidoscope', '10'=>'blindH', '11'=>'blindV',
					'12'=>'cubeH', '13'=>'cubeV')),
			__('AUTOPLAY', 'crunchpress')=>array('type'=>'radioenabled','oldname'=>'autoPlay','name'=>THEME_NAME_S.'_refine_slider_autoplay',
				'description'=>'Autoplay refine slider.'),			
			__('SHOW LEFT/RIGHT NAVIGATION', 'crunchpress')=>array(
				'type'=>'combobox',
				'oldname'=>'controls',
				'name'=>THEME_NAME_S.'_refine_slider_show_navigation',
				'options'=>array(
					'0'=>'null', '1'=>'arrows', '2'=>'thumbs'),
				'description'=>'Enable left/right navigation of the refine slider.'),				
			__('KEYBOARD NAVIGATION', 'crunchpress')=>array('type'=>'radioenabled','oldname'=>'keyNav','name'=>THEME_NAME_S.'_refine_slider_key_navigation',
				'description'=>'Use left/right arrow keys to switch slide.'),
			__('ANIMATION SPEED', 'crunchpress')=>array('type'=>'inputtext','oldname'=>'transitionDuration','name'=>THEME_NAME_S.'_refine_slider_animation_speed','default'=>'500',
				'description'=>'This is the animation speed during the change of each slide.'),
			__('PAUSE TIME', 'crunchpress')=>array('type'=>'inputtext','oldname'=>'delay','name'=>THEME_NAME_S.'_refine_slider_pause_time','default'=>'3000',
				'description'=>'This option is the pause time of each slider.'),
		),
		
	);
	
	// add action to embeded the panel in to dashboard
	add_action('admin_menu','add_crunchpress_panel');
	function add_crunchpress_panel(){
	
	
		$page = add_menu_page('CrunchPress Option', THEME_NAME_F , 'manage_options', 'options', 'create_crunchpress_panel'); 
		  
		  /*add_menu_page('The Church SEO settings','SEO Options','manage_options','admin.php?page=seo_settings', array($this, 'options_panel'), CP_THEME_PATH_URL. '/framework/assets/images/seo-icon.png');*/
		
		add_action('admin_enqueue_scripts','register_crunchpress_panel_scripts');
		
	}
	
	
	// add ajax action to hook the functions when save button is pressed 
	add_action('wp_ajax_save_crunchpress_panel','save_crunchpress_panel');
	function save_crunchpress_panel(){
	
		check_ajax_referer(plugin_basename(__FILE__),'security');
		
		global $crunchpress_element;
		
		$return_data = array('success'=>'-1', 'alert'=>'Save option failed, please try contacting your host provider to increase the post_max_size and suhosin.post.max_vars varialble on the server.');
		
		foreach($crunchpress_element as $elements){
		
			foreach($elements as $element){
			
				// when save sidebar
				if($element['type'] == 'sidebar'){
				
					$sidebar_xml = '<sidebar>';
					if( !empty( $_POST[$element['name']] ) ){
						$sidebar = $_POST[$element['name']];     
					}else{
						$sidebar = array();
					}
					
					foreach($sidebar as $sidebar_name){
					
						$sidebar_xml = $sidebar_xml . create_xml_tag('name',$sidebar_name);
						
					}
					
					$sidebar_xml = $sidebar_xml . '</sidebar>';
					
					if(!save_option($element['name'], get_option($element['name']), $sidebar_xml)){
					
						die( json_encode($return_data) );
						
					}
					
				// when save uploaded font
				}else if($element['type'] == 'uploadfont'){
				
					$uploadfont_xml = '<uploadfont>';
					if( !empty($_POST[$element['name']]) && !empty($_POST[$element['file']]) ){
						$uploadfont = $_POST[$element['name']];
						$uploadfont_file = $_POST[$element['file']];
						$num = sizeof($uploadfont);
						
						for($i=0; $i<$num; $i++){
						
							$uploadfont_xml = $uploadfont_xml . '<font>';
							$uploadfont_xml = $uploadfont_xml . create_xml_tag('name', $uploadfont[$i]);
							$uploadfont_xml = $uploadfont_xml . create_xml_tag('file', $uploadfont_file[$i]);
							$uploadfont_xml = $uploadfont_xml . '</font>';
							
						}
					}
					$uploadfont_xml = $uploadfont_xml . '</uploadfont>';
					
					if(!save_option($element['name'], get_option($element['name']), $uploadfont_xml)){
					
						die( json_encode($return_data) );
						
					}
					
				// do nothing with dummy button
				}else if($element['type'] == 'dummy'){
				
				}else if( !empty($element['name']) ){
					if( !empty( $_POST[$element['name']] ) ){
						$new_option_value = str_replace( "\'" , "'", $_POST[$element['name']]);
						$new_option_value = str_replace( '\"' , '"', $new_option_value);
						$new_option_value = str_replace( '\\\\' , '\\' , $new_option_value);
					}else{
						$new_option_value = '';
					}
					
					if(!save_option($element['name'], get_option($element['name']), $new_option_value)){
					
						die( json_encode($return_data) );
						
					}
					
				}
				
			}
			
		}
		
		// call the function to generate the style-custom.css file.
		cp_generate_style_custom();
		
		die( json_encode( array('success'=>'0') ) );
		
	}
	
	// update the option if new value is exists and not equal to old one 
	function save_option($name, $old_value, $new_value){
	
		if(empty($new_value) && !empty($old_value)){
		
			if(!delete_option($name)){
			
				return false;
				
			}
			
		}else if($old_value != $new_value){
		
			if(!update_option($name, $new_value)){
			
				return false;
				
			}
			
		}
		
		return true;
		
	}
	
	// start creating the CrunchPress panel ( by calling function to create menu and elements )
	function create_crunchpress_panel(){
	
		global $crunchpress_menu;
		global $crunchpress_element;
		
		?>
		
		<form name="goodlayer-panel-form" id="goodlayer-panel-form">
			<div class="crunchpress-panel-wrapper">
			<?php
				
				echo '<div class="panel-menu">';
				echo '<div class="panel-menu-header"><div class="panel-menu-header-strap"></div>';
				echo '<img src="' . CP_PATH_URL . '/framework/images/admin-panel-logo.png" width="180px;" alt="crunchpress"/>';
				echo '</div>';
				
					create_crunchpress_menu($crunchpress_menu);
					
				echo '</div>';
				echo '<div class="panel-elements" id="panel-elements">';
				echo '<div class="panel-element-head"><div class="panel-element-header-strap"></div>';
				
				echo '<div class="panel-header-left-text">';
				echo '<div class="panel-crunchpress-text">'.THEME_NAME_F.'</div>';
				echo '<div class="panel-admin-panel-text">admin panel</div>';
				echo '</div>';
				
				echo '</div>';	
				
				echo '<div class="panel-element" id="panel-element-save-complete">';
				echo '<div class="panel-element-save-text">Save Options Complete.</div>';
				echo '<div class="panel-element-save-arrow"></div></div>';
			
					create_crunchpress_elements($crunchpress_element);
				
				echo '<div class="panel-element-tail">';
				echo '<div class="tail-save-changes"><div class="loading-save-changes"></div>';
				echo '<input type="submit" value="' . __('Save Changes','crunchpress') . '">';
				echo '</div>';						
				echo '</div>';						
				echo '<input type="hidden" name="action" value="save_crunchpress_panel">';
				echo '<input type="hidden" name="security" value="' . wp_create_nonce(plugin_basename(__FILE__)) . '">';
				echo '</div>';	
				
			?>

			</div>
		</form>
		
		<?php
	}
	
	// Create accordion menu
	function create_crunchpress_menu($menu){
		echo '<div id="panel-nav"><ul>';
		
		foreach($menu as $title=>$sub_menu){ 
		
			echo '<li>';
			echo '<a id="parent" href="#" >';
			echo '<div class="top-menu-bar"></div>';
			echo '<div class="top-menu-image"><img src="' . CP_PATH_URL . '/framework/images/admin-panel/' . str_replace(' ', '', $title) . '.png"/></div>';
			echo '<span class="top-menu-text">' . __($title, 'crunchpress') . '</span>';
			echo '</a>';
			echo '<ul>';
			
			foreach($sub_menu as $sub_title=>$name){
			
				echo '<li>';
				echo '<a id="children" href="#" rel=' . $name . '>';
				echo '<div class="child-menu-image"></div>';
				echo '<span class="child-menu-text">' . __($sub_title, 'crunchpress') . '</span>';
				echo '</a>';
				echo '</li>';
				
			}
			
			echo '</ul>';
			echo '</li>';
			
		}
		
		echo '</ul></div>';
		
	}
	
	// decide to create each input element base on the receiving key of elements
	function create_crunchpress_elements($elements){
	
		foreach($elements as $key => $element){
		
			echo '<div class="panel-element" id=' . $key . '>';

				foreach($element as $key => $values){
				
					if( !empty($values['name']) ){
						$values['value'] = get_option($values['name']);
						$values['default'] = (isset($values['default']))? $values['default']: '';
					}
					
					switch($values['type']){
					
						case 'upload': print_panel_upload($key, $values); break;
						case 'inputtext': print_panel_input_text($key, $values); break;
						case 'textarea': print_panel_input_textarea($key, $values); break;
						case 'radioenabled': print_panel_radio_enabled($key, $values); break;
						case 'radioimage' : print_panel_radioimage($key, $values); break;
						case 'combobox': print_panel_combobox($key, $values); break;
						case 'font-combobox': print_panel_font_combobox($key, $values); break;
						case 'colorpicker': print_panel_color_picker($key, $values); break;
						case 'sliderbar': print_panel_sliderbar($key, $values); break;
						case 'sidebar': print_panel_sidebar($key, $values); break;
						case 'uploadfont': print_panel_upload_font($key, $values); break;
						case 'button': print_panel_button($key, $values); break;
						case 'dummy': print_panel_dummy(); break;
						case 'notice': print_panel_notice(); break;
						
						
						
					}
					
				}
			
			echo '</div>';
			
		}
		
	}
	
	/*  ---------------------------------------------------------------------
	*	The following section is the template of input elements
	*	---------------------------------------------------------------------
	*/
	
	// Upload => name, value, default
	function print_panel_upload($title, $values){
	
		extract($values);
		if( empty( $body_class ) ){ $body_class = $name; }
		
		?>
			<div class="panel-body body-<?php echo $body_class; ?>">
				<div class="panel-body-gimmick"></div>
				<div class="panel-title">
					<label for="<?php echo $name; ?>" > <?php _e($title, 'crunchpress'); ?> </label>
				</div>
				<div class="panel-input">	
					<div class="input-example-image" id="input-example-image">
					<?php 
					
						$image_src = '';
						
						if(!empty($value)){ 
						
							$image_src = wp_get_attachment_image_src( $value, 'full' );
							$image_src = (empty($image_src))? '': $image_src[0];
							$thumb_src_preview = wp_get_attachment_image_src( $value, '150x150');
							echo '<img src="' . $thumb_src_preview[0] . '" />';
							
						} 
						
					?>			
					</div>
					<input name="<?php echo $name; ?>" type="hidden" id="upload_image_attachment_id" value="<?php 
					
						echo ($value == '')? esc_html($default): esc_html($value);
						
					?>" />
					<input id="upload_image_text" class="upload_image_text" type="text" value="<?php echo $image_src; ?>" />
					<input class="upload_image_button" type="button" value="Upload" />
				</div>
				<br class="clear">
			</div>
			
		<?php
		
	}
	
	// text => name, value, default
	function print_panel_input_text($title, $values){
	
		extract($values);
		
		?>
			<div class="panel-body">
				<div class="panel-body-gimmick"></div>
				<div class="panel-title">
					<label for="<?php echo $name; ?>" > <?php _e($title, 'crunchpress'); ?> </label>
				</div>
				<div class="panel-input">
					<input type="text" name="<?php echo $name; ?>" id="<?php echo $name; ?>" value="<?php 
						
						echo ($value == '')? esc_html($default): esc_html($value);
						
						 ?>" />
				</div>
				<?php if(isset($description)){ ?>
				
					<div class="panel-description"><?php _e($description, 'crunchpress'); ?></div>
					<div class="panel-description-info-img"></div>
					
				<?php } ?>
				<br class="clear">
			</div>
			
		<?php
	
	}
	
	// textarea => name, value, default
	function print_panel_input_textarea($title, $values){
	
		extract($values);
		
		?>
		
			<div class="panel-body">
				<div class="panel-body-gimmick"></div>
				<div class="panel-title">
					<label for="<?php echo $name; ?>"><?php _e($title, 'crunchpress'); ?></label>
				</div>
				<div class="panel-input">
					<textarea name="<?php echo $name; ?>" id="<?php echo $name; ?>" ><?php
						
						echo ($value == '')? esc_html($default): esc_html($value);
						
					?></textarea>
				</div>
				<?php if(isset($description)){ ?>
				
					<div class="panel-description"><?php _e($description, 'crunchpress'); ?></div>
					<div class="panel-description-info-img"></div>
					
				<?php } ?>
				<br class="clear">
			</div>
			
		<?php
		
	}
	
	// radioenabled => name, value
	function print_panel_radio_enabled($title, $values){
	
		extract($values);
		
		?>
		
			<div class="panel-body">
				<div class="panel-body-gimmick"></div>
				<div class="panel-title">
					<label for="<?php echo $name; ?>"><?php _e($title, 'crunchpress'); ?></label>
				</div>
				<div class="panel-input">
					<label for="<?php echo $name; ?>"><div class="checkbox-switch <?php
						
						echo ($value=='enable' || ($value=='' && empty($default)))? 'checkbox-switch-on': 'checkbox-switch-off'; 

					?>"></div></label>
					<input type="checkbox" name="<?php echo $name; ?>" class="checkbox-switch" value="disable" checked>
					<input type="checkbox" name="<?php echo $name; ?>" id="<?php echo $name; ?>" class="checkbox-switch" value="enable" <?php 
						
						echo ($value=='enable' || ($value=='' && empty($default)))? 'checked': ''; 
					
					?>>
				</div>
				<?php if(isset($description)){ ?>
				
					<div class="panel-description"><?php _e($description, 'crunchpress'); ?></div>
					<div class="panel-description-info-img"></div>
					
				<?php } ?>
				<br class="clear">
			</div>
			
		<?php
		
	}
	
	function print_panel_radioimage($title, $values){
		
		extract($values);
		
		if( empty( $body_class ) ){ $body_class = $name; }
		
		?>
		
			<div class="panel-body body-<?php echo $body_class; ?>">
				<div class="panel-body-gimmick"></div>
				<div class="panel-title">
					<label for="<?php echo $name; ?>"><?php _e($title, 'crunchpress'); ?></label>
				</div>
				<div class="panel-radioimage">
				
					<?php foreach( $options as $option ){ ?>
					
						<div class='radio-image-wrapper'>
							<label for="<?php echo $option['value']; ?>">
								<img src=<?php echo CP_PATH_URL.$option['image']?> class="<?php echo $name; ?>" alt=<?php echo $name;?>>
								<div id="check-list"></div>                                
							</label>
							<input type="radio" name="<?php echo $name; ?>" value="<?php echo $option['value']; ?>" <?php 
								if($value == $option['value']){
									echo 'checked';
								}else if($value == '' && $default == $option['value']){
									echo 'checked';
								}
							?> id="<?php echo $option['value']; ?>" class="<?php echo $name; ?>"
                            >                            
						</div>
						
					<?php } ?>
					<br class="clear">	
				</div>
			</div>		
		
		<?php
		
	}
	
	// combobox => name, value, options[]
	function print_panel_combobox($title, $values){
	
		extract($values);
		
		if( empty($body) ) $body = "";
		if( empty($id) ) $id = $name;
		
		?>
		
			<div class="panel-body <?php echo $body; ?>">	
				<div class="panel-body-gimmick"></div>
				<div class="panel-title">
					<label for="<?php echo $name; ?>"><?php _e($title, 'crunchpress'); ?></label>
				</div>
				<div class="panel-input">	
					<div class="combobox">
						<select name="<?php echo $name; ?>" id="<?php echo $id; ?>">
						
							<?php foreach($options as $option){ ?>
							
								<option <?php if( $option == esc_html($value) ){ echo 'selected'; }?>><?php echo $option; ?></option>
							
							<?php } ?>
							
						</select>
					</div>
				</div>
				<?php if(isset($description)){ ?>
				
					<div class="panel-description"><?php _e($description, 'crunchpress'); ?></div>
					<div class="panel-description-info-img"></div>
					
				<?php } ?>
				<br class="clear">
			</div>
			
		<?php
		
	}	
	
	// font-combobox => name, value, options[]
	function print_panel_font_combobox($title, $values){
	
		extract($values);
		if(empty($value)){ $value = $default; } 
		$elements = get_font_array();
		
		?>
		
			<div class="panel-body">
				<div class="panel-body-gimmick"></div>
				<div class="panel-title">
					<label for="<?php echo $name; ?>"><?php _e($title, 'crunchpress'); ?></label>
				</div>
				<div class="panel-input">	
					<div class="panel-font-sample" id="panel-font-sample"><?php echo FONT_SAMPLE_TEXT; ?></div> 
					<div class="combobox" id="combobox-font-sample">
						<select name="<?php echo $name; ?>" id="<?php echo $name; ?>" class="cp-panel-select-font-family">
						
							<?php foreach($elements as $option_name => $status){ ?>
							
								<option <?php if( $option_name==substr(esc_html($value),2) ){ echo 'selected'; }?> <?php echo $status; ?>><?php 
										
										echo ($status=='enabled')?  '- ':'';
										echo $option_name; 
									
									?></option>
							
							<?php } ?>
							
						</select>
					</div>
				</div>
				<?php if(isset($description)){ ?>
				
					<div class="panel-description"><?php _e($description, 'crunchpress'); ?></div>
					<div class="panel-description-info-img"></div>
					
				<?php } ?>
				<br class="clear">
			</div>
			
		<?php
		
	}	
	
	// colorpicker => name, value, default
	function print_panel_color_picker($title, $values){
	
		extract($values);
		
		?>
		
			<div class="panel-body">
				<div class="panel-body-gimmick"></div>
				<div class="panel-title">
					<label for="<?php echo $name; ?>" > <?php _e($title, 'crunchpress'); ?> </label>
				</div>
				<div class="panel-input">
					<input type="text" name="<?php echo $name; ?>" class="color-picker" value="<?php 
												
						echo ($value == '')? esc_html( $color_scheme_1): esc_html($value);
						
						?>" color_scheme_1="<?php echo $color_scheme_1; ?>" color_scheme_2="<?php echo $color_scheme_2; ?>" color_scheme_3="<?php echo $color_scheme_3; ?>" color_scheme_4="<?php echo $color_scheme_4; ?>" />
				</div>
				<?php if(isset($description)){ ?>
				
					<div class="panel-description"><?php _e($description, 'crunchpress'); ?></div>
					<div class="panel-description-info-img"></div>
					
				<?php } ?>
				<br class="clear">
			</div>
			
		<?php
	}
	
	// sliderbar => name, value, default
	function print_panel_sliderbar($title, $values){
	
		extract($values);
		
		?>
		
			<div class="panel-body">
				<div class="panel-body-gimmick"></div>
				<div class="panel-title">
					<label for="<?php echo $name; ?>" > <?php _e($title, 'crunchpress'); ?> </label>
				</div>
				<div class="panel-input">
					<div id="<?php echo $name; ?>" class="sliderbar" rel="sliderbar"></div>
					<input type="hidden" name="<?php echo $name; ?>" value="<?php echo ($value == '')? esc_html($default): esc_html($value); ?>" >
					<div id="slidertext"><?php echo ($value == '')? esc_html($default): esc_html($value); ?> px</div>
				</div>
				<?php if(isset($description)){ ?>
				
					<div class="panel-description"><?php _e($description, 'crunchpress'); ?></div>
					<div class="panel-description-info-img"></div>
					
				<?php } ?>
				<br class="clear">
			</div>
			
		<?php
		
	}
	
	// sidebar => name, value
	function print_panel_sidebar2($title, $values){
	
		extract($values);
		
		?>
		
		<div class="panel-body" id="panel-body">
			<div class="panel-body-gimmick"></div>
			<div class="panel-title">
				<label> <?php _e($title, 'crunchpress'); ?> </label>
			</div>
			<div class="panel-input">
				<input type="text" id="add-more-sidebar" value="type title here" rel="type title here">
				<div id="add-more-sidebar" class="add-more-sidebar"></div>
			</div>
				<?php if(isset($description)){ ?>
				
					<div class="panel-description"><?php _e($description, 'crunchpress'); ?></div>
					
				<?php } ?>
			<br class="clear">
			<div id="selected-sidebar" class="selected-sidebar">
				<div class="default-sidebar-item" id="sidebar-item">
					<div class="panel-delete-sidebar"></div>
					<div class="slider-item-text"></div>
					<input type="hidden" id="<?php echo $name; ?>">
				</div>
				
				<?php 
				
				if(!empty($value)){
					
					$xml = new DOMDocument();
					$xml->loadXML($value);
					
					foreach( $xml->documentElement->childNodes as $sidebar_name ){
					
				?>
						<div class="sidebar-item" id="sidebar-item">
							<div class="panel-delete-sidebar"></div>
							<div class="slider-item-text"><?php echo $sidebar_name->nodeValue; ?></div>
							<input type="hidden" name="<?php echo $name; ?>[]" id="<?php echo $name; ?>" value="<?php echo $sidebar_name->nodeValue; ?>">
						</div>
					
				<?php 
					} 
					
				} 
				
				?>
				
			</div>
		</div>
		<?php 
		
	}
	
	// uploadfont => name, value
	function print_panel_upload_font($title, $values){
	
		extract($values);
		
		?>
		
		<div class="panel-body" id="panel-body">
			<div class="panel-body-gimmick"></div>
			<div class="panel-title panel-add-more-title">
				<?php _e($title, 'crunchpress'); ?>
			</div>
			<div id="add-more-font" class="add-more-font"></div>
			<br class="clear">
			<div id="added-font" class="added-font">
				<div class="default-font-item" id="font-item">
					<div class="inner-font-item">
						<div class="panel-font-title"><?php _e('Font Name','crunchpress'); ?></div>
						<input type="text" id="<?php echo $name; ?>" class="cp_upload_font_name" readonly>
					</div>
					<div class="inner-font-item">
						<div class="panel-font-title"><?php _e('Font File','crunchpress'); ?></div>
						<input type="hidden" id="<?php echo $file; ?>"  class="font-attachment-id">
						<input type="text" class="upload-font-text" readonly>
						<input class="upload-font-button" type="button" value="Upload" />
					</div>
					<div class="panel-delete-font"></div>
				</div>
				<?php 
				
					if(!empty($value)){
						
						$xml = new DOMDocument();
						$xml->loadXML($value);
						
						foreach( $xml->documentElement->childNodes as $each_font ){
						
				?>
				
					<div class="font-item" id="font-item">
						<div class="inner-font-item">
							<div class="panel-font-title"><?php _e('Font Name','crunchpress'); ?></div>
							<input type="text" name="<?php echo $name; ?>[]" id="<?php echo $name; ?>" value="<?php echo find_xml_value($each_font, 'name'); ?>" class="cp_upload_font_name" readonly>
						</div>
						<div class="inner-font-item">
							<div class="panel-font-title"><?php _e('Font File','crunchpress'); ?></div>
							<input type="hidden" name="<?php echo $file; ?>[]" id="<?php echo $file; ?>" class="font-attachment-id" value="<?php 
									$attachment_id = find_xml_value($each_font, 'file'); 
									echo $attachment_id;
								?>" >
							<input type="text" class="upload-font-text" value="<?php echo (empty($attachment_id))? '': wp_get_attachment_url( $attachment_id ); ?>" readonly>
							<input class="upload-font-button" type="button" value="Upload" />
						</div>
						<div class="panel-delete-font"></div>
					</div>
					
				<?php 
				
						}
						
					}
					
				?>
				
			</div>
		</div>
		<?php
		
	}
	
	// print normal button
	function print_panel_button($title, $values){
	
		extract($values);
	
		?>

			<div class="panel-body">
				<div class="panel-body-gimmick"></div>
				<div class="panel-title">
					<label> <?php _e($title, 'crunchpress'); ?> </label>
				</div>
				<div class="panel-input">
					<input type="button" value="<?php echo $text; ?>" id="<?php echo $id; ?>" />
				</div>
				<?php if(isset($description)){ ?>
				
					<div class="panel-description"><?php _e($description, 'crunchpress'); ?></div>
					<div class="panel-description-info-img"></div>
					
				<?php } ?>
				<br class="clear">
			</div>		
		
		<?php	
	}
	
	// upload dummy data (from xml file)
	function print_panel_dummy(){
		?>

			<div class="panel-body">
				<div class="panel-body-gimmick"></div>
				<div class="panel-title">
					<label> DUMMIES DATA </label>
				</div>
				<div class="panel-input">
					<input type="button" value="Import Dummies Data" id="import-dummies-data" />
					<div id="import-now-loading" class="now-loading"></div>
				</div>
				<div class="panel-description">
					By clicking this button, you can import the dummy post and page to help 
					you create a site that look like theme preview to help you understand the
					function of this theme better. <br><br>
					*** It may takes a while during importing process, make sure not to reload
					the page or make any changes to the database.
				</div>
				<div class="panel-description-info-img"></div>
				<br class="clear">
			</div>		
		
		<?php
	}
	
	
	function print_panel_notice(){
		?>
            <style>
			
			</style>
			<div class="panel-body">
				<div class="panel-body-gimmick"></div>
								
				<div class="panel-notice" >
				<div class="warning"><h3>	Please install Woocommerce Plugin to see the options for Products Page. </h3></div>
				 
				</div>
				
				<br class="clear">
			</div>		
		
		<?php
	}
?>