<?php require_once Config_YVTWP::$views_dir.'header.php'; ?>

<script type="text/javascript">
function onSuccess(response)
{
    var args={"form_id":'yvtwp_form_general_settings',"status":response.status,"message":response.messages,"show_popin_error":0,"show_popin_success":0};
    afterSendAjaxRequest(args);
    jQuery("input[name=onChangeClearAllCache]").val('0');    
}

function serialiseMicrodata()
{ 
    var microdata_fields= {};
    jQuery(".microdata_inputs .microdata_elements").each(function(){
        var id_parent=jQuery(this).attr("id");
        var property_key=jQuery("#"+id_parent+" .property_key").val();
        var property_value=jQuery("#"+id_parent+" .property_value").val();

        if(property_key && property_value){
            microdata_fields[property_key]=property_value;
        }
    });
    
    jQuery("[name=videos_microdata]").val(JSON.stringify(microdata_fields));    
}

jQuery(document).ready(function(){
    
    <?php if(isset($_REQUEST['tab'])){ ?>
            jQuery(".tab-pane").removeClass("active");
            jQuery(".yvtwp-nav-tabs li").removeClass("active");
            
            jQuery(".link_<?php echo $_REQUEST['tab']  ?>").addClass("active");
            jQuery("#tab_<?php echo $_REQUEST['tab']  ?>").addClass("active");
    <?php } ?>

    jQuery('#yvtwp_form_general_settings').on('submit', function(ev){
        ev.preventDefault();

        var args={"form_id":'yvtwp_form_general_settings'};
        
        
        serialiseMicrodata();

        beforeSendAjaxRequest(args);
        sendAjaxRequest(onSuccess,'yvtwp_form_general_settings');
    }); 
        
    <?php 
    if(!empty($generalSettings))
    {
        foreach ($generalSettings as $key => $value) 
        {
            $unset_keys=array('videos_microdata');
            ?>
            <?php if(!in_array($key, $unset_keys)){ ?>
            if(jQuery("input[name=<?php echo $key ?>]").length ){
                jQuery("input[name=<?php echo $key ?>]").val('<?php echo $value ?>');
            }
            if(jQuery("select[name=<?php echo $key ?>]").length ){
                jQuery("select[name=<?php echo $key ?>]").val('<?php echo $value ?>');
            }
            <?php } ?>

        <?php     
        }    
    }
    ?>  
            
    //scheduling settings
    jQuery("select[name=cron_job_type]").change(function()
    {
        if(jQuery(this).val()=='virtual_cron_job')
        {
            jQuery(".virtual_cron_job").css({'display':'block'});
            jQuery(".real_cron_job").css({'display':'none'});
        }
        else
        {
            jQuery(".real_cron_job").css({'display':'block'});
            jQuery(".virtual_cron_job").css({'display':'none'});
        }    

    });
    jQuery("select[name=cron_job_type]").change();    
    
    //recurrence change
    jQuery("select[name=scheduling_recurrance]").change(function()
    {
        var recurrance=jQuery(this).val();
        
        switch(recurrance)
        {
            case 'daily':
                jQuery(".dynamique_recurrance").text("0 0 * * *");
                break;
            case 'twicedaily':
                jQuery(".dynamique_recurrance").text("0 0,12 * * *");
                break;
            case 'hourly':
                jQuery(".dynamique_recurrance").text("0 * * * *");
                break;
            case 'yvtwpevery30minute':
                jQuery(".dynamique_recurrance").text("0,30 * * * *");
                break;
            case 'yvtwpevery15minute':
                jQuery(".dynamique_recurrance").text("*/15 * * * *");
                break;  
            case 'yvtwpevery5minute':
                jQuery(".dynamique_recurrance").text("*/5 * * * *");
                break;                 
        }
    });    
    jQuery("select[name=scheduling_recurrance]").change(); 
 

});
/*--------------------------------*/
jQuery(document).ready(function(){

    jQuery(".onChangeClearAllCache input").bind("input", function() {
        jQuery("input[name=onChangeClearAllCache]").val('1');
    });

    jQuery(".onChangeClearAllCache select").change(function(){
        jQuery("input[name=onChangeClearAllCache]").val('1');
    });

    //init indicateur for clear cache
    jQuery("input[name=onChangeClearAllCache]").val('0');    
    
    jQuery(".show_other_settings").click(function(){
        jQuery(".other_settings").css({'display':'block'});
    });
});  

</script>
<script type="text/javascript">
    jQuery(document).ready(function(){

        //init default config
        jQuery("#init_config").click(function(){

                swal({
                    title: "<?php _e('Alert', 'YVTWP-lang') ?>",
                    text: "<?php _e("Do you really want to reset to default settings?", 'YVTWP-lang') ?>",
                    showCancelButton: true,type: "info",html: true,confirmButtonText: "<?php _e("Ok", 'YVTWP-lang') ?>"
                },function(isConfirm)
                {   
                    if (isConfirm) {
                        window.location="<?php echo $_SERVER['REQUEST_URI'].'&init' ?>";
                    }//End isConfirm
                }); 
            
        });        
        
    });
</script>

<div class="container yvtwp_container">
    <h1></h1>
    <div class="col-md-8" style="padding: 0px">
        <ul class="nav nav-tabs yvtwp-nav-tabs">
            <li class="active"><a href="#tab_general_settings" data-toggle="tab"><?php _e('General Settings', 'YVTWP-lang') ?></a></li>
            <li class="link_scheduling_settings"><a href="#tab_scheduling_settings" data-toggle="tab"><?php _e('Scheduling Settings', 'YVTWP-lang') ?></a></li>
            <li class="link_videos_microdata_settings"><a href="#tab_videos_microdata_settings" data-toggle="tab"><?php _e('Videos microdata Settings', 'YVTWP-lang') ?></a></li>       
            <li class=""><a href="?page=yvtwp&yvtwp_controller=settings&yvtwp_action=youtubeAPISettings"><?php _e('Youtube API settings', 'YVTWP-lang') ?></a></li>
        </ul>  
    </div>
    <div class="col-md-4" style="text-align: right;">
        <a id="init_config"><?php _e('Reset Settings - w-p-l-o-c-k-e-r-.-c-o-m', 'YVTWP-lang') ?></a> 
    </div>    
    <form action="" method="POST" role="form" id="yvtwp_form_general_settings">
        <div class="tab-content">

            <?php require_once Config_YVTWP::$views_dir.'youtube/partials/setting_tabs/general_settings.php'; ?>
            <?php require_once Config_YVTWP::$views_dir.'youtube/partials/setting_tabs/scheduling_settings.php'; ?>
            <?php require_once Config_YVTWP::$views_dir.'youtube/partials/setting_tabs/videos_microdata_settings.php'; ?>
                
            
            <input type="hidden" name="action" value="<?php echo Config_YVTWP::$wp_ajax_action_name ?>" >
            <input type="hidden" name="yvtwp_controller" value="settings" >
            <input type="hidden" name="yvtwp_action" value="setGeneralSettings" >
            
            <input type="hidden" name="onChangeClearAllCache" value="0" />

            <div class="yvtwp_user_fedback"> </div>

            <div class="yvtwp_content_save_button">
                <input type="submit" class="yvtwp_save_button btn btn-primary btn-lg" value="<?php _e('Submit changes', 'YVTWP-lang') ?>" >
            </div>                                        

                  
    </div><!-- tab content -->
    </form>  
</div><!-- end of container -->