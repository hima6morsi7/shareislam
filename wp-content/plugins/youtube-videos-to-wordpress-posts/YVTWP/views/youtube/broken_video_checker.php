<?php require_once Config_YVTWP::$views_dir.'header.php'; ?>

<div class="container yvtwp_container">

<script type="text/javascript"> 
    function addImportLog(result)
    {  
        jQuery(".no_broken_videos").remove();
        jQuery(".table_broken_videos tr").removeClass("current_broken_tr");
        
        var tr='<tr class="current_broken_tr" log_id="'+result['log_id']+'" post_id="'+result['post_id']+'">'+result['messages']+'</tr>';
        
        jQuery(".table_broken_videos tbody").prepend(tr);         
    }
    function start_check()
    {
        if(jQuery("input[name=auto_check_status]").val()=='1')
        {
            var args={"form_id":'yvtwp_form_broken_video_checker'};

            beforeSendAjaxRequest(args);
            sendAjaxRequest(onSuccessBrokenVideoChecker,'yvtwp_form_broken_video_checker');   
        }
      
    }
    /*
     */
    function onSuccessBrokenVideoChecker(response)
    {
        var args={"form_id":'yvtwp_form_broken_video_checker',"status":response.status,"message":response.messages,"show_popin_error":0,"show_popin_success":0};
        afterSendAjaxRequest(args);
        
        var result=response.result;    
        
       if(jQuery.isNumeric(result['checkedVideosCount']))
        {
            jQuery(".checked_videos_count").text(result['checkedVideosCount']); 
            var checkedVideosCount=result['checkedVideosCount'];
            var total_videos_to_check=<?php echo $total_videos_to_check ?>;        

            var valuenow=(checkedVideosCount/total_videos_to_check)*100;
            var valuenow=Math.ceil(valuenow);

            var width=valuenow+'%';
            jQuery(".progress-bar").css({'width':width});
            jQuery(".progress-bar .content_poucentage").text(width);
            jQuery(".progress-bar").attr('aria-valuenow',valuenow);
        }         
        
        if(result['check_status']=='end')
        {
            //total_videos_to_check=checkedVideosCount;
            jQuery(".total_videos_to_check").text(total_videos_to_check); 

            jQuery('#stop_check').hide();
            jQuery("input[name=auto_check_status]").val('0'); 
            jQuery("#start_check").show(1000);
        }            
        
        if(response.status=='1')
        {
            setTimeout('start_check()',0*1000);
        }      
        else if(response.status=='0')
        {   
            addImportLog(result);   
            
            //check if import i stopped and send new request
            if(jQuery("input[name=auto_check_status]").val()=='1')
            {
                setTimeout('start_check()',0*1000);
            }
        }
        
        jQuery("#button_init_check").css({'display':'block'});     
    }//End function

    jQuery(document).ready(function(){
    
        jQuery('#stop_check').hide();
    
        jQuery('#start_check').click(function(){
            
            jQuery("input[name=auto_check_status]").val('1');
            jQuery('#start_check').hide();
            jQuery("#stop_check").show(3000);             
            start_check();
        }); 
        jQuery('#stop_check').click(function(){
            
            jQuery("input[name=auto_check_status]").val('0'); 
            jQuery('#stop_check').hide();
            jQuery("#start_check").show(3000);   
            
            stop_check();
            
            var msg_content='<div class="updated notice is-dismissible below-h2 alert alert-success"><p class="yvtwp_msg_content"><?php _e("Bulk import has been stopped", 'YVTWP-lang') ?></p></div>';
            jQuery("#yvtwp_form_broken_video_checker .yvtwp_user_fedback").html(msg_content); 
            jQuery("#yvtwp_form_broken_video_checker .yvtwp_content_save_button").css({'display':'block'});            
        });        
        
    });
</script>
<div class="yvtwp_divider" style="text-align: center;font-weight: bold;font-size: 26px;">
        <?php _e('Broken videos checker', 'YVTWP-lang') ?>  
    </div>
<form id="yvtwp_form_broken_video_checker" method="POST" style="max-width: 880px;margin: auto"> 
    <div class="auto_import_feedback">
        <div class="yvtwp_user_fedback"> </div>
    </div>
    <div>
        <input type="hidden" name="action" value="<?php echo Config_YVTWP::$wp_ajax_action_name ?>" >
        <input type="hidden" name="yvtwp_controller" value="brokenVideo" >
        <input type="hidden" name="yvtwp_action" value="brokenVideoChecker" > 
        <input type="hidden" name="auto_check_status" value="0" >
    </div>

</form>

<?php 
    $progress_value=0;
    if($total_videos_to_check!=0)
        $progress_value=($countVideosChecked/$total_videos_to_check)*100; 
