<?php
class LogModel_YVTWP {

    private static $table_log='';

    private static function init() {
        self::$table_log= Config_YVTWP::$yvtwp_prefixe.'log';        
    }    
    
    public static function insertLog($args)
    {
        self::init();
        
        $datas=array();
        $insert_time=date('Y-m-d H:i:s',time());
        
        $datas['import_id']=$args['import_id'];
        $datas['log_type']=$args['log_type'];
        $datas['response']=  json_encode($args['response']);
        $datas['date']=$insert_time;
        $datas['user_id']=  Config_YVTWP::$current_user_id_2;
        if(isset($args['additionnel_infos']))
            $datas['additionnel_infos']=json_encode($args['additionnel_infos']);
        
        $response=MappingWP_YVTWP::insertData(self::$table_log,$datas);

        return $response;           
    }
    /*
     * 
     */
    public static function clearLog($arg)
    {
        self::init();
        
        $query="TRUNCATE TABLE ".self::$table_log;
        $response= MappingWP_YVTWP::executeSql($query,  MappingWP_YVTWP::GET_RESULTS); 
        
        return $response;
    }
    /**
     * 
     */
    public static function clearImportLlog($arg)
    {
        self::init();      
        
        $response= MappingWP_YVTWP::deleteData(self::$table_log,array('import_id'=>$arg['import_id']));

        return $response;           
    }    
    /**
     * 
     */
    public static function deletelogByID($id)
    {
        self::init();      
        
        $response= MappingWP_YVTWP::deleteData(self::$table_log,array('id'=>$id));

        return $response;           
    }       
    /*
     * 
     */
    public static function getLogById($id)
    {
        self::init();     
        
        $query="select * from ".self::$table_log."  where id={$id} LIMIT 1";
        $response= MappingWP_YVTWP::executeSql($query,MappingWP_YVTWP::GET_RESULTS);
        
        return $response;
    }    
    /*
     * 
     */
    public static function getListOfLogs($arg)
    {
        self::init();
        
        $where="where 1";   
        $paged=0;        
        $paged_limit=Config_YVTWP::get('log_paged');;
                
        if(isset($arg['paged']))
            $paged=$arg['paged']-1;

        $next_offset = $paged * $paged_limit;
        
        //if applicated filter
        if(isset($arg['log_type']) && !empty($arg['log_type']))
            $where=$where." and log_type='{$arg['log_type']}'";
        else
            $where=$where." and log_type!='broken_videos' ";   
            
        if(isset($arg['import_id']) && !empty($arg['import_id']))
            $where=$where." and import_id='{$arg['import_id']}'";            
        
        $query="select * from ".self::$table_log." {$where} order by id desc LIMIT $paged_limit OFFSET $next_offset ";
        $response= MappingWP_YVTWP::executeSql($query,MappingWP_YVTWP::GET_RESULTS);
 
        return $response;           
    }
    /*
     * 
     */
    public static function getTotalResults($arg)
    {
        self::init();
        
        $where="where 1";                   
        $total_results=0;
        
        //if applicated filter
        if(isset($arg['log_type']) && !empty($arg['log_type']))
            $where=$where." and log_type='{$arg['log_type']}'";
        else
            $where=$where." and log_type!='broken_videos' ";            
            
        if(isset($arg['import_id']) && !empty($arg['import_id']))
            $where=$where." and import_id='{$arg['import_id']}'";
        
        $query="select count(*) from ".self::$table_log." {$where} ";
        $response= MappingWP_YVTWP::executeSql($query,MappingWP_YVTWP::GET_VAR);
        
        if($response->status==1)
            $total_results=$response->result;
 
        return $total_results;
    }
    /*
     */
    private static function getMessageLogForScheduledMsgImport($response)
    {
        $message=__('Scheduling import', 'YVTWP-lang')." : ";
        $separteur=" | ";
        $response=  json_decode($response);
        $result=(array)$response->result;
        $response_messages=$response->messages;
        
        if($response->status==1)
           $response_messages="<span style='color:#7ad03a;font-weight:bold'> {$response_messages} </span>";         
        else
            $response_messages="<span style='color:red'> {$response_messages} </span>";       
        
        
        return $response_messages;
    }    
    /*
     */
    private static function getMessageLogForScheduledVideosImport($response)
    {
        $message=__('Scheduling videos import', 'YVTWP-lang')." : ";
        $separteur=" | ";
        $response=  json_decode($response);
        $result=(array)$response->result;
        $response_messages=$response->messages;
        
        if($response->status==1)
        {
            if(isset($result['is_updated']) && $result['is_updated']=='yes')
                $response_messages="<span style='color:blue;font-weight:bold'> {$response_messages} </span>";
            else 
               $response_messages="<span style='color:#7ad03a;font-weight:bold'> {$response_messages} </span>";         
        }
        else
            $response_messages="<span style='color:red'> {$response_messages} </span>";       
        
        if(isset($result['video_key']))
        {
            $edit_link=get_edit_post_link($result['post_id']);

            $video_title="<a target='_blank' href='https://www.youtube.com/watch?v={$result['video_key']}'> {$result['video_title']} </a>";
            $link_view="<a target='_blank' href='{$result['view_link']}'>".__('View', 'YVTWP-lang')." </a>";
            $link_edit="<a target='_blank' href='{$edit_link}'>".__('Edit', 'YVTWP-lang')." </a>";

            $message=$message.$video_title.'<div style="float:right">'.$response_messages.$separteur.$link_view.$separteur.$link_edit.'</div>';
        }
        else
            $message=$response_messages;
        
        return $message;
    }
    /*
     */
    private static function getMessageLogForNormalVideosImport($response)
    {
        $message=__('Normal videos import', 'YVTWP-lang')." : ";
        $separteur=" | ";
        $response=  json_decode($response);
        $result=(array)$response->result;
        $response_messages=$response->messages;
        
        if($response->status==1)
        {
            if($result['is_updated']=='yes')
                $response_messages="<span style='color:blue;font-weight:bold'> {$response_messages} </span>";
            else 
               $response_messages="<span style='color:#7ad03a;font-weight:bold'> {$response_messages} </span>";         
        }
        else
            $response_messages="<span style='color:red'> {$response_messages} </span>";
        
       // var_dump($result);
        $edit_link=get_edit_post_link($result['post_id']);
        
        $video_title="<a target='_blank' href='https://www.youtube.com/watch?v={$result['video_key']}'> {$result['video_title']} </a>";
        $link_view="<a target='_blank' href='{$result['view_link']}'>".__('View', 'YVTWP-lang')." </a>";
        $link_edit="<a target='_blank' href='{$edit_link}'>".__('Edit', 'YVTWP-lang')." </a>";
        
        $message=$message.$video_title.'<div style="float:right">'.$response_messages.$separteur.$link_view.$separteur.$link_edit.'</div>';
        
        return $message;
    }    
    /*
     */
    private static function getMessageLogForDbErrors($response)
    {
        $message=__('DB Errors : ', 'YVTWP-lang');
        $response=  json_decode($response);
        $response_messages=$message."<span style='color:red;font-weight:bold'> {$response->messages} </span>";
        
        return $response_messages;
    } 
    /*
     */
    private static function getMessageLogForYoutubeApiErrors($response)
    {
        $message=__('Youtube API Errors : ', 'YVTWP-lang');
        $response=  json_decode($response);
        $response_messages=$message."<span style='color:red;font-weight:bold'> {$response->messages} </span>";
        
        return $response_messages;
    }   
    private static function getMessageLogForCommentsImport($response)
    {
        $message=__('', 'YVTWP-lang')." : ";
        $separteur=" | ";
        $response=  json_decode($response);
        $result=(array)$response->result;
        $response_messages=$response->messages;
        
        if($response->status==1)
        {
            if(isset($result['is_updated']) && $result['is_updated']=='yes')
                $response_messages="<span style='color:blue;font-weight:bold'> {$response_messages} </span>";
            else 
               $response_messages="<span style='color:#7ad03a;font-weight:bold'> {$response_messages} </span>";         
        }
        else
            $response_messages="<span style='color:red'> {$response_messages} </span>";
        
        $comment_title=  get_comment_excerpt($result['comment_id']);
        $link_view="<a target='_blank' href='".get_comment_link($result['comment_id'])."'>".__('View', 'YVTWP-lang')." </a>";
        $link_edit="<a target='_blank' href='".get_edit_comment_link($result['comment_id'])."'>".__('Edit', 'YVTWP-lang')." </a>";
        $the_attached_post="<a target='_blank' href='".get_the_permalink($result['post_id'])."'>".__('Attached post', 'YVTWP-lang')." </a>";
        
        $message=$message.$comment_title.'<div style="float:right">'.$response_messages.$separteur.$link_view.$separteur.$link_edit.$separteur.$the_attached_post.'</div>';
        
        return $message;
    }     
    /*
     * 
     */
    private static function getMessageLogForBrokenVideos($response)
    {
        $response=  json_decode($response);
        $result=(array)$response->result;

        return $result['messages'];
    }   
    /*
     * 
     */
    private static function getMessageLogSimple($response)
    {
        $response=  json_decode($response);
        $result=(array)$response->result;

        if($response->status==1)
        {
               $response_messages="<span style='color:#7ad03a;font-weight:bold'> {$response->messages} </span>";         
        }
        else
            $response_messages="<span style='color:red'> {$response->messages} </span>";
        
        
        $video_title="<a target='_blank' href='https://www.youtube.com/watch?v={$result['video_key']}'> {$result['video_title']} </a>";

        
        $message=$video_title.'<div style="float:right">'.$response_messages.'</div>';
        
        return $message;        
        
    }      
    /*
     */
    public static function getMessageLogFromResponse($log)
    {
        $message="";
        
        switch ($log['log_type']) {
            case 'scheduling_msg_import':
                $message=self::getMessageLogForScheduledMsgImport($log['response']);
                break;             
            case 'scheduling_videos_import':
                $message=self::getMessageLogForScheduledVideosImport($log['response']);
                break;
            case 'normal_videos_import':
                $message=self::getMessageLogForNormalVideosImport($log['response']);
                break;            
            case 'db_errors':
                $message=self::getMessageLogForDbErrors($log['response']);
                break;            
            case 'youtube_api_errors':
                $message=self::getMessageLogForYoutubeApiErrors($log['response']);
                break; 
            case 'comments':
                $message=self::getMessageLogForCommentsImport($log['response']);
                break;
            case 'broken_videos':
                $message=self::getMessageLogForBrokenVideos($log['response']);
                break;     
            case 'simple_log':
                $message=self::getMessageLogSimple($log['response']);
                break;                 
            default:
                break;
        }
        
        return $message;
    }

}
?>