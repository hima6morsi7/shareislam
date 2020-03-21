<?php $time_check_result=( isset($generalSettings['paginate_import_time_check_result']) ? $generalSettings['paginate_import_time_check_result'] : 5); ?>
<script type="text/javascript"> 
    function onSuccessImportFeed(response)
    {
        var args={"form_id":'yvtwp_form_import_feed',"status":response.status,"message":response.messages,"show_popin_error":1,"show_popin_success":0};
        afterSendAjaxRequest(args);
        
        var result=response.result;       
        //init td message
        //jQuery(".td_msg").remove();
        if(result['import_status']=='end')
        {
            jQuery("#yvtwp_form_import_feed .yvtwp_save_button").removeAttr('disabled');
            jQuery("#yvtwp_form_import_feed .yvtwp_save_button").attr('value','<?php _e('Import selected', 'YVTWP-lang') ?>');  
        }
        
        jQuery.each( result, function( key, value ) {
            
            var result_video=value.result;

            jQuery(".row_"+result_video.video_key+" .td_msg").remove();
            
            var link_comments='';

            if(value.status=='1') //imported
            {
                if(result_video.comment_count!='0')
                    link_comments=' | <a target="_blanck" href="'+result_video.comments_link+'"> <?php _e('Comments', 'YVTWP-lang') ?> ['+result_video.comment_count+'] </a>';
                    
                var link_view='<br/><a target="_blanck" href="'+result_video.view_link+'"> <?php _e('View', 'YVTWP-lang') ?> </a>';
                var link_edit=' | <a target="_blanck" href="'+result_video.edit_link+'"> <?php _e('Edit', 'YVTWP-lang') ?> </a>';
                var p_result='<td class="td_msg success" style="color:green">'+value.messages+link_view+link_edit+link_comments+'</td>';
                jQuery(".row_"+result_video.video_key).append(p_result);
                
                //jQuery("#tab_schedule_options input[name=schedule_start_date]").attr('disabled','disabled');
            }
            else //skipped
            {
                if(result_video.is_broken && result_video.is_broken=='yes')
                {
                    var p_result='<td class="td_msg warning" style="color:red">'+value.messages+'</td>';
                }
                else
                {
                    var link_view='<br/><a target="_blanck" href="'+result_video.view_link+'"> <?php _e('View', 'YVTWP-lang') ?> </a>';
                    var link_edit=' | <a target="_blanck" href="'+result_video.edit_link+'"> <?php _e('Edit', 'YVTWP-lang') ?> </a>';
                    var p_result='<td class="td_msg warning" style="color:red">'+value.messages+link_view+link_edit+'</td>';   
                }
                jQuery(".row_"+result_video.video_key).append(p_result);
            }
        });

        var str_ids = jQuery("[name=selected_videos_id_copier]").val();
        var array_ids = str_ids.split(",");

        next_video_id=array_ids.shift();
        jQuery("[name=selected_videos_id_copier]").val(array_ids.join());

        setTimeout(function(){

            jQuery("[name=selected_videos_id]").val(next_video_id);
            sendRequestVideo(next_video_id);

        },<?php echo $time_check_result*1000; ?>,next_video_id);          
  
    }//End function
    
        function sendRequestVideo(video_id)
        {
            if(video_id!='')
            {
                jQuery("[name=selected_videos_id]").val(video_id);
                var args={"form_id":'yvtwp_form_import_feed'};
                //msgSuccessAjax(0,'yvtwp_form_import_feed',1); //init image waiting and msg box
                beforeSendAjaxRequest(args);
                sendAjaxRequest(onSuccessImportFeed,'yvtwp_form_import_feed'); 
                
                if(jQuery("[name=selected_videos_id_copier]").val()!='')
                {
                    jQuery("#yvtwp_form_import_feed .yvtwp_save_button").attr('disabled','disabled');
                    jQuery("#yvtwp_form_import_feed .yvtwp_save_button").attr('value','<?php echo sprintf(__('Sleeping for %s seconds!', 'YVTWP-lang'),$time_check_result) ?>');
                }
            }
            else
            {
                jQuery("#yvtwp_form_import_feed .yvtwp_save_button").removeAttr('disabled');
                jQuery("#yvtwp_form_import_feed .yvtwp_save_button").attr('value','<?php _e('Import selected', 'YVTWP-lang') ?>');                
            }
        }    

    jQuery(document).ready(function(){

        //when select all
        jQuery("#yvtwp-select-all").click(function(){
            var is_checked=jQuery(this).attr("checked");
            jQuery(".checkbox_video").each(function(){           
                if(is_checked=="checked"){
                    jQuery(this).attr("checked","checked");
                } 
                else
                {
                    jQuery(this).removeAttr("checked");
                }
            });
        });

        jQuery('#yvtwp_form_import_feed .yvtwp_save_button').click(function(){
            jQuery(".td_msg").remove();
            var ids_selected=[];
            jQuery(".checkbox_video").each(function(){
                var is_checked=jQuery(this).attr("checked");
                if(is_checked=="checked"){
                    ids_selected.push(jQuery(this).val());  
                }
            });
                        
            if(ids_selected.join()!='')
            {
                jQuery("[name=selected_videos_id_copier]").val(ids_selected.join());

                var str_ids = jQuery("[name=selected_videos_id_copier]").val();
                var array_ids = str_ids.split(",");

                next_video_id=array_ids.shift();
                jQuery("[name=selected_videos_id_copier]").val(array_ids.join());                

                sendRequestVideo(next_video_id);
                
            }
            else
            {
                alert("<?php _e("No selected videos", 'YVTWP-lang') ?>");
            }
        }); 

    });
  
