<script type="text/javascript">
    jQuery(function() {
        var availableUsers = [<?php foreach ($users as $key => $user) {echo '"'.$user->user_login.'"'.",";}?>];
        jQuery("input[name=author_login]" ).autocomplete({
          source: availableUsers
        });
    });    
    /*
     */
    function afterLoadCategories()
    {
        jQuery('#post_categories').multiselect('selectAll',true);
        jQuery('#post_categories').multiselect('deselectAll',false);

        var categories='<?php echo $default_settings['categories'] ?>';
        categories=categories.split(',');

        if(categories!='')
        {
            for (var i = 0; i < categories.length; i++) {                
              var index = jQuery("#post_categories option[value="+categories[i]+"]").index();
              if(index!=-1)
              {
                jQuery('#post_categories').multiselect('select',categories[i]);
              }
            }     
        }
    }   
    //for hide or shwo import options     
    jQuery(document).ready(function(){
    
        jQuery('[data-toggle="tooltip"]').tooltip();   

        <?php if(isset($_REQUEST['paged'])){ ?>
        jQuery(".nav-tabs .active").removeClass('active');
        jQuery("#a_feed_options").click();
        jQuery("#tab_feed_options .disabled_part input").attr("disabled","disabled");
        jQuery("#tab_feed_options .disabled_part select").attr("disabled","disabled");
        <?php } ?>  
            
        <?php if(isset($_REQUEST['paged'])){ ?>

            jQuery("#yvtwp-tab-content").on("hide.bs.collapse", function(){
                jQuery(".btn_hide_how").html('<span class="button_open glyphicon glyphicon-collapse-down"></span> <?php //_e('Open', 'YVTWP-lang') ?>');
            });
            jQuery("#yvtwp-tab-content").on("show.bs.collapse", function(){
                jQuery(".btn_hide_how").html('<span class="glyphicon glyphicon-collapse-up"></span> <?php //_e('Close', 'YVTWP-lang') ?>');
            });      

              jQuery(".li_link_tabs").click(function(){
                  if(jQuery( ".btn_hide_how" ).hasClass( "collapsed" ))
                  {
                      jQuery(".btn_hide_how").click();
                  }      
              });    
        <?php } ?>

        jQuery(document).ready(function(){
            jQuery(".btn_hide_how").addClass('collapsed');
        });
            
      
        jQuery('#post_categories').multiselect({
            enableFiltering: true,
            filterPlaceholder: 'Search for something...',
            includeSelectAllOption: true,
            buttonWidth: '100%'
        });
        
        jQuery("#post_categories").change(function(){
            jQuery("input[name=categories]").val(jQuery("#post_categories").val());
        });
        
        jQuery(document).ready(function(){            
            afterLoadCategories(); 
        });               
        <?php if($_REQUEST['yvtwp_action']=='newImport'){ ?>    
        /*--------datetimepicker------------*/
        jQuery("input[name=published_after]").datetimepicker({
            formatTime:'H:i',
            formatDate:'d.m.Y',
            //defaultDate:'8.12.1986', // it's my birthday
            defaultDate:'+03.01.1970', // it's my birthday
            defaultTime:'10:00',
            timepickerScrollbar:false
        });
        jQuery("input[name=published_before]").datetimepicker({
            formatTime:'H:i',
            formatDate:'d.m.Y',
            //defaultDate:'8.12.1986', // it's my birthday
            defaultDate:'+03.01.1970', // it's my birthday
            defaultTime:'10:00',
            timepickerScrollbar:false
        });        
        jQuery("input[name=schedule_start_date]").datetimepicker({
            formatTime:'H:i',
            formatDate:'d.m.Y',
            //defaultDate:'8.12.1986', // it's my birthday
            defaultDate:'+03.01.1970', // it's my birthday
            defaultTime:'10:00',
            timepickerScrollbar:false
        });     
        
        /*-------comments----------*/
        jQuery("input[name=comment_published_after]").datetimepicker({
            formatTime:'H:i',
            formatDate:'d.m.Y',
            //defaultDate:'8.12.1986', // it's my birthday
            defaultDate:'+03.01.1970', // it's my birthday
            defaultTime:'10:00',
            timepickerScrollbar:false
        });    
        /*-------videos----------*/
        jQuery("input[name=video_published_after]").datetimepicker({
            formatTime:'H:i',
            formatDate:'d.m.Y',
            //defaultDate:'8.12.1986', // it's my birthday
            defaultDate:'+03.01.1970', // it's my birthday
            defaultTime:'10:00',
            timepickerScrollbar:false
        });          
        /*--------datetiepicker------------*/
        <?php } ?>         
    });
