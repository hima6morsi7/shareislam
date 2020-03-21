<div class="tab-pane" id="tab_tags_options">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Basic Form Elements
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>
                                                <?php _e("Import video tags", 'YVTWP-lang') ?>

                                            </label>
                                        </div>
                                        <div class="col-md-2">
                                            <span class="btn btn-primary"><?php _e('As', 'YVTWP-lang') ?></span>
                                        </div>
                                        <div class="col-md-4"> 
                                            <select class="form-control" name="import_video_tag">
                                                <option value="1">post tags</option>
                                                <option value="2">do not import</option>
                                            </select>                                             
                                        </div>
                                    </div>                                            
                                    <p class="help-block"><?php _e('help text here', 'YVTWP-lang') ?></p>
                                </div> 
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>
                                                <?php _e("Maximum number of imported tags", 'YVTWP-lang') ?>
                                            </label>
                                        </div>
                                        <div class="col-md-4"> 
                                            <select class="form-control" name="max_tags">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                        </div>
                                    </div>
                                    <p class="help-block"><?php _e('help text here', 'YVTWP-lang') ?></p>
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