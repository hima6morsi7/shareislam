<script type="text/javascript">
jQuery(function () 
{
    jQuery('#add_new_custom_field').click(function () {
        var num     = jQuery('.clonedInput').length, // Checks to see how many "duplicatable" input fields we currently have
            newNum  = new Number(num + 1),      // The numeric ID of the new input field being added, increasing by 1 each time
            newElem = jQuery('#clonedInput').clone(true,true).attr('id', 'clonedInput' + newNum).fadeIn('slow').removeClass("display_none"); // create the new element via clone(), and manipulate it's ID using newNum value
        // Insert the new element after the last "duplicatable" input field
        jQuery('.content_custom_fields').append(newElem);
    });

    jQuery('.delete_new_custom_field').click(function () {
        var current_element=jQuery(this);
        //console.log(current_element);
        var val=current_element.parent().parent().find(".custom_field").val();
        var val2=current_element.parent().parent().find(".template_field").val();

        if(val!='' || val2!='')
        {
            swal({
                title: "<?php _e("Alert", 'YVTWP-lang') ?>",
                text: "<?php _e("Delete Key?", 'YVTWP-lang') ?>",
                showCancelButton: true,type: "info",html: true,confirmButtonText: "Ok"
            },function(isConfirm)
            {   
                if (isConfirm) { current_element.parent().parent().remove(); }//End isConfirm
            });  
        }
        else
        {
            current_element.parent().parent().remove();
        }
    });     
    
    jQuery('.delete_base_custom_field').click(function () {
        var current_element=jQuery(this);
        //console.log(current_element);
        var val=current_element.parent().parent().find(".custom_field").val();
        var val2=current_element.parent().parent().find(".template_field").val();

        if(val!='' || val2!='')
        {
            swal({
                title: "<?php _e("Alert", 'YVTWP-lang') ?>",
                text: "<?php _e("Delete Key?", 'YVTWP-lang') ?>",
                showCancelButton: true,type: "info",html: true,confirmButtonText: "Ok"
            },function(isConfirm)
            {   
                if (isConfirm) { 
                    current_element.parent().parent().find(".custom_field").val(''); 
                    current_element.parent().parent().find(".template_field").val(''); 
                }//End isConfirm
            });  
        }
    });    
    
    
});

function addCustomFieldsToFormDatas()
{    
    var template_fields=[],custom_fields=[];
    jQuery(".content_custom_fields .clonedInput").each(function(){
        var id_parent=jQuery(this).attr("id");
        var template_field_value=jQuery("#"+id_parent+" .template_field").val();
        var custom_field_value=jQuery("#"+id_parent+" .custom_field").val();

        if(template_field_value && custom_field_value){
            template_fields.push(template_field_value);
            custom_fields.push(custom_field_value);
        }
    });
    
    jQuery("[name=template_fields]").val(template_fields.join('sep_yvtwp')); 
    jQuery("[name=custom_fields]").val(custom_fields.join());     
}

jQuery(document).ready(function(){
    //jQuery('#add_new_custom_field').click();
    jQuery(".select_template_field").click(function(){
        var current_element=jQuery(this);
        current_element.parent().parent().parent().parent().find(".template_field").val(current_element.attr('value'));
    });    
});    


jQuery(function() {

    jQuery(".add_template_field").click(function(){
        insertAtCaret('template_video',jQuery(this).attr('title'));
    });
    jQuery(".button_add_field").click(function(){
        insertAtCaret('template_video',jQuery('.template_fields_haut').val());
    });    

    function insertAtCaret(areaId,text) {
        var txtarea = document.getElementById(areaId);
        var scrollPos = txtarea.scrollTop;
        var strPos = 0;
        var br = ((txtarea.selectionStart || txtarea.selectionStart == '0') ? 
            "ff" : (document.selection ? "ie" : false ) );
        if (br == "ie") { 
            txtarea.focus();
            var range = document.selection.createRange();
            range.moveStart ('character', -txtarea.value.length);
            strPos = range.text.length;
        }
        else if (br == "ff") strPos = txtarea.selectionStart;

        var front = (txtarea.value).substring(0,strPos);  
        var back = (txtarea.value).substring(strPos,txtarea.value.length); 
        txtarea.value=front+text+back;
        strPos = strPos + text.length;
        if (br == "ie") { 
            txtarea.focus();
            var range = document.selection.createRange();
            range.moveStart ('character', -txtarea.value.length);
            range.moveStart ('character', strPos);
            range.moveEnd ('character', 0);
            range.select();
        }
        else if (br == "ff") {
            txtarea.selectionStart = strPos;
            txtarea.selectionEnd = strPos;
            txtarea.focus();
        }
        txtarea.scrollTop = scrollPos;
    }

});
</script>

