<?php
class TmpVideosModel_YVTWP {

    private static $table_tmp_videos='';

    private static function init() 
    {
        self::$table_tmp_videos= Config_YVTWP::$yvtwp_prefixe.'tmp_videos';
    }
    /**
     * 
     */
    public static function insertVideosFeed($arg)
    {
        self::init();
        
        if(!isset($arg['paged']))
            $arg['paged']=1;

        $videoDatas=json_decode($arg['video_datas'], TRUE);
        $publishedAt=date("Y-m-d H:i:s", strtotime($videoDatas['snippet']['publishedAt']));             
        
        $schedule_position= self::getNextLastTmpvideoSchedulePositionInImport($arg['import_id']);
        $insert_time=date('Y-m-d H:i:s');
        
        $data['import_id']=$arg['import_id'];
        $data['video_key']=$arg['video_key'];
        $data['published_at']=$publishedAt;
        $data['video_datas']=$arg['video_datas'];
        $data['paged']=$arg['paged'];
        $data['page_token']=$arg['pageToken'];
        $data['schedule_position']=$schedule_position;
        $data['time']=$insert_time;

        $response=MappingWP_YVTWP::insertData(self::$table_tmp_videos,$data);

        return $response;   
    }
    /*
     * 
     */
    public static function getFisrtInsertedVideo($import_id)
    {
        self::init();
        
        $res=FALSE;
        $query="select id from ".self::$table_tmp_videos." where import_id={$import_id} order by id ASC limit 1"; 
        $response= MappingWP_YVTWP::executeSql($query,MappingWP_YVTWP::GET_VAR);

        if($response->status==1)
               $res=$response->result;
        
        return $res;        
    }
    /*
     * 
     */
    public static function getNextVideoIdToImport($import_id)
    {
        self::init();
        $res=FALSE;
        
        $id_last_auto_video_imported=ImportModel_YVTWP::getLastAutoVideoImported($import_id);
        if(!$id_last_auto_video_imported)
            $res=self::getFisrtInsertedVideo($import_id);
        else
        {
            $query="select id from ".self::$table_tmp_videos." where import_id={$import_id} and id>{$id_last_auto_video_imported} limit 1 ";             
            $response= MappingWP_YVTWP::executeSql($query,MappingWP_YVTWP::GET_VAR);

            if($response->status==1 && $response->result)
                $res=$response->result;
        }
            
        return $res;          
    }    
    /*
     * 
     */
    private static function getNextLastTmpvideoSchedulePositionInImport($import_id)
    {
        self::init();
        
        $schedule_position=1;
        $query="select schedule_position from ".self::$table_tmp_videos." where import_id='{$import_id}' order by id desc limit 1 "; 
        $response= MappingWP_YVTWP::executeSql($query,MappingWP_YVTWP::GET_VAR);

        if($response->status==1)
            if($response->result!=0)
                $schedule_position=$response->result+1;            
        
        return $schedule_position;        
    }
    /*
     * 
     */
    public static function getSchedulePositionByTmpVideoId($tmp_video_id)
    {
        self::init();
        
        $schedule_position=1;
        $query="select schedule_position from ".self::$table_tmp_videos." where id='{$tmp_video_id}' "; 
        $response= MappingWP_YVTWP::executeSql($query,MappingWP_YVTWP::GET_VAR);

        if($response->status==1)
            $schedule_position=$response->result;
        
        return $schedule_position;        
    }
    /*
     * 
     */
    public static function existImportFeed($import_id,$pageToken)
    {
        self::init();
        
        $exist=TRUE;
        
        $query="select count(id) from ".self::$table_tmp_videos." where import_id={$import_id} and page_token='{$pageToken}' ";
        $response= MappingWP_YVTWP::executeSql($query,MappingWP_YVTWP::GET_VAR);
        
        if($response->status==1)
        {
            $result=$response->result;
            if($result==0)
                $exist=FALSE;
        }
 
        return $exist;   
    }
    /**
     * 
     */
    public static function getVideosFeed($arg)
    {
        self::init();
        $dateCondition='';
        
        if(!isset($arg['paged']))
            $arg['paged']=1;
        
        $import_settings=$arg['import_settings'];
        
        if(!empty($import_settings['published_after'])&&!empty($import_settings['published_before']))
        {
            $publishedAfter=date('Y-m-d H:i:s', strtotime($import_settings['published_after']));
            $publishedBefore=date('Y-m-d H:i:s', strtotime($import_settings['published_before']));   
            $dateCondition=" and published_at between '{$publishedAfter}' and '{$publishedBefore}'  ";
        }         
        
        $query="select * from ".self::$table_tmp_videos." where import_id={$arg['import_id']} and paged={$arg['paged']} $dateCondition ";
        $response= MappingWP_YVTWP::executeSql($query,MappingWP_YVTWP::GET_RESULTS);
 
        return $response;           
    }
    /**
     * 
     */
    public static function getTmpVideoById($id)
    {
        self::init();
        
        $query="select * from ".self::$table_tmp_videos." where id={$id} ";
        $response= MappingWP_YVTWP::executeSql($query,MappingWP_YVTWP::GET_RESULTS);
 
        return $response;           
    }
    /*
     * 
     */
    public static function getPagedByTmpVideoId($tmp_video_id)
    {
        self::init();
        
        $paged=0;
        $query="select paged from ".self::$table_tmp_videos." where paged!='' and id='{$tmp_video_id}' "; 
        $response= MappingWP_YVTWP::executeSql($query,MappingWP_YVTWP::GET_VAR);

        if($response->status==1)
            $paged=$response->result;
        
        return $paged;
    }
    /*
     * 
     */
    public static function existTmpVideosPaged($paged,$import_id)
    {
        self::init();
        
        $res=FALSE;
        $query="select count(paged) from ".self::$table_tmp_videos." where paged='{$paged}' and import_id='{$import_id}' "; 
        $response= MappingWP_YVTWP::executeSql($query,MappingWP_YVTWP::GET_VAR);

        if($response->status==1)
            if($response->result>0)
               $res=TRUE;
        
        return $res;
    }    
    /*
     * 
     */
    public static function getCountTmpImportedVideo($import_id)
    {
        self::init();
        $count=0;

        $query="select count(id) from ".self::$table_tmp_videos." where import_id={$import_id} and is_imported='1' ";             
        $response= MappingWP_YVTWP::executeSql($query,MappingWP_YVTWP::GET_VAR);

        if($response->status==1)
            if($response->result)
                $count=$response->result;
            
        return $count;         
    }
    /*
     * 
     */
    public static function updateTmpVideo($arg)
    {
        self::init();
        
        $query="update ".self::$table_tmp_videos."
        set is_imported='{$arg['is_imported']}' where id={$arg['tmp_video_id']} and import_id='{$arg['import_id']}' " ;
        $response= MappingWP_YVTWP::executeSql($query,MappingWP_YVTWP::UPDATE);  
        
        return $response;        
    }
    /*
     * 
     */
    public static function updateImpVideosCommentInfos($data)
    {
        self::init();   

        $where=array('video_key'=>$data['video_key']);
        $data['updated_time']=date('Y-m-d H:i:s');
        unset($data['video_key']);    
        
        $response= MappingWP_YVTWP::updateData(self::$table_tmp_videos,$data,$where); 
        
        return $response;
    }    
    /*
     * 
     */
    public static function getNextPageTokenComment($post_id)
    {
        return get_post_meta($post_id,'yvtwp_next_page_token_comment',TRUE);        
    }   
    /*
     * 
     */
    public static function getCurrentPagedComment($post_id)
    {
        $paged=get_post_meta($post_id,'yvtwp_current_paged_comment',TRUE);
        if(!$paged)
            $paged=1;
        
        return $paged;
    }         
    /**
     * 
     */
    public static function clearCache($arg)
    {
        self::init();      
        
        $response= MappingWP_YVTWP::deleteData(self::$table_tmp_videos,array('import_id'=>$arg['import_id']));

        return $response;           
    }
    /**
     * 
     */
    public static function deleteByVideoKeyAndImportId($import_id, $video_key)
    {
        self::init();      
        
        $response= MappingWP_YVTWP::deleteData(self::$table_tmp_videos,array('import_id' => $import_id, 'video_key' => $video_key));

        return $response;           
    }    
    /*
     * 
     */
    public static function trancateTable()
    {
        self::init();
        
        $query="TRUNCATE TABLE ".self::$table_tmp_videos;
        $response= MappingWP_YVTWP::executeSql($query,  MappingWP_YVTWP::GET_RESULTS); 
        
        return $response;        
    }    
    
}
?>