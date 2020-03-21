<?php
class VideoCommentToPostComment_YVTWP {

    public $apiCommentId;
    public $apiCommentIdParent;
    public $tmpCommentId;
    public $postID;
    public $importId;
    public $videoKey;    
    public $importSettings;
    public $commentDatas;    
    
    public $commentStatus;
    public $commentType;    
    public $commentParent=0;
    public $commentContent;
    public $commentAuthorName;
    public $commentAuthorEmail;
    public $commentAuthorUrl;
    public $commentAuthorProfileImageUrl;
    public $commentDate;
    public $commentPublishedAt;
    
    public $commentCustomFields=array();



    public function __construct($post_id,$video_key,$import_settings,$tmpComment,$commentParent) {
        $this->init($post_id,$video_key,$import_settings,$tmpComment,$commentParent);
    }
    /**
     * 
     */
    private function init($post_id,$video_key,$import_settings,$tmpComment,$commentParent)
    {
        $this->postID=$post_id;
        $this->videoKey=$video_key;
        $this->importSettings=$import_settings;         
        $this->commentDatas=json_decode($tmpComment['comment_datas'],TRUE);

        if(isset($this->commentDatas['snippet']['topLevelComment']))                
            $this->commentDatas=$this->commentDatas['snippet']['topLevelComment'];
            
        $this->importId=$this->importSettings['import_id'];
        $this->apiCommentId=$this->commentDatas['id'];
        if(isset($this->commentDatas['snippet']['parentId']))    
            $this->apiCommentIdParent=$this->commentDatas['snippet']['parentId']; 
        
        $this->tmpCommentId=$tmpComment['id'];
        
        $this->commentStatus=$this->importSettings['comment_status'];
        $this->commentType=$this->importSettings['comment_type'];
        $this->commentParent=$commentParent;
        $this->commentContent=$this->commentDatas['snippet']['textDisplay'];
        $this->commentAuthorName=$this->commentDatas['snippet']['authorDisplayName'];
        
        switch ($this->importSettings['comment_author_url']) 
        {
            case 'authorGooglePlusUrl':
                if(isset($this->commentDatas['snippet']['authorGoogleplusProfileUrl']))
                    $this->commentAuthorUrl=$this->commentDatas['snippet']['authorGoogleplusProfileUrl'];
                break;
            case 'authorChannelUrl':
                if(isset($this->commentDatas['snippet']['authorChannelUrl']))
                    $this->commentAuthorUrl=$this->commentDatas['snippet']['authorChannelUrl'];
                break;                
        }
        
        $this->commentAuthorProfileImageUrl=$this->commentDatas['snippet']['authorProfileImageUrl'];
        $this->commentPublishedAt=date('Y-m-d H:i:s',strtotime($this->commentDatas['snippet']['publishedAt'])); 
        
        if($this->importSettings['comment_date']=='youtubeCommentPublishedDate')
            $this->commentDate=date('Y-m-d H:i:s',strtotime($this->commentDatas['snippet']['publishedAt']));   
        else
            $this->commentDate=current_time('mysql');
    }
    /*
     * 
     */
    private function addCommentCustomFields($comment_id)
    {
        $this->commentCustomFields['yvtwp_comment_datas']=$this->commentDatas;
        $this->commentCustomFields['yvtwp_api_comment_id']= $this->apiCommentId;
        $this->commentCustomFields['yvtwp_import_id']= $this->importSettings['import_id'];
        $this->commentCustomFields['yvtwp_video_key']= $this->videoKey;
        $this->commentCustomFields['yvtwp_publishedAt']= $this->commentPublishedAt;

        if(!$this->commentParent)
            $this->commentCustomFields['yvtwp_is_parent']= $this->importId.'yes';
            
        if($this->commentAuthorProfileImageUrl)
            $this->commentCustomFields['yvtwp_author_profile_image_url']=$this->commentAuthorProfileImageUrl;
                    
        //add post custom fields
        foreach ($this->commentCustomFields as $key => $value) 
        {
            if ( !update_comment_meta ($comment_id,$key,$value) )  
                add_comment_meta($comment_id,$key,$value, true );	
        }                 
    }
        /*
     * 
     */
    private  function containSearchTerm()
    {
        $res=FALSE;
        
        if(!empty($this->importSettings['comment_search_term']))
        {
            $terms=explode(',',trim($this->importSettings['comment_search_term']));
            foreach ($terms as $term) {
                if (strpos($this->commentContent,$term) !== false) {
                    $res=TRUE;
                    break;
                }             
                
            }
        }
        else 
            $res=TRUE;
        
        return $res;
    }
    /**
     * 
     */
    public function execute($logType=NULL)
    {
        $comment_id=NULL;
        $response= new Response_YVTWP(1,__('Imported', 'YVTWP-lang'));
        
        $containSearchTerm= $this->containSearchTerm();
        if($containSearchTerm)
        {
            if(!Comment_YVTWP::existCommentMeta('yvtwp_api_comment_id',$this->apiCommentId))
                $response=$this->addComment();
            else
            {
                $comment_id=Comment_YVTWP::getComment_idByCommentMeta('yvtwp_api_comment_id',$this->apiCommentId);
                $response=$this->updateComment($comment_id);
            }        

            $response->result['post_id']=$this->postID;

            //update TMP video infos
            $arg1['is_imported']='1';
            $arg1['tmp_comment_id']=  $this->tmpCommentId;
            $arg1['api_comment_id']=  $this->apiCommentId;
            $arg1['api_comment_id_parent']=  $this->apiCommentIdParent;  

            TmpCommentModel_YVTWP::updateTmpComment($arg1);


            if(!$logType)
                $logType='comments';

            $dataLog['import_id']=$this->importId;
            $dataLog['log_type']=$logType;
            $dataLog['response']=$response;
            LogModel_YVTWP::insertLog($dataLog);
        }
        else
        {
            $response= new Response_YVTWP(0,__('Not contain search term', 'YVTWP-lang'));
        }
        

        return $response;
    }   
    /*
     * 
     */
    private function addComment()
    {
        $response= new Response_YVTWP(1,__('Comment Imported', 'YVTWP-lang'));

        $comment = array(
            'comment_post_ID' => $this->postID,
            'comment_author' => $this->commentAuthorName,
            'comment_author_email' => $this->commentAuthorEmail,
            'comment_author_url' => $this->commentAuthorUrl,
            'comment_content' => $this->commentContent,
            'comment_type' => $this->commentType,
            'comment_parent' => $this->commentParent,
            'user_id' => Config_YVTWP::$current_user_id_2,
            'comment_author_IP' => '',
            'comment_agent' => '',
            'comment_date' => $this->commentDate,
            'comment_approved' => $this->commentStatus,
        );

        $comment_id = wp_insert_comment( $comment );

        if($comment_id==0) //if error
        {
            $response->status=0;
            $response->messages=  __('Error while saving the comment', 'YVTWP-lang');
        }
        else
        {            
            //add comment custom fields
            $this->addCommentCustomFields($comment_id);
            $response->result['comment_id']=$comment_id;            
        }    
        
        return $response;
    }
    /*
     * 
     */
    private function updateComment($comment_id)
    {
        $response= new Response_YVTWP(1,__('Comment Updated', 'YVTWP-lang'));
        // Create comment object
        $comment = array(
            'comment_ID' =>$comment_id,
            'comment_post_ID' => $this->postID,
            'comment_author' => $this->commentAuthorName,
            'comment_author_email' => $this->commentAuthorEmail,
            'comment_author_url' => $this->commentAuthorUrl,
            'comment_content' => $this->commentContent,
            'comment_type' => $this->commentType,
            'comment_parent' => $this->commentParent,
            'user_id' => Config_YVTWP::$current_user_id_2,
            'comment_author_IP' => '',
            'comment_agent' => '',
            'comment_date' => $this->commentDate,
            'comment_approved' => $this->commentStatus,
        );           
        
        wp_update_comment($comment);
                
        $response->result['comment_id']=$comment_id;   
        $response->result['is_updated']='yes';                       

        //add comment custom fields
        $this->addCommentCustomFields($comment_id);
        
        return $response;        
    }
    /*
     * 
     */
    private function parseTemplate($template, $fields)
    {
        $pattern = "/\{\{(\w+)\}\}/";
        $res = array();

        preg_match_all($pattern, $template, $res, PREG_SET_ORDER);
        foreach ($res as $r) 
        {
            if (isset($this->$fields[$r[1]]))  
            {
                $template = str_replace($r[0], $this->$fields[$r[1]], $template);
            }    
            else
            {
                $template = str_replace($r[0],'', $template);
            }
        }//foreach

        return $template;
    }//parseTemplate  
    /*
     * 
     */
    private function removeUrlFromStr($string)
    {
        $string = preg_replace("/(?:(?:https?|ftp|file):\/\/|www\.|ftp\.)(?:\([-A-Z0-9+&@#\/%=~_|$?!:;,.]*\)|[-A-Z0-9+&@#\/%=~_|$?!:;,.])*(?:\([-A-Z0-9+&@#\/%=~_|$?!:;,.]*\)|[A-Z0-9+&@#\/%=~_|$])/ix",'', $string);
        return $string;
    }    
    
}
?>