<div class="tab-pane" id="tab_embed_options"> <!---Embed options -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Basic Form Elements
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-12 content_header_template">
                                        <div class="col-md-4" style="text-align: left;padding-left: 0px;">
                                            <label>
                                                <?php _e("Post Content", 'YVTWP-lang') ?>
                                            </label>
                                        </div>
                                        <?php if(isset($post_formats) && is_array($post_formats)){ ?>
                                        <div class="col-md-2">
                                            <div class="col-md-6">
                                                <?php _e("Format", 'YVTWP-lang') ?>
                                            </div> 
                                            <div class="col-md-6">
                                                <select name="post_format" style="min-width: 110px">
                                                    <?php foreach ($post_formats as $key=>$value) { ?>    
                                                    <option value="<?php echo $value ?>"><?php echo $value ?></option>
                                                    <?php  } ?>                                                        
                                                </select> 
                                            </div>
                                        </div>                                                
                                        <span class="template_field_sep template_field_sep_first">|</span>
                                        <?php } ?>
                                        <a class="add_template_field" title='[embed]{{video_url}}[/embed]'>
                                            Video shortcode <i class="dashicons dashicons-format-video"></i>
                                        </a>                    
                                        <span class="template_field_sep template_field_sep_first">|</span>
                                        <select class="template_fields_haut" >
                                            <?php foreach (Config_YVTWP::$templateFields as $key=>$value) { ?>    
                                            <option value="<?php echo '{{'.$key.'}}' ?>"><?php echo '{{'.$key.'}}' ?></option>
                                            <?php  } ?>                                                        
                                        </select>
                                        <a class="button_add_field dashicons dashicons-plus-alt" title="<?php _e("Add", 'YVTWP-lang') ?>"></a>                                                
                                    </div>
                                    <div class="col-md-12">                                         
                                        <textarea class="form-control" id="template_video" name="template_video" width="100%" rows="8"><?php $template_video=$default_settings['template_video'];while(strchr($template_video,'\\')) { $template_video =stripslashes($template_video); } ;echo stripslashes($template_video); ?></textarea>                                            
                                    </div>                                             
                                    <p class="help-block col-md-12"></p>
                                </div>   
                            </div>
                            <div class="row" style="margin-bottom:25px;">
                                <div class="col-md-12">
                                    <p class=""><label><?php _e("Post excerpt", 'YVTWP-lang') ?></label></p>
                                </div>
                                <div class="col-md-12">
                                   <div class="input-group">
                                       <textarea name="excerpt_content" width="100%" rows="1" class="form-control template_field" ></textarea>
                                      <div class="input-group-btn">
                                         <button type="button" class="btn btn-default 
                                            dropdown-toggle" data-toggle="dropdown">
                                            <?php _e("Video fields", 'YVTWP-lang') ?> 
                                            <span class="caret"></span>
                                         </button>
                                         <ul class="dropdown-menu pull-right content_templte_fields">
                                            <?php foreach (Config_YVTWP::$templateFields as $key=>$value) { ?>    
                                             <li><a value="<?php echo '{{'.$key.'}}' ?>" class="select_template_field"><?php echo '{{'.$key.'}}' ?></a></li>
                                            <?php  } ?>                                                             
                                         </ul>
                                      </div><!-- /btn-group -->
                                   </div><!-- /input-group -->
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="yvtwp_comment_filter_title"><?php _e("Custom Fields", 'YVTWP-lang') ?></p>
                                </div>
                            </div>
                            <div class="col-md-12"> 
                                <div class="content_custom_fields row">
                                <?php foreach ($embed_template_fields as $key0 => $value0) { ?>
                                    <div id="clonedInput<?php echo $key0+1 ?>" class="form-group clonedInput">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <?php if($key0==0){ ?>
                                                <span><?php _e("Custom field name", 'YVTWP-lang') ?></span>
                                                <?php } ?>
                                                <input class="form-control custom_field"  value="<?php if(isset($embed_custom_fields[$key0]))echo $embed_custom_fields[$key0] ?>" >
                                            </div>                                            
                                            <div class="col-md-1 yvtwp_center <?php if($key0==0){echo 'content_custom_fields_base';}?>">
                                                <span class="btn btn-primary">
                                                <?php _e('As', 'YVTWP-lang') ?>
                                                </span>
                                            </div>
                                            <div class="col-md-6">
                                                <?php if($key0==0){ ?>
                                                <span><?php _e("Custom field value", 'YVTWP-lang') ?></span>
                                                <?php } ?>
                                               <div class="input-group">
                                                   <?php 
                                                        while(strchr($value0,'\\')) { 
                                                            $value0 =stripslashes($value0); 
                                                        }
                                                        $value0=str_replace('"',"&quot;",$value0);
                                                        //$value0=str_replace("'","&#39;", $value0);
                                                   ?>
                                                   <input class="form-control template_field" value="<?php echo $value0 ?>" />
                                                  <div class="input-group-btn">
                                                     <button type="button" class="btn btn-default 
                                                        dropdown-toggle" data-toggle="dropdown">
                                                        <?php _e("Video fields", 'YVTWP-lang') ?> 
                                                        <span class="caret"></span>
                                                     </button>
                                                     <ul class="dropdown-menu pull-right content_templte_fields">
                                                        <?php foreach (Config_YVTWP::$templateFields as $key=>$value) { ?>    
                                                         <li><a value="<?php echo '{{'.$key.'}}' ?>" class="select_template_field"><?php echo '{{'.$key.'}}' ?></a></li>
                                                        <?php  } ?>                                                             
                                                     </ul>
                                                  </div><!-- /btn-group -->
                                               </div><!-- /input-group -->
                                            </div>
                                            <div class="col-md-1 <?php if($key0==0){echo 'content_custom_fields_base';}?>">
                                                <a class="<?php if($key0!=0){echo 'delete_new_custom_field';}else{echo 'delete_base_custom_field';} ?>" title="<?php _e('Remove', 'YVTWP-lang') ?>"><i class="dashicons dashicons-dismiss"></i></a>
                                            </div>
                                        </div>     
                                    </div>  
                                <?php } ?>
                            </div>
                            </div>                        
                            <div class="col-md-12">
                                <div class="row">
                                    <div>
                                        <a id="add_new_custom_field" title="<?php _e('Add New Custom Field', 'YVTWP-lang') ?>">
                                        <input  type="button" value="<?php _e('Add New Custom Field', 'YVTWP-lang') ?>" >
                                        <i class="dashicons dashicons-plus-alt"> </i>
                                        </a>
                                    </div>
                                    <div class="form-group" style="margin-top: 15px">
                                        <div class="yvtwp-infos-block">
                                            <p class="help-block"><?php _e('If your theme is based on custom fields to manage videos, this section lets you easily add a custom value or a video field to your theme custom fields. You\'ll need to know what custom fields your theme requires.', 'YVTWP-lang') ?></p>
                                        </div>
                                    </div>  
                                </div>
                            </div>           
                        </div>
                        <!-- col-lg-10-->
                    </div>
                    <input type="hidden" name="template_fields" >
                    <input type="hidden" name="custom_fields" >
                    <!--row -->
                </div>
                <!-- /panel-body -->
            </div>
            <!-- /panel -->
        </div>
        <!--col-lg-12 -->
    </div>            
