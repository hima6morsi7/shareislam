<?php
class Shortcodes_YVTWP 
{
    
    public static function yvtwpVideoShortcode($atts=null,$content=NULL)
    {
        ob_start();
        
        parse_str( parse_url( $content, PHP_URL_QUERY ), $array_of_args );
        $video_key=$array_of_args['v'];

        $post_id=Post_YVTWP::getPost_idByPostMeta('yvtwp_video_key',$video_key);

        if($post_id)
        {
            $import_id=  get_post_meta($post_id,'yvtwp_import_id', true);            
            $option_name="yvtwp_import_settings_".$import_id;
            $import_settings=SettingsModel_YVTWP::getOption($option_name,'',TRUE);                
        }

        if($video_key){
        ?>
        <div class="yvtwp-video-wrapper" >
            <iframe src="https://www.youtube.com/embed/<?php echo $video_key ?>?feature=oembed" frameborder="0" allowfullscreen="" id="<?php echo 'yvtwp_'.$video_key ?>"></iframe>
        </div>
        <?php
        }
        else
            _e('Invalid Youtube URL', 'YVTWP-lang');
        
        $res=  ob_get_contents();
        ob_clean();
        
        return $res;
    }   
    /*
     * 
     */
    public static function yvtwpThemeDocShortcode($atts=null,$content=NULL)
    {
        $supported_themes=array();
        $is_website=FALSE;
         
        $filePath=Config_YVTWP::$supported_themes_url.'all_themes.json';
        $fileContents=FileSystem_YVTWP::getJsonFileContents($filePath);

        if($fileContents)
        {
            $supported_themes=  json_decode ($fileContents,TRUE);
            $supported_themes=$supported_themes['items'];
        }         
        
        $key=$atts['theme_slug'];
        $theme_infos=$supported_themes[$key];
        
        if(isset($atts['is_website']))
            $is_website=TRUE;
        
        
        ob_start();
        if(file_exists(Config_YVTWP::$doc_help_dir.$atts['theme_slug'].'.php'))
        {
            if($is_website)
                require_once Config_YVTWP::$doc_help_dir.'for_all/header_all.php';      
            
            require_once Config_YVTWP::$doc_help_dir.'for_all/title_details.php';  
            require_once Config_YVTWP::$doc_help_dir.$atts['theme_slug'].'.php';
            
            if($is_website)
                require_once Config_YVTWP::$doc_help_dir.'for_all/footer_all.php';
        }
        
        $res=  ob_get_contents();
        ob_clean();
        
        return $res;        
    }
}
?>