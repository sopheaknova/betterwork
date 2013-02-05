<?php

/* Register Custom Post Type for Slideshow */
add_action('init', 'slideshow_post_type_init');

function slideshow_post_type_init() {
  $labels = array(
    'name' => __('Slideshow', 'post type general name','betterwork'),
    'singular_name' => __('slideshow', 'post type singular name','betterwork'),
    'add_new' => __('Add New', 'slideshow','betterwork'),
    'add_new_item' => __('Add New slideshow','betterwork'),
    'edit_item' => __('Edit slideshow','betterwork'),
    'new_item' => __('New slideshow','betterwork'),
    'view_item' => __('View slideshow','betterwork'),
    'search_items' => __('Search slideshow','betterwork'),
    'not_found' =>  __('No slideshow found','betterwork'),
    'not_found_in_trash' => __('No slideshow found in Trash','betterwork'), 
    'parent_item_colon' => ''
  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'rewrite' => true,
    'query_var' => true,
    'capability_type' => 'post',
    'hierarchical' => false,
    'show_in_nav_menus' => false,
    'menu_position' => 111,
	'menu_icon' => get_template_directory_uri() . '/images/slideshow.png',
    'rewrite' => array(
      'slug' => 'slideshow_item',
      'with_front' => FALSE,
    ),
    'supports' => array(
      'title',
	  'thumbnail'
    )
  );
  register_post_type('slideshow',$args);
}

/* Register Custom Post Type for Donor */
add_action('init', 'donor_post_type_init');

function donor_post_type_init() {
  $labels = array(
    'name' => __('Donor', 'post type general name','betterwork'),
    'singular_name' => __('donor', 'post type singular name','betterwork'),
    'add_new' => __('Add New', 'donor','betterwork'),
    'add_new_item' => __('Add New donor','betterwork'),
    'edit_item' => __('Edit donor','betterwork'),
    'new_item' => __('New donor','betterwork'),
    'view_item' => __('View donor','betterwork'),
    'search_items' => __('Search donor','betterwork'),
    'not_found' =>  __('No donor found','betterwork'),
    'not_found_in_trash' => __('No donor found in Trash','betterwork'), 
    'parent_item_colon' => ''
  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'rewrite' => true,
    'query_var' => true,
    'capability_type' => 'post',
    'hierarchical' => false,
    'show_in_nav_menus' => false,
    'menu_position' => 112,
	'menu_icon' => get_template_directory_uri() . '/images/donor.png',
    'rewrite' => array(
      'slug' => 'donor_item',
      'with_front' => FALSE,
    ),
    'supports' => array(
      'title',
	  //'editor',
	  'thumbnail'
    )
  );
  register_post_type('donor',$args);
}

/* Register Column for Custom Post Type for Donor */
add_filter("manage_edit-donor_columns", "donor_edit_columns");
add_action("manage_posts_custom_column",  "donor_custom_columns");


function donor_edit_columns($columns){
		$columns = array(
			"cb" => "<input type=\"checkbox\" />",
			"title" => "Donor Name",
			"link" => "Website",
			"logo" => "Logo",
		);
		
		return $columns;
}

function donor_custom_columns($column){
		global $post;
		switch ($column)
		{
			case "link":
				$custom_link = get_post_custom('_cmb_link_donor');
				echo $custom_link["_cmb_link_donor"][0];
				break;
			/*case "logo":
				$custom = get_post_custom('_cmb_image_donor');
				echo '<img src="'. betterwork_process_image( $custom["_cmb_image_donor"][0], 100, 50, 1, 100 ) .'" />';
				break;*/
			case "logo":
				the_post_thumbnail(array(100,100));
				break;	
		}
}

/* Register Column for Custom Post Type for Slideshow */
add_filter("manage_edit-slideshow_columns", "slideshow_edit_columns");
add_action("manage_posts_custom_column",  "slideshow_custom_columns");


function slideshow_edit_columns($columns){
		$columns = array(
			"cb" => "<input type=\"checkbox\" />",
			"title" => "Title",
			"link" => "Link",
			"image" => "Image",
		);
		
		return $columns;
}

function slideshow_custom_columns($column){
		global $post;
		switch ($column)
		{
			case "link":
				$custom = get_post_custom('_cmb_url_slideshow');
				echo $custom["_cmb_url_slideshow"][0];
				break;
			/*case "image":
				$custom = get_post_custom('_cmb_image_slideshow');
				echo '<img src="'. betterwork_process_image( $custom["_cmb_image_slideshow"][0], 100, 50, 1, 100 ) .'" />';
				break;*/
			case "image":
				the_post_thumbnail(array(100,100));
				break;	
		}
}

?>