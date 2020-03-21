<?php
class Config_YVTWP {
    
    public static $default_controller='import';
    public static $default_action='index';
    public static $plugin_name='youtube-videos-to-wordpress-posts';
    public static $plugin_version=400;
    public static $plugin_dir_path;
    public static $plugin_dir_url;
    public static $doc_help_dir='';
    public static $supported_themes_dir='';
    public static $supported_themes_url='';
    public static $views_dir='';
    public static $resources_url='';
    public static $abspath='';
    
    public static $wpdb_prefixe='';
    public static $yvtwp_prefixe='';
    public static $wpdb_charset='';
    public static $wp_ajax_action_name='yvtwp_ajax_action';
    public static $ajax_url='';
    public static $current_user_id;
    public static $current_user_id_2;
    public static $current_author_login;
    public static $google_token;
    
    public static $default_import_setting=array(
        'post_type' =>  'post' ,    
        'post_status' =>  'publish' ,        
        'import_type'=>'paginate_import',
        'import_video_thumbnail' =>  'yes' ,
        'thumbnails_quality' => 'thumbnailMaxresUrl',
        'author_login' => '',
        'update_if_exist'  =>  'yes',
        'categories'=>'',
        'taxonomy_categories'=>'category',
        'import_youtube_categories'=>'no',
        'tags'=>'',
        'taxonomy_tags'=>'post_tag',
        'import_youtube_tags'=>'no',
        'max_youtube_tags' => 10,
        'import_video_tag' =>  'no' ,
        'max_tags' =>  '1' ,
        'post_format' => 'video',        
        'yvtwp_shortcode'=>'[embed]{{video_url}}[/embed]',
        'template_video' =>'[embed]{{video_url}}[/embed]<p>{{video_description}}</p>',
        'title_deleted_keywords' =>  '' ,
        'title_remplaced_keywords' =>  '' ,
        'title_remplaced_keywords_by' =>  '' ,
        'text_before_title' =>  '' ,
        'text_after_title' =>  '' ,
        'description_deleted_keywords' =>  '' ,
        'description_remplaced_keywords' =>  '' ,
        'description_remplaced_keywords_by' =>  '' ,
        'delete_url_from_description' =>  'no' ,
        'import_description_as_post_except' => 'no',
        'active_post_schedule' => 'no',
        'schedule_marge_start' =>30,
        'schedule_marge_end' =>60,
        'enable_comments_import'=>'no',
        'comment_status' => 1,
        'comment_type' => '',
        'comment_author_url'=>'authorGooglePlusUrl',
        'comment_date'=>'youtubeCommentPublishedDate',
        'max_comments' => 100,
        'import_comments_replies'=>'no',
        'max_comments_replies'=>5,
        'comment_oreder_by' => 'time',
        'comment_text_formatt' => 'html',        
        'comment_search_term' => '',
        'comment_published_after'=>'',
        'enable_comments_synced'=>'no',
        'comment_max_check_per_day'=>5,
        'commentsHourBetweenEveryCheck'=>1,
        'active_import_schedule' => 'no',
        'max_videos_to_import_in_every_check' => 5,
        'order' => 'date',
        'post_publish_date' => 'video_publish_date'
        );
    
        public static $general_settings=array(
        'yvtwp_capabilitie' => 'manage_options',
        'ajax_request' => 'wp',
        'active_error_logging' => 'yes',
        'active_youtube_api_details_errors' => 'yes',
        'bulk_import_time_check_result' =>5,  
        'import_paged' => 20,
        'log_paged' => 30,
        'paginate_import_time_check_result' =>5,   
        'paginate_paged' => 30,
        'bulk_paged' => 30,
        'schedule_paged' => 5,
        'comment_paged' => 50,
        'comment_paged_schedule' => 5,
        'active_import_scheduling' => 'no',
        'enable_scheduling_max_videos' => 'yes',
        'cron_job_type' => 'virtual_cron_job',
        'scheduling_recurrance' => 'twicedaily',
        'deregister_other_plugins_scripts' =>'yes',
        'deregister_other_plugins_styles'  => 'yes',
        'active_debug' => 'no',
        'force_import_broken_videos' => 'no',
        'active_envato_plugin_update'=>'yes'   
        );     
        
