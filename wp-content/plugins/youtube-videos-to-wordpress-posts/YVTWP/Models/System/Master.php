<?php
class Master_YVTWP {
    
    private static function getController($name) 
    {
        $objectController=new ImportController_YVTWP();
        switch ($name) 
        {
            case 'import':
                $objectController=new ImportController_YVTWP();
                break;
            case 'settings':
                $objectController=new SettingsController_YVTWP();
                break;    
            case 'utils':
                $objectController=new UtilsController_YVTWP();
                break;     
             case 'log':
                $objectController=new LogController_YVTWP();  
                 break; 
            case 'brokenVideo':
                $objectController=new BrokenVideoController_YVTWP();
                break;
            case 'themeLoader':
                $objectController=new ThemeLoader_YVTWP();
                break;            
        }
        
        return $objectController;        
    }//End function
    
    /**
     * 
     */
    public static function executeControllerAction($arg) 
    {               
        $controllerName=Config_YVTWP::$default_controller;
        $controllerAction=Config_YVTWP::$default_action;

        if(isset($arg['yvtwp_controller']))
            $controllerName=$arg['yvtwp_controller'];            
        
        if(isset($arg['yvtwp_action']))
            $controllerAction=$arg['yvtwp_action'];   
        
        $controllerObject=  self::getController($controllerName);
        $array=array('li'=>$arg);  
        $retour=call_user_func_array(array($controllerObject,$controllerAction.'Action'),$array);

        if(is_null($retour))
            $retour=new Response_YVTWP(0,__('Unknow error, see error_log for more details', 'YVTWP-lang'),NULL);

        return $retour;
        
    }//End function
    
}//End class
?>