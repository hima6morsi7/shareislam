<?php
	/*	
	*	CrunchPress Custom Style File (style-custom.php)
	*	---------------------------------------------------------------------
	*	This file fetch all style options in admin panel to generate the css
	*	to attach to header.php file
	*	---------------------------------------------------------------------
	*/

	header('Content-type: text/css;');
	
	$current_url = dirname(__FILE__);
	$wp_content_pos = strpos($current_url, 'wp-content');
	$wp_content = substr($current_url, 0, $wp_content_pos);

	require_once($wp_content . 'wp-load.php');
	define('THEME_NAME_S','cp');
?>

<?php $color_scheme = get_option(THEME_NAME_S.'_color_scheme','color_scheme_1'); ?>

/* Background
   ------------------------------------------------------------------ */
<?php 
	$background_style =  get_option(THEME_NAME_S.'_background_style','Pattern');
	if($background_style == 'Pattern'){
		$background_pattern = get_option(THEME_NAME_S.'_background_pattern','1');
		?>
		
		html{ 
			background-image: url('<?php echo CP_PATH_URL; ?>/images/pattern/pattern-<?php echo $background_pattern; ?>.png');
			background-repeat: repeat; 
		}
		
		<?php
	}
?>

/* Logo - Header Area
   ------------------------------------------------------------------ */
.logo-wrapper{ 
	margin-top: <?php echo get_option(THEME_NANE_S . 'logo_margin', ''); ?>;	
}  
.top-banner-wrapper{
	margin-top: <?php echo get_option(THEME_NANE_S . '_banner_top_margin', '36'); ?>px;
	margin-bottom: <?php echo get_option(THEME_NANE_S . '_banner_bottom_margin', '0'); ?>px;
}
header.main{
    border-color:  <?php echo get_option(THEME_NAME_S.'_top_navigation_bottom_bar','#C45C27'); ?> !important;
}

/* Social Network
   ------------------------------------------------------------------ */
.social-wrapper{
	margin-top: <?php echo get_option(THEME_NANE_S . '_social_wrapper_margin', '95'); ?>px;
}  
   
/* Font Size
   ------------------------------------------------------------------ */
body{
	font-size: <?php echo get_option(THEME_NAME_S.'_content_size', '12'); ?>px;
}
h1{
	font-size: <?php echo get_option(THEME_NAME_S.'_h1_size', '30'); ?>px;
}
h2{
	font-size: <?php echo get_option(THEME_NAME_S.'_h2_size', '25'); ?>px;
}
h3{
	font-size: <?php echo get_option(THEME_NAME_S.'_h3_size', '20'); ?>px;
}
h4{
	font-size: <?php echo get_option(THEME_NAME_S.'_h4_size', '18'); ?>px;
}
h5{
	font-size: <?php echo get_option(THEME_NAME_S.'_h5_size', '16'); ?>px;
}
h6{
	font-size: <?php echo get_option(THEME_NAME_S.'_h6_size', '15'); ?>px;
}

/* Element Color
   ------------------------------------------------------------------ */
   
html{
   <?php /*?> background-color:  <?php echo get_option(THEME_NAME_S.'_body_background','#f7f7f7'); ?>;<?php */?>
}


/* Font Family 
  ------------------------------------------------------------------ */
body{
    font-family:<?php echo substr(get_option(THEME_NAME_S.'_content_font'), 2);?>;
}
 
<?php $rtl = get_option ( THEME_NAME_S . '_rtl', 'disable' ); ?>