        public static $videos_microdata=array(
        "@context"=>"http://schema.org",
        "@type"=>"VideoObject",
        "name"=>"{{video_title}}",
        "description"=>"{{video_description}}",
        "thumbnailUrl"=>"{{thumbnail_default_url}}",
        "uploadDate"=>"{{video_publishedAt}}",
        "duration"=>"{{video_duration}}",
        "contentUrl"=>"{{video_url}}",
        "embedUrl"=>"https://www.youtube.com/embed/{{video_key}}",
        "interactionCount"=>"yvtwp_views_count"
        );
        
    public static $microdataTemplateFields=array(
        'video_key'=>'videoKey',
        'video_url'=>'videoUrl',
        'video_title'=>'videoTitle',
        'video_description'=>'videoDescription',
        'video_duration'=>'videoDuration',
        'video_views'=>'videoViews',
        'video_favorites'=>'videoFavorites',
        'video_likes'=>'videoLikes',
        'video_dislikes'=>'videoDislikes',
        'video_comments_count'=>'videoCommentsCount',
        'video_publishedAt'=>'videoPublishedAt',  
        'thumbnail_maxres_url'=>'thumbnailMaxresUrl',
        'thumbnail_standard_url'=>'thumbnailStandardUrl',
        'thumbnail_high_url'=>'thumbnailHighUrl',
        'thumbnail_medium_url'=>'thumbnailMediumUrl',
        'thumbnail_default_url'=>'thumbnailDefaultUrl'
        );      
    
        public static $thumbnailsQuality=array(
        'thumbnailMaxresUrl'=>'maxres(1280px|720px)',
        'thumbnailStandardUrl'=>'sddefault(640px|480px)',
        'thumbnailHighUrl'=>'hqdefault(480px|360px)',
        'thumbnailMediumUrl'=>'mqdefault(320px|180px)'
        );      
        
        public static $active_wp_user_filter='no'; //no no
        public static $is_demo='no'; //only for demo
        public static $user_id_demo=1;
        
        public static $feed_page_attributs=array(
        'video_title' => 1,
        'description' =>0,
        'channel_title' => 1 ,
        'views' => 1 ,
        'likes' =>0,
        'dislikes' =>0,
        'favorites' =>0,
        'comments' =>0,
        'duration' =>0,
        'dimension' =>0,
        'definition' =>0,        
        'published_at' => 1,
        'thumbnail' => 1
        );    
    
    public static $templateFields=array(
        'video_key'=>'videoKey',
        'video_url'=>'videoUrl',
        'video_title'=>'title',
        'video_description'=>'description',
        'video_duration'=>'videoDuration',
        'video_views'=>'videoViews',
        'video_favorites'=>'videoFavorites',
        'video_likes'=>'videoLikes',
        'video_dislikes'=>'videoDislikes',
        'video_comments'=>'videoComments',
        'video_publishedAt'=>'videoPublishedAt',  
        'thumbnail_maxres_url'=>'thumbnailMaxresUrl',
        'thumbnail_standard_url'=>'thumbnailStandardUrl',
        'thumbnail_high_url'=>'thumbnailHighUrl',
        'thumbnail_medium_url'=>'thumbnailMediumUrl',
        'thumbnail_default_url'=>'thumbnailDefaultUrl',        
        'all_custom_fields'=>'customFields'
        );
    
    public static $statusVideoMessage;
        
    public static $feedType=array();
    public static $importTypes=array();
    public static $logType=array();   
    public static $schedulingRecurrance=array();    
    
    public static $order=array();    
    public static $safeSearch=array();    
    public static $videoCaption=array();    
    public static $videoDefinition=array();   
    public static $videoDimension=array();    
    public static $videoDuration=array();   
    public static $videoEmbeddable=array();    
    public static $videoLicense=array();    
    public static $videoSyndicated=array();   
    public static $videoType=array();     
    
    public static $commentStatus=array();  
    public static $commentAuthorUrl=array();
    public static $commentDate=array();
    public static $commentOrder=array();
    public static $commentFormat=array();
    
    
    public static $googleDevelopperkeyErrorMsg;
    
    public static $autorized_scripts=array('jscolor','common','admin-bar','utils','svg-painter','wp-auth-check','jquery');
    public static $autorized_styles=array('admin-bar','colors','ie','wp-auth-check');

