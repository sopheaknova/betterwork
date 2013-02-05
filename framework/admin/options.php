<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 * 
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet (lowercase and without spaces)
	$themename = get_theme_data(STYLESHEETPATH . '/style.css');
	$themename = $themename['Name'];
	$themename = preg_replace("/\W/", "", strtolower($themename) );
	
	$optionsframework_settings = get_option('optionsframework');
	$optionsframework_settings['id'] = $themename;
	update_option('optionsframework', $optionsframework_settings);
	
	// echo $themename;
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the "id" fields, make sure to use all lowercase and no spaces.
 *  
 */

function optionsframework_options() {
	
	$yesno = array('no' => 'No', 'yes' =>'Yes' );
	$float = array('left' => 'left', 'right' =>'right');
	// Test data
	$test_array = array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five");
	// Multicheck Array
	$multicheck_array = array("one" => "French Toast", "two" => "Pancake", "three" => "Omelette", "four" => "Crepe", "five" => "Waffle");
	// Multicheck Defaults
	$multicheck_defaults = array("one" => "true","five" => "true");
	// Background Defaults
	$bodytypo = array('size' => '12px');
	$background = array('repeat' => 'repeat');
//H typo
$h1 = array('size' => '36px', 'face' =>'' );
$h2 = array('size' => '30px', 'face' =>'' );
$h3 = array('size' => '24px', 'face' =>'' );
$h4 = array('size' => '18px', 'face' =>'' );
$h5 = array('size' => '14px', 'face' =>'' );
$h6 = array('size' => '12px', 'face' =>'' );

//nivo slider
	$nivo_effects = array('random' => 'random', 'sliceDown' => 'sliceDown', 'sliceDownLeft' => 'sliceDownLeft', 'sliceUp' => 'sliceUp', 'sliceUpLeft' => 'sliceUpLeft','sliceUpDown' => 'sliceUpDown', 'sliceUpDownLeft' => 'sliceUpDownLeft', 'fold' => 'fold', 'fade' => 'fade', 'random' => 'random', 
	 'slideInRight' => 'slideInRight', 'slideInLeft' => 'slideInLeft', 'boxRandom' => 'boxRandom', 'boxRain' => 'boxRain', 
	 'boxRainReverse' => 'boxRainReverse', 'boxRainGrow' => 'boxRainGrow', 'boxRainGrowReverse' => 'boxRainGrowReverse', );

//cycle Slider
	$cycle_effects = array('blindX' => 'blindX', 'blindY' => 'blindY', 'blindZ' => 'blindZ', 'cover' => 'cover', 'curtainX' => 'curtainX','curtainY' => 'curtainY', 'fade' => 'fade', 'fadeZoom' => 'fadeZoom', 'growX' => 'growX', 'growY' => 'growY', 
	 'none' => 'none', 'scrollUp' => 'scrollUp', 'scrollDown' => 'scrollDown', 'scrollLeft' => 'scrollLeft', 
	 'scrollRight' => 'scrollRight', 'scrollHorz' => 'scrollHorz', 'scrollVert' => 'scrollVert',
	'shuffle' => 'shuffle', 'slideX' => 'slideX', 'slideY' => 'slideY', 'toss' => 'toss', 
	 'turnUp' => 'turnUp', 'turnDown' => 'turnDown', 'turnLeft' => 'turnLeft', 'turnRight' => 'turnRight', 'uncover' => 'uncover', 'wipe' => 'wipe', 'zoom' => 	'zoom');

//ReCAPTCHA Theme
	$recaptcha_themes = array('white' => 'white', 'red' => 'red', 'blackglass' => 'blackglass', 'clean' => 'clean');

	// Pull all the categories into an array
	$options_categories = array();  
	$options_categories_obj = get_categories('hide_empty=0');
	foreach ($options_categories_obj as $category) {
    	$options_categories[$category->cat_ID] = $category->cat_name;
	}
	//$options_categories_tmp = array_unshift($options_categories, "Select a category:"); 
	
	// Pull all the categories into an array
	$options_tags = array();  
	$options_tags_obj = get_tags();
	foreach ($options_tags_obj as $tag) {
    	$options_tags[$tag->tag_ID] = $tag->tag_name;
	}
		
	// Pull all the pages into an array
	$options_pages = array();  
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages['false'] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
    	$options_pages[$page->ID] = $page->post_title;
	}
		
	//apps category
	$res_categories = array();  
	$res_categories_obj = get_categories('taxonomy=residences_categories&hide_empty=0');
	foreach ($res_categories_obj as $rescategory) {
    	$res_categories[$rescategory->cat_ID] = $rescategory->cat_name;
	}

	// If using image radio buttons, define a directory path
	$imagepath =  get_stylesheet_directory_uri() . '/framework/admin/images/';
	$srcpath =  get_stylesheet_directory_uri() . '/framework/src/';
		
	$options = array();

