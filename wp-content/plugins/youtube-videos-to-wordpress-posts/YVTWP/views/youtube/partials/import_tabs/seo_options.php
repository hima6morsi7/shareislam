<div class="tab-pane" id="tab_seo_options">
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
                                            <label><?php _e("Enable Rich Snippets for Videos", 'YVTWP-lang') ?></label>
                                        </div>
                                        <div class="col-md-3">
                                            <select class="form-control" name="enable_rich_snippets">
                                                <option value="yes"><?php _e("Yes", 'YVTWP-lang') ?></option>
                                                <option value="no"><?php _e("No", 'YVTWP-lang') ?></option>
                                            </select>                                                   
                                        </div>
                                    </div>                                            
                                </div>
                            </div>      
                            <div class="content_enable_rich_snippets">
                                <div class="col-md-10">    
                                    <div class="row">
                                        <code style="display: block;clear: both;font-size: 18px;font-weight: bold;">
                                            &lt;script type="application/ld+json"&gt;<br/>
                                            {
                                            <br/>
                                            <div style="padding-left: 15px">
                                                <?php 
                                                    $count=count(Config_YVTWP::$videos_microdata);
                                                    $index=0;
                                                    foreach (Config_YVTWP::$videos_microdata as $key => $value) {
                                                        if($index<$count-1)
                                                            echo '"'.$key.'"'.': '.'<span style="color:#689f38">"'.$value.'",</span>'.'<br/>';
                                                        else
                                                            echo '"'.$key.'"'.': '.'<span style="color:#689f38">"'.$value.'"</span>';

                                                        $index++;
                                                    }
                                                ?>
                                            </div>    
                                            }  
                                            <br/>
                                            &lt;/script&gt; 
                                        </code>
                                    </div>
                                </div>
                                <div class="col-md-10" style="margin-top: 10px">
                                    <ul class="list-group yvtwp_notices row">
                                        <li class="list-group-item list-group-item-warning">
                                            <?php _e("When you activate this option, the video microdata will be automatically compiled and added to the import videos.", 'YVTWP-lang') ?>
                                        </li>
                                        <li class="list-group-item list-group-item-warning">
                                          <?php _e('If you want to change anything in this code, you can do so in the ', 'YVTWP-lang') ?>
                                          <a target="_blank" href="?page=yvtwp&yvtwp_controller=settings&yvtwp_action=generalSettings&tab=videos_microdata_settings">
                                              <?php _e('Videos microdata Settings page', 'YVTWP-lang') ?>
                                          </a>
                                        </li>                                                              
                                    </ul>                                                            
                                </div>                             
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