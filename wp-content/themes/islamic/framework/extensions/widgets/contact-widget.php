<?php
/**
 * Plugin Name: CrunchPress Contact Widget
 * Description: Contact From Widget.
 *
 */

/**
 * Add function to widgets_init that'll load our widget.
 * @since 0.1
 */
add_action( 'widgets_init', 'contact_widget' );

/**
 * Register our widget.
 * 'Example_Widget' is the widget class used below.
 *
 * @since 0.1
 */
function contact_widget() {
	register_widget( 'contact' );
}

/**
 * Example Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update.  Nice!
 *
 * @since 0.1
 */
class contact extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function contact() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'contact-widget', 'description' => __('Contact From Widget.', 'crunchpress') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'contact-widget' );

		/* Create the widget. */
		$this->WP_Widget( 'contact-widget', __( THEME_NAME_F. ' - Contact form', 'crunchpress'), $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		wp_reset_query();
		
		/* Our variables from the widget settings. */
		$title = apply_filters('Last From Port', $instance['title'] );

		/* Before widget (defined by themes). */
		echo $before_widget;
		
		/* Display the widget title if one was input (before and after defined by themes). */
		if($title) echo $before_title . $title . $after_title;
		
		//If the form is submitted
		if(isset($_POST['submitted'])) {

			//Check to see if the honeypot captcha field was filled in
			if(trim($_POST['checking']) !== '') {
				$captchaError = true;
			} else {
			
				//Check to make sure that the name field is not empty
				if(trim($_POST['widget-contactName']) === '') {
					$nameError = 'Please enter your name';
					$hasError = true;
				} else {
					$name = trim($_POST['widget-contactName']);
				}
				
				//Check to make sure sure that a valid email address is submitted
				if(trim($_POST['widget-email']) === '')  {
					$emailError = 'Please enter a valid email address';
					$hasError = true;
				} else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['widget-email']))) {
					$emailError = 'Please enter a valid email address';
					$hasError = true;
				} else {
					$email = trim($_POST['widget-email']);
				}
					
				//Check to make sure comments were entered	
				if(trim($_POST['widget-comments']) === '') {
					$commentError = 'Please enter message';
					$hasError = true;
				} else {
					if(function_exists('stripslashes')) {
						$comments = stripslashes(trim($_POST['widget-comments']));
					} else {
						$comments = trim($_POST['widget-comments']);
					}
				}
					
				//If there is no error, send the email
				if(!isset($hasError)) {

					$emailTo = $instance['email'];
					$subject = 'Contact Form Submission from '.$name;
					$sendCopy = isset($_POST['sendCopy'])? trim($_POST['sendCopy']): false;
					$body = "Name: $name \n\nEmail: $email \n\nComments: $comments";
					$headers = 'From: My Site <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;
					
					@mail($emailTo, $subject, $body, $headers);

					if($sendCopy == true) {
						$subject = 'You emailed Your Name';
						$headers = 'From: Your Name <noreply@somedomain.com>';
						mail($email, $subject, $body, $headers);
					}

					$emailSent = true;

				}
			}
		} 
		
		
		?>
		
		<script type="text/javascript">
			/* Contact Form Widget*/
			jQuery(document).ready(function() {
				jQuery('form#contactForm').submit(function() {
					jQuery('form#contactForm .error').remove();
					var hasError = false;
					jQuery('.requiredField').each(function() {
						if(jQuery.trim(jQuery(this).val()) == '') {
							var labelText = jQuery(this).prev('label').text();
							jQuery(this).parent().append('<div class="error"><?php echo __('* Require','cp_front_end'); ?></div>');
							hasError = true;
							
						} else if(jQuery(this).hasClass('email')) {
							var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
							if(!emailReg.test(jQuery.trim(jQuery(this).val()))) {
								var labelText = jQuery(this).prev('label').text();
								jQuery(this).parent().append('<div class="error"><?php echo __('* Require','cp_front_end'); ?></div>');
								hasError = true;
							}
						}
					});
					
					if(!hasError) {
						jQuery('form#contactForm li.buttons button').fadeOut('normal', function() {
							jQuery(this).parent().append('<?php echo __('Please Wait...','cp_front_end'); ?>');
						});
						var formInput = jQuery(this).serialize();
						jQuery.post(jQuery(this).attr('action'),formInput, function(data){
							jQuery('form#contactForm').slideUp("fast", function() {				   
								jQuery(this).before('<p class="thanks"><?php echo __('Thanks! Your email was sent','cp_front_end'); ?></p>');
							});
						});
					}
					
					return false;
					
				});
			});			
		</script>			
				
		<div class="contact-widget-whole"> 				
					<?php if(isset($hasError) || isset($captchaError)) { ?>
						<p class="error"><?php echo get_option(THEME_NAME_S.'_translator_sending_error_contact_widget','There was an error submitting the form.'); ?><p>
					<?php } ?>
						<div class="contact-widget">
								<form action="<?php the_permalink(); ?>" id="contactForm" method="post">
							
									<ol class="forms">
											<input type="text" name="widget-contactName" id="widget-contactName" value="<?php if(isset($_POST['widget-contactName'])) echo $_POST['widget-contactName'];?> Name" class="requiredField footerinput" />
										<?php if(!empty($nameError) && $nameError != '') { ?>
												<span class="error"><?php echo $nameError;?></span>
										<?php } ?>
											<input type="text" name="widget-email" id="widget-email" value="<?php if(isset($_POST['widget-email']))  echo $_POST['widget-email'];?> E-mail" class="requiredField email footerinput" />
										<?php if(!empty($emailError) && $emailError != '') { ?>
												<span class="error"><?php echo $emailError;?></span>
										<?php } ?>
											<textarea name="widget-comments" id="widget-commentsText" class="requiredField footertextarea" ><?php if(isset($_POST['widget-comments'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['widget-comments']); } else { echo $_POST['widget-comments']; } } ?>Message</textarea>
										<?php if(!empty($commentError) && $commentError != '') { ?>
												<span class="error"><?php echo $commentError;?></span> 
										<?php } ?>
										<li class="screenReader"><label class="screenReader">If you want to submit this form, do not enter anything in this field</label><input type="text" name="checking" id="checking" class="screenReader" value="<?php if(isset($_POST['checking']))  echo $_POST['checking'];?>" /></li>
										<li class="buttons"><input type="hidden" name="submitted" id="submitted" value="true" /><button type="submit" class="button"><?php echo __('Submit','cp_front_end'); ?></button></li>
									</ol>
								</form>
						</div>
						<div class="clear alignleft"></div>
												
		<?php 
		/* After widget (defined by themes). */
		echo $after_widget;
		echo "</div>";
	}

	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['email'] = strip_tags( $new_instance['email'] );

		return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => __('Contact Widget', 'crunchpress'), 'email' => '');
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'crunchpress'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="width100" />
		</p>

		<!-- Widget Email: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'email' ); ?>"><?php _e('Email:', 'crunchpress'); ?></label>
			<input id="<?php echo $this->get_field_id( 'email' ); ?>" name="<?php echo $this->get_field_name( 'email' ); ?>" value="<?php echo $instance['email']; ?>" class="width100" />
		</p>		
		
	<?php
	}
}

