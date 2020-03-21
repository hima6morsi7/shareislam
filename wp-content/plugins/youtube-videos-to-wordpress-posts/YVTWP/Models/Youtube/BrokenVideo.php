<?php

class BrokenVideo_YVTWP {

    public $post_id=1;
    public $videoKey;
    public $videoStatus;
    public $errorMessage;



    public function __construct($post_id=NULL) {
        if($post_id)
        {
            $this->post_id=$post_id;
            $this->videoKey=  get_post_meta($post_id,'yvtwp_video_key',TRUE);
        }
    }
   /*
    * 
    */
   public function executeCheck()
   {
        $response=$this->getApiResponse();
        
        if($response->status==1 && is_array($response->result))
        {
            $apiResult=$response->result['items'][0];
            $response=$this->checkVideoByApi($apiResult);
        }
        else 
        {
            $response=$this->checkVideoByHttp();
        }
        
        //a supprimer
        /*$response->status=0;
        $response->messages="";*/
        
        if($response->status==0)
        { 
           $response=$this->setErrorLog($response); 
        }
        
        return $response;
   }
   /*
    * 
    */
   private function getApiResponse()
   {
        $miniUrl='videos';
        $options=array('part' => 'status','id'=>$this->videoKey,'maxResults' => 1 );                    
        $response=YoutubeAPI_YVTWP::getYoutubeAPIResponse($miniUrl, $options);  
        
        return $response;
   }
   public function checkVideoByApi($apiResult)
   {
       $response=new Response_YVTWP(1);
       
        if(isset($apiResult['status']))
        {
            if(isset($apiResult['status']['uploadStatus']))
                $response=$this->checkUploadStatus($apiResult['status']['uploadStatus']);
            if($response->status==1 && isset($apiResult['status']['privacyStatus']))
                $response=$this->checkPrivacyStatus($apiResult['status']['privacyStatus']);
            if($response->status==1 && isset($apiResult['status']['embeddable']))
                $response=$this->checkEmbeddableStatus($apiResult['status']['embeddable']);
        }
       
       return $response;
   }
   /*
    * 
    */
   private function checkVideoByHttp()
   {
       $response=new Response_YVTWP(1);
       
       $url="https://www.youtube.com/watch?v=".$this->videoKey;
                   
       $result_remote=wp_remote_get($url);
       if($result_remote && wp_remote_retrieve_response_code($result_remote))
       {
           $code_response=wp_remote_retrieve_response_code($result_remote);
           
           if($code_response!=200)
           {
               $response->status=0;
               $response->messages=__('No result , Http error code ', 'YVTWP-lang').$code_response;
           }
       }
       
       return $response;
   }
   /*
    * 
    */
   private function checkUploadStatus($uploadStatus)
   {
       $response=new Response_YVTWP(1);
       
       if($uploadStatus!='processed' && $uploadStatus!='uploaded')
       {
           $response->status=0;
           $response->messages=Config_YVTWP::$statusVideoMessage[$uploadStatus];
       }
           
       return $response;
   }
   /*
    * 
    */
   private function checkPrivacyStatus($privacyStatus)
   {
       $response=new Response_YVTWP(1);
       
       if($privacyStatus!='public')
       {
           $response->status=0;
           $response->messages=Config_YVTWP::$statusVideoMessage[$privacyStatus];
       }
           
       return $response;       
   }
   /*
    * 
    */
   private function checkEmbeddableStatus($embeddable)
   {
       $response=new Response_YVTWP(1);
       
       if(!$embeddable)
       {
           $response->status=0;
           $response->messages=Config_YVTWP::$statusVideoMessage['embeddable'];
       }
           
       return $response;         
   }
   /*
    * 
    */
   private function setErrorLog($response)
   {
    $separteur=" | ";
    $response_messages=$response->messages;    
       
    $video_title=get_the_title($this->post_id);
    $view_link=get_the_permalink($this->post_id);
    $edit_link=get_edit_post_link($this->post_id);   
    $link_delete=get_delete_post_link($this->post_id,'',TRUE);

    $check_date="<td class='log_td_date'><span> ".date('Y-m-d H:i:s',time())."</span></td>";
    $video_title="<td class='log_td_date'><span><a target='_blank' href='https://www.youtube.com/watch?v={$this->videoKey}'> {$video_title} </a></span></td> ";
    $response_messages="<td class='log_td_date broken_td_status'><span>".$response->messages."</span></td>";
    $link_view="<td class='log_td_date'><span><a target='_blank' href='{$view_link}'>".__('View', 'YVTWP-lang')." </a>";
    $link_edit="<a target='_blank' href='{$edit_link}'>".__('Edit', 'YVTWP-lang')." </a>";
    $link_delete="<a class='button_delete_checked'>".__('Delete Permanently', 'YVTWP-lang')." </a> </span></td>";

    $response->result['post_id']=$this->post_id;
    $response->result['messages']=$check_date.$video_title.$response_messages.$separteur.$link_view.$separteur.$link_edit.$separteur.$link_delete;    
    $response->result['insert_time']=date('Y-m-d H:i:s',time());
    $response->messages=' ';
    
    $dataLog['import_id']=0;
    $dataLog['log_type']='broken_videos';
    $dataLog['response']=$response;
    $dataLog['additionnel_infos']=array('post_id'=>$this->post_id,'video_key'=>$this->videoKey);
    $resLog=LogModel_YVTWP::insertLog($dataLog);
    
    $response->result['log_id']=$resLog->result;
    
    
    return $response;
   }   
    
    
}
?>