<?php if ($rtl== "enable") {echo 'body {text-align:right; } .cp-page-title {text-align:right;}
.sf-menu, .sf-menu li {float:right;} ';	}?>

body {
	text-align:<?php echo $rtl?>;
}

h1, h2, h3, h4, h5, h6, .cp-title{
    font-family:<?php echo substr(get_option(THEME_NAME_S.'_header_font'), 2);?>;
    color:<?php echo get_option(THEME_NANE_S . '_title_color', '#2E1308'); ?>;
}

div.shortcode-block-quote-left,div.shortcode-block-quote-right,div.shortcode-block-quote-center {
   font-family:<?php echo substr(get_option(THEME_NAME_S.'_header_font'), 2);?>;
}

h1.stunning-text-title{
	font-family: <?php echo substr(get_option(THEME_NANE_S.'_stunning_text_font'), 2); ?>;
    
	color: <?php echo get_option(THEME_NANE_S . '_stunning_text_title_color', '#333333'); ?>;
}
.stunning-text-caption{
	color: <?php echo get_option(THEME_NANE_S . '_stunning_text_caption_color', '#666666'); ?>;
}
  
/* Font Color
   ------------------------------------------------------------------ */
body{
	color: <?php echo get_option(THEME_NAME_S.'_content_color','#5F5F5F'); ?>!important;
}
a, .dropdown_widget .footer-wrapper form .register ,div.scroll-top,#twitter a i{
	color: <?php echo get_option(THEME_NAME_S.'_link_color','#C45C27'); ?>;
}
a:hover{
	color:  <?php echo get_option(THEME_NAME_S.'_link_hover_color','#700000'); ?>;
}
.footer-wrapper a{
	color:  <?php echo get_option(THEME_NAME_S.'_footer_link_color','#9A9992'); ?>;
}
.footer-wrapper a:hover{
	color:  <?php echo get_option(THEME_NAME_S.'_footer_link_hover_color','#C45C27'); ?>;
}  
.pika-stage .caption, .flex-caption{
	color: <?php echo get_option(THEME_NANE_S . '_slider_caption_color', '#d9d9d9'); ?> !important;
} 

.nivo-caption { 
	background: url('<?php echo CP_PATH_URL; ?>/images/color_schemes/<?php echo $color_scheme; ?>/captionbg.png') !important; 
}
 
.sidebar-title-color, .sidebar-header-title{
    color: <?php echo get_option(THEME_NAME_S.'_sidebar_title_color','#494949'); ?>!important;
}
.sidebar-content-color{
	color: <?php echo get_option(THEME_NANE_S.'_sidebar_content_color', '#989898'); ?> !important;
}
.custom-sidebar .post-info-color{
	color: <?php echo get_option(THEME_NAME_S.'_sidebar_info_color','#a4a4a4'); ?> ;
}
.custom-sidebar .post-info-color:hover{
	color: <?php echo get_option(THEME_NAME_S.'_sidebar_info_hover_color','#a4a4a4'); ?>;
}
.custom-sidebar .cp-widget-tab-header-item a{
	color: <?php echo get_option(THEME_NANE_S.'_tab_widget_title_color', '#a0a0a0'); ?> !important;
}
.custom-sidebar .cp-widget-tab-header-item.active a{
	color: <?php echo get_option(THEME_NANE_S.'_tab_widget_title_active_color', '#ef7f2c'); ?> !important;
}

/* Post-Portfolio Color
   ------------------------------------------------------------------ */
 
div.portfolio-thumbnail-image-hover{
    background-color: <?php echo get_option(THEME_NAME_S.'portfolio_hover_color','#C45C27'); ?> !important;
}	  
.post-title-color{
	color: <?php echo get_option(THEME_NAME_S.'_post_title_color','#333333'); ?>!important;
}
h3.portfolio-header-title, h3.product-header-title{
	color: <?php echo get_option(THEME_NAME_S.'_prod_port_title_color','#4d4d4d'); ?>!important;
}
.post-title-color a:hover{
    color: <?php echo get_option(THEME_NAME_S.'_post_title_hover_color','#707070'); ?>!important;
}
.post-widget-title-color{
	color: <?php echo get_option(THEME_NANE_S.'_post_widget_title_color', '#ef7f2c'); ?> !important;
}
.post-info-color, .custom-sidebar #twitter_update_list, .blog-thumbnail-info a,.single-thumbnail-info a{
    color: <?php echo get_option(THEME_NAME_S.'_post_info_color','#818181'); ?>!important;
}
.custom-sidebar #twitter_update_list, .blog-thumbnail-info a:hover,.single-thumbnail-info a:hover{
    color: <?php echo get_option(THEME_NAME_S.'_post_info_hover_color','#C45C27'); ?>!important;
}
.pagination{
	border-color: <?php echo get_option(THEME_NANE_S.'_pagination_border', '#dfdfdf'); ?>; 
}
.pagination a{ 
	color: <?php echo get_option(THEME_NANE_S.'_pagination_text_color', '#8c8c8c'); ?>; 
	background-color: <?php echo get_option(THEME_NANE_S.'_pagination_background', '#f0f0f0'); ?>; 
}
.pagination a:hover, .pagination span.current{ 
	color: <?php echo get_option(THEME_NANE_S.'_pagination_hover_text', '#525252'); ?>; 
	background-color: <?php echo get_option(THEME_NANE_S.'_pagination_hover_background', '#ffffff'); ?>; 
}
.filter-nav ul li a.active{
	border-bottom: <?php echo get_option(THEME_NANE_S.'_filter_selected_color', '#72651C'); ?>;
}