</script>
<script type="text/javascript">
    function onSuccessDefaultSetting(response){
        var args={"form_id":'yvtwp_form_default_setting',"status":response.status,"message":response.messages,"show_popin_error":0,"show_popin_success":1};
        afterSendAjaxRequest(args);    
    }
    /*-------------------------------*/
    function onSuccessChangePostType(response){
        if(response.status=='1')
        {
            var result=response.result;
            if(result.length===0)
            {
                jQuery(".content-taxonomy-and-category").css({'display':'none'});
                jQuery(".content-taxonomy-not-exist").css({'display':'block'});
            }
            else
            {            
                jQuery(".content-taxonomy-and-category").css({'display':'block'});
                jQuery(".content-taxonomy-not-exist").css({'display':'none'});            
                //init 
                jQuery("#select_taxonomy_categories").empty();
                jQuery("#select_taxonomy_tags").empty();
                var option_select='<option value="0"><?php _e("Select a taxonomy", 'YVTWP-lang') ?></option>';
                jQuery("#select_taxonomy_categories").append(option_select); 
                jQuery("#select_taxonomy_tags").append(option_select);             

                console.log(result);
                for (var key in result)
                {
                    var option_select="<option value='"+key+"'>"+key+" </option>";
                    jQuery("#select_taxonomy_categories").append(option_select);
                    jQuery("#select_taxonomy_tags").append(option_select);
                }   

                jQuery(".taxonomies_categories_waiting").css({'display':'none'});
                jQuery(".taxonomies_tags_waiting").css({'display':'none'});

                var taxonomy_categories = "<?php if(isset($default_settings['taxonomy_categories'])) {echo $default_settings['taxonomy_categories'];}else {echo 'jQuery("#select_taxonomy_categories option").eq(1).val()';} ?>";
                //get categories for first taxonomy
                jQuery(".categories_waiting").css({'display':'block'});
                jQuery("input[name=taxonomy]").val(taxonomy_categories);
                jQuery("input[name=taxonomy_categories]").val(taxonomy_categories);
                jQuery('#select_taxonomy_categories').val(taxonomy_categories);
                
                sendAjaxRequest(onSuccessChangeTaxonomy,'yvtwp_form_change_taxonomy');

                var taxonomy_tags = "<?php if(isset($default_settings['taxonomy_tags'])) {echo $default_settings['taxonomy_tags'];}else {echo 'jQuery("#select_taxonomy_tags option").eq(1).val()';} ?>";
                //get tags for second taxonomy
                jQuery(".tags_waiting").css({'display':'block'});
                jQuery("input[name=taxonomy]").val(taxonomy_tags);
                jQuery("input[name=taxonomy_tags]").val(taxonomy_tags);
                jQuery('#select_taxonomy_tags').val(taxonomy_tags);
                
                sendAjaxRequest(onSuccessChangeTaxonomyTags,'yvtwp_form_change_taxonomy');                
            }
        }
    }

    function onSuccessChangeTaxonomy(response)
    {
        if(response.status=='1')
        {
            jQuery("#post_categories").empty();
            jQuery("#post_categories").multiselect('destroy');

            jQuery('#post_categories').multiselect({
                enableFiltering: true,
                filterPlaceholder: 'Search for something...',
                includeSelectAllOption: true,
                buttonWidth: '100%'
            });

            var existCategory=false;
            var result=response.result;

            if(result.length>0)
            {
                for (i=0;i<result.length;i++)
                {
                    existCategory=true;
                    var category=result[i];
                    var option_select="<option value='"+category['term_id']+"' selected>"+category['name']+" </option>";
                    jQuery("#post_categories").append(option_select);
                }
                    jQuery('#post_categories').multiselect('selectAll',true);
                    jQuery('#post_categories').multiselect('deselectAll',false);
            }
            jQuery("#post_categories").multiselect('rebuild');

            if(!existCategory){}
            afterLoadCategories();        
        }
        jQuery(".categories_waiting").css({'display':'none'});    
    }//End function
    /*-------------------------------*/
    function onSuccessChangeTaxonomyTags(response){}
    jQuery(document).ready(function(){
        /*-----------for taxonomy options when post type changed------------------*/
        jQuery("#select_post_type").change(function(){
            jQuery(".taxonomies_categories_waiting").css({'display':'block'});
            jQuery("input[name=taxonomies_post_type]").val(jQuery(this).val());
            sendAjaxRequest(onSuccessChangePostType,'yvtwp_form_change_post_type');     
        });
        jQuery(document).ready(function(){
            jQuery("#select_post_type").change();
        });
        /*-----------for categories options when taxonomy changed------------------*/
        jQuery("#select_taxonomy_categories").change(function(){
            jQuery(".categories_waiting").css({'display':'block'});
            jQuery("input[name=taxonomy]").val(jQuery(this).val());
            jQuery("input[name=taxonomy_categories]").val(jQuery(this).val());
            sendAjaxRequest(onSuccessChangeTaxonomy,'yvtwp_form_change_taxonomy');
        });   
        /*-----------for tags options when taxonomy changed------------------*/
        jQuery("#select_taxonomy_tags").change(function(){
          //  jQuery(".tags_waiting").css({'display':'block'});
            jQuery("input[name=taxonomy]").val(jQuery(this).val());
            jQuery("input[name=taxonomy_tags]").val(jQuery(this).val());
          //  sendAjaxRequest(onSuccessChangeTaxonomyTags,'yvtwp_form_change_taxonomy');
        });     
        //---------------import default setting-----------------------
        jQuery('#yvtwp_form_default_setting').on('submit', function(ev){
            ev.preventDefault();
            var args={"form_id":'yvtwp_form_default_setting'};

            addCustomFieldsToFormDatas();
            beforeSendAjaxRequest(args);
            sendAjaxRequest(onSuccessDefaultSetting,'yvtwp_form_default_setting');
        });    
        /*-------------------------*/
        function beforeNewImport(form_id){}
        function onSuccessNewImport(response)
        {   
            var args={"form_id":'yvtwp_form_new_import',"status":response.status,"message":response.messages,"show_popin_error":0,"show_popin_success":0};
            afterSendAjaxRequest(args);

            if(response.status=='1')
            {
                if(response.result)
                {
                    if(response.result['import_id'])
                    {
                        jQuery('input[name=import_id]').val(response.result['import_id']);
                    }
                    if(response.result['redirect'])
                    {
                        window.location=response.result['redirect'];
                    }   
                }
            }    
        } 
        /*-----------------*/
        jQuery('#yvtwp_form_new_import').on('submit', function(ev){
            ev.preventDefault();       
            var args={"form_id":'yvtwp_form_new_import'};

            addCustomFieldsToFormDatas();        
            beforeSendAjaxRequest(args);
            sendAjaxRequest(onSuccessNewImport,'yvtwp_form_new_import');      
        });         

        jQuery(".feed_key").bind("change paste keyup", function() {
        jQuery('input[name=feed_key]').val(jQuery(this).val()); 
        });

        function onSuccessCheckAuhorLogin(response)
        {        
            if(response.status=='0')
            {
                jQuery(".author_login_msg").css({'display':'block'});
                jQuery("input[name=author_login]").css({'border-color':'red'});
            }       
        }
        /*------------------------------------------------------------*/
        jQuery('#yvtwp_form_check_author_login').on('submit', function(ev){
            ev.preventDefault();       
            var args={"form_id":'yvtwp_form_check_author_login'};

            addCustomFieldsToFormDatas();        
            beforeSendAjaxRequest(args);
            sendAjaxRequest(onSuccessCheckAuhorLogin,'yvtwp_form_check_author_login');
        });    
        jQuery("input[name=author_login]").focusout(function(){
            jQuery(".author_login_msg").css({'display':'none'});
            jQuery("input[name=author_login]").css({'border-color':'#ccc'});

            jQuery('#yvtwp_form_check_author_login input[name=login]').val(jQuery(this).val());
            jQuery('#yvtwp_form_check_author_login').submit();    
        });

        jQuery('.tagsInput').tagsInput({
            'height':'50px','width':'100%','interactive':true,
            'defaultText':'<?php _e('Add', 'YVTWP-lang') ?>',
          /*'onAddTag':callback_function,
            'onRemoveTag':callback_function,
            'onChange' : callback_function,*/
            'delimiter': ['',';'],'removeWithBackspace' : true,
            'minChars' : 0,'maxChars' : 0, //if not provided there is no limit,
            'placeholderColor' : '#666666'
        });

        <?php if(!empty($default_settings)){
            if(!isset($default_settings['order']) || empty($default_settings['order']))
                $default_settings['order']='date';
            ?>

        <?php foreach ($default_settings as $key => $value) {
            $unset_keys=array('template_video','template_fields');
            ?>
            <?php if(!in_array($key, $unset_keys)){ ?>
            if(jQuery("input[name=<?php echo $key ?>]").length )
                jQuery("input[name=<?php echo $key ?>]").val("<?php echo $value ?>");
            if(jQuery("select[name=<?php echo $key ?>]").length )
                jQuery("select[name=<?php echo $key ?>]").val("<?php echo $value ?>");            
            <?php } ?>

        <?php } ?>  
            jQuery(".feed_key").val("<?php if(isset($default_settings['feed_key'])){echo $default_settings['feed_key'];} ?>");

            jQuery('input[name=tags]').importTags("<?php echo $default_settings['tags'] ?>");
            jQuery('input[name=title_deleted_keywords]').importTags("<?php echo $default_settings['title_deleted_keywords'] ?>");
            jQuery('input[name=title_remplaced_keywords]').importTags("<?php echo $default_settings['title_remplaced_keywords'] ?>");
            jQuery('input[name=title_remplaced_keywords_by]').importTags("<?php echo $default_settings['title_remplaced_keywords_by'] ?>");
            jQuery('input[name=description_deleted_keywords]').importTags("<?php echo $default_settings['description_deleted_keywords'] ?>");
            jQuery('input[name=description_remplaced_keywords]').importTags("<?php echo $default_settings['description_remplaced_keywords'] ?>");
            jQuery('input[name=description_remplaced_keywords_by]').importTags("<?php echo $default_settings['description_remplaced_keywords_by'] ?>");
        <?php } ?>
        <?php if(isset($arg['import_id'])){ ?>
            jQuery('input[name=import_id]').val('<?php echo $arg['import_id'] ?>');
        <?php } ?>       
            
        <?php  if(isset($default_settings['import_without_pagination']) && !isset($default_settings['import_type'])){  ?>
            var import_without_pagination="<?php echo $default_settings['import_without_pagination'] ?>";
            if(import_without_pagination=='yes')
                jQuery("select[name=import_type]").val('bulk_import');
        <?php  } ?>  

            jQuery(".input_feed_single_video").mouseleave(function(){
                var url=jQuery(this).val();
                var res=getVideoId(url);
                if(res)
                {
                    jQuery(this).val(res);
                    jQuery("input[name=feed_key]").val(res);
                }
            });
        //---------------------General options ------------------------
        jQuery("select[name=import_video_thumbnail]").change(function()
        {
            jQuery("select[name=thumbnails_quality]").attr('disabled','disabled');
            if(jQuery(this).val()=='yes')           
                jQuery("select[name=thumbnails_quality]").removeAttr('disabled'); 
        }); 
        jQuery("select[name=import_video_thumbnail]").change();          
        /*--------------------------------------------------------------*/
        jQuery("select[name=import_youtube_tags]").change(function()
        {
            if(jQuery(this).val()=='no')
                jQuery(".content_max_tags").css({'display':'none'});
            else
                jQuery(".content_max_tags").css({'display':'block'});
        });
        jQuery("select[name=import_youtube_tags]").change();   
        
        jQuery(".pointer_general_options").click(function(){
            jQuery("#a_general_options").click();
        });        

        // switchButton
        jQuery("#checkbox_active_import_schedule").switchButton({width: 50,height: 20,button_width: 25}); 
        jQuery("#checkbox_active_import_schedule").change(function(){
            var is_checked=jQuery(this).attr("checked");

            if(is_checked=="checked")
            {
                jQuery("input[name=active_import_schedule]").val('yes');
            }
            else
            {
                jQuery("input[name=active_import_schedule]").val('no');
            }
        });
        //--------------------------------
        jQuery("select[name=import_type]").change(function()
        {
            if(jQuery(this).val()=='scheduled_import')
            {                
                jQuery(".scheduled_import_msg").css({'display':'block'});
                jQuery("input[name=max_page_results]").val('5');

                <?php if(!isset($_REQUEST['import_id'])){ ?>
                    jQuery("input[name=active_import_schedule]").val('yes');
                <?php } ?>                
                                          
                if(jQuery("input[name=active_import_schedule]").val()!='no')
                {
                    jQuery("#checkbox_active_import_schedule").switchButton({checked: true});                    
                }
                else
                {
                    jQuery("#checkbox_active_import_schedule").switchButton({checked: false}); 
                }
                
                jQuery("select[name=order]").val('date');
            }  
            else
            {
                jQuery("input[name=max_page_results]").val('10');
                jQuery(".scheduled_import_msg").css({'display':'none'});
                jQuery("input[name=active_import_schedule]").val('no');
                jQuery("#checkbox_active_import_schedule").switchButton({
                    checked: false
                  });
            }
            
            jQuery("input[name=reload_when_select_change]").val('1');     
            jQuery("input[name=clear_cache]").val('1');
        });         
        //jQuery("select[name=import_type]").change();        
        
        //date options
        jQuery("select[name=post_publish_date]").change(function()
        {
            if(jQuery(this).val()=='custom_publish_date')           
                jQuery(".custom_publish_dates").css({'display':'block'}); 
            else
                jQuery(".custom_publish_dates").css({'display':'none'}); 

        }); 
        jQuery("select[name=post_publish_date]").change();
        
        /*--------------------comment options---------------------------------*/
        jQuery("select[name=enable_comments_import]").change(function()
        {
            jQuery(".import_comments_config").css({'display':'none'});
            if(jQuery(this).val()=='yes')           
                jQuery(".import_comments_config").css({'display':'block'}); 
        }); 
        jQuery("select[name=enable_comments_import]").change(); 
        
        
        jQuery("select[name=enable_synchronize_video]").change(function()
        {
            jQuery(".enable_synchronize_video_disabled input").attr('disabled','disabled');
            jQuery(".enable_synchronize_video_disabled select").attr('disabled','disabled');
            if(jQuery(this).val()=='yes') {          
                jQuery(".enable_synchronize_video_disabled input").removeAttr('disabled'); 
                jQuery(".enable_synchronize_video_disabled select").removeAttr('disabled'); 
                jQuery("select[name=update_if_exist]").val("yes");
            }
        }); 
        jQuery("select[name=enable_synchronize_video]").change();         
        
        
        jQuery("select[name=enable_comments_synced]").change(function()
        {
            jQuery(".enable_comments_synced_disabled input").attr('disabled','disabled');
            if(jQuery(this).val()=='yes')           
                jQuery(".enable_comments_synced_disabled input").removeAttr('disabled'); 
        }); 
        jQuery("select[name=enable_comments_synced]").change();    
        
        jQuery("select[name=import_comments_replies]").change(function()
        {
            jQuery(".import_comments_replies_disabled input").attr('disabled','disabled');
            if(jQuery(this).val()=='yes')           
                jQuery(".import_comments_replies_disabled input").removeAttr('disabled'); 
        }); 
        jQuery("select[name=import_comments_replies]").change();        
        
        /*--------------------comment options---------------------------------*/
        jQuery(".clear_comments_cache select").change(function(){
            jQuery("input[name=clear_comments_cache]").val('1');
        });
        jQuery(".clear_comments_cache input").change(function(){
            jQuery("input[name=clear_comments_cache]").val('1');
        });         
        
        /*--------------------seo options---------------------------------*/
        jQuery("select[name=enable_rich_snippets]").change(function()
        {
            jQuery(".content_enable_rich_snippets").css({'display':'none'});
            if(jQuery(this).val()=='yes')           
                jQuery(".content_enable_rich_snippets").css({'display':'block'}); 
        }); 
        jQuery("select[name=enable_rich_snippets]").change();         
        
        //-------------------------------------------------------------
        jQuery(".reload_when_select_change select").change(function(){
            jQuery("input[name=reload_when_select_change]").val('1');
            jQuery("input[name=clear_cache]").val('1');
        });
        jQuery(".reload_when_select_change input").change(function(){
            jQuery("input[name=reload_when_select_change]").val('1');
            jQuery("input[name=clear_cache]").val('1');
        });    
        /*--------------------------------*/
        jQuery(document).ready(function(){
            //init indicateur for clear cache
            jQuery("input[name=reload_when_select_change]").val('0'); 
            jQuery("input[name=clear_comments_cache]").val('0');
            jQuery("input[name=clear_cache]").val('0'); 
        });        
        
        //force current user login
        <?php if(!isset($_REQUEST['import_id']) && empty($default_settings['author_login'])){ ?>
            jQuery("input[name=author_login]").val('<?php echo Config_YVTWP::$current_author_login ?>');  
        <?php } ?>
        
    });  
    
    //Plugins script conflicts (changelog 3.0.7)
    jQuery(document).ready(function(){
        jQuery(".content_select_cats").click(function(){
            var menu_status=jQuery(".content_select_cats .dropdown-menu").attr('style');
            if(menu_status=='display: block')
                jQuery(".content_select_cats .dropdown-menu").attr('style','display: none');
            else
                jQuery(".content_select_cats .dropdown-menu").attr('style','display: block');
        });
    });
</script>