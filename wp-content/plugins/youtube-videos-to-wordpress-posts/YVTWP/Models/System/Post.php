<?php

class Post_YVTWP {
    
    private static $table_posts='';
    private static $table_postmeta='';

    private static function init() {
        self::$table_posts=Config_YVTWP::$wpdb_prefixe.'posts';
        self::$table_postmeta=Config_YVTWP::$wpdb_prefixe.'postmeta';
    }    
    /**
     * 
     */
    public static function getListPostTypes($arg_)
    {
        $response= new Response_YVTWP();

        $exclude_cpts = array('attachment','revision','nav_menu_item','');
        $cpts=get_post_types('', 'names' );
        
        // remove Excluded CPTs from All CPTs.
        foreach($exclude_cpts as $exclude_cpt)
            unset($cpts[$exclude_cpt]);

        $response->result = $cpts;        

        return $response;
    }
    /**
     * 
     */
    public static function getListCustomFields($arg_)
    {
        self::init();
        
        $query="select distinct meta_key from ".self::$table_postmeta." ";
        $response=  MappingWP_YVTWP::executeSql($query,MappingWP_YVTWP::GET_RESULTS);
        
        return $response;        
    }
    /*
     */
    public static function getExistPostIdbyTitle($title)
    {
        self::init();
        
        $title=  MappingWP_YVTWP::esc_sql($title);        
        $res=FALSE;
        
        $query="select ID from ".self::$table_posts." where post_type!='attachment' and post_title like '{$title}' limit 1";
        $response=  MappingWP_YVTWP::executeSql($query,MappingWP_YVTWP::GET_VAR);
        
        if($response->status==1)
        {
            $result=$response->result;
            if($result>0)
                $res=$result;
        }
        
        return $res;           
    }
    /*
     */
    public static function existPostMeta($meta_key,$meta_value)
    {
        self::init();
        
        $res=TRUE;
        
        $query="select count(meta_key) from ".self::$table_postmeta." where meta_key='{$meta_key}' and meta_value='{$meta_value}' ";
        $response=  MappingWP_YVTWP::executeSql($query,  MappingWP_YVTWP::GET_VAR);
        
        if($response->status==1)
        {
            $result=$response->result;
            if($result==0)
                $res=FALSE;
        }
        
        return $res;         
    }
    public static function getPost_idByPostMeta($meta_key,$meta_value)
    {
        self::init();
        
        $query="select post_id from ".self::$table_postmeta." where meta_key='{$meta_key}' and meta_value='{$meta_value}' ";
        $response=MappingWP_YVTWP::executeSql($query,MappingWP_YVTWP::GET_VAR);    
        
        return $response->result;
    }
    /*
     * 
     */
    public static function getPostsCountByImportId($import_id)
    {
        self::init();
        
        $result=0;
        
        $query="select count(post_id) from ".self::$table_postmeta." where meta_key='yvtwp_import_id' and meta_value='{$import_id}' ";
        $response= MappingWP_YVTWP::executeSql($query,MappingWP_YVTWP::GET_VAR);
        
        if($response->status==1)
            $result=$response->result;
        
        return $result;       
    }   
    /*
     * 
     */
    public static function getPostsCountByMetaKey($meta_key)
    {
        self::init();
        
        $result=0;
        
        $query="select count(post_id) from ".self::$table_postmeta." where meta_key='{$meta_key}' ";
        $response= MappingWP_YVTWP::executeSql($query,MappingWP_YVTWP::GET_VAR);
        
        if($response->status==1)
            $result=$response->result;
        
        return $result;       
    }     
    /*
     * 
     */
    public static function getCountBrokenVideosChecked($last_post_checked_id)
    {
        self::init();
        
        $result=0;
        
        //$query="select count(post_id) from ".self::$table_postmeta." where meta_key='yvtwp_video_key' and post_id<{$last_post_checked_id} ";
        $query="select count(ID) from ".self::$table_posts." A join ".self::$table_postmeta." B on A.ID=B.post_id where B.meta_key='yvtwp_video_key' and A.ID<={$last_post_checked_id} ";
        $response= MappingWP_YVTWP::executeSql($query,MappingWP_YVTWP::GET_VAR);
        
        if($response->status==1)
            $result=$response->result;
        
        return $result;       
    }      
    /*
     * 
     */
    public static function getNextBrokenPostIdToCheck($last_post_checked_id)
    {
        self::init();
        
        $result=FALSE;
        
        $query="select post_id from ".self::$table_postmeta." where meta_key='yvtwp_video_key' and post_id>{$last_post_checked_id} order by post_id ASC limit 1 ";
        $response= MappingWP_YVTWP::executeSql($query,MappingWP_YVTWP::GET_VAR);
        
        if($response->status==1)
            $result=$response->result;
        
        return $result;       
    }       
    /*
     *
     */
    public static function getPostIdsByImportId($import_id)
    {
        self::init();
        
        $result=array();
        
        $query="select post_id from ".self::$table_postmeta." where meta_key='yvtwp_import_id' and meta_value='{$import_id}' ";
        $response=  MappingWP_YVTWP::executeSql($query, MappingWP_YVTWP::GET_RESULTS);
        
        if($response->status==1)
            $result=$response->result;
        
        return $result;         
    }
    /*
     * 
     */
    public static function synchronizeVideoDatas($post_id)
    {    
        
        $hoursBetweenEveryCheck=1;
        $current_date = new DateTime("now");
        $importId=get_post_meta($post_id,'yvtwp_import_id',TRUE);
        $videoKey=get_post_meta($post_id,'yvtwp_video_key',TRUE);
        $importSettings=SettingsModel_YVTWP::getOption("yvtwp_import_settings_".$importId,null,TRUE);
        
        if(isset($importSettings['synchronize_video_hour_between_every_check']))
            $hoursBetweenEveryCheck=(int)$importSettings['synchronize_video_hour_between_every_check'];
        
        if($importId && $videoKey && isset($importSettings['enable_synchronize_video']) && $importSettings['enable_synchronize_video']=='yes')
        {
            $last_check_date=get_post_meta($post_id,'yvtwp_synchronize_video_last_date',TRUE);
            if(!$last_check_date)
                $last_check_date=new DateTime("now");
            else
                $last_check_date = new DateTime($last_check_date);
            
            $count_check_per_day=(int)get_post_meta($post_id,'yvtwp_count_synchronize_video_per_day',TRUE);

            if($current_date->format('Y-m-d') > $last_check_date->format('Y-m-d'))
                $count_check_per_day=0;

            //if($last_check_date->add(new DateInterval("PT{$hoursBetweenEveryCheck}H"))<=$current_date || $count_check_per_day==0)
            //if( ( $last_check_date->modify(new DateInterval("PT{$hoursBetweenEveryCheck}H"))<= $current_date ) || $count_check_per_day==0 )
            $last_check_date->modify("+{$hoursBetweenEveryCheck} hour");
            if( ( $last_check_date <= $current_date ) || $count_check_per_day ==0 )
            {            
                if($count_check_per_day<(int)$importSettings['synchronize_video_max_check_per_day'])
                {
                    $importController=new ImportController_YVTWP();
                    $importController->importSynchronizeVideo($post_id,$importSettings, $importId, $videoKey);

                    update_post_meta($post_id,'yvtwp_count_synchronize_video_per_day',$count_check_per_day+1);  
                    update_post_meta($post_id,'yvtwp_synchronize_video_last_date',date('Y-m-d H:i:s'));    
                }
            }
        }

    }
    /*
     * 
     */
    public static function checkVideoNewComments($post_id)
    {    
        $hoursBetweenEveryCheck=1;
        $current_date = new DateTime("now");
        $importId=get_post_meta($post_id,'yvtwp_import_id',TRUE);
        $videoKey=get_post_meta($post_id,'yvtwp_video_key',TRUE);
        $importSettings=SettingsModel_YVTWP::getOption("yvtwp_import_settings_".$importId,null,TRUE);
        
        if(isset($importSettings['commentsHourBetweenEveryCheck']))
            $hoursBetweenEveryCheck=(int)$importSettings['commentsHourBetweenEveryCheck'];
        
        if($importId && $videoKey && isset($importSettings['enable_comments_import']) && $importSettings['enable_comments_synced']=='yes')
        {
            $last_check_date=get_post_meta($post_id,'yvtwp_check_comments_last_date',TRUE);
            if(!$last_check_date)
                $last_check_date=new DateTime("now");
            else
                $last_check_date = new DateTime($last_check_date);
            
            $count_check_per_day=(int)get_post_meta($post_id,'yvtwp_count_check_comments_per_day',TRUE);

            if($current_date->format('Y-m-d')>$last_check_date->format('Y-m-d'))
                $count_check_per_day=0;

            //if($last_check_date->add(new DateInterval("PT{$hoursBetweenEveryCheck}H"))<=$current_date || $count_check_per_day==0)
            //if($last_check_date->modify(new DateInterval("PT{$hoursBetweenEveryCheck}H"))<=$current_date || $count_check_per_day==0)
            $last_check_date->modify("+{$hoursBetweenEveryCheck} hour");
            if( ( $last_check_date <= $current_date ) || $count_check_per_day ==0 )
            {            
                if($count_check_per_day<(int)$importSettings['comment_max_check_per_day'])
                {
                    
                    $importController=new ImportController_YVTWP();
                    $importController->importVideoComments($post_id,$importId,$importSettings,$videoKey,$isSchedule=TRUE);

                    update_post_meta($post_id,'yvtwp_count_check_comments_per_day',$count_check_per_day+1);  
                    update_post_meta($post_id,'yvtwp_check_comments_last_date',date('Y-m-d H:i:s'));    
                }
            }   
        }

    }
    /*
     * 
     */
    public static function addRichSnippetsforVideos($post_id)
    {    
        $importId=get_post_meta($post_id,'yvtwp_import_id',TRUE);
        $videoKey=get_post_meta($post_id,'yvtwp_video_key',TRUE);
        $importSettings=SettingsModel_YVTWP::getOption("yvtwp_import_settings_".$importId,null,TRUE);
        

        if($importId && isset($importSettings['enable_rich_snippets']) && $importSettings['enable_rich_snippets']=='yes')
        {
 
            $videoMicrodata=new VideoMicrodata_YVTWP($importSettings, $post_id);
            $res=$videoMicrodata->parseTemplate(Config_YVTWP::$videos_microdata,Config_YVTWP::$microdataTemplateFields);
            
            if(is_array($res) && !empty($res))
            { 
                echo '<script type="application/ld+json">';
                echo json_encode($res);
                echo '</script>';
            }
        }

    }    
    /*
     * 
     */
    public static function incrementViewsCount($post_id)
    {
        $current_count=0;
        if(get_post_meta($post_id,'yvtwp_views_count',TRUE))
            $current_count=get_post_meta($post_id,'yvtwp_views_count',TRUE);

        update_post_meta($post_id,'yvtwp_views_count',$current_count+1);        
    }
    /*
     * 
     */
    public static function get_site_available_user_roles() 
    {
        global $wp_roles;

        $all_roles = $wp_roles->roles;

        return $all_roles;
    }
    /*
     * 
     */
    public static function getUsersByRole($role_name)
    {
        $args = array(
                'blog_id'      => $GLOBALS['blog_id'],
                'role'         => $role_name,
                'meta_key'     => '',
                'meta_value'   => '',
                'meta_compare' => '',
                'meta_query'   => array(),
                'include'      => array(),
                'exclude'      => array(),
                'orderby'      => 'post_count',
                'order'        => 'DESC',
                'offset'       => '',
                'search'       => '',
                'number'       => '3000',
                'count_total'  => false,
                'fields'       => array('ID','user_login'),
                'who'          => ''
         );        
        $users=get_users( $args );
        
        return $users;
    }
    public static function getTaxonomiesByPostType($post_type)
    {
        $args1=array(
          'object_type' => array($post_type) 
        ); 

        $output = 'names'; // or objects
        $operator = 'and'; // 'and' or 'or'
        $taxonomies=get_taxonomies($args1,$output,$operator);         
        
        return $taxonomies;
    }
    /*
     * 
     */
    public static function getCategoriesByTaxonomy($taxonomy)
    {
        $terms=array();
        
        $args = array(
            'orderby'           => 'name', 
            'order'             => 'ASC',
            'hide_empty'        => FALSE, 
            'exclude'           => array(), 
            'exclude_tree'      => array(), 
            'include'           => array(),
            'number'            => '', 
            'fields'            => 'all', 
            'slug'              => '',
            'parent'            => '',
            'hierarchical'      => true, 
            'child_of'          => 0,
            'childless'         => false,
            'get'               => '', 
            'name__like'        => '',
            'description__like' => '',
            'pad_counts'        => false, 
            'offset'            => '', 
            'search'            => '', 
            'cache_domain'      => 'core'
        ); 

        $terms = get_terms($taxonomy, $args);
            
        //return arry of object categories
        return $terms;
    }//End function
    /*
     * 
     */
    public static function deletePostAttachements($post_id)
    {
        $media = get_children( array(
            'post_parent' => $post_id,
            'post_type'   => 'attachment'
        ) );

        if( !empty( $media ) ) {
            foreach( $media as $file ) {
                $res=wp_delete_attachment( $file->ID ,TRUE);
                if($res===FALSE)
                {
                    $messages="Error wp_delete_attachment";
                    MappingWP_YVTWP::logErrorsDB($messages); 
                }
            } 
        }         
    }

}
