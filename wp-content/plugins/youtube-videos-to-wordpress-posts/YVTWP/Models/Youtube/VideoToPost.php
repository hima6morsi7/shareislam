<?php
class VideoToPost_YVTWP {
    
    public static $importedVideos=array();
    public static $skippedVideos=array();

    public $skip_add_new;
    public $isSchedulingImport=false;

    public $importId;
    public $tmpVideoId;
    
    public $importSettings;
    public $videoDatas;
    public $template_video;
    public $excerpt_content = false;


    public $postType;
    public $title;
    public $description;
    public $postContent='';
    public $postExcerpt='';
    public $postAuthor;
    public $postStatus;
    public $postDate;
    public $customFields;
    public $allCustomFields_fieldName;
    public $tags=array();
    public $categories=array();
    public $taxonomyCategories;
    public $taxonomyTags;
    public $thumbnails;
    
    public $postFormat;


    public $schedule_position;
    public $activeSchedule;
    public $scheduleStartDate;
    public $scheduleMargeStart; //by minute
    public $scheduleMargeEnd; //by minute


    public $videoKey;
    public $videoUrl;
    public $videoTitle;


    public $videoDuration;
    public $videoViews;
    public $videoFavorites;
    public $videoLikes;
    public $videoDislikes;
    public $videoComments;
    public $videoPublishedAt;
    
    public $thumbnailMaxresUrl;
    public $thumbnailStandardUrl;
    public $thumbnailHighUrl;    
    public $thumbnailMediumUrl;
    public $thumbnailDefaultUrl;
    
    public $thumbnailsQuality;
    
    public $templateFields;
    public $templateCustomFields;

