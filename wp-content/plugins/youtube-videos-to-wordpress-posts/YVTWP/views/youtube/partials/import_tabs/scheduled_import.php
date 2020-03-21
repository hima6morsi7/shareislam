<?php $countTmpVideoImported=Post_YVTWP::getPostsCountByImportId($_REQUEST['import_id']); ?>
<div class="form-group" style="margin-top: 20px">
        <div class="col-md-12">
                <div class="yvtwp-infos-block">
                    <p class="help-block">
                        <?php _e('the videos will be imported with scheduled import actualy', 'YVTWP-lang') ?>
                        <strong>
                        <?php _e('Imported videos : ', 'YVTWP-lang') ?>
                        <span class="videos_imported"><?php echo $countTmpVideoImported ?></span>
                        <span class="span_sep"> / </span>
                        <span class="totals_result"><?php echo $total_results ?></span>    
                        </strong>
                        <?php if($countTmpVideoImported>0){ ?>
                        <a href="?page=yvtwp&yvtwp_controller=log&yvtwp_action=log&log_type=scheduling_videos_import&paged=1&import_id=<?php echo $importInfos['id'] ?>" ><?php _e('View logs for more details.', 'YVTWP-lang') ?></a>
                        <?php } ?>
                    </p>
                </div>
        </div>
</div>
