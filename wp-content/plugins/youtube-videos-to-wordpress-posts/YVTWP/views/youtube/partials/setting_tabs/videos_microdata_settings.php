<?php
//https://developers.google.com/structured-data/rich-snippets/videos
//https://developers.google.com/structured-data/testing-tool/
?>
<input type="hidden" name="videos_microdata" />

<div class="tab-pane" id="tab_videos_microdata_settings">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body" style="padding: 30px">
                    <div class="row">
                        <div class="col-md-12" >
                            <div class="row">
                                <label style="margin-bottom: 20px">
                                    <?php _e('Manage Videos microdata ','YVTWP-lang') ?>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12"> 
                            <div class="microdata_inputs row">
                            <?php $keyIndex=0; ?>
                            <?php foreach (Config_YVTWP::$videos_microdata as $key => $value) { ?>
                                <div class="form-group microdata_elements" id="microdata_element<?php echo $keyIndex ?>">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <?php if($keyIndex==0){ ?>
                                            <span><?php _e("Property key", 'YVTWP-lang') ?></span>
                                            <?php } ?>
                                            <input class="form-control property_key"  value="<?php echo $key ?>" disabled="disabled" />
                                        </div>                                            
                                        <div class="col-md-1 yvtwp_center <?php if($key==0){echo 'content_custom_fields_base';}?>">
                                            <span style="font-weight: 800">
                                            <?php _e('=>', 'YVTWP-lang') ?>
                                            </span>
                                        </div>
                                        <div class="col-md-7">
                                            <?php if($keyIndex==0){ ?>
                                            <span><?php _e("Property value", 'YVTWP-lang') ?></span>
                                            <?php } ?>
                                           <div class="input-group">
                                               <input id="property_value" class="form-control property_value" value="<?php echo $value ?>" />
                                              <div class="input-group-btn">
                                                 <button type="button" class="btn btn-default 
                                                    dropdown-toggle" data-toggle="dropdown">
                                                    <?php _e("Video fields", 'YVTWP-lang') ?> 
                                                    <span class="caret"></span>
                                                 </button>
                                                 <ul class="dropdown-menu pull-right content_templte_fields">
                                                    <?php foreach (Config_YVTWP::$microdataTemplateFields as $key=>$value) { ?>    
                                                     <li><a value="<?php echo '{{'.$key.'}}' ?>" class="select_template_field"><?php echo '{{'.$key.'}}' ?></a></li>
                                                    <?php  } ?>                                                             
                                                 </ul>
                                              </div><!-- /btn-group -->
                                           </div><!-- /input-group -->
                                        </div>
                                    </div>     
                                </div>  
                            <?php 
                                $keyIndex++;
                            } ?>
                        </div>
                        </div>                        
                        <div class="col-md-11">
                            <ul class="list-group yvtwp_notices row">
                                <li class="list-group-item list-group-item-warning">
                                    <?php _e("Only change the above settings if you know what you're doing.", 'YVTWP-lang') ?>
                                </li>
                                <li class="list-group-item list-group-item-warning">
                                  <code style="max-width: 150px;float: left;margin-right: 10px;">interactionCount</code>
                                  <?php _e('This Property contains the number of times the video has been viewed in your site, you can put the name of the custum field that is used to store the post views count.', 'YVTWP-lang') ?>
                                </li>
                                <li class="list-group-item">
                                    <p>
                                        <?php _e('For more details about the videos microdata you can visit this ', 'YVTWP-lang') ?>
                                        <a target="_blank" href="https://developers.google.com/structured-data/rich-snippets/videos">Link</a> <br/>
                                        <?php _e('You can validate your markup at this ', 'YVTWP-lang') ?>
                                        <a target="_blank" href="https://developers.google.com/structured-data/testing-tool/">Link</a>
                                    </p>
                                </li>                                                              
                            </ul>                                                            
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
jQuery(function() {

    jQuery(".select_template_field").click(function(){
        var current_element=jQuery(this);
        current_element.parent().parent().parent().parent().find(".property_value").val(current_element.attr('value'));
    });    

    });
</script>