?>
<?php
/*
Contact Info Widget
*/

class contact_info_widget extends WP_Widget {

  function contact_info_widget() {
     /* Widget settings. */
    $widget_ops = array(
     'description' => 'Contact Info Widget');

     /* Widget control settings. */
    $control_ops = array(
       'width' => 250,
       'height' => 250,
       'id_base' => 'contact_info-widget');

    /* Create the widget. */
   $this->WP_Widget('contact_info-widget', 'Crunch-biz - Contact Info', $widget_ops, $control_ops );
  }

  function form ($instance) {
    /* Set up some default widget settings. */
    $defaults = array(
	'title'=>'Contact Info',
	'col_1_heading'=>'Direction' ,
	'col_2_heading'=>'Address' ,
	'col_3_heading'=>'Phone' ,
	'col_4_heading'=>'Email' ,
	
	'col_1_content'=>'Vestibulum dolor Duis gravida, enim ut fermeneget Enim ut fermentum..',
	'col_2_content'=>'Nikolay Yordanov, 269 Main Street, <br/> London England',
	'col_3_content'=>'Phone+3598198689775 <br/> Cellphone+3598298689779',
	'col_4_content'=>'test@email.com' 
		
	);
   $instance = wp_parse_args( (array) $instance, $defaults ); ?>
  <p>
    <label for="<?php echo $this->get_field_id('title'); ?>">Title:</label> <br/>
    <input type="text" name="<?php echo $this->get_field_name('title') ?>" id="<?php echo $this->get_field_id('title') ?> " value="<?php echo $instance['title'] ?>" size="35">
  </p>

   <p>
    <label for="<?php echo $this->get_field_id('col_1_heading'); ?>">Column 1 Heading:</label>
    <input type="text" name="<?php echo $this->get_field_name('col_1_heading') ?>" id="<?php echo $this->get_field_id('col_1_heading') ?> " value="<?php echo $instance['col_1_heading'] ?>" size="35">
  </p>
  
  <p>
    <label for="<?php echo $this->get_field_id('col_1_content'); ?>">Column 1 Content:</label>
   <textarea class="widefat" rows="5" name="<?php echo $this->get_field_name('col_1_content') ?>" id="<?php echo $this->get_field_id('col_1_content') ?> "><?php echo $instance['col_1_content'] ?></textarea>
  </p>
  
  <p>
    <label for="<?php echo $this->get_field_id('col_2_heading'); ?>">Column 2 Heading:</label>
    <input type="text" name="<?php echo $this->get_field_name('col_2_heading') ?>" id="<?php echo $this->get_field_id('col_2_heading') ?> " value="<?php echo $instance['col_2_heading'] ?>" size="35">
  </p>
  
  <p>
    <label for="<?php echo $this->get_field_id('col_2_content'); ?>">Column 2 Content:</label>
    <textarea class="widefat" rows="5" name="<?php echo $this->get_field_name('col_2_content') ?>" id="<?php echo $this->get_field_id('col_2_content') ?> "><?php echo $instance['col_2_content'] ?></textarea> </p>
  
  <p>
    <label for="<?php echo $this->get_field_id('col_3_heading'); ?>">Column 3 Heading:</label>
    <input type="text" name="<?php echo $this->get_field_name('col_3_heading') ?>" id="<?php echo $this->get_field_id('col_3_heading') ?> " value="<?php echo $instance['col_3_heading'] ?>" size="35">
  </p>
  
  <p>
    <label for="<?php echo $this->get_field_id('col_3_content'); ?>">Column 3 Content:</label>
   <textarea class="widefat" rows="5" name="<?php echo $this->get_field_name('col_3_content') ?>" id="<?php echo $this->get_field_id('col_3_content') ?> "><?php echo $instance['col_3_content'] ?></textarea>  </p>
  
  
  <p>
    <label for="<?php echo $this->get_field_id('col_4_heading'); ?>">Column 4 Heading:</label>
    <input type="text" name="<?php echo $this->get_field_name('col_4_heading') ?>" id="<?php echo $this->get_field_id('col_4_heading') ?> " value="<?php echo $instance['col_4_heading'] ?>" size="35">
  </p>
  
  <p>
    <label for="<?php echo $this->get_field_id('col_4_content'); ?>">Column 4 Content:</label>
    <textarea class="widefat" rows="5" name="<?php echo $this->get_field_name('col_4_content') ?>" id="<?php echo $this->get_field_id('col_4_content') ?> "><?php echo $instance['col_4_content'] ?></textarea> </p>
   
 
  <?php
}

