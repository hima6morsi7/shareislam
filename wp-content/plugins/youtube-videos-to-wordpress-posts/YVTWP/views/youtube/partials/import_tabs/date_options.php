<div class="tab-pane" id="tab_date_options">
    <div class="row">
        <div class="col-md-12">          
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                  <div id="collapse1" class="panel-collapse collapse in">
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <div class="row"> 
                                                <div class="col-md-9">
                                                    <div class="col-md-4">
                                                        <label><?php _e("Set post publish date to", 'YVTWP-lang') ?></label>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <select class="form-control" name="post_publish_date">
                                                            <option value="video_publish_date"><?php _e('Video publish date', 'YVTWP-lang') ?></option> 
                                                            <option value="insert_date"><?php _e('Insert date', 'YVTWP-lang') ?></option>
                                                            <option value="custom_publish_date"><?php _e('Custom publish date', 'YVTWP-lang') ?></option> 
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="help-block"></p>
                                        </div>  
                                        <div class="custom_publish_dates" style="display: none">

                                            <div class="form-group">
                                                <div class="row"> 
                                                    <div class="col-md-12">
                                                        <div class="col-md-3">
                                                                <label><?php _e("Publish start date", 'YVTWP-lang') ?></label>
                                                                <input name="schedule_start_date" />
                                                        </div>       
                                                        <div class="col-md-3" style="">
                                                            <label><?php _e("Random min value", 'YVTWP-lang') ?></label>
                                                            <input type="number" name="schedule_marge_start" min="1" max="1000" /><span>&nbsp;<?php _e('Minutes', 'YVTWP-lang') ?></span>
                                                        </div>
                                                        <div class="col-md-3" style="">
                                                            <label><?php _e("Random max value", 'YVTWP-lang') ?></label>
                                                            <input type="number" name="schedule_marge_end" min="1" max="1000" /><span>&nbsp;<?php _e('Minutes', 'YVTWP-lang') ?></span>
                                                        </div>   
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                        <div class="yvtwp-infos-block">
                                                            <p class="help-block">
                                                                <?php _e('This option is useful for Bulk Import where you can set a custom date range to use for publishing posts.', 'YVTWP-lang') ?>
                                                            </p>
                                                        </div>
                                                </div>
                                            </div>                                            
                                        </div>
                                    </div>
                                  </div>
                                </div>                           

                        </div>
                        <!-- col-lg-10-->
                    </div>
                    <!--row -->
            <!-- /panel -->        
        </div>
        <!--col-lg-12 -->
    </div>
</div>