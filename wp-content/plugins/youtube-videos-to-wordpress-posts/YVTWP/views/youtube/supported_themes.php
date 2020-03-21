<?php require_once Config_YVTWP::$views_dir.'header.php'; ?>
<script type="text/javascript">
    function onSuccessLoadTheme(response)
    {
        var args={"form_id":'yvtwp_form_load_theme',"status":response.status,"message":response.messages,"show_popin_error":0,"show_popin_success":1};
        afterSendAjaxRequest(args);
    }    
    jQuery(document).ready(function(){
        jQuery("#tab_general_options").addClass('active');
        //init default config
        jQuery(".link_load").click(function(){
                jQuery("input[name=theme_slug]").val(jQuery(this).attr("theme_slug"));
                swal({
                    title: "<?php _e('Alert', 'YVTWP-lang') ?>",
                    text: "<?php _e("Loading this theme settings will override your default settings. Continue!", 'YVTWP-lang') ?>",
                    showCancelButton: true,type: "info",html: true,confirmButtonText: "<?php _e("Ok", 'YVTWP-lang') ?>"
                },function(isConfirm)
                {   
                    if (isConfirm) {
                        sendAjaxRequest(onSuccessLoadTheme,'yvtwp_form_load_theme');
                    }//End isConfirm
                }); 
            
        }); 
        
        jQuery(".link_details").click(function(){
                var theme_slug=jQuery(this).attr("theme_slug");
                
                swal({
                    title:"",
                    text: jQuery(".doc_"+theme_slug).html(),
                    showCancelButton: false,
                    html: true,
                    confirmButtonText: "<?php _e("Close", 'YVTWP-lang') ?>",
                    customClass: 'doc_pop_up'
                },function(isConfirm)
                {   
                }); 
            
        });           
        
        

        jQuery(".<?php echo $theme_name?>").addClass('yvtwp_current_theme');
        
        jQuery(".theme_container").mouseover(function(){
            jQuery(".theme_container").removeClass('yvtwp_current_theme');
            jQuery(this).addClass('yvtwp_current_theme');
        });
        
    });
</script>
<div class="container yvtwp_container">
    <h3 style="margin-top: 5px"><?php _e('Premium themes Supported', 'YVTWP-lang') ?></h3>
    <div class="col-lg-12" style="padding: 0px;max-width: 1030px">
        <ul class="list-group yvtwp_notices" style="max-width: 1005px;margin-bottom: 0px">
            <li class="list-group-item">
                <?php _e("search for your theme, and click in the Load Settings button. That’s it!! All settings are now automatically set for you.", 'YVTWP-lang') ?>
            </li>
            <li class="list-group-item">
              <?php _e('If you’re using a premium theme that uses WordPress custom fields to integrate videos, and it’s not listed in this page. You can integrated easily using the', 'YVTWP-lang') ?>
                
                    <a href="?page=yvtwp&yvtwp_controller=settings&yvtwp_action=defaultImportSettings">
                        <strong><?php _e('Embed options', 'YVTWP-lang') ?></strong>
                    </a> 
                    <?php _e('Tab', 'YVTWP-lang') ?>, 
                    <?php _e("If you have any difficulties integrating your theme, you can contact us and we’ll help you with it.",'YVTWP-lang'); ?> 
            </li>  
            <li class="list-group-item">
                <?php _e("If you’re using a simple theme, Keep the default plugin settings, and let the WordPress shortcode integrate the videos for you.", 'YVTWP-lang') ?>
            </li>            
        </ul>  
        
        <form role="form" id="yvtwp_form_load_theme">
            <input type="hidden" name="action" value="<?php echo Config_YVTWP::$wp_ajax_action_name ?>" />
            <input type="hidden" name="yvtwp_controller" value="themeLoader" />
            <input type="hidden" name="yvtwp_action" value="loadNewTheme" /> 
            <input type="hidden" name="theme_slug" value="<?php echo $theme_name ?>" />
        </form>  
        
        <?php foreach ($supported_themes as $key => $theme) { ?>
        <div class="theme_container <?php echo $key ?>">
            <div class="container_img">
                <a href="<?php echo $theme['link_view'] ?>" target="_black">
                    <img class="img_theme" src="<?php echo Config_YVTWP::$supported_themes_url.'themes_img/'.$key.'.png' ?>" />
                </a>
            </div>
            <div>
                <h2><?php echo $theme['name'] ?></h2>
            </div>
            <div class="yvtwp_actions">
                <a class="link_load btn btn-primary" theme_slug="<?php echo $key ?>"><?php _e('Load Settings', 'YVTWP-lang') ?></a>
                <span> | </span>
                <a class="link_details" theme_slug="<?php echo $key ?>" theme_name="<?php echo $theme['name'] ?>">
                    <?php _e('Details', 'YVTWP-lang') ?>
                </a>
            </div>
        </div>
        <div class="<?php echo 'doc_'.$key ?>" style="display: none">
            <?php echo do_shortcode("[yvtwp_theme_doc theme_slug='{$key}']"); ?>
        </div>        
        <?php } ?>
        
    </div>
</div><!-- end of container -->

<?php $generate=FALSE;
if($generate){
        ?>
<!-- generator -->
<div class="my_content_generator">
    <p>
        YouTube videos to WordPress posts provide a clean way to integrate with any WordPress theme, no coding skills needed. The settings are available in a visual mode, you just need to know your theme custom fields to integrate videos.
    </p>
    <p>Premium video themes are automatically supported</p>
    <table cellpadding="20">
    <?php 
    $counter=0;
    $counter_tr=0;
    foreach ($supported_themes as $key => $theme) 
    { 
        if($counter%4==0){echo '<tr>';$counter_tr=0;}
    ?>
        <td align="center">
            <a href="<?php echo 'http://yvtwp.if36.com/'.$theme['doc_page'] ?>" target="blank">
                <img width="190" src="<?php echo $theme['envato_img_link'] ?>" alt="<?php echo $theme['name'] ?>" title="<?php echo $theme['name'] ?>">
                <br/>
                <strong><?php echo $theme['name'] ?></strong>
            </a>
        </td>
    <?php 
        if($counter_tr==4||$counter==  count($supported_themes)){echo '</tr>';}
        $counter_tr++;
        $counter++;
    } 
    ?>
    </table>
</div>
<?php } ?>