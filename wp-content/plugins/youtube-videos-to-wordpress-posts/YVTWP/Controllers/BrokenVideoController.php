<?php

class BrokenVideoController_YVTWP {

    public function brokenVideoIndexAction($arg)
    {
        $listOfLogs=array();$default_paged=Config_YVTWP::get('log_paged');
        $total_videos_to_check=Post_YVTWP::getPostsCountByMetaKey('yvtwp_video_key');
        $last_post_checked_id=SettingsModel_YVTWP::getOption('yvtwp_last_broken_post_checked_id',1);
       
        
        $countVideosChecked=Post_YVTWP::getCountBrokenVideosChecked($last_post_checked_id);
    
        $arg['log_type']="broken_videos";
        $total_results=  LogModel_YVTWP::getTotalResults($arg);
   
                
        if(LogModel_YVTWP::getListOfLogs($arg)->status==1)
            $listOfLogs=  LogModel_YVTWP::getListOfLogs($arg)->result;
        
        require_once Config_YVTWP::$views_dir.'youtube/broken_video_checker.php';
    }
    /*
     * 
     */
    public function clearLogAction($arg)
    {
        return LogModel_YVTWP::clearLog($arg);
    }
    /*
     * 
     */
    public function brokenVideoCheckerAction($arg)
    {
        $response=new Response_YVTWP(1,__('Finished checking broken videos', 'YVTWP-lang'),array('check_status'=>'end'));
        
        $last_post_checked_id=SettingsModel_YVTWP::getOption('yvtwp_last_broken_post_checked_id',1);
        $post_id=Post_YVTWP::getNextBrokenPostIdToCheck($last_post_checked_id);
        
        if($post_id)
        {
            SettingsModel_YVTWP::setOption('yvtwp_last_broken_post_checked_id',$post_id);
            
            $BrokenVideo= new BrokenVideo_YVTWP($post_id);
            $response=$BrokenVideo->executeCheck();       
        }
        $response->result['checkedVideosCount']=Post_YVTWP::getCountBrokenVideosChecked($last_post_checked_id);
        
        return $response;

    } 
    /*
     * 
     */
    public function initCheckAction($arg)
    {
        $response=new Response_YVTWP(1);
        
        SettingsModel_YVTWP::setOption('yvtwp_last_broken_post_checked_id','1');
        LogModel_YVTWP::clearLog($arg);
        
        return $response;
        
    }
    /*
     * 
     */
    public function deleteCheckedAction($arg)
    {
        $response=new Response_YVTWP(1);
        
        $log_id=$arg['log_id'];
        
        $response=LogModel_YVTWP::getLogById($log_id);
        if($response->status==1 && is_array($response->result))
        {
            $result=$response->result[0];
            $additionnel_infos=json_decode($result['additionnel_infos'],ARRAY_A);

            $post_id=$additionnel_infos['post_id'];
            $video_key=$additionnel_infos['video_key'];
            
            $import_id=ImportModel_YVTWP::getImportIdByVideoKey($video_key);
            
            if($import_id)
            {
                $arg=array('post_id'=>$post_id,'import_id'=>$import_id);
                $importController=new ImportController_YVTWP();
                $resu=$importController->deleteAction($arg);
                
            }
            else 
            {
                Post_YVTWP::deletePostAttachements($post_id);
                
                $res=wp_delete_post($post_id, TRUE);
                if($res===FALSE)
                {
                    $messages="Error wp_delete_post";
                    MappingWP_YVTWP::logErrorsDB($messages); 
                }          
            }
            
        }
        
        LogModel_YVTWP::deletelogByID($log_id);
        
        return $response;  
    }
    
}
?>