/* Column Service
   ------------------------------------------------------------------ */
h2.column-service-title{
	color: <?php echo get_option(THEME_NANE_S.'_column_service_title_color', '#ef7f2c'); ?> !important;
}

/* Stunning Text
   ------------------------------------------------------------------ */
h3.text-widget-title{
    color: <?php echo get_option(THEME_NAME_S.'_text_widget_title_color','#C45C27'); ?>!important;  
}
.text-widget-caption {
	color: <?php echo get_option(THEME_NAME_S.'_text_widget_caption_color','#818181'); ?>!important;   
}
a.text-widget-button {
	background-color: <?php echo get_option(THEME_NAME_S.'_text_widget_button_background','#C45C27'); ?>!important;  
}
a.text-widget-button {
	color: <?php echo get_option(THEME_NAME_S.'_text_widget_button_color','#F6F6F4'); ?>!important;  
}
.stunning-text-button{
	color: <?php echo get_option(THEME_NANE_S.'_stunning_text_button_color', '#ffffff'); ?> !important;
	<?php $stunning_text_button_color = get_option(THEME_NANE_S.'_stunning_text_button_background', '#ff8a42'); ?> 
	background-color: <?php echo $stunning_text_button_color ?> !important;
	border: 1px solid <?php echo $stunning_text_button_color ?> !important;
}

/* Footer Color
   ------------------------------------------------------------------ */
.top-slider, header { 
	background: url('<?php echo CP_PATH_URL; ?>/images/color_schemes/<?php echo $color_scheme; ?>/banner-bg.jpg') repeat; 
}
footer { 
	background: url('<?php echo CP_PATH_URL; ?>/images/color_schemes/<?php echo $color_scheme; ?>/footer-bg.jpg') repeat; 
}
.bismiallah {
   background: url('<?php echo CP_PATH_URL; ?>/images/color_schemes/<?php echo $color_scheme; ?>/bisim.png') no-repeat center center; 
}
.footer-wrapper .cp-title { 
	 color: <?php echo get_option(THEME_NAME_S.'_footer_title_color','#fff'); ?>!important;;
}
.footer-wrapper { 
	 color: <?php echo get_option(THEME_NAME_S.'_footer_content_color','#fff'); ?>!important;;
}
.footer-wrapper .cp-ider{
	border-color: <?php echo get_option(THEME_NANE_S.'_footer_ider_color', '#ebebeb'); ?> !important;
}
.footer-wrapper .post-info-color, .custom-sidebar #twitter_update_list{
	color: <?php echo get_option(THEME_NANE_S.'_footer_content_info_color', '#b1b1b1'); ?> !important;
}
.footer-wrapper .contact-form-wrapper input[type='text'], 
.footer-wrapper .contact-form-wrapper input[type='password'], 
.footer-wrapper .contact-form-wrapper textarea, 
.footer-wrapper .custom-sidebar #search-text input[type='text'], 
.footer-wrapper .custom-sidebar .contact-widget-whole input, 
.footer-wrapper .custom-sidebar .contact-widget-whole textarea {
	color: <?php echo get_option(THEME_NANE_S.'_footer_input_text', '#888888'); ?> !important; 
	background-color: <?php echo get_option(THEME_NANE_S.'_footer_input_background', '#f0f0f0'); ?> !important;
	border: 1px solid <?php echo get_option(THEME_NANE_S.'_footer_input_border', '#e8e8e8'); ?> !important;
}
.footer-wrapper a.button, .footer-wrapper button, .footer-wrapper button:hover {
    color: <?php echo get_option(THEME_NAME_S.'_footer_button_text','#fff'); ?>
	background-color: <?php echo get_option(THEME_NANE_S.'_footer_button_color', '#7d7d7d'); ?> !important;
}
div.copyright-left p{ 
	color: <?php echo get_option(THEME_NAME_S.'_footer_title_color','#808080'); ?> !important;
}
.footer-wrapper .custom-sidebar .recent-post-widget-thumbnail {  
	background-color: <?php echo get_option(THEME_NANE_S.'_footer_frame_background', '#ebebeb'); ?> !important; 
}

