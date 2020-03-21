<?php

class ImportModel_YVTWP {

    private static $table_imports='';
    private static $table_tmp_videos='';

    private static function init() 
    {
        self::$table_imports= Config_YVTWP::$yvtwp_prefixe.'imports';
        self::$table_tmp_videos= Config_YVTWP::$yvtwp_prefixe.'tmp_videos';        
    }    
    
    public static function existFeedKey($feed_key)
    {
        self::init();
        
        $feed_key=strtolower($feed_key);
        $bool=FALSE;
        
        $query="select count(feed_key) from ".self::$table_imports." where LOWER(feed_key)='{$feed_key}' ";
        $response= MappingWP_YVTWP::executeSql($query,MappingWP_YVTWP::GET_VAR);
        
        if($response->result>0)
            $bool=TRUE;
        
        return $bool;
    }
    /*
     * 
     */
    public static function getLoadLinkByFeedKey($feed_key)
    {
        $link=FALSE;
        
        $query="select * from ".self::$table_imports." where feed_key='{$feed_key}' limit 1";
        $response= MappingWP_YVTWP::executeSql($query,MappingWP_YVTWP::GET_RESULTS);  
        
        if($response->status==1 && is_array($response->result))
        {
            $import=$response->result[0];
            $settings=SettingsModel_YVTWP::getOption("yvtwp_import_settings_".$import['id'],Config_YVTWP::$default_import_setting,TRUE);
            
            $link="?page=yvtwp&yvtwp_controller=import&yvtwp_action=newImport&feed_type=".$import['feed_type']."&import_type=".$settings['import_type']."&paged=1&pageToken=&import_id=".$import['id'];
        }
        
        return $link;
    }
    /**
     * 
     */
    public static function saveImportSettings($arg)
    {
        self::init();
        
        unset($arg['action']);
        unset($arg['yvtwp_controller']);
        unset($arg['yvtwp_action']);
        
        //update import settings
        if(!empty($arg['import_id']))
        {              
            $data['feed_type']=$arg['feed_type'];
            $data['feed_key']=$arg['feed_key'];
            $data['max_imported_videos']=$arg['max_imported_videos'];
            $data['import_description']=$arg['import_description'];
            $data['active_import_schedule']=$arg['active_import_schedule'];
            $data['updated_time']= date('Y-m-d H:i:s');
            
            $where=array('id'=>$arg['import_id']);

            $response=MappingWP_YVTWP::updateData(self::$table_imports, $data, $where);            
            
            if($response->status==1)
            {
                $response_old_settings=SettingsModel_YVTWP::getOption('yvtwp_import_settings_'.$arg['import_id'],$arg,TRUE);
                $res=SettingsModel_YVTWP::setOption('yvtwp_import_settings_'.$arg['import_id'],$arg,TRUE);
                
                if($res) //change schedule current position if start date is changed
                {
                    $old_settings=$response_old_settings;
                    if(isset($old_settings['schedule_start_date']))
                        if($old_settings['schedule_start_date']!=$arg['schedule_start_date'])
                            self::updateScheduleCurrentPosition($arg['import_id'],0); 
                }    
            }   
        }
        else //insert import settings
        {   
            $data['feed_type']=$arg['feed_type'];
            $data['feed_key']=$arg['feed_key'];
            $data['max_imported_videos']=$arg['max_imported_videos'];
            $data['import_description']=$arg['import_description'];
            $data['active_import_schedule']=$arg['active_import_schedule'];
            $data['created_time']= date('Y-m-d H:i:s');
            $data['user_id']=Config_YVTWP::$current_user_id_2;

            $response=MappingWP_YVTWP::insertData(self::$table_imports,$data);
                        
            if($response->status==1)
            {
                $import_id=$response->result;
                $arg['import_id']=$import_id;
                $res=SettingsModel_YVTWP::setOption('yvtwp_import_settings_'.$import_id,$arg,TRUE);

                if($res)
                {
                    $result['import_id']=$import_id;
                    $result['redirect']='?page=yvtwp&yvtwp_controller=import&yvtwp_action=newImport&paged=1&import_id='.$import_id;
                    $response->messages=__('You\'ll be redirected in a moment!', 'YVTWP-lang');
                    $response->result=$result;
                }
            }
        }
 
        return $response;
    }
    /**
     * 
     */
    /*
     * 
     */
    public static function getImportIdByFeedKey($feed_key)
    {
        self::init();     
        
        $import_id=1;
        
        $query="select id from ".self::$table_imports." where feed_key='{$feed_key}' ";
        $response= MappingWP_YVTWP::executeSql($query,MappingWP_YVTWP::GET_VAR);

        if($response->status==1)
            $import_id=$response->result;
                   
        return $import_id;
    }    
    /*
     * 
     */
    public static function getImportIdByVideoKey($video_key)
    {
        self::init();     
        
        $import_id=FALSE;
        
        $query="select id from ".self::$table_imports." where feed_key='{$video_key}' ";
        $response= MappingWP_YVTWP::executeSql($query,MappingWP_YVTWP::GET_VAR);

        if($response->status==1)
            $import_id=$response->result;
                   
        return $import_id;
    }        
    /*
     * 
     */
    public static function getAllImportSingleVideosIds()
    {
        self::init();
        
        $imploded="";
        
        $where="where 1";
        $where_user_filter="";
        if(Config_YVTWP::$is_demo=='yes' && Config_YVTWP::$current_user_id!=Config_YVTWP::$user_id_demo)
            $where_user_filter=" and user_id!=".Config_YVTWP::$user_id_demo;     
        
        $where=$where." and feed_type='feed_single_video'";
        
        $query="select id from ".self::$table_imports." {$where}{$where_user_filter} order by id desc ";
        $response= MappingWP_YVTWP::executeSql($query,MappingWP_YVTWP::GET_RESULTS);
 
        return $response;           
    }    
    /*
     * 
     */
    public static function getAllSingleVideosImplodedKeys()
    {
        self::init();
        
        $imploded="";
        
        $where="where 1";
        $where_user_filter="";
        if(Config_YVTWP::$is_demo=='yes' && Config_YVTWP::$current_user_id!=Config_YVTWP::$user_id_demo)
            $where_user_filter=" and user_id!=".Config_YVTWP::$user_id_demo;     
        
        $where=$where." and feed_type='feed_single_video'";
        
        $query="select feed_key from ".self::$table_imports." {$where}{$where_user_filter} order by id desc ";
        $response= MappingWP_YVTWP::executeSql($query,MappingWP_YVTWP::GET_RESULTS);
        
        if($response->status==1 && is_array($response->result))
        {
            $values = array_map('array_pop', $response->result);
            $imploded = implode(',', $values);            
        }
 
        return $imploded;           
    }
    /*
     * 
     */
    public static function getListOfImports($arg)
    {
        self::init();
        
        $where="where 1";
        $where_user_filter="";
        if(Config_YVTWP::$is_demo=='yes' && Config_YVTWP::$current_user_id!=Config_YVTWP::$user_id_demo)
            $where_user_filter=" and user_id!=".Config_YVTWP::$user_id_demo;     
                
        $paged_limit=Config_YVTWP::get('import_paged');
        $paged=0;
        
        if(isset($arg['paged']))
            $paged=$arg['paged']-1;

        $next_offset = $paged * $paged_limit;
        
        //if applicated filter
        if(isset($arg['feed_type']))
            $where=$where." and feed_type='{$arg['feed_type']}'";
        
        $query="select * from ".self::$table_imports." {$where}{$where_user_filter} order by id desc LIMIT $paged_limit OFFSET $next_offset ";
        $response= MappingWP_YVTWP::executeSql($query,MappingWP_YVTWP::GET_RESULTS);
 
        return $response;           
    }
    /*
     * 
     */
    public static function getTotalResults($arg)
    {
        self::init();
        
        $total_results=0;
        $where="where 1";
        $where_user_filter="";
        
        if(Config_YVTWP::$is_demo=='yes' && Config_YVTWP::$current_user_id!=Config_YVTWP::$user_id_demo)
            $where_user_filter=" and user_id!=".Config_YVTWP::$user_id_demo;        
                
        //if applicated filter
        if(isset($arg['feed_type']))
            $where=$where." and feed_type='{$arg['feed_type']}'";
        
        $query="select count(*) from ".self::$table_imports." {$where}{$where_user_filter} ";
        $response= MappingWP_YVTWP::executeSql($query,MappingWP_YVTWP::GET_VAR);
        
        if($response->status==1)
            $total_results=$response->result;
 
        return $total_results;
    }   
    /*
     * 
     */
    public static function updateImportInfos($data)
    {
        self::init();   

        $where=array('id'=>$data['import_id']);
        $data['updated_time']=date('Y-m-d H:i:s');
        unset($data['import_id']);    
        
        $response= MappingWP_YVTWP::updateData(self::$table_imports,$data,$where); 
        
        return $response;
    }
    /*
     * 
     */
    public static function getScheduleCurrentPositionByImportKey($import_id)
    {
        self::init();

        $schedule_current_position=0;
        $query="select schedule_current_position from ".self::$table_imports." where id={$import_id} "; 
        $response= MappingWP_YVTWP::executeSql($query,MappingWP_YVTWP::GET_VAR);

        if($response->status==1)
            $schedule_current_position=$response->result;
        
        return $schedule_current_position;        
    }    
    /*
     * 
     */
    public static function updateScheduleCurrentPosition($import_id,$schedule_current_position)
    {
        self::init();         
        
        if(!$schedule_current_position)
            $schedule_current_position=0;
        
        $query="update ".self::$table_imports."
        set schedule_current_position={$schedule_current_position} where id={$import_id} " ;
        $response= MappingWP_YVTWP::executeSql($query,MappingWP_YVTWP::UPDATE);  
        
        return $response;
    }    
    /*
     * 
     */
    public static function updateLastAutoVideoImported($data)
    {
        self::init();     
        
        $where=array('id'=>$data['import_id']);
        unset($data['import_id']);
        
        $response= MappingWP_YVTWP::updateData(self::$table_imports,$data,$where);         
        
        return $response;
    } 
    /*
     */
    public static function updateCurrentPaged($paged,$import_id)
    {
        self::init();         

        $where=array('id'=>$import_id);
        $data['current_paged']=$paged; 
        
        $response= MappingWP_YVTWP::updateData(self::$table_imports,$data,$where);         
        
        return $response;        
    } 
    /*
     */
    public static function updateLastScheduleCheckDate($date,$import_id)
    {
        self::init();         

        $where=array('id'=>$import_id);
        $data['last_schedule_check_date']=$date; 
        
        $response= MappingWP_YVTWP::updateData(self::$table_imports,$data,$where);           
        
        return $response;        
    }   
    /*
     * 
     */
    public static function getNextPageToken($import_id)
    {
        self::init();     
        
        $nextPageToken=FALSE;
        
        $query="select next_page_token from ".self::$table_imports." where next_page_token!='' and id={$import_id} ";
        $response= MappingWP_YVTWP::executeSql($query,MappingWP_YVTWP::GET_VAR);

        if($response->status==1)
            $nextPageToken=$response->result;
            
        return $nextPageToken;
    }
    /*
     * 
     */
    public static function getNextPageTokenComment($import_id)
    {
        self::init();     
        
        $nextPageToken=FALSE;
        
        $query="select next_page_token_comment from ".self::$table_imports." where next_page_token_comment!='' and id={$import_id} ";
        $response= MappingWP_YVTWP::executeSql($query,MappingWP_YVTWP::GET_VAR);

        if($response->status==1)
            $nextPageToken=$response->result;
            
        return $nextPageToken;
    }   
    /*
     * 
     */
    public static function getCurrentPagedComment($import_id)
    {
        self::init();     
        
        $current_paged_comment=1;
        
        $query="select current_paged_comment from ".self::$table_imports." where current_paged_comment!='' and id={$import_id} ";
        $response= MappingWP_YVTWP::executeSql($query,MappingWP_YVTWP::GET_VAR);

        if($response->status==1)
            $current_paged_comment=$response->result;
                   
        return $current_paged_comment;
    }    
    /*
     * 
     */
    public static function getLastAutoVideoImported($import_id)
    {
        self::init();     
        
        $last_auto_video_imported=FALSE;
        
        $query="select last_auto_video_imported from ".self::$table_imports." where last_auto_video_imported!='' and id={$import_id} ";
        $response= MappingWP_YVTWP::executeSql($query,MappingWP_YVTWP::GET_VAR);

        if($response->status==1)
            $last_auto_video_imported=$response->result;
            
        return $last_auto_video_imported;        
    }

