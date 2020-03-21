<?php
class TmpCommentModel_YVTWP {

    private static $table_tmp_comments='';

    private static function init() 
    {
        self::$table_tmp_comments= Config_YVTWP::$yvtwp_prefixe.'tmp_comments';
    }
    /**
     * 
     */
    public static function insertCommentsFeed($data)
    {
        self::init();
        
        if(!isset($data['paged']))
            $data['paged']=1;

        $commentDatas=  json_decode($data['comment_datas'], TRUE);
        if(isset($commentDatas['snippet']['topLevelComment']['snippet']['publishedAt']))
            $publishedAt=date("Y-m-d H:i:s",strtotime($commentDatas['snippet']['topLevelComment']['snippet']['publishedAt'])); 
        else
            $publishedAt=date("Y-m-d H:i:s",strtotime($commentDatas['snippet']['publishedAt']));
        
        $data['published_at']=$publishedAt;
        $data['time']=current_time('mysql');;

        $response=MappingWP_YVTWP::insertData(self::$table_tmp_comments,$data);

        return $response;   
    }
    /*
     * 
     */
    private static function getNextLastTmpvideoSchedulePositionInImport($import_id)
    {
        self::init();
        
        $schedule_position=1;
        $query="select schedule_position from ".self::$table_tmp_comments." where import_id='{$import_id}' order by id desc limit 1 "; 
        $response= MappingWP_YVTWP::executeSql($query,MappingWP_YVTWP::GET_VAR);

        if($response->status==1)
            if($response->result!=0)
                $schedule_position=$response->result+1;            
        
        return $schedule_position;        
    }
    /*
     * 
     */
    public static function getSchedulePositionByTmpCommentId($tmp_video_id)
    {
        self::init();
        
        $schedule_position=1;
        $query="select schedule_position from ".self::$table_tmp_comments." where id='{$tmp_video_id}' "; 
        $response= MappingWP_YVTWP::executeSql($query,MappingWP_YVTWP::GET_VAR);

        if($response->status==1)
            $schedule_position=$response->result;
        
        return $schedule_position;        
    }
    /**
     * 
     */
    public static function deleteCommentPageTokenFeed($import_id,$video_key,$page_token)
    {
        self::init();      
        
        $response= MappingWP_YVTWP::deleteData(self::$table_tmp_comments,array('import_id'=>$import_id,'video_key'=>$video_key,'page_token'=>$page_token));     

        return $response;           
    }
    /*
     * 
     */
    public static function existCommentFeedImport($import_id,$video_key,$pageToken)
    {
        self::init();
        
        $exist=TRUE;
        if(!$pageToken)
            $pageToken='';
        
        $query="select count(id) from ".self::$table_tmp_comments." where import_id='{$import_id}' and video_key='{$video_key}' and page_token='{$pageToken}' ";
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
    public static function getCommentsFeed($arg)
    {
        self::init();
        
        if(!isset($arg['paged']))
            $arg['paged']=1;            
        
        $query="select * from ".self::$table_tmp_comments." where video_key='{$arg['video_key']}' and paged={$arg['paged']} ";
        $response= MappingWP_YVTWP::executeSql($query,MappingWP_YVTWP::GET_RESULTS);
 
        return $response;           
    }
    /**
     * 
     */
    public static function getTmpCommentById($id)
    {
        self::init();
        
        $query="select * from ".self::$table_tmp_comments." where id={$id} ";
        $response= MappingWP_YVTWP::executeSql($query,MappingWP_YVTWP::GET_RESULTS);
 
        return $response;           
    }
    /*
     * 
     */
    public static function getPagedByTmpCommentId($tmp_video_id)
    {
        self::init();
        
        $paged=0;
        $query="select paged from ".self::$table_tmp_comments." where paged!='' and id='{$tmp_video_id}' "; 
        $response= MappingWP_YVTWP::executeSql($query,MappingWP_YVTWP::GET_VAR);

        if($response->status==1)
            $paged=$response->result;
        
        return $paged;
    }
    /*
     * 
     */
    public static function existTmpCommentsPaged($paged,$import_id)
    {
        self::init();
        
        $res=FALSE;
        $query="select count(paged) from ".self::$table_tmp_comments." where paged='{$paged}' and import_id='{$import_id}' "; 
        $response= MappingWP_YVTWP::executeSql($query,MappingWP_YVTWP::GET_VAR);

        if($response->status==1)
            if($response->result>0)
               $res=TRUE;
        
        return $res;
    }    
    /*
     * 
     */
    public static function getCountTmpImportedComment($import_id)
    {
        self::init();
        $count=0;

        $query="select count(id) from ".self::$table_tmp_comments." where import_id={$import_id} and is_imported='1' ";             
        $response= MappingWP_YVTWP::executeSql($query,MappingWP_YVTWP::GET_VAR);

        if($response->status==1)
            if($response->result)
                $count=$response->result;
            
        return $count;         
    }
    /*
     * 
     */
    public static function updateTmpComment($arg)
    {
        self::init();
        
        $where=array('id'=>$arg['tmp_comment_id']);
        $arg['updated_time']=date('Y-m-d H:i:s');
        unset($arg['tmp_comment_id']);    
        
        $response= MappingWP_YVTWP::updateData(self::$table_tmp_comments,$arg,$where);         
        
        return $response;        
    }
    /**
     * 
     */
    public static function clearCache($arg,$post_id=NULL)
    {
        self::init();      
        
        $response= MappingWP_YVTWP::deleteData(self::$table_tmp_comments,array('import_id'=>$arg['import_id']));    
        
        if($post_id)
        {
            delete_post_meta($post_id,'yvtwp_current_paged_comment');
            delete_post_meta($post_id,'yvtwp_next_page_token_comment');
        }

        return $response;           
    }   
    /**
     * 
     */
    public static function deleteDatas($arg)
    {
        self::init();      
        
        $result= Comment_YVTWP::getCommentIdsByImportId($arg['import_id']);
        foreach ($result as $key => $value) 
        {
            $res=  wp_delete_comment($value['comment_id'], TRUE);
            if($res===FALSE)
            {
                $messages="Error wp_delete_comment";
                MappingWP_YVTWP::logErrorsDB($messages); 
            }                
        }       

        return 1;           
    }    
    /*
     * 
     */
    public static function trancateTable()
    {
        self::init();
        
        $query="TRUNCATE TABLE ".self::$table_tmp_comments;
        $response= MappingWP_YVTWP::executeSql($query,  MappingWP_YVTWP::GET_RESULTS); 
        
        return $response;        
    }
      
}
?>