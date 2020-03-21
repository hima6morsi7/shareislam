<?php require_once Config_YVTWP::$views_dir.'header.php'; ?>

<div class="container yvtwp_container" style="padding: 20px 0px">
    
    <div class="row yvtwp_index_page">
        <div class="col-lg-2 col-md-6">
            <div class="panel panel_feed_channel">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-2">
                            <a href="?page=yvtwp&feed_type=feed_channel&paged=1">
                                <i class="total_feed_type"><?php echo $total_results_channel ?></i>
                            </a>
                        </div>
                        <div class="col-xs-10 text-right">
                            <div class="huge">
                                <a href="?page=yvtwp&feed_type=feed_channel&paged=1">
                                    <?php _e('Channels', 'YVTWP-lang') ?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="?page=yvtwp&yvtwp_controller=import&yvtwp_action=newImport&feed_type=feed_channel">
                    <div class="panel-footer">
                        <span class="pull-left"><?php _e('New Channel', 'YVTWP-lang') ?></span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-2 col-md-6">
            <div class="panel panel_feed_playlist">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-2">
                            <a href="?page=yvtwp&feed_type=feed_playlist&paged=1">
                            <i class="total_feed_type"><?php echo $total_results_playlist ?></i>
                            </a>
                        </div>
                        <div class="col-xs-10 text-right">
                            <div class="huge">
                                <a href="?page=yvtwp&feed_type=feed_playlist&paged=1">
                                    <?php _e('Playlists', 'YVTWP-lang') ?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="?page=yvtwp&yvtwp_controller=import&yvtwp_action=newImport&feed_type=feed_playlist">
                    <div class="panel-footer">
                        <span class="pull-left"><?php _e('New Playlist', 'YVTWP-lang') ?></span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-2 col-md-6">
            <div class="panel panel_feed_user">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-2">
                            <a href="?page=yvtwp&feed_type=feed_user&paged=1">
                                <i class="total_feed_type"><?php echo $total_results_user ?></i>
                            </a>
                        </div>
                        <div class="col-xs-10 text-right">
                            <div class="huge">
                                <a href="?page=yvtwp&feed_type=feed_user&paged=1">
                                    <?php _e('Users', 'YVTWP-lang') ?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="?page=yvtwp&yvtwp_controller=import&yvtwp_action=newImport&feed_type=feed_user">
                    <div class="panel-footer">
                        <span class="pull-left"><?php _e('New User', 'YVTWP-lang') ?></span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-2 col-md-6">
            <div class="panel panel_feed_search_query">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-2">
                            <a href="?page=yvtwp&feed_type=feed_search_query&paged=1">
                            <i class="total_feed_type"><?php echo $total_results_search_query ?></i>
                            </a>
                        </div>
                        <div class="col-xs-10 text-right">
                            <div class="huge">
                                <a href="?page=yvtwp&feed_type=feed_search_query&paged=1">
                                    <?php _e('Search Query', 'YVTWP-lang') ?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="?page=yvtwp&yvtwp_controller=import&yvtwp_action=newImport&feed_type=feed_search_query">
                    <div class="panel-footer">
                        <span class="pull-left"><?php _e('New Search Query', 'YVTWP-lang') ?></span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-2 col-md-6">
            <div class="panel panel_feed_single_video">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-2">
                            <a href="?page=yvtwp&feed_type=feed_single_video&paged=1">
                            <i class="total_feed_type"><?php echo $total_results_single_video ?></i>
                            </a>
                        </div>
                        <div class="col-xs-10 text-right">
                            <div class="huge">
                                <a href="?page=yvtwp&feed_type=feed_single_video&paged=1">
                                    <?php _e('Videos', 'YVTWP-lang') ?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="?page=yvtwp&yvtwp_controller=import&yvtwp_action=newImport&feed_type=feed_single_video">
                    <div class="panel-footer">
                        <span class="pull-left"><?php _e('New Video', 'YVTWP-lang') ?></span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>        
    </div> <!--End row-->  

 

