<div class="tab-pane" id="tab_video_synchronization">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Basic Form Elements
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-8">
                                        <label><?php _e("Enable synchronization", 'YVTWP-lang') ?></label>
                                    </div>
                                    <div class="col-md-4">
                                        <select class="form-control" name="enable_synchronize_video">
                                            <option value="no"><?php _e("No", 'YVTWP-lang') ?></option>
                                            <option value="yes"><?php _e("Yes", 'YVTWP-lang') ?></option>
                                        </select>                                                   
                                    </div>
                                </div>  
                            </div>
                            <div class="enable_synchronize_video_disabled">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <label><?php _e("Enable title synchronization", 'YVTWP-lang') ?></label>
                                        </div>
                                        <div class="col-md-4">
                                            <select class="form-control" name="enable_title_synchronize">
                                                <option value="no"><?php _e("No", 'YVTWP-lang') ?></option>
                                                <option value="yes"><?php _e("Yes", 'YVTWP-lang') ?></option>
                                            </select>                                                   
                                        </div>
                                    </div> 
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <label><?php _e("Enable description synchronization", 'YVTWP-lang') ?></label>
                                        </div>
                                        <div class="col-md-4">
                                            <select class="form-control" name="enable_description_synchronize">
                                                <option value="no"><?php _e("No", 'YVTWP-lang') ?></option>
                                                <option value="yes"><?php _e("Yes", 'YVTWP-lang') ?></option>
                                            </select>                                                   
                                        </div>
                                    </div> 
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <label><?php _e("Enable image synchronization", 'YVTWP-lang') ?></label>
                                        </div>
                                        <div class="col-md-4">
                                            <select class="form-control" name="enable_image_synchronize">
                                                <option value="no"><?php _e("No", 'YVTWP-lang') ?></option>
                                                <option value="yes"><?php _e("Yes", 'YVTWP-lang') ?></option>
                                            </select>                                                   
                                        </div>
                                    </div> 
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <label><?php _e("Enable categories synchronization", 'YVTWP-lang') ?></label>
                                        </div>
                                        <div class="col-md-4">
                                            <select class="form-control" name="enable_categories_synchronize">
                                                <option value="no"><?php _e("No", 'YVTWP-lang') ?></option>
                                                <option value="yes"><?php _e("Yes", 'YVTWP-lang') ?></option>
                                            </select>                                                   
                                        </div>
                                    </div> 
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <label><?php _e("Enable tags synchronization", 'YVTWP-lang') ?></label>
                                        </div>
                                        <div class="col-md-4">
                                            <select class="form-control" name="enable_tags_synchronize">
                                                <option value="no"><?php _e("No", 'YVTWP-lang') ?></option>
                                                <option value="yes"><?php _e("Yes", 'YVTWP-lang') ?></option>
                                            </select>                                                   
                                        </div>
                                    </div> 
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <label><?php _e("Enable custom fields synchronization", 'YVTWP-lang') ?></label>
                                        </div>
                                        <div class="col-md-4">
                                            <select class="form-control" name="enable_custom_fields_synchronize">
                                                <option value="no"><?php _e("No", 'YVTWP-lang') ?></option>
                                                <option value="yes"><?php _e("Yes", 'YVTWP-lang') ?></option>
                                            </select>                                                   
                                        </div>
                                    </div> 
                                </div>
                            </div>
                            
                        </div>
                        <!--<div class="col-md-6 enable_synchronize_video_disabled">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label><?php _e("Disable title and description synchronization", 'YVTWP-lang') ?></label>
                                    </div>
                                    <div class="col-md-6">
                                        <select class="form-control" name="disable_title_and_description_synchronization">
                                            <option value="yes"><?php _e("Yes", 'YVTWP-lang') ?></option>
                                            <option value="no"><?php _e("No", 'YVTWP-lang') ?></option>
                                        </select>                                                   
                                    </div>
                                </div>                                            
                            </div>
                        </div>-->
                        <div class="col-md-6 enable_synchronize_video_disabled">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-9">
                                        <label><?php _e("Max checks per day for every video", 'YVTWP-lang') ?></label>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="number" max="10" min="1" class="form-control" name="synchronize_video_max_check_per_day" value="1">                                                
                                    </div>
                                </div>  
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-9">
                                        <label><?php _e("Time to wait between every check (by hours)", 'YVTWP-lang') ?></label>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="number" max="12" min="0" class="form-control" name="synchronize_video_hour_between_every_check" value="1">                                                
                                    </div>
                                </div> 
                            </div>
                            <div class="form-group">
                                <p>
                                    <?php _e("Customize how often the plugin should check for sync the video datas, and you can also exclude title and description 
    because they rarely get changed after the video has been published.", 'YVTWP-lang') ?>
                                </p>
                            </div>
                        </div> 
                        <div class="col-md-6 enable_synchronize_video_disabled">
                            <div class="form-group">
                                           
                            </div>
                        </div>                                 
                        <div class="col-md-12">
                            <p>
                                <?php _e("", 'YVTWP-lang') ?>
                            </p>
                        </div>

                    </div>
                </div>
                <!-- /panel-body -->
            </div>
            <!-- /panel -->
        </div>
        <!--col-md-12 -->
    </div>

</div>  