    public function __construct($import_id,$tmp_video_id,$skip_add_new=NULL) {
        $this->importId = $import_id;
        $this->tmpVideoId = $tmp_video_id;
        $this->skip_add_new = $skip_add_new;
        
        $import_settings=SettingsModel_YVTWP::getOption('yvtwp_import_settings_'.$this->importId,'',TRUE);
        $tmp_video= TmpVideosModel_YVTWP::getTmpVideoById($this->tmpVideoId)->result[0];

        $this->importSettings = $import_settings;
        $this->videoDatas = json_decode($tmp_video['video_datas'],TRUE);
        $this->template_video = $import_settings['template_video'];
        
        if( isset($import_settings['excerpt_content']) && !empty($import_settings['excerpt_content']) ) {
            $this->excerpt_content = $import_settings['excerpt_content'];
        }
        
        $this->videoTitle=$this->videoDatas['snippet']['title'];
        $this->title=$this->videoDatas['snippet']['title'];
        $this->description=$this->videoDatas['snippet']['description'];
        $this->postStatus=$import_settings['post_status'];
        $this->postType=$import_settings['post_type'];
        
        if(!empty($import_settings['post_format']))
            $this->postFormat=$import_settings['post_format'];
        
        if(isset($this->importSettings['active_post_schedule']) || ( isset($this->importSettings['post_publish_date']) && $this->importSettings['post_publish_date']=='custom_publish_date' ) )
            $this->activeSchedule='yes';
        
        $this->scheduleStartDate=date('Y-m-d H:i:s',  strtotime($this->importSettings['schedule_start_date']));
        $this->scheduleMargeStart=$this->importSettings['schedule_marge_start'];
        $this->scheduleMargeEnd=$this->importSettings['schedule_marge_end'];
        
        
        $this->videoKey=$tmp_video['video_key'];
        $this->videoUrl='https://www.youtube.com/watch?v='.$this->videoKey;

        if(isset($this->videoDatas['contentDetails']['duration']))
            $this->videoDuration=YoutubeDuration_YVTWP::getCleanedDuration($this->videoDatas['contentDetails']['duration']);        
        if(isset($this->videoDatas['statistics']['viewCount']))
            $this->videoViews=$this->videoDatas['statistics']['viewCount'];
        if(isset($this->videoDatas['statistics']['favoriteCount']))
            $this->videoFavorites=$this->videoDatas['statistics']['favoriteCount'];
        if(isset($this->videoDatas['statistics']['likeCount']))
            $this->videoLikes=$this->videoDatas['statistics']['likeCount'];
        if(isset($this->videoDatas['statistics']['dislikeCount']))
            $this->videoDislikes=$this->videoDatas['statistics']['dislikeCount'];
        if(isset($this->videoDatas['statistics']['commentCount']))
            $this->videoComments=$this->videoDatas['statistics']['commentCount'];
        if(isset($this->videoDatas['snippet']['publishedAt']))
            $this->videoPublishedAt=date('Y-m-d H:i:s',strtotime($this->videoDatas['snippet']['publishedAt']));
        
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
        
        if(isset($this->importSettings['thumbnails_quality']))
            $this->thumbnailsQuality=$this->importSettings['thumbnails_quality'];
                
        //set custum fiels   
        $this->templateFields = $import_settings['template_fields'];   
        $this->templateCustomFields = $import_settings['custom_fields'];          
    }
    /*
     * 
     */
    private function initCustomFields($template_fields,$custom_fields)
    {
        $this->customFields['yvtwp_video_datas']=$this->videoDatas;
        $this->customFields['yvtwp_video_key']= $this->videoKey;
        $this->customFields['yvtwp_feed_key']= $this->importSettings['feed_key']; 
        $this->customFields['yvtwp_import_id']= $this->importId;
        
        if(!empty($template_fields) && !empty($custom_fields))
        {
            $embed_template_fields=Utils_YVTWP::getEmbedTemplateFieldsArray($template_fields);
            $embed_custom_fields= explode(',', $custom_fields);

            $embed_custom_fields = array_map('trim', $embed_custom_fields);

            if(is_array($embed_custom_fields) && is_array($embed_template_fields))
            {
                foreach ($embed_custom_fields as $key => $value)
                {
                    if($embed_template_fields[$key]=='{{all_custom_fields}}')
                        $this->allCustomFields_fieldName=$value;
                    else
                        $this->customFields[$value]=$this->parseTemplate($embed_template_fields[$key],Config_YVTWP::$templateFields);                  
                }              
            }
        }
    }
    /*
     * 
     */
    private function embedOptions()
    {
        $this->template_video= $this->parseTemplate($this->template_video,Config_YVTWP::$templateFields);
        $this->template_video=  stripslashes($this->template_video);
        
        $this->postContent=$this->template_video;  
    }
    /*
     * 
     */
    private function titleOptions()
    {
        //str_replace(',','',$text) remplaced by preg_replace('~,(?!.*,)~', '', $text)
        
        $title_deleted_keywords = explode(';', $this->importSettings['title_deleted_keywords']);
        $title_remplaced_keywords = explode(';', $this->importSettings['title_remplaced_keywords']);
        $title_remplaced_keywords_by = explode(';', $this->importSettings['title_remplaced_keywords_by']);
        
        foreach ($title_deleted_keywords as $value) {
            $this->title=  str_replace(preg_replace('~,(?!.*,)~', '', $value),'', $this->title);
        }
        
        foreach ($title_remplaced_keywords as $key => $value) {
            $this->title=  str_replace(preg_replace('~,(?!.*,)~', '', $value), preg_replace('~,(?!.*,)~', '', $title_remplaced_keywords_by[$key]), $this->title);
        }
        
        if(!empty($this->importSettings['text_before_title']))
            $this->title=$this->importSettings['text_before_title'].' '.$this->title;
        
        if(!empty($this->importSettings['text_after_title']))
            $this->title=$this->title.' '.$this->importSettings['text_after_title'];              
    }
    /*
     * 
     */
    private function descriptionOptions() {
        //str_replace(',','',$text) remplaced by preg_replace('~,(?!.*,)~', '', $text)
        
        $description_deleted_keywords =       explode(';', $this->importSettings['description_deleted_keywords']);
        $description_remplaced_keywords =     explode(';', $this->importSettings['description_remplaced_keywords']);
        $description_remplaced_keywords_by =  explode(';', $this->importSettings['description_remplaced_keywords_by']);
        
        if($this->importSettings['delete_url_from_description']=='yes')
            $this->description = $this->removeUrlFromStr($this->description);
        
        foreach ($description_deleted_keywords as $value) {
            $this->description = str_replace(preg_replace('~,(?!.*,)~', '', $value),'', $this->description);
        }
        
        foreach ($description_remplaced_keywords as $key => $value) {
            $this->description = str_replace(preg_replace('~,(?!.*,)~', '', $value), preg_replace('~,(?!.*,)~', '', $description_remplaced_keywords_by[$key]), $this->description);
        } 
        
        if($this->importSettings['import_description_as_post_except']=='yes')
            $this->postExcerpt= $this->description;  
        
        $this->excerptOptions();
    }
    private function excerptOptions() {
        if($this->excerpt_content) {
            $this->excerpt_content= $this->parseTemplate($this->excerpt_content,Config_YVTWP::$templateFields);
            $this->excerpt_content=  stripslashes($this->excerpt_content);
            $this->postExcerpt=$this->excerpt_content;  
        }
    }
    /*
     * 
     */
    private function dateOptions()
    {
        if($this->activeSchedule=='yes')
        {
            $SchedulePosition=  ImportModel_YVTWP::getScheduleCurrentPositionByImportKey($this->importId);
            $this->schedule_position=$SchedulePosition+1;
            $this->postDate=date('Y-m-d H:i:s',strtotime($this->scheduleStartDate.' + '.rand($this->scheduleMargeStart,$this->scheduleMargeEnd)*$SchedulePosition.' minute')); 
            if($this->postDate)
                $this->postStatus='future';            
        }
        else
        {
            if( isset($this->importSettings['post_publish_date']) )
            {
                if($this->importSettings['post_publish_date']=='video_publish_date')
                    $this->postDate=$this->videoPublishedAt;
                else
                {
                    if($this->importSettings['post_publish_date']=='insert_date')
                        $this->postDate=null;                    
                }
            }        
        }
    }
    /*
     * 
     */
    public function commentOptions($post_id)
    {
        if(!$this->isSchedulingImport)
            ImportController_YVTWP::importVideoComments($post_id,$this->importId,$this->importSettings,$this->videoKey);
    }
    /*
     * 
     */
    private function setPostAuthor()
    {
        if(!empty($this->importSettings['author_login']))
        {
            $user=get_user_by('login',$this->importSettings['author_login']);
            if($user)
                $this->postAuthor=$user->ID;
            else
                $this->postAuthor=get_current_user_id();
        }        
    }
    /*
     * 
     */
    private function setCategories()
    {
        $this->taxonomyCategories=$this->importSettings['taxonomy_categories'];        
        $categories= explode(',',$this->importSettings['categories']);
        
        //set youtube categories
        if($this->importSettings['import_youtube_categories']=='yes')
        {
            if(isset($this->videoDatas['snippet']['categoryId']))
            {
                $youtube_categoryId=$this->videoDatas['snippet']['categoryId'];
                $youtube_categories=  require_once Config_YVTWP::$views_dir.'resources/datas-json/categories_youtube.php';

                if($youtube_categories['items'])
                {
                    foreach ($youtube_categories['items'] as $key => $category) {
                        if($category['id']==$youtube_categoryId)
                        {
                            $category_name=$category['snippet']['title'];

                            $term = term_exists($category_name,$this->taxonomyCategories);
                            if ($term !== 0 && $term !== null) 
                              $this->categories[]=$term['term_id'];
                            else 
                            {
                                $reult=wp_insert_term($category_name, $this->taxonomyCategories);
                                if($reult)
                                    $this->categories[]=$reult['term_id'];
                            }                                
                            break;
                        }
                    }
                }
            }
        }        
        
        if($categories && !empty($this->taxonomyCategories))
        {
           
            foreach ($categories as $key => $term_id) 
            {               
                $term = term_exists((int)$term_id,$this->taxonomyCategories);
                 
                if ($term !== 0 && $term !== null)
                  $this->categories[]=$term_id;   
            }
        }
        
        $this->categories = array_map( 'intval', $this->categories );
        $this->categories = array_unique( $this->categories );   
    }
    /*
     * 
     */
    private function setTags()
    {
        $this->taxonomyTags=$this->importSettings['taxonomy_tags'];
        $tags= explode(';',  str_replace(',','', $this->importSettings['tags']));
        
        //set youtube tags
        if($this->importSettings['import_youtube_tags']=='yes')
        {
            if(isset($this->videoDatas['snippet']['tags']))
            {
                $tags_youtube=$this->videoDatas['snippet']['tags'];
                if(is_array($tags_youtube))
                {
                    $maxTags=10;
                    if($this->importSettings['max_youtube_tags']>0)
                        $maxTags=(int)$this->importSettings['max_youtube_tags'];                    

                    if($maxTags>count($tags_youtube))
                        $maxTags=count($tags_youtube);

                    $rand_tags=  array_rand($tags_youtube, $maxTags);
                    if(is_array($rand_tags))
                    {
                        foreach ($rand_tags as $key => $value)
                        {
                            $tags[]=$tags_youtube[$value];
                        }
                    }
                }
            }
        }
        
        if($tags && !empty($this->taxonomyTags))
        {
            foreach ($tags as $key => $term_name) 
            {
                if($term_name)
                {
                    $term_id=0;

                    $term = term_exists($term_name,$this->taxonomyTags);
                    if ($term !== 0 && $term !== null)
                      $term_id=$term['term_id'];
                    else 
                    {
                        $reult=wp_insert_term($term_name, $this->taxonomyTags);
                        if(is_array($reult) && !is_wp_error($reult))
                            $term_id=$reult['term_id'];
                        else {
                            //var_dump($reult);
                        }
                    }

                    if($term_id!=0)
                    {
                        $term=  get_term_by('id',(int)$term_id, $this->taxonomyTags);
                        if($term)
                            $this->tags[]=$term->term_id;
                    }  
                }
            }
        }
        
        $this->tags = array_map( 'intval',$this->tags );
        $this->tags = array_unique( $this->tags );            
    }    
    /*
     * 
     */
    public function checkBrokenVideo()
    {
        $response= new Response_YVTWP(1);
        
        if(Config_YVTWP::get('force_import_broken_videos')=='no')
        {
            $brokenVideo=new BrokenVideo_YVTWP();
            $response=$brokenVideo->checkVideoByApi($this->videoDatas);

            if($response->status==0)
            {
                $response->result['is_broken']='yes';
                $response->result['video_title']=$this->videoTitle;
                $response->result['video_key']=$this->videoKey;            
                $response->messages=$response->messages.' <a target="_blank" href="'.$this->videoUrl.'">'.__('View on youtube', 'YVTWP-lang').'</a>';
            }    
        }
        
        return $response;
    }

