<?php

 
class CP_Widget_Social extends WP_Widget {

	function CP_Widget_Social() {
		$widget_ops = array('classname' => 'widget_social', 'description' => __('Display your social profiles','crunchpress'));
		$control_ops = array('width' => 300, 'height' => 350);
		$this->WP_Widget('social', __(THEME_NAME_F. ' - Social Profiles'), $widget_ops, $control_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
		$title = $instance['title'];
		$address = $instance['address'];
		$facebook_id = $instance['facebook_id'];
		$flicker_id = $instance['flicker_id'];
		$skype_id = $instance['skype_id'];
		$twitter_id = $instance['twitter_id'];
		$linkdin_id = $instance['linkdin_id'];
		echo $before_title . $title . $after_title;
	?>
		
		<!--begin of social widget-->
        <?php echo $address; ?>
        <ul class="social-icons">
            <li class="fb"><a href="<?php echo $facebook_id; ?>" rel="nofollow" target="_blank"><?php _e('Facebook', 'cruncpress'); ?></a></li>
            <li class="flicker"><a href="<?php echo $flicker_id; ?>" rel="nofollow" target="_blank"><?php _e('Flicker', 'cruncpress'); ?></a></li>
            <li class="skype"><a href="<?php echo $skype_id; ?>" rel="nofollow" target="_blank"><?php _e('Skype', 'cruncpress'); ?></a></li>
            <li class="twitter"><a href="<?php echo $twitter_id; ?>" rel="nofollow" target="_blank"><?php _e('Twitter', 'cruncpress'); ?></a></li>
             <li class="linkdin"><a href="<?php echo $linkdin_id; ?>" rel="nofollow" target="_blank"><?php _e('Linkdin', 'cruncpress'); ?></a></li>
        </ul>
		<!--end of social widget-->
	<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] =  $new_instance['title'];
		$instance['address'] =  $new_instance['address'];
		$instance['facebook_id'] =  $new_instance['facebook_id'];
		$instance['flicker_id'] = $new_instance['flicker_id'];
		$instance['skype_id'] = $new_instance['skype_id'];
		$instance['twitter_id'] =  $new_instance['twitter_id'];
		$instance['linkdin_id'] =  $new_instance['linkdin_id'];

		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 
		'title' => 'Location',
		'address' => '123, street name landmark,
						California 123
						Tel: 123-456-7890
						Fax. +123-456-7890',
		'facebook_id' => '',
		'flicker_id' => '',
		'skype_id' => '',
		'twitter_id' => '',
		'linkdin_id' => ''
		 ) );
		
		$title = $instance['title'];
		$address = $instance['address'];
		$facebook_id = format_to_edit($instance['facebook_id']);
		$flicker_id = $instance['flicker_id'];
		$skype_id = $instance['skype_id'];
		$linkdin_id = $instance['linkdin_id'];
		$twitter_id = format_to_edit($instance['twitter_id']);		
	?>
    
        <p>
        	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','crunchpress'); ?>
			<input class="widefat" 
            	id="<?php echo $this->get_field_id('title'); ?>" 
                name="<?php echo $this->get_field_name('title'); ?>" 
                type="text" value="<?php echo $title; ?>" />
            </label>
        </p>
       
         <p>
    <label for="<?php echo $this->get_field_id('address'); ?>">Address</label>
    <textarea class="widefat" rows="5" name="<?php echo $this->get_field_name('address') ?>" id="<?php echo $this->get_field_id('address') ?> "><?php echo $instance['address'] ?></textarea> </p>
        
		<p>
        	<label for="<?php echo $this->get_field_id('facebook_id'); ?>"><?php _e('Enter your Facebook ID:','crunchpress'); ?>
			<input class="widefat" 
            	id="<?php echo $this->get_field_id('facebook_id'); ?>" 
                name="<?php echo $this->get_field_name('facebook_id'); ?>" 
                type="text" value="<?php echo $facebook_id; ?>" />
            </label>
        </p>
			
		<p>
        	<label for="<?php echo $this->get_field_id('flicker_id'); ?>"><?php _e('Enter your RSS ID:','crunchpress'); ?>
			<input class="widefat" 
            	id="<?php echo $this->get_field_id('flicker_id'); ?>" 
                name="<?php echo $this->get_field_name('flicker_id'); ?>" 
                type="text" value="<?php echo $flicker_id; ?>" />
            </label>
        </p>
		
		<p>
        	<label for="<?php echo $this->get_field_id('skype_id'); ?>"><?php _e('Enter your Skype ID:','crunchpress'); ?>
			<input class="widefat" 
            	id="<?php echo $this->get_field_id('skype_id'); ?>" 
                name="<?php echo $this->get_field_name('skype_id'); ?>" 
                type="text" value="<?php echo $skype_id; ?>" /> 
            </label>
        </p>
		
		<p>
        	<label for="<?php echo $this->get_field_id('twitter_id'); ?>"><?php _e('Enter your Twitter ID:','crunchpress'); ?>
			<input class="widefat" 
                id="<?php echo $this->get_field_id('twitter_id'); ?>" 
                name="<?php echo $this->get_field_name('twitter_id'); ?>" 
                type="text" value="<?php echo $twitter_id; ?>" />
            </label>
        </p>
        <p>
        	<label for="<?php echo $this->get_field_id('linkdin_id'); ?>"><?php _e('Enter your Linkedin ID:','crunchpress'); ?>
			<input class="widefat" 
                id="<?php echo $this->get_field_id('linkdin_id'); ?>" 
                name="<?php echo $this->get_field_name('linkdin_id'); ?>" 
                type="text" value="<?php echo $linkdin_id; ?>" />
            </label>
        </p>
		<?php }
}

register_widget('CP_Widget_Social');