</div>

<div id="clonedInput" class="form-group clonedInput display_none">
    <div class="row">
        <div class="col-md-4">
            <input class="form-control custom_field">
        </div>                                            
        <div class="col-md-1 yvtwp_center">
            <span class="btn btn-primary">
            <?php _e('As', 'YVTWP-lang') ?>
            </span>
        </div>
        <div class="col-md-6">
           <div class="input-group">
              <input class="form-control template_field" />
              <div class="input-group-btn">
                 <button type="button" class="btn btn-default 
                    dropdown-toggle" data-toggle="dropdown">
                    <?php _e("Video fields", 'YVTWP-lang') ?> 
                    <span class="caret"></span>
                 </button>
                 <ul class="dropdown-menu pull-right content_templte_fields">
                    <?php foreach (Config_YVTWP::$templateFields as $key=>$value) { ?>    
                     <li><a value="<?php echo '{{'.$key.'}}' ?>" class="select_template_field"><?php echo '{{'.$key.'}}' ?></a></li>
                    <?php  } ?>                                                             
                 </ul>
              </div><!-- /btn-group -->
           </div><!-- /input-group -->
        </div>
        <div class="col-md-1">
            <a style="cursor: pointer" class="delete_new_custom_field" title="<?php _e('Remove', 'YVTWP-lang') ?>"><i class="dashicons dashicons-dismiss"></i></a>
        </div>
    </div>      
</div>  