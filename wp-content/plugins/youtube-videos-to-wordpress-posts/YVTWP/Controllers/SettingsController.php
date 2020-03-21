<?php

class SettingsController_YVTWP {

    public function indexAction($arg)
    {
        $response = new Response_YVTWP(1);
        
        return $response;
    }
    /**-------------------------------------------------------------------------
     * 
     * @global \YVTWP\Controllers\type $generalConfig_YVTWP
     * @param type $arg
     */
    public function defaultImportSettingsAction($arg)
    {
        $error_message='';

        $arg_=array();
        $postTypes=Post_YVTWP::getListPostTypes($arg_)->result;
        $custom_fields=Post_YVTWP::getListCustomFields($arg_)->result;
        $default_settings=SettingsModel_YVTWP::getOption('yvtwp_default_import_settings',Config_YVTWP::$default_import_setting,TRUE);

        if(!isset($default_settings['post_type'])){
            $default_settings=Config_YVTWP::$default_import_setting;
            $error_message=__("Invalid Settigns", 'YVTWP-lang');
        }                

        $embed_template_fields=array(''=>'');
        if(isset($default_settings['template_fields']))
            $embed_template_fields=Utils_YVTWP::getEmbedTemplateFieldsArray($default_settings['template_fields']);
        
        $embed_custom_fields=array();
        if(isset($default_settings['custom_fields']))
            $embed_custom_fields= explode(',', $default_settings['custom_fields']);
            
        
        $current_user = wp_get_current_user();
        $available_roles= Post_YVTWP::get_site_available_user_roles();
        $users=  Post_YVTWP::getUsersByRole('');
        $taxonomies=   Post_YVTWP::getTaxonomiesByPostType($default_settings['post_type']);
        $categories=   Post_YVTWP::getCategoriesByTaxonomy(reset($taxonomies));
        
        //get current theme supported formats
        if ( current_theme_supports( 'post-formats' ) ) {
            $post_formats = get_theme_support( 'post-formats' );
            if ( is_array( $post_formats[0] ) ) {
                $post_formats=$post_formats[0];
            }
        }         
        
        require_once Config_YVTWP::$views_dir.'youtube/default_import_settings.php';
    }
    /*
     * 
     */
    public function initDefaultSettingsAction($arg)
    {
        SettingsModel_YVTWP::setOption('yvtwp_default_import_settings','');
        Config_YVTWP::loadDefaultSettings();        
    }
    /**
     * 
     */
    public function setDefaultImportSettingsAction($arg)
    {
        $response=new Response_YVTWP(1);
        unset($arg['action']);
        unset($arg['yvtwp_controller']);
        unset($arg['yvtwp_action']);
        
        $res=SettingsModel_YVTWP::setOption('yvtwp_default_import_settings',$arg,TRUE);
        
        return $response;
    }
    /**-------------------------------------------------------------------------
     * 
     * @global type $generalConfig_YVTWP
     * @param type $arg
     */
    public function youtubeAPISettingsAction($arg)
    {       
        $client_id=SettingsModel_YVTWP::getOption('yvtwp_client_id','');
        $client_secret=SettingsModel_YVTWP::getOption('yvtwp_client_secret','');
        $developer_key=SettingsModel_YVTWP::getOption('yvtwp_developer_key','');

        require_once Config_YVTWP::$views_dir.'youtube/youtube_api_settings.php';
    }   
    /*
     * 
     */
    public function generalSettingsAction($arg)
    {       
        if(isset($_REQUEST['init']))
        {
            SettingsModel_YVTWP::removeOption('yvtwp_general_settings');
            SettingsModel_YVTWP::removeOption('yvtwp_videos_microdata');
        }

        $generalSettings=  Config_YVTWP::$general_settings;
        $available_roles= Post_YVTWP::get_site_available_user_roles();
        
        $embed_template_fields=array(''=>'');
        if(isset($default_settings['template_fields']))
            $embed_template_fields=  explode(',',$default_settings['template_fields']);
        
        
        require_once Config_YVTWP::$views_dir.'youtube/general_settings.php';
    }    
    /*
     * 
     */
    public function setGeneralSettingsAction($arg)
    {       
        $response=new Response_YVTWP(1);
        
        unset($arg['action']);
        unset($arg['yvtwp_controller']);
        unset($arg['yvtwp_action']);
        
        if(isset($arg['onChangeClearAllCache']) && $arg['onChangeClearAllCache']==1)
        {
            ImportModel_YVTWP::clearCacheForAllImport();
            TmpVideosModel_YVTWP::trancateTable();
            TmpCommentModel_YVTWP::trancateTable();
        }
        
        unset($arg['onChangeClearAllCache']);
        SettingsModel_YVTWP::setOption('yvtwp_general_settings',$arg,TRUE);
        SettingsModel_YVTWP::setOption('yvtwp_videos_microdata',json_decode(stripslashes($arg['videos_microdata']),TRUE),TRUE);

        return $response;        
    }     
    /*
     * 
     */
    public function setFeedPageAttributsAction($arg)
    {
        $response=new Response_YVTWP(1);
        
        unset($arg['action']);
        unset($arg['yvtwp_controller']);
        unset($arg['yvtwp_action']);
        
        SettingsModel_YVTWP::setOption('yvtwp_feed_page_attributs',$arg,TRUE);
        
        return $response;
    }
    /**-------------------------------------------------------------------------
     * 
     * @param type $arg
     */
    public static function setGoogleKeysAction($arg)
    {
        $miniUrl='search';
        $options=array('part' => 'id','maxResults' => 1,'q' => 'chhiwat' ); 
        
        $existDevelopperKey=SettingsModel_YVTWP::getOption('yvtwp_developer_key','');

        SettingsModel_YVTWP::setOption('yvtwp_developer_key',trim($arg['developer_key']));

        $response=  YoutubeAPI_YVTWP::getYoutubeAPIResponse($miniUrl, $options);
        

        if($response->status==0)
        {
            SettingsModel_YVTWP::setOption('yvtwp_developer_key',$existDevelopperKey);
            $response->messages=__("Invalid Google developper key : ", 'YVTWP-lang').$response->messages;
        }
        else
        {
            $response=new Response_YVTWP(1);;
        }        
        
        return $response;
    }       
    /*
     */
    public function importSettingAction($arg)
    {
        $response=new Response_YVTWP(1);
        
        if ($_FILES['file']['error'] == UPLOAD_ERR_OK && is_uploaded_file($_FILES['file']['tmp_name'])) 
        { 
            $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
            $size=$_FILES['file']['size'];
            if(($ext=='txt' || $ext=='json') && $size<1048576) 
            {
                $file_content = file_get_contents($_FILES['file']['tmp_name']); 
                if(!empty($file_content))
                {
                    $import_setting =json_decode($file_content,TRUE);
                    
                    if(isset($import_setting['import_youtube_categories']))
                    {
                        $option_name="yvtwp_default_import_settings";
                        $import_id='';
                        
                        $res=SettingsModel_YVTWP::setOption($option_name,$import_setting,TRUE);
                        if(isset($arg['import_id']))
                        {
                            $import_id=$arg['import_id'];
                            $option_name="yvtwp_import_settings_".$import_id;
                            $res=SettingsModel_YVTWP::setOption($option_name,$import_setting,TRUE);
                        }
                        
                        if($res)
                        {
                            $response->messages=__('Settings imported successfully', 'YVTWP-lang');  
                        }
                    }
                    else
                    {
                        $response->status=0;
                        $response->messages=__('Invalid settings.','YVTWP-lang');                         
                    }
                    
                }
                else
                {
                    $response->status=0;
                    $response->messages=__('The selected file is empty.','YVTWP-lang');                    
                }
            }   
            else
            {
                $response->status=0;
                $response->messages=__('File type is not supported or is larger than 1Mb.','YVTWP-lang');
            }

        }
        else
        {
            $response->status=0;
            $response->messages=__('Error while uploading the file.', 'YVTWP-lang');
        }
        
        return $response;
    }    
    /*
     * 
     */
    public function exportSettingsAction($arg)
    {
        $resultWriteFile=FALSE;
        $option_name="yvtwp_default_import_settings";
        $import_id='';

        if(isset($arg['import_id']))
        {
            $import_id=$arg['import_id'];
            $option_name="yvtwp_import_settings_".$import_id;
        }

        $default_settings=SettingsModel_YVTWP::getOption($option_name,'',TRUE);

        if(empty($default_settings))
            $default_settings=Config_YVTWP::$default_import_setting; 

        //here you get the options to export and set it as content, ex:
        $options= $default_settings;
        $content = json_encode($options);

        $upload_dir = wp_upload_dir(); 

        $theme_name = str_replace(' ','_', wp_get_theme());
        $theme_name=  strtolower($theme_name);
        
        $file_name = $theme_name.'.json';
        $file_path = $upload_dir['basedir'].'/'.$file_name;        
        $file_url=$upload_dir['baseurl'].'/'.$file_name;

        $creds = request_filesystem_credentials(site_url() . '/wp-admin/', '', false, false, array());

        /* initialize the API */
        if ( ! WP_Filesystem($creds) ) {
            echo 'WP_Filesystem can\'t be initialised <br/>';
            return false;
        }	
        
        global $wp_filesystem;
        /* do our file manipulations below */
        $resultWriteFile=$wp_filesystem->put_contents($file_path,$content,FS_CHMOD_FILE);

        require_once Config_YVTWP::$views_dir.'youtube/file_settings_download.php';
    } 
}
?>