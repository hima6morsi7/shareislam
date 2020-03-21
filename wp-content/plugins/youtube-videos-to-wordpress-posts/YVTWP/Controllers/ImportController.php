<?php

class ImportController_YVTWP {
    
    public function indexAction($arg) {   
        
        //video deleted   95IyAhW17Uw
        //video regler  o54IsLenf0M
        $dedVideo= new BrokenVideo_YVTWP('o54IsLenf0M');
        $dedVideo->executeCheck();
        
        
        $default_paged=Config_YVTWP::get('import_paged');
        $listOfImports=array();
                
        $total_results=ImportModel_YVTWP::getTotalResults($arg);
        $datas['feed_type']='feed_channel';
        $total_results_channel=ImportModel_YVTWP::getTotalResults($datas);
        $datas['feed_type']='feed_playlist';
        $total_results_playlist=ImportModel_YVTWP::getTotalResults($datas);   
        $datas['feed_type']='feed_user';
        $total_results_user=ImportModel_YVTWP::getTotalResults($datas);  
        $datas['feed_type']='feed_search_query';
        $total_results_search_query=ImportModel_YVTWP::getTotalResults($datas); 
        $datas['feed_type']='feed_single_video';
        $total_results_single_video=ImportModel_YVTWP::getTotalResults($datas);        
                
        if(ImportModel_YVTWP::getListOfImports($arg)->status==1)
            $listOfImports=ImportModel_YVTWP::getListOfImports($arg)->result;
        
        require_once Config_YVTWP::$views_dir.'youtube/index.php';
    }//End function
    /**
     */
    public function newImportAction($arg)
    {
        $response=new Response_YVTWP(1);
        $feedDatas=array();
        $option_name="yvtwp_default_import_settings";
        $importInfos=array();$import_id='';

        if(isset($arg['import_id']))
        {
            $import_id=$arg['import_id'];
            $option_name="yvtwp_import_settings_".$import_id;
        }
        
        $default_settings=SettingsModel_YVTWP::getOption($option_name,Config_YVTWP::$default_import_setting,TRUE);
        
        if(!isset($default_settings['import_type']) && isset($default_settings['import_without_pagination'])) 
        {
            //old version
            if($default_settings['import_without_pagination']=='yes')
                $default_settings['import_type']='bulk_import';
            else    
                $default_settings['import_type']='paginate_import';         
        }        
        
        if((isset($arg['import_id']) && $default_settings['import_type']=='paginate_import') || (isset($arg['import_id']) && $_REQUEST['paged']==1 && ($default_settings['import_type']=='bulk_import' || $default_settings['import_type']=='scheduled_import') ) )
        {
            $YoutubeAPIVideo_YVTWP= new YoutubeAPIVideo_YVTWP();
            
            $response=$YoutubeAPIVideo_YVTWP->getFeeds($arg);
            if($response->status==1)
                $feedDatas=$response->result;          
        }
        
        
        if(isset($arg['import_id']))
        {
            $importInfos=ImportModel_YVTWP::getImportInfos($import_id)->result[0];   
            $feedPageAttributs=SettingsModel_YVTWP::getOption('yvtwp_feed_page_attributs',Config_YVTWP::$feed_page_attributs,TRUE);       

            $countTmpVideoImported=TmpVideosModel_YVTWP::getCountTmpImportedVideo($import_id);
            $total_results=$importInfos['total_results'];       
        }
        
        
        $arg_=array();
        $postTypes=Post_YVTWP::getListPostTypes($arg_)->result;
        $custom_fields=Post_YVTWP::getListCustomFields($arg_)->result;

        $embed_template_fields=array(''=>'');
        if(isset($default_settings['template_fields']))        
            $embed_template_fields=Utils_YVTWP::getEmbedTemplateFieldsArray($default_settings['template_fields']);
        
        $embed_custom_fields=array();
        if(isset($default_settings['custom_fields']))
            $embed_custom_fields= explode(',', $default_settings['custom_fields']);        
        
        $current_user = wp_get_current_user();
        $available_roles= Post_YVTWP::get_site_available_user_roles();
        $users=  Post_YVTWP::getUsersByRole('');
        $taxonomies=   Post_YVTWP::getTaxonomiesByPostType($default_settings['post_type']);
        
        //get current theme supported formats
        if ( current_theme_supports( 'post-formats' ) ) {
            $post_formats = get_theme_support( 'post-formats' );
            if ( is_array( $post_formats[0] ) )
                $post_formats=$post_formats[0];
        }         
        
        $categories=array();
        if($taxonomies) {
            $categories=   Post_YVTWP::getCategoriesByTaxonomy(reset($taxonomies));     
        }
        
        $countries=  require_once Config_YVTWP::$views_dir.'resources/datas-json/countries.php';
        $countries=$countries->items;
        
        $language_codes=  require_once Config_YVTWP::$views_dir.'resources/datas-json/language-codes-3b2.php';
        $language_codes=$language_codes->items;     
        
        $youtube_categories=  require_once Config_YVTWP::$views_dir.'resources/datas-json/categories_youtube.php';
        $youtube_categories=$youtube_categories['items'];        
        
        //general settings
        $generalSettings=SettingsModel_YVTWP::getGeneralSettings($arg);

        require_once Config_YVTWP::$views_dir.'youtube/new_import.php';
    }  
    public function allSingleVidoesImportAction($arg)
    {
        $response=new Response_YVTWP(1);
        $import_id='0';$listOfAllSingleVideos=array();
        $arg=array('feed_type'=>'feed_single_video');

        $option_name="yvtwp_import_settings_".$import_id;
        
        $default_import_settings=SettingsModel_YVTWP::getOption('yvtwp_default_import_settings',Config_YVTWP::$default_import_setting,TRUE);
        
        $default_settings=SettingsModel_YVTWP::getOption($option_name,$default_import_settings,TRUE);


        $countTmpVideoImported=TmpVideosModel_YVTWP::getCountTmpImportedVideo($import_id);
        $total_results=  ImportModel_YVTWP::getTotalResults($arg);       
        
        $imploded_videos_key=  ImportModel_YVTWP::getAllSingleVideosImplodedKeys();
        
        $arg_=array();
        $postTypes=Post_YVTWP::getListPostTypes($arg_)->result;
        $custom_fields=Post_YVTWP::getListCustomFields($arg_)->result;

        $embed_template_fields=array(''=>'');
        if(isset($default_settings['template_fields']))
            $embed_template_fields=  explode(',',$default_settings['template_fields']);
        
        $embed_custom_fields=array();
        if(isset($default_settings['custom_fields']))
            $embed_custom_fields= explode(',', $default_settings['custom_fields']);        
        
        $current_user = wp_get_current_user();
        $available_roles= Post_YVTWP::get_site_available_user_roles();
        $users=  Post_YVTWP::getUsersByRole('');
        $taxonomies=   Post_YVTWP::getTaxonomiesByPostType($default_settings['post_type']);
        
        //get current theme supported formats
        if ( current_theme_supports( 'post-formats' ) ) {
            $post_formats = get_theme_support( 'post-formats' );
            if ( is_array( $post_formats[0] ) )
                $post_formats=$post_formats[0];
        }         
        
        $categories=array();
        if($taxonomies)
        $categories=   Post_YVTWP::getCategoriesByTaxonomy(reset($taxonomies));     
        
        $countries=  require_once Config_YVTWP::$views_dir.'resources/datas-json/countries.php';
        $countries=$countries->items;
        
        $language_codes=  require_once Config_YVTWP::$views_dir.'resources/datas-json/language-codes-3b2.php';
        $language_codes=$language_codes->items;     
        
        $youtube_categories=  require_once Config_YVTWP::$views_dir.'resources/datas-json/categories_youtube.php';
        $youtube_categories=$youtube_categories['items'];        
        
        //general settings
        $generalSettings=SettingsModel_YVTWP::getGeneralSettings($arg);

        require_once Config_YVTWP::$views_dir.'youtube/all_single_videos_import.php';
    }     
    /*
     * 
     */
    public function importAllSingleVideosAction($arg)
    {
        $response=new Response_YVTWP(1);
        $import_status='pendding';$result=array();$reste_videos=array();
        $import_id=0;
        
        if(!empty($arg['selected_videos_id_copier']))
            $reste_videos=explode(',',$arg['selected_videos_id_copier']);
        
        $import_settings=SettingsModel_YVTWP::getOption("yvtwp_import_settings_0",Config_YVTWP::$default_import_setting,TRUE);
        
        $video_key=$arg['selected_videos_id'];
        if(!empty($video_key))
        {
            $arg['feed_key']=$video_key;
            $arg['import_id']=  ImportModel_YVTWP::getImportIdByFeedKey($video_key);
            $YoutubeAPIVideo_YVTWP=new YoutubeAPIVideo_YVTWP();
            $response=$YoutubeAPIVideo_YVTWP->getFeedsForSingleVideo($arg,$import_settings);
            
            if($response->status==1 && isset($response->result[0]))
            {
                $nextVideoId=$response->result[0]['id'];
                $videoToPost= new VideoToPost_YVTWP($import_id,$nextVideoId);
                $result_import[]=$videoToPost->execute();
                $result['result_import']=$result_import; 
                $response->messages='';                  
            }
        }
        else
        {
            $import_status='end';
            $response->messages=__('Done importing videos.','YVTWP-lang');
        }

        $result['TmpImportedVideo']=ImportModel_YVTWP::getTotalResults(array('feed_type'=>'feed_single_video'))-count($reste_videos);
        $result['import_status']=$import_status;
        $response->result=$result;
        
        return $response;
    } 
    /*
     * 
     */
    public function importSynchronizeVideo($post_id,$import_settings,$import_id,$video_key)
    {
        $response=new Response_YVTWP(1);
        $result=array();
        
        $import_settings['update_if_exist'] = 'yes';
        $arg['feed_key'] = $video_key;
        $arg['import_id'] =  $import_id;
        $YoutubeAPIVideo_YVTWP = new YoutubeAPIVideo_YVTWP();
        $response = $YoutubeAPIVideo_YVTWP->getFeedsForSynchroniseVideo($arg,$import_settings);

        if($response->status==1 && $response->result) {
            $nextVideoId = $response->result;
            $videoToPost = new VideoToPost_YVTWP($import_id,$nextVideoId);
            $response = $videoToPost->updatePostSynchronizeVideo($post_id);                 
        }
        
        return $response;
    }    
    /*
     * 
     */
    public function saveImportSettingsAllSingleVideosAction($arg)
    {
        unset($arg['action']);
        unset($arg['yvtwp_controller']);
        unset($arg['yvtwp_action']);
        
        if(isset($arg['clear_comments_cache']) && $arg['clear_comments_cache']==1)
        {
            $listOfAllsingleVideos=  ImportModel_YVTWP::getAllImportSingleVideosIds();
            if(is_array($listOfAllsingleVideos->result))
            {
                foreach ($listOfAllsingleVideos->result as $value) {
                    TmpCommentModel_YVTWP::clearCache(array('import_id'=>$value['id']));
                }
            }   
        }
        
        $arg['feed_key']='all_single_videos';
        $res=SettingsModel_YVTWP::setOption('yvtwp_import_settings_0',$arg,TRUE);
        
        return new Response_YVTWP(1);
    }    
    /**
     * 
     * @param type $arg
     */
    public function saveImportSettingsAction($arg)
    {
        $response=new Response_YVTWP(1);
        if(!empty($arg['published_after']) && !empty($arg['published_before']))
        {
            $published_after=strtotime($arg['published_after']);
            $published_before=strtotime($arg['published_before']);
            if($published_after>=$published_before)
                return new Response_YVTWP (0,__('Published after date must be less than the published before date', 'YVTWP-lang'));
        }

        if(ImportModel_YVTWP::existFeedKey($arg['feed_key']) && empty($arg['import_id']))
        {
            $message_r=__('This import already exist','YVTWP-lang');
            if(ImportModel_YVTWP::getLoadLinkByFeedKey($arg['feed_key']))
                $message_r=$message_r.' <a href="'.ImportModel_YVTWP::getLoadLinkByFeedKey($arg['feed_key']).'">'.__('Load','YVTWP-lang').'<a>';
            
            return new Response_YVTWP($status=0,$message_r);
        }

        if(empty($arg['import_id'])) //check feed key when created import
        {
            $YoutubeAPIVideo_YVTWP= new YoutubeAPIVideo_YVTWP();
            $response=$YoutubeAPIVideo_YVTWP->existFeedKey($arg);
        }            

        if($response->status==1)
        {
            $response=ImportModel_YVTWP::saveImportSettings($arg);
            if(empty($arg['import_id']) && isset($response->result['import_id']))
                $arg['import_id']=$response->result['import_id'];            
            
            if(isset($arg['clear_comments_cache']) && $arg['clear_comments_cache']==1)
                TmpCommentModel_YVTWP::clearCache(array('import_id'=>$arg['import_id']));

            if($arg['feed_type']!='feed_single_video' && $arg['reload_when_select_change']==1 && !empty($arg['import_id'])) //when change feed options
            {
                $result=array();
                $result['redirect']='?page=yvtwp&yvtwp_controller=import&yvtwp_action=newImport&paged=1&import_id='.$arg['import_id'];
                $response->messages=__('You\'ll be redirected in a moment', 'YVTWP-lang'); 
                $response->result=$result;

                if(isset($arg['clear_cache']) && $arg['clear_cache']==1)
                    $this->clearCacheAction(array('import_id'=>$arg['import_id']));                                                   
            }
            else if($arg['feed_type']=='feed_single_video') //single video
                $response=$this->saveImportSettingsSingleVideo($arg);
        }
        
        return $response;
    } 
    /*
     * 
     */
    public function saveImportSettingsSingleVideo($arg)
    {
        $YoutubeAPIVideo_YVTWP= new YoutubeAPIVideo_YVTWP();
        $response=$YoutubeAPIVideo_YVTWP->getFeedsForSingleVideo($arg);

        if($response->status==1 && isset($response->result[0]['id']))
        {
            $arg['tmp_video_id']=$response->result[0]['id'];
            $response=$this->importSingleVideoAction($arg);           
            if($response->status==1)
            {
                $response->result['import_id']=$arg['import_id'];

                $comments_link='';
                if($response->result['comment_count']!=0)
                    $comments_link='<a target="_blanck" href="'.get_comments_link($response->result['post_id']).'">'.__('Comments', 'YVTWP-lang').'['.$response->result['comment_count'].']'.'</a>';

                $youtube_video_link='<a target="_blanck" href="https://www.youtube.com/watch?v='.$response->result['video_key'].'">'.__('View on Youtube', 'YVTWP-lang').'</a>';
                $site_video_link='<a target="_blanck" href="'.get_site_url().'?p='.$response->result['post_id'].'">'.__('View on website', 'YVTWP-lang').'</a>';
                $edit_link='<a target="_blanck" href="'.get_edit_post_link($response->result['post_id']).'">'.__('Edit', 'YVTWP-lang').'</a>';

                $response->messages=__('Video imported succefully', 'YVTWP-lang').$youtube_video_link.$site_video_link.$edit_link.$comments_link;

                if($response->status==0)
                    $response->messages=__('Video skipped [Exist]', 'YVTWP-lang').$youtube_video_link.$site_video_link.$edit_link.$comments_link;  
            }
        } 
        
        return $response;
    }

