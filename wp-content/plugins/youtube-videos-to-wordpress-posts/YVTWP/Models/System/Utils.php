<?php
class Utils_YVTWP {

    public static function getEmbedTemplateFieldsArray($template_fields)
    {
        $sep=',';
        $embed_template_fields=array(''=>'');
        
        if($template_fields)
        {
            if (strpos($template_fields,'sep_yvtwp') !== false) {
                $sep='sep_yvtwp';
            }            
            
            $embed_template_fields=explode($sep,$template_fields);
        }
        
        return $embed_template_fields;
    }
    /*
     * 
     */
    public static function formatNumber($n) {
        return number_format($n);
    }
    /*
     * 
     */
    public static function get_http_response_code($url) {
        $headers = get_headers($url);
        return substr($headers[0], 9, 3);
    }  
    
}