</script>

<?php
if($response->status==0){ ?>
    <div class="alert alert-danger">
        <?php echo $response->messages  ?>
    </div>
    <div>
        <a href="" class="yvtwp_save_button btn btn-primary btn-lg"><?php _e('Try again', 'YVTWP-lang') ?></a>
    </div>

<?php } else{ ?>

<div class="yvtwp_divider" style="text-align: right"></div>

<div class="wrap">   
    <div class="table-responsive">   
        <table width="100%">
            <tr>
                <?php if($GLOBALS['import_exist']&&$_REQUEST['yvtwp_action']=='newImport'&&isset($_REQUEST['paged'])){ ?>
                <td width="100%">
                    <div class="updated notice is-dismissible below-h2 alert alert-success">
                        <p><?php _e('This is a cached result!', 'YVTWP-lang') ?></p>
                    </div>                    
                </td>
                <?php } ?>   
            </tr>
        </table>

        <?php require Config_YVTWP::$views_dir.'youtube/partials/import_tabs/videos_list_head_and_footer.php'; ?>
        <table id="table_video_list" class="table table-hover table-bordered table-condensed">
        <thead>
            <tr>
                <th>
                    <input id="yvtwp-select-all" type="checkbox" title="Tout sélectionner">
                </th>
                <th>
                    <span><?php _e('Video Title', 'YVTWP-lang') ?></span>
                </th>
                <?php if($feedPageAttributs['description']==1){ ?>
                <th>
                   <span><?php _e('Description', 'YVTWP-lang') ?></span>
                </th>  
                <?php } ?>                
                <?php if($feedPageAttributs['channel_title']==1){ ?>
                <th>
                   <span><?php _e('Channel Title', 'YVTWP-lang') ?></span>
                </th>  
                <?php } ?>
                <?php if($feedPageAttributs['views']==1){ ?>
                <th >
                    <span><?php _e('Views', 'YVTWP-lang') ?></span>
                </th>  
                <?php } ?>
                <?php if($feedPageAttributs['likes']==1){ ?>
                <th>
                    <span><?php _e('Likes', 'YVTWP-lang') ?></span>
                </th>
                <?php } ?>  
                <?php if($feedPageAttributs['dislikes']==1){ ?>
                <th>
                    <span><?php _e('Dislikes', 'YVTWP-lang') ?></span>
                </th>
                <?php } ?> 
                <?php if($feedPageAttributs['favorites']==1){ ?>
                <th>
                    <span><?php _e('Favorites', 'YVTWP-lang') ?></span>
                </th>
                <?php } ?> 
                <?php if($feedPageAttributs['comments']==1){ ?>
                <th>
                    <span><?php _e('Comments', 'YVTWP-lang') ?></span>
                </th>
                <?php } ?>  
                <?php if($feedPageAttributs['duration']==1){ ?>
                <th>
                    <span><?php _e('Duration', 'YVTWP-lang') ?></span>
                </th>
                <?php } ?> 
                <?php if($feedPageAttributs['dimension']==1){ ?>
                <th>
                    <span><?php _e('Dimension', 'YVTWP-lang') ?></span>
                </th>
                <?php } ?>  
                <?php if($feedPageAttributs['definition']==1){ ?>
                <th>
                    <span><?php _e('Definition', 'YVTWP-lang') ?></span>
                </th>
                <?php } ?>                   
                <?php if($feedPageAttributs['published_at']==1){ ?>
                <th>
                    <span><?php _e('Published At', 'YVTWP-lang') ?></span>
                </th> 
                <?php } ?>
                <?php if($feedPageAttributs['thumbnail']==1){ ?>
                <th>
                    <?php _e('Thumbnail', 'YVTWP-lang'); ?>
                </th>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($feedDatas as $key => $value) {
                $videoDatas=json_decode($value['video_datas'],TRUE);
            ?>
            <tr class="<?php echo 'row_'.$videoDatas['id'] ?>">
                <th>
                    <input class="checkbox_video" value="<?php echo $value['id'] ?>" type="checkbox">
                </th>
                <td class="">
                    <span>
                        <a href="https://www.youtube.com/watch?v=<?php echo $videoDatas['id'] ?>" target="_blank" title="<?php _e('View on Youtube', 'YVTWP-lang') ?>"><?php echo $videoDatas['snippet']['title']; ?></a>
                        <?php if(Post_YVTWP::existPostMeta('yvtwp_video_key',$videoDatas['id'])) { ?>
                        <span class="exist_video_index"> [Exist] </span>
                        <?php } ?>
                    </span>
                </td>
                <?php if($feedPageAttributs['description']==1){ ?>
                <td data-toggle="tooltip" data-placement="center" title="<?php echo $videoDatas['snippet']['description']; ?>">
                    <span><?php echo substr($videoDatas['snippet']['description'],0,30); ?></span>
                </td>        
                <?php } ?>                
                <?php if($feedPageAttributs['channel_title']==1){ ?>
                <td class="">
                    <span><?php echo $videoDatas['snippet']['channelTitle']; ?></span>
                </td>        
                <?php } ?>
                <?php if($feedPageAttributs['views']==1){ ?>
                <td>
                    <span><?php echo Utils_YVTWP::formatNumber($videoDatas['statistics']['viewCount']); ?></span>
                </td>
                <?php } ?>
                <?php if($feedPageAttributs['likes']==1){ ?>
                <td class="">
                    <span>
                        <?php 
                            if(isset($videoDatas['statistics']['likeCount']))
                                echo $videoDatas['statistics']['likeCount']; 
                        ?>
                    </span>
                </td>
                <?php } ?>  
                <?php if($feedPageAttributs['dislikes']==1){ ?>
                <td class="">
                    <span>
                        <?php 
                            if(isset($videoDatas['statistics']['dislikeCount']))
                                echo $videoDatas['statistics']['dislikeCount']; 
                            ?>
                    </span>
                </td>
                <?php } ?> 
                <?php if($feedPageAttributs['favorites']==1){ ?>
                <td class="">
                    <span>
                        <?php 
                            if(isset($videoDatas['statistics']['favoriteCount']))
                                echo $videoDatas['statistics']['favoriteCount']; 
                        ?>
                    </span>
                </td>
                <?php } ?> 
                <?php if($feedPageAttributs['comments']==1){ ?>
                <td class="">
                    <span>
                        <?php 
                            if(isset($videoDatas['statistics']['commentCount']))
                                echo $videoDatas['statistics']['commentCount']; 
                        ?>
                    </span>
                </td>
                <?php } ?> 
                <?php if($feedPageAttributs['duration']==1){ ?>
                <td class="">
                    <span>
                        <?php 
                            echo YoutubeDuration_YVTWP::getCleanedDuration($videoDatas['contentDetails']['duration']);
                        ?>
                    </span>
                </td>
                <?php } ?>   
                <?php if($feedPageAttributs['dimension']==1){ ?>
                <td class="">
                    <span><?php echo $videoDatas['contentDetails']['dimension']; ?></span>
                </td>
                <?php } ?> 
                <?php if($feedPageAttributs['definition']==1){ ?>
                <td class="">
                    <span><?php echo $videoDatas['contentDetails']['definition']; ?></span>
                </td>
                <?php } ?>                      
                <?php if($feedPageAttributs['published_at']==1){ ?>
                <td class="">
                    <!--<span><?php echo date('Y-m-d H:i:s',  strtotime($videoDatas['snippet']['publishedAt'])); ?></span> -->
                    <abbr class="timeago" title="<?php echo $videoDatas['snippet']['publishedAt'] ?>"></abbr>
                </td> 
                <?php } ?>
                <?php if($feedPageAttributs['thumbnail']==1){ ?>
                <td>
                    <img width="80px" src="<?php echo $videoDatas['snippet']['thumbnails']['default']['url'] ?>" />
                </td>
                <?php } ?>
            </tr>                  
             <?php } ?>
        </tbody>                     
      </table>
      <?php require Config_YVTWP::$views_dir.'youtube/partials/import_tabs/videos_list_head_and_footer.php'; ?>   
    </div>    
</div>
<?php } ?>
<!-- config table feed -->
<div id="dialog_attributs" title="<?php _e('Table attributes', 'YVTWP-lang') ?>">
    <form role="form" id="yvtwp_form_feed_page_attributs" style="display: none">
        <div class="content-form-feed-attributs form-group table-responsive">
            <table class="table table-hover table-bordered table-condensed" style="margin-bottom: 0px">
                <tr>
                    <td><input type="checkbox" name="description" value="<?php echo $feedPageAttributs["description"] ?>" ></td>
                    <td><?php _e("Description", 'YVTWP-lang') ?></td>
                </tr>                
                <tr>
                    <td><input type="checkbox" name="channel_title" value="<?php echo $feedPageAttributs["channel_title"] ?>" ></td>
                    <td><?php _e("Channel Title", 'YVTWP-lang') ?></td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="views" value="<?php echo $feedPageAttributs["views"] ?>" ></td>
                    <td><?php _e("Views", 'YVTWP-lang') ?></td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="likes" value="<?php echo $feedPageAttributs["likes"] ?>" ></td>
                    <td><?php _e("Likes", 'YVTWP-lang') ?></td>
                </tr> 
                <tr>
                    <td><input type="checkbox" name="dislikes" value="<?php echo $feedPageAttributs["dislikes"] ?>" ></td>
                    <td><?php _e("Dislikes", 'YVTWP-lang') ?></td>
                </tr>  
                <tr>
                    <td><input type="checkbox" name="favorites" value="<?php echo $feedPageAttributs["favorites"] ?>" ></td>
                    <td><?php _e("Favorites", 'YVTWP-lang') ?></td>
                </tr> 
                <tr>
                    <td><input type="checkbox" name="comments" value="<?php echo $feedPageAttributs["comments"] ?>" ></td>
                    <td><?php _e("Comments", 'YVTWP-lang') ?></td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="duration" value="<?php echo $feedPageAttributs["duration"] ?>" ></td>
                    <td><?php _e("Duration", 'YVTWP-lang') ?></td>
                </tr>   
                <tr>
                    <td><input type="checkbox" name="dimension" value="<?php echo $feedPageAttributs["dimension"] ?>" ></td>
                    <td><?php _e("Dimension", 'YVTWP-lang') ?></td>
                </tr> 
                <tr>
                    <td><input type="checkbox" name="definition" value="<?php echo $feedPageAttributs["definition"] ?>" ></td>
                    <td><?php _e("Definition", 'YVTWP-lang') ?></td>
                </tr>                  
                <tr>
                    <td><input type="checkbox" name="published_at" value="<?php echo $feedPageAttributs["published_at"] ?>" ></td>
                    <td><?php _e("Published At", 'YVTWP-lang') ?></td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="thumbnail" value="<?php echo $feedPageAttributs["thumbnail"] ?>" ></td>
                    <td><?php _e("Thumbnail", 'YVTWP-lang') ?></td>
                </tr>                
            </table>        
            <div>
                <input type="hidden" name="action" value="<?php echo Config_YVTWP::$wp_ajax_action_name ?>" >
                <input type="hidden" name="yvtwp_controller" value="settings" >
                <input type="hidden" name="yvtwp_action" value="setFeedPageAttributs" >
            </div>

            <div class="yvtwp_user_fedback"> </div>

            <div class="yvtwp_content_save_button" style="text-align: center">
                <a id="yvtwp_save_button" class="btn btn-primary btn-lg" role="button">
                    <?php _e("Save", 'YVTWP-lang') ?>
                </a>
            </div>                
        </div>
    </form>
</div>        
<script type="text/javascript">
    /*
     */
    function onSuccess(response)
    {
        var args={"form_id":'yvtwp_form_feed_page_attributs',"status":response.status,"message":response.messages,"show_popin_error":0,"show_popin_success":0};
        afterSendAjaxRequest(args);
        
        if(response.status=='1')
        {
            window.location="";
        }
    }
    /*------------------------------------*/
    jQuery(document).ready(function(){

        jQuery("#yvtwp_save_button").click(function(){
            var args={"form_id":'yvtwp_form_feed_page_attributs'};

            beforeSendAjaxRequest(args);
            sendAjaxRequest(onSuccess,'yvtwp_form_feed_page_attributs');
        }); 
        
        jQuery("#yvtwp_form_feed_page_attributs input[type=checkbox]").click(function(){
            if(jQuery(this).is(":checked"))
            {
                jQuery(this).val('1');
            }
            else
            {
                jQuery(this).val('0');
            }
        });
        
        jQuery("#yvtwp_form_feed_page_attributs input[type=checkbox]").each(function(i){
            var val=jQuery(this).val();
            if(val=='1')
            {
                jQuery(this).attr("checked","checked");
            }
        });
        
        jQuery(".config_table_feed").click(function(){
            jQuery("#yvtwp_form_feed_page_attributs").css({'display':'block'});
            jQuery( "#dialog_attributs" ).dialog();
            
        });
    });
</script>