// General Setting 
		$options[] = array( "name" => __('general Settings', 'betterwork'),
						"type" => "heading",
						"slug" => "general"
						);
	
	$options[] = array( "name" => __('the logo', 'betterwork'),
						"id" => "logo_img",
						"desc" => __('upload custom logo.', 'betterwork'),
						"type" => "upload",
						);


	$options[] = array( "name" => __('favicon', 'betterwork'),
						"desc" => __('upload your favicon. Use .ico file. Size 16px X 16px', 'betterwork'),
						"id" => "custom_favicon",
						"type" => "upload",
						);
	
	$options[] = array( "name" => __('Scroll to top button', 'betterwork'),
						"id" => "scroll_top_bt",
						"desc" => __('Enable or disable Scroll to top button', 'betterwork'),
						"std" => true,
						"type" => "checkbox",
						);

	$options[] = array( "name" => __('Scroll To Top Image', 'betterwork'),
						"id" => "scroll_top_bt_img",
						"desc" => __('upload custom Scroll to top image', 'betterwork'),
						"type" => "upload",
						);

	$options[] = array( "name" => __('Enable prettyPhoto_script', 'betterwork'),
						"id" => "enable_prettyphoto_script",
						"desc" => __('Enable or disable big photo when user click on thumbnail photo in each post/page.', 'betterwork'),
						"std" => true,
						"type" => "checkbox",
						);

	$options[] = array( "name" => __('Google analytics', 'betterwork'),
						"desc" => __('google analytics or any Script, it will be add before closing of body tag', 'betterwork'),
						"id" => "footer_script",
						"type" => "textarea"
						);
	
	$options[] = array( "name" => __('Feedburner', 'betterwork'),
				"id" => "feedburner",
				"type" => "text",
				);					

// End General

// Homepage	
	$options[] = array( "name" => __('Homepage setting', 'betterwork'),
						"type" => "heading",
						"slug" => "home"
						);
		
		$options[] = array( "name" => __('Latest updated tabs', 'betterwork'),
						"type" => "info",
						"desc" => __('Select any category to show in each tabs you prefer', 'betterwork')
						);
						
		$options[] = array( "name" => __('Title of latest updated', 'betterwork'),
						"id" => "latest_update_txt",
						"std" => __('Latest updated', 'betterwork'),
						"type" => "text"
						);
						
		$options[] = array( "name" => __('Description of latest updated', 'betterwork'),
						"id" => "latest_update_desc",
						"std" => __('The content for latest updated are coming soon.', 'betterwork'),
						"desc" => __('Use this text for present to user, when stories did not update', 'betterwork'),
						"type" => "text"
						);								
		
		$options[] = array( "name" => __('show/hide Tab 1', 'betterwork'),
						"id" => "show_tab1",
						"std" => true,
						"type" => "checkbox"
						);
										
		$options[] = array( "name" => __('Tab 1', 'betterwork'),
						"id" => "tab_1",
						"desc" => __('Select cagetory name <strong>Prgram updated</strong>.', 'betterwork'),
						"type" => "select",
						"options" => $options_categories
						);
		
		$options[] = array( "name" => __('show/hide Tab 2', 'betterwork'),
						"id" => "show_tab2",
						"std" => true,
						"type" => "checkbox"
						);
						
		$options[] = array( "name" => __('Tab 2', 'betterwork'),
						"id" => "tab_2",
						"desc" => __('Select cagetory name <strong>Press release</strong>.', 'betterwork'),
						"type" => "select",
						"options" => $options_categories
						);
		
		$options[] = array( "name" => __('show/hide Tab 3', 'betterwork'),
						"id" => "show_tab3",
						"std" => true,
						"type" => "checkbox"
						);
						
		$options[] = array( "name" => __('Tab 3', 'betterwork'),
						"id" => "tab_3",
						"desc" => __('Select cagetory name <strong>News clippings</strong>.', 'betterwork'),
						"type" => "select",
						"options" => $options_categories
						);
		
		$options[] = array( "name" => __('show/hide Tab 4', 'betterwork'),
						"id" => "show_tab4",
						"std" => true,
						"type" => "checkbox"
						);
										
		$options[] = array( "name" => __('Tab 4', 'betterwork'),
						"id" => "tab_4",
						"desc" => __('Select cagetory name <strong>Annoucement</strong>.', 'betterwork'),
						"type" => "select",
						"options" => $options_categories
						);
		
		$options[] = array( "name" => __('show/hide Tab 5', 'betterwork'),
						"id" => "show_tab5",
						"std" => true,
						"type" => "checkbox"
						);
						
		$options[] = array( "name" => __('Tab 5', 'betterwork'),
						"id" => "tab_5",
						"desc" => __('Select cagetory name <strong>Events</strong>.', 'betterwork'),
						"type" => "select",
						"options" => $options_categories
						);												
										
