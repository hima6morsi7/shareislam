<?php
class YoutubeAPI_YVTWP
{
    public function __construct(){}
    /*
     * 
     */
    public static function setGlobalOptions($arg,$import_settings,$options)
    {
        $default_youtube_args=array('order','regionCode','relevanceLanguage','safeSearch','topicId','videoCaption','videoCaption','videoDefinition','videoDimension','videoDuration','videoEmbeddable','videoLicense','videoSyndicated','videoType');       
        $options['type']='video';
        
        foreach ($default_youtube_args as $key_arg) 
        {
            if(!empty($import_settings[$key_arg]))
                $options[$key_arg]=$import_settings[$key_arg];
        }
        
        if(!empty($import_settings['published_after']))
            $options['publishedAfter']=date('Y-m-d\TH:i:s.000\Z', strtotime($import_settings['published_after']));   

        if(!empty($import_settings['published_before']))
            $options['publishedBefore']=date('Y-m-d\TH:i:s.000\Z', strtotime($import_settings['published_before']));   

        if(isset($arg['pageToken']))
            if(!empty($arg['pageToken']))
                $options['pageToken']=$arg['pageToken'];     
        
        return $options;
    }
    /*
     * 
     */
    public static function getSearchResponse_YVTWP($arg,$import_settings)
    {        
        $max_results=Config_YVTWP::get('paginate_paged');
        switch ($import_settings['import_type']) {
            case 'bulk_import':
                $max_results=Config_YVTWP::get('bulk_paged');
                break;
            case 'scheduled_import':
                $max_results=Config_YVTWP::get('schedule_paged');
                break;            
        }
        if(isset($import_settings['force_page_results']))
            $max_results=$import_settings['force_page_results'];
        
        if(!isset($default_settings['import_type']) && isset($default_settings['import_without_pagination']))
        {
            //old version
            if($import_settings['import_without_pagination']=='yes')
                $import_settings['import_type']='bulk_import';
            else    
                $import_settings['import_type']='paginate_import';         
        }        
     
        switch ($import_settings['feed_type']) {
            case 'feed_user':
                $miniUrl='channels';
                $options=array('part' => 'contentDetails','maxResults' => $max_results,'forUsername' => $import_settings['feed_key']);
                $response= self::getYoutubeAPIResponse($miniUrl, $options);

                if($response->status==1)
                {
                    $result=$response->result;
                    if(isset($result['items'][0]['contentDetails']['relatedPlaylists']['uploads']))
                    {
                        $playlistId=$result['items'][0]['contentDetails']['relatedPlaylists']['uploads'];

                        $miniUrl='playlistItems';
                        $options=array('part' => 'id,snippet','maxResults' => $max_results,'playlistId' => $playlistId);
                        $options=self::setGlobalOptions($arg, $import_settings, $options);

                        $response= self::getYoutubeAPIResponse($miniUrl, $options);                            
                    }
                }                    
                break; 
            case 'feed_channel':
                /*$miniUrl='search';
                $options=array('part' => 'id','maxResults' => $max_results,'channelId' => $import_settings['feed_key']);
                $options=self::setGlobalOptions($arg, $import_settings, $options);                    
                $response= self::getYoutubeAPIResponse($miniUrl, $options);*/

                $miniUrl='channels';
                $options=array('part' => 'contentDetails','maxResults' => $max_results,'id' => $import_settings['feed_key']);
                $response= self::getYoutubeAPIResponse($miniUrl, $options);

                if($response->status==1)
                {
                    $result=$response->result;
                    if(isset($result['items'][0]['contentDetails']['relatedPlaylists']['uploads']))
                    {
                        $playlistId=$result['items'][0]['contentDetails']['relatedPlaylists']['uploads'];

                        $miniUrl='playlistItems';
                        $options=array('part' => 'id,snippet','maxResults' => $max_results,'playlistId' => $playlistId);
                        $options=self::setGlobalOptions($arg, $import_settings, $options);

                        $response= self::getYoutubeAPIResponse($miniUrl, $options);                            
                    }
                }                     
                break;
            case 'feed_playlist':
                $miniUrl='playlistItems';
                $options=array('part' => 'id,snippet','maxResults' => $max_results,'playlistId' => $import_settings['feed_key']);
                $options=self::setGlobalOptions($arg, $import_settings, $options);

                $response= self::getYoutubeAPIResponse($miniUrl, $options);
                break;
            case 'feed_search_query':
                $miniUrl='search';
                $feed_key=  str_replace(' ','+', $import_settings['feed_key']);
                $options=array('part' => 'id,snippet','maxResults' => $max_results,'q' => $feed_key );                    
                $options=self::setGlobalOptions($arg, $import_settings, $options);

                $response= self::getYoutubeAPIResponse($miniUrl, $options);   
                break; 
            case 'feed_single_video':
                $miniUrl='videos';
                $options=array('part' => 'snippet','id'=>$import_settings['feed_key'],'maxResults' => 1 );                    
                $response=self::getYoutubeAPIResponse($miniUrl, $options);
                if($response->status==0)
                    $response->messages=__('Invalid video key', 'YVTWP-lang');
                break;                        
            default:
                break;                              
        }

        return $response;
    }
    //------------------------------------------------------------
    public static function getGoogleFeedUrl($miniUrl,$options)
    {
        $url='https://www.googleapis.com/youtube/v3/'.$miniUrl.'?';
        
        foreach ($options as $key => $value) 
        {
            $url=$url.$key.'='.$value.'&';
        }
        
        $url=$url.'key='.SettingsModel_YVTWP::getOption('yvtwp_developer_key');
        
        return $url;
    }
    //----------------------------------------------------------------------
    public static function getYoutubeAPIResponse($miniUrl,$options)
    {
        $response= new Response_YVTWP(1,'');
        $url=  self::getGoogleFeedUrl($miniUrl, $options);
        
        if(!extension_loaded('openssl'))
        {
            $response->status=0;
            $response->messages=__("Youtube Videos to Wordpress Posts requires the PHP OpenSSL extension . Make sure it's installed.", 'YVTWP-lang');
        }
        else
        {
            $result  = wp_remote_get($url);
            
            if($result && wp_remote_retrieve_body($result))
            {
                $result = wp_remote_retrieve_body($result); 
                
                $result= json_decode($result,TRUE); 
                if($result)
                {
                    if(isset($result['error']['errors'][0])){
                        $response->status=0;
                        $errorArray=$result['error']['errors'][0];

                        $response->messages=self::apiCorrespondenceErrorMsg($errorArray);
                    }
                    else
                    {
                        if($result['pageInfo']['totalResults']==0)
                        {
                            $response->status=0;
                            $response->messages=__('No result', 'YVTWP-lang');
                        }
                        else
                        {
                            $response->status=1;
                            $response->result=$result;
                        }
                    }
                }
                else 
                {
                    $response->status=0;
                    $response->messages=__("Invalid Youtube API response", 'YVTWP-lang');  
                }
            }
            else
            {
                $response->status=0;
                if(is_wp_error($result))
                    $response->messages=$result->get_error_message();
                else
                    $response->messages=__("Cannot read from Youtube API, `wp_remote_get` error", 'YVTWP-lang');
            }
        }
        
        return $response;        
    }
    /*
     * 
     */
    public static function apiCorrespondenceErrorMsg($errorArray)
    {
        $messages='';
        $messages_log='';
        
        if(is_array($errorArray))
        { 
            $generalSettings=SettingsModel_YVTWP::getGeneralSettings();
            if($generalSettings['active_youtube_api_details_errors']=='yes')
            {
                foreach ($errorArray as $key => $value)
                {
                    $messages=$messages.'<p>'.$key.' => '.$value.'</p>';
                    $messages_log=$messages_log.' | '.$key.' => '.$value;
                }
                
                //add to error log
                $response=new Response_YVTWP(0,$messages_log);
                $dataLog['import_id']='';
                $dataLog['log_type']='youtube_api_errors';
                $dataLog['response']=$response;
                LogModel_YVTWP::insertLog($dataLog);                 
            }
            else
                $messages=$errorArray['message'].' : '.$errorArray['reason'];
        }
        
        return $messages;
    }
    

}//class
?>