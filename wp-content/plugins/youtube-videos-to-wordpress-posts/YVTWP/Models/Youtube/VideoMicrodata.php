<?php
class VideoMicrodata_YVTWP {
    

    public $post_id;
    public $importId;
    public $tmpVideoId;
    
    public $importSettings;
    public $videoDatas;
    public $template_video;

    public $postTitle;
    public $postContent='';
    public $postExcerpt='';
    public $postAuthor;
    public $postDate;
    
    public $thumbnails;

    public $videoKey;
    public $videoUrl;
    public $videoTitle;
    public $videoDuration;
    public $videoDescription;
    public $videoViews;
    public $videoFavorites;
    public $videoLikes;
    public $videoDislikes;
    public $videoCommentsCount;
    public $videoPublishedAt;
    
    public $thumbnailMaxresUrl;
    public $thumbnailStandardUrl;
    public $thumbnailHighUrl;    
    public $thumbnailMediumUrl;
    public $thumbnailDefaultUrl;
        
    public function __construct($import_settings,$post_id) {
        
        $this->videoDatas=get_post_meta($post_id,'yvtwp_video_datas',TRUE);

        $this->importSettings=$import_settings;
        $this->post_id=$post_id;

        $this->videoKey=get_post_meta($post_id,'yvtwp_video_key',TRUE);
        $this->videoUrl='https://www.youtube.com/watch?v='.$this->videoKey;        
        $this->videoTitle=$this->videoDatas['snippet']['title'];
        $this->videoDescription=$this->videoDatas['snippet']['description'];
        
        $this->postTitle=get_the_title($post_id);
        $this->postContent=  get_post_field('post_content',$post_id);
        

        if(isset($this->videoDatas['contentDetails']['duration']))
            $this->videoDuration=$this->videoDatas['contentDetails']['duration'];        
        if(isset($this->videoDatas['statistics']['viewCount']))
            $this->videoViews=$this->videoDatas['statistics']['viewCount'];
        if(isset($this->videoDatas['statistics']['favoriteCount']))
            $this->videoFavorites=$this->videoDatas['statistics']['favoriteCount'];
        if(isset($this->videoDatas['statistics']['likeCount']))
            $this->videoLikes=$this->videoDatas['statistics']['likeCount'];
        if(isset($this->videoDatas['statistics']['dislikeCount']))
            $this->videoDislikes=$this->videoDatas['statistics']['dislikeCount'];
        if(isset($this->videoDatas['statistics']['commentCount']))
            $this->videoCommentsCount=$this->videoDatas['statistics']['commentCount'];
        if(isset($this->videoDatas['snippet']['publishedAt']))
            $this->videoPublishedAt=$this->videoDatas['snippet']['publishedAt'];
        
        $this->thumbnails=$this->videoDatas['snippet']['thumbnails'];
        
        if(isset($this->videoDatas['snippet']['thumbnails']['maxres']['url']))
            $this->thumbnailMaxresUrl=$this->videoDatas['snippet']['thumbnails']['maxres']['url'];     
        if(isset($this->videoDatas['snippet']['thumbnails']['standard']['url']))
            $this->thumbnailStandardUrl=$this->videoDatas['snippet']['thumbnails']['standard']['url'];        
        if(isset($this->videoDatas['snippet']['thumbnails']['high']['url']))
            $this->thumbnailHighUrl=$this->videoDatas['snippet']['thumbnails']['high']['url'];        
        if(isset($this->videoDatas['snippet']['thumbnails']['medium']['url']))
            $this->thumbnailMediumUrl=$this->videoDatas['snippet']['thumbnails']['medium']['url'];        
        if(isset($this->videoDatas['snippet']['thumbnails']['default']['url']))
            $this->thumbnailDefaultUrl=$this->videoDatas['snippet']['thumbnails']['default']['url']; 
    }
    /*
     * 
     */
    public function parseTemplate($videos_microdata,$fields)
    {
        $pattern = "/\{\{(\w+)\}\}/";
        $res = array();
        $microdataResult=array();

        foreach ($videos_microdata as $key=>$value) 
        {        
            preg_match_all($pattern,$value,$res, PREG_SET_ORDER);

            if(is_array($res) && !empty($res))
            {
                foreach ($res as $r) 
                {
                    if (isset($this->$fields[$r[1]]))  
                        $value = str_replace($r[0], $this->$fields[$r[1]], $value);  
                }//foreach       
            }
            else
            {
                $is_custum_field=  get_post_meta($this->post_id,$value,TRUE);
                if($is_custum_field)
                    $value=$is_custum_field;
            }            
            
            $microdataResult[$key]=$value;
        }//foreach
        
        //var_dump($microdataResult);

        return $microdataResult;
    }//parseTemplate    
    
}
?>