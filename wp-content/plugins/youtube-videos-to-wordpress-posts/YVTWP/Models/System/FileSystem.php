<?php

class FileSystem_YVTWP {
    
    public static function getJsonFileContents($filePath)
    {
        $res= false;
        $creds = request_filesystem_credentials(site_url() . '/wp-admin/', '', false, false, array());

        /* initialize the API */
        if ( ! WP_Filesystem($creds) ) {
            echo 'WP_Filesystem can\'t be initialised <br/>';
        }	
        
        if(defined('FS_CHMOD_FILE'))
        {
            global $wp_filesystem;               
            $res= $wp_filesystem->get_contents($filePath,FS_CHMOD_FILE);
        }
        
        if(!$res)
            $res=file_get_contents($filePath);
        
        return $res;
    }
    
}
?>