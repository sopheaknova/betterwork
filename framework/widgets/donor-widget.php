<?php
/**
 * Widget Name: Donor Widget
 * Description: A widget that allows to show donors as carousel to be added to a sidebar.
 * Version: 1.0
 *
 */

/**
 * Add function to widgets_init that'll load our widget.
 * @since 0.1
 */
add_action('widgets_init', 'donor_widgets');

/**
 * Register our widget.
 * 'Donor_Widgets' is the widget class used below.
 *
 * @since 0.1
 */
function donor_widgets() {
	register_widget('Donor_Widgets');
	}

/**
 * Donor Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update.  Nice!
 *
 * @since 1.0
 */	
class Donor_Widgets extends WP_Widget {
	
	/**
	 * Widget setup.
	 */
	function Donor_Widgets() {
	
		/* Widget settings. */
		$widget_ops = array('classname' => 'donor-widget', 'description' => esc_html__('A widget that allows to show donors as carousel to be added to a sidebar', 'betterwork'));
		
		/* Create the widget. */
		$this->WP_Widget('donor-widget', esc_html__('Betterwork: Donor', 'betterwork'), $widget_ops );
		
		}
		
	function widget( $args, $instance) {
		global $post;
		extract ($args);
		
		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title']);
		$donor_num = absint($instance['donor_num']);
		$desc_txt = $instance['desc_txt'];
		$link_to = $instance['link_to'];
		
		/* Before widget (defined by themes). */
		echo $before_widget;
		
		/* Title of widget (before and after define by theme). */
		if ( $title )
			echo $before_title . $title . $after_title;
?>
		<div><?php echo $instance[ 'desc_txt' ]; ?></div>
        <div class="carousel-controller">
        <a href="#" id="carousel-prev">&laquo; Prev</a>
        <ul id="donor-carousel" class="jcarousel-skin-tango">
        <?php
		$donor = new WP_Query("post_type=donor&posts_per_page={$donor_num}");
        
        if ($donor->have_posts()) : while ($donor->have_posts()) : $donor->the_post();
        	
			update_post_cache($posts);
            $img_donor_link = get_post_meta($post->ID, '_cmb_link_donor', true);
            $img_donor_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "donor-thumb" );
        ?>
            <li>
            <?php if ($img_donor_link != '') : ?>
            <a href="<?php echo $img_donor_link; ?>" target="_blank">
            <img src="<?php echo betterwork_process_image( $img_donor_src[0], 215, 118, 1, 100 ); ?>" alt="<?php esc_attr( the_title() ); ?>" />
            </a>
            <?php else: ?>
            <img src="<?php echo betterwork_process_image( $img_donor_src[0], 215, 118, 1, 100 ); ?>" alt="<?php esc_attr( the_title() ); ?>" />
            <?php endif; ?>
            </li>
        <?php
            endwhile; 
        else: ?>
            <li><?php _e('<strong><em>There are no logo updated! &raquo; Go to admin backend -&gt; Add new Donor</em></strong>', 'betterwork'); ?></li> 
        <?php
        endif; 
        wp_reset_postdata();
        ?> 	    
          </ul>
        <a href="#" id="carousel-next">Next &raquo;</a>   
        <div class="clear"></div>
        </div>
        
		<span class="more-donors"><?php echo $instance[ 'link_to' ]; ?></span>
<?php 			
		/* After widget (defined by themes). */		
		echo $after_widget;
	}	
	
	/**
	 * Update the widget settings.
	 */	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		
		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['donor_num'] = ( $new_instance['donor_num'] ) ? absint(strip_tags( $new_instance['donor_num'] )) : 2;
		$instance['desc_txt'] = strip_tags($new_instance['desc_txt']);
		$instance['link_to'] = $new_instance['link_to'];
		
		return $instance;
	}
	
	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */	
	function form( $instance ) {
		/* Set up some default widget settings. */
		$defaults = array( 'title' => __('Donor', 'betterwork'), 'donor_num' => 2, 'desc_txt' => __('The Better Work global programme is funded by', 'betterwork'), 'link_to' => __('The For a complete list of donors, including country programme donors, please click <a href="#">here</a> ...', 'betterwork'));
		$instance = wp_parse_args( (array) $instance, $defaults); ?>
		
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'betterwork') ?></label>
		<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>"  class="widefat" />
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'donor_num' ); ?>"><?php esc_html_e('Number of donor\'s logo:', 'betterwork'); ?></label>
			<input id="<?php echo $this->get_field_id( 'donor_num' ); ?>" type="text" name="<?php echo $this->get_field_name( 'donor_num' ); ?>" value="<?php echo $instance['donor_num']; ?>" size="2" maxlength="2" />
		</p>
        
        <p><label for="<?php echo $this->get_field_id('desc_txt'); ?>"><?php _e('Description line 1:', 'desc_txt'); ?></label>
<textarea rows="5" class="widefat" id="<?php echo $this->get_field_id('donor_txt_1'); ?>" name="<?php echo $this->get_field_name('desc_txt'); ?>"><?php echo format_to_edit($instance['desc_txt']); ?></textarea></p>

		<p><label for="<?php echo $this->get_field_id('link_to'); ?>"><?php _e('Link to detail page text:', 'link_to'); ?></label>
<textarea rows="5" class="widefat" id="<?php echo $this->get_field_id('link_to'); ?>" name="<?php echo $this->get_field_name('link_to'); ?>"><?php echo format_to_edit($instance['link_to']); ?></textarea></p>

        
	   <?php
    }
} //end class