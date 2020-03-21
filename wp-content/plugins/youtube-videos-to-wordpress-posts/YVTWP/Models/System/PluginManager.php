<?php
class PluginManager_YVTWP {
    
    public static function whenPluginIsActivated() 
    {
        require_once( ABSPATH.'wp-admin/includes/upgrade.php' );
        self::createDbTables();
        self::createDbTablesDatas();        
    }//End function   
    /**
     *
     */
    public static function createDbTables() 
    {
        global $wpdb;
        
        $charset_collate=  Config_YVTWP::$wpdb_charset;
        $prefixe=$wpdb->prefix.'yvtwp_';
        
        $table_name = $prefixe. 'imports';
	$sql1 = "CREATE TABLE $table_name (
		id mediumint(9) AUTO_INCREMENT,
                feed_type varchar(100),
                feed_key  varchar(300),
                max_imported_videos int,
                count_imported_videos int,
                import_description varchar(400) DEFAULT '',
                next_page_token varchar(400) DEFAULT '',
                prev_page_token varchar(400) DEFAULT '',
                total_results int DEFAULT 0,
                etag varchar(400),
                current_paged int DEFAULT 1,
                all_data text,
                last_auto_video_imported varchar(10) DEFAULT '',
                schedule_current_position mediumint(9) DEFAULT 0,
                active_import_schedule varchar(3) DEFAULT 'no',
                last_schedule_check_date DATETIME DEFAULT '2015-10-11 00:00:00',
                enable_import_comment varchar(3) DEFAULT 'no',
                created_time DATETIME,
                updated_time DATETIME,	
                user_id bigint(20),
		UNIQUE KEY id (id)
	) $charset_collate;";
        //------------------------------------------------------------
        $table_name = $prefixe. 'tmp_videos';
	$sql2 = "CREATE TABLE $table_name (
		id mediumint(9) AUTO_INCREMENT,
                import_id int,
                video_key  varchar(300),
                published_at datetime,
                video_datas  text,
                is_imported int DEFAULT 0,
                paged mediumint(9) DEFAULT 0,
                page_token varchar(400) DEFAULT '',
                schedule_position int DEFAULT 0,
                etag_comment varchar(400),
                total_results_comment int DEFAULT 0,
                count_imported_comment int DEFAULT 0,
                current_paged_comment int DEFAULT 1,
                next_page_token_comment varchar(400) DEFAULT '',
                prev_page_token_comment varchar(400) DEFAULT '',                
		time datetime,	
                updated_time datetime,
                user_id bigint(20),
		UNIQUE KEY id (id)
	) $charset_collate;";
        $table_name = $prefixe. 'tmp_comments';
	$sql3 = "CREATE TABLE $table_name (
		id mediumint(9) AUTO_INCREMENT,
                import_id int,
                video_key  varchar(200),
                published_at datetime,
                comment_datas  text,
                is_imported int DEFAULT 0,
                paged mediumint(9) DEFAULT 1,
                page_token varchar(400) DEFAULT '',
                api_comment_id varchar(600) DEFAULT '',
                api_comment_id_parent varchar(600) DEFAULT '',
                schedule_position int DEFAULT 0,
		time datetime,	
                updated_time datetime,
                user_id bigint(20),
		UNIQUE KEY id (id)
	) $charset_collate;";        
        //-------------------------------------------------------------
        /*$table_name = $prefixe.'config';
	$sql3 = "CREATE TABLE $table_name (
		id mediumint(9) AUTO_INCREMENT,
		option_key varchar(100),
		option_value text,
                user_id bigint(20),
                UNIQUE KEY id (id)
	) $charset_collate;";*/    
        //-------------------------------------------------------------
        $table_name = $prefixe.'log';
	$sql4 = "CREATE TABLE $table_name (
		id bigint(20) AUTO_INCREMENT,
                import_id bigint(20),   
                log_type varchar(100),
                response text,
		date datetime,
		additionnel_infos text,
                user_id bigint(20),
                UNIQUE KEY id (id)
	) $charset_collate;";          

	//this function can add or update a structure table when plugin is activated
	dbDelta($sql1.$sql2.$sql3.$sql4);          
    }//End function
    
    /**
     * this function create default datas for plugin tables
     */
    public static function createDbTablesDatas()
    {
        
    }//End function
    /*
     */
    public static function yvtwpVersion110()
    {
        global $wpdb;
        $yvtwp_prefixe=$wpdb->prefix.'yvtwp_';
        $config_table_name = $yvtwp_prefixe."config";
               
        if($wpdb->get_var("SHOW TABLES LIKE '$config_table_name'") == $config_table_name) 
        {
            $query="select * from ".$config_table_name;
            $response=  MappingWP_YVTWP::executeSql($query,MappingWP_YVTWP::GET_RESULTS);
            
            if($response->status==1)
            {
                if(is_array($response->result))
                {
                    foreach ($response->result as $key => $value) 
                    {
                        $option_key=$value['option_key'];
                        $option_value=$value['option_value']; 

                        $test_json=json_decode($option_value,TRUE);
                        if(is_array($test_json))
                            SettingsModel_YVTWP::setOption($option_key, $test_json);
                        else
                            SettingsModel_YVTWP::setOption($option_key, $option_value); 
                    }
                    $query="drop table IF EXISTS ".$config_table_name;
                    $response=MappingWP_YVTWP::executeSql($query,MappingWP_YVTWP::DELETE);                      
                }
            }        
        }
    }
    /*
     */
    public static function updateOldOptionsNames()
    {
        global $wpdb;
        $yvtwp_prefixe=$wpdb->prefix.'yvtwp_';
        $import_table_name=$yvtwp_prefixe."imports";
        $option_table_name=$wpdb->prefix."options";
        
        $query="select id from ".$import_table_name;
        $response=MappingWP_YVTWP::executeSql($query,MappingWP_YVTWP::GET_RESULTS);         
        
        if($response->status==1)
        {
            $result=$response->result;
            if(is_array($result))
            {
                foreach ($result as $key => $import) {
                    $old_option_name="import_settings_".$import['id'];
                    $new_option_name="yvtwp_import_settings_".$import['id'];
                    
                    $query="update ".$option_table_name." set option_name='{$new_option_name}' where option_name='{$old_option_name}' " ;
                    $response=MappingWP_YVTWP::executeSql($query,MappingWP_YVTWP::UPDATE);   
                }
            }
        }
               
        $query="update ".$option_table_name." set option_name='yvtwp_feed_page_attributs' where option_name='feed_page_attributs' " ;
        $response=MappingWP_YVTWP::executeSql($query,MappingWP_YVTWP::UPDATE);      
        
        $query="update ".$option_table_name." set option_name='yvtwp_general_settings' where option_name='general_settings' " ;
        $response=MappingWP_YVTWP::executeSql($query,MappingWP_YVTWP::UPDATE);   
        
        $query="update ".$option_table_name." set option_name='yvtwp_default_import_settings' where option_name='default_import_settings' " ;
        $response=MappingWP_YVTWP::executeSql($query,MappingWP_YVTWP::UPDATE);   
        
        $query="update ".$option_table_name." set option_name='yvtwp_developer_key' where option_name='developer_key' " ;
        $response=MappingWP_YVTWP::executeSql($query,MappingWP_YVTWP::UPDATE);   
        
        $query="update ".$option_table_name." set option_name='yvtwp_client_secret' where option_name='client_secret' " ;
        $response=MappingWP_YVTWP::executeSql($query,MappingWP_YVTWP::UPDATE);   
        
        $query="update ".$option_table_name." set option_name='yvtwp_client_id' where option_name='client_id' " ;
        $response=MappingWP_YVTWP::executeSql($query,MappingWP_YVTWP::UPDATE);          

    }
    /*
     */
    public static function yvtwpVersion211()
    {
        global $wpdb;
        $yvtwp_prefixe=$wpdb->prefix.'yvtwp_';
        
        self::yvtwpVersion110();
        self::updateOldOptionsNames();
        
        $tmp_videos_table_name=$yvtwp_prefixe."tmp_videos";
        $query="ALTER TABLE ".$tmp_videos_table_name." CHANGE import_key import_id varchar(100) " ;
        $response=MappingWP_YVTWP::executeSql($query,MappingWP_YVTWP::GET_RESULTS);  


        $postmeta_table_name=$wpdb->prefix."postmeta";
        $query="update ".$postmeta_table_name." set meta_key='yvtwp_import_id' where meta_key='yvtwp_import_key' " ;
        $response=MappingWP_YVTWP::executeSql($query,MappingWP_YVTWP::UPDATE);         

        $query="drop table IF EXISTS ".$yvtwp_prefixe."tmp_imports";
        $response=MappingWP_YVTWP::executeSql($query,MappingWP_YVTWP::DELETE);         
        

        SettingsModel_YVTWP::setOption("yvtwp_211","yes"); 
        
    }
    /*
     * 
     */
    public static function yvtwpVersion300()
    {
        if(SettingsModel_YVTWP::getOption("yvtwp_300")!='yes' || isset($_REQUEST['forceUpdate']))
        {                   
            require_once( ABSPATH.'wp-admin/includes/upgrade.php' );
            self::createDbTables();              
            self::yvtwpVersion211();

            ImportModel_YVTWP::clearCacheForAllImport();
            TmpVideosModel_YVTWP::trancateTable();
            TmpCommentModel_YVTWP::trancateTable(); 

            SettingsModel_YVTWP::setOption("yvtwp_300","yes"); 
        }
    }
    /*
     * 
     */
    public static function requirementsAdminNotices()
    {
        if(isset($_REQUEST['page']) && $_REQUEST['page']=='yvtwp')
        {
            if( (!isset($_REQUEST['yvtwp_action'])) || ($_REQUEST['yvtwp_action']!='youtubeAPISettings'))
            { 
                if(!SettingsModel_YVTWP::getOption('yvtwp_developer_key'))
                {      
                    ?>    
                    <div id="setting-error-tgmpa" class="error settings-error notice is-dismissible"> 
                        <p></p>
                        <p>
                            <em><?php _e('Youtube Videos to Wordpress Posts', 'YVTWP-lang') ?></em> : <strong><?php _e('You need to set a Google developer key', 'YVTWP-lang') ?> </strong>
                        </p>
                        <p>
                            <strong>
                                <a class="button-primary" href="?page=yvtwp&yvtwp_controller=settings&yvtwp_action=youtubeAPISettings">
                                    <?php _e('Go to set Google developper key', 'YVTWP-lang') ?>
                                </a> 
                            </strong>
                        </p>
                        <button type="button" class="notice-dismiss">
                            <span class="screen-reader-text"><?php _e('Dismiss message', 'YVTWP-lang') ?></span>
                        </button>
                        <p></p>
                    </div>
                    <?php 
                }
            }

            if(!extension_loaded('openssl'))
            {
            ?>
                    <div id="setting-error-tgmpa" class="error settings-error notice is-dismissible"> 
                        <p></p>
                        <p>
                            <?php _e("Youtube Videos to Wordpress Posts requires the PHP OpenSSL extension . Make sure it's installed.", 'YVTWP-lang') ?>
                        </p>
                        <button type="button" class="notice-dismiss">
                            <span class="screen-reader-text"><?php _e('Dismiss message', 'YVTWP-lang') ?></span>
                        </button>
                        <p></p>
                    </div>     
            <?php        
            }

            if(Config_YVTWP::$is_demo=="yes")
            {
            ?>
                    <style type="text/css">
                        #setting-error-tgmpa {display: none}
                    </style>
                    <div class="error settings-error notice is-dismissible"> 
                        <p></p>
                        <p>
                            <?php _e("Youtube Videos to Wordpress Posts : Probably you may have a conflict with other users. Your import settings 
                            can be deleted or changed,  because this demo is shared with other users at the same time.", 'YVTWP-lang') ?>
                        </p>
                        <button type="button" class="notice-dismiss">
                            <span class="screen-reader-text"><?php _e('Dismiss message', 'YVTWP-lang') ?></span>
                        </button>
                        <p></p>
                    </div>     
            <?php        
            }                
        }
    }
    /*
     * 
     */
    public static function setPluginAdminMenu()
    {
        add_menu_page(__('Youtube Videos to Wordpress Posts', 'YVTWP-lang'),__('Youtube Videos to Wordpress Posts', 'YVTWP-lang'),Config_YVTWP::get('yvtwp_capabilitie'),'yvtwp','yvtwp_execute','dashicons-format-video');
        add_submenu_page('yvtwp',__('New import', 'YVTWP-lang'),__('New import', 'YVTWP-lang'),Config_YVTWP::get('yvtwp_capabilitie'),'?page=yvtwp&yvtwp_controller=import&yvtwp_action=newImport' );
        add_submenu_page('yvtwp',__('Import settings', 'YVTWP-lang'),__('Default import settings', 'YVTWP-lang'),Config_YVTWP::get('yvtwp_capabilitie'),'?page=yvtwp&yvtwp_controller=settings&yvtwp_action=defaultImportSettings' );
        //add_submenu_page('yvtwp',__('Youtube API settings', 'YVTWP-lang'),__('Youtube API settings', 'YVTWP-lang'),Config_YVTWP::$yvtwp_capabilitie,'?page=yvtwp&yvtwp_controller=settings&yvtwp_action=youtubeAPISettings' );
        add_submenu_page('yvtwp',__('Settings', 'YVTWP-lang'),__('Settings', 'YVTWP-lang'),Config_YVTWP::get('yvtwp_capabilitie'),'?page=yvtwp&yvtwp_controller=settings&yvtwp_action=generalSettings' );
        add_submenu_page('yvtwp',__('Broken videos checker', 'YVTWP-lang'),__('Broken videos checker', 'YVTWP-lang'),Config_YVTWP::get('yvtwp_capabilitie'),'?page=yvtwp&yvtwp_controller=brokenVideo&yvtwp_action=brokenVideoIndex&log_type=broken_videos' );
        add_submenu_page('yvtwp',__('Log system', 'YVTWP-lang'),__('Log system', 'YVTWP-lang'),Config_YVTWP::get('yvtwp_capabilitie'),'?page=yvtwp&yvtwp_controller=log&yvtwp_action=log' );    
        add_submenu_page('yvtwp',__('Supported themes', 'YVTWP-lang'),__('Supported themes', 'YVTWP-lang'),Config_YVTWP::get('yvtwp_capabilitie'),'?page=yvtwp&yvtwp_controller=themeLoader&yvtwp_action=themeLoaderIndex' );
    }
    /*
     * 
     */
    public static function enqueueStylesAndScriptsFrontend()
    {
        wp_enqueue_style( 'yvtwp-frontend',Config_YVTWP::$resources_url.'css/yvtwp-frontend.css');
    }
    /*
     * 
     */
    public static function enqueueStylesAndScriptsBackend()
    {
       //style
        wp_enqueue_style( 'yvtwp-style-bootstrap',Config_YVTWP::$resources_url.'bootstrap/css/bootstrap.min.css');
        wp_enqueue_style( 'yvtwp-style',Config_YVTWP::$resources_url.'css/yvtwp.css');
        //font awesome
        wp_enqueue_style( 'yvtwp-font-awesome',Config_YVTWP::$resources_url.'font-awesome/css/font-awesome.min.css');
        //script
        wp_enqueue_script('yvtwp-script',Config_YVTWP::$resources_url.'js/yvtwp.js'); 
        wp_enqueue_script('yvtwp-script-bootstrap',Config_YVTWP::$resources_url.'bootstrap/js/bootstrap.min.js');

        //sweetalert-master
        wp_enqueue_style( 'yvtwp-sweetalert-master-style',Config_YVTWP::$resources_url.'sweetalert-master/lib/sweet-alert.css');
        wp_enqueue_script('yvtwp-sweetalert-master-script',Config_YVTWP::$resources_url.'sweetalert-master/lib/sweet-alert.min.js'); 

        //jquery.timeago.js
        wp_enqueue_script('yvtwp-jquery-timeago',Config_YVTWP::$resources_url.'jquery.timeago.js');

        //juery Tags input
        wp_enqueue_style( 'yvtwp-tagsinput-style',Config_YVTWP::$resources_url.'jqueryTags/jquery.tagsinput.min.css');
        wp_enqueue_script('yvtwp-tagsinput-script',Config_YVTWP::$resources_url.'jqueryTags/jquery.tagsinput.min.js');

        //datetimepicker
        wp_enqueue_style( 'yvtwp-datetimepicker-style',Config_YVTWP::$resources_url.'datetimepicker-master/jquery.datetimepicker.css');
        wp_enqueue_script('yvtwp-datetimepicker-script',Config_YVTWP::$resources_url.'datetimepicker-master/jquery.datetimepicker.js'); 

        //bootstrap-multiselect
        wp_enqueue_style( 'yvtwp-bootstrap-multiselect-style',Config_YVTWP::$resources_url.'bootstrap-multiselect-master/dist/css/bootstrap-multiselect.css');
        wp_enqueue_script('yvtwp-bootstrap-multiselect-script',Config_YVTWP::$resources_url.'bootstrap-multiselect-master/dist/js/bootstrap-multiselect.js'); 

        //jquery-ui
        wp_enqueue_style( 'yvtwp-jquery-ui-style',Config_YVTWP::$resources_url.'jquery-ui/jquery-ui.min.css');
        wp_enqueue_script('yvtwp-jquery-ui-script',Config_YVTWP::$resources_url.'jquery-ui/jquery-ui.min.js'); 

        //jquery-switchButton-master
        wp_enqueue_style( 'yvtwp-jquery-switchButton-master-style',Config_YVTWP::$resources_url.'jquery-switchButton-master/jquery.switchButton.css');
        wp_enqueue_script('yvtwp-jquery-switchButton-master-script',Config_YVTWP::$resources_url.'jquery-switchButton-master/jquery.switchButton.js');              
    }
    /*
     * 
     */
    public static function deregisterOtherPluginsScripts()
    {
        if(Config_YVTWP::get('deregister_other_plugins_scripts')=='yes')
        {
            global $wp_scripts; 
            foreach ($wp_scripts->queue as $key => $handle) 
            {
                if(!in_array($handle,Config_YVTWP::$autorized_scripts))
                    wp_deregister_script($handle); 
            }    
        }
    }
    /*
     * 
     */
    public static function deregisterOtherPluginsStyles()
    {
        if(Config_YVTWP::get('deregister_other_plugins_styles')=='yes')
        {
            global $wp_styles; 
            foreach ($wp_styles->queue as $key => $handle) 
            {
                if(!in_array($handle,Config_YVTWP::$autorized_styles))
                    wp_deregister_style($handle); 
            }               
        }         
    }   
    /*
     * 
     */
    public static function debugMode($post_id,$arg=NULL)
    {
        if(Config_YVTWP::get('active_debug')=='yes' && isset($_REQUEST['debug']))
        {
            $post_id=  get_the_ID();
            echo '<div style="position: absolute;display: block;padding: 100px;background: rgb(255, 255, 255) none repeat scroll 0% 0%;z-index: 10000;color: rgb(0, 0, 0);">';
            echo '<pre>';
            echo 'get_post_custom_keys'.'<br/>';
            print_r(get_post_custom_keys($post_id));
            echo '</pre>';

            $custum_fields=get_post_custom($post_id);
            foreach ($custum_fields as $key => $value)
            {
                echo $key.'<br/>';
                $res=get_post_meta($post_id,$key);
                if(is_array($res))
                {
                    echo '<pre>';
                    print_r($res[0]);
                    echo '</pre>';
                }
                else
                {
                    echo '<pre>';
                    print_r($res);
                    echo '</pre>';
                }
            }
            echo '</pre></div>';
        }
    }
    
} //End Class
?>