/* Divider Color
   ------------------------------------------------------------------ */
.cp-ider{
	border-color: <?php echo get_option(THEME_NANE_S . '_ider_line', '#ececec'); ?> !important;
}
table th{
	color: <?php echo get_option(THEME_NAME_S.'_table_text_title','#666666'); ?>;
	background-color: <?php echo get_option(THEME_NANE_S.'_table_title_background', '#f7f7f7'); ?>;
}
table, table tr, table tr td, table tr th,{
    border-color: <?php echo get_option(THEME_NAME_S.'_table_border','#dddddd'); ?> !important;
}

/* Tabs Color
   ------------------------------------------------------------------ */
ul.tabs li a, .product .woocommerce_tabs ul.tabs li a, #content .product .woocommerce_tabs ul.tabs li a,ul.tabs-content > li{
	color:  <?php echo get_option(THEME_NAME_S.'_tab_text_color','#848484'); ?>;
	background-color:  <?php echo get_option(THEME_NAME_S.'_tab_background_color','#ffffff'); ?>!important;
}
ul.tabs li a.active, .product .woocommerce_tabs ul.tabs li.active a, #content .product .woocommerce_tabs ul.tabs li.active a{
	color:  <?php echo get_option(THEME_NAME_S.'_tab_title_active_color','#333'); ?>;
	background-color:  <?php echo get_option(THEME_NAME_S.'_tab_active_background_color','#f5f5f5'); ?> !important;
}
	
/* Main Menu Styling
	-----------------------------------------------------------------*/
<?php $sub_menu_border =  get_option(THEME_NAME_S.'_sub_navigation_border','#333'); ?>

.main-menu {
	border-color: <?php echo get_option(THEME_NAME_S.'_main_navigation_text_background_current','#C45C27'); ?>;
    background: <?php echo get_option(THEME_NAME_S.'_main_navigation_background','#C45C27'); ?>!important;
}

.sf-menu ul{
	border-color: <?php echo $sub_menu_border; ?> !important;	
}
.sf-menu li li a{
	 color: <?php echo get_option(THEME_NAME_S.'_main_navigation_text','#32302C'); ?>!important;      
}
.sf-menu li li a:focus, .navigation-wrapper .sf-menu li li a:hover, .navigation-wrapper li li .sf-menu a:active,.sf-menu li li a{
	color: <?php echo get_option(THEME_NAME_S.'_main_navigation_text','#fff'); ?>!important;  
}
.sf-menu li li {
    background: none repeat scroll 0 0 rgba(0, 0, 0, 0.8);
    color: <?php echo get_option(THEME_NAME_S.'_main_navigation_text_hover','#2E1308'); ?>!important;
    color: <?php echo get_option(THEME_NAME_S.'_main_navigation_text','#32302C'); ?>!important;  
}
.sf-menu li a{
    color: <?php echo get_option(THEME_NAME_S.'_main_navigation_text','#fff'); ?>!important;
}
.sf-menu a:focus, .sf-menu a:hover, .sf-menu a:active{
	color: <?php echo get_option(THEME_NAME_S.'_main_navigation_text_hover','#2E1308'); ?>!important;
    background: <?php echo get_option(THEME_NAME_S.'_main_navigation_background_hover','#FCBF9F'); ?>!important;
} 
.sf-menu .current-menu-item a{
	color: <?php echo get_option(THEME_NAME_S.'_main_navigation_text_current','#2E1308'); ?>!important; 
    background: <?php echo get_option(THEME_NAME_S.'_main_navigation_text_background_current','#FCBF9F'); ?>!important; 
 }