// End Homepage						

// Article Elements

		$options[] = array( "name" => __('Post settings', 'betterwork'),
						"type" => "heading",
						"slug" => "post"
						);

		$options[] = array( "name" => __('Article Elements', 'betterwork'),
						"type" => "info",
						"desc" => __('Show/Hide any article Element, in home/category/article', 'betterwork')
						);

		$options[] = array( "name" => __('show/hide the excerpt instead of the full post content', 'betterwork'),
						"id" => "show_excerpt",
						"std" => true,
						"desc" => __('show/hide the excerpt instead of the full post content in the archive page.', 'betterwork'),
						"type" => "checkbox"
						);
						
		$options[] = array( "name" => __('Learn more text', 'betterwork'),
						"id" => "learn_more",
						"std" => __('learn more', 'betterwork'),
						"type" => "text"
						);
						
		$options[] = array( "name" => __('See all text', 'betterwork'),
						"id" => "see_all_txt",
						"std" => __('See all', 'betterwork'),
						"type" => "text"
						);										
						
		$options[] = array( "name" => __('Change the excerpt length number', 'betterwork'),
						"id" => "excerpt_length_in_words",
						"std" => '47',
						"desc" => __('This number refers to the number of words to show.', 'betterwork'),
						"type" => "text"
						);
		
		$options[] = array( "name" => __('Read More Link', 'betterwork'),
						"id" => "readmore_link",
						"std" => __('Read more'),
						"desc" => __('Enter the text for the post\'s \'Read more\' link. Leave blank to hide it. ', 'betterwork'),
						"type" => "text"
						);
						
		$options[] = array( "name" => __('Show Author Name', 'betterwork'),
						"id" => "show_postmetadata_authors",
						"std" => true,
						"desc" => __('Show/hide the author\'s name. ', 'betterwork'),
						"type" => "checkbox"
						);	
						
		$options[] = array( "name" => __('Post Tags', 'betterwork'),
						"id" => "show_postmetadata_tags",
						"std" => false,
						"desc" => __('Show/hide Post Tags', 'betterwork'),
						"type" => "checkbox"
						);
		
		$options[] = array( "name" => __('Enable "Featured Image" in archive page', 'betterwork'),
						"id" => "show_thumbnail_in_archive",
						"std" => false,
						"desc" => __('Show/hide thumbnails image in archive page', 'betterwork'),
						"type" => "checkbox"
						);																			



// Article Elements


//Slideshow

