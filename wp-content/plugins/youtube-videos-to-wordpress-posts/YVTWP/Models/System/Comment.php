<?php

class Comment_YVTWP {
    
    private static $table_comments='';
    private static $table_commentmeta='';

    private static function init() {
        self::$table_comments=Config_YVTWP::$wpdb_prefixe.'comments';
        self::$table_commentmeta=Config_YVTWP::$wpdb_prefixe.'commentmeta';
    }    
    /**
     * 
     */
    public static function existCommentMeta($meta_key,$meta_value)
    {
        self::init();
        
        $res=TRUE;
        
        $query="select count(meta_key) from ".self::$table_commentmeta." where meta_key='{$meta_key}' and meta_value='{$meta_value}' ";
        $response=  MappingWP_YVTWP::executeSql($query,  MappingWP_YVTWP::GET_VAR);
        
        if($response->status==1)
        {
            $result=$response->result;
            if($result==0)
                $res=FALSE;
        }
        
        return $res;         
    }
    public static function getComment_idByCommentMeta($meta_key,$meta_value)
    {
        self::init();
        
        $query="select comment_id from ".self::$table_commentmeta." where meta_key='{$meta_key}' and meta_value='{$meta_value}' ";
        $response=MappingWP_YVTWP::executeSql($query,MappingWP_YVTWP::GET_VAR);    
        
        return $response->result;
    }
    /*
     * 
     */
    public static function getCommentsCountByImportId($import_id)
    {        
        self::init();
        
        $result=0;
        
        $query="select count(*) from ".self::$table_commentmeta." where meta_key='yvtwp_import_id' and meta_value='{$import_id}' ";
        $response= MappingWP_YVTWP::executeSql($query,MappingWP_YVTWP::GET_VAR);
        
        if($response->status==1)
            $result=(int)$response->result;
        
        return $result;          
    }   
    /*
     * 
     */
    public static function getCommentsCountByVideoKey($video_key)
    {        
        self::init();
        
        $result=0;
        
        $query="select count(*) from ".self::$table_commentmeta." where meta_key='yvtwp_video_key' and meta_value='{$video_key}' ";
        $response= MappingWP_YVTWP::executeSql($query,MappingWP_YVTWP::GET_VAR);
        
        if($response->status==1)
            $result=(int)$response->result;
        
        return $result;          
    }       
    /*
     * 
     */
    public static function getParentsCommentsCountByImportId($import_id)
    {
        self::init();
        
        $result=0;
        $import_id=$import_id.'yes';
        
        $query="select count(comment_id) from ".self::$table_commentmeta." where meta_key='yvtwp_is_parent' and meta_value='{$import_id}' ";
        $response= MappingWP_YVTWP::executeSql($query,MappingWP_YVTWP::GET_VAR);
        
        if($response->status==1)
            $result=(int)$response->result;
        
        return $result;       
    }     
    /*
     *
     */
    public static function getCommentIdsByImportId($import_id)
    {
        self::init();
        
        $result=array();
        
        $query="select comment_id from ".self::commentmeta." where meta_key='yvtwp_import_id' and meta_value='{$import_id}' ";
        $response=  MappingWP_YVTWP::executeSql($query, MappingWP_YVTWP::GET_RESULTS);
        
        if($response->status==1)
            $result=$response->result;
        
        return $result;         
    }    

}
?>