.sf-menu li.current-menu-ancestor a, .sf-menu li.current-menu-item a{
	color: <?php echo get_option(THEME_NAME_S.'_main_navigation_text_hover','#2E1308'); ?>!important;
    background: <?php echo get_option(THEME_NAME_S.'_main_navigation_text_background_current','#FCBF9F'); ?>!important; 
}

.sf-menu li.current-menu-ancestor li.current-menu-item a,.sf-menu li.current-menu-ancestor li a:hover{
	color: <?php echo get_option(THEME_NAME_S.'_main_navigation_text_hover','#2E1308'); ?>!important;
    background: <?php echo get_option(THEME_NAME_S.'_main_navigation_text_background_current','#FCBF9F'); ?>!important; 
}
.sf-menu li.current-menu-ancestor li a{
	color: <?php echo get_option(THEME_NAME_S.'_sub_navigation_text_normal','#fff'); ?>!important; 
}

/* Button Color
   ------------------------------------------------------------------ */
<?php
	$cp_button_color = get_option(THEME_NAME_S.'_button_background_color','#C45C27'); 
	$cp_button_border = get_option(THEME_NAME_S.'_button_border_color','#dedede'); 
	$cp_button_text = get_option(THEME_NANE_S.'_button_text_color','#ffffff');
	$cp_button_hover = get_option(THEME_NAME_S.'_button_text_hover_color','#f1f1f1');