$options[] = array( "name" => __('Slideshow', 'betterwork'),
						"type" => "heading",
						"slug" => "feature"
						);


	$options[] = array( "name" => __('Animation & Effects', 'betterwork'),
						"type" => "info",
						);

	$options[] = array( "name" => __('Effect', 'betterwork'),
						"desc" => __('name of transition effect', 'betterwork'),
						"id" => "cycle_effect",
						"std" => "fade",
						"type" => "select",
						"options" => $cycle_effects
						);

	$options[] = array( "name" => __('easing', 'betterwork'),
						"desc" => __('easing method for transitions <a href="http://ralphwhitbeck.com/demos/jqueryui/effects/easing/">more info</a>', 'betterwork'),
						"id" => "cycle_ease",
						"std" => "easeInOutBack",
						"type" => "text"
						);

	$options[] = array( "name" => __('Speed', 'betterwork'),
						"desc" => __('speed of the transition', 'betterwork'),
						"id" => "cycle_speed",
						"std" => "1000",
						"step" => "1",
						"min" => "200",
						"max" => "5000",
						"suffix" => "ms",
						"type" => "range",
						);

	$options[] = array( "name" => __('timeout', 'betterwork'),
						"desc" => __('milliseconds between slide transitions', 'betterwork'),
						"id" => "cycle_timeout",
						"std" => "5000",
						"step" => "1",
						"min" => "500",
						"max" => "20000",
						"suffix" => "ms",
						"type" => "range",
						);


// End Slideshow

//Contact Forms 
	$options[] = array( "name" => __('Contact Forms', 'betterwork'),
						"type" => "heading",
						"slug" => "contact"
						);
	/*$options[] = array( "name" => __('Place map location', 'betterwork'),
						"type" => "info",
						"desc" => __('Show google map in contact page by enter value of Lat & Long', 'betterwork')
						);
											
	$options[] = array( "name" => __('Latitude', 'betterwork'),
						"id" => "map_latitude",
						"std" => "11.552801",
						"desc" => __('Enter your latitude here, for quick search your latitude, please visit<a href="http://itouchmap.com/latlong.html" target="_blank">www.itouchmap.com/latlong.html</a>', 'betterwork'),
						"type" => "text",
						);
						
	$options[] = array( "name" => __('Longitude', 'betterwork'),
						"id" => "map_longitude",
						"std" => "104.928333",
						"desc" => __('Enter your longitude here, for quick search your longitude, please visit<a href="http://itouchmap.com/latlong.html" target="_blank">www.itouchmap.com/latlong.html</a>', 'betterwork'),
						"type" => "text",
						);*/					
	
	$options[] = array( "name" => __('Contact Fields', 'betterwork'),
						"type" => "info",
						"desc" => __('The Contact Fields provide a way to better display additional contact information such as Company Name, Address, Phone, etc', 'betterwork')
						);
	
	$options[] = array( "name" => __('Address', 'betterwork'),
						"id" => "address1",
						"std" => "4, route des Morillons <br />CH-1211 Geneva 22 <br />Switzerland",
						"desc" => __('Please add your address here.', 'betterwork'),
						"type" => "textarea",
						);					
	
	$options[] = array( "name" => __('Telephone Number', 'betterwork'),
						"id" => "tel_contact",
						"std" => "(123) 123-4567",
						"desc" => __('Please add your telephone number here.', 'betterwork'),
						"type" => "text",
						);
	
	$options[] = array( "name" => __('Fax Number', 'betterwork'),
						"id" => "fax_contact",
						"std" => "(123) 123-4567",
						"desc" => __('Please add your fax number here.', 'betterwork'),
						"type" => "text",
						);
						
	$options[] = array( "name" => __('Email Form', 'betterwork'),
						"type" => "info",
						"desc" => __('A way to show/hide form, and who will receive email', 'betterwork')
						);
						
	$options[] = array( "name" => __('Enable email form', 'betterwork'),
						"id" => "is_form_email_contact",
						"std" => true,
						"type" => "checkbox"
						);					
						
	$options[] = array( "name" => __('Recipient Email', 'betterwork'),
						"id" => "email_receipients",
						"std" => "betterwork@ilo.org",
						"desc" => __('Please enter recipient\'s email address, comma-separate multiple recipients', 'betterwork'),
						"type" => "text"
						);
						
	$options[] = array( "name" => __('Enable ReCAPTCHA', 'betterwork'),
						"id" => "recaptcha_enabled",
						"std" => false,
						"desc" => __('Add ReCAPTCHA to the email form for extra security (for more information visit <a href="www.recaptcha.net" target="_blank">www.recaptcha.net</a>)', 'betterwork'),
						"type" => "checkbox"
						);
	
	$options[] = array( "name" => __('ReCAPTCHA Public Key', 'betterwork'),
						"id" => "recaptcha_publickey",
						"desc" => __('To use reCAPTCHA you must get an API public key from <a href="www.recaptcha.net" target="_blank">www.recaptcha.net</a>', 'betterwork'),
						"type" => "text"
						);
						
	$options[] = array( "name" => __('ReCAPTCHA Private Key', 'betterwork'),
						"id" => "recaptcha_privatekey",
						"desc" => __('To use reCAPTCHA you must get an API private key from <a href="www.recaptcha.net" target="_blank">www.recaptcha.net</a>', 'betterwork'),
						"type" => "text"
						);	
	
	$options[] = array( "name" => __('ReCAPTCHA Theme', 'betterwork'),
						"id" => "recaptcha_theme",
						"desc" => __('Choose Theme: White, Red, Blackglass and Clean, use to protect auto mail sender', 'betterwork'),
						"std" => "white",
						"type" => "select",
						"options" => $recaptcha_themes
						);																																								
						

