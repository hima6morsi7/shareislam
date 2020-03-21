<div class="tab-pane" id="tab_description_options">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"></div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                                <div class="form-group">
                                    <div class="row"> 
                                        <div class="col-md-3">
                                            <label><?php _e("Delete description keywords", 'YVTWP-lang') ?></label>
                                        </div>
                                        <div class="col-md-9">
                                            <input class="form-control tagsInput" name="description_deleted_keywords">                                                 
                                        </div>
                                    </div>
                                    <p class="help-block"></p>
                                </div>    
                                <div class="yvtwp_divider"></div>
                                <div class="form-group">
                                    <div class="row"> 
                                        <div class="col-md-3">
                                            <label><?php _e("Replace description keywords", 'YVTWP-lang') ?></label>
                                        </div>
                                        <div class="col-md-4">
                                            <input class="form-control tagsInput" name="description_remplaced_keywords">
                                        </div>
                                        <div class="col-md-1">
                                            <span class="btn btn-primary"><?php _e('By', 'YVTWP-lang') ?></span>
                                        </div>
                                        <div class="col-md-4">
                                            <input class="form-control tagsInput" name="description_remplaced_keywords_by">
                                        </div>
                                    </div>
                                </div>
                                <div class="yvtwp_divider"></div>
                                <div class="form-group">
                                    <div class="row"> 
                                        <div class="col-md-3">
                                            <label><?php _e("Delete description URLs", 'YVTWP-lang') ?></label>
                                        </div>
                                        <div class="col-md-4">
                                            <select class="form-control" name="delete_url_from_description">
                                                <option value="yes"><?php _e('Yes', 'YVTWP-lang') ?></option>
                                                <option value="no"><?php _e('No', 'YVTWP-lang') ?></option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label><?php _e("Import description as post excerpt", 'YVTWP-lang') ?></label>
                                        </div>
                                        <div class="col-md-2">
                                            <select class="form-control" name="import_description_as_post_except">
                                                <option value="yes"><?php _e('Yes', 'YVTWP-lang') ?></option>
                                                <option value="no"><?php _e('No', 'YVTWP-lang') ?></option>
                                            </select>
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