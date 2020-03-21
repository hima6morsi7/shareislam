<?php
class MappingWP_YVTWP {
    
    const GET_RESULTS='get_results';
    const INSERT='insert';
    const GET_VAR='get_var';
    const UPDATE='update';
    const DELETE='delete';

    private static $tablename1='';
    private static $tablename2='';

    private static function init() {
        self::$tablename1=Config_YVTWP::$wpdb_prefixe.'posts';
        self::$tablename2=Config_YVTWP::$wpdb_prefixe.'postmeta';
    }
    public static function logErrorsDB($messages)
    {
        if(!empty($messages))
        {
            $generalSettings=SettingsModel_YVTWP::getGeneralSettings();
            if($generalSettings['active_error_logging']=='yes')                
            {
                $error_message="";
                $callers=debug_backtrace();
                $facontion_name=$callers[1]['function'];
                
                if(isset($_REQUEST['yvtwp_controller']))
                    $error_message=$error_message.'Controller : '.$_REQUEST['yvtwp_controller'];
                if(isset($_REQUEST['yvtwp_action']))
                    $error_message=$error_message.' | Action : '.$_REQUEST['yvtwp_action'];
                    
                    
                $error_message=$error_message.' | fonction : '.$facontion_name.' | Error Message : '.$messages;

                $response=new Response_YVTWP(0,$error_message);
                $dataLog['import_id']='';
                $dataLog['log_type']='db_errors';
                $dataLog['response']=$response;
                LogModel_YVTWP::insertLog($dataLog);                
            }
        }        
    }
    /*
     */
    public static function insertData($tablename,$data,$additional_params=NULL,$format=NULL) 
    {
        global $wpdb;
        
        $response = new Response_YVTWP(1);
        
        $result=$wpdb->insert($tablename, $data, $format);
        if($result===FALSE)
        {
            $response->status=0;
            $response->messages=$wpdb->last_error;
            //log erreur
            self::logErrorsDB($response->messages);
        } 
        else
        {
            $response->result=$wpdb->insert_id;
        }
        
        return $response;
    }
    /*
     */
    public static function updateData($tablename,$data,$where,$additional_params=NULL,$format=NULL) 
    {
        global $wpdb;
        
        $response = new Response_YVTWP(1);
        
        $result=$wpdb->update($tablename, $data, $where, $format = null);
        if($result===FALSE)
        {
            $response->status=0;
            $response->messages=$wpdb->last_error;
            //log erreur
            self::logErrorsDB($response->messages);
        } 
        else
        {
            //number of rows updated
            $response->result=$result;
        }
        
        return $response;
    }   
    /*
     */
    public static function deleteData($tablename,$where,$additional_params=NULL) 
    {
        global $wpdb;
        
        $response = new Response_YVTWP(1);
        
        $result=$wpdb->delete($tablename, $where);
        if($result===FALSE)
        {
            $response->status=0;
            $response->messages=$wpdb->last_error;
            //log erreur
            self::logErrorsDB($response->messages);
        } 
        else
        {
            //number of rows deleted
            $response->result=$result;
        }
        
        return $response;
    }      
    /**
     * 
     */
    public static function executeSql($query,$query_type,$output_type=NULL)
    {
        global $wpdb;
        
        $response = new Response_YVTWP(1);
        
        switch ($query_type) {
            case "get_results":
                $result=$wpdb->get_results($query,ARRAY_A); 
                if(is_null($result))
                {
                    $status=0;
                    $messages=$wpdb->last_error;
                    $result=array();
                }                
                break;            
            case "get_var":
                $result=$wpdb->get_var($query);   
                if(is_null($result))
                {
                    $status=0;
                    $messages=$wpdb->last_error;
                    $result='';
                }                
                break;
            case "insert":
                $result=$wpdb->query($query);
                if($result===FALSE)
                {
                    $status=0;
                    $messages=$wpdb->last_error;
                    $result=NULL;           
                }  
                else
                {
                    $result=$wpdb->insert_id;                    
                }                     
                break; 
            case "update":
                $result=$wpdb->query($query);
                if($result===FALSE)
                {
                    $status=0;
                    $messages=$wpdb->last_error;
                    $result=NULL;                    
                }                  
                break;
            case "delete":
                $result=$wpdb->query($query);
                if($result===FALSE)
                {
                    $status=0;
                    $messages=$wpdb->last_error;
                    $result=NULL;                    
                }                  
                break;                
        }
       
        if(!empty($messages))
        {
            self::logErrorsDB($messages);
        }
        
        if(isset($status))
            $response->status=$status;
                
        if(isset($messages))
            $response->messages=$messages;
        
        if(isset($result))
            $response->result=$result;
            
        return $response;
    }
    public static function esc_sql($value)
    {
        return esc_sql($value);
    }
}
?>