// End Contact Forms

//footer
	$options[] = array( "name" => __('Footer', 'betterwork'),
					"type" => "heading",
					"slug" => "footer",
					);
			
	
	$options[] = array( "name" => __('copyrights', 'betterwork'),
				"desc" => __('footer copyrights text', 'betterwork'),
				"id" => "copyrights",
				"std" => __('© 2012 Betterwork. All rights reserved.', 'betterwork'),
				"type" => "text",
				);
				
	$options[] = array( "name" => __('Custom logo 1', 'betterwork'),
				"desc" => __('footer custom logo, (optional): if you do not upload new logo image, it use ILO logo', 'betterwork'),
				"id" => "footer_custom_logo1",
				"type" => "upload",
				);
	
	$options[] = array( "name" => __('Link for Custom logo 1', 'betterwork'),
				"desc" => __('footer link for custom logo 1', 'betterwork'),
				"id" => "footer_url_custom_logo1",
				"std" => 'http://www.ilo.org',
				"type" => "text",
				);			
	
	$options[] = array( "name" => __('Custom logo 2', 'betterwork'),
				"desc" => __('footer custom logo, (optional): if you do not upload new logo image, it use IFC logo', 'betterwork'),
				"id" => "footer_custom_logo2",
				"type" => "upload",
				);
	
	$options[] = array( "name" => __('Link for Custom logo 2', 'betterwork'),
				"desc" => __('footer link for custom logo 2', 'betterwork'),
				"id" => "footer_url_custom_logo2",
				"std" => 'http://www.ifc.org',
				"type" => "text",
				);			
				
	
		$options[] = array( "name" => __('Social Networks', 'betterwork'),
						"type" => "info",
						"desc" => __('Control in the bottom social icons, Paste the URL of your favorite social networks or leave empty to hide icons', 'betterwork')
						);

		$options[] = array( "name" => __('Join message', 'betterwork'),
						"id" => "join_us_text",
						"std" => __('Join us on:', 'betterwork'),
						"type" => "text",
						);
						
		$options[] = array( "name" => __('Facebook', 'betterwork'),
						"id" => "facebook_url",
						"std" => "#",
						"type" => "text",
						);

		$options[] = array( "name" => __('Youtube', 'betterwork'),
						"id" => "youtube_url",
						"type" => "text",
						"std" => "#"
						);

		$options[] = array( "name" => __('Twitter', 'betterwork'),
						"id" => "twitter_url",
						"type" => "text",
						"std" => "#"
						);
						
		$options[] = array( "name" => __('Linkedin', 'betterwork'),
						"id" => "linkedin_url",
						"type" => "text",
						"std" => "#"
						);				

// End Footer


	return $options;
}