    /**
     * 
     */
    public function importSingleVideoAction($arg)
    {
        $videoToPost= new VideoToPost_YVTWP($arg['import_id'],$arg['tmp_video_id']);

        return $videoToPost->execute(); 
    }    
    /**
     * 
     */
    public function importSelectedVideosAction($arg)
    {
        $response=new Response_YVTWP(1);$result=array();
        
        $skip_add_new=NULL;
        $max_videos_to_import=100000;$arg['pageToken']='';$import_status='pendding';$result=array();
        
        $import_settings=SettingsModel_YVTWP::getOption("yvtwp_import_settings_".$arg['import_id'],'',TRUE);
        if(isset($import_settings['max_imported_videos']) && !empty($import_settings['max_imported_videos']))
            $max_videos_to_import=(int)$import_settings['max_imported_videos'];
        
        $is_max_import=Post_YVTWP::getPostsCountByImportId($arg['import_id'])>=$max_videos_to_import;
        
        if($is_max_import && $import_settings['update_if_exist']=='no')
        {
            $response->messages=__("you have attaint Max videos ", 'YVTWP-lang').$max_videos_to_import; 
            $response->result=array('import_status'=>'end');
        }
        else
        {
            if($is_max_import)
                $skip_add_new=1; 
            
            $videoToPost= new VideoToPost_YVTWP($arg['import_id'],$arg['selected_videos_id'],$skip_add_new);
            $responsePost=$videoToPost->execute();
            $result[]=$responsePost;

            $response->messages=__('Last video Processed => ', 'YVTWP-lang').$videoToPost->videoTitle;
            $response->result=$result;
        }
        
        return $response; 
    }  
    /*
     * 
     */
    public function importAllFeedVideosAction($arg)
    {
        $response=new Response_YVTWP(1);
        $skip_add_new=NULL;
        $max_videos_to_import=100000;$arg['pageToken']='';$import_status='pendding';$result=array();
        
        $import_settings=SettingsModel_YVTWP::getOption("yvtwp_import_settings_".$arg['import_id'],'',TRUE);
        if(isset($import_settings['max_imported_videos']) && !empty($import_settings['max_imported_videos']))
            $max_videos_to_import=(int)$import_settings['max_imported_videos'];
        
        $is_max_import=Post_YVTWP::getPostsCountByImportId($arg['import_id'])>=$max_videos_to_import;
        
        if($is_max_import && $import_settings['update_if_exist']=='no')
        {
            $import_status='end';
            $response->messages=__("Done importing videos, Max imported videos excessed", 'YVTWP-lang').$max_videos_to_import;            
        }
        else
        {
            $response=ImportModel_YVTWP::getImportInfos($arg['import_id']);

            if(isset($response->result[0]))
            {
                $importInfo=$response->result[0]; 
                $arg['paged']=$importInfo['current_paged'];

                $nextVideoId=TmpVideosModel_YVTWP::getNextVideoIdToImport($arg['import_id']);
                
                if(ImportModel_YVTWP::getNextPageToken($arg['import_id']))
                    $arg['pageToken']=ImportModel_YVTWP::getNextPageToken($arg['import_id']);

                if(!$nextVideoId)
                {
                    $YoutubeAPIVideo_YVTWP= new YoutubeAPIVideo_YVTWP();
                    $response=$YoutubeAPIVideo_YVTWP->getFeeds($arg);
                    
                    $nextVideoId=TmpVideosModel_YVTWP::getNextVideoIdToImport($arg['import_id']);
                }

                if($nextVideoId)
                {
                    if($is_max_import)
                        $skip_add_new=1;

                    $videoToPost= new VideoToPost_YVTWP($arg['import_id'],$nextVideoId,$skip_add_new);
                    $result_import[]=$videoToPost->execute();
                    $result['result_import']=$result_import;
                    ImportModel_YVTWP::updateLastAutoVideoImported(array('last_auto_video_imported'=>$nextVideoId,'import_id'=>$arg['import_id']));   
                    $response->messages='';
                }  

                if(!$nextVideoId) //end of import
                {    
                    $import_status='end';
                    $response->messages=__("Bulk import has been finished", 'YVTWP-lang');
                    if(TmpVideosModel_YVTWP::getCountTmpImportedVideo($arg['import_id'])>=500 && $import_settings['feed_type']=='feed_search_query' && $max_videos_to_import>500)
                    {
                        $response->messages=__("Youtube API v3 limits the number of paginated results in the search query to 500, you can check this <a target='_blank' href='https://code.google.com/p/gdata-issues/issues/detail?id=4282'>link</a> for info on the issue.", 'YVTWP-lang');
                    }
                }
                if(isset($import_settings['video_published_after']) && !empty($import_settings['video_published_after']) )
                {  
                    $video_published_after=date('Y-m-d H:i:s',strtotime($import_settings['video_published_after']));
                    if($videoToPost->videoPublishedAt<$video_published_after)
                    {
                        if(($import_settings['order']=='date' && $import_settings['feed_type']=='feed_search_query') || ($import_settings['feed_type']!='feed_search_query' && $import_settings['feed_type']!='feed_playlist'))
                        {    
                            $arg['paged']=0;
                            $objectImportController=new ImportController_YVTWP();
                            $objectImportController->clearCacheAction($arg);
                            
                            $import_status='end';
                            $response->messages=__("Bulk import has been stopped because there are no more videos after this date ", 'YVTWP-lang').$import_settings['video_published_after'];                              
                        }                     
                    }  
                }                  
            }
        }
        
        //$result['TmpImportedVideo']=TmpVideosModel_YVTWP::getCountTmpImportedVideo($arg['import_id']);
        $result['TmpImportedVideo']=Post_YVTWP::getPostsCountByImportId($arg['import_id']);
        $result['import_status']=$import_status;
        $response->result=$result;
        $videoToPost=NULL;
        
        return $response;
    }
    public function index2Action($arg) {   
		self::importSchedulingVideos();
	}    
    public static function importSchedulingVideos()
    {
        $import_id=ImportModel_YVTWP::getImportIdToCheckNewsVideos();
           
        if($import_id)
        {
            $skip_add_new=NULL;$max_videos_to_import=100000;$arg['pageToken']='';$result_import=array();$logType='scheduling_videos_import';
            
            $importInfo=ImportModel_YVTWP::getImportInfos($import_id)->result[0];
            $import_settings=SettingsModel_YVTWP::getOption("yvtwp_import_settings_".$import_id,'',TRUE);
            if(isset($import_settings['max_imported_videos']) && !empty($import_settings['max_imported_videos']))
                $max_videos_to_import=(int)$import_settings['max_imported_videos'];

            if(Post_YVTWP::getPostsCountByImportId($import_id)>=$max_videos_to_import && Config_YVTWP::get('enable_scheduling_max_videos')=='yes')
            {
                $response=new Response_YVTWP(1,$import_settings['feed_key'].__(" => Done importing videos, Max imported videos excessed", 'YVTWP-lang').$max_videos_to_import); 
                $dataLog=array('import_id'=>$import_id,'log_type'=>'scheduling_msg_import','response'=>$response);
                LogModel_YVTWP::insertLog($dataLog);                
            }            
            else
            {
                $YoutubeAPIVideo_YVTWP= new YoutubeAPIVideo_YVTWP();
                $totalResults=$YoutubeAPIVideo_YVTWP->getFeedsTotalResults($import_id);   
                $totalExistVideos=(int)Post_YVTWP::getPostsCountByImportId($import_id);

                if($totalExistVideos<$totalResults)
                {  
                    $arg['paged']=$importInfo['current_paged'];
                    $arg['import_id']=$import_id;
   
                    if(ImportModel_YVTWP::getNextPageToken($import_id))
                        $arg['pageToken']=ImportModel_YVTWP::getNextPageToken($import_id);

                    if($arg['pageToken'] || $arg['paged']==1)
                    {
                        $YoutubeAPIVideo_YVTWP= new YoutubeAPIVideo_YVTWP();
                        $response=$YoutubeAPIVideo_YVTWP->getFeeds($arg);
                        if($response->status==1 && is_array($response->result))
                        {
                            foreach($response->result as $key => $value) 
                            {                                  
                                $videoToPost= new VideoToPost_YVTWP($import_id,$value['id']);
                                $videoToPost->isSchedulingImport=TRUE;

                                if(isset($import_settings['video_published_after']) && !empty($import_settings['video_published_after']) )
                                {  
                                    $video_published_after=date('Y-m-d H:i:s',strtotime($import_settings['video_published_after']));
                                    if($videoToPost->videoPublishedAt<$video_published_after)
                                    {
                                        $skip_add_new=1;
                                        if(($import_settings['order']=='date' && $import_settings['feed_type']=='feed_search_query') || ($import_settings['feed_type']!='feed_search_query' && $import_settings['feed_type']!='feed_playlist'))
                                        {    
                                            $arg['paged']=0;
                                            $objectImportController=new ImportController_YVTWP();
                                            $objectImportController->clearCacheAction($arg);
                                            break;
                                        }
                                    }  
                                }                                
                                        
                                $videoToPost->skip_add_new=$skip_add_new;
                                $responseVideoToPost=$videoToPost->execute($logType);

                                if($import_settings['feed_type'] !='feed_playlist' && isset($responseVideoToPost->result['is_exist']) && $responseVideoToPost->result['is_exist']=='yes')
                                {
                                    $arg['paged']=0;
                                    $objectImportController=new ImportController_YVTWP();
                                    $objectImportController->clearCacheAction($arg);
                                    break;
                                }                                

                                $arg2=array('last_auto_video_imported'=>$value['id'],'import_id'=>$import_id);
                                ImportModel_YVTWP::updateLastAutoVideoImported($arg2);  
                                $videoToPost=NULL;
                                $skip_add_new=NULL;
                            }
                            ImportModel_YVTWP::updateCurrentPaged($arg['paged']+1,$import_id);
                        }
                    }
                    if(!$arg['pageToken'] && $arg['paged']!=1) //end of import
                    {   
                        $objectImportController=new ImportController_YVTWP();
                        $objectImportController->clearCacheAction($arg);
                    }   
                }
            }
            
            ImportModel_YVTWP::updateLastScheduleCheckDate(date("Y-m-d H:i:s",time()),$import_id);
        }
    }
    /*
     * 
     */
    public static function importVideoComments($post_id,$importId,$importSettings,$videoKey,$isSchedule=NULL)
    {
        ini_set('max_execution_time',0);
        
        if($importSettings['enable_comments_import']=='yes')
        {
            $maxComments=(int)$importSettings['max_comments_import'];
            if($maxComments==0)
                $maxComments=50000;
            
            $paged=TmpVideosModel_YVTWP::getCurrentPagedComment($post_id);
            $pageToken=TmpVideosModel_YVTWP::getNextPageTokenComment($post_id);
               
            while(($pageToken && Comment_YVTWP::getCommentsCountByVideoKey($videoKey)<$maxComments) || $paged==1) 
            {
                $arg=array('import_id'=>$importId,'video_key'=>$videoKey,'paged'=>$paged,'pageToken'=>$pageToken);
                $YoutubeAPIComment_YVTWP=new YoutubeAPIComment_YVTWP();
                $response=$YoutubeAPIComment_YVTWP->getFeeds($arg,$importSettings,$isSchedule);

                if(is_array($response->result))
                {
                    foreach ($response->result as $tmpComment) 
                    { 
                        if(Comment_YVTWP::getCommentsCountByVideoKey($videoKey)>=$maxComments)
                            break 2; 

                        $comment=new VideoCommentToPostComment_YVTWP($post_id,$videoKey,$importSettings,$tmpComment,NULL);                    
                        $responseParent=$comment->execute();
                        if($responseParent->status==1)
                        {
                            $comment_parent=$responseParent->result['comment_id'];

                            if(!empty($importSettings['comment_published_after']))
                            {
                                $comment_published_after=date('Y-m-d H:i:s',strtotime($importSettings['comment_published_after']));
                                if($comment->commentPublishedAt<$comment_published_after)
                                {
                                    TmpCommentModel_YVTWP::clearCache(array('import_id'=>$importId),$post_id);
                                    break 2;
                                }
                            }                           
                            
                            $commentDatas=json_decode($tmpComment['comment_datas'],TRUE);
                            if(isset($commentDatas['replies']) && $comment_parent && $importSettings['import_comments_replies']=='yes')
                            {
                                $counter_imported_replies=0;
                                $max_comment_replies=$importSettings['max_comments_replies'];  

                                foreach ($commentDatas['replies']['comments'] as $tmpCommentReply) 
                                {
                                    if(Comment_YVTWP::getCommentsCountByVideoKey($videoKey)>=$maxComments)
                                        break 3;                                

                                    if($counter_imported_replies>=$max_comment_replies)                                       
                                        break;

                                    $tmp_comments_datas=array('import_id'=>$importId,'video_key'=>$videoKey,'comment_datas'=>json_encode($tmpCommentReply),'paged'=>$paged,'page_token'=>$pageToken);
                                    $response=TmpCommentModel_YVTWP::insertCommentsFeed($tmp_comments_datas);    

                                    if($response->status==1)
                                    {
                                        $tmp_comments_datas['id']=$response->result;
                                        $commentReply=new VideoCommentToPostComment_YVTWP($post_id,$videoKey,$importSettings,$tmp_comments_datas,$comment_parent);    
                                        $commentReply->execute();                                  
                                    } 

                                    $counter_imported_replies=$counter_imported_replies+1;
                                }
                            }
                            
                            if($isSchedule && isset($responseParent->result['is_updated']) && $responseParent->result['is_updated']=='yes')
                            {
                                TmpCommentModel_YVTWP::clearCache(array('import_id'=>$importId),$post_id);
                                break 2;
                            }                            
                        }
                    }    
                }
                    
                $paged=$paged+1;
                if($YoutubeAPIComment_YVTWP->searchResponse)
                    $YoutubeAPIComment_YVTWP->updateTmpVideoInfos($post_id);
                
                $pageToken=TmpVideosModel_YVTWP::getNextPageTokenComment($post_id); 
                    
                //one check and exit
                if($isSchedule)
                    break;
            }
            
            if((!$isSchedule && $importSettings['enable_comments_synced']=='yes') || !$pageToken)
                TmpCommentModel_YVTWP::clearCache(array('import_id'=>$importId),$post_id);

        }        
    }
    /*
     * 
     */
    public function checkAutoImportResultAction($arg)
    {
        $response=new Response_YVTWP(1, '', NULL);

        $result['TmpImportedVideo']=TmpVideosModel_YVTWP::getCountTmpImportedVideo($arg['import_id']);
        $response->result=$result;              
      
        return $response;
    }
    /**
     * 
     */
    public function clearCacheAction($arg)
    {
        ini_set('max_execution_time', 0);
        
        $response = ImportModel_YVTWP::clearCacheImport($arg);

        return $response;
    }    
    /**
     * 
     */
    public function deleteAction($arg)
    {
        ini_set('max_execution_time', 0);
        
        $response = ImportModel_YVTWP::deleteImport($arg);
        if($response->status==1)
            $response=$this->clearCacheAction($arg);
        
        return $response;
    }
    
    
}
?>