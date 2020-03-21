<script type="text/javascript">
    function sendAjaxRequest(fn_success,form_id)
    {
        jQuery.ajax({
        url : "<?php echo Config_YVTWP::getAjaxUrl() ?>",
        type: "POST",
        async: true,
        data : getFormDatas(form_id), //default form id yvtwp_form_datas
        success:function(data, textStatus, jqXHR)
        { 
            if(data==''){var data='{"status":0,"messages":"Undefined error try again","result":null}';}
            
            var extract_data = data.match(/{"status"(.*)}/).pop();    
            extract_data='{"status"'+extract_data+'}';
            //alert(extract_data);
            var response=jQuery.parseJSON(extract_data);
            //var response=jQuery.parseJSON(data);
            fn_success(response);
            //msgSuccessAjax(response,form_id);
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
        msgErrorAjax(form_id);
        }

        });

    }//End function   

    jQuery(document).ready(function(){            
        //index page
        jQuery(".tooltip_feed_key").tooltip(); 
    
        /***
         * admin.php?page=yvtwp&yvtwp_controller=YoutubeImport&yvtwp_action=newImport
         * views/youtube/new_import.php
         */
        jQuery(document).ready(function(){
            
             jQuery('#feed_type').change(function(){
                 jQuery("select[name=import_type]").change();
                 
                 var el=jQuery(this).val();
                 jQuery(".yvtwp_block_feed li").css({'display':'none'}); //init all
                 jQuery(".yvtwp_block_feed ."+el).css({'display':'block'}); 

                 jQuery(".schedule_marges").css({'display':'block'});

                 jQuery(".yvtwp_block_feed li input").removeAttr("required"); //init all
                 jQuery(".yvtwp_block_feed ."+el+" input").attr('required','required');

                 //-------------------------------------------------------------
                 jQuery(".yvtwp_filter_and_order").css({'display':'block'});
                 jQuery(".yvtwp_max_feed_results").css({'display':'block'});
                 jQuery(".import_without_pagination").css({'display':'block'});
                 jQuery(".content_video_published_after").css({'display':'block'});
                 jQuery(".sep_video_published_after").css({'display':'none'});
                 switch(el)
                 {
                     case 'feed_channel':
                         jQuery(".yvtwp_filter_and_order").css({'display':'none'});
                        break;                     
                     case 'feed_playlist':
                         jQuery(".yvtwp_filter_and_order").css({'display':'none'});
                        break;
                     case 'feed_user':
                         jQuery(".yvtwp_filter_and_order").css({'display':'none'});
                        break; 
                     case 'feed_single_video':
                         jQuery(".yvtwp_filter_and_order").css({'display':'none'});
                         jQuery(".yvtwp_max_feed_results").css({'display':'none'});
                         jQuery(".import_without_pagination").css({'display':'none'});
                         jQuery(".content_video_published_after").css({'display':'none'});
                         jQuery(".sep_video_published_after").css({'display':'block'});
                         
                         jQuery(".scheduled_import_msg").css({'display':'none'});
                         jQuery(".schedule_marges").css({'display':'none'});
                        break;                        
                 }
                        
             });

             jQuery('#feed_type').change();
             

         });     

        /*show current feed type in select input for 
        views/youtube/index.php and views/youtube/new_import.php
        */
        <?php if(isset($_REQUEST['feed_type'])){ ?>
            jQuery("#feed_type").val("<?php echo $_REQUEST['feed_type'] ?>");
            jQuery(".yvtwp_block_feed li").css({'display':'none'}); //init all
            jQuery(".yvtwp_block_feed .<?php echo $_REQUEST['feed_type'] ?>").css({'display':'block'});
            jQuery(".<?php echo 'panel_'.$_REQUEST['feed_type'] ?>").addClass("panel-primary");

            jQuery(".yvtwp_block_feed li input").removeAttr("required"); //init all
            jQuery(".yvtwp_block_feed .<?php echo $_REQUEST['feed_type'] ?> input").attr('required','required');          

        <?php }else{ ?>
            //default choice
            jQuery(".yvtwp_block_feed li").css({'display':'none'}); //init all
            jQuery(".yvtwp_block_feed .feed_channel").css({'display':'block'});         

            jQuery(".yvtwp_block_feed li input").removeAttr("required"); //init all
            jQuery(".yvtwp_block_feed .feed_channel input").attr('required','required');     
        <?php } ?>

        //jquery timeago   
        jQuery("abbr.timeago").timeago();

    });        


<?php 
    $menu_position=1;
    if(isset($_REQUEST['yvtwp_action']))
    {
        switch ($_REQUEST['yvtwp_action']) 
        {
            case 'newImport':
                $menu_position=2;
                break;
            case 'defaultImportSettings':
                $menu_position=3;
                break;
            case 'generalSettings':
                $menu_position=4;
                break;
            case 'brokenVideoIndex':
                $menu_position=5;
                break;            
            case 'log':
                $menu_position=6;
                break;  
            case 'themeLoaderIndex':
                $menu_position=7;
                break;              
            case 'youtubeAPISettings':
                $menu_position=8;
                break;              
            default:                
                break;
        }
    }
?>

jQuery('#toplevel_page_yvtwp ul li:eq(1)').removeClass("current");
jQuery('#toplevel_page_yvtwp ul li:eq(1) a').removeClass("current"); // gets first li

jQuery('#toplevel_page_yvtwp ul li:eq(<?php echo $menu_position ?>)').addClass("current");
jQuery('#toplevel_page_yvtwp ul li:eq(<?php echo $menu_position ?>) a').addClass("current");    

</script>
<?php if(is_rtl()){ ?>
    <style>
        .yvtwp_container
        {
            direction: ltr;
            padding-left: 30px;
            text-align: left;
        }
        .yvtwp_container .wrap {
            margin: 10px 2px 0 30px;
        }
        .tablenav .tablenav-pages {
            float: right;
        }
        #table_video_list,.table_head_feed,.table-responsive
        {
            direction: ltr;
            text-align: left;
        }
        #table_video_list th {
            direction: rtl;
        }
        #yvtwp_form_feed_page_attributs td
        {
            direction: rtl;
        }
    </style>
<?php } ?>
    <input type="hidden" name="yvtwp_site_url" value="<?php echo get_site_url() ?>" />