<script type="text/javascript">
    
    function changeFeedType()
    {
        var value=jQuery("#select_feed_type").val();
        
        if(value)
        {
            if(value=='all'){
                window.location="?page=yvtwp";}
            else{
            window.location="?page=yvtwp&feed_type="+value+"&paged=1";}
        }
    }
    
    function onSuccessDeleteImport(response)
    {
        var args={"form_id":'yvtwp_form_delete_import',"status":response.status,"message":response.messages,"show_popin_error":0,"show_popin_success":0};
        afterSendAjaxRequest(args);        
        if(response.status=='1')
        {
            window.location='';   
        }        
    }
    
    function onSuccessClearCacheImport(response)
    {
        var args={"form_id":'yvtwp_form_clear_cache_import',"status":response.status,"message":response.messages,"show_popin_error":0,"show_popin_success":0};
        afterSendAjaxRequest(args);        
        if(response.status=='1')
        {
            window.location='';   
        }        
    }    
    
    jQuery(document).ready(function(){
        
        <?php if(isset($_REQUEST['feed_type'])){ ?>
                jQuery("#select_feed_type").val('<?php echo $_REQUEST['feed_type']  ?>');
        <?php } ?>
        
        //delete import
        jQuery(".delete_import").click(function(){
            var import_id=jQuery(this).attr("import_id");
            jQuery("#yvtwp_form_delete_import input[name=import_id]").val(import_id);
            if(import_id)
            {
                swal({
                    title: "<?php _e('Alert', 'YVTWP-lang') ?>",
                    text: "<?php _e("This will delete all content (posts, pages, etc) related to this import. Continue?", 'YVTWP-lang') ?>",
                    showCancelButton: true,type: "error",html: true,confirmButtonText: "Ok"
                },function(isConfirm)
                {   
                    if (isConfirm) {
                        //jQuery(this).parent('tr').css({'background-color':'red'});
                        var args={"form_id":'yvtwp_form_delete_import'};
                        beforeSendAjaxRequest(args);
                        sendAjaxRequest(onSuccessDeleteImport,'yvtwp_form_delete_import');
                    }//End isConfirm
                }); 

            }
            
        });
        //clear cache import
        jQuery(".clear_cache_import").click(function(){
            var import_id=jQuery(this).attr("import_id");
            jQuery("#yvtwp_form_clear_cache_import input[name=import_id]").val(import_id);
            if(import_id)
            {
                swal({
                    title: "<?php _e('Alert', 'YVTWP-lang') ?>",
                    text: "<?php _e("This will delete cached videos. Continue?", 'YVTWP-lang') ?>",
                    showCancelButton: true,type: "info",html: true,confirmButtonText: "<?php _e("Ok", 'YVTWP-lang') ?>"
                },function(isConfirm)
                {   
                    if (isConfirm) {
                        var args={"form_id":'yvtwp_form_clear_cache_import'};
                        beforeSendAjaxRequest(args);
                        sendAjaxRequest(onSuccessClearCacheImport,'yvtwp_form_clear_cache_import');
                    }//End isConfirm
                }); 

            }
            
        });        
        
    });
</script>

<?php 
    $feed_type_str="";
    $maxPaged=ceil($total_results/$default_paged);
    
    if($maxPaged==0)
        $maxPaged=1;
    
    if(!isset($_REQUEST['paged']))
        $_REQUEST['paged']=1;
    
    $paged_prev=$_REQUEST['paged'];

    if($paged_prev>1)
        $paged_prev=$paged_prev-1;
    
    $paged_next=$_REQUEST['paged'];
    if($paged_next<$maxPaged)
        $paged_next=$paged_next+1;

    if(isset($_REQUEST['feed_type']))
        $feed_type_str="&feed_type=".$_REQUEST['feed_type'];

    $base_link_next="?page=yvtwp".$feed_type_str."&paged=";
    $base_link_prev="?page=yvtwp".$feed_type_str."&paged=";

    if($paged_next==$_REQUEST['paged'])
    {
        $paged_next='';
        $base_link_next='#';
    }
    if($paged_prev==$_REQUEST['paged'])
    {
        $paged_prev='';
        $base_link_prev='#';
    }        
            
    ?>
