<?php require_once Config_YVTWP::$views_dir.'header.php'; ?>
<?php require_once Config_YVTWP::$views_dir.'youtube/partials/import_tabs/script_js.php'; ?>

<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery("#tab_general_options").addClass('active');
        //init default config
        jQuery("#init_config").click(function(){

                swal({
                    title: "<?php _e('Alert', 'YVTWP-lang') ?>",
                    text: "<?php _e("Do you really want to reset to default settings?", 'YVTWP-lang') ?>",
                    showCancelButton: true,type: "info",html: true,confirmButtonText: "<?php _e("Ok", 'YVTWP-lang') ?>"
                },function(isConfirm)
                {   
                    if (isConfirm) {
                        sendAjaxRequest(function(){
                            window.location="<?php echo $_SERVER['REQUEST_URI'] ?>";
                        },'yvtwp_form_init_defaultSettings');
                    }//End isConfirm
                }); 
            
        });        
        
    });
</script>

<div class="container yvtwp_container">
    <h1><?php _e('Default Import Settings', 'YVTWP-lang') ?></h1>
    <div class="col-md-8" style="padding: 0px">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_general_options" data-toggle="tab"><?php _e('General Options', 'YVTWP-lang') ?></a></li>
            <li><a href="#tab_embed_options" data-toggle="tab"><?php _e('Embed Options', 'YVTWP-lang') ?></a></li>
            <li><a href="#tab_title_description_options" data-toggle="tab"><?php _e('Title & Description Options', 'YVTWP-lang') ?></a></li>
            <li><a href="#tab_tags_options" data-toggle="tab"><?php //_e('Tags Options', 'YVTWP-lang') ?></a></li>
        </ul>
    </div>
    <div class="col-md-4" style="text-align: right;">
            <a id="init_config"><?php _e('Reset Default', 'YVTWP-lang') ?></a>
            <span style="margin: 0px 5px">|</span>
            <a id="button_import_export_settings"><?php _e('Import/Export Settings', 'YVTWP-lang') ?></a>    
    </div>
    
    <form role="form" id="yvtwp_form_default_setting">    
        
        <div class="tab-content">
            <?php require_once Config_YVTWP::$views_dir.'youtube/partials/import_tabs/general_options.php'; ?>
            <?php require_once Config_YVTWP::$views_dir.'youtube/partials/import_tabs/embed_options.php'; ?>
            <?php require_once Config_YVTWP::$views_dir.'youtube/partials/import_tabs/title_description_options.php'; ?>
            <?php require_once Config_YVTWP::$views_dir.'youtube/partials/import_tabs/date_options.php'; ?>
            <?php //require_once Config_YVTWP::$views_dir.'youtube/partials/import_tabs/tags_options.php'; ?>            
        </div><!-- tab content -->

        <div>
            <input type="hidden" name="action" value="<?php echo Config_YVTWP::$wp_ajax_action_name ?>" >
            <input type="hidden" name="yvtwp_controller" value="settings" >
            <input type="hidden" name="yvtwp_action" value="setDefaultImportSettings" >
        </div>
        
        <div class="yvtwp_user_fedback"> </div>
        
        <div class="yvtwp_content_save_button"> 
            <input type="submit" class="yvtwp_save_button btn btn-primary btn-lg" value="<?php _e('Save Changes', 'YVTWP-lang') ?>" >
        </div>
        
    </form>    
    <?php require_once Config_YVTWP::$views_dir.'youtube/partials/import_export_settings.php'; ?>
    <?php require_once Config_YVTWP::$views_dir.'youtube/partials/import_tabs/form_ajax.php'; ?>
</div><!-- end of container -->