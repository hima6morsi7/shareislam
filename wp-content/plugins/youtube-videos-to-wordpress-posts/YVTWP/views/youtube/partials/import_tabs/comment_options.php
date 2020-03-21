<div class="tab-pane" id="tab_comment_options">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Basic Form Elements
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label><?php _e("Enable comments import", 'YVTWP-lang') ?></label>
                                        </div>
                                        <div class="col-md-3">
                                            <select class="form-control" name="enable_comments_import">
                                                <option value="no"><?php _e("No", 'YVTWP-lang') ?></option>
                                                <option value="yes"><?php _e("Yes", 'YVTWP-lang') ?></option>
                                            </select>                                                   
                                        </div>
                                    </div>                                            
                                </div>
                            </div>      
                            
                            <div class="import_comments_config">                                
                                
                                <div class="col-md-6">
                                    <div class="form-group disabled_part">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label><?php _e("Set comment status to", 'YVTWP-lang') ?></label>
                                            </div>
                                            <div class="col-md-6">
                                                <select class="form-control" name="comment_status">
                                                    <?php foreach (Config_YVTWP::$commentStatus as $key => $value) { ?>
                                                        <option value="<?php echo $key ?>"><?php echo $value?></option>
                                                    <?php }  ?>
                                                </select>                                                     
                                            </div>
                                        </div>                                            
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="row"> 
                                            <div class="col-md-6">
                                                <label><?php _e("Set Comment type to", 'YVTWP-lang') ?></label>
                                            </div>
                                            <div class="col-md-6">
                                                <input class="form-control" name="comment_type" value="" />
                                            </div>
                                        </div>
                                    </div> 
                                </div> 
                                
                                <div class="col-md-6">
                                    <div class="form-group disabled_part">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label><?php _e("Comment author url", 'YVTWP-lang') ?></label>
                                            </div>
                                            <div class="col-md-6">
                                                <select class="form-control" name="comment_author_url">
                                                    <?php foreach (Config_YVTWP::$commentAuthorUrl as $key => $value) { ?>
                                                        <option value="<?php echo $key ?>"><?php echo $value?></option>
                                                    <?php }  ?>
                                                </select>                                                     
                                            </div>
                                        </div>                                            
                                    </div>
                                </div>  
                                
                                <div class="col-md-6">
                                    <div class="form-group disabled_part">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label><?php _e("Comment date", 'YVTWP-lang') ?></label>
                                            </div>
                                            <div class="col-md-6">
                                                <select class="form-control" name="comment_date">
                                                    <?php foreach (Config_YVTWP::$commentDate as $key => $value) { ?>
                                                        <option value="<?php echo $key ?>"><?php echo $value?></option>
                                                    <?php }  ?>
                                                </select>                                                     
                                            </div>
                                        </div>                                            
                                    </div>
                                </div>                                 
                                
                                <div class="col-md-12">
                                    <p class="yvtwp_comment_filter_title"><?php _e("Youtube comments filter", 'YVTWP-lang') ?></p>
                                </div>
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <div class="row"> 
                                            <div class="col-md-6">
                                                <label><?php _e("Max imported comments", 'YVTWP-lang') ?></label>
                                            </div>
                                            <div class="col-md-6 clear_comments_cache">
                                                <input type="number" min="1" class="form-control" name="max_comments_import" value="100">                                                   
                                            </div>
                                        </div>
                                        <p class="help-block"></p>
                                    </div> 

                                </div> 
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label><?php _e("Import comment replies", 'YVTWP-lang') ?></label>
                                            </div>
                                            <div class="col-md-3 clear_comments_cache">
                                                <select class="form-control" name="import_comments_replies">
                                                    <option value="no"><?php _e("No", 'YVTWP-lang') ?></option>
                                                    <option value="yes"><?php _e("Yes", 'YVTWP-lang') ?></option>
                                                </select>                                                   
                                            </div>
                                            <div class="col-md-3 import_comments_replies_disabled">
                                                <input type="number" class="form-control" name="max_comments_replies" placeholder="<?php _e("Max", 'YVTWP-lang') ?>" value="5" />
                                            </div>
                                        </div>                                            
                                    </div>
                                </div>                                  
                                <div class="col-md-6">
                                    <div class="form-group disabled_part">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label><?php _e("Order by", 'YVTWP-lang') ?></label>
                                            </div>
                                            <div class="col-md-6 clear_comments_cache">
                                                <select class="form-control" name="comment_oreder_by">
                                                    <?php foreach (Config_YVTWP::$commentOrder as $key => $value) { ?>
                                                        <option value="<?php echo $key ?>"><?php echo $value?></option>
                                                    <?php }  ?>
                                                </select>                                                     
                                            </div>
                                        </div>    
                                    </div>
                                </div> 
                                <div class="col-md-6">
                                    <div class="form-group disabled_part">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label><?php _e("Comment text format", 'YVTWP-lang') ?></label>
                                            </div>
                                            <div class="col-md-6 clear_comments_cache">
                                                <select class="form-control" name="comment_text_format">
                                                    <?php foreach (Config_YVTWP::$commentFormat as $key => $value) { ?>
                                                        <option value="<?php echo $key ?>"><?php echo $value?></option>
                                                    <?php }  ?>
                                                </select>                                                     
                                            </div>
                                        </div>                                            
                                    </div>
                                </div> 
                                <div class="col-md-6">
                                    <div class="form-group disabled_part">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label><?php _e("Search term", 'YVTWP-lang') ?></label>
                                            </div>
                                            <div class="col-md-6">
                                                <input class="form-control" name="comment_search_term" placeholder="term1,term2,term3">                                                   
                                            </div>
                                        </div> 
                                        <p class="help-block">
                                            <?php _e("Import comments that contain a specified term.", 'YVTWP-lang') ?>
                                        </p>                                            
                                    </div>
                                </div>  
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label><?php _e("Comment Published After", 'YVTWP-lang') ?></label>
                                            </div>
                                            <div class="col-md-6">
                                                <input class="form-control col-md-12" name="comment_published_after">   
                                            </div>    
                                        </div>    
                                    </div>                                    
                                </div>
                            
                                <div class="col-md-12">
                                    <p class="yvtwp_comment_filter_title"><?php _e("Comments synchronization", 'YVTWP-lang') ?></p>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label><?php _e("Enable comments synchronization", 'YVTWP-lang') ?></label>
                                            </div>
                                            <div class="col-md-6 clear_comments_cache">
                                                <select class="form-control" name="enable_comments_synced">
                                                    <option value="no"><?php _e("No", 'YVTWP-lang') ?></option>
                                                    <option value="yes"><?php _e("Yes", 'YVTWP-lang') ?></option>
                                                </select>                                                   
                                            </div>
                                        </div>                                            
                                    </div>
                                </div>
                                <div class="col-md-4 enable_comments_synced_disabled">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-7">
                                                <label><?php _e("Max checks per day for evry video comments", 'YVTWP-lang') ?></label>
                                            </div>
                                            <div class="col-md-5">
                                                <input type="number" max="10" min="1" class="form-control" name="comment_max_check_per_day" value="2">                                                
                                            </div>
                                        </div>                                            
                                    </div>
                                </div> 
                                <div class="col-md-4 enable_comments_synced_disabled">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-7">
                                                <label><?php _e("Time to wait between every check (by hours)", 'YVTWP-lang') ?></label>
                                            </div>
                                            <div class="col-md-5">
                                                <input type="number" max="12" min="0" class="form-control" name="commentsHourBetweenEveryCheck" value="1">                                                
                                            </div>
                                        </div>                                            
                                    </div>
                                </div>                                 
                                <div class="col-md-12">
                                    <p>
                                        <?php _e("You can keep comments synced to your website, similar to the sync option we use on videos. We will check for new posted comments every time a user visit the video page on your website, and you can set a limit to the number of checks per day.", 'YVTWP-lang') ?>
                                    </p>
                                </div>

                                <input type="hidden" name="moderation_status" />

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