<?php
class YoutubeAPIComment_YVTWP
{
    public  $searchResponse;
    public  $argFeed;

    public function __construct() {

    }

    public function updateTmpVideoInfos($post_id=NULL)
    {
        $searchResponse_YVTWP=  $this->searchResponse;
        $arg=  $this->argFeed;
        $commentInfos=array();
        $nextPageToken=NULL;
        
        $commentInfos['current_paged_comment']=$arg['paged']+1;

        if(isset($searchResponse_YVTWP['prevPageToken']))
            $commentInfos['prev_page_token_comment']=$searchResponse_YVTWP['prevPageToken'];
        else
            $commentInfos['prev_page_token_comment']='';

        if(isset($searchResponse_YVTWP['nextPageToken']))
        {
            $commentInfos['next_page_token_comment']=$searchResponse_YVTWP['nextPageToken'];
            $nextPageToken=$searchResponse_YVTWP['nextPageToken'];
        }
        else
            $commentInfos['next_page_token_comment']='';

        $commentInfos['total_results_comment']=$searchResponse_YVTWP['pageInfo']['totalResults'];
        $commentInfos['etag_comment']=$searchResponse_YVTWP['etag'];
        $commentInfos['video_key']=$arg['video_key'];

        $response= TmpVideosModel_YVTWP::updateImpVideosCommentInfos($commentInfos);
        //$response=  ImportModel_YVTWP::updateTmpVideoInfos($commentInfos);    
        
        if($post_id)
        {
            update_post_meta($post_id,'yvtwp_current_paged_comment',$arg['paged']+1);
            update_post_meta($post_id,'yvtwp_next_page_token_comment',$nextPageToken);            
        }
        
        
        
        return $response;
    }
    /*
     */
    public  function getFeeds($arg,$import_settings,$isSchedule=NULL)
    {
        $response=new Response_YVTWP(1,'');
        
        $maxResults=Config_YVTWP::get('comment_paged');
        if($isSchedule)
            $maxResults=Config_YVTWP::get('comment_paged_schedule');

        if(!TmpCommentModel_YVTWP::existCommentFeedImport($arg['import_id'],$arg['video_key'],$arg['pageToken']))
        {
            //TmpCommentModel_YVTWP::deleteCommentPageTokenFeed($arg['import_id'],$arg['video_key'],$arg['pageToken']);
            $miniUrl='commentThreads';
            
            $options=array('part' => 'id,snippet','videoId'=>$arg['video_key'],'maxResults' => $maxResults,'order'=>$import_settings['comment_oreder_by'],'textFormat'=>$import_settings['comment_text_format'] );
            
            if($import_settings['import_comments_replies']=='yes')
                $options['part']='id,replies,snippet';
            
            if(isset($arg['pageToken']) && !empty($arg['pageToken']))
                $options['pageToken']=$arg['pageToken'];                

            $response= YoutubeAPI_YVTWP::getYoutubeAPIResponse($miniUrl,$options);

            if($response->status==1)
            {
                $searchResponse=$response->result;

                //self::updateTmpVideoInfos($searchResponse, $arg);
                $this->searchResponse=$searchResponse;
                $this->argFeed=$arg;

                foreach ($searchResponse['items'] as $searchResult) 
                {                                
                    if(!isset($arg['pageToken']))
                        $arg['pageToken']='';

                    $tmp_comments_datas=array('import_id'=>$arg['import_id'],'video_key'=>$arg['video_key'],'comment_datas'=>json_encode($searchResult),'paged'=>$arg['paged'],'page_token'=>$arg['pageToken']);
                    TmpCommentModel_YVTWP::insertCommentsFeed($tmp_comments_datas);              
                }     
            }
        }
        
        if($response->status==1)
            $response=TmpCommentModel_YVTWP::getCommentsFeed($arg);            

        return $response;
    }    
    
}
?>