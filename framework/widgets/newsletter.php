<?php 

add_action('widgets_init','o2_newsletter');

function o2_newsletter() {
	register_widget('o2_newsletter');
	}

class o2_newsletter extends WP_Widget {
	function o2_newsletter() {
			
		$widget_ops = array('classname' => 'newsletter','description' => __('Widget display the Subscribe box','betterwork'));
			
		/* Widget control settings. */
		$control_ops = array( 'width' => 150, 'height' => 150, 'id_base' => 'newsletter' );
		
		$this->WP_Widget('newsletter',__('Betterwork: - Newsletter','betterwork'),$widget_ops);

		}
		
	function widget( $args, $instance ) {
		extract( $args );
		
		/* User-selected settings. */
		$title = apply_filters('widget_title', $instance['title']);
		$feed_url = $instance['feed_url'];
		
		/* Before widget (defined by themes). */
		echo $before_widget;
		
		/* Title of widget (before and after define by theme). */
		if ( $title )
			echo $before_title . $title . $after_title;
?>

		<div>
			<img class="rs_icon" src="<?php echo O2_IMG; ?>/rss_icon.png" alt="rss">
                     <form action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=<?php echo $feed_url; ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
		     <input type="text" class="nsf" name="email" name="uri" value="<?php _e('Your Email', 'betterwork'); ?>" onfocus="if(this.value=='<?php _e('Your Email', 'betterwork'); ?>')this.value='';" onblur="if(this.value=='')this.value='<?php _e('Your Email', 'betterwork'); ?>';"/>
		     <input type="hidden" name="loc" value="en_US"/>
			<input type="hidden" value="<?php echo $feed_url; ?>" name="uri"/>
		     <input type="submit"  class="nsb" value="<?php _e('Subscribe','betterwork');?>" />
                     </form>
		</div>

<?php 
		/* After widget (defined by themes). */
		echo $after_widget;
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags (if needed) and update the widget settings. */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['feed_url'] = strip_tags($new_instance['feed_url']);

		return $instance;
	}
	
function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 
			'title' => __('Subscribe to our newsletter', 'betterwork'),
			'feed_url' => 'nova'
 			);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
	
    	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('title:', 'betterwork'); ?></label>
		<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>"  class="widefat" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'feed_url' ); ?>"><?php _e('feedburner name: (your name without http://feeds.feedburner.com/) ', 'betterwork'); ?></label>
		<input id="<?php echo $this->get_field_id( 'feed_url' ); ?>" name="<?php echo $this->get_field_name( 'feed_url' ); ?>" value="<?php echo $instance['feed_url']; ?>" class="widefat" />
		</p>


   <?php 
}
	} //end class