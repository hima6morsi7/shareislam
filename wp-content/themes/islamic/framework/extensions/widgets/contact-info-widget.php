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
       'id_base' => 'cp_contact_info-widget');

    /* Create the widget. */
   $this->WP_Widget('contact_info-widget', 'Crunch Biz-Contact Info Widget', $widget_ops, $control_ops );
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
		echo $col_2_heading; 
		echo stripslashes(nl2br($col_2_content));
		echo '</p></figure>';
		echo '<figure class="four columns mt0"><h3 class="cp-title">'.$col_3_heading.'</h3><p>';
		echo $col_3_heading; 
		echo stripslashes(nl2br($col_3_content));
		echo '</p></figure>';
		echo '<figure class="four columns mt0"><h3 class="cp-title">'.$col_4_heading.'</h3><p>';
		echo $col_4_heading; 
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