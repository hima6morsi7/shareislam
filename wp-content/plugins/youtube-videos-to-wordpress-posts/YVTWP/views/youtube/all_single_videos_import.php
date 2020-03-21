<?php require_once Config_YVTWP::$views_dir.'header.php'; ?>
<?php require_once Config_YVTWP::$views_dir.'youtube/partials/import_tabs/script_js.php'; ?>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery("#tab_general_options").addClass('active');           
    });
</script>
<div class="container yvtwp_container">
    <div style="text-align: center;max-width: 1050px;margin: auto;">
        <ul class="list-group yvtwp_notices">
            <li class="list-group-item list-group-item-warning">
                <span class="badge"><?php _e('Note', 'YVTWP-lang') ?></span>
                <p class="help-block">
                    <?php _e('You can use this page to update all single video imports using the same settings.', 'YVTWP-lang') ?>
                </p>
            </li>
        </ul> 
    </div>     
    
    <div class="yvtwp_setting_import">
        <div class="row">
            <div class="col-md-11">
                <ul class="nav nav-tabs">
                    <li class="active"><a  href="#tab_general_options" data-toggle="tab"><?php _e('General Options', 'YVTWP-lang') ?></a></li>
                    <li><a  href="#tab_embed_options" data-toggle="tab"><?php _e('Embed Options', 'YVTWP-lang') ?></a></li>
                    <li><a  href="#tab_title_description_options" data-toggle="tab"><?php _e('Title & Description Options', 'YVTWP-lang') ?></a></li>
                    <li><a  href="#tab_date_options" data-toggle="tab"><?php _e('Date Options', 'YVTWP-lang') ?></a></li>                    
                    <li><a  href="#tab_comment_options" data-toggle="tab"><?php _e('Comments Options', 'YVTWP-lang') ?></a></li> 
                </ul>
            </div>
            <div class="col-md-1">
            </div>
        </div>
        <form role="form" id="yvtwp_form_new_import">    

            <div class="tab-content"> 
                <?php require_once Config_YVTWP::$views_dir.'youtube/partials/import_tabs/general_options.php'; ?>
                <?php require_once Config_YVTWP::$views_dir.'youtube/partials/import_tabs/embed_options.php'; ?>
                <?php require_once Config_YVTWP::$views_dir.'youtube/partials/import_tabs/title_description_options.php'; ?>
                <?php require_once Config_YVTWP::$views_dir.'youtube/partials/import_tabs/date_options.php'; ?>
                <?php require_once Config_YVTWP::$views_dir.'youtube/partials/import_tabs/comment_options.php'; ?>
            </div><!-- tab content -->    
                <div>
                    <input type="hidden" name="action" value="<?php echo Config_YVTWP::$wp_ajax_action_name ?>" >
                    <input type="hidden" name="yvtwp_controller" value="import" >
                    <input type="hidden" name="yvtwp_action" value="saveImportSettingsAllSingleVideos" >
                    <input type="hidden" name="import_id" required="" value="<?php echo $import_id ?>"> 
                    <input type="hidden" name="reload_when_select_change" value="0">
                    <input type="hidden" name="clear_comments_cache" value="0">
                    <input type="hidden" name="clear_cache" value="0">
                    <input type="hidden" name="show_advanced_videos_filter" value="1" />
                </div>

                    <div class="yvtwp_user_fedback"> </div>

                    <div class="yvtwp_content_save_button">
                        <input type="submit" class="yvtwp_save_button btn btn-primary btn-lg" value="<?php _e('Save Settings', 'YVTWP-lang') ?>" />                    
                    </div>
                
            
        </form>    
        <?php //require_once Config_YVTWP::$views_dir.'youtube/partials/import_tabs/form_ajax.php'; ?>
    </div>
</div><!-- end of container -->    
<?php  require_once Config_YVTWP::$views_dir.'youtube/partials/import_tabs/bulk_import_all_single_videos.php'; ?>