<script type="text/javascript"> 
    function addImportLog(result)
    {  
        jQuery(".content_table_video_list").css({'display':'block'});
        
        jQuery.each( result, function( key, value ) {
            
            var result_video=value.result;

            var link_comments='';
            if(value.status=='1') //imported or updated
            {
                if(result_video.comment_count!='0')
                    link_comments=' | <a target="_blanck" href="'+result_video.comments_link+'"> <?php _e('Comments', 'YVTWP-lang') ?> ['+result_video.comment_count+'] </a>';
                
                if(result_video.is_updated=='yes')
                {
                    var link_view='<br/><a target="_blanck" href="'+result_video.view_link+'"> <?php _e('View', 'YVTWP-lang') ?> </a>';
                    var link_edit=' | <a target="_blanck" href="'+result_video.edit_link+'"> <?php _e('Edit', 'YVTWP-lang') ?> </a>';
                    var p_result='<tr class="tr_updated is_all"><td>'+result_video.video_title+'</td><td class="td_msg success" style="color:green">'+value.messages+link_view+link_edit+link_comments+'</td></tr>';
                    jQuery("#table_video_list").prepend(p_result);                    
                }
                else
                {
                    var link_view='<br/><a target="_blanck" href="'+result_video.view_link+'"> <?php _e('View', 'YVTWP-lang') ?> </a>';
                    var link_edit=' | <a target="_blanck" href="'+result_video.edit_link+'"> <?php _e('Edit', 'YVTWP-lang') ?> </a>';
                    var p_result='<tr class="tr_imported is_all"><td>'+result_video.video_title+'</td><td class="td_msg success" style="color:green">'+value.messages+link_view+link_comments+link_edit+'</td></tr>';
                    jQuery("#table_video_list").prepend(p_result);                    
                }

                
            }
            else //skipped
            {
                if(result_video.is_broken && result_video.is_broken=='yes')
                {
                    var p_result='<tr class="tr_skipped is_all"><td>'+result_video.video_title+'</td><td class="td_msg warning" style="color:red">'+value.messages+'</td></tr>';
                }
                else
                {
                    var link_view='<br/><a target="_blanck" href="'+result_video.view_link+'"> <?php _e('View', 'YVTWP-lang') ?> </a>';
                    var link_edit=' | <a target="_blanck" href="'+result_video.edit_link+'"> <?php _e('Edit', 'YVTWP-lang') ?> </a>';
                    var p_result='<tr class="tr_skipped is_all"><td>'+result_video.video_title+'</td><td class="td_msg warning" style="color:red">'+value.messages+link_view+link_edit+'</td></tr>';                    
                }
                jQuery("#table_video_list").prepend(p_result);
            }
        });   
        
        jQuery(".is_all .filter_count").text("["+jQuery("#table_video_list .is_all").length+"]");
        jQuery(".tr_updated .filter_count").text("["+jQuery("#table_video_list .tr_updated").length+"]");
        jQuery(".tr_imported .filter_count").text("["+jQuery("#table_video_list .tr_imported").length+"]");
        jQuery(".tr_skipped .filter_count").text("["+jQuery("#table_video_list .tr_skipped").length+"]");
        
        
    }
    function start_import()
    {
        if(jQuery("input[name=auto_import_status]").val()=='1')
        {
            var args={"form_id":'yvtwp_form_import_all_feed_videos'};

            beforeSendAjaxRequest(args);
            sendAjaxRequest(onSuccessImportAllFeedVideos,'yvtwp_form_import_all_feed_videos');   
        }
      
    }
    /*
     */
    function stop_import()
    {
        var args={"form_id":'yvtwp_form_check_auto_import_result'};
        beforeSendAjaxRequest(args);
        sendAjaxRequest(onSuccessCheckAutoImportResult,'yvtwp_form_check_auto_import_result');  
    }
    /*
     */
    function onSuccessImportAllFeedVideos(response)
    {
        var args={"form_id":'yvtwp_form_import_all_feed_videos',"status":response.status,"message":response.messages,"show_popin_error":0,"show_popin_success":0};
        afterSendAjaxRequest(args);
        
        var result=response.result;    
        
        if(response.status=='1')
        {
            if(jQuery.isNumeric(result['TmpImportedVideo']))
            {
                jQuery(".videos_imported").text(result['TmpImportedVideo']); 
                var TmpImportedVideo=result['TmpImportedVideo'];
                var total_results=<?php if($importInfos['total_results']){echo $importInfos['total_results'];}else{echo '0';} ?>;

                if(result['import_status']=='end')
                {
                    //total_results=TmpImportedVideo;
                    jQuery(".totals_result").text(total_results); 
                    
                    jQuery('#stop_import').hide();
                    jQuery("input[name=auto_import_status]").val('0'); 
                    jQuery("#start_import").show(3000);
                }            

                var valuenow=(TmpImportedVideo/total_results)*100;
                var valuenow=Math.ceil(valuenow);

                var width=valuenow+'%';
                jQuery(".progress-bar").css({'width':width});
                jQuery(".progress-bar .content_poucentage").text(width);
                jQuery(".progress-bar").attr('aria-valuenow',valuenow);
                
                /*if(parseInt(result['TmpImportedVideo'])>0)
                jQuery("#tab_schedule_options input[name=schedule_start_date]").attr('disabled','disabled');*/
            } 
            //check if import i stopped and send new request
            if(jQuery("input[name=auto_import_status]").val()=='1')
            {
                setTimeout('start_import()',<?php echo $generalSettings['bulk_import_time_check_result']*1000 ?>);
            }
            
            if(result['result_import'])
            {
                addImportLog(result['result_import']);
            }
        }      
        else if(response.status=='0')
        {
            setTimeout('start_import()',30*1000);       
        }
    }//End function
    
    function onSuccessCheckAutoImportResult(response)
    {
        var args={"form_id":'yvtwp_form_check_auto_import_result',"status":response.status,"message":response.messages,"show_popin_error":1,"show_popin_success":1};
        //afterSendAjaxRequest(args);
        
        var result=response.result;   
        
        if(response.status=='1')
        {
            if(result)
            {
                if(jQuery.isNumeric(result['TmpImportedVideo']))
                {
                    jQuery(".videos_imported").text(result['TmpImportedVideo']); 
                    var TmpImportedVideo=result['TmpImportedVideo'];
                    var total_results=<?php if($importInfos['total_results']){echo $importInfos['total_results'];}else{echo '0';} ?>;

                    var valuenow=(TmpImportedVideo/total_results)*100;
                    var valuenow=Math.ceil(valuenow);

                    var width=valuenow+'%';
                    jQuery(".progress-bar").css({'width':width});
                    jQuery(".progress-bar .content_poucentage").text(width);
                    jQuery(".progress-bar").attr('aria-valuenow',valuenow);
                }
            }
        }  
    }

    jQuery(document).ready(function(){
    
        jQuery('#start_import').click(function(){
            jQuery("input[name=auto_import_status]").val('1');
            jQuery('#start_import').hide();
            jQuery("#stop_import").show(3000);             
            start_import();
        }); 
        jQuery('#stop_import').click(function(){
            
            jQuery("input[name=auto_import_status]").val('0'); 
            jQuery('#stop_import').hide();
            jQuery("#start_import").show(3000);   
            
            stop_import();
            
            var msg_content='<div class="updated notice is-dismissible below-h2 alert alert-success"><p class="yvtwp_msg_content"><?php _e("Bulk import has been stopped", 'YVTWP-lang') ?></p></div>';
            jQuery("#yvtwp_form_import_all_feed_videos .yvtwp_user_fedback").html(msg_content); 
            jQuery("#yvtwp_form_import_all_feed_videos .yvtwp_content_save_button").css({'display':'block'});            
        });        
   
        //when leaving page import
        jQuery(window).bind('beforeunload',function(){
            //stop_import();
        });
        
        jQuery(".filter_button").click(function(){
            var class_ref=jQuery(this).attr('class_ref');
            
            jQuery(".is_all").css({'visibility':'hidden','position':'absolute'});
            jQuery("."+class_ref).css({'visibility':'visible','position':'relative'});
            
        });
        
    });
