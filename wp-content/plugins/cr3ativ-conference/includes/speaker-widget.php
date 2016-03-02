<?php 

class cr3ativ_speaker extends WP_Widget {

	// constructor
	function cr3ativ_speaker() {
        parent::__construct(false, $name = __('Speaker Loop', 'cr3at_conf') );
    }

	// widget form creation
	function form($instance) { 
// Check values
 if( $instance) { 
     $title = esc_attr($instance['title']); 
     $speakertitle = esc_attr($instance['speakertitle']);
     $speakerheadshot = esc_attr($instance['speakerheadshot']);
     $speakercompany = esc_attr($instance['speakercompany']);
     $speakercompanyurl = esc_attr($instance['speakercompanyurl']);
     $itemstodisplay = esc_attr($instance['itemstodisplay']); 
     $orderby = esc_attr($instance['orderby']); 
} else { 
     $title = ''; 
     $speakertitle = '';
     $speakerheadshot = '';
     $speakercompany = '';
     $speakercompanyurl = '';
     $itemstodisplay = ''; 
     $orderby = '';
} 
?>
<p>
<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'cr3at_conf'); ?></label>
<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" style="float:right; width:56%;" />
</p>
<p>
<label for="<?php echo $this->get_field_id('orderby'); ?>"><?php _e('Sorting Method', 'cr3at_conf'); ?></label>
<select id="<?php echo $this->get_field_id('orderby'); ?>" name="<?php echo $this->get_field_name('orderby'); ?>"  style="float:right; width:56%;">
    <option selected="selected" value="none"><?php _e( 'Select One', 'cr3at_conf' ); ?></option>
    <option <?php if ( $orderby == '1' ) { echo ' selected="selected"'; } ?> value="1"><?php _e('ASC', 'cr3at_conf'); ?></option>
    <option <?php if ( $orderby == '2' ) { echo ' selected="selected"'; } ?> value="2"><?php _e('DESC', 'cr3at_conf'); ?></option>
</select>
</p>
<p>
<label for="<?php echo $this->get_field_id('speakerheadshot'); ?>"><?php _e('Show speaker headshot?', 'cr3at_conf'); ?></label>
<input id="<?php echo $this->get_field_id('speakerheadshot'); ?>" name="<?php echo $this->get_field_name('speakerheadshot'); ?>" type="checkbox" value="1" <?php checked( '1', $speakerheadshot ); ?> style="float:right; margin-right:6px;" />
</p>
<p>
<label for="<?php echo $this->get_field_id('speakertitle'); ?>"><?php _e('Show speaker title?', 'cr3at_conf'); ?></label>
<input id="<?php echo $this->get_field_id('speakertitle'); ?>" name="<?php echo $this->get_field_name('speakertitle'); ?>" type="checkbox" value="1" <?php checked( '1', $speakertitle ); ?> style="float:right; margin-right:6px;" />
</p>
<p>
<label for="<?php echo $this->get_field_id('speakercompany'); ?>"><?php _e('Show speaker company name?', 'cr3at_conf'); ?></label>
<input id="<?php echo $this->get_field_id('speakercompany'); ?>" name="<?php echo $this->get_field_name('speakercompany'); ?>" type="checkbox" value="1" <?php checked( '1', $speakercompany ); ?> style="float:right; margin-right:6px;" />
</p>
<p>
<label for="<?php echo $this->get_field_id('speakercompanyurl'); ?>"><?php _e('Link company name to company url?', 'cr3at_conf'); ?></label>
<input id="<?php echo $this->get_field_id('speakercompanyurl'); ?>" name="<?php echo $this->get_field_name('speakercompanyurl'); ?>" type="checkbox" value="1" <?php checked( '1', $speakercompanyurl ); ?> style="float:right; margin-right:6px;" />
</p>
<p>
<label for="<?php echo $this->get_field_id('itemstodisplay'); ?>"><?php _e('How many to show?', 'cr3at_conf'); ?></label>
<input id="<?php echo $this->get_field_id('itemstodisplay'); ?>" name="<?php echo $this->get_field_name('itemstodisplay'); ?>" type="text" value="<?php echo $itemstodisplay; ?>" style="float:right; width:56%;" />
</p>


<?php }
	// widget update
	function update($new_instance, $old_instance) {
      $instance = $old_instance;
      // Fields
      $instance['title'] = strip_tags($new_instance['title']);
      $instance['speakertitle'] = strip_tags($new_instance['speakertitle']);
      $instance['orderby'] = strip_tags($new_instance['orderby']);
      $instance['speakerheadshot'] = strip_tags($new_instance['speakerheadshot']);
      $instance['speakercompany'] = strip_tags($new_instance['speakercompany']);
      $instance['speakercompanyurl'] = strip_tags($new_instance['speakercompanyurl']);
      $instance['itemstodisplay'] = $new_instance['itemstodisplay'];
     return $instance;
}

	// widget display
	function widget($args, $instance) {
   extract( $args );
   // these are the widget options
   $title = apply_filters('widget_title', $instance['title']);
   $speakerheadshot = $instance['speakerheadshot'];
   $itemstodisplay = $instance['itemstodisplay'];    
   $speakercompany = $instance['speakercompany'];
   $speakertitle = $instance['speakertitle'];
   $speakercompanyurl = $instance['speakercompanyurl'];
   $orderby = $instance['orderby'];
   echo $before_widget;
   if( $orderby == '1' ) {
   $orderby = 'ASC';
   } else {
   $orderby = 'DESC';
   }
      
global $post;

		$args = array(
		'post_type' => 'cr3ativspeaker',
        'order' => $orderby,
        'posts_per_page' => $itemstodisplay
		);
   
    query_posts($args);  
   
   // Check if title is set
   if ( $title ) {
      echo $before_title . $title . $after_title;
   }	
   
   // Display the widget
?> 
<div class="speakerwidgetwrapper">
		<?php 
   		if (have_posts($args)) : while (have_posts()) : the_post(); 

        $speakertitletext = get_post_meta($post->ID, 'speakertitle', $single = true); 
        $speakerurltext = get_post_meta($post->ID, 'speakerurltext', $single = true);  
        $speakerurl = get_post_meta($post->ID, 'speakerurl', $single = true);
        
        ?>
    

     <div class="speakerwidget">
     <?php 
        
     if( $speakerheadshot == '1' ) { ?>
         
         <a href="<?php the_permalink (); ?>" target="_self"><?php the_post_thumbnail( 'full'); ?></a>
     <?php } ?>
         
     <h2 class="speakercompanyname"><a href="<?php the_permalink (); ?>" target="_self"><?php the_title (); ?></a></h2>
         
     <?php if( $speakertitle == '1' ) { ?>
         
         <?php if ($speakertitletext != ('')){ ?>
         
            <?php echo ($speakertitletext); ?>
         
         <?php } ?>
         
     <?php } ?>

     <?php if( $speakercompany == '1' ) { 
         
         if( $speakercompanyurl == '1' ) { ?>
         
         <?php if ($speakerurl != ('')){ ?>
         
            <h3 class="speakercompanyname"><a href="<?php echo ($speakerurl); ?>" target="_blank"><?php echo ($speakerurltext); ?></a></h3>
         
         <?php } else { ?>
         
            <h3 class="speakercompanyname"><?php echo ($speakerurltext); ?></h3>
         <?php } ?>
         
     <?php } else { ?>
         
             <h3 class="speakercompanyname"><?php echo ($speakerurltext); ?></h3>
     <?php } 
         
     } ?>

        </div>
       
        <?php endwhile; ?>

        <?php else: ?> 
        <p><?php _e( 'There are no posts to display. Try using the search.', 'cr3at_conf' ); ?></p> 

        <?php endif; wp_reset_query(); ?>
    
</div>
  
<?php     
   
   echo $after_widget;
}
}

// register widget
add_action('widgets_init', create_function('', 'return register_widget("cr3ativ_speaker");'));

?>