    /**
     * 
     */
    public static function getImportInfos($import_id)
    {
        self::init();       
        
        $query="select * from ".self::$table_imports." where id={$import_id} limit 1 ";
        $response= MappingWP_YVTWP::executeSql($query,MappingWP_YVTWP::GET_RESULTS);
 
        return $response;            
    }
    /*
     */
    public static function loadFeed($arg)
    {
        $response=TmpVideosModel_YVTWP::insertVideosDatas($arg);
    }
    /**
     * 
     */
    public static function clearCacheImport($arg)
    {
        self::init();      
        
        TmpVideosModel_YVTWP::clearCache($arg);
        TmpCommentModel_YVTWP::clearCache($arg);
        LogModel_YVTWP::clearImportLlog($arg);
        
        $infosImport['current_paged']=1;
        $infosImport['prev_page_token']='';
        $infosImport['next_page_token']='';
        $infosImport['etag']='';
        $infosImport['last_auto_video_imported']='';
        $infosImport['schedule_current_position']=0;
        $infosImport['import_id']=$arg['import_id'];

        $response=  ImportModel_YVTWP::updateImportInfos($infosImport);   
        
        

        return $response;           
    }     
    /**
     * 
     */
    public static function deleteImport($arg)
    {
        self::init();       
        
        $response= MappingWP_YVTWP::deleteData(self::$table_imports,array('id'=>$arg['import_id']));
        
        if($response->status==1)
        {
            SettingsModel_YVTWP::removeOption('yvtwp_import_settings_'.$arg['import_id']);  
            
            $result= Post_YVTWP::getPostIdsByImportId($arg['import_id']);
            foreach ($result as $key => $value) {
                
                Post_YVTWP::deletePostAttachements($value['post_id']);
                
                $res=wp_delete_post($value['post_id'], TRUE);
                if($res===FALSE)
                {
                    $messages="Error wp_delete_post";
                    MappingWP_YVTWP::logErrorsDB($messages); 
                }                
            }
        }
 
        return $response;           
    }   
    /*
     * 
     */
    public static function getImportIdToCheckNewsVideos()
    {
        self::init();

        $import_id=FALSE;
        $query="select id from ".self::$table_imports." where active_import_schedule='yes' order by last_schedule_check_date ASC limit 1 "; 
        $response= MappingWP_YVTWP::executeSql($query,MappingWP_YVTWP::GET_VAR);

        if($response->status==1)
            $import_id=$response->result;
        
        return $import_id;         
    }
    /*
     * 
     */
    public static function clearCacheForAllImport()
    {
        self::init();
        
        $query="update ".self::$table_imports." set current_paged=1,prev_page_token='',next_page_token='',etag='',last_auto_video_imported='',schedule_current_position=0  "; 
        $response= MappingWP_YVTWP::executeSql($query,MappingWP_YVTWP::UPDATE);
        
        return $response;
    }
}
?>