<?php
/**
 * VideoTube Submit Video
 * Add [msubmit] shortcode to create the Submit Video page.
 * @author 		Toan Nguyen
 * @category 	Core
 * @version     1.0.0
 */
if( !defined('ABSPATH') ) exit;
if( !class_exists('Mars_ShortcodeSubmitVideo') ){
	class Mars_ShortcodeSubmitVideo {
		function __construct() {
			add_action('init', array($this,'add_shortcodes'));
			add_action('wp_ajax_mars_submit_video', array($this,'action_form'));
			add_action('wp_ajax_nopriv_mars_submit_video', array($this,'action_form'));
		}
		function add_shortcodes(){
			add_shortcode('videotube_upload', array($this,'videotube_upload'));
		}
		function videotube_upload( $attr, $content = null){
			global $videotube;
			global $post;	
			$html = null;
			extract(shortcode_atts(array(
				'id'			=>	'',
				'vcategory'		=>	'on',
				'vtag'			=>	'on',
				'cat_exclude'	=>	'',
				'cat_include'	=>	'',
				'cat_orderby'	=>	'name',
				'cat_order'		=>	'DESC'
			), $attr));
			$video_type = isset( $videotube['video-type'] ) ? $videotube['video-type'] : null;
			if( !is_array( $video_type ) ){
				$video_type = (array)$video_type;
			}
			$submit_roles = isset( $videotube['submit_roles'] ) ? (array)$videotube['submit_roles'] : 'author';
			if( count( $submit_roles ) == 1 ){
				$submit_roles = (array)$submit_roles;
			}	
			//print_r($submit_roles);
			### 0 is not allow guest, 1 is only register.
			$submit_permission = isset( $videotube['submit_permission'] ) ? $videotube['submit_permission'] : 0;
			$user_id = get_current_user_id();
			$current_user_role = mars_get_user_role( $user_id );
			### Check if Admin does not allow Visitor submit the video.
			if( $submit_permission == 0 && !$user_id ){
				
				$login_shortcode = apply_filters( 'submit_form_login_shortcode' , '[videotube_login]');
				
				$html .= do_shortcode($login_shortcode);			
			}
			//elseif( $submit_permission == 0 && !in_array( $current_user_role, $submit_roles) && $current_user_role != 'administrator'){
			elseif( $submit_permission == 0 && !in_array( $current_user_role, $submit_roles)){
				$html .= '
					<div class="alert alert-warning">'.__('You don\'t have the right permission to access this feature.','mars').'</div>
				';		
			}
			else{
				
				$edit = false;
				$post_data = array(
					'post_title'		=>	'',
					'post_content'		=>	'',
					'post_categories'	=>	array(),
					'post_tags'			=>	''
				);
				
				if( ! empty( $id ) && get_post_type( $id ) == 'video' ){
					$post_data = array_merge( $post_data, get_post( $id, ARRAY_A ) );
					
					if( has_term( null, 'video_tag', $id ) ){
						$tags = get_the_terms( $id, 'video_tag' );
						$post_data['post_tags'] = join(",", wp_list_pluck( $tags , 'name') );
					}
					
					if( has_term( null, 'categories', $id ) ){
						$categories= get_the_terms( $id, 'categories' );
						$post_data['post_categories'] = wp_list_pluck( $categories, 'term_id');
					}
					
					$edit = true;
				}
				
				$categories_html = null;
				$category_array = array(
					'hide_empty'=>0,
					'order'	=>	$cat_order,
					'orderby'	=>	$cat_orderby,
				);
				if( ! empty( $cat_exclude ) ){
					$cat_exclude = explode(",", $cat_exclude);
					if( is_array( $cat_exclude ) ){
						$category_array['exclude']	= $cat_exclude;
					}
				}
				if( ! empty( $cat_include ) ){
					$cat_include = explode(",", $cat_include);
					if( is_array( $cat_include ) ){
						$category_array['include']	= $cat_include;
					}
				}		
				
				$categories = get_terms('categories', $category_array);
				
				 if ( !empty( $categories ) && !is_wp_error( $categories ) ){
				 	$categories_html .= '<select name="categories-multiple" id="categories-multiple" class="multi-select-categories form-control" multiple="multiple">';
				 	foreach ( $categories as $category ){
				 		$selected = in_array( $category->term_id , $post_data['post_categories']) ? 'selected' : '';
				 		$categories_html .= '<option '.$selected.' value="'.$category->term_id.'">'.$category->name.'</option>';
				 	}
				 	$categories_html .= '</select>';
				 }
				 
				$html .= '<form role="form" action="" method="post" id="mars-submit-video-form" enctype="multipart/form-data">';
					if( isset( $_GET['resp'] ) && $_GET['resp'] == 'success' ){
						$html .= '<div class="alert alert-success" role="alert">'.esc_html__( 'Updated!', 'mars' ).'</div>';
					}
					 $html .= '<div class="form-group post_title">
					    <label for="post_title">'.__('Title','mars').'</label>
					    <span class="label label-danger">'.__('Required','mars').'</span>
					    <input type="text" class="form-control" name="post_title" id="post_title" value="'.esc_attr( $post_data['post_title'] ).'">
					    <span class="help-block"></span>
					  </div>
					  <div class="form-group post_content">
					    <label for="post_content">'.__('Description','mars').'</label>';
						if( $videotube['submit_editor'] == 1 ){
							$html .= mars_get_editor( $post_data['post_content'], 'post_content', 'post_content');	
						}
						else{
							$html .= '<textarea name="post_content" id="post_content" class="form-control" rows="3">'.esc_textarea( $post_data['post_content'] ).'</textarea>';
						}
					  $html .= '<span class="help-block"></span>';
					  
					  $html .= '</div>';
					  
					  if( ! $edit ){
						  $html .= '<div class="form-group video-types">
						  	<label for="post_title">'.__('Type','mars').'</label>
						  	<span class="label label-danger">'.__('Required','mars').'</span>';
						  	if( in_array( 'videolink', $video_type ) ){
						  		$html .= '
								  	<div class="radio">
									  	<input checked type="radio" value="video_link_type" name="chb_video_type">'.__('Link','mars').'			  	
								  	</div>					  		
						  		';
						  	}
						  	if( in_array( 'embedcode', $video_type ) ){
						  		$html .= '
								  	<div class="radio">
									  	<input type="radio" value="embed_code_type" name="chb_video_type">'.__('Embed Code','mars').'					  	
								  	</div>					  		
						  		';
						  	}
						  	if( in_array( 'videofile', $video_type ) ){
						  		$html .= '
								  	<div class="radio">
									  	<input type="radio" value="file_type" name="chb_video_type">'.__('Upload file','mars').'					  	
								  	</div>					  		
						  		';
						  	}
						  $html .= '</div>';
						  
						  if( in_array( 'videolink', $video_type ) ){
						  	$html .= '
							  <div class="form-group video_url video-type video_link_type">
							    <label for="video_url">'.__('Video Link','mars').'</label>
							    <span class="label label-danger">'.__('Required','mars').'</span>
							    <input type="text" class="form-control" name="video_url" id="video_url" placeholder="Example: http://www.youtube.com/watch?v=X6pQ-pNSnRE">
							    <span class="help-block"></span>
							  </div>					  	
						  	';
						  }
						  if( in_array( 'embedcode', $video_type ) ){
						  	$html .= '
							  <div class="form-group embed_code_type video-type embed_code_type" style="display:none;">
							    <label for="video_url">'.__('Embed Code','mars').'</label>
							    <span class="label label-danger">'.__('Required','mars').'</span>
							    <textarea class="form-control" name="embed_code" id="embed_code"></textarea>
							    <span class="help-block"></span>
							  </div>					  	
						  	';
						  }
						  if( in_array( 'videofile', $video_type ) ){
						  	$html .= '<div class="form-group video_file video-type file_type" style="display:none;">';
							  	$html .= '<label><div class="btn-group">';
							  		$html .= '<a class="btn btn-default btn-sm upload-file upload-video-file"><i class="fa fa-cloud-upload" aria-hidden="true"></i> '. __( 'Upload video file', 'mars' ) .'</a>';
							  		$html .= '<input style="display:none;" type="file" type="text" class="form-control" name="video_file" id="video_file">';
							  	$html .= '</div><label>';
						  	$html .= '</div>';
						  }
					  }

					  $html .= '<div class="form-group video_thumbnail">';
						  $html .= '<label><div class="btn-group">';
							  $html .= '<a class="btn btn-default btn-sm upload-file upload-image-file"><i class="fa fa-cloud-upload" aria-hidden="true"></i> '. __( 'Upload Image', 'mars' ) .'</a>';
							  $html .= '<input style="display:none;" type="file" type="text" class="form-control" name="video_thumbnail" id="video_thumbnail">';
						  $html .= '</div></label>';
						  if( $edit && has_post_thumbnail( $id ) ){
						  	$html .= '<div class="thumbnail-image">';
						  		$html .= get_the_post_thumbnail( $id, 'thumbnail' );
						  	$html .= '</div>';
						  }
					  $html .= '</div>';

					  if( $vtag == 'on' ):

						  $html .= '<div class="form-group video-tag">
						    <label for="key">'.__('Tags','mars').'</label>
						    <input value="'.esc_attr( $post_data['post_tags'] ).'" type="text" class="form-control" name="video_tag" id="video_tag">
							<span class="help-block">'.
								__( 'Enter tags, separated by commas(,), e.g: travel,vblog,tutorial', 'mars' )
							.'</span>
						  </div>';
					  endif;
					  if( $vcategory == 'on' ):
					  	$html .= '<div class="form-group categories-video">
						    <label for="category">'.__('Category','mars').'</label>';
						    $html .= $categories_html;
						  $html .= '</div>';
					  endif;
					  $videolayout = isset( $videotube['videolayout'] ) ? $videotube['videolayout'] : 'yes';
					  if( $videolayout == 'yes' ){
						$html .= '
	 						<div class="form-group layout"> 	
							  	<label for="layout">'.__('Layout','mars').'</label>';
									if( function_exists( 'mars_videolayout' ) ){
										$i = 0;
										foreach ( mars_videolayout() as $key=>$value ){
											$i++;
											//$html .= '<option value="'.$key.'">'.$value.'</option>';
											$html .= '<div class="radio">';
												$html .= '<input '. ( $i==1 ? 'checked' : null ) .' type="radio" name="layout" value="'.$key.'">' . $value;
											$html .= '</div>';
										}
									}
							  	$html .= '
							  	<span class="help-block"></span>				    
						  	</div>						
						';
					  }
					  
					  $html .= '<div class="form-group group-submit">';
						  if( $edit ){
						  	$html .= '<button type="submit" class="btn btn-primary"">'.__('Update','mars').'</button>';
						  	$html .= '<button id="delete-video" data-id="'.esc_attr( $id ).'" href="'.esc_url( get_permalink( $id ) ).'" class="btn btn-danger"">'.__('Delete video','mars').'</button>';
						  	$html .= '<a href="'.esc_url( get_permalink( $id ) ).'" class="btn btn-default"">'.__('Go to video','mars').'</a>';
						  }
						  else{
						  	$html .= '<button type="submit" class="btn btn-primary"">'.__('Submit','mars').'</button>';
						  }
						  $html .= '
						  <input type="hidden" name="current_page" value="'.$post->ID.'">
						  <input type="hidden" name="attachment_id">
						  <input type="hidden" name="_thumbnail_id">
						  <input type="hidden" name="post_id" value="'.esc_attr( $id ).'">
						  <input type="hidden" name="action" value="mars_submit_video">';
					  $html .= '</div>';
					$html .= '
					</form>
				';
				
			}
			return do_shortcode( $html );
		}
		function action_form(){
			global $videotube;
			$videosize = isset( $videotube['videosize'] ) ? (int)$videotube['videosize'] : 10;
			$post_title = wp_filter_nohtml_kses( $_POST['post_title'] );
			$video_url = isset( $_POST['video_url'] ) ? trim( $_POST['video_url'] ) : null;
			$embed_code = isset( $_POST['embed_code'] ) ? trim( $_POST['embed_code'] ) : null;
			$video_file = isset( $_FILES['video_file'] ) ? $_FILES['video_file'] : null;
			$post_content = wp_filter_nohtml_kses( $_POST['post_content'] );
			$chb_video_type = isset( $_POST['chb_video_type'] ) ? $_POST['chb_video_type'] : null;
			$video_thumbnail = isset( $_FILES['video_thumbnail'] ) ? $_FILES['video_thumbnail'] : null; 
			$video_tag = isset( $_POST['video_tag'] ) ? wp_filter_nohtml_kses( $_POST['video_tag'] ) : null;
			$video_category = isset( $_POST['video_category'] ) ? $_POST['video_category'] : null;
			$user_id = get_current_user_id() ? get_current_user_id() : $videotube['submit_assigned_user'];
			$post_status = $videotube['submit_status'] ? $videotube['submit_status'] : 'pending'; 
			$layout = isset( $_POST['layout'] ) ? $_POST['layout'] : 'small';
				
			if( !$post_title ){
				echo json_encode(array(
					'resp'	=>	'error',
					'message'	=>	__('Video Title is required','mars'),
					'element_id'	=>	'post_title'
				));exit;
			}
			if( !$post_content ){
				echo json_encode(array(
					'resp'	=>	'error',
					'message'	=>	__('Video Description is required','mars'),
					'element_id'	=>	'post_content'
				));exit;					
			}
			
			if( !$chb_video_type ){
				echo json_encode(array(
					'resp'	=>	'error',
					'message'	=>	__('Video Type is required','mars'),
					'element_id'	=>	'chb_video_type'
				));exit;				
			}
			
			switch ($chb_video_type) {
				case 'video_link_type':
					if( !$video_url ){
						echo json_encode(array(
							'resp'	=>	'error',
							'message'	=>	__('Video Link is required','mars'),
							'element_id'	=>	'video_url'
						));exit;				
					}
					if( !wp_oembed_get( $video_url ) ){
						echo json_encode(array(
							'resp'	=>	'error',
							'message'	=>	__('The link does not support.','mars'),
							'element_id'	=>	'video_url'
						));exit;			
					}
				break;
				
				case 'embed_code_type':
					if( !$embed_code ){
						echo json_encode(array(
							'resp'	=>	'error',
							'message'	=>	__('Embed Code is required','mars'),
							'element_id'	=>	'embed_code'
						));exit;
					}
					if( apply_filters( 'mars_submitform_thumbnail_required' , true) === true ):
						if( !$video_thumbnail ){
							echo json_encode(array(
								'resp'	=>	'error',
								'message'	=>	__('Video Preview Image is required','mars'),
								'element_id'	=>	'video_thumbnail'
							));exit;
						}
						if( !mars_check_file_allowed( $video_thumbnail, 'image' ) ){
							echo json_encode(array(
								'resp'	=>	'error',
								'message'	=>	__('Video Preview Image type is invalid','mars'),
								'element_id'	=>	'video_thumbnail'
							));exit;
						}
					endif;
				break;
				default:
					if( !$video_file ){
						echo json_encode(array(
							'resp'	=>	'error',
							'message'	=>	__('Video File is required.','mars'),
							'element_id'	=>	'video_file'
						));exit;
					}
					if( !mars_check_file_allowed( $video_file, 'video' ) ){
						echo json_encode(array(
							'resp'	=>	'error',
							'message'	=>	__('Video File is invalid.','mars'),
							'element_id'	=>	'video_file'
						));exit;
					}
					if( !mars_check_file_size_allowed($video_file) ){
						echo json_encode(array(
							'resp'	=>	'error',
							'message'	=>	__('The video size must be less than ' . $videosize . 'MB','mars'),
							'element_id'	=>	'video_file'
						));exit;						
					}
					if( apply_filters( 'mars_submitform_thumbnail_required' , true) === true ):
						if( !$video_thumbnail ){
							echo json_encode(array(
								'resp'	=>	'error',
								'message'	=>	__('Video Preview Image is required','mars'),
								'element_id'	=>	'video_thumbnail'
							));exit;
						}
						if( !mars_check_file_allowed( $video_thumbnail, 'image' ) ){
							echo json_encode(array(
								'resp'	=>	'error',
								'message'	=>	__('Video Preview Image type is invalid','mars'),
								'element_id'	=>	'video_thumbnail'
							));exit;
						}
					endif;
				break;
			}
			
			/**
			 * Error handler
			 * @since Videotube V2.2.7
			 */
			$errors = new WP_Error();
			$errors	=	apply_filters( 'do_ajax_submit_video_errors' , $errors, $_POST );
			
			if ( ! empty( $errors->errors ) ) {
				echo json_encode(array(
					'resp'	=>	'error',
					'message'	=>	$errors->get_error_message(),
					'element_id'	=>	$errors->get_error_code()
				));exit;
			}
			
			$postarr = array(
				'post_title'	=>	$post_title,
				'post_content'	=>	$post_content,
				'post_type'	=>	'video',
				'post_author'	=>	$user_id,
				'post_status'	=>	$post_status,
				'comment_status'	=>	'open'
			);
			
			$postarr	=	apply_filters( 'mars_submit_data_args' , $postarr );
			
			$post_id = wp_insert_post($postarr, true);
			
			if ( is_wp_error( $post_id ) ){
				echo json_encode(array(
					'resp'	=>	'error',
					'message'	=>	$post_id->get_error_message()
				));exit;
			}
			
			###  update meta
			if( $layout ){
				update_post_meta( $post_id , 'layout', $layout);
			}
			if( $video_url ){
				update_post_meta( $post_id , 'video_url', $video_url);
			}
			elseif ( $embed_code){
				update_post_meta( $post_id , 'video_url', $embed_code);
			}
			else{
				### Upload files.
				if( function_exists('mars_insert_attachment') ){
					mars_insert_attachment('video_file', $post_id, false, 'video_file');
					update_post_meta( $post_id , 'video_type', 'files');
				}
			}
			### Preview image
			if( $video_thumbnail ){
				### Upload files.
				if( function_exists('mars_insert_attachment') ){
					mars_insert_attachment('video_thumbnail', $post_id, true);
				}
			}
			### update term
			if( $video_tag ){
				wp_set_post_terms($post_id, $video_tag,'video_tag',true);	
			}
			if( $video_category ){
				wp_set_post_terms($post_id, $video_category,'categories',true);
			}
			do_action('mars_save_post',$post_id);
			if( $post_status != 'publish' ){
				$redirect_to = $videotube['submit_redirect_to'] ? get_permalink( $videotube['submit_redirect_to'] ) : NULL;
				if( empty( $redirect_to ) ){
					echo json_encode(array(
						'resp'	=>	'success',
						'message'	=>	__('Congratulation, Your submit is waiting for approval.','mars'),
						'post_id'	=>	$post_id,
					));exit;
				}
				else{
					echo json_encode(array(
						'resp'	=>	'success',
						'message'	=>	__('Congratulation, Your submit is waiting for approval.','mars'),
						'post_id'	=>	$post_id,
						'redirect_to'	=>	$redirect_to
					));exit;					
				}
			}
			else{
				echo json_encode(array(
					'resp'	=>	'publish',
					'message'	=>	__('Congratulation, Your submit is published.','mars'),
					'post_id'	=>	$post_id,
					'redirect_to'	=>	get_permalink( $post_id )
				));exit;				
			}
		}
	}
	new Mars_ShortcodeSubmitVideo();
}