    //put your code here
    public function __construct($file) 
    {        
        global $wpdb;

        self::$plugin_dir_path=plugin_dir_path($file);
        self::$plugin_dir_url=plugins_url().'/'.self::$plugin_name.'/';
        self::$doc_help_dir=plugin_dir_path($file).'supported-themes/doc_help/';
        self::$supported_themes_dir=plugin_dir_path($file).'supported-themes/';
        self::$supported_themes_url=self::$plugin_dir_url.'supported-themes/';
        self::$views_dir=plugin_dir_path($file).'YVTWP/views/';
        self::$resources_url=plugins_url().'/'.self::$plugin_name.'/YVTWP/views/resources/';
        self::$abspath=ABSPATH;
        
        self::$wpdb_prefixe=$wpdb->prefix;
        self::$yvtwp_prefixe=$wpdb->prefix.'yvtwp_';
        self::$wpdb_charset=$wpdb->get_charset_collate();
        self::$ajax_url=admin_url( 'admin-ajax.php' );        
        
        self::initGeneralSettings();
        self::initVideoMicrodata();
        self::loadDefaultSettings();
                
        self::$googleDevelopperkeyErrorMsg=__('You need to set your Google developer key to use the plugin', 'YVTWP-lang').'<a href="?page=yvtwp&yvtwp_controller=settings&yvtwp_action=youtubeAPISettings"> '.__('Click here to change','YVTWP-lang').' </a>';
        self::$feedType=array(
            'feed_channel'=>__('Channel','YVTWP-lang'),
            'feed_playlist'=>__('Playlist','YVTWP-lang'),
            'feed_user'=>__('User','YVTWP-lang'),
            'feed_search_query'=>__('Search query','YVTWP-lang'),
            'feed_single_video' => __('Single video','YVTWP-lang')
            );

        self::$importTypes=array(
            'paginate_import'=>__('Paginate Import','YVTWP-lang'),
            'bulk_import'=>__('Bulk Import','YVTWP-lang'),
            'scheduled_import'=>__('Scheduled Import','YVTWP-lang')
            );    

        self::$logType=array(
            'scheduling_videos_import' =>__('Scheduling videos import','YVTWP-lang'),
            'normal_videos_import' =>__('Normal videos import','YVTWP-lang'),
            'comments'  => __('Comment import','YVTWP-lang'),
            'db_errors' => __('DataBase Errors','YVTWP-lang'),
            'youtube_api_errors' =>__('Youtube API Errors','YVTWP-lang') 
            );  

        self::$schedulingRecurrance=array(
            'daily'=>__('Daily','YVTWP-lang'),
            'twicedaily'=>__('Twice daily','YVTWP-lang'),
            'hourly'=>__('Hourly','YVTWP-lang'),
            'yvtwpevery30minute'=>__('Once Every 30 Minutes','YVTWP-lang'),
            'yvtwpevery15minute'=>__('Once Every 15 Minutes','YVTWP-lang'),
            'yvtwpevery5minute'=>__('Once Every 5 Minutes','YVTWP-lang')
            );

        self::$order=array(
            ''=>__('select','YVTWP-lang'),        
            'date'=>__('date','YVTWP-lang'),
            'rating'=>__('rating','YVTWP-lang'),
            'relevance'=>__('relevance','YVTWP-lang'),
            'title'=>__('title','YVTWP-lang'),
            'viewCount' =>__('view count','YVTWP-lang')
            );  

        self::$safeSearch=array(
            ''=>__('select','YVTWP-lang'),
            'none'=>__('none','YVTWP-lang'),        
            'moderate'=>__('moderate','YVTWP-lang'),
            'strict'=>__('strict','YVTWP-lang')
            ); 

        self::$videoCaption=array(
            ''=>__('select','YVTWP-lang'),
            'any'=>__('any','YVTWP-lang'),
            'closedCaption'=>__('closedCaption','YVTWP-lang'),
            'none'=>__('none','YVTWP-lang')
            ); 

        self::$videoDefinition=array(
            ''=>__('select','YVTWP-lang'),
            'any'=>__('any','YVTWP-lang'),
            'high'=>__('high','YVTWP-lang'),
            'standard'=>__('standard','YVTWP-lang')
            ); 

        self::$videoDimension=array(
            ''=>__('select','YVTWP-lang'),
            'any'=>__('any','YVTWP-lang'),
            '2d'=>__('2d','YVTWP-lang'),
            '3d'=>__('3d','YVTWP-lang')
            ); 

        self::$videoDuration=array(
            ''=>__('select','YVTWP-lang'),
            'any'=>__('any','YVTWP-lang'),
            'long'=>__('long','YVTWP-lang'),
            'medium'=>__('medium','YVTWP-lang'),
            'short'=>__('short','YVTWP-lang')
            );  

        self::$videoEmbeddable=array(
            'true'=>__('true','YVTWP-lang'),
            'any'=>__('any','YVTWP-lang')
            );  

        self::$videoLicense=array(
            ''=>__('select','YVTWP-lang'),
            'any'=>__('any','YVTWP-lang'),
            'creativeCommon'=>__('creativeCommon','YVTWP-lang'),
            'youtube'=>__('youtube','YVTWP-lang')
            ); 

        self::$videoSyndicated=array(
            ''=>__('select','YVTWP-lang'),
            'any'=>__('any','YVTWP-lang'),
            'true'=>__('true','YVTWP-lang')
            );    

        self::$videoType=array(
            ''=>__('select','YVTWP-lang'),
            'any'=>__('any','YVTWP-lang'),
            'episode'=>__('episode','YVTWP-lang'),
            'movie'=>__('movie','YVTWP-lang')
            );  
        
        self::$commentStatus=array(
            '1'=>__('Approved','YVTWP-lang'),
            '0'=>__('Unapproved','YVTWP-lang'),
            'spam'=>__('Spam','YVTWP-lang'),
            'trash'=>__('Trash','YVTWP-lang')
            ); 

        self::$commentAuthorUrl=array(
            ''=>__('none','YVTWP-lang'),
            'authorGooglePlusUrl'=>__('Author Google plus Profile Url','YVTWP-lang'),
            'authorChannelUrl' =>__('Author Channel Url','YVTWP-lang')
            ); 
        
        self::$commentDate=array(
            'youtubeCommentPublishedDate'=>__('Youtube published date','YVTWP-lang'),
            'insertDate'=>__('Insert date','YVTWP-lang')
            );         
        
                
        self::$commentOrder=array(
            'time'=>__('Time ','YVTWP-lang'),
            'relevance'=>__('Relevance ','YVTWP-lang')
            );   
        
        self::$commentFormat=array(
            'html'=>__('Html','YVTWP-lang'),
            'plainText'=>__('Plain Text','YVTWP-lang')
            );   
        
        self::$statusVideoMessage=array(
            'deleted'=>__('Video Deleted','YVTWP-lang'),
            'failed'=>__('Failed upload video','YVTWP-lang'),
            'rejected'=>__('Video Rejected','YVTWP-lang'),
            'private'=>__('Private Video','YVTWP-lang'),
            'unlisted'=>__('Unlisted Video','YVTWP-lang'),
            'embeddable'=>__('Video Embeding is not allowed','YVTWP-lang')
            );          
    }//End construct
    private static function initGeneralSettings()
    {                       
        $generalSettings=SettingsModel_YVTWP::getGeneralSettings();

        foreach (self::$general_settings as $key => $value)
        {
            if(!isset($generalSettings[$key]) || $generalSettings[$key]=="")
                $generalSettings[$key]=$value;
        }
        
        self::$general_settings=$generalSettings;       
    }
    /*
     * 
     */
    public static function loadDefaultSettings($theme_name=NULL)
    {
        $default_settings=SettingsModel_YVTWP::getOption('yvtwp_default_import_settings');
        if(!is_array($default_settings) || $theme_name)
        {
            if(!$theme_name)
            {
                $theme_name = str_replace(' ','_', wp_get_theme());
                $theme_name=  strtolower($theme_name);
            }
            
            $file_name = $theme_name.'.json';   
            $file_path=  self::$supported_themes_dir.$file_name;

            if(file_exists($file_path))
            {
                $json_content=  FileSystem_YVTWP::getJsonFileContents($file_path);
                $array_settings=json_decode($json_content,TRUE);
                if(is_array($array_settings))
                {
                    self::$default_import_setting=$array_settings;
                    SettingsModel_YVTWP::setOption('yvtwp_default_import_settings',$array_settings,TRUE);
                }
            }
        }
    }
    /*
     * 
     */
    public static function initVideoMicrodata()
    {
        $videoMicrodata=SettingsModel_YVTWP::getOption('yvtwp_videos_microdata');
        if(is_array($videoMicrodata))
            self::$videos_microdata=$videoMicrodata;
    }
    /*
     * 
     */
    public static function get($ConfigName,$default=NULL)
    {
        //self::initGeneralSettings();
        return self::$general_settings[$ConfigName];
    }
    /*
     * 
     */
    public static function getAjaxUrl()
    {
        $ajax_url=self::$ajax_url;
        if(isset(self::$general_settings['ajax_request']))
            if(self::$general_settings['ajax_request']=='yvtwp')
                $ajax_url=plugins_url().'/'.self::$plugin_name.'/ajax_request.php';  
            
        return $ajax_url;
    }
}
?>