	function update ($new_instance, $old_instance) {
	  $instance = $old_instance;

	  $instance['col_1_heading'] = $new_instance['col_1_heading'];
	  $instance['col_1_content'] = $new_instance['col_1_content'];
	  
	  $instance['col_2_heading'] = $new_instance['col_2_heading'];
	  $instance['col_2_content'] = $new_instance['col_2_content'];
	  
	  $instance['col_3_heading'] = $new_instance['col_3_heading'];
	  $instance['col_3_content'] = $new_instance['col_3_content'];
	  
	  $instance['col_4_heading'] = $new_instance['col_4_heading'];
	  $instance['col_4_content'] = $new_instance['col_4_content'];
	  
	  $instance['title'] = $new_instance['title'];
	  
	  return $instance;
	}

	function widget ($args,$instance) {
	   extract($args);

	  $title = $instance['title'];
	  
	  $col_1_heading = $instance['col_1_heading']; 
	  $col_1_content = $instance['col_1_content']; 
	  
	  $col_2_heading = $instance['col_2_heading']; 
	  $col_2_content = $instance['col_2_content']; 
	  
	  $col_3_heading = $instance['col_3_heading']; 
	  $col_3_content = $instance['col_3_content']; 
	  
	  $col_4_heading = $instance['col_4_heading']; 
	  $col_4_content = $instance['col_4_content']; 
	 
	 
	  
	  //print the widget for the sidebar
	  echo $before_widget;
	 echo stripslashes($args['before_widget']);
    	/*echo stripslashes($args['before_title']);*/
		echo '<h2>'.$title.' <span class="sub-heading">Stay Connected</span></h2>';
		/*echo stripslashes($widgettitle);*/
    	/*echo stripslashes($args['after_title']);*/
    	echo '<div class="contact_info_widget">';
		echo '<figure class="four columns mt0"><h3 class="cp-title">'.$col_1_heading.'</h3><p>';
		echo stripslashes(nl2br($col_1_content));
		echo '</p></figure>';
		echo '<figure class="four columns mt0"><h3 class="cp-title">'.$col_2_heading.'</h3><p>';
		echo stripslashes(nl2br($col_2_content));
		echo '</p></figure>';
		echo '<figure class="four columns mt0"><h3 class="cp-title">'.$col_3_heading.'</h3><p>';
		echo stripslashes(nl2br($col_3_content));
		echo '</p></figure>';
		echo '<figure class="four columns mt0"><h3 class="cp-title">'.$col_4_heading.'</h3><p>';
		echo stripslashes(nl2br($col_4_content));
		echo '</p></figure>';
		
    	
    	
		echo '</div>';
    	echo '</div>';//close div.textwidget
      echo stripslashes($args['after_widget']);
	 }
	}

	function hmk_contact_info_widget() {
	  register_widget('contact_info_widget');
	}

	add_action('widgets_init', 'hmk_contact_info_widget');