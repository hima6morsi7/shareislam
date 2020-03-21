<!-----------form for change role-------------->
<form role="form" id="yvtwp_form_change_role">
    <input type="hidden" name="action" value="<?php echo Config_YVTWP::$wp_ajax_action_name ?>" >
    <input type="hidden" name="yvtwp_controller" value="utils" >
    <input type="hidden" name="yvtwp_action" value="getUsersByRole" >
    <input type="hidden" name="author_role" />
</form>
<!-----------form for change post type-------------->
<form role="form" id="yvtwp_form_change_post_type">
    <input type="hidden" name="action" value="<?php echo Config_YVTWP::$wp_ajax_action_name ?>" >
    <input type="hidden" name="yvtwp_controller" value="utils" >
    <input type="hidden" name="yvtwp_action" value="getTaxonomyByPostType" >
    <input type="hidden" name="taxonomies_post_type" />
</form>   
<!-----------form for change taxonomy-------------->
<form role="form" id="yvtwp_form_change_taxonomy">
    <input type="hidden" name="action" value="<?php echo Config_YVTWP::$wp_ajax_action_name ?>" >
    <input type="hidden" name="yvtwp_controller" value="utils" >
    <input type="hidden" name="yvtwp_action" value="getCategoriesByTaxonomy" >
    <input type="hidden" name="taxonomy" />
</form> 
<!-----------form check user login-------------->
<form role="form" id="yvtwp_form_check_author_login">
    <input type="hidden" name="action" value="<?php echo Config_YVTWP::$wp_ajax_action_name ?>" >
    <input type="hidden" name="yvtwp_controller" value="utils" >
    <input type="hidden" name="yvtwp_action" value="existAuthorLogin" >
    <input type="hidden" name="login" />
</form> 
<!---------for init default settings ---------->        
<form role="form" id="yvtwp_form_init_defaultSettings">
    <input type="hidden" name="action" value="<?php echo Config_YVTWP::$wp_ajax_action_name ?>" >
    <input type="hidden" name="yvtwp_controller" value="settings" >
    <input type="hidden" name="yvtwp_action" value="initDefaultSettings" >            
</form>