</script>
<div class="yvtwp_divider"></div>
<form id="yvtwp_form_import_all_feed_videos" method="POST" style="max-width: 880px;margin: auto"> 
    <div class="auto_import_feedback">
        <div class="yvtwp_user_fedback"> </div>
    </div>
    <div>
        <input type="hidden" name="action" value="<?php echo Config_YVTWP::$wp_ajax_action_name ?>" >
        <input type="hidden" name="yvtwp_controller" value="import" >
        <input type="hidden" name="yvtwp_action" value="importAllFeedVideos" > 
        <input type="hidden" name="import_id" value="<?php echo $_REQUEST['import_id'] ?>" >
    </div>

</form>

<form id="yvtwp_form_check_auto_import_result" method="POST"> 
    <div>
        <input type="hidden" name="action" value="<?php echo Config_YVTWP::$wp_ajax_action_name ?>" >
        <input type="hidden" name="yvtwp_controller" value="import" >
        <input type="hidden" name="yvtwp_action" value="checkAutoImportResult" > 
        <input type="hidden" name="import_id" value="<?php echo $_REQUEST['import_id'] ?>" >
        <input type="hidden" name="auto_import_status" value="0">
    </div>

</form>
<?php 
    $progress_value=0;
    if($total_results!=0)
        $progress_value=($countTmpVideoImported/$total_results)*100; 
