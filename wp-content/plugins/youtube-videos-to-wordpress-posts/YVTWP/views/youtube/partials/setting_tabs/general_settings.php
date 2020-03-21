<div class="tab-pane active" id="tab_general_settings">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-10">

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-5">
                                            <label><?php _e("Activate Envato Plugin Update", 'YVTWP-lang') ?></label>
                                        </div>
                                        <div class="col-lg-4">
                                            <select class="form-control" name="active_envato_plugin_update">
                                                <option value="yes"><?php _e('Yes', 'YVTWP-lang') ?></option>
                                                <option value="no"><?php _e('No', 'YVTWP-lang') ?></option>
                                            </select>                                                    
                                        </div>
                                    </div>   
                                    <div style="font-weight: bold">
                                        <?php _e('To use this option you should install', 'YVTWP-lang') ?>
                                        <a target="_black" href="https://github.com/envato/envato-wordpress-toolkit">
                                            <?php _e('the Envato WordPress Toolkit plugin.', 'YVTWP-lang') ?>
                                        </a> 
                                    </div>
                                </div>                                         
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-5">
                                            <label><?php _e("Activate error logging", 'YVTWP-lang') ?></label>
                                        </div>
                                        <div class="col-lg-4">
                                            <select class="form-control" name="active_error_logging">
                                                <option value="yes"><?php _e('Yes', 'YVTWP-lang') ?></option>
                                                <option value="no"><?php _e('No', 'YVTWP-lang') ?></option>
                                            </select>                                                    
                                        </div>
                                    </div>                                                  
                                </div>                                        
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-5">
                                            <label><?php _e("Activate Youtube API error logging", 'YVTWP-lang') ?></label>
                                        </div>
                                        <div class="col-lg-4">
                                            <select class="form-control" name="active_youtube_api_details_errors">
                                                <option value="yes"><?php _e('Yes', 'YVTWP-lang') ?></option>
                                                <option value="no"><?php _e('No', 'YVTWP-lang') ?></option>
                                            </select>                                                    
                                        </div>
                                    </div>                                                  
                                </div>

                                <div class="form-group" style="display: none">
                                    <div class="row">
                                        <div class="col-lg-5">
                                            <label><?php _e("AJAX request type", 'YVTWP-lang') ?></label>
                                        </div>
                                        <div class="col-lg-4">
                                            <select class="form-control" name="ajax_request">
                                                <option value="yvtwp"><?php _e('yvtwp', 'YVTWP-lang') ?></option>
                                                <option value="wp"><?php _e('wp', 'YVTWP-lang') ?></option>
                                            </select>                                                    
                                        </div>
                                    </div>                                                  
                                </div> 
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-5">
                                            <label><?php _e("Deregister other plugins styles", 'YVTWP-lang') ?></label>
                                        </div>
                                        <div class="col-lg-4">
                                            <select class="form-control" name="deregister_other_plugins_styles">
                                                <option value="yes"><?php _e('Yes', 'YVTWP-lang') ?></option>
                                                <option value="no"><?php _e('No', 'YVTWP-lang') ?></option>
                                            </select>                                                    
                                        </div>
                                        <p class="help-block col-lg-10">
                                            <?php _e('Deregister all other plugins styles when YVTWP pages are loaded to avoid conflict.', 'YVTWP-lang') ?>
                                        </p>
                                    </div>                                                  
                                </div>                                        
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-5">
                                            <label><?php _e("Deregister other plugins scripts", 'YVTWP-lang') ?></label>
                                        </div>
                                        <div class="col-lg-4">
                                            <select class="form-control" name="deregister_other_plugins_scripts">
                                                <option value="yes"><?php _e('Yes', 'YVTWP-lang') ?></option>
                                                <option value="no"><?php _e('No', 'YVTWP-lang') ?></option>
                                            </select>                                                    
                                        </div>
                                        <p class="help-block col-lg-10">
                                            <?php _e('Deregister all other plugins scripts when YVTWP pages are loaded to avoid conflict.', 'YVTWP-lang') ?>
                                        </p>
                                    </div>                                                  
                                </div>                                                  
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-5">
                                            <label><?php _e("Active debug", 'YVTWP-lang') ?></label>
                                        </div>
                                        <div class="col-lg-4">
                                            <select class="form-control" name="active_debug">
                                                <option value="no"><?php _e('No', 'YVTWP-lang') ?></option>
                                                <option value="yes"><?php _e('Yes', 'YVTWP-lang') ?></option>
                                            </select>                                                    
                                        </div>
                                    </div>                                                  
                                </div>   
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-5">
                                            <label><?php _e("Force import broken videos", 'YVTWP-lang') ?></label>
                                        </div>
                                        <div class="col-lg-4">
                                            <select class="form-control" name="force_import_broken_videos">
                                                <option value="no"><?php _e('No', 'YVTWP-lang') ?></option>
                                                <option value="yes"><?php _e('Yes', 'YVTWP-lang') ?></option>
                                            </select>                                                    
                                        </div>
                                    </div>                                                  
                                </div>                             
                                <?php if(is_admin()){ ?>
                                <div class="form-group" style="display: none">
                                    <div class="row">
                                        <div class="col-lg-5">
                                            <label><?php _e('Plugin Capabilitie', 'YVTWP-lang') ?></label>
                                        </div>
                                        <div class="col-lg-4">
                                            <input type="text" name="yvtwp_capabilitie" value="<?php echo Config_YVTWP::get('yvtwp_capabilitie'); ?>" />
                                        </div>
                                    </div>
                                </div> 
                                <?php } ?>
                            <div class="show_other_settings" style="border:solid 5px red;cursor: pointer;margin-bottom: 20px;width: 50%;text-align: center;padding: 10px">
                                <?php _e("More settings", 'YVTWP-lang') ?>
                            </div>
                            <div class="other_settings" style="display: none;margin-bottom: 30px">
                                <div class="form-group" style="color: red;font-weight: bold">
                                    <?php _e("Only change the below settings if you know what you're doing.", 'YVTWP-lang') ?>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-5">
                                            <label><?php _e("Bulk import refresh interval", 'YVTWP-lang') ?></label>
                                        </div>
                                        <div class="col-lg-4">
                                            <input name="bulk_import_time_check_result" type="number" min="2" max="60" value="10">
                                            <span><?php _e("Second", 'YVTWP-lang') ?></span>
                                        </div>
                                    </div>                                                  
                                </div> 
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-5">
                                            <label><?php _e("Paginate import refresh interval", 'YVTWP-lang') ?></label>
                                        </div>
                                        <div class="col-lg-4">
                                            <input name="paginate_import_time_check_result" type="number" min="2" max="50" value="10">
                                            <span><?php _e("Second", 'YVTWP-lang') ?></span>
                                        </div>
                                    </div>                                                  
                                </div> 
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-5">
                                            <label><?php _e("Imports per page", 'YVTWP-lang') ?></label>
                                        </div>
                                        <div class="col-lg-4">
                                            <input name="import_paged" type="number" min="1" max="100" value="20">
                                        </div>
                                    </div>                                                  
                                </div>  
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-5">
                                            <label><?php _e("Logs per page", 'YVTWP-lang') ?></label>
                                        </div>
                                        <div class="col-lg-4">
                                            <input name="log_paged" type="number" min="1" max="100" value="30">
                                        </div>
                                    </div>                                                  
                                </div>                                         
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-5">
                                            <label><?php _e("Youtube Paginate import videos per request", 'YVTWP-lang') ?></label>
                                        </div>
                                        <div class="col-lg-4 onChangeClearAllCache">
                                            <input name="paginate_paged" type="number" min="1" max="50" value="30">
                                        </div>
                                    </div>                                                  
                                </div>  
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-5">
                                            <label><?php _e("Youtube bulk import videos per request", 'YVTWP-lang') ?></label>
                                        </div>
                                        <div class="col-lg-4 onChangeClearAllCache">
                                            <input name="bulk_paged" type="number" min="1" max="50" value="30">
                                        </div>
                                    </div>                                                  
                                </div> 
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-5">
                                            <label><?php _e("Youtube scheduled import videos per request", 'YVTWP-lang') ?></label>
                                        </div>
                                        <div class="col-lg-4 onChangeClearAllCache">
                                            <input name="schedule_paged" type="number" min="1" max="30" value="30">
                                        </div>
                                    </div>                                                  
                                </div>   
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-5">
                                            <label><?php _e("Youtube normal import comments per request", 'YVTWP-lang') ?></label>
                                        </div>
                                        <div class="col-lg-4 onChangeClearAllCache">
                                            <input name="comment_paged" type="number" min="1" max="60" value="50">
                                        </div>
                                    </div>                                                  
                                </div>   
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-5">
                                            <label><?php _e("Youtube schedule import comments  per request", 'YVTWP-lang') ?></label>
                                        </div>
                                        <div class="col-lg-4 onChangeClearAllCache">
                                            <input name="comment_paged_schedule" type="number" min="1" max="30" value="5">
                                        </div>
                                    </div>                                                  
                                </div>     
                        </div>
                        <!-- col-lg-10-->
                    </div>
                    <!--row -->
                </div>
                <!-- /panel-body -->
            </div>
            <!-- /panel -->
        </div>
        <!--col-lg-12 -->
    </div>

</div>
</div>