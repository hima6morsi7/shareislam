<?php require_once Config_YVTWP::$views_dir.'header.php'; ?>

<script type="text/javascript">
function onSuccess(response)
{
    var args={"form_id":'yvtwp_form_youtube_api_settings',"status":response.status,"message":response.messages,"show_popin_error":0,"show_popin_success":0};
    afterSendAjaxRequest(args);
}

jQuery(document).ready(function(){

    jQuery('#yvtwp_form_youtube_api_settings').on('submit', function(ev){
        ev.preventDefault();

        var args={"form_id":'yvtwp_form_youtube_api_settings'};

        beforeSendAjaxRequest(args);
        sendAjaxRequest(onSuccess,'yvtwp_form_youtube_api_settings');
    }); 

});

</script>

<div class="container yvtwp_container">
    <h1><?php _e('Youtube API Settings', 'YVTWP-lang') ?></h1>
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_a" data-toggle="tab"><?php _e('Youtube API Key', 'YVTWP-lang') ?></a></li>
        <li><a href="#tab_b" data-toggle="tab"><?php _e('How to get your API Key', 'YVTWP-lang') ?></a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tab_a">

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-10">
                                    <form action="" method="POST" role="form" id="yvtwp_form_youtube_api_settings">
                                        <!--
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-5">
                                                    <label><?php _e("Client ID", 'YVTWP-lang') ?></label>
                                                </div>
                                                <div class="col-lg-5">
                                                    <input class="form-control" name="client_id" value="<?php echo $client_id ?>">                                                   
                                                </div>
                                            </div>                                            
                                            <p class="help-block"><i class="fa fa-info fa-fw"></i>help text here.</p>
                                        </div>
                                        <div class="yvtwp_divider"></div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-5">
                                                    <label><?php _e("Client Secret", 'YVTWP-lang') ?></label>
                                                </div>
                                                <div class="col-lg-5">
                                                    <input class="form-control" name="client_secret" value="<?php echo $client_secret ?>">                                                   
                                                </div>
                                            </div>                                            
                                            <p class="help-block"><i class="fa fa-info fa-fw"></i>help text here.</p>
                                        </div> 
                                        <div class="yvtwp_divider"></div>
                                        -->
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <label><?php _e("Developer key", 'YVTWP-lang') ?></label>
                                                </div>
                                                <div class="col-lg-8">
                                                    <input class="form-control" name="developer_key" value="<?php echo $developer_key ?>">                                                   
                                                </div>
                                            </div>                                            
                                            <!--<p class="help-block"><i class="fa fa-info fa-fw"></i>help text here.</p>-->
                                        </div> 
                                        <div>
                                            <input type="hidden" name="action" value="<?php echo Config_YVTWP::$wp_ajax_action_name ?>" >
                                            <input type="hidden" name="yvtwp_controller" value="settings" >
                                            <input type="hidden" name="yvtwp_action" value="setGoogleKeys" >
                                        </div>
                                        
                                        <div class="yvtwp_user_fedback"> </div>

                                        <div class="yvtwp_content_save_button">
                                            <input type="submit" class="yvtwp_save_button btn btn-primary btn-lg" value="<?php _e('Submit changes', 'YVTWP-lang') ?>" >
                                        </div>                                        
                                        
                                    </form>
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
        <div class="tab-pane" id="tab_b"> <!---Embed options--->

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Basic Form Elements
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-10">
                                    <p>After signing to Google account, navigate to the <a href="https://console.developers.google.com/project">Developer Console</a> and click on the <code>Create Project</code> button.</p>
                                    <div class="figure">
                                        <img src="https://dl.dropboxusercontent.com/s/8iy2oc50gn18k7m/Screenshot%202015-09-02%2012.31.52.png?dl=0" alt="Create Project" />
                                        <p class="caption">Create Project</p>
                                    </div>
                                    <p>Give your project a name and click <code>create</code>. Now you can select your project from the list at the top of the window.</p>
                                    <div class="figure">
                                        <img src="https://dl.dropboxusercontent.com/s/xr5jtwxhdc8x017/Screenshot%202015-09-02%2013.25.53.png?dl=0" alt="Choose Project" />
                                        <p class="caption">Choose Project</p>
                                    </div>
                                    <p>The left menu contains an <code>APIs &amp; auth</code> menu where you can activate Youtube API if it's not activated by default.</p>
                                    <div class="figure">
                                        <img src="https://dl.dropboxusercontent.com/s/ea79aa10gm2xjrj/yvtwp_activate_api.gif?dl=0" alt="Activate Youtube API" />
                                        <p class="caption">Activate Youtube API</p>
                                    </div>
                                    <p>Select <code>credentials</code> and create a new API key.</p>
                                    <div class="figure">
                                        <img src="https://dl.dropboxusercontent.com/s/dxy58c57qws6nqf/yvtwp_create_key.gif?dl=0" alt="Create API Key" />
                                        <p class="caption">Create API Key</p>
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
    </div><!-- tab content -->
</div><!-- end of container -->