?>
<div class="row">
    <div class="col-md-12 content_buttons">
        <div>
            <input id="start_import" type="button" class="btn btn-primary btn-default" value="<?php _e('Start', 'YVTWP-lang') ?>">
            <input id="stop_import" type="button" class="btn btn-primary btn-default" value="<?php _e('Stop', 'YVTWP-lang') ?>">
        </div>
    </div>
    <div class="col-md-12">
        <div class="progress_number">
            <?php _e('Imported videos: ', 'YVTWP-lang') ?>
            <span class="videos_imported"><?php echo $countTmpVideoImported ?></span>
            <span class="span_sep"> / </span>
            <span class="totals_result"><?php echo $total_results ?></span>
           
        </div>
    </div>    
    <div class="col-md-12" style="text-align: center;">
        <div style="max-width: 850px;margin: auto;margin-top: 15px">
            <div class="progress" style="max-width: 850px">
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
        
        <div class="col-md-12" style="text-align: right;">
            <div style="max-width: 850px;margin: auto;margin-top: 5px">
                <?php if($countTmpVideoImported>0){ ?>
                <a href="?page=yvtwp&yvtwp_controller=log&yvtwp_action=log&log_type=normal_videos_import&paged=1&import_id=<?php echo $importInfos['id']; ?>" ><?php _e('View logs for more details.', 'YVTWP-lang') ?></a>
                <?php } ?>                
            </div>            
        </div>
        
        <ul class="nav nav-tabs content_table_video_list" style="max-width: 850px;margin: auto;display: none">
            <li class_ref="is_all"  class="active filter_button is_all"><a  data-toggle="tab"><?php _e('All', 'YVTWP-lang') ?><span class="filter_count"></span></a></li>
            <li class_ref="tr_imported" class="filter_button tr_imported"><a  data-toggle="tab"><?php _e('Imported', 'YVTWP-lang') ?><span class="filter_count"></span></a></li>
            <li class_ref="tr_updated" class="filter_button tr_updated"><a  data-toggle="tab"><?php _e('Updated', 'YVTWP-lang') ?><span class="filter_count"></span></a></li>
            <li class_ref="tr_skipped" class="filter_button tr_skipped"><a  data-toggle="tab"><?php _e('Skipped', 'YVTWP-lang') ?><span class="filter_count"></span></a></li>
        </ul>
        <div class="table-responsive content_table_video_list" style="max-width: 850px;margin: auto;max-height: 300px;overflow-y: scroll;display: none">
            <table id="table_video_list" class="table table-hover table-bordered table-condensed">
                
            </table>
        </div>
        
    </div>
</div>
