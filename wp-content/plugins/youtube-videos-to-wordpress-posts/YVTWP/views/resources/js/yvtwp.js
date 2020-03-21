/**
 * General javascript code
 */

/**
 * @param {type} formID
 * @returns datas for ajax request
 */
function getFormDatas(formID)
{
    if(!formID){
        formID='yvtwp_form_datas';
    }
    var formData = {};
    
    jQuery("#"+formID).find("input[name]").each(function (index, node) {
        formData[node.name] = special_char_replace(node.value);
    });
    jQuery("#"+formID).find("select[name]").each(function (index, node) {
        formData[node.name] = special_char_replace(node.value);
    });    
    jQuery("#"+formID).find("textarea[name]").each(function (index, node) {
        formData[node.name] = node.value;
    });        
    
    return formData;
}
function special_char_replace(stringg)
{
    stringg=stringg.replace(/&quot;/g ,'"');
    //stringg=stringg.replace(/'/g , "&#39;");
        
    return stringg;
}

function beforeSendAjaxRequest(args)
{
    var site_url=jQuery("input[name=yvtwp_site_url]").val();
    if(!site_url)
        site_url="";
    
   //var wait_div='<div class="yvtwp_wait"><i class="fa fa-refresh fa-spin fa-3x fa-fw margin-bottom"></i></div>';
   var wait_div='<div class="yvtwp_wait"><img style="color:red" img src="'+site_url+'/wp-admin/images/wpspin_light.gif" alt="Please wait..." title="Please wait..." /></div>';
   
   if(args.form_id)
   {
       jQuery("#"+args.form_id+" .yvtwp_content_save_button").css({'display':'none'});
       jQuery("#"+args.form_id+" .yvtwp_user_fedback").html(wait_div);
   }
}
/*
 * 
 */
function afterSendAjaxRequest(args)
{
   var msg_content='';
   switch(args.status) 
   {
    case 0: //error        
        if(args.show_popin_error==1)
        {
            swal({
                title: "Error!",
                text: args.message,
                type: "error",
                html: true,
                closeOnConfirm:true,
                confirmButtonText: "Ok"
            });              
        }
        else
        {
            msg_content='<div class="alert alert-danger"><p class="yvtwp_msg_content">'+args.message+'</p></div>';
        }
        break;
    case 1: //success        
        if(args.show_popin_success==1)
        {
            swal({
                title: "Success",
                text: args.message,
                type: "success",
                html: true,
                timer: 10000,
                confirmButtonText: "Ok"
            });   
        }
        else
        {
            if(args.message!='')
            {
                msg_content='<div class="alert alert-success"><p class="yvtwp_msg_content">'+args.message+'</p></div>';
            }
        }
        break;
    }
   
   if(args.form_id)
   {      
       if(args.message!='')
       {
            jQuery("#"+args.form_id+" .yvtwp_user_fedback").html(msg_content); 
            jQuery("#"+args.form_id+" .yvtwp_content_save_button").css({'display':'block'});
       }
   }

}
/**
 * 
 * @param {type} param
 */
function msgSuccessAjax(response,form_id,init)
{
    var exclude_form=['yvtwp_form_change_role','yvtwp_form_change_post_type','yvtwp_form_change_taxonomy'];
    
    if(jQuery.inArray(form_id,exclude_form)== -1)
    {
        if(init==1)
        {
            jQuery('#'+form_id+' .yvtwp_save_button').css({'display':'none'});
            jQuery('#'+form_id+' .yvtwp_wait').css({'display':'block'});
            jQuery('#'+form_id+' .yvtwp_msg_box').css({'display':'none'});
        }
        else
        {    
            jQuery('#'+form_id+' .yvtwp_save_button').css({'display':'inline'});
            jQuery('#'+form_id+' .yvtwp_wait').css({'display':'none'});    
            jQuery('#'+form_id+' .yvtwp_msg_box').css({'display':'block'}); 

            var status =response.status;
            if(status=='1'){
                jQuery('#'+form_id+' .yvtwp_msg_box .alert').removeClass('alert-danger');
                jQuery('#'+form_id+' .yvtwp_msg_box .alert').addClass('alert-success');
                jQuery('#'+form_id+' .yvtwp_msg_content').html(response.messages);
                swal({
                    title: "Success",
                    text: response.messages,
                    type: "success",
                    html: true,
                    timer: 500,
                    confirmButtonText: "Ok"
                });            
            }
            else{
                jQuery('#'+form_id+' .yvtwp_msg_box .alert').removeClass('alert-success');
                jQuery('#'+form_id+' .yvtwp_msg_box .alert').addClass('alert-danger'); 
                jQuery('#'+form_id+' .yvtwp_msg_content').html(response.messages);
                //alert("error");
                swal({
                    title: "Error!",
                    text: response.messages,
                    type: "error",
                    html: true,
                    confirmButtonText: "Ok"
                });            
            }
        }        
    }
    


}//End function
/**
 * 
 * @param {type} param
 */
function msgErrorAjax(form_id)
{
    jQuery('#'+form_id+' .save_button').css({'display':'inline'});
    jQuery('#'+form_id+' .yvtwp_wait').css({'display':'none'});    
    jQuery('#'+form_id+' .yvtwp_msg_box').css({'display':'block'}); 

    jQuery('#'+form_id+' .yvtwp_msg_box .alert').removeClass('alert-success');
    jQuery('#'+form_id+' .yvtwp_msg_box .alert').addClass('alert-danger'); 
    jQuery('#'+form_id+' .yvtwp_msg_content').html('Error Ajax');
    //alert("error");
}  
/*
 * 
 */
function getVideoId(url){
    if(url.indexOf('?') != -1 ) {
        var query = decodeURI(url).split('?')[1];
        var params = query.split('&');
        for(var i=0,l = params.length;i<l;i++)
            if(params[i].indexOf('v=') === 0)
                return params[i].replace('v=','');
    } else if (url.indexOf('youtu.be') != -1) {
        return decodeURI(url).split('youtu.be/')[1];
    }
    return null;
}