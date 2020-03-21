<?php
/*
Plugin Name: Youtube Videos To Wordpress Posts |  VestaThemes.com
Plugin URI: http://yvtwp.if36.com
Description: Youtube videos to Wordpress posts is a powerful tools to import videos from Youtube and conveting them to any Wordpress content type (post, page, custom post types), this plugin lets you easily integrate imported videos to any Wordpress theme (no code changes are required).
Version: 4.0.6
Author: Karim Lamghari & Younes Rafie
Author URI: http://yvtwp.if36.com
Text Domain: YVTWP-lang
Domain Path: /languages/
*/

    /*----------------load required class and files---------------------------*/
    require_once plugin_dir_path(__FILE__).'autoload.php';  
    new Config_YVTWP(__FILE__);   
    /*------------------------------------------------------------------------*/ 
    add_action('plugins_loaded', 'yvtwp_load_plugin');
    function yvtwp_load_plugin() 
    {
        //load plugin text domain
        load_plugin_textdomain( 'YVTWP-lang', false, dirname( plugin_basename(__FILE__) ) . '/languages/' );
        
        //get currennt user ID and login
        if ( is_user_logged_in() ) 
        {
            $current_user=wp_get_current_user();
             
            Config_YVTWP::$current_user_id=$current_user->data->ID;
            Config_YVTWP::$current_user_id_2=$current_user->data->ID;
            Config_YVTWP::$default_import_setting['author_login']=$current_user->data->user_login;
            Config_YVTWP::$current_author_login=$current_user->data->user_login;            
        }
        
        //envato update
        if(Config_YVTWP::get('active_envato_plugin_update')=='yes')
        { 
            include plugin_dir_path( __FILE__ ) . 'lib/envato-plugin-update.php';
            PresetoPluginUpdateEnvato::instance()->add_item( array(
                'id' =>12836753,
                'basename' => plugin_basename( __FILE__ )
            ));  
        }
    }
    /*------------------------when Plugin Is Activated------------------------*/
    register_activation_hook(__FILE__,'yvtwp_when_plugin_is_activated');
    function yvtwp_when_plugin_is_activated($networkwide)
    {
        global $wpdb;
        if (function_exists( 'is_multisite' ) && is_multisite() ) 
        {
            //check if it is network activation if so run the activation function for each id
            if( $networkwide ) 
            {
                $old_blog =  $wpdb->blogid;
                //Get all blog ids
                $blogids =  $wpdb->get_col( "SELECT blog_id FROM $wpdb->blogs" );
                foreach ( $blogids as $blog_id ) {
                   switch_to_blog($blog_id);
                   //actions to be executed
                    PluginManager_YVTWP::whenPluginIsActivated();
                    yvtwp_scheduled_import_activation();
                }
                switch_to_blog( $old_blog );
                return;
            }
        }        
        //actions to be executed
        PluginManager_YVTWP::whenPluginIsActivated();
        yvtwp_scheduled_import_activation();
    }
    /*------------------------when Plugin Is deleted--------------------------*/
    register_uninstall_hook(__FILE__,'yvtwp_when_plugin_is_deleted');
    function yvtwp_when_plugin_is_deleted()
    {
        if (function_exists( 'is_multisite' ) && is_multisite() ) 
        {
            global $wpdb;
            $old_blog =  $wpdb->blogid;
            //Get all blog ids
            $blogids =  $wpdb->get_col( "SELECT blog_id FROM $wpdb->blogs" );
            foreach ( $blogids as $blog_id )
            {
                switch_to_blog($blog_id);
                yvtwp_plugin_drop_datas();
            }
            switch_to_blog( $old_blog );
        } 
        else 
            yvtwp_plugin_drop_datas();          
    }        
    /*------------- drop tables ----------------------------------------------*/
    function yvtwp_plugin_drop_datas()
    {
        global $wpdb;        
        $table_prefix=$wpdb->prefix.'yvtwp_';        
        //$wpdb->query("drop table IF EXISTS ".$table_prefix."config");        
    }
    /*--------Create tables for new multisite created-------------------------*/
    add_action( 'wpmu_new_blog', 'yvtwp_create_tables_mu' );
    function yvtwp_create_tables_mu( $blog_id, $user_id, $domain, $path, $site_id, $meta )
    {
        $plugin_yvtwp = 'youtube-videos-to-wordpress-posts/youtube-videos-to-wordpress-posts.php';
        if ( is_plugin_active_for_network($plugin_yvtwp) ) 
        {
            switch_to_blog( $blog_id );
            PluginManager_YVTWP::whenPluginIsActivated();
            restore_current_blog();
        }
    }    
    /*--------------Delete tables when multisite blog is deleted--------------*/
    add_filter( 'wpmu_drop_tables', 'yvtwp_delete_tables_mu' );
    function yvtwp_delete_tables_mu( $tables ) 
    {
         global $wpdb;
         $table_prefix=$wpdb->prefix.'yvtwp_';
         
         $tables[] = $table_prefix."imports";
         $tables[] = $table_prefix."tmp_videos";
         $tables[] = $table_prefix."tmp_comments";
         $tables[] = $table_prefix."log";
         
         return $tables;
     }    
    /*------------------------------------------------------------------------*/
    if(Config_YVTWP::$plugin_version<=300)
        PluginManager_YVTWP::yvtwpVersion300();
    /*-----------------------show plugin notices------------------------------*/
    add_action( 'admin_notices','yvtwp_requirements_admin_notices' );
    function yvtwp_requirements_admin_notices()
    {
        PluginManager_YVTWP::requirementsAdminNotices();
    }     
    /*-------------add custom interval for scheduling import------------------*/   
    function cron_add_minute( $schedules ) {
        $schedules['yvtwpevery30minute'] = array(
                'interval' => 30*60,
                'display' => __( 'Once Every 30 Minutes' )
        );
        $schedules['yvtwpevery15minute'] = array(
                'interval' => 15*60,
                'display' => __( 'Once Every 15 Minutes' )
        );
        $schedules['yvtwpevery5minute'] = array(
                'interval' => 5*60,
                'display' => __( 'Once Every 5 Minutes' )
        );        
        
        return $schedules;
    }
    add_filter( 'cron_schedules', 'cron_add_minute' );    
    /*-------------create a scheduling Event (if it does not exist already)---*/
    function yvtwp_scheduled_import_activation()
    {
        if(Config_YVTWP::get('active_import_scheduling')=='yes')
        {   
            $recurrence=  Config_YVTWP::get('scheduling_recurrance');
            //$recurrence='everyminute';
            if(!wp_next_scheduled('yvtwp_scheduled_import'))
            {                
                wp_schedule_event(time(),$recurrence,'yvtwp_scheduled_import');
                SettingsModel_YVTWP::setOption('yvtwp_last_schedule_recurrence',$recurrence);
            }            
            else
            {
                $yvtwp_last_schedule_recurrence=SettingsModel_YVTWP::getOption('yvtwp_last_schedule_recurrence');
                if($yvtwp_last_schedule_recurrence!=$recurrence)
                    yvtwp_scheduled_import_desactivation();
            }
        }
        else
            yvtwp_scheduled_import_desactivation();
    }
    //called when wordpress loaded
    add_action('init','yvtwp_scheduled_import_activation');
    /*----------delete a scheduling Event (when the plugin is desactivated)---*/
    function yvtwp_scheduled_import_desactivation()
    {
        if(wp_next_scheduled('yvtwp_scheduled_import'))
        {
            // find out when the last event was scheduled
            $timestamp = wp_next_scheduled ('yvtwp_scheduled_import');
            // unschedule previous event if any
            wp_unschedule_event($timestamp, 'yvtwp_scheduled_import');
        }
    }    
    register_deactivation_hook(__FILE__,'yvtwp_scheduled_import_desactivation');
    /*------------------------------------------------------------------------*/
    function yvtwp_check_imports_new_videos()
    {
        ImportController_YVTWP::importSchedulingVideos();
    }
    add_action('yvtwp_scheduled_import','yvtwp_check_imports_new_videos');
    /*---------------------------Create admin menu----------------------------*/
    add_action('admin_menu','yvtwp_set_admin_menu');
    function yvtwp_set_admin_menu() 
    {
        PluginManager_YVTWP::setPluginAdminMenu();
    }
    /*-------------------------Set core function execution -------------------*/
    function yvtwp_execute() 
    {   
        if(Config_YVTWP::get('active_debug')=='yes') {    
            ini_set('display_errors',1);
            ini_set('display_startup_errors',1);
            error_reporting(-1);  
        }
        else {
            ini_set('display_errors',0);
            ini_set('display_startup_errors',0);
            error_reporting(0);
        }
        
        Master_YVTWP::executeControllerAction($_REQUEST);  
    }
    /*-------------------------Set ajax core function execution --------------*/
    add_action( 'wp_ajax_yvtwp_ajax_action','yvtwp_ajax_action' );
    add_action( 'wp_ajax_nopriv_yvtwp_ajax_action','nopriv_yvtwp_ajax_action');

    function yvtwp_ajax_action() 
    {
        if(Config_YVTWP::get('active_debug')=='yes')
        {    
            ini_set('display_errors',1);
            ini_set('display_startup_errors',1);
            error_reporting(-1);  
        }        
        
        $response=Master_YVTWP::executeControllerAction($_REQUEST);        
        echo json_encode($response);        
        wp_die(); // this is required to terminate immediately and return a proper response
    }
    function nopriv_yvtwp_ajax_action() 
    {       
        wp_die(); // this is required to terminate immediately and return a proper response
    }    
    /*-------------------------add script and style --------------------------*/
    add_action('admin_enqueue_scripts','yvtwp_enqueue_scripts_and_style_backend');    
    function yvtwp_enqueue_scripts_and_style_backend()
    {
        if(isset($_REQUEST['page']) && $_REQUEST['page']=='yvtwp')
        {
            PluginManager_YVTWP::deregisterOtherPluginsScripts();
            PluginManager_YVTWP::deregisterOtherPluginsStyles();

            PluginManager_YVTWP::enqueueStylesAndScriptsBackend();
        }           
    }  
    /*------------------------------------------------------------------------*/ 
    function yvtwp_enqueue_scripts_and_style_frontend()
    {
        PluginManager_YVTWP::enqueueStylesAndScriptsFrontend();
    }    
    add_action( 'wp_enqueue_scripts', 'yvtwp_enqueue_scripts_and_style_frontend' );
    /*------------------------------------------------------------------------*/    
    /*------------------------- set YVTWP video display short-----------------*/
    add_shortcode('yvtwp_video','yvtwp_video_shortcode');
    function yvtwp_video_shortcode($atts,$content)
    {
        return Shortcodes_YVTWP::yvtwpVideoShortcode($atts,$content);
    }
    /*------------------------- set theme doc shortcode-----------------*/
    add_shortcode('yvtwp_theme_doc','yvtwp_theme_doc_shortcode');
    function yvtwp_theme_doc_shortcode($atts,$content)
    {
        return Shortcodes_YVTWP::yvtwpThemeDocShortcode($atts,$content);
    }    
    /*-------------------------------debug part--------------------------------*/
    add_action('wp_head','yvtwp_post_head_action');
    function yvtwp_post_head_action()
    {
        /*echo '<div style="position: absolute;display: block;padding: 100px;background: rgb(255, 255, 255) none repeat scroll 0% 0%;z-index: 10000;color: rgb(0, 0, 0);">';
         echo '</pre>';   */        
        if(is_single() && get_the_ID())
        {
            $post_id= get_the_ID();
            if(get_post_meta($post_id,'yvtwp_import_id',TRUE))
            {
                PluginManager_YVTWP::debugMode($post_id);
                Post_YVTWP::synchronizeVideoDatas($post_id);
                Post_YVTWP::checkVideoNewComments($post_id);
            }
        }
    }
    /*
     */
    add_action('wp_footer','yvtwp_post_footer_action');
    function yvtwp_post_footer_action()
    {
        /*echo '<div style="position: absolute;display: block;padding: 100px;background: rgb(255, 255, 255) none repeat scroll 0% 0%;z-index: 10000;color: rgb(0, 0, 0);">';
        echo '</pre>';    */    
        if(is_single() && get_the_ID())
        {
            $post_id= get_the_ID();
            if(get_post_meta($post_id,'yvtwp_import_id',TRUE))
            {
                Post_YVTWP::incrementViewsCount($post_id);
                Post_YVTWP::addRichSnippetsforVideos($post_id);
            }
        }
    }    
