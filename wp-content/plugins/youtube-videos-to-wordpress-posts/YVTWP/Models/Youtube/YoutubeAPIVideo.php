<?php
class YoutubeAPIVideo_YVTWP
{    
    public $searchResponse;
    public $argFeed;
    
    public function updateImportInfos()
    {
        $searchResponse_YVTWP=  $this->searchResponse;
        $arg=  $this->argFeed;
        
        if(isset($arg['pageToken']) && !empty($arg['pageToken']) && isset($searchResponse_YVTWP['nextPageToken']))
            $infosImport['current_paged']=$arg['paged']+1;

        if(isset($searchResponse_YVTWP['prevPageToken']))
            $infosImport['prev_page_token']=$searchResponse_YVTWP['prevPageToken'];
        else
            $infosImport['prev_page_token']='';

        if(isset($searchResponse_YVTWP['nextPageToken']))
            $infosImport['next_page_token']=$searchResponse_YVTWP['nextPageToken'];
        else
            $infosImport['next_page_token']='';

        $infosImport['total_results']=$searchResponse_YVTWP['pageInfo']['totalResults'];
        $infosImport['etag']=$searchResponse_YVTWP['etag'];
        $infosImport['import_id']=$arg['import_id'];

        $response= ImportModel_YVTWP::updateImportInfos($infosImport);        
    }