<div class="yvtwp_divider"></div>
        <div class="form-group">
            <div class="row">  
                <div class="col-md-3" style="padding-top: 9px;">
                    <select class="form-control" name="feed_type" id="select_feed_type" >
                        <option value=""><?php _e("Select Feed Type", 'YVTWP-lang') ?></option>
                        <option value="all"><?php _e("All", 'YVTWP-lang') ?></option>
                        <?php foreach (Config_YVTWP::$feedType as $key => $value) { ?>
                            <option value="<?php echo $key ?>"><?php echo $value?></option>
                        <?php }  ?>
                    </select>                    
                </div>
                <div class="col-md-3" style="padding:9px 0px 0px 0px">
                    <input onclick="changeFeedType()" type="submit" name="filter_action" id="post-query-submit" class="button" value="<?php _e('Filter', 'YVTWP-lang') ?>">
                </div>
                <div class="col-md-6"> 
                    <div class="tablenav top">

                        <div class="tablenav-pages">
                            <span class="displaying-num"><?php echo $total_results.' ';    _e('Items', 'YVTWP-lang') ?> </span>
                            <span class="pagination-links">
                                <a class="prev-page disabled" title="<?php _e('Previous page', 'YVTWP-lang') ?>" href="<?php echo $base_link_prev.$paged_prev ?>" >‹</a>
                                <span class="paging-input">
                                    <label for="current-page-selector" class="screen-reader-text"><?php _e('Select a page', 'YVTWP-lang') ?></label>
                                    <input class="current-page" id="current-page-selector" title="<?php _e('Current page', 'YVTWP-lang') ?>" name="paged" value="<?php echo $_REQUEST['paged'] ?>" size="1" type="text">
                                    <?php _e('Of', 'YVTWP-lang') ?> <span class="total-pages"><?php echo $maxPaged ?></span>       
                                </span>
                                <a class="next-page" title="<?php _e('Next page', 'YVTWP-lang') ?>" href="<?php echo $base_link_next.$paged_next ?>" >›</a>
                            </span>
                        </div>
                    </div>                    
                </div>
            </div>                                            

        </div>
    <div class="table-responsive">
        <table id="table_video_list" class="table table-hover table-bordered table-condensed">
            <thead>
                <tr>
                    <th>
                        <span><?php _e('Feed Type', 'YVTWP-lang') ?></span>
                    </th>
                    <th>
                       <span><?php _e('Feed Name', 'YVTWP-lang') ?></span>
                    </th>   
                    <th>
                        <span><?php _e('Import type', 'YVTWP-lang') ?></span>
                    </th>                     
                    <th>
                        <span><?php _e('Total Videos', 'YVTWP-lang') ?></span>
                    </th>
                    <th>
                        <span><?php _e('Videos Imported', 'YVTWP-lang') ?></span>
                    </th>                     
                    <th>
                        <span><?php _e('Actions', 'YVTWP-lang') ?></span>
                    </th> 
                </tr>
            </thead>

            <tfoot>

            </tfoot>

            <tbody>
                <?php if(empty($listOfImports)){ ?>
                <tr>
                    <td colspan="7" align="center"><?php _e('No result', 'YVTWP-lang') ?></td>
                </tr>
                <?php }else{ ?>
                <?php 
                    foreach ($listOfImports as $key => $value) 
                    {
                        $option_name="yvtwp_import_settings_".$value['id'];
                        $import_settings=SettingsModel_YVTWP::getOption($option_name,Config_YVTWP::$default_import_setting,TRUE);   

                        if(!isset($import_settings['import_type']))
                        {
                            if($import_settings['import_without_pagination']=='yes')
                                $import_settings['import_type']='bulk_import';
                            else    
                                $import_settings['import_type']='paginate_import';                             
                        }
                        
                        if(!isset($import_settings['feed_title']) || empty($import_settings['feed_title']))
                        {
                            $import_settings['feed_title']=$value['feed_key'];
                        }
                        
                        
                ?>
               
                <tr>
                    <td>
                        <span><?php echo Config_YVTWP::$feedType[$value['feed_type']]; ?></span>
                    </td>
                    <td>
                        <a href="#" class="tooltip_feed_key" data-toggle="tooltip" data-placement="top" title="<?php echo $value['feed_key'] ?>">
                            <?php echo $import_settings['feed_title']; ?>
                        </a>
                    </td>
                    <td>
                        <span>
                            <?php 
                                    if($import_settings['feed_type']=='feed_single_video')
                                        echo 'Single import';
                                    else
                                        echo Config_YVTWP::$importTypes[$import_settings['import_type']];
                            ?>
                        </span>
                    </td>                    
                    <td>
                        <span><?php echo $value['total_results']; ?></span>
                    </td>
                    <td>
                        <?php 
                                /*if($import_settings['feed_type']=='feed_single_video')
                                    echo '1';
                                else*/
                                    echo Post_YVTWP::getPostsCountByImportId($value['id']);
                        ?>                        
                    </td>  
                    <td>
                        <span>
                            <a href="?page=yvtwp&yvtwp_controller=import&yvtwp_action=newImport&feed_type=<?php echo $value['feed_type'] ?>&import_type=<?php echo $import_settings['import_type'] ?>&paged=<?php echo $value['current_paged'] ?>&pageToken=<?php echo $value['next_page_token'] ?>&import_id=<?php echo $value['id'] ?>" title="<?php _e('Load Feed', 'YVTWP-lang') ?>">
                                <?php _e('Load', 'YVTWP-lang') ?>
                            </a> 
                        </span>
                        <span> | </span>
                        <span>
                            <a import_id="<?php echo $value['id'] ?>" class="clear_cache_import" title="<?php _e('Clear cache', 'YVTWP-lang') ?>">
                                <?php _e('Clear Cache', 'YVTWP-lang') ?>
                            </a> 
                        </span>
                        <span> | </span>
                        <span>
                            <a import_id="<?php echo $value['id'] ?>"  class="delete_import" title="<?php _e('Remove', 'YVTWP-lang') ?>">
                                <i class="dashicons dashicons-dismiss"></i>
                            </a>
                        </span>
                    </td>
                </tr>
                <?php } }//End else ?>
            </tbody>
        </table>
    </div>    
        <form id="yvtwp_form_delete_import" method="POST">
            <input type="hidden" name="action" value="<?php echo Config_YVTWP::$wp_ajax_action_name ?>" >
            <input type="hidden" name="yvtwp_controller" value="import" >
            <input type="hidden" name="yvtwp_action" value="delete" > 
            <input type="hidden" name="import_id" >
            
            <div class="yvtwp_user_fedback" style="float: right;max-width: 300px;text-align: right"> </div>
            
        </form>

        <form id="yvtwp_form_clear_cache_import" method="POST">
            <input type="hidden" name="action" value="<?php echo Config_YVTWP::$wp_ajax_action_name ?>" >
            <input type="hidden" name="yvtwp_controller" value="import" >
            <input type="hidden" name="yvtwp_action" value="clearCache" > 
            <input type="hidden" name="import_id" >
            
            <div class="yvtwp_user_fedback" style="float: right;max-width: 300px;text-align: right"> </div>
            
        </form>

<div style="max-width: 300px;margin: 20px auto">
    <?php if(isset($_REQUEST['feed_type']) && $_REQUEST['feed_type']=='feed_single_video' && $total_results_single_video>1){ ?>
    <a href="?page=yvtwp&yvtwp_controller=import&yvtwp_action=allSingleVidoesImport" class="btn btn-primary btn-lg">
        <?php _e('Update all single video imports', 'YVTWP-lang') ?>
    </a>
    <?php } ?>
</div>    

</div>