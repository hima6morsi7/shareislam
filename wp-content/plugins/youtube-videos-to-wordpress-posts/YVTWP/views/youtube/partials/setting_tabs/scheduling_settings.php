<div class="tab-pane" id="tab_scheduling_settings">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-5">
                                            <label><?php _e("Activate import scheduling", 'YVTWP-lang') ?></label>
                                        </div>
                                        <div class="col-lg-5">
                                            <select class="form-control" name="active_import_scheduling">
                                                <option value="no"><?php _e('No', 'YVTWP-lang') ?></option>
                                                <option value="yes"><?php _e('Yes', 'YVTWP-lang') ?></option>
                                            </select>                                                    
                                        </div>
                                    </div>                                                  
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-5">
                                            <label><?php _e("Enable Max videos to import", 'YVTWP-lang') ?></label>
                                        </div>
                                        <div class="col-lg-5">
                                            <select class="form-control" name="enable_scheduling_max_videos">
                                                <option value="yes"><?php _e('Yes', 'YVTWP-lang') ?></option>
                                                <option value="no"><?php _e('No', 'YVTWP-lang') ?></option>
                                            </select>                                                    
                                        </div>
                                    </div>                                                  
                                </div>                            
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-5">
                                            <label><?php _e("Cron job type for scheduling", 'YVTWP-lang') ?></label>
                                        </div>
                                        <div class="col-lg-5">
                                            <select class="form-control" name="cron_job_type">
                                                <option value="virtual_cron_job"><?php _e('Virtual cron job (based in wordpress cron)', 'YVTWP-lang') ?></option>
                                                <option value="real_cron_job"><?php _e('Real cron job (based in server cron)', 'YVTWP-lang') ?></option>
                                            </select>                                                    
                                        </div>
                                    </div>
                                </div>  
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-5">
                                            <label><?php _e("Scheduling recurrance", 'YVTWP-lang') ?></label>
                                        </div>
                                        <div class="col-lg-5">
                                            <select class="form-control" name="scheduling_recurrance">
                                                <?php foreach (Config_YVTWP::$schedulingRecurrance as $key => $value) { ?>
                                                    <option value="<?php echo $key ?>"><?php echo $value?></option>
                                                <?php }  ?>                                                            
                                            </select>                                                    
                                        </div> 

                                    </div>                                                
                                </div>
                                <div class="form-group virtual_cron_job">
                                            <div class="col-lg-10" style="margin-top: 10px">
                                                <ul class="list-group yvtwp_notices">
                                                    <li class="list-group-item list-group-item-warning">
                                                        <span class="badge"><?php _e('Note', 'YVTWP-lang') ?></span>
                                                        <p class="help-block">
                                                            <?php _e('When activating Virtual cron job, cron events are only triggered when you have a visitor on your website. If there are no visitors, there can be no cron job checks and therefore no videos imported. This is how Wordpress cron jobs work.', 'YVTWP-lang') ?>
                                                        </p>
                                                        <p style="text-transform: uppercase;color: #777;font-weight: bold">
                                                            <?php _e('ZERO VISITS = ZERO CRON RUNS = ZERO Import cheked = ZERO video imported', 'YVTWP-lang') ?>    
                                                        </p>
                                                    </li>
                                                </ul> 
                                            </div>                                               
                                </div>
                                <div class="form-group real_cron_job">
                                    <div class="row">
                                        <div class="col-lg-12">
                                                <ul class="list-group yvtwp_notices">
                                                    <li class="list-group-item list-group-item-warning">
                                                      <span class="badge"><?php _e('Step 1', 'YVTWP-lang') ?></span> 
                                                        <?php _e('First, you need to disable the file to be hit every time someone loads your pages. To do this, open the wp-config.php file in your main WordPress folder and add this line or update it if is set a false ', 'YVTWP-lang') ?>
                                                        <br/>
                                                        <code>define('DISABLE_WP_CRON', true); </code>
                                                    </li>
                                                    <li class="list-group-item list-group-item-warning">
                                                      <span class="badge"><?php _e('Step 2', 'YVTWP-lang') ?></span> 
                                                        <?php _e('Add your cron on the server via the command line  or  panel and add the line.', 'YVTWP-lang') ?>
                                                        <br/>
                                                        <p><code><span class="dynamique_recurrance">0 0 * * *</span> wget -q -O /dev/null <?php echo get_site_url().'/wp-cron.php?doing_cron' ?> > /dev/null 2>&1 </code> </p>
                                                    </li>
                                                    <li class="list-group-item list-group-item-warning">
                                                        <span class="badge"><?php _e('Step 3', 'YVTWP-lang') ?></span>
                                                        <p>
                                                            Make sure <strong>wget</strong> is not blocked
                                                        </p>
                                                        <p>
                                                            Some configurations and overprotective plugins restrict an access of your site by wget.<br/>
                                                            for example <strong>“Better WP Security”</strong> WordPress plugin. It adds the following line to the .htaccess file<br/>
                                                            <code>RewriteCond %{HTTP_USER_AGENT} ^Wget [NC,OR]</code>
                                                            You need to remove this line, or the whole setup won’t work.                                                                        
                                                        </p>
                                                        <p>
                                                            <?php _e('For more infos in cron jobs view this ', 'YVTWP-lang') ?>
                                                            <a href="http://goo.gl/wRZuA8"><?php _e('Tutorial', 'YVTWP-lang') ?></a>
                                                        </p>
                                                    </li> 
                                                    <li class="list-group-item">
                                                        <p>
                                                            <?php _e('If you are not familiar with cron jobs you use this external service to trigger a cron job', 'YVTWP-lang') ?>
                                                            <a target="_blank" href="http://goo.gl/n5733z">Easy Cron</a>
                                                        </p>
                                                    </li>                                                              
                                                </ul>                                                            
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