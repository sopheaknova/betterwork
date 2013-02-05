<?php
/**
 * Widget Name: Google Map Widget
 * Description: A widget that allows a Google Map to be added to a sidebar.
 * Version: 0.1
 *
 */

/**
 * Add function to widgets_init that'll load our widget.
 * @since 0.1
 */
add_action( 'widgets_init', 'google_map_load_widgets' );

/**
 * Register our widget.
 * 'Google_Map_Widget' is the widget class used below.
 *
 * @since 0.1
 */
function google_map_load_widgets() {
	register_widget( 'Google_Map_Widget' );
}

/**
 * Google Map Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update.  Nice!
 *
 * @since 0.1
 */
class Google_Map_Widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function Google_Map_Widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'widget_googlemap', 'description' => esc_html__('A Google Map widget.', 'betterwork') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'googlemap-widget' );

		/* Create the widget. */
		$this->WP_Widget( 'googlemap-widget', esc_html__('Betterwork: Google Map', 'betterwork'), $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$latitude = $instance['latitude'];
		$longitude = $instance['longitude'];
		$zoom = $instance['zoom'];
		$width = $instance['width'];
		$height = $instance['height'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;

		/* Display the widget title if one was input (before and after defined by themes). */
		?>
     	<div class="contact-map">
				<script type="text/javascript"
                    src="http://maps.google.com/maps/api/js?sensor=false">
                </script>
                <script type="text/javascript">					
                  jQuery(document).ready(function ($)
                    {
                        var myLatlng = new google.maps.LatLng(11.553228,104.927963  );
                        var myOptions = {							  
                          zoom: 16,
                          center: myLatlng,
                          mapTypeId: google.maps.MapTypeId.ROADMAP
                        }
                        var map = new google.maps.Map(document.getElementById("c-map"), myOptions);
                        
                        var marker = new google.maps.Marker({
                            position: myLatlng, 
                            map: map,
                            animation: google.maps.Animation.DROP,
                            title:"Betterwork"
                        });
						var infowindow = new google.maps.InfoWindow({
							content: "<strong><?php bloginfo( 'name' ); ?></strong> <br /> <small><?php echo of_get_option('address1'); ?></small>"
						});
						google.maps.event.addListener(marker, 'click', function() {
							infowindow.open(map, marker);
						});
                    });
                </script>
        <div id="c-map" style="width:280px; height:445px;"></div>
        </div><!--/Map-->   
<?php        
		/* After widget (defined by themes). */
		echo $after_widget;
	}

	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		/* Strip slashes (important for text inputs). */
		$instance['latitude'] = $new_instance['latitude'];
		$instance['longitude'] = $new_instance['longitude'];
		$instance['zoom'] = $new_instance['zoom'];
		$instance['width'] = $new_instance['width'];
		$instance['height'] = $new_instance['height'];

		return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => esc_html__('Office location', 'betterwork'), 'latitude' => 11.553228, 'longitude' => 104.927963, 'zoom' => 15, 'width' => 280, 'height' => 445 );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		
		<p>
		    <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e('Title:', 'betterwork'); ?></label>
		    <input id="<?php echo $this->get_field_id( 'title' ); ?>" type="text" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>
		
        <p>
		    <label for="<?php echo $this->get_field_id( 'latitude' ); ?>"><?php esc_html_e('Latitude:', 'betterwork'); ?></label>
		    <input id="<?php echo $this->get_field_id( 'latitude' ); ?>" type="text" name="<?php echo $this->get_field_name( 'latitude' ); ?>" value="<?php echo $instance['latitude']; ?>" style="width:100%;" />
            <small>Get it from <a href="http://itouchmap.com/latlong.html" target="_blank">www.itouchmap.com/latlong.html</a></small>
		</p>
        
        <p>
		    <label for="<?php echo $this->get_field_id( 'longitude' ); ?>"><?php esc_html_e('Longitude:', 'betterwork'); ?></label>
		    <input id="<?php echo $this->get_field_id( 'longitude' ); ?>" type="text" name="<?php echo $this->get_field_name( 'longitude' ); ?>" value="<?php echo $instance['longitude']; ?>" style="width:100%;" />
            <small>Get it from <a href="http://itouchmap.com/latlong.html" target="_blank">www.itouchmap.com/latlong.html</a></small>
		</p>
        
        <p>
		    <label for="<?php echo $this->get_field_id( 'zoom' ); ?>"><?php esc_html_e('Zoom Level:', 'betterwork'); ?></label>
		    <input id="<?php echo $this->get_field_id( 'zoom' ); ?>" type="text" name="<?php echo $this->get_field_name( 'zoom' ); ?>" value="<?php echo $instance['zoom']; ?>" style="width:100%;" />
		</p>
        
        <p>
		    <label for="<?php echo $this->get_field_id( 'width' ); ?>"><?php esc_html_e('Width of map:', 'betterwork'); ?></label>
		    <input id="<?php echo $this->get_field_id( 'width' ); ?>" type="text" name="<?php echo $this->get_field_name( 'width' ); ?>" value="<?php echo $instance['width']; ?>" style="width:100%;" />
		</p>
        
        <p>
		    <label for="<?php echo $this->get_field_id( 'height' ); ?>"><?php esc_html_e('Height of map:', 'betterwork'); ?></label>
		    <input id="<?php echo $this->get_field_id( 'height' ); ?>" type="text" name="<?php echo $this->get_field_name( 'height' ); ?>" value="<?php echo $instance['height']; ?>" style="width:100%;" />
		</p>

<?php
	}
}

