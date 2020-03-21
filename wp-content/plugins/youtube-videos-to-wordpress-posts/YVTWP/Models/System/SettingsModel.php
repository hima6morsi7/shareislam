<?php
class SettingsModel_YVTWP {
    

    public static function setOption($option_key,$option_value,$serialize=NULL)
    {
        if(Config_YVTWP::$active_wp_user_filter=='yes')
            $option_key=$option_key.'_'.Config_YVTWP::$current_user_id;
        
        $res=self::getOption($option_key);
        if($res || empty($res))
            update_option($option_key,$option_value);
        else
            add_option($option_key, $option_value); 

        return TRUE;
    }
    /**
     * 
     */
    public static function getOption($option_key,$default_value=NULL,$unserialize=NULL)
    {
        if(Config_YVTWP::$active_wp_user_filter=='yes')
            $option_key=$option_key.'_'.Config_YVTWP::$current_user_id;

        $res=get_option($option_key);
        
        if(!$res && $default_value)
            $res=$default_value;
        
        return $res;
    }
    /*
     * 
     */
    public static function removeOption($option_key)
    {
        if(Config_YVTWP::$active_wp_user_filter=='yes')
            $option_key=$option_key.'_'.Config_YVTWP::$current_user_id;

        $res=delete_option($option_key);
        
        return $res;
    }
    public static function getGeneralSettings($arg=NULL)
    {
        $option_key='yvtwp_general_settings';
        if(Config_YVTWP::$active_wp_user_filter=='yes')
            $option_key=$option_key.'_'.Config_YVTWP::$current_user_id;        
        
        $generalSettings=self::getOption($option_key,Config_YVTWP::$general_settings);   
                
        return $generalSettings;
    }     

    
}
?>