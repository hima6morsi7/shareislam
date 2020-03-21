<?php 
if(!isset($_REQUEST['feed_type']))
    $_REQUEST['feed_type']='feed_channel';
?>
<?php require_once Config_YVTWP::$views_dir.'header.php'; ?>
<?php require_once Config_YVTWP::$views_dir.'youtube/partials/import_tabs/script_js.php'; ?>

<div class="container yvtwp_container">
    <div class="yvtwp_setting_import">
        <div class="row">
            <div class="col-md-11" style="padding-right: 0px">
                <ul class="nav nav-tabs">
                    <li class="active li_link_tabs"><a class="link_tabs" id="a_feed_options" href="#tab_feed_options" data-toggle="tab"><?php _e('Feed Options', 'YVTWP-lang') ?></a></li>
                    <li class="li_link_tabs"><a class="link_tabs" id="a_general_options" href="#tab_general_options" data-toggle="tab"><?php _e('General Options', 'YVTWP-lang') ?></a></li>
                    <li class="li_link_tabs"><a class="link_tabs" href="#tab_embed_options" data-toggle="tab"><?php _e('Embed Options', 'YVTWP-lang') ?></a></li>
                    <li class="li_link_tabs"><a class="link_tabs" href="#tab_title_description_options" data-toggle="tab"><?php _e('Title & Description', 'YVTWP-lang') ?></a></li>
                    <li class="li_link_tabs"><a class="link_tabs" href="#tab_date_options" data-toggle="tab"><?php _e('Date', 'YVTWP-lang') ?></a></li>                    
                    <li class="li_link_tabs"><a class="link_tabs" href="#tab_comment_options" data-toggle="tab"><?php _e('Comments', 'YVTWP-lang') ?></a></li> 
                    <li class="li_link_tabs"><a class="link_tabs" href="#tab_seo_options" data-toggle="tab"><?php _e('Seo', 'YVTWP-lang') ?></a></li>
                    <li class="li_link_tabs"><a class="link_tabs" href="#tab_video_synchronization" data-toggle="tab"><?php _e('Video synchronization', 'YVTWP-lang') ?></a></li>
                </ul>
            </div>
            <div class="col-md-1">
                 <?php if(isset($_REQUEST['paged']) && isset($_REQUEST['import_type']) && $_REQUEST['import_type']=='paginate_import' && $_REQUEST['feed_type']!='feed_single_video'){ ?>
                    <button type="button" class="btn_hide_how btn btn-success" data-toggle="collapse" data-target="#yvtwp-tab-content">
                    <span class="glyphicon glyphicon-collapse-down"></span>
                    <?php //_e('Open', 'YVTWP-lang') ?>
                    </button>
                 <?php } ?>
            </div>
        </div>
        <form role="form" id="yvtwp_form_new_import">    

            <div id="yvtwp-tab-content" class="<?php if(isset($_REQUEST['paged']) && isset($_REQUEST['import_type']) && $_REQUEST['import_type']=='paginate_import' && $_REQUEST['feed_type']!='feed_single_video'){echo 'collapse'; } ?> tab-content"> 
                
                <?php require_once Config_YVTWP::$views_dir.'youtube/partials/import_tabs/feed_options.php'; ?>
                <?php require_once Config_YVTWP::$views_dir.'youtube/partials/import_tabs/general_options.php'; ?>
                <?php require_once Config_YVTWP::$views_dir.'youtube/partials/import_tabs/embed_options.php'; ?>
                <?php require_once Config_YVTWP::$views_dir.'youtube/partials/import_tabs/title_description_options.php'; ?>
                <?php require_once Config_YVTWP::$views_dir.'youtube/partials/import_tabs/date_options.php'; ?>
                <?php require_once Config_YVTWP::$views_dir.'youtube/partials/import_tabs/comment_options.php'; ?>
                <?php require_once Config_YVTWP::$views_dir.'youtube/partials/import_tabs/seo_options.php'; ?>
                <?php require_once Config_YVTWP::$views_dir.'youtube/partials/import_tabs/video_synchronization.php'; ?>
                
                <div>
                    <input type="hidden" name="action" value="<?php echo Config_YVTWP::$wp_ajax_action_name ?>" >
                    <input type="hidden" name="yvtwp_controller" value="import" >
                    <input type="hidden" name="yvtwp_action" value="saveImportSettings" >
                    <input type="hidden" name="import_id" required=""> 
                    <input type="hidden" name="reload_when_select_change" value="0">
                    <input type="hidden" name="clear_comments_cache" value="0">
                    
                    <input type="hidden" name="clear_cache" value="0">
                    <input type="hidden" name="show_advanced_videos_filter" value="1" />
                </div>

                    <div class="yvtwp_user_fedback"> </div>

                    <div class="yvtwp_content_save_button">
                        <input type="submit" class="yvtwp_save_button btn btn-primary btn-lg" value="
                            <?php if(!isset($_REQUEST['paged']) || $_REQUEST['feed_type']=='feed_single_video'){ ?>
                            <?php _e('Save and Import Feed', 'YVTWP-lang') ?>
                            <?php }else{ ?>
                            <?php _e('Save Import Settings', 'YVTWP-lang') ?>
                            <?php } ?>" >                    
                    </div>
                
            </div><!-- tab content -->
        </form>    
        <?php require_once Config_YVTWP::$views_dir.'youtube/partials/import_tabs/form_ajax.php'; ?>
    </div>
</div><!-- end of container -->    
<?php 
if(isset($_REQUEST['paged']) && $_REQUEST['feed_type']!='feed_single_video')
{
    if(!isset($default_settings['import_type']) && isset($default_settings['import_without_pagination']))
    {
        //old version
        if($default_settings['import_without_pagination']=='yes')
            $default_settings['import_type']='bulk_import';
        else    
            $default_settings['import_type']='paginate_import';         
    }
    if(file_exists(Config_YVTWP::$views_dir.'youtube/partials/import_tabs/'.$default_settings['import_type'].'.php'))
        require_once Config_YVTWP::$views_dir.'youtube/partials/import_tabs/'.$default_settings['import_type'].'.php';

    
}
?>