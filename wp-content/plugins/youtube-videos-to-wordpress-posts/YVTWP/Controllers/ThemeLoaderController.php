<?php
class ThemeLoader_YVTWP {
    
    public function themeLoaderIndexAction($arg)
    {
        $supported_themes=self::getSupportedThemes();     
        
        $theme_name = str_replace(' ','_', wp_get_theme());
        $theme_name=  strtolower($theme_name);
        
        require_once Config_YVTWP::$views_dir.'youtube/supported_themes.php';
    }
    /*
     * 
     */
    public function loadNewThemeAction($arg)
    {
        Config_YVTWP::loadDefaultSettings($arg['theme_slug']);
        return new Response_YVTWP(1,'Theme loaded successfuly');
    }
    /*
     * 
     */
    public static function getSupportedThemes()
    {
        $res=array();
        
        $filePath=Config_YVTWP::$supported_themes_url.'all_themes.json';
        
        $fileContents=FileSystem_YVTWP::getJsonFileContents($filePath);

        if($fileContents)
        {
            $res=json_decode($fileContents,TRUE);
            $res=$res['items'];
        }  else {
            _e('An error occurred while trying to load the theme JSON file', 'YVTWP-lang');
        }
        
        return $res;
    }
}
?>