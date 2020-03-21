<script type="text/javascript">
    /*
     */
    function onSuccessImportSettings(response)
    {
        var args={"form_id":'yvtwp_form_import_settings',"status":response.status,"message":response.messages,"show_popin_error":0,"show_popin_success":0};
        afterSendAjaxRequest(args);
    }
    /*
     */
    function onSuccessExportSettings(response)
    {
        var args={"form_id":'yvtwp_form_export_settings',"status":response.status,"message":response.messages,"show_popin_error":0,"show_popin_success":0};
        afterSendAjaxRequest(args);
    }    
    /*------------------------------------*/
    jQuery(document).ready(function(){
        
        jQuery('#yvtwp_form_import_settings').on('submit', function(ev){
            ev.preventDefault();
            var args={"form_id":'yvtwp_form_import_settings'};

            beforeSendAjaxRequest(args);
            //sendAjaxRequest(onSuccessImportSettings,'yvtwp_form_import_settings');
            var file_data = jQuery('#button_choice_file').prop('files')[0];   
            var form_data = new FormData();                  
            form_data.append('file', file_data);
            form_data.append('action', "<?php echo Config_YVTWP::$wp_ajax_action_name ?>");
            form_data.append('yvtwp_controller',"settings");
            form_data.append('yvtwp_action',"importSetting");
                          
            jQuery.ajax({
                url: "<?php echo Config_YVTWP::$ajax_url ?>", // point to server-side PHP script 
                dataType: 'text',  // what to expect back from the PHP script, if anything
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,                         
                type: 'post',
                success: function(response){
                    var extract_data = response.match(/{"status"(.*)}/).pop();    
                    extract_data='{"status"'+extract_data+'}';
                    var response=jQuery.parseJSON(extract_data);                        

                    var args={"form_id":'yvtwp_form_import_settings',"status":response.status,"message":response.messages,"show_popin_error":0,"show_popin_success":0};
                    afterSendAjaxRequest(args);

                    if(response.status=='1')
                    {
                        var url_to="<?php echo $_SERVER['REQUEST_URI'] ?>"
                        window.location=url_to.replace('&init','');
                    }
                }
            });           
        });
        /*---------------------------------------------------*/
        jQuery('#yvtwp_form_export_settings').on('submit', function(ev){
            ev.preventDefault();
            var args={"form_id":'yvtwp_form_export_settings'};

            addCustomFieldsToFormDatas();
            beforeSendAjaxRequest(args);
            sendAjaxRequest(onSuccessExportSettings,'yvtwp_form_export_settings');
        });        
        
        jQuery("#button_import_export_settings").click(function(){
            //jQuery('#yvtwp_form_export_settings').submit();
            
            jQuery("#tab_import_export_settings").css({'display':'block'});
            jQuery( "#tab_import_export_settings" ).dialog({
                width: 700,
                modal: true
            });
            
        });
        
        jQuery("#button_export_settings_as_text").click(function(){
            jQuery(".content_settings_text").css({'display':'block'});
        });        
               
        
    });
</script>
<div class="col-md-12">
    <div class="tab-pane" id="tab_import_export_settings" style="display: none;" title="<?php _e('Import/Export Settings', 'YVTWP-lang') ?>">
        <form role="form" id="yvtwp_form_import_settings" enctype="multipart/form-data">
            
            <div class="form-group" style="margin-top: 10px">
                <div class="yvtwp-infos-block">
                    <p class="help-block"><?php _e('You can transfer the import settings between different installs by generating your import settings and uploading them to a new installation, then click "Import Settings" to apply changes.', 'YVTWP-lang') ?></p>
                </div>
            </div>

            <div class="col-md-12">
                
                <div class="form-group col-md-6">
                    <label><?php _e('Select File .txt or .json', 'YVTWP-lang') ?></label>
                    <input id="button_choice_file" type="file" name="file_setting">
                </div>           
                
                <div class="form-group col-md-6" style="padding-top: 16px">
                    <div class="yvtwp_content_save_button"> 
                        <input type="submit" class="yvtwp_save_button btn btn-primary btn-lg" value="<?php _e('Import Settings', 'YVTWP-lang') ?>" >
                    </div>
                </div>

                <div class="yvtwp_user_fedback"> </div>
            </div> 
        </form>   
           
        <div class="yvtwp_divider_grise"></div>
        
        <form role="form" id="yvtwp_form_export_settings" >                                    
            <div class="yvtwp_user_fedback"> </div>    
            <div class="form-group col-md-12" style="margin-left: 10px">
                <span class="dashicons dashicons-migrate"></span>
                <a target="_blank" href="?page=yvtwp&yvtwp_controller=settings&yvtwp_action=exportSettings"> 
                    <?php _e('Click here to download import settings', 'YVTWP-lang') ?> 
                </a>
            </div>
        </form>  

    </div>
</div>    