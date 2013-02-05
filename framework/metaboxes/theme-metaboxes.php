<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 * @category Betterwork
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
 */

add_filter( 'cmb_meta_boxes', 'cmb_sample_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
 
function cmb_sample_metaboxes( array $meta_boxes ) {
	
	// Pull all the categories into an array
	$options_categories = array();  
	$options_categories_obj = get_categories('hide_empty=0');
	foreach ($options_categories_obj as $category) {
    	$options_categories[$category->cat_ID] = $category->cat_name;
	}
	//$options_categories_tmp = array_unshift($options_categories, "Select a category:");  
	
	// Start with an underscore to hide fields from custom fields list
	$prefix = '_cmb_';

	$meta_boxes[] = array(
		'id'         => 'slideshow_metabox',
		'title'      => 'Slideshow Option',
		'pages'      => array( 'slideshow', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name' => 'Link/URL',
				'desc' => __('Put the link/url of page. (optional)', 'betterwork'),
				'id'   => $prefix . 'url_slideshow',
				'type' => 'text',
			),
			/*array(
				'name' => 'Upload image',
				'desc' => __('Upload image slide. Good mage dimensions whould be 1024px X 355px', 'betterwork'),
				'id'   => $prefix . 'image_slideshow',
				'type' => 'file',
			),*/
		)
	);

	// Add other metaboxes as needed
	$meta_boxes[] = array(
		'id'         => 'donor_metabox',
		'title'      => 'Donor Option',
		'pages'      => array( 'donor', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name' => 'Link/URL',
				'desc' => __('Put the website link for donor. (optional)', 'betterwork'),
				'id'   => $prefix . 'link_donor',
				'type' => 'text',
			),
			/*array(
				'name' => 'Upload image',
				'desc' => __('Upload image/logo of donor. Good mage dimensions whould be 400px X 190px', 'betterwork'),
				'id'   => $prefix . 'image_donor',
				'type' => 'file',
			),*/
		)
	);
	
	// Add metaboxes for Landing category template
	$meta_boxes[] = array(
		'id'         => 'cat_landing_metabox',
		'title'      => 'Landing category template Option',
		'pages'      => array( 'page', ), // Post type
		'show_on' => array( 'key' => 'page-template', 'value' => 'page-landing-category.php' ),
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name' => 'Category slideshow',
				'desc' => __('Select category to show as slideshow. e.g: Programme updated ...', 'betterwork'),
				'id'   => $prefix . 'cat_landingpage',
				'type' => 'taxonomy_select',
				'taxonomy' => 'category', 
			),
			array(
				'name' => 'Category Tab 1',
				'desc' => __('Check category to show in tabs.', 'betterwork'),
				'id'   => $prefix . 'cat_tab1',
				'type' => 'select_cat',
				'options' => $options_categories, 
			),
			array(
				'name' => 'Category Tab 2',
				'desc' => __('Check category to show in tabs.', 'betterwork'),
				'id'   => $prefix . 'cat_tab2',
				'type' => 'select_cat',
				'options' => $options_categories, 
			),
			array(
				'name' => 'Category Tab 3',
				'desc' => __('Check category to show in tabs.', 'betterwork'),
				'id'   => $prefix . 'cat_tab3',
				'type' => 'select_cat',
				'options' => $options_categories, 
			)
		)
	);

	return $meta_boxes;
}
add_action( 'init', 'cmb_initialize_cmb_meta_boxes', 9999 );
/**
 * Initialize the metabox class.
 */
function cmb_initialize_cmb_meta_boxes() {

	if ( ! class_exists( 'cmb_Meta_Box' ) )
		require_once 'init.php';

}