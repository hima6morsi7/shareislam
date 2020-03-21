<div class="tab-pane active" id="tab_feed_options">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Basic Form Elements
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label><?php _e("Feed Title", 'YVTWP-lang') ?></label>
                                        </div>
                                        <div class="col-md-6">
                                            <input class="form-control" name="feed_title">                                                    
                                        </div>
                                        <p class="help-block" style="display: none">
                                            <?php _e("Optional: Use this to remember this import.", 'YVTWP-lang') ?>
                                        </p>                                        
                                    </div>                                            
                                </div>
                            </div>  
                            <div class="col-md-7 sep_video_published_after"></div>
                            <div class="yvtwp_max_feed_results col-md-6">

                                <div class="form-group">
                                    <div class="row"> 
                                        <div class="col-md-6">
                                            <label><?php _e("Max videos to import", 'YVTWP-lang') ?></label>
                                        </div>
                                        <div class="col-md-6 reload_when_select_change">
                                            <input type="number"  min="1" class="form-control" name="max_imported_videos" value="100000">            
                                        </div>
                                    </div>
                                    <p class="help-block"></p>
                                </div>


                            </div>                            
                            <div class="col-md-6">
                                <div class="form-group disabled_part">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label><?php _e("Feed Type", 'YVTWP-lang') ?></label>
                                        </div>
                                        <div class="col-md-6">
                                            <select class="form-control" name="feed_type" id="feed_type">
                                                <?php foreach (Config_YVTWP::$feedType as $key => $value) { ?>
                                                    <option value="<?php echo $key ?>"><?php echo $value?></option>
                                                <?php }  ?>
                                            </select>                                                     
                                        </div>
                                    </div>                                            
                                </div>
                            </div>
                            <div class="col-md-6">
                                <input class="form-control" type="hidden" name="feed_key" required="">
                                <ul class="yvtwp_block_feed disabled_part">
                                    <li class="feed_channel">
                                        <div class="form-group block_channel_id">
                                            <div class="row"> 
                                                <div class="col-md-6">
                                                    <label><?php _e("Chanel ID", 'YVTWP-lang') ?></label>
                                                </div>
                                                <div class="col-md-6">
                                                    <input class="form-control feed_key input_feed_channel" placeholder="<?php _e('Chanel ID', 'YVTWP-lang') ?>" >                                                   
                                                </div>
                                            </div>
                                            <p class="help-block">
                                                <img src="<?php echo Config_YVTWP::$resources_url ?>img/chanel_id.png" />
                                            </p>
                                        </div>
                                    </li>                                             
                                    <li class="feed_playlist">
                                        <div class="form-group block_playlist_id">
                                            <div class="row"> 
                                                <div class="col-md-6">
                                                    <label><?php _e("Playlist ID", 'YVTWP-lang') ?></label>
                                                </div>
                                                <div class="col-md-6">
                                                    <input class="form-control feed_key input_feed_playlist" placeholder="<?php _e('Playlist ID', 'YVTWP-lang') ?>">                                                   
                                                </div>
                                            </div>
                                            <p class="help-block">
                                                <img src="<?php echo Config_YVTWP::$resources_url ?>img/playlist_id.png" />
                                            </p>
                                        </div>
                                    </li>
                                    <li class="feed_user">
                                        <div class="form-group block_user_id">
                                            <div class="row"> 
                                                <div class="col-md-6">
                                                    <label><?php _e("User ID", 'YVTWP-lang') ?></label>
                                                </div>
                                                <div class="col-md-6">
                                                    <input class="form-control feed_key input_feed_user" placeholder="<?php _e('User ID', 'YVTWP-lang') ?>" >                                                   
                                                </div>
                                            </div>
                                            <p class="help-block">
                                                <img src="<?php echo Config_YVTWP::$resources_url ?>img/user_id.png" />
                                            </p>
                                        </div>
                                    </li>
                                    <li class="feed_search_query">
                                        <div class="form-group block_search_query">
                                            <div class="row"> 
                                                <div class="col-md-6">
                                                    <label><?php _e("Search Query", 'YVTWP-lang') ?></label>
                                                </div>
                                                <div class="col-md-6">
                                                    <input class="form-control feed_key input_feed_search_query" placeholder="<?php _e('Search Query', 'YVTWP-lang') ?>">                                                   
                                                </div>
                                            </div>
                                        </div>
                                    </li>  
                                    <li class="feed_single_video">
                                        <div class="form-group block_search_query">
                                            <div class="row"> 
                                                <div class="col-md-6">
                                                    <label><?php _e("Single Video", 'YVTWP-lang') ?></label>
                                                </div>
                                                <div class="col-md-6">
                                                    <input class="form-control feed_key input_feed_single_video" placeholder="<?php _e('Video Key', 'YVTWP-lang') ?>">
                                                </div>
                                            </div>
                                            <p class="help-block">
                                                <img src="<?php echo Config_YVTWP::$resources_url ?>img/youtube_key.png" />
                                            </p>
                                        </div>
                                    </li>                                     
                                </ul> 
                            </div>
                                <div class="col-md-6 import_without_pagination">
                                    <div class="form-group">
                                        <div class="row"> 
                                            <div class="col-md-6">
                                                <label><?php _e("Import type", 'YVTWP-lang') ?></label>
                                            </div>
                                            <div class="col-md-6">
                                                <select class="form-control" name="import_type">
                                                    <?php foreach (Config_YVTWP::$importTypes as $key => $value) { ?>
                                                        <option value="<?php echo $key ?>"><?php echo $value?></option>
                                                    <?php }  ?>                                                    
                                                </select> 
                                                <input type="hidden" name="active_import_schedule" value="no" />
                                                <div class="switch-wrapper scheduled_import_msg" style="margin-top: 5px">
                                                    <input id="checkbox_active_import_schedule" type="checkbox" <?php if(isset($default_settings['active_import_schedule']) && $default_settings['active_import_schedule']=='yes'){echo 'value="1" checked'; } ?> >
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                </div>                             
                                <div class="col-md-6 content_video_published_after">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label><?php _e("Import videos published after", 'YVTWP-lang') ?></label>
                                            </div>
                                            <div class="col-md-6">
                                                <input class="form-control col-md-12" name="video_published_after">   
                                            </div>    
                                        </div>    
                                    </div>                                    
                                </div>                            
                                <div>                                  
                                    <input type="hidden" max="50" min="1" class="form-control" name="max_page_results" value="50"> 
                                    <input type="hidden" name="import_description" />
                                </div>
                            
                                <div class="col-md-12 scheduled_import_msg" style="display: none">
                                        <div class="yvtwp-infos-block">
                                            <p class="help-block"><?php _e('When activating this option, new posted videos are automatically added to your website.', 'YVTWP-lang') ?></p>
                                            <p class="help-block">
                                                <strong><?php _e('Note 1 ','YVTWP-lang') ?></strong> <?php _e(': Make sure that you configured and activated the scheduling import in', 'YVTWP-lang') ?> 
                                                <a href="?page=yvtwp&yvtwp_controller=settings&yvtwp_action=generalSettings&tab=scheduling_settings"><?php _e('Settings => Scheduling settings.', 'YVTWP-lang') ?> </a>
                                            </p>
                                            <p class="help-block" style="display: none">
                                                Youtube videos are automatically added to your website. Also,
                                                <strong><?php _e('Note 2 ','YVTWP-lang') ?></strong><?php _e(': Make sure that the setting "Update if exist" is set to "No" in the tab', 'YVTWP-lang') ?>  
                                                <a class="pointer_general_options"><?php _e('General options', 'YVTWP-lang') ?> </a>
                                                <?php _e(', This will economize your server resources. ', 'YVTWP-lang') ?> 
                                            </p>
                                            <p class="help-block">
                                                <strong><?php _e('Note 2 ','YVTWP-lang') ?></strong><?php _e(': Before setting a schedule import, make sure that you\'re importing all existing videos with a Bulk import and have set the published after date value in the settings above.', 'YVTWP-lang') ?>  
                                                <?php _e(' This will economize your server resources, and the Youtube API quota.', 'YVTWP-lang') ?> 
                                            </p>                                            
                                        </div>
                                </div>                            

                                <div class="yvtwp_filter_and_order reload_when_select_change col-md-12">
                                    <div class="panel panel-default" id="panel3">
                                        <div class="panel-heading" style="padding: 0px">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-target="#collapseThree" href="#collapseThree" class="collapsed" style="display: block;padding: 15px 10px;">
                                                    <?php _e('Advanced Videos Filter', 'YVTWP-lang'); ?>
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseThree" class="panel-collapse collapse" style="height: auto;">
                                            <div class="panel-body">
                                                <div class="row my_first_row">
                                                    <div class="col-md-6" style="border-right: solid 5px;">
                                                        <div class="row">

                                                            <div class="form-group">
                                                                    <div class="col-md-5">
                                                                        <label><?php _e("Published After", 'YVTWP-lang') ?></label>
                                                                    </div>
                                                                    <div class="col-md-7">
                                                                        <input class="form-control col-md-12" name="published_after">   
                                                                    </div>                                     
                                                            </div>   
                                                            <div class="form-group">
                                                                    <div class="col-md-5">
                                                                        <label><?php _e("Published Before", 'YVTWP-lang') ?></label>
                                                                    </div>
                                                                    <div class="col-md-7">
                                                                        <input type="text" class="form-control col-md-12" name="published_before">
                                                                    </div>                                     
                                                            </div>                                                             
                                                            <div class="form-group">
                                                                <div class="col-md-5">
                                                                    <label><?php _e('Order By', 'YVTWP-lang') ?></label>
                                                                </div>
                                                                <div class="col-md-7">
                                                                    <select class="form-control" name="order" >
                                                                        <?php foreach (Config_YVTWP::$order as $key => $value) { ?>
                                                                            <option value="<?php echo $key ?>"><?php echo $value?></option>
                                                                        <?php }  ?>
                                                                    </select>                                                     
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <div class="col-md-5">
                                                                    <label><?php _e('Region Code', 'YVTWP-lang') ?></label>
                                                                </div>
                                                                <div class="col-md-7">
                                                                    <select class="form-control" name="regionCode">
                                                                        <option value=""><?php _e('Select', 'YVTWP-lang') ?></option>
                                                                        <?php foreach ($countries as $key => $country) { ?>
                                                                        <option value="<?php echo $country->Code ?>"><?php echo $country->Name ?></option>
                                                                        <?php } ?>
                                                                    </select>                                            
                                                                </div>
                                                            </div>  
                                                            <div class="form-group">
                                                                <div class="col-md-5">
                                                                    <label><?php _e('Relevance Language', 'YVTWP-lang') ?></label>
                                                                </div>
                                                                <div class="col-md-7">
                                                                    <select class="form-control" name="relevanceLanguage">
                                                                        <option value=""><?php _e('Select', 'YVTWP-lang') ?></option>
                                                                        <?php foreach ($language_codes as $key => $language) { ?>
                                                                        <option value="<?php echo $language->alpha2 ?>"><?php echo $language->English ?></option>
                                                                        <?php } ?>                                                        
                                                                    </select>                                               
                                                                </div>
                                                            </div> 
                                                            <div class="form-group">
                                                                <div class="col-md-5">
                                                                    <label><?php _e('Safe Search', 'YVTWP-lang') ?></label>
                                                                </div>
                                                                <div class="col-md-7">
                                                                    <select class="form-control" name="safeSearch">
                                                                        <?php foreach (Config_YVTWP::$safeSearch as $key => $value) { ?>
                                                                            <option value="<?php echo $key ?>"><?php echo $value?></option>
                                                                        <?php }  ?>
                                                                    </select>                                                     
                                                                </div>
                                                            </div>   
                                                            <div class="form-group" style="display: none">
                                                                <div class="col-md-5">
                                                                    <label><?php _e('Topic ID', 'YVTWP-lang') ?></label>
                                                                </div>
                                                                <div class="col-md-7">
                                                                    <input class="form-control" name="topicId">                                                
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="col-md-5">
                                                                    <label><?php _e('Video Caption', 'YVTWP-lang') ?></label>
                                                                </div>
                                                                <div class="col-md-7">
                                                                    <select class="form-control" name="videoCaption">
                                                                        <?php foreach (Config_YVTWP::$videoCaption as $key => $value) { ?>
                                                                            <option value="<?php echo $key ?>"><?php echo $value?></option>
                                                                        <?php }  ?>
                                                                    </select>
                                                                </div>
                                                            </div>   
                                                            <div class="form-group">
                                                                <div class="col-md-5">
                                                                    <label><?php _e('Video Category', 'YVTWP-lang') ?></label>
                                                                </div>
                                                                <div class="col-md-7">
                                                                    <select class="form-control" name="videoCategoryId"> 
                                                                        <option value=""><?php _e('Select', 'YVTWP-lang') ?></option>
                                                                        <?php foreach ($youtube_categories as $key => $category) { ?>
                                                                        <option value="<?php echo $category['id'] ?>"><?php echo $category['snippet']['title'] ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- part2  -->
                                                    <div class="col-md-6" style="padding-left: 0px">

                                                        <div class="form-group">
                                                            <div class="col-md-5">
                                                                <label><?php _e('Video Definition', 'YVTWP-lang') ?></label>
                                                            </div>
                                                            <div class="col-md-7">
                                                                <select class="form-control" name="videoDefinition">
                                                                    <?php foreach (Config_YVTWP::$videoDefinition as $key => $value) { ?>
                                                                        <option value="<?php echo $key ?>"><?php echo $value?></option>
                                                                    <?php }  ?>
                                                                </select> 
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="col-md-5">
                                                                <label><?php _e('Video Dimension', 'YVTWP-lang') ?></label>
                                                            </div>
                                                            <div class="col-md-7">
                                                                <select class="form-control" name="videoDimension">
                                                                    <?php foreach (Config_YVTWP::$videoDimension as $key => $value) { ?>
                                                                        <option value="<?php echo $key ?>"><?php echo $value?></option>
                                                                    <?php }  ?>
                                                                </select> 
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="col-md-5">
                                                                <label><?php _e('Video Duration', 'YVTWP-lang') ?></label>
                                                            </div>
                                                            <div class="col-md-7">
                                                                <select class="form-control" name="videoDuration">
                                                                    <?php foreach (Config_YVTWP::$videoDuration as $key => $value) { ?>
                                                                        <option value="<?php echo $key ?>"><?php echo $value?></option>
                                                                    <?php }  ?>
                                                                </select> 
                                                            </div>
                                                        </div>  
                                                        <div class="form-group">
                                                            <div class="col-md-5">
                                                                <label><?php _e('Video Embeddable', 'YVTWP-lang') ?></label>
                                                            </div>
                                                            <div class="col-md-7">
                                                                <select class="form-control" name="videoEmbeddable">
                                                                    <?php foreach (Config_YVTWP::$videoEmbeddable as $key => $value) { ?>
                                                                        <option value="<?php echo $key ?>"><?php echo $value?></option>
                                                                    <?php }  ?>
                                                                </select> 
                                                            </div>
                                                        </div>    
                                                        <div class="form-group">
                                                            <div class="col-md-5">
                                                                <label><?php _e('Video License', 'YVTWP-lang') ?></label>
                                                            </div>
                                                            <div class="col-md-7">
                                                                <select class="form-control" name="videoLicense">
                                                                    <?php foreach (Config_YVTWP::$videoLicense as $key => $value) { ?>
                                                                        <option value="<?php echo $key ?>"><?php echo $value?></option>
                                                                    <?php }  ?>
                                                                </select> 
                                                            </div>
                                                        </div>  
                                                        <div class="form-group">
                                                            <div class="col-md-5">
                                                                <label><?php _e('Video Syndicated', 'YVTWP-lang') ?></label>
                                                            </div>
                                                            <div class="col-md-7">
                                                                <select class="form-control" name="videoSyndicated">
                                                                    <?php foreach (Config_YVTWP::$videoSyndicated as $key => $value) { ?>
                                                                        <option value="<?php echo $key ?>"><?php echo $value?></option>
                                                                    <?php }  ?>
                                                                </select> 
                                                            </div>
                                                        </div> 
                                                        <div class="form-group">
                                                            <div class="col-md-5">
                                                                <label><?php _e('Video Type', 'YVTWP-lang') ?></label>
                                                            </div>
                                                            <div class="col-md-7">
                                                                <select class="form-control" name="videoType">
                                                                    <?php foreach (Config_YVTWP::$videoType as $key => $value) { ?>
                                                                        <option value="<?php echo $key ?>"><?php echo $value?></option>
                                                                    <?php }  ?>
                                                                </select> 
                                                            </div>
                                                        </div>
                                                    </div>   
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" style="display: none">
                                    <div class="row"> 
                                        <div class="col-md-5">
                                            <label><?php _e("Comment on this import", 'YVTWP-lang') ?></label>
                                        </div>
                                        <div class="col-md-5">
                                            <input type="text" class="form-control" name="comment_import">                                                   
                                        </div>
                                    </div>
                                    <p class="help-block">
                                        <?php _e('help message', 'YVTWP-lang') ?>
                                    </p>
                                </div>
                        </div>
                        <!-- col-md-12-->
                    </div>
                    <!--row -->
                </div>
                <!-- /panel-body -->
            </div>
            <!-- /panel -->
        </div>
        <!--col-md-12 -->
    </div>

</div>  