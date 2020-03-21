<?php if(isset($_REQUEST['paged']))
    {
        $maxPaged=ceil($importInfos['total_results']/$default_settings['max_page_results']);
        $paged_prev=$_REQUEST['paged'];
        if(!empty($importInfos['prev_page_token']) || TmpVideosModel_YVTWP::existTmpVideosPaged($paged_prev-1,$importInfos['id'])){
            if($paged_prev>1){ $paged_prev=$paged_prev-1; }
        }
        
        $paged_next=$_REQUEST['paged'];
        if(!empty($importInfos['next_page_token']) || TmpVideosModel_YVTWP::existTmpVideosPaged($paged_next+1,$importInfos['id'])){
            if($paged_next<$maxPaged){ $paged_next=$paged_next+1; }
        }    
    }
    $base_url="?page=yvtwp&yvtwp_controller=import&yvtwp_action=newImport&import_id=".$_REQUEST['import_id'];
    $url_page_next="&paged=".$paged_next."&pageToken=".$importInfos['next_page_token'];
    $url_page_prev="&paged=".$paged_prev."&pageToken=".$importInfos['prev_page_token'];
    
    if(!empty($importInfos['next_page_token']) || TmpVideosModel_YVTWP::existTmpVideosPaged($paged_next,$importInfos['id']))
        $url_page_next=$base_url.$url_page_next;
    
    if(!empty($importInfos['prev_page_token']) || TmpVideosModel_YVTWP::existTmpVideosPaged($paged_prev,$importInfos['id']))
        $url_page_prev=$base_url.$url_page_prev;

    if('?'.$_SERVER['QUERY_STRING']==$url_page_next)
        $url_page_next='#';
    if('?'.$_SERVER['QUERY_STRING']==$url_page_prev)
        $url_page_prev='#';    
    ?>
<table class="table_head_feed">
        <thead>
            <tr>
                <th>
                    <form id="yvtwp_form_import_feed" method="POST"> 
                        <table style="width: 100%">
                            <tr>
                                <td style="padding-left: 5px">
                                    <div class="yvtwp_content_save_button" style="text-align:left;">
                                    <input class="yvtwp_save_button btn btn-primary btn-lg" value="<?php _e('Import selected', 'YVTWP-lang') ?>" type="button">
                                    </div>    
                                </td>
                                <td align="left">
                                    <div class="yvtwp_user_fedback feed_table_fedback">  </div>
                                </td>
                            </tr>
                        </table>

                        <div>
                            <input type="hidden" name="action" value="<?php echo Config_YVTWP::$wp_ajax_action_name ?>" >
                            <input type="hidden" name="yvtwp_controller" value="import" >
                            <input type="hidden" name="yvtwp_action" value="importSelectedVideos" > 
                            <input type="hidden" name="import_id" value="<?php echo $_REQUEST['import_id'] ?>" >
                            <input type="hidden"  name="selected_videos_id" value="" >
                            <input type="hidden"  name="selected_videos_id_copier" value="" >
                        </div>

                    </form>
                </th>
                <th align="right" style="padding-right: 5px">

                    <div class="tablenav top">

                        <div class="tablenav-pages">
                            <span class="displaying-num"><?php echo $importInfos['total_results'].' ';_e('Videos', 'YVTWP-lang') ?> </span>
                            <span class="pagination-links">
                                <a class="prev-page" title="<?php _e('Previous page', 'YVTWP-lang') ?>" href="<?php echo $url_page_prev ?>" >‹</a>
                                <span class="paging-input">
                                    <label for="current-page-selector" class="screen-reader-text"><?php _e('Select a page', 'YVTWP-lang') ?></label>
                                    <input class="current-page" id="current-page-selector" title="<?php _e('Current page', 'YVTWP-lang') ?>" name="paged" value="<?php echo $_REQUEST['paged'] ?>" size="1" type="text">
                                    <?php _e('Of', 'YVTWP-lang') ?> <span class="total-pages"><?php echo $maxPaged ?></span>       
                                </span>
                                <a class="next-page" title="<?php _e('Next page', 'YVTWP-lang') ?>" href="<?php echo $url_page_next ?>" >›</a>
                            </span>
                        </div>
                        
                        <div style="float: right;padding: 5px 10px;">
                            <a style="cursor: pointer" class="config_table_feed" title="<?php _e('Show on table', 'YVTWP-lang') ?>">
                                <i class="dashicons-before dashicons-admin-tools"></i>
                            </a>                    
                        </div>                        

                    </div>
                </th>
            </tr>
      </thead>
    </table>