?>
a.button, button, input[type='submit'], input[type='reset'], input[type='button'],
a.blog-read-more, a.cp-button{
	background-color: <?php echo $cp_button_color; ?>;
	color: <?php echo $cp_button_text; ?>;
}
div.custom-sidebar .flickr_badge_image:hover,div.custom-sidebar .recent-post-widget-thumbnail img:hover,.cp-gallery-item .gallery:hover {
   border:3px solid <?php echo $cp_button_color; ?>; 
}
.nivo-controlNav a.active {background-color: <?php echo $cp_button_color; ?>!important;}
.nivo-controlNav a {background:#fff !important;}

a.button:hover, button:hover, input[type='submit']:hover, input[type='reset']:hover, input[type='button']:hover,
a.blog-read-more:hover,{
	background: <?php echo $cp_button_hover; ?>;
    color:#fff;
}
.tagcloud a:hover{
	background: <?php echo $cp_button_color; ?>;
    color:#fff;
    border-radius: 3px;
}

/* Price Item
   ------------------------------------------------------------------ */   
.cp-price-item .cp-ider{ 
	border-color: <?php echo get_option(THEME_NANE_S.'_price_item_border', '#ececec'); ?> !important;
}
.cp-price-item .price-title{
	background-color: <?php echo get_option(THEME_NANE_S.'_price_item_price_title_background', '#e9e9e9'); ?> !important;
	color: <?php echo get_option(THEME_NANE_S.'_price_item_price_title_color', '#3a3a3a'); ?> !important;
}
.cp-price-item .price-item.active .price-title{ 
	background-color: <?php echo get_option(THEME_NANE_S.'_price_item_best_price_title_background', '#5f5f5f'); ?> !important;
	color: <?php echo get_option(THEME_NANE_S.'_price_item_best_price_title_color', '#ffffff'); ?> !important;
}
.cp-price-item .price-tag{
	color: <?php echo get_option(THEME_NAME_S.'_price_item_price_color','#3a3a3a'); ?>!important;
}
.cp-price-item .price-item.active .price-tag{
	<?php $cp_best_price_color = get_option(THEME_NAME_S.'_price_item_best_price_color','#C45C27'); ?>
	color: <?php echo $cp_best_price_color; ?> !important;
}   
.cp-price-item .price-item.active{
	border-top: 1px solid <?php echo $cp_best_price_color; ?> !important;
}
/* Contact Form
   ------------------------------------------------------------------ */
<?php
	$cp_contact_form_frame = get_option(THEME_NAME_S.'_contact_form_frame_color','#f8f8f8'); 
	$cp_contact_form_shadow = get_option(THEME_NAME_S.'_contact_form_inner_shadow','#ececec');
 ?>
.contact-form-wrapper input[type='text'], 
.contact-form-wrapper input[type='password'],
.contact-form-wrapper textarea,
.custom-sidebar #search-text input[type='text'],
.custom-sidebar .contact-widget-whole input, 
.comment-wrapper input[type='text'], input[type='password'], .comment-wrapper textarea,
.custom-sidebar .contact-widget-whole textarea,
span.wpcf7-form-control-wrap input[type='text'], 
span.wpcf7-form-control-wrap input[type='password'], 
span.wpcf7-form-control-wrap textarea{
	color: <?php echo get_option(THEME_NAME_S.'_contact_form_text_color','#888888'); ?> !important;
	background-color: <?php echo get_option(THEME_NAME_S.'_contact_form_background_color','#fff'); ?>!important;
	border: 1px solid <?php echo get_option(THEME_NAME_S.'_contact_form_border_color','#cfcfcf'); ?>!important;

}

/* Icon Type (dark/light)
   ------------------------------------------------------------------ */
<?php global $cp_icon_type; ?>

	
.single-port-next-nav .right-arrow{ background: url('<?php echo CP_PATH_URL; ?>/images/icon/<?php echo $cp_icon_type; ?>/arrow-right.png') no-repeat; }
.single-port-prev-nav .left-arrow{ background: url('<?php echo CP_PATH_URL; ?>/images/icon/<?php echo $cp_icon_type; ?>/arrow-left.png') no-repeat; }

.single-thumbnail-author,
.archive-wrapper .blog-item .blog-thumbnail-author,
.blog-thumbnail-author{ background: url('<?php echo CP_PATH_URL; ?>/images/icon/author.png') no-repeat 0px 0px; }

.single-thumbnail-date,
.custom-sidebar .recent-post-widget-date,
.archive-wrapper .blog-item .blog-thumbnail-date,.blog-thumbnail-date{ background: url('<?php echo CP_PATH_URL; ?>/images/icon/date.png') no-repeat 0px 0px; }

.single-thumbnail-comment,
.archive-wrapper .blog-item .blog-thumbnail-comment,
.blog-item-holder .blog-thumbnail-comment,
.custom-sidebar .recent-post-widget-comment-num{ background: url('<?php echo CP_PATH_URL; ?>/images/icon/comment.png') no-repeat 0px 0px; }

.single-thumbnail-tag,
.archive-wrapper .blog-item .blog-thumbnail-tag{ background: url('<?php echo CP_PATH_URL; ?>/images/icon/tag.png') no-repeat; }

.single-port-visit-website{ background: url('<?php echo CP_PATH_URL; ?>/images/icon/<?php echo $cp_icon_type; ?>/link-small.png') no-repeat; }

span.accordion-head-image.active,
span.toggle-box-head-image.active{ background-image: url('<?php echo CP_PATH_URL; ?>/images/icon/<?php echo $cp_icon_type; ?>/minus-24px.png'); }
span.accordion-head-image,
span.toggle-box-head-image{ background-image: url('<?php echo CP_PATH_URL; ?>/images/icon<?php echo $cp_icon_type; ?>/plus-24px.png'); }

.jcarousellite-nav .prev, 
.jcarousellite-nav .next{ background-image: url('<?php echo CP_PATH_URL; ?>/images/icon<?php echo $cp_icon_type; ?>/navigation-20px.png'); } 

.jcarousellite-nav .prev, 
.jcarousellite-nav .next{ background-image: url('<?php echo CP_PATH_URL; ?>/images/icon<?php echo $cp_icon_type; ?>/navigation-20px-dark.png'); } 

.blog-item-slideshow-nav-right,
.blog-item-slideshow-nav-left{ background-image: url('<?php echo CP_PATH_URL; ?>/images/icon/<?php echo $cp_icon_type; ?>/slideshow-navigation.png'); } 


.blog-item-holder .blog-item-full .blog-small-list ul li{ background: url('<?php echo CP_PATH_URL; ?>/images/icon/<?php echo $cp_icon_type; ?>/arrow4.png') no-repeat 0px 6px; }
.custom-sidebar ul li{ background: url('<?php echo CP_PATH_URL; ?>/images/icon/<?php echo $cp_icon_type; ?>/liststylebg.png') no-repeat 0px 6px; }

.ider{ background: url('<?php echo CP_PATH_URL; ?>/images/icon/<?php echo $cp_icon_type; ?>/header-gimmick.png') repeat-x 0px 0px; }
.header-gimmick{ background: url('<?php echo CP_PATH_URL; ?>/images/icon/<?php echo $cp_icon_type; ?>/header-gimmick.png') repeat-x 0px 8px; }
.sidebar-header-gimmick{ background: url('<?php echo CP_PATH_URL; ?>/images/icon/<?php echo $cp_icon_type; ?>/header-gimmick.png') repeat-x 0px 6px; }

/* Search Box Icon Type */
<?php $cp_search_box_icon = get_option(THEME_NANE_S.'_search_box_icon','light') ?>
.custom-sidebar #searchsubmit,	
.search-wrapper input[type='submit']{ background-image:url('<?php echo CP_PATH_URL; ?>/images/icon/search-button.png'); background-repeat: no-repeat; background-position: center;}
.search-wrapper input[type='submit']{ background-repeat: no-repeat;}	
.search-wrapper input[type='submit']{ background-position: center;}
div.search-wrapper #search-text input {	background-color:  <?php echo get_option(THEME_NAME_S.'_search_box_background','#ffffff'); ?> !important;}
div.search-wrapper #search-text input {color: <?php echo get_option(THEME_NAME_S.'_search_box_text','#525252'); ?> !important;}

/* Footer Icon Type
   ------------------------------------------------------------------ */
   
<?php global $cp_footer_icon_type; ?>
.footer-wrapper .custom-sidebar .recent-post-widget-comment-num { background: url('<?php echo CP_PATH_URL; ?>/images/icon/<?php echo $cp_footer_icon_type; ?>/comment-light.png') no-repeat 0px 1px; }
.footer-wrapper .custom-sidebar .recent-post-widget-date{ background: url('<?php echo CP_PATH_URL; ?>/images/icon/<?php echo $cp_footer_icon_type; ?>/date-light.png') no-repeat 0px 1px; }


/* Elements Shadow
   ------------------------------------------------------------------ */
<?php $cp_element_shadow = get_option(THEME_NANE_S.'_elements_shadow','#ececec'); ?>


.cp-price-item .price-item.active{ 
	-moz-box-shadow: 0px 0px 3px <?php echo $cp_element_shadow; ?>;
	-webkit-box-shadow: 0px 0px 3px <?php echo $cp_element_shadow; ?>;
	box-shadow: 0px 0px 3px <?php echo $cp_element_shadow; ?>;
}

/* BKP FRAME */
.cp-frame-wrapper,
.page-cp-frame-wrapper,
.cp-widget-tab-header-item,
.cp-widget-tab-header-item-last{
	background-color: <?php echo get_option(THEME_NANE_S.'_frame_outer_background', '#f8f8f8'); ?> !important;
}
.cp-frame-wrapper,
.page-cp-frame-wrapper{
	border-color: <?php echo get_option(THEME_NANE_S.'_frame_outer_border', '#dadada'); ?> !important;
	
}
.cp-tab-ider{
	border-color: <?php echo get_option(THEME_NANE_S . '_tab_widget_border_color', '#e5e5e5'); ?> !important;
}
.cp-frame,
.page-cp-frame,
.cp-widget-tab-header-item.active{
	background-color: <?php echo get_option(THEME_NANE_S.'_frame_inner_background', '#ffffff'); ?> !important;
}