?>
<div class="row">
    <div class="col-md-12 content_buttons">
        <div>
            <input id="start_check" type="button" class="btn btn-primary btn-default" value="<?php _e('Start', 'YVTWP-lang') ?>">
            <input id="stop_check" type="button" class="btn btn-primary btn-default" value="<?php _e('Stop', 'YVTWP-lang') ?>">
        </div>
    </div>
    <div class="col-md-12">
        <div class="progress_number">
            <?php _e('Processed videos: ', 'YVTWP-lang') ?>
            <span class="checked_videos_count"><?php echo $countVideosChecked ?></span>
            <span class="span_sep"> / </span>
            <span class="total_videos_to_check"><?php echo $total_videos_to_check ?></span>
           
        </div>
    </div>    
    <div class="col-md-12" style="text-align: center;">
        <div class="col-md-1"></div>
        <div class="col-md-1 form-group" style="margin-bottom: 0px">
            
            <input id="button_init_check" style="<?php if($countVideosChecked==0){echo 'display: none;';} ?>"  type="button" class="btn btn-primary" value="<?php _e("Cancel", 'YVTWP-lang') ?>" />
        </div>
        <div class="col-md-10" style="max-width: 700px;margin: auto;margin-top: 15px">
            <div class="progress" style="max-width: 700px">
              <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo ceil($progress_value) ?>"
              aria-valuemin="0" aria-valuemax="100" style="width:<?php echo ceil($progress_value) ?>%">
                  <span class="content_poucentage"><?php echo ceil($progress_value) ?>%</span>
              </div>
            </div>  
            <!--<div class="progress">
              <div class="progress-bar progress-bar-striped active" role="progressbar"
                   aria-valuenow="<?php echo $progress_value ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo ceil($progress_value) ?>%">
                <?php echo ceil($progress_value) ?>%
              </div>
            </div>  -->          
        </div>
        
    </div>
</div>




    
<script type="text/javascript">

    function onSuccessInitCheck(response)
    {
        var args={"form_id":'yvtwp_form_init_check',"status":response.status,"message":response.messages,"show_popin_error":0,"show_popin_success":0};
        afterSendAjaxRequest(args);        
        if(response.status=='1')
        {
            window.location='';   
        } 
    }
    /*
     * 
     */
    function onSuccessDeleteChecked(response)
    {
        var args={"form_id":'yvtwp_form_delete_checked',"status":response.status,"message":response.messages,"show_popin_error":0,"show_popin_success":0};
        afterSendAjaxRequest(args);        
        if(response.status=='1')
        {
            window.location='';   
        } 
    }    
    /*
     */
    jQuery(document).ready(function(){
        
        //init check
        jQuery("#button_init_check").click(function(){

            swal({
                title: "<?php _e('Alert', 'YVTWP-lang') ?>",
                text: "<?php _e("This will cancel the current check", 'YVTWP-lang') ?>",
                showCancelButton: true,type: "error",html: true,confirmButtonText: "Ok"
            },function(isConfirm)
            {   
                if (isConfirm) {
                    //jQuery(this).parent('tr').css({'background-color':'red'});
                    var args={"form_id":'yvtwp_form_init_check'};
                    beforeSendAjaxRequest(args);
                    sendAjaxRequest(onSuccessInitCheck,'yvtwp_form_init_check');
                }//End isConfirm
            }); 
        });    
        
        //delete checked
        jQuery(document).on('click','.button_delete_checked',function(){

        jQuery("input[name=log_id]").val(jQuery(this).closest('tr').attr('log_id'));

            swal({
                title: "<?php _e('Alert', 'YVTWP-lang') ?>",
                text: "<?php _e("This will removed the video and its attached content", 'YVTWP-lang') ?>",
                showCancelButton: true,type: "error",html: true,confirmButtonText: "Ok"
            },function(isConfirm)
            {   
                if (isConfirm) {
                    //jQuery(this).parent('tr').css({'background-color':'red'});
                    var args={"form_id":'yvtwp_form_delete_checked'};
                    beforeSendAjaxRequest(args);
                    sendAjaxRequest(onSuccessInitCheck,'yvtwp_form_delete_checked');
                }//End isConfirm
            }); 
        });         
        
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


    <div class="form-group" style="margin-bottom: 0px">
            <div class="row">  
                <div class="col-md-6">
             
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
        <table id="table_video_list_log" class="table table-hover table-bordered table-condensed table_broken_videos">
            <thead>
                <tr>
                    <th>
                        <span><?php _e('Date ', 'YVTWP-lang') ?></span>
                    </th>
                   <th>
                       <span><?php _e('Video', 'YVTWP-lang') ?></span>
                    </th>                     
                   <th>
                       <span><?php _e('Status', 'YVTWP-lang') ?></span>
                    </th> 
                   <th>
                       <span><?php _e('Actions', 'YVTWP-lang') ?></span>
                    </th>                     
                </tr>
            </thead>

            <tfoot>

            </tfoot>

            <tbody>
                <?php if(empty($listOfLogs)){ ?>
                <tr class="no_broken_videos">
                    <td colspan="7" align="center"><?php _e('No Broken videos', 'YVTWP-lang') ?></td>
                </tr>
                <?php }else{ ?>
                <?php foreach ($listOfLogs as $key => $value) {
                    ?>
               
                <tr log_id="<?php echo $value['id'] ?>">
                        <?php echo LogModel_YVTWP::getMessageLogFromResponse($value); ?>
                </tr>
                <?php } }//End else ?>
            </tbody>
        </table>
    </div>  

    <form id="yvtwp_form_init_check" method="POST">
        <input type="hidden" name="action" value="<?php echo Config_YVTWP::$wp_ajax_action_name ?>" >
        <input type="hidden" name="yvtwp_controller" value="brokenVideo" >
        <input type="hidden" name="yvtwp_action" value="initCheck" > 

        <div class="yvtwp_user_fedback" style="float: right;max-width: 300px;text-align: right"> </div>

    </form>

    <form id="yvtwp_form_delete_checked" method="POST">
        <input type="hidden" name="action" value="<?php echo Config_YVTWP::$wp_ajax_action_name ?>" >
        <input type="hidden" name="yvtwp_controller" value="brokenVideo" >
        <input type="hidden" name="yvtwp_action" value="deleteChecked" > 
        <input type="hidden" name="log_id" value="" />

        <div class="yvtwp_user_fedback" style="float: right;max-width: 300px;text-align: right"> </div>

    </form>


</div>