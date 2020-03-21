<div class="tab-pane" id="tab_general_options">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Basic Form Elements
                </div>
                <div class="panel-body">
                    <div class="row my_first_row">
                        <div class="col-md-6" style="border-right: solid 5px;">
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-7">
                                        <label><?php _e("Content type", 'YVTWP-lang') ?></label>
                                    </div>
                                    <div class="col-md-5">
                                        <select class="form-control" name="post_type" id="select_post_type" value="">
                                            <?php
                                            foreach ($postTypes as $value) {?>
                                            <option value="<?php echo $value ?>"><?php echo $value ?></option>
                                            <?php  } ?>
                                        </select>                                                     
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-7">
                                        <label><?php _e('Post status', 'YVTWP-lang') ?></label>
                                    </div>
                                    <div class="col-md-5">
                                        <select class="form-control" name="post_status">
                                            <option value="publish"><?php _e('Published', 'YVTWP-lang') ?></option>
                                            <option value="draft"><?php _e('Draft', 'YVTWP-lang') ?></option>
                                            <option value="pending"><?php _e('Pending', 'YVTWP-lang') ?></option>
                                            <option value="private"><?php _e('Private', 'YVTWP-lang') ?></option>
                                        </select>
                                    </div>
                                </div>                                
                                <div class="form-group">
                                    <div class="col-md-5">
                                        <label><?php _e("Import Featured Image", 'YVTWP-lang') ?></label>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="col-md-4">
                                            <select class="form-control" name="import_video_thumbnail">
                                                <option value="yes"><?php _e('Yes', 'YVTWP-lang') ?></option>
                                                <option value="no"><?php _e('No', 'YVTWP-lang') ?></option>
                                            </select>
                                        </div>
                                        <div class="col-md-8" style="padding: 0px">
                                            <select class="form-control" name="thumbnails_quality">
                                                <?php foreach (Config_YVTWP::$thumbnailsQuality as $key => $value) { ?>
                                                    <option value="<?php echo $key ?>"><?php echo $value?></option>
                                                <?php }  ?>
                                            </select> 
                                        </div>
                                    </div>                                            
                                </div>                                  
                                <div class="form-group">
                                    <div class="col-md-7" style="padding-right: 1px">
                                        <label>
                                            <?php _e('Author', 'YVTWP-lang') ?></label>
                                        
                                    </div>     
                                    <div class="col-md-5">
                                        <input class="form-control" name="author_login" value="<?php echo Config_YVTWP::$current_author_login ?>" />
                                    </div>
                                </div>
                                <div class="col-md-12 author_login_msg" style="text-align: center;color: red;display: none">
                                    <?php _e('Invalid user login', 'YVTWP-lang') ?>
                                </div>
                                <div class="form-group">
                                        <div class="col-md-7">
                                            <label><?php _e("Update if exist", 'YVTWP-lang') ?></label>
                                        </div>
                                        <div class="col-md-5">
                                            <select class="form-control" name="update_if_exist">
                                                <option value="yes"><?php _e('Yes', 'YVTWP-lang') ?></option>
                                                <option value="no"><?php _e('No', 'YVTWP-lang') ?></option>
                                            </select>
                                        </div>
                                </div>
                            </div>
                        </div> 
                        <div class="col-md-6 content-taxonomy-and-category">
                            <div id="content_taxonomy_categories" class="form-group">
                                <div class="col-md-5">
                                    <label><?php _e('Categories taxonomy', 'YVTWP-lang') ?></label>
                                </div>
                                <div class="col-md-7">
                                    <select class="form-control" id="select_taxonomy_categories">
                                        <option value="0"><?php _e("Select a taxonomy", 'YVTWP-lang') ?></option>
                                        <?php foreach ($taxonomies as $key=>$value) { ?>
                                        <option value="<?php echo $key ?>"><?php echo $key ?></option>
                                        <?php } ?>
                                    </select>
                                    <input type="hidden" name="taxonomy_categories" placeholder="<?php _e('taxonomy categories', 'YVTWP-lang') ?>" />
                                    <div class="taxonomies_categories_waiting">
                                        <i class="fa fa-refresh fa-spin fa-2x fa-fw margin-bottom"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-5">
                                    <label><?php _e('Categories', 'YVTWP-lang') ?></label>
                                </div>
                                
                                <div class="col-md-7 content_select_cats">
                                    <select  id="post_categories" multiple="multiple">
                                        <?php foreach ($categories as $key=>$value) { ?>
                                            <option value="<?php echo $value->term_id ?>"><?php echo $value->name ?></option>
                                        <?php } ?>
                                    </select> 
                                    <input type="hidden" name="categories" />
                                    <div class="categories_waiting">
                                        <i class="fa fa-refresh fa-spin fa-2x fa-fw margin-bottom"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-5">
                                    <label><?php _e("Import youtube categories", 'YVTWP-lang') ?></label>
                                </div>
                                <div class="col-md-7">
                                    <select class="form-control" name="import_youtube_categories">
                                        <option value="no"><?php _e('No', 'YVTWP-lang') ?></option>
                                        <option value="yes"><?php _e('Yes', 'YVTWP-lang') ?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 yvtwp_divider" style="margin: 10px 0px 0px 0px"></div>
                            <div id="content_taxonomy_tags" class="form-group">
                                <div class="col-md-5">
                                    <label><?php _e('Tags taxonomy', 'YVTWP-lang') ?></label>
                                </div>
                                <div class="col-md-7">
                                    <select class="form-control" id="select_taxonomy_tags">
                                        <option value="0"><?php _e("Select a taxonomy", 'YVTWP-lang') ?></option>
                                        <?php foreach ($taxonomies as $key=>$value) { ?>
                                            <option value="<?php echo $key ?>"><?php echo $key ?></option>
                                        <?php } ?>
                                    </select>  
                                    <input type="hidden" name="taxonomy_tags" placeholder="taxonomy tags" />
                                    <div class="taxonomies_tags_waiting">
                                        <i class="fa fa-refresh fa-spin fa-2x fa-fw margin-bottom"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" style="display: none">
                                <div class="col-md-5">
                                    <label><?php _e('Select tags', 'YVTWP-lang') ?></label>
                                </div>
                                <div class="col-md-7">
                                    <select class="form-control" id="post_tags">
                                        <option value="0"><?php _e("Add new Tag", 'YVTWP-lang') ?></option>
                                        <?php foreach ($categories as $key=>$value) { ?>
                                            <option value="<?php echo $value->name ?>"><?php echo $value->name ?></option>
                                        <?php } ?>
                                    </select>  
                                    <div class="tags_waiting">
                                        <i class="fa fa-refresh fa-spin fa-2x fa-fw margin-bottom"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-5">
                                        <label><?php _e('Tags ', 'YVTWP-lang') ?></label>
                                </div>
                                <div class="col-md-7">
                                    <input name="tags" class="tagsInput" />
                                </div> 
                            </div>
                            <div class="form-group">
                                <div class="col-md-5">
                                    <label><?php _e("Import Youtube tags", 'YVTWP-lang') ?></label>
                                </div>
                                <div class="col-md-7">
                                    <select class="form-control" name="import_youtube_tags">
                                        <option value="no"><?php _e('No', 'YVTWP-lang') ?></option>
                                        <option value="yes"><?php _e('Yes', 'YVTWP-lang') ?></option>
                                    </select>
                                </div> 
                            </div>
                            <div class="form-group content_max_tags">
                                <div class="col-md-5 max_tags">
                                    <label><?php _e('Max Youtube tags', 'YVTWP-lang') ?></label>
                                </div>
                                <div class="col-md-7">
                                    <input type="number" name="max_youtube_tags" min="1" max="20" style="width: 100%;height: 34px;width: 55px" />
                                </div>
                            </div>                              
                        </div>   
                        <div class="col-md-6 content-taxonomy-not-exist" style="display: none;vertical-align: middle;height: 200px;text-align: center;padding-top: 7%;font-weight: bold;font-size: 17px;">
                            <?php _e('This post type doesn\'t contain any taxonomy', 'YVTWP-lang') ?>
                        </div>
                    </div>
                </div>
                <!-- /panel-body -->
            </div>
            <!-- /panel -->
        </div>
        <!--col-lg-12 -->
    </div>
</div>