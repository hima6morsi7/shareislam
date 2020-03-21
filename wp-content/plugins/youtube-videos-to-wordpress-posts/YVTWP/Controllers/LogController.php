<?php

class LogController_YVTWP {

    public function logAction($arg)
    {
        $listOfLogs=array();$default_paged=Config_YVTWP::get('log_paged');
    
        $total_results=  LogModel_YVTWP::getTotalResults($arg);
        /*$datas['feed_type']='feed_channel';
        $total_results_channel=ImportModel_YVTWP::getTotalResults($datas);*/
   
                
        if(LogModel_YVTWP::getListOfLogs($arg)->status==1)
            $listOfLogs=  LogModel_YVTWP::getListOfLogs($arg)->result;
        
        require_once Config_YVTWP::$views_dir.'youtube/log.php';
    }
    /*
     * 
     */
    public function clearLogAction($arg)
    {
        return LogModel_YVTWP::clearLog($arg);
    }
    
}
?>