    /**
     * 
     */
    public function execute($logType=NULL)
    {
        if($this->isSchedulingImport)
        {
            remove_filter('content_save_pre', 'wp_filter_post_kses'); 
            remove_filter('content_filtered_save_pre', 'wp_filter_post_kses');
        }
        
        $response= new Response_YVTWP(1,__('Imported', 'YVTWP-lang'));
        /*$post = array(
          'ID'             => [ <post id> ] // Are you updating an existing post?
          'post_content'   => [ <string> ] // The full text of the post.
          'post_name'      => [ <string> ] // The name (slug) for your post
          'post_title'     => [ <string> ] // The title of your post.
          'post_status'    => [ 'draft' | 'publish' | 'pending'| 'future' | 'private' | custom registered status ] // Default 'draft'.
          'post_type'      => [ 'post' | 'page' | 'link' | 'nav_menu_item' | custom post type ] // Default 'post'.
          'post_author'    => [ <user ID> ] // The user ID number of the author. Default is the current user ID.
          'ping_status'    => [ 'closed' | 'open' ] // Pingbacks or trackbacks allowed. Default is the option 'default_ping_status'.
          'post_parent'    => [ <post ID> ] // Sets the parent of the new post, if any. Default 0.
          'menu_order'     => [ <order> ] // If new post is a page, sets the order in which it should appear in supported menus. Default 0.
          'to_ping'        => // Space or carriage return-separated list of URLs to ping. Default empty string.
          'pinged'         => // Space or carriage return-separated list of URLs that have been pinged. Default empty string.
          'post_password'  => [ <string> ] // Password for post, if any. Default empty string.
          'guid'           => // Skip this and let Wordpress handle it, usually.
          'post_content_filtered' => // Skip this and let Wordpress handle it, usually.
          'post_excerpt'   => [ <string> ] // For all your post excerpt needs.
          'post_date'      => [ Y-m-d H:i:s ] // The time post was made.
          'post_date_gmt'  => [ Y-m-d H:i:s ] // The time post was made, in GMT.
          'comment_status' => [ 'closed' | 'open' ] // Default is the option 'default_comment_status', or 'closed'.
          'post_category'  => [ array(<category id>, ...) ] // Default empty.
          'tags_input'     => [ '<tag>, <tag>, ...' | array ] // Default empty.
          'tax_input'      => [ array( <taxonomy> => <array | string>, <taxonomy_other> => <array | string> ) ] // For custom taxonomies. Default empty.
          'page_template'  => [ <string> ] // Requires name of template file, eg template.php. Default empty.
        );       
         */  
        
        $response=  $this->checkBrokenVideo();
        
        if($response->status==1)
        {        
            $this->titleOptions();
            $this->descriptionOptions();
            $this->setPostAuthor();
            $this->setCategories();
            $this->setTags();
            $this->embedOptions();   
            $this->dateOptions();
            
            $this->initCustomFields($this->templateFields, $this->templateCustomFields);  



            if(!Post_YVTWP::existPostMeta('yvtwp_video_key',$this->videoKey))
            {
                $post_id=  Post_YVTWP::getExistPostIdbyTitle($this->title);
                if(!$post_id) //if title dont exist
                {
                    $response=$this->addPost();

                    if($response->status==1 && isset($response->result['post_id']))
                    {
                        $post_id=$response->result['post_id'];
                        if($this->activeSchedule=='yes')
                            ImportModel_YVTWP::updateScheduleCurrentPosition ($this->importId,$this->schedule_position); 

                        //import comment
                        $this->commentOptions($response->result['post_id']);                
                    }
                }
                else
                {
                    $response->status=0;
                    $response->messages=__('Skipped,[Title Exists]', 'YVTWP-lang'); 
                    $response->result['is_updated']='no';                
                }
            }
            else
            {
                $post_id=Post_YVTWP::getPost_idByPostMeta('yvtwp_video_key',$this->videoKey);

                if($this->importSettings['update_if_exist']=='yes' && !$this->isSchedulingImport)
                {   
                    $response=  $this->updatePost($post_id);
                    if($response->status==1 && $this->activeSchedule=='yes')
                        ImportModel_YVTWP::updateScheduleCurrentPosition($this->importId,$this->schedule_position); 

                    //import comment
                    if($response->status==1)
                        $this->commentOptions($post_id);                
                }
                else 
                {                
                    $response->status=0;
                    $response->messages=__('Skipped,[Exist]', 'YVTWP-lang'); 
                    $response->result['is_updated']='no';
                }  
                $response->result['is_exist']='yes';
            }        

            if($post_id)
            {
                $response->result['video_title']=$this->videoTitle;
                $response->result['video_key']=$this->videoKey;
                $response->result['post_id']=$post_id; 
                $response->result['view_link']=get_the_permalink($post_id);
                $response->result['edit_link']=get_edit_post_link($post_id); 
                $response->result['comments_link']=  get_comments_link($post_id);
                $response->result['comment_count']=Comment_YVTWP::getCommentsCountByVideoKey($this->videoKey);
            }

            //update TMP video infos
            $arg['is_imported']='1';
            $arg['import_id']=$this->importId;
            $arg['tmp_video_id']=  $this->tmpVideoId;
            TmpVideosModel_YVTWP::updateTmpVideo($arg);
        }
        else
        {
            $logType='simple_log';
        }
        
        
        
        if(!$logType)
            $logType='normal_videos_import';
            
        $dataLog['import_id']=$this->importId;
        $dataLog['log_type']=$logType;
        $dataLog['response']=$response;
        LogModel_YVTWP::insertLog($dataLog);

        if($this->isSchedulingImport)
        {
            add_filter('content_save_pre', 'wp_filter_post_kses'); 
            add_filter('content_filtered_save_pre', 'wp_filter_post_kses');
        }        
        
        return $response;
    }   
    /*
     * 
     */
    private function addPost()
    {
        $response= new Response_YVTWP(1,__('Imported', 'YVTWP-lang'));
        
        if($this->skip_add_new)
        {
            $response->status=0;
            $response->messages=__('Skipped, [Max imported videos excessed]', 'YVTWP-lang'); 
            $response->result['video_title']=$this->videoTitle;
            $response->result['video_key']=$this->videoKey;           
        }
        else
        {            
            if(!$this->isPublishAfter()) {
                $response->status=0;
                $response->messages=__('Skipped, published before ', 'YVTWP-lang').'['.$this->importSettings['video_published_after'].']'; 
                $response->result['video_title']=$this->videoTitle;
                $response->result['video_key']=$this->videoKey;                 
            }
            else {
                // Create post object
                $post = array(
                    'post_title'     => wp_strip_all_tags($this->title),
                    //'post_content'   => iconv('ISO-8859-1','UTF-8', $this->postContent), not work for arabic chars
                    'post_content'   => $this->postContent,
                    'post_excerpt'   => $this->postExcerpt,
                    'post_status'    => $this->postStatus,
                    'post_type'      => $this->postType,  
                    'post_author'    => $this->postAuthor,
                    'post_category'  => $this->categories,
                    'tags_input'     => $this->tags
                );

                if($this->postDate)
                {
                    $post['post_date']=$this->postDate;
                    $post['post_date_gmt']=get_gmt_from_date($this->postDate);
                }

                $post_id = wp_insert_post( $post, $wp_error=TRUE );
                
                if($post_id==0 || is_wp_error($post_id)) //if error
                {
                    $response->status=0;
                    $response->messages=  __('Error while saving the post ', 'YVTWP-lang').$post_id->get_error_data();
                }
                else
                {
                    if($post_id)
                        $this->addPostCategoriesAndTags($post_id);

                    //add post custom fields
                    $this->addPostCustomFields($post_id);
                    //set post format
                    if($this->postFormat)
                        set_post_format ($post_id,$this->postFormat);
                    //add post thumbnail
                    if($this->importSettings['import_video_thumbnail']=='yes')
                        $this->uploadThumbnail($post_id);

                    $response->result['video_title']=$this->videoTitle;
                    $response->result['video_key']=$this->videoKey;
                    $response->result['post_id']=$post_id; 
                    $response->result['view_link']=get_the_permalink($post_id);
                    $response->result['edit_link']=get_edit_post_link($post_id);
                    $response->result['is_updated']='no';

                }    
            }
        }
        
        return $response;
    }
    /*
     * 
     */
    private function isPublishAfter()
    {
        $res=true;
        
        if(isset($this->importSettings['video_published_after']) && !empty($this->importSettings['video_published_after']) )
        {  
            $video_published_after=date('Y-m-d H:i:s',strtotime($this->importSettings['video_published_after']));
            if($this->videoPublishedAt<$video_published_after)
                $res=FALSE;    
        }

        return $res;
    }
    /*
     * 
     */
    public function updatePostSynchronizeVideo($post_id)
    {
        
        $this->titleOptions();
        $this->descriptionOptions();
        $this->embedOptions();   

        $this->initCustomFields($this->templateFields, $this->templateCustomFields);  
        
        remove_filter('content_save_pre', 'wp_filter_post_kses'); 
        remove_filter('content_filtered_save_pre', 'wp_filter_post_kses');
        
        $response= new Response_YVTWP(1,__('Updated the synchronization', 'YVTWP-lang'));
        // Create post object
        $post = array(
            'ID' => $post_id,           
            'post_type' => $this->postType
        );             
        
        if($this->importSettings['enable_title_synchronize'] == 'yes') {
            $post['post_title'] = wp_strip_all_tags($this->title);
        }
        if($this->importSettings['enable_description_synchronize'] == 'yes') {
            $post['post_content'] = $this->postContent;
            $post['post_excerpt'] = $this->postExcerpt;
        }
        if($this->importSettings['enable_categories_synchronize'] == 'yes') {
            $this->setCategories();
            $post['post_category'] = $this->categories;
        }
        if($this->importSettings['enable_tags_synchronize'] == 'yes') {
            $this->setTags();
            $post['tags_input'] = $this->tags;
        }
        
        $wp_error='';
        $result=  wp_update_post($post,TRUE);

        if($result==0 || is_wp_error($result)) //if error
        {
            $response->status=0;
            $response->messages=  __('Error while updating the synchronise post ', 'YVTWP-lang').$result->get_error_data();
        }
        else
        {
            if( $post_id && $this->postType != 'post' ) {
                
                if($this->importSettings['enable_tags_synchronize'] == 'yes') {
                    wp_set_object_terms($post_id,$this->tags,$this->taxonomyTags);
                }
       
                if($this->importSettings['enable_categories_synchronize'] == 'yes' && $this->taxonomyCategories && $this->taxonomyCategories != $this->taxonomyTags)
                {
                    wp_set_object_terms($post_id,$this->categories, $this->taxonomyCategories);  
                }
                
            }
                     
            //add post custom fields
            if($this->importSettings['enable_custom_fields_synchronize'] == 'yes') {
                $this->addPostCustomFields($post_id);
            }
   
            if($this->importSettings['import_video_thumbnail']=='yes' && $this->importSettings['enable_image_synchronize'] == 'yes') {
                Post_YVTWP::deletePostAttachements($post_id);
                $this->uploadThumbnail($post_id);            
            }
                                  
        }    
        
        add_filter('content_save_pre', 'wp_filter_post_kses'); 
        add_filter('content_filtered_save_pre', 'wp_filter_post_kses');
        
        return $response;        
    }
    /*
     * 
     */
    private function updatePost($post_id)
    {
        $response= new Response_YVTWP(1,__('Updated', 'YVTWP-lang'));
        // Create post object
        $post = array(
            'ID'             => $post_id,  
            'post_status'    => $this->postStatus,
            'post_type'      => $this->postType,  
            'post_author'    => $this->postAuthor,
            'post_category'  => $this->categories,
            'tags_input'     => $this->tags            
        );             
        
        $post['post_title'] = wp_strip_all_tags($this->title);
        $post['post_content'] = $this->postContent;
        $post['post_excerpt'] = $this->postExcerpt;
        
        $wp_error='';
        $result=  wp_update_post($post,TRUE);

        if($result==0 || is_wp_error($result)) //if error
        {
            $response->status=0;
            $response->messages=  __('Error while updating the post ', 'YVTWP-lang').$result->get_error_data();
        }
        else
        {
            if($post_id)
                $this->addPostCategoriesAndTags($post_id);
                     
            //add post custom fields
            $this->addPostCustomFields($post_id);
            //set post format
            if($this->postFormat)
                set_post_format ($post_id,$this->postFormat);     

            
            if($this->importSettings['import_video_thumbnail']=='yes') {
                Post_YVTWP::deletePostAttachements($post_id);
                $this->uploadThumbnail($post_id);                
            } else {
                Post_YVTWP::deletePostAttachements($post_id);
            }
                                      
            $response->result['video_title']=$this->videoTitle;
            $response->result['video_key']=$this->videoKey;
            $response->result['post_id']=$post_id;   
            $response->result['view_link']=get_the_permalink($post_id);
            $response->result['edit_link']=get_edit_post_link($post_id);
            $response->result['is_updated']='yes';
            
            if($this->postDate && $this->activeSchedule=='yes')//if schedule is activated
            {   
                $post_date_gmt=get_gmt_from_date($this->postDate);
                $query="UPDATE ".Config_YVTWP::$wpdb_prefixe."posts SET post_status = '{$this->postStatus}',post_date='{$this->postDate}',post_date_gmt='{$post_date_gmt}' WHERE ID={$post_id}";    
                MappingWP_YVTWP::executeSql($query,MappingWP_YVTWP::UPDATE);           
            }                        
        }    
        
        return $response;        
    }
    /*
     * 
     */
    private function addPostCustomFields($post_id)
    {
        //add post custom fields
        foreach ($this->customFields as $key => $value) 
        {
            //serialized value
            if(!is_array($value) && is_array(json_decode(stripslashes($value),TRUE)))
                $value=json_decode(stripslashes($value),TRUE);
            
            if ( ! update_post_meta ($post_id,$key,$value) )  
                add_post_meta($post_id,$key,$value, true );	 
        }        
        
        if($this->allCustomFields_fieldName)
        {          
            $customFieldsClone=$this->customFields;
            
            unset($customFieldsClone['yvtwp_video_datas']);
            unset($customFieldsClone['yvtwp_video_key']);
            unset($customFieldsClone['yvtwp_feed_key']);
            unset($customFieldsClone['yvtwp_import_id']);
            
            update_post_meta($post_id,$this->allCustomFields_fieldName,$customFieldsClone);
        }     
    }
    /*
     * 
     */
    private function addPostCategoriesAndTags($post_id)
    {
        if( $this->taxonomyCategories == $this->taxonomyTags )
        {
            //wp_set_object_terms($post_id, null,$this->taxonomyCategories); //clear/remove all categories from a post
            $mergedTaxonomies = array_unique( array_merge($this->tags, $this->categories) ) ;
            wp_set_object_terms($post_id, $mergedTaxonomies, $this->taxonomyTags);
        }
        else {
            wp_set_object_terms($post_id, $this->tags, $this->taxonomyTags);
            wp_set_object_terms($post_id, $this->categories, $this->taxonomyCategories);   
        }
    }
    /*
     * 
     */
    private function uploadThumbnail($post_id)
    {
        ini_set('max_execution_time',10000);
        $image_url='http://i1.ytimg.com/vi/'.$this->videoKey.'/0.jpg';
        
        $thumbnailsQuality=$this->thumbnailsQuality;        
        if($thumbnailsQuality && $this->$thumbnailsQuality )
        {
            $image_url=$this->$thumbnailsQuality;
        }
        else 
        {
            if($this->thumbnailMaxresUrl)
                $image_url=$this->thumbnailMaxresUrl;
            else             
            if($this->thumbnailStandardUrl)
                $image_url=$this->thumbnailStandardUrl;
            elseif($this->thumbnailHighUrl)
                $image_url=$this->thumbnailHighUrl;
        }                

        if($image_url)
        {
            $upload_dir = wp_upload_dir(); // Set upload folder
            
            //$image_data = file_get_contents($image_url); // Get image data
            $image_data  = wp_remote_get($image_url);
            $image_data = wp_remote_retrieve_body( $image_data );   
            
            $filename   = $this->videoKey.basename($image_url); // Create image file name

            // Check folder permission and define file location
            if( wp_mkdir_p( $upload_dir['path'] ) )
                $file = $upload_dir['path'] . '/' . $filename;
            else
                $file = $upload_dir['basedir'] . '/' . $filename;

            // Create the image  file on the server
            file_put_contents( $file, $image_data );

            // Check image file type
            $wp_filetype = wp_check_filetype( $filename, null );

            // Set attachment data
            $attachment = array(
                'post_mime_type' => $wp_filetype['type'],
                'post_title'     => get_the_title($post_id),
                'post_content'   => get_the_title($post_id),
                'post_status'    => 'inherit'
            );

            // Create the attachment
            $attach_id = wp_insert_attachment( $attachment, $file, $post_id );

            // Include image.php
            require_once(ABSPATH . 'wp-admin/includes/image.php');

            // Define attachment metadata
            $attach_data = wp_generate_attachment_metadata( $attach_id, $file );

            // Assign metadata to attachment
            wp_update_attachment_metadata( $attach_id, $attach_data );

            // And finally assign featured image to post
            set_post_thumbnail( $post_id, $attach_id );      
        }
    }
    /*
     * 
     */
    private function parseTemplate($template, $fields)
    {
        $pattern = "/\{\{(\w+)\}\}/";
        $res = array();

        $object_vars=  get_object_vars($this);
        preg_match_all($pattern, $template, $res, PREG_SET_ORDER);
        
        foreach ($res as $r) 
        {
            $current_field=$fields[$r[1]];
            if (isset($object_vars[$current_field]))  
                $template = str_replace($r[0],$object_vars[$current_field],$template);   
            else
                $template = str_replace($r[0],'', $template);
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