    public function getVideoIdFromSearchResult($feed_type,$searchResult)
    {
        $videoId=FALSE;
        switch ($feed_type) {
            case 'feed_playlist':
                $videoId=$searchResult['snippet']['resourceId']['videoId'];
                break;
            case 'feed_channel':
                //$videoId=$searchResult['id']['videoId'];
                $videoId=$searchResult['snippet']['resourceId']['videoId'];
                break; 
            case 'feed_user':
                $videoId=$searchResult['snippet']['resourceId']['videoId'];
                break;              
            case 'feed_search_query':
                $videoId=$searchResult['id']['videoId'];
                break;
            case 'feed_single_video':
                $videoId=$searchResult['id'];
                break;                
            default:
                break;
        }
        
        return $videoId;
    }
    /*
     */
    public function existFeedKey($import_settings)
    {
        $import_settings['max_page_results']=1;
        $arg=array();
        
        $response=  YoutubeAPI_YVTWP::getSearchResponse_YVTWP($arg,$import_settings);        


        return $response;
    }    
    /*
     */
    public function getFeedsForSingleVideo($arg,$import_settings=NULL)
    {
        $response=new Response_YVTWP(1,'');
        $arrayFeedJson=array();$infosImport=array();
        
        if(!$import_settings)
            $import_settings=SettingsModel_YVTWP::getOption('yvtwp_import_settings_'.$arg['import_id'],'',TRUE);
        
        if(!TmpVideosModel_YVTWP::existImportFeed($arg['import_id'],''))
        {
            $infosImport=array('current_paged'=>'1','prev_page_token'=>'1','next_page_token'=>'','total_results'=>'1','etag'=>'','import_id'=>$arg['import_id']);
            $response=ImportModel_YVTWP::updateImportInfos($infosImport);   

            if($response->status==1)
            {
                $miniUrl='videos';
                $options=array('part' => 'snippet,statistics,contentDetails,status','id'=>$arg['feed_key'],'maxResults' => 1 );                    
                $response=  YoutubeAPI_YVTWP::getYoutubeAPIResponse($miniUrl, $options);

                if($response->status==1)
                {                                        
                    $searchResponse_YVTWP=$response->result ;                    

                    foreach ($searchResponse_YVTWP['items'] as $searchResult) 
                    {
                        $tmp_videos_datas=array('import_id'=>$arg['import_id'],'video_key'=>$searchResult['id'],'video_datas'=>json_encode($searchResult),'paged'=>1,'pageToken'=>'');
                        $response=TmpVideosModel_YVTWP::insertVideosFeed($tmp_videos_datas); 
                    }        
                }                    
            } 
        }
            
        if($response->status==1)
        {
            //get temporaire feed
            $arg['import_settings']=$import_settings;
            $response=TmpVideosModel_YVTWP::getVideosFeed($arg); 
        }
        
        return $response;
    }    
    /*
     */
    public function getFeedsForSynchroniseVideo($arg,$import_settings=NULL)
    {
        $response=new Response_YVTWP(1,'',null);
        
        $miniUrl = 'videos';
        $options = array('part' => 'snippet,statistics,contentDetails,status','id'=>$arg['feed_key'],'maxResults' => 1 );                    
        $response =  YoutubeAPI_YVTWP::getYoutubeAPIResponse($miniUrl, $options);

        if($response->status==1) {                                        
            $searchResponse_YVTWP = $response->result ;                    

            foreach ($searchResponse_YVTWP['items'] as $searchResult) {
                TmpVideosModel_YVTWP::deleteByVideoKeyAndImportId($arg['import_id'], $searchResult['id']);
                
                $tmp_videos_datas = array('import_id'=>$arg['import_id'],'video_key'=>$searchResult['id'],'video_datas'=>json_encode($searchResult),'paged'=>1,'pageToken'=>'');
                $response->result = TmpVideosModel_YVTWP::insertVideosFeed($tmp_videos_datas)->result; 
            }        
        }                    
       
        return $response;
    }   
    /**
     * 
     */
    public function getFeeds($arg)
    {
        $response=new Response_YVTWP(1,'');
        $arrayFeedJson=array();$infosImport=array();
        
        $import_settings=SettingsModel_YVTWP::getOption('yvtwp_import_settings_'.$arg['import_id'],'',TRUE);
        if(!isset($arg['pageToken']))
            $arg['pageToken']='';
        
        
        if(!TmpVideosModel_YVTWP::existImportFeed($arg['import_id'],$arg['pageToken']))
        {
            $response= YoutubeAPI_YVTWP::getSearchResponse_YVTWP($arg,$import_settings);

            if($response->status==1)
            {
                $searchResponse_YVTWP = $response->result;   

                $this->searchResponse=$searchResponse_YVTWP;
                $this->argFeed=$arg;
                
                $this->updateImportInfos();

                if($response->status==1)
                {
                    $videoResults=array();
                    foreach ($searchResponse_YVTWP['items'] as $searchResult) 
                    {
                        if($this->getVideoIdFromSearchResult($import_settings['feed_type'],$searchResult))
                            array_push($videoResults,$this->getVideoIdFromSearchResult($import_settings['feed_type'],$searchResult));
                    }      

                    $videoIds = join(',', $videoResults);

                    $miniUrl='videos';
                    $options=array('part' => 'snippet,statistics,contentDetails,status','id'=>$videoIds);

                    $response=  YoutubeAPI_YVTWP::getYoutubeAPIResponse($miniUrl, $options);
                    if($response->status==1)
                    {
                        $searchResponse_YVTWP=$response->result ;

                        foreach ($searchResponse_YVTWP['items'] as $searchResult) 
                        {                                
                            if(!isset($arg['pageToken']))
                                $arg['pageToken']='';

                            $tmp_videos_datas=array('import_id'=>$arg['import_id'],'video_key'=>$searchResult['id'],'video_datas'=>json_encode($searchResult),'paged'=>$arg['paged'],'pageToken'=>$arg['pageToken']);
                            TmpVideosModel_YVTWP::insertVideosFeed($tmp_videos_datas);              
                        }                         
                    }
                }                 
            }
            $GLOBALS['import_exist']=FALSE;    
        }
        else
            $GLOBALS['import_exist']=TRUE;
        
        if($response->status==1)
        {
            //get temporaire feed
            $arg['import_settings']=$import_settings;
            $response=TmpVideosModel_YVTWP::getVideosFeed($arg);            
        }

        return $response;
    }
    /*
     */
    public function getFeedsTotalResults($import_id)
    {
        $total_results=0;       
        $import_settings=SettingsModel_YVTWP::getOption('yvtwp_import_settings_'.$import_id,'',TRUE);
        $import_settings['force_page_results']=1;
        $import_settings['import_type']='paginate_import';
        
        $arg=array();
        
        $response=YoutubeAPI_YVTWP::getSearchResponse_YVTWP($arg,$import_settings);
        if($response->status==1)
        {
            $searchResponse_YVTWP = $response->result;
            $total_results=$searchResponse_YVTWP['pageInfo']['totalResults'];
        }

        return $total_results;
    }    
    
}//class
?>