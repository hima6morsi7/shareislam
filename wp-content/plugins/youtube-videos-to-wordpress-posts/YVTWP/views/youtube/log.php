<?php require_once Config_YVTWP::$views_dir.'header.php';
?>

<div class="container yvtwp_container" style="padding: 20px 0px">
    
<script type="text/javascript">
    
    /*
     */
    function changeFeedType()
    {
        var value=jQuery("#select_log_type").val();
        
        if(value)
        {
            if(value=='all'){
                window.location="?page=yvtwp&yvtwp_controller=log&yvtwp_action=log";}
            else{
            window.location="?page=yvtwp&yvtwp_controller=log&yvtwp_action=log&log_type="+value+"&paged=1";}
        }
    }
    /*
     */
    function onSuccessClearLog(response)
    {
        var args={"form_id":'yvtwp_form_clear_log',"status":response.status,"message":response.messages,"show_popin_error":0,"show_popin_success":0};
        afterSendAjaxRequest(args);        
        if(response.status=='1')
        {
            window.location='';   
        } 
    }
    /*
     */
    jQuery(document).ready(function(){
        
        //delete import
        jQuery("#button_clear_log").click(function(){

            swal({
                title: "<?php _e('Alert', 'YVTWP-lang') ?>",
                text: "<?php _e("This will delete all logs", 'YVTWP-lang') ?>",
                showCancelButton: true,type: "error",html: true,confirmButtonText: "Ok"
            },function(isConfirm)
            {   
                if (isConfirm) {
                    //jQuery(this).parent('tr').css({'background-color':'red'});
                    var args={"form_id":'yvtwp_form_clear_log'};
                    beforeSendAjaxRequest(args);
                    sendAjaxRequest(onSuccessClearLog,'yvtwp_form_clear_log');
                }//End isConfirm
            }); 
        });     
        
        <?php if(isset($_REQUEST['log_type'])){ ?>
            jQuery("#select_log_type").val("<?php echo $_REQUEST['log_type'] ?>");
        <?php } ?>
        
    });
</script>

<?php 
    $log_type_str="";
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
        
    if(isset($_REQUEST['log_type']))
        $log_type_str="&log_type=".$_REQUEST['log_type'];

    $base_link_next="?page=yvtwp&yvtwp_controller=log&yvtwp_action=log".$log_type_str."&paged=";
    $base_link_prev="?page=yvtwp&yvtwp_controller=log&yvtwp_action=log".$log_type_str."&paged=";

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

<?php if($total_results>0){ ?>
    <div class="form-group" style="float: right">
        <input id="button_clear_log"  type="button" class="btn btn-primary" value="<?php _e("Clear log", 'YVTWP-lang') ?>" />
    </div>
<?php } ?>

<div class="yvtwp_divider row"> </div>

        <div class="form-group">
            <div class="row">  
                <div class="col-md-3" style="padding-top: 9px;">
                    <select class="form-control" name="log_type" id="select_log_type" >
                        <option value=""><?php _e("Select Log Type", 'YVTWP-lang') ?></option>
                        <option value="all"><?php _e("All", 'YVTWP-lang') ?></option>
                        <?php foreach (Config_YVTWP::$logType as $key => $value) { ?>
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
        <table id="table_video_list_log" class="table table-hover table-bordered table-condensed">
            <thead>
                <tr>
                    <th>
                        <span><?php _e('Date ', 'YVTWP-lang') ?></span>
                    </th>
                   <th>
                       <span><?php _e('Message', 'YVTWP-lang') ?></span>
                    </th>                    
                </tr>
            </thead>

            <tfoot>

            </tfoot>

            <tbody>
                <?php if(empty($listOfLogs)){ ?>
                <tr>
                    <td colspan="7" align="center"><?php _e('No result', 'YVTWP-lang') ?></td>
                </tr>
                <?php }else{ ?>
                <?php foreach ($listOfLogs as $key => $value) {
                    ?>
               
                <tr>
                    <td class="log_td_date">
                        <span><?php echo $value['date']; ?></span>
                    </td> 
                    <td>
                        <span><?php echo LogModel_YVTWP::getMessageLogFromResponse($value); ?></span>
                    </td>
                </tr>
                <?php } }//End else ?>
            </tbody>
        </table>
    </div>    
        <form id="yvtwp_form_clear_log" method="POST">
            <input type="hidden" name="action" value="<?php echo Config_YVTWP::$wp_ajax_action_name ?>" >
            <input type="hidden" name="yvtwp_controller" value="log" >
            <input type="hidden" name="yvtwp_action" value="clearLog" > 
            
            <div class="yvtwp_user_fedback" style="float: right;max-width: 300px;text-align: right"> </div>
            
        </form>

</div>