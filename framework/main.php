<?php

/**************************************************************
 *          All theme Paths 
 ***************************************************************/
	
	//theme Directory and URI
	define('O2_DIR', get_template_directory());
	define('O2_URI', get_template_directory_uri());
	define('O2_PLUGIN_DIR', ABSPATH . 'wp-content/plugins');
	// Framework
	define('O2_FW', O2_DIR . '/framework');
	//post types
	define('O2_TYPE', O2_FW . '/posttype');
	
		//assest
		define('O2_JS', O2_URI . '/js');
		define('O2_CSS', O2_URI . '/css');
		define('O2_IMG', O2_URI . '/images');
		define('O2_SCRIPTS', O2_URI. '/framework/scripts');
		define('O2_FUN', O2_FW . '/functions');
		define('O2_ADMIN', O2_FW . '/admin');
		define('O2_CUSTOMPOST', O2_FW . '/custom-post');
		define('O2_META', O2_FW . '/metaboxes');
		define('O2_SC', O2_FW . '/shortcodes');
		define('O2_WIDGET', O2_FW . '/widgets');
		define('O2_INCLUDES', O2_DIR . '/includes');
	define('OPTIONS_FRAMEWORK_URL', O2_URI . '/framework/admin/');
	define('OPTIONS_FRAMEWORK_DIRECTORY', O2_ADMIN);
		
	
	//Admin Option
    require (O2_ADMIN . '/options-framework.php');	
	
	//Add Dynamic sidebar
	include(O2_FUN . '/sidebar-generator.php');
	
	//Add CPT	
	include (O2_TYPE . '/custom-post-type.php');
	
	//Add metabox
	include ( O2_META . '/theme-metaboxes.php');
	//include ( O2_META . '/example-functions.php');
	
	//Add custom widgets
	include(O2_WIDGET . '/latestpost-widget.php');
	include(O2_WIDGET . '/video-widget.php');
	include(O2_WIDGET . '/newsletter.php');
	include(O2_WIDGET . '/customcategory-widget.php');
	include(O2_WIDGET . '/googlemap-widget.php');
	include(O2_WIDGET . '/donor-widget.php');
	include(O2_WIDGET . '/subpages-widget.php');
	//include(O2_WIDGET . '/calendar-category-widget.php');
	include(O2_WIDGET . '/text-image-widget.php');
	
	
	//do_action('icl_navigation_menu');

// load styles
function my_init_styles() {
    if( !is_admin() ){
	
	wp_enqueue_style('reset', O2_CSS . '/reset.css', false, '1.0', 'screen');
	wp_enqueue_style('text', O2_CSS . "/text.css", false, '1.0', 'screen');
	//addon style 'jCarousel'
	wp_enqueue_style('donor-carousel', O2_CSS . "/jcarousel/skin.css", false, '1.0'); 
	//addon style 'PrettyPhoto'
	
	if ( of_get_option('enable_prettyphoto_script') &&  !WP_PRETTY_PHOTO_PLUGIN_ACTIVE ) {
			wp_enqueue_style('pretty_photo', O2_JS . '/prettyPhoto/css/prettyPhoto.css', false, '3.1.3', 'screen');
        }
	
    wp_enqueue_style('style-orig', O2_URI . "/style.css", false, '1.0', 'screen');
	if ( is_rtl() ){
		wp_enqueue_style('style-rtl', O2_CSS . "/rtl.css", false, '1.0', 'screen');
	}
    
    }
}
add_action('wp_print_styles', 'my_init_styles');

// load scripts
function my_init_scripts() {
    if( !is_admin() ){
	    
		// Load jQuery
		if( WP_PRETTY_PHOTO_PLUGIN_ACTIVE ) { // WP-prettyPhoto requires jquery 1.4.2
				wp_deregister_script( 'jquery' );
				wp_register_script( 'jquery', O2_JS ."/js/jquery.js", false, '' );
			}
		wp_enqueue_script('jquery');
		
		// jQuery validation script
		if ( is_page_template('page-contact.php') ) {
			wp_enqueue_script('jquery_validate_lib', O2_JS."/jquery.validate.min.js", array('jquery'), '1.8.1', false);
			wp_enqueue_script('masked_input_plugin', O2_JS."/jquery.maskedinput.min.js", array('jquery'), '1.3', false);
		}
		
		if ( is_home() || is_page_template('page-landing-category.php') ) :
			wp_enqueue_script('jquery-cycle', O2_JS."/jquery.cycle.all.min.js", array('jquery'), '2.9', false);
			wp_enqueue_script('jquery-easing', O2_JS."/jquery.easing.1.3.js", array('jquery'), '1.3', false);
		endif;
		
		// PrettyPhoto script
		if( of_get_option('enable_prettyphoto_script') && !WP_PRETTY_PHOTO_PLUGIN_ACTIVE ) {
				wp_enqueue_script('pretty_photo_lib', O2_JS."/prettyPhoto/js/jquery.prettyPhoto.js", array('jquery'), '3.1.3', false);
				wp_enqueue_script('custom_pretty_photo', O2_JS."/prettyPhoto/custom_params.js", array('pretty_photo_lib'), '3.1.3', false);
			}
		
		// Miscellaneous JS scripts
		wp_enqueue_script('donor-widget-custom', O2_JS."/jquery.jcarousel.min.js", '', '1.0', false);
		wp_enqueue_script('script-custom', O2_JS."/custom.js", '', '1.0', false);
		if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
	
	}
	
}

add_action('wp_print_scripts', 'my_init_scripts');

// Custom logo login
function my_custom_login_logo() {
    echo '<style type="text/css">
        .login h1 a { background-image:url('.get_bloginfo('template_directory').'/images/custom-login-logo.png) !important; height:119px !important; background-size: 323px 119px !important; }
    </style>';
}

add_action('login_head', 'my_custom_login_logo');

//  Remove error message login
add_filter('login_errors', create_function('$a', "return null;"));


//  Remove wordpress link on admin login logo
function remove_link_on_admin_login_info() {
     return  get_bloginfo('url');
}
  
add_filter('login_headerurl', 'remove_link_on_admin_login_info');

//	Remove logo and other items in Admin menu bar
function remove_admin_bar_links() {
	global $wp_admin_bar;
	$wp_admin_bar->remove_menu('comments');
	$wp_admin_bar->remove_menu('wp-logo');
}
add_action( 'wp_before_admin_bar_render', 'remove_admin_bar_links' );

//  Remove wordpress version generation
function remove_version_info() {
     return '';
}
add_filter('the_generator', 'remove_version_info');


//  Set favicons for backend code
function adminfavicon() {
echo '<link rel="icon" type="image/x-icon" href="'.get_bloginfo('template_directory').'/images/admin-favicon.png" />';
}
add_action( 'admin_head', 'adminfavicon' );

// Menu functions with support for WordPress 3.0 menus
if ( function_exists('wp_nav_menu') ) {
    add_theme_support( 'nav-menus' );
    register_nav_menus( array(
	'primary' => esc_html__( 'Main Menu', 'betterwork' ),
    ) );
	register_nav_menus(
	   array(
		'footer'   => esc_html__('Footer Menu', 'betterwork'),
	) );
}

// set default main menu if wp_nav_menu not active
function bw_main_nav() {
    if ( function_exists( 'wp_nav_menu' ) )
		wp_nav_menu ( array( 'menu_class' => 'nav','container'=> 'ul', 'theme_location' => 'primary', 'fallback_cb' => 'bw_main_nav_fallback' ));
    else
        bw_main_nav_fallback();
}

function bw_main_nav_fallback() {
    
    $menu_html = '<div class="nav_wrap">';
    $menu_html .= '<ul class="nav">';
    $menu_html .= is_front_page() ? "<li class='current_page_item_home'>" : "<li>";
    $menu_html .= '<a href="'.get_bloginfo('url').'" class="homeicon">'.esc_html__('Home', 'betterwork').'</a></li>';
    $menu_html .= wp_list_pages('depth=5&title_li=0&sort_column=menu_orde&echo=0');
    $menu_html .= '</ul>';
    $menu_html .= '</div>';
    echo $menu_html;
}

// set footer menu if wp_nav_menu not active
function bw_footer_nav() {
    if ( function_exists( 'wp_nav_menu' ) )
	wp_nav_menu ( array( 'container'=> 'ul', 
				'after' => ' - ',
				'theme_location' => 'footer',
			    'fallback_cb' => 'bw_footer_nav_fallback' ));
    else
        bw_footer_nav_fallback();
}

function bw_footer_nav_fallback() {
    
    $menu_html .= '<ul>';
    $menu_html .= is_front_page() ? "<li class='current_page_item_home'>" : "<li>";
    $menu_html .= '<a href="'.get_bloginfo('url').'" class="homeicon">'.esc_html__('Home', 'betterwork').'</a> </li>';
    $menu_html .= wp_list_pages('depth=-1&title_li=0&link_before= - &link_after= &echo=0');
    $menu_html .= '</ul>';
    echo $menu_html;
}

// replace the original get_search_form() with the internationalized version here:
function translatable_search_form( $form ) {
    $form = '<form role="search" method="get" id="searchform" action="'.get_bloginfo('url').'" >
    <div><label class="screen-reader-text" for="s">' . __('Search for:', 'betterwork') . '</label>
	<input type="text" value="' . get_search_query() . '" name="s" id="s" />
	<input type="submit" id="searchsubmit" value="'. esc_attr__('Search', 'betterwork') .'" />
    </div>
    </form>';
    return $form;
}
add_filter( 'get_search_form', 'translatable_search_form' );

// Custom Comment template
function mytheme_comment( $comment, $args, $depth ) {
   $GLOBALS['comment'] = $comment;
   $template_dir_url = get_bloginfo('template_url'); ?>

   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
     <div id="comment-<?php comment_ID(); ?>">
	<div class="comment-meta vcard pngfix">
	    <div class="avatar-wrapper">
<?php		echo get_avatar( $comment, $size='52', $default="{$template_dir_url}/images/common-images/mystery-man.jpg" ); ?>
	    </div>
	    <div class="commentmetadata">
		<div class="author"><?php comment_author_link() ?></div>
<?php		    printf(__('<span class="time">%1$s</span> on <a href="#comment-%2$s" title="">%3$s</a>', 'betterwork'), get_comment_time(__('g:i a')), get_comment_ID(), get_comment_date(__('F j, Y')) );
		    edit_comment_link(esc_html__('edit', 'betterwork'),'&nbsp;&nbsp;',''); ?>
	    </div>
	</div>

	<div class="commenttext">
<?php	    if ($comment->comment_approved == '0') : ?>
		<em><?php esc_html_e('Your comment is awaiting moderation.', 'betterwork') ?></em>
		<br />
<?php	    endif; ?>
<?php	    comment_text() ?>
	    <div class="reply">
<?php		comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
	    </div>
	</div>


     </div>
<?php
}

// Include the posts' count under a category into the a-tag when listing the categories
function posts_count_inside_the_link( $html ) {
    $html = preg_replace( '/\<\/a\> \((.*)\)/', ' <span class="posts-counter">($1)</span></a>', $html );
    return $html;
}
add_filter('wp_list_categories', 'posts_count_inside_the_link');

// Include the posts' count under an archive into the a-tag when listing the categories
function posts_count_inside_archive_link( $html ) {
    $html = preg_replace( '/\<\/a\>&nbsp;\((.*)\)/', ' <span class="posts-counter">($1)</span></a>', $html );
    return $html;
}
add_filter('get_archives_link', 'posts_count_inside_archive_link');

function o2_doctitle() {
		$site_name = get_bloginfo('name');
	    $separator = '|';
	        	
	    if ( is_single() ) {
	      $content = single_post_title('', FALSE);
	    }
	    elseif ( is_home() || is_front_page() ) { 
	      $content = get_bloginfo('description');
	    }
	    elseif ( is_page() ) { 
	      $content = single_post_title('', FALSE); 
	    }
	    elseif ( is_search() ) { 
	      $content = __('Search Results for:', 'mom'); 
	      $content .= ' ' . esc_html(stripslashes(get_search_query()));
	    }
	    elseif ( is_category() ) {
	      $content = __('Category Archives:', 'mom');
	      $content .= ' ' . single_cat_title("", false);;
	    }
	    elseif ( is_tag() ) { 
	      $content = __('Tag Archives:', 'mom');
	      $content .= ' ' . o2_tag_query();
	    }
	    elseif ( is_404() ) { 
	      $content = __('Not Found', 'mom'); 
	    }
	    else { 
	      $content = get_bloginfo('description');
	    }
	
	    if (get_query_var('paged')) {
	      $content .= ' ' .$separator. ' ';
	      $content .= 'Page';
	      $content .= ' ';
	      $content .= get_query_var('paged');
	    }
	
	    if($content) {
	      if ( is_home() || is_front_page() ) {
	          $elements = array(
	            'site_name' => $site_name,
	            'separator' => $separator,
	            'content' => $content
	          );
	      }
	      else {
	          $elements = array(
	            'content' => $content
	          );
	      }  
	    } else {
	      $elements = array(
	        'site_name' => $site_name
	      );
	    }
	
	    // Filters should return an array
	    $elements = apply_filters('o2_doctitle', $elements);
		
	    // But if they don't, it won't try to implode
	    if(is_array($elements)) {
	      $doctitle = implode(' ', $elements);
	    }
	    else {
	      $doctitle = $elements;
	    }
	    
	    $doctitle = "\t" . "<title>" . $doctitle . "</title>" . "\n\n";
	    
	    echo $doctitle;
	} // end o2_doctitle

// Creates the content-type section
function o2_create_contenttype() {
    $content  = "\t";
    $content .= "<meta http-equiv=\"Content-Type\" content=\"";
    $content .= get_bloginfo('html_type'); 
    $content .= "; charset=";
    $content .= get_bloginfo('charset');
    $content .= "\" />";
    $content .= "\n\n";
    echo apply_filters('o2_create_contenttype', $content);
} // end o2_create_contenttype

// The master switch for SEO functions
function o2_seo() {
		$content = TRUE;
		return apply_filters('o2_seo', $content);
}

// Creates the canonical URL
function o2_canonical_url() {
		if (o2_seo()) {
    		if ( is_singular() ) {
        		$canonical_url = "\t";
        		$canonical_url .= '<link rel="canonical" href="' . get_permalink() . '" />';
        		$canonical_url .= "\n\n";        
        		echo apply_filters('o2_canonical_url', $canonical_url);
				}
    }
} // end o2_canonical_url


// switch use of o2_the_excerpt() - default: ON
function o2_use_excerpt() {
    $display = TRUE;
    $display = apply_filters('o2_use_excerpt', $display);
    return $display;
} // end o2_use_excerpt


// switch use of o2_the_excerpt() - default: OFF
function o2_use_autoexcerpt() {
    $display = FALSE;
    $display = apply_filters('o2_use_autoexcerpt', $display);
    return $display;
} // end o2_use_autoexcerpt

function o2_the_excerpt($deprecated = '') {
	global $post;
	$output = '';
	$output = strip_tags($post->post_excerpt);
	$output = str_replace('"', '\'', $output);
	if ( post_password_required($post) ) {
		$output = __('There is no excerpt because this is a protected post.');
		return $output;
	}

	return $output;
	
}

// Creates the meta-tag description
function o2_create_description() {
		$content = '';
		if (o2_seo()) {
    		if (is_single() || is_page() ) {
      		  if ( have_posts() ) {
          		  while ( have_posts() ) {
            		    the_post();
										if (o2_the_excerpt() == "") {
                    		if (o2_use_autoexcerpt()) {
                        		$content ="\t";
														$content .= "<meta name=\"description\" content=\"";
                        		$content .= o2_excerpt_rss();
                        		$content .= "\" />";
                        		$content .= "\n\n";
                    		}
                		} else {
                    		if (o2_use_excerpt()) {
                        		$content ="\t";
                        		$content .= "<meta name=\"description\" content=\"";
                        		$content .= o2_the_excerpt();
                        		$content .= "\" />";
                        		$content .= "\n\n";
                    		}
                		}
            		}
        		}
    		} elseif ( is_home() || is_front_page() ) {
        		$content ="\t";
        		$content .= "<meta name=\"description\" content=\"";
        		$content .= get_bloginfo('description');
        		$content .= "\" />";
        		$content .= "\n\n";
    		}
    		echo apply_filters ('o2_create_description', $content);
		}
} // end o2_create_description


// meta-tag description is switchable using a filter
function o2_show_description() {
    $display = TRUE;
    $display = apply_filters('o2_show_description', $display);
    if ($display) {
        o2_create_description();
    }
} // end o2_show_description


// create meta-tag robots
function o2_create_robots() {
        global $paged;
		if (o2_seo()) {
    		$content = "\t";
    		if((is_home() && ($paged < 2 )) || is_front_page() || is_single() || is_page() || is_attachment()) {
				$content .= "<meta name=\"robots\" content=\"index,follow\" />";
    		} elseif (is_search()) {
        		$content .= "<meta name=\"robots\" content=\"noindex,nofollow\" />";
    		} else {	
        		$content .= "<meta name=\"robots\" content=\"noindex,follow\" />";
    		}
    		$content .= "\n\n";
    		if (get_option('blog_public')) {
    				echo apply_filters('o2_create_robots', $content);
    		}
		}
} // end o2_create_robots


// meta-tag robots is switchable using a filter
function o2_show_robots() {
    $display = TRUE;
    $display = apply_filters('o2_show_robots', $display);
    if ($display) {
        o2_create_robots();
    }
} // end o2_show_robots

// creates link to style.css
function o2_create_stylesheet() {
    $content = "\t";
    $content .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"";
    $content .= get_bloginfo('stylesheet_url');
    $content .= "\" />";
    $content .= "\n\n";
    echo apply_filters('o2_create_stylesheet', $content);
}

// Capture the output of "the_author_posts_link()" function into a local variable and return it.
// This function must be used within 'The Loop'
if ( !function_exists('betterwork_get_the_author_page_link') ) {
    function betterwork_get_the_author_page_link() {
        ob_start();
        the_author_posts_link();
        $the_author_link = ob_get_contents();
        ob_end_clean();
        return $the_author_link;
    }
}

if ( function_exists('add_theme_support') ) {
    add_theme_support( 'automatic-feed-links' );
} elseif ( function_exists('automatic_feed_links') ) {
    automatic_feed_links();
}

// Add support for post featured image.  To add this feature to other post types, add those new types to the array, e.g. array( 'post', 'page', 'movies' )
if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails', array( 'post', 'page', 'slideshow', 'donor' ));
	add_image_size( 'medium', 267, 9999 );
	add_image_size( 'large', 588, 9999 );
	
	add_image_size( 'homeslide-thumb', 952, 330, true ); // Hard Crop Mode, if Soft Crop Mode change true to false or blank
	add_image_size( 'donor-thumb', 215, 118, true ); // Hard Crop Mode
	add_image_size( 'catslide-thumb', 500, 300, true ); // Hard Crop Mode
}

add_filter( 'image_size_names_choose', 'custom_image_sizes_choose' );
function custom_image_sizes_choose( $sizes ) {
	$custom_sizes = array(
		'homeslide-thumb' => 'Home Slideshow',
		'donor-thumb' => 'Donor logo'
	);
	return array_merge( $sizes, $custom_sizes );
}

// Filter the "Featured Image" with this theme's custom image frame with alignment. Can be enabled from the theme's "Blog Section".
if ( of_get_option('show_thumbnail_in_archive') ) {
    function my_post_image_html( $html, $post_id, $post_image_id ) {
        $html = preg_replace('/title=\"(.*?)\"/', '', $html);
        preg_match( '/aligncenter|alignleft|alignright/', $html, $matches );
        $image_alignment = $matches[0];
        $html = preg_replace('/aligncenter|alignleft|alignright/', 'alignnone', $html);
        $html = '<span class="custom-frame '.$image_alignment.'"><a href="' . get_permalink( $post_id ) . '" title="' . esc_attr( get_post_field( 'post_title', $post_id ) ) . '">' . $html . '</a></span>';
        if( $image_alignment == 'aligncenter' ) $html = '<div style="text-align:center;">'.$html.'</div>';
        return $html;
    }
    add_filter( 'post_thumbnail_html', 'my_post_image_html', 10, 3 );
}

/* Check for image */
function findImage() {
	$content = get_the_content();
	$count = substr_count($content, '<img');
	if ($count > 0) return true;
	else return false;
}

/* Get the first image from the post and return it */
function get_image_url() {
    global $post, $posts;
    $first_img = '';
    ob_start();
    ob_end_clean();
    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
    $first_img = $matches [1] [0];

    if(empty($first_img)){ //Defines a default image
	$first_img = ''; //"/images/thumbnail-default.jpg";
    }
    return $first_img;
}

// This function is used in processing images (cutting, cropping, zoom)
if ( !function_exists('betterwork_process_image') ) {
    function betterwork_process_image( $img_source, $img_width, $img_height, $zc = 1, $q = 100 ) {
		
		$img_source = O2_SCRIPTS .'/timthumb.php?src='.$img_source.'&amp;w='.$img_width.'&amp;h='.$img_height.'&amp;zc='.$zc.'&amp;q='.$q;
        return $img_source;
    }
}

/**
 * Customize image dimension and apply custom image frame with alignment
 * @param int $post_id Post ID.
 * @param string $img_src Image URL.
 * @param string $width Image width.
 * @param string $height Image height.
 * @param string $image_alignment Image alignment in the form of 'alignleft', 'aligncenter', 'alignright'
 * @param bool $linked Set to 'true' if the image should link to the post or 'false' otherwise
 * @return string HTML formatted image linking (optional) to the Post with $post_id
 */
function customized_featured_image( $post_id, $img_src, $width, $height, $image_alignment = 'alignleft', $linked = true ) {
    $the_image_html = '<img src="'.betterwork_process_image( $img_src, $width, $height, 1, 100 ).'" alt="' . esc_attr( get_post_field( 'post_title', $post_id ) ) . '" />';
    if ( $linked ) $the_image_html = '<a href="'.get_permalink( $post_id ).'" title="' . esc_attr( get_post_field( 'post_title', $post_id ) ) . '">'.$the_image_html.'</a>';
    $html = '<span class="custom-frame '.$image_alignment.'">'.$the_image_html.'</span>';
    if( $image_alignment == 'aligncenter' ) $html = '<div style="text-align:center;">'.$html.'</div>';
    return $html;
}

/**
 * Display the post image linked (optional) to the post
 * @param int $post_id Post ID.
 * @param bool $linked Set to 'true' if the image should link to the post or 'false' otherwise
 * @return string HTML formatted post image linking (optional) to the Post with $post_id
 */
function display_post_image_fn( $post_id, $linked = true) {
	
    $post_image_url = get_post_meta($post_id, 'post_image', true); // Grab the preview image from the custom field 'post_image', if set.
	
	if ( !$post_image_url && has_post_thumbnail( $post_id ) ) {
        $tmp_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'single-post-thumbnail' );
        $post_image_url = $tmp_image[0];
    }
	
	if ( !$post_image_url && !has_post_thumbnail( $post_id ) && function_exists('get_image_url') && findImage() ) {
		$post_image_url = get_image_url();	
	}
	
	if ( of_get_option('show_thumbnail_in_archive') ) :
	    if ( $post_image_url ) {    
                echo customized_featured_image( $post_id, $post_image_url, 150, 150, 'alignleft', $linked );	
		} 
	endif;	
}

/***************** BEGIN EXCERPTS ******************/
// change the length of excerpts
function new_excerpt_length( $length ) {
    return of_get_option('excerpt_length_in_words');
}
add_filter('excerpt_length', 'new_excerpt_length');

// remove the '[...]'
function moreLink( $content ){
    return str_replace( '[...]', '', do_shortcode($content) );
}
add_filter('the_excerpt', 'moreLink');

// Custom length of the excerpt in words
function custom_string_length_by_words( $string, $limit ) {
    $array_of_words = explode(' ', $string, ($limit + 1));
    if( count($array_of_words) > $limit ){
	array_pop($array_of_words);
    }
    return implode(' ', $array_of_words);
}

/***************** END EXCERPTS ******************/

/*
 * Plugin Name: Shortcode Empty Paragraph Fix
 * Plugin URI: http://www.johannheyne.de/wordpress/shortcode-empty-paragraph-fix/
 * Description: Fix issues when shortcodes are embedded in a block of content that is filtered by wpautop.
 * Author URI: http://www.johannheyne.de
 * Version: 0.1
 * Put this in /wp-content/plugins/ of your Wordpress installation
 */
function shortcode_paragraph_insertion_fix($content) {   
    $array = array (
        '<p>[' => '[', 
        ']</p>' => ']', 
        ']<br />' => ']'
    );
    $content = strtr($content, $array);
    return $content;
}
add_filter('the_content', 'shortcode_paragraph_insertion_fix');

// format "<!--more-->" tag for betterwork
function betterwork_more_link( $more_link, $more_link_text ) {
        global $post;
        $html .= ' <a title="'.$more_link_text.'" href="'.get_permalink().'#more-'.$post->ID.'" class="read-more-align-left"><span>'.$more_link_text.'</span> &rarr;</a>';
        $html .= '<div class="clear"></div>';
        return $html;
}
add_filter('the_content_more_link', 'betterwork_more_link', 10, 2);

// Capture the output of "the_author_posts_link()" function into a local variable and return it.
// This function must be used within 'The Loop'
if ( !function_exists('betterwork_get_the_author_page_link') ) {
    function betterwork_get_the_author_page_link() {
        ob_start();
        the_author_posts_link();
        $the_author_link = ob_get_contents();
        ob_end_clean();
        return $the_author_link;
    }
}

// Determine whether WP-prettyPhoto plugin is acivated and assign the result to a constant
defined('WP_PRETTY_PHOTO_PLUGIN_ACTIVE')
        || define('WP_PRETTY_PHOTO_PLUGIN_ACTIVE', class_exists( 'WP_prettyPhoto' ) );


// if the WP-prettyPhoto plugin is not active handle rel="wp-prettyPhoto" in links for the prettyPhoto integrated script (if enabled)
if ( !WP_PRETTY_PHOTO_PLUGIN_ACTIVE && ( of_get_option('enable_prettyphoto_script') ) ) {
    /**
     * Insert rel="wp-prettyPhoto" to all links for images, movie, YouTube and iFrame. 
     * This function will ignore links where you have manually entered your own rel reference.
     * @param string $content Post/page contents
     * @return string Prettified post/page contents
     * @link http://0xtc.com/2008/05/27/auto-lightbox-function.xhtml
     * @access public
      */
    function autoinsert_rel_prettyPhoto ($content) {
        global $post;
        $rel = 'wp-prettyPhoto';
        $image_match = '\.bmp|\.gif|\.jpg|\.jpeg|\.png';
        $movie_match = '\.mov.*?';
        $swf_match = '\.swf.*?';
        $youtube_match = 'http:\/\/www\.youtube\.com\/watch\?v=[A-Za-z0-9]*';
        $iframe_match = '.*iframe=true.*';
        $pattern[0] = "/<a(.*?)href=('|\")([A-Za-z0-9\/_\.\~\:-]*?)(".$image_match."|".$movie_match."|".$swf_match."|".$youtube_match."|".$iframe_match.")('|\")([^\>]*?)>/i";
        $pattern[1] = "/<a(.*?)href=('|\")([A-Za-z0-9\/_\.\~\:-]*?)(".$image_match."|".$movie_match."|".$swf_match."|".$youtube_match."|".$iframe_match.")('|\")(.*?)(rel=('|\")".$rel."(.*?)('|\"))([ \t\r\n\v\f]*?)((rel=('|\")".$rel."(.*?)('|\"))?)([ \t\r\n\v\f]?)([^\>]*?)>/i";
        $replacement[0] = '<a$1href=$2$3$4$5$6 rel="'.$rel.'['.$post->ID.']">';
        $replacement[1] = '<a$1href=$2$3$4$5$6$7>';
        $content = preg_replace($pattern, $replacement, $content);
        return $content;
    }
    add_filter('the_content', 'autoinsert_rel_prettyPhoto');
    add_filter('the_excerpt', 'autoinsert_rel_prettyPhoto');


    // Add the 'wp-prettyPhoto' rel attribute to the default WP gallery links
    function gallery_prettyPhoto ($content) {
            // add checks if you want to add prettyPhoto on certain places (archives etc).
            return str_replace("<a", "<a rel='wp-prettyPhoto[gallery]'", $content);
    }
    add_filter( 'wp_get_attachment_link', 'gallery_prettyPhoto');
}


/***************** BEGIN SHORTCODES ******************/
// Allows shortcodes to be displayed in sidebar widgets
add_filter('widget_text', 'do_shortcode');

// Shirtcode: "Read More ->" Link.
// Usage: [read_more text="Read more" title="Read More..." url="http://www.some-url-goes-here.com/" align="left" target="_blank"]
function read_more_func( $atts ) {
    extract(shortcode_atts(array(
	    'text' => esc_html__('Read more', 'betterwork'),
	    'title' => '',
	    'url' => '#',
	    'align' => 'left',
	    'target' => '',
    ), $atts));

    $target = ($target == '_blank') ? ' target="_blank"' : '';
    $align_class = ( $align == 'right' ) ? '-align-right': '-align-left';
    $html = '<a class="read-more'.$align_class.'" href="'.$url.'" title="'.$title.'"'.$target.'><span>'.do_shortcode($text).'</span> &rarr;</a>';
    return $html;
}
add_shortcode('read_more', 'read_more_func');

// Shirtcode: Button.
// Usage: [button text="Read more..." style="light" title="Nice Button" url="http://www.some-url-goes-here.com/" align="left" target="_blank"]
function button_func( $atts ) {
    extract(shortcode_atts(array(
	    'text' => esc_html__('Read more...', 'betterwork'),
	    'style' => 'dark',
	    'title' => '',
	    'url' => '#',
	    'align' => 'left',
	    'target' => '',
    ), $atts));

    $target = ($target == '_blank') ? ' target="_blank"' : '';
    $align_class = ( $align == 'right' ) ? ' align-btn-right': ' align-btn-left';
    $style_class = ( $style == 'dark' ) ? ' dark-button': ' light-button';
    $html = '<div class="clear"></div>
		<a class="pngfix'.$style_class.$align_class.'" href="'.$url.'" title="'.$title.'"'.$target.'><span class="pngfix">'.do_shortcode($text).'</span></a>
	     <div class="clear"></div>';
    return $html;
}
add_shortcode('button', 'button_func');

// Shirtcode: Small Button.
// Usage: [small_button text="Read more..." style="light" title="Nice Button" url="http://www.some-url-goes-here.com/" align="left" target="_blank"]
function small_button_func( $atts ) {
    extract(shortcode_atts(array(
	    'text' => esc_html__('Read more...', 'betterwork'),
	    'style' => 'dark',
	    'title' => '',
	    'url' => '#',
	    'align' => 'left',
	    'target' => '',
    ), $atts));

    $target = ($target == '_blank') ? ' target="_blank"' : '';
    $align_class = ( $align == 'right' ) ? ' align-btn-right': ' align-btn-left';
    $style_class = ( $style == 'dark' ) ? ' small-dark-button': ' small-light-button';
    $html = '<div class="clear"></div>
		<a class="pngfix'.$style_class.$align_class.'" href="'.$url.'" title="'.$title.'"'.$target.'><span class="pngfix">'.do_shortcode($text).'</span></a>
	     <div class="clear"></div>';
    return $html;
}
add_shortcode('small_button', 'small_button_func');

// Shirtcode: Round Button.
// Usage: [round_button text="Read more..." style="light" title="Nice Button" url="http://www.some-url-goes-here.com/" align="left" target="_blank"]
function round_button_func( $atts ) {
    extract(shortcode_atts(array(
	    'text' => esc_html__('Read more...', 'betterwork'),
	    'style' => 'dark',
	    'title' => '',
	    'url' => '#',
	    'align' => 'left',
	    'target' => '',
    ), $atts));
    $target = ($target == '_blank') ? ' target="_blank"' : '';
    $align_class = ( $align == 'right' ) ? ' align-btn-right': ' align-btn-left';
    $style_class = ( $style == 'dark' ) ? ' dark-round-button': ' light-round-button';
    $html = '<div class="clear"></div>
		<a class="pngfix'.$style_class.$align_class.'" href="'.$url.'" title="'.$title.'"'.$target.'><span class="pngfix">'.do_shortcode($text).'</span></a>
	     <div class="clear"></div>';
    return $html;
}
add_shortcode('round_button', 'round_button_func');

// Shirtcode: Custom Button.
// Usage: [custom_button text="Read more..." title="Nice Button" url="http://www.some-url-goes-here.com/" size="medium" bg_color="#FF5C00" text_color="#FFFFFF" align="left" target="_blank"]
// Options: align: left or right, size: small, medium, large and x-large, the rest are self explanatory...
function custom_button_func( $atts ) {
    extract(shortcode_atts(array(
	    'text' => esc_html__('Read more...', 'betterwork'),
	    'title' => '',
	    'url' => '#',
	    'size' => 'medium',
	    'bg_color' => '#FF5C00',
	    'text_color' => '#FFFFFF',
	    'align' => 'left',
	    'target' => '',
    ), $atts));
    $target = ($target == '_blank') ? ' target="_blank"' : '';
    $align_class = ( $align == 'right' ) ? ' align-btn-right': ' align-btn-left';
    $html = '
                <a class="'.strtolower($size).' custom-button'.$align_class.'" href="'.$url.'" title="'.$title.'"'.$target.'><span style="background-color:'.$bg_color.'; color:'.$text_color.'">'.do_shortcode($text).'</span></a>
	     ';
    return $html;
}
add_shortcode('custom_button', 'custom_button_func');

// Shirtcode: Divider with an anchor link to top of page.
// Usage: [divider]
function divider_func( $atts ) {
    return '<div class="divider"></div>';
}
add_shortcode('divider', 'divider_func');

// Shirtcode: Divider with an anchor link to top of page.
// Usage: [divider_top]
function divider_top_func( $atts ) {
    return '<div class="divider top-of-page"><a href="#top" title="'.esc_html__('Top of Page', 'betterwork').'">'.esc_html__('Back to Top', 'betterwork').'</a></div>';
}
add_shortcode('divider_top', 'divider_top_func');

// Shirtcode: Clear , used to clear an element of its neighbors, no floating elements are allowed on the left or the right side.
// Usage: [clear]
function clear_func( $atts ) {
    return '<div class="clear"></div>';
}
add_shortcode('clear', 'clear_func');

// Shirtcode: Mesage Box. Predefined and custom.
// Usage (pre-defined): [message type="info"]Your info message goes here...[/message]
// there are 4 pre-set message types: "info", "success", "warning", "erroneous"
// Usage (custom): [message type="custom" width="100%" start_color="#FFFFFF" end_color="#EEEEEE" border="#BBBBBB" color="#333333"]Your info message goes here...[/message]
// width could be in pixels as well, e.g. width="250px"
// Usage (simple): [message type="simple" bg_color="#EEEEEE" color="#333333"]Your info message goes here...[/message]
function message_box_func( $atts, $content = null ) {
    extract(shortcode_atts(array(
	    'type' => 'custom',
	    'align' => 'left',
	    'start_color' => '#FFFFFF',
	    'end_color' => '#EEEEEE',
	    'border' => '#BBBBBB',
	    'width' => '100%',
	    'color' => '#333333',
	    'bg_color' => '#F5F5F5',
    ), $atts));
    if ($type == 'custom') {
	if ($align == 'center') {
	    $margin_left = $margin_right = 'auto !important';
	} elseif ($align == 'right') {
	    $margin_left = 'auto !important';
	    $margin_right = '0 !important';
	} else { // default: LEFT
	    $margin_left = $margin_right = '0 !important';
	}
	$html = '<div class="'.$type.'" style="background:-moz-linear-gradient(center top , '.$start_color.', '.$end_color.') repeat scroll 0 0 transparent;
					       background: -webkit-gradient(linear, center top, center bottom, from('.$start_color.'), to('.$end_color.'));
					       margin-left:'.$margin_left.';
					       margin-right:'.$margin_right.';
					       border:1px solid '.$border.';
					       background-color: '.$end_color.';
					       width:'.$width.';
					       color:'.$color.';"><div class="inner-padding">'.do_shortcode($content).'</div></div>';
    } elseif ($type == 'simple') {
	$html = '<div class="'.$type.'" style="background-color:'.$bg_color.'; color:'.$color.';"><div class="inner-padding">'.do_shortcode($content).'</div></div>';
    } else {
	$html = '<div class="'.$type.'"><div class="msg-box-icon pngfix">'.do_shortcode($content).'</div></div>';
    }
    return $html;
}
add_shortcode('message', 'message_box_func');

// Shirtcode: PullQuote.
// Usage: [pullquote style="left" quote="light"], style options: 'left', 'right'; quote options: 'light' (optional), otherwise defaults to dark style
function pullquote_func( $atts, $content = null ) {
    extract(shortcode_atts(array(
	    'style' => 'left',
	    'quote' => 'dark',
    ), $atts));
    $align = ($style == 'right') ? 'alignright' : 'alignleft';
    $quote_color = ($quote == 'light') ? ' bq-light' : '';
    return '<blockquote class="'.$align.$quote_color.'">'.do_shortcode($content).'</blockquote>';
}
add_shortcode('pullquote', 'pullquote_func');

// Shortcode: Dropcap
// Usage: [dropcap]A[/dropcap]
function dropcap_func( $atts, $content = null ) {
    return '<span class="dropcap">'.$content.'</span>';
}
add_shortcode('dropcap', 'dropcap_func');

// Shortcode: one_fourth
// Usage: [one_fourth]Content goes here...[/one_fourth]
function one_fourth_func( $atts, $content = null ) {
    return '<div class="one_fourth">'.do_shortcode($content).'</div>';
}
add_shortcode('one_fourth', 'one_fourth_func');

// Shortcode: one_fourth_last
// Usage: [one_fourth_last]Content goes here...[/one_fourth_last]
function one_fourth_last_func( $atts, $content = null ) {
    return '<div class="one_fourth last_column">'.do_shortcode($content).'</div>';
}
add_shortcode('one_fourth_last', 'one_fourth_last_func');

// Shortcode: one_third
// Usage: [one_third]Content goes here...[/one_third]
function one_third_func( $atts, $content = null ) {
    return '<div class="one_third">'.do_shortcode($content).'</div>';
}
add_shortcode('one_third', 'one_third_func');

// Shortcode: one_third_last
// Usage: [one_third_last]Content goes here...[/one_third_last]
function one_third_last_func( $atts, $content = null ) {
    return '<div class="one_third last_column">'.do_shortcode($content).'</div>';
}
add_shortcode('one_third_last', 'one_third_last_func');

// Shortcode: one_half
// Usage: [one_half]Content goes here...[/one_half]
function one_half_func( $atts, $content = null ) {
    return '<div class="one_half">'.do_shortcode($content).'</div>';
}
add_shortcode('one_half', 'one_half_func');

// Shortcode: one_half_last
// Usage: [one_half_last]Content goes here...[/one_half_last]
function one_half_last_func( $atts, $content = null ) {
    return '<div class="one_half last_column">'.do_shortcode($content).'</div>';
}
add_shortcode('one_half_last', 'one_half_last_func');

// Shortcode: two_third
// Usage: [two_third]Content goes here...[/two_third]
function two_third_func( $atts, $content = null ) {
    return '<div class="two_third">'.do_shortcode($content).'</div>';
}
add_shortcode('two_third', 'two_third_func');

// Shortcode: two_third_last
// Usage: [two_third_last]Content goes here...[/two_third_last]
function two_third_last_func( $atts, $content = null ) {
    return '<div class="two_third last_column">'.do_shortcode($content).'</div>';
}
add_shortcode('two_third_last', 'two_third_last_func');

// Shortcode: three_fourth
// Usage: [three_fourth]Content goes here...[/three_fourth]
function three_fourth_func( $atts, $content = null ) {
    return '<div class="three_fourth">'.do_shortcode($content).'</div>';
}
add_shortcode('three_fourth', 'three_fourth_func');

// Shortcode: three_fourth_last
// Usage: [three_fourth_last]Content goes here...[/three_fourth_last]
function three_fourth_last_func( $atts, $content = null ) {
    return '<div class="three_fourth last_column">'.do_shortcode($content).'</div>';
}
add_shortcode('three_fourth_last', 'three_fourth_last_func');

// Shortcode: toggle_content
// Usage: [toggle_content title="Title"]Your content goes here...[/toggle_content]
function toggle_content_func( $atts, $content = null ) {
    extract(shortcode_atts(array(
	    'title'      => '',
    ), $atts));
    $html = '<h4 class="slide_toggle"><a href="#">' .$title. '</a></h4>';
    $html .= '<div class="slide_toggle_content" style="display: none;">'.do_shortcode($content).'</div>';
    return $html;
}
add_shortcode('toggle_content', 'toggle_content_func');

// Shortcode: tab
// Usage: [tab title="title 1"]Your content goes here...[/tab]
function tab_func( $atts, $content = null ) {
    extract(shortcode_atts(array(
	    'title'      => '',
    ), $atts));
    global $single_tab_array;
    $single_tab_array[] = array('title' => $title, 'content' => trim(do_shortcode($content)));
    return $single_tab_array;
}
add_shortcode('tab', 'tab_func');

/* Shortcode: tabs
 * Usage:   [tabs]
 * 		[tab title="title 1"]Your content goes here...[/tab]
 * 		[tab title="title 2"]Your content goes here...[/tab]
 * 	    [/tabs]
 */
function tabs_func( $atts, $content = null ) {
    global $single_tab_array;
    $single_tab_array = array(); // clear the array

    $tabs_nav = '<div class="clear"></div>';
    $tabs_nav .= '<div class="tabs-wrapper">';
    $tabs_nav .= '<ul class="tabs">';
    do_shortcode($content); // execute the '[tab]' shortcode first to get the title and content
    foreach ($single_tab_array as $tab => $tab_attr_array) {
	$random_id = rand(1000,2000);
	$default = ( $tab == 0 ) ? ' class="defaulttab"' : '';
	$tabs_nav .= '<li><a href="javascript:void(0)"'.$default.' rel="tab'.$random_id.'"><span>'.$tab_attr_array['title'].'</span></a></li>';
	$tabs_content .= '<div class="tab-content" id="tab'.$random_id.'"><div class="tabs-inner-padding">'.$tab_attr_array['content'].'</div></div>';
    }
    $tabs_nav .= '</ul>';
    $tabs_output .= $tabs_nav . $tabs_content;
    $tabs_output .= '</div><!-- tabs-wrapper end -->';
    $tabs_output .= '<div class="clear"></div>';
    return $tabs_output;
}
add_shortcode('tabs', 'tabs_func');

// Shortcode: accordion_toggle
// Usage: [accordion_toggle title="title 1"]Your content goes here...[/accordion_toggle]
function accordion_toggle_func( $atts, $content = null ) {
    extract(shortcode_atts(array(
	    'title'      => '',
    ), $atts));
    global $single_accordion_toggle_array;
    $single_accordion_toggle_array[] = array('title' => $title, 'content' => trim(do_shortcode($content)));
    return $single_accordion_toggle_array;
}
add_shortcode('accordion_toggle', 'accordion_toggle_func');

/* Shortcode: accordion
 * Usage:   [accordion]
 * 		[accordion_toggle title="title 1"]Your content goes here...[/accordion_toggle]
 * 		[accordion_toggle title="title 2"]Your content goes here...[/accordion_toggle]
 * 	    [/accordion]
 */
function accordion_func( $atts, $content = null ) {
    global $single_accordion_toggle_array;
    $single_accordion_toggle_array = array(); // clear the array

    $accordion_output = '<div class="clear"></div>';
    $accordion_output .= '<div class="accordion-wrapper">';
    do_shortcode($content); // execute the '[accordion_toggle]' shortcode first to get the title and content
    foreach ($single_accordion_toggle_array as $tab => $accordion_toggle_attr_array) {
	$accordion_output .= '<h3 class="accordion-toggle"><a href="#">'.$accordion_toggle_attr_array['title'].'</a></h3>';
        $accordion_output .= '<div class="accordion-container">';
        $accordion_output .= '  <div class="content-block">'.$accordion_toggle_attr_array['content'].'</div>';
        $accordion_output .= '</div><!-- end accordion-container -->';
    }
    $accordion_output .= '</div><!-- end accordion-wrapper -->';
    $accordion_output .= '<div class="clear"></div>';
    return $accordion_output;
}
add_shortcode('accordion', 'accordion_func');

// Shortcode: list
// Usage: [custom_list style="list-1"]List html goes here...[/custom_list]
function custom_list_func( $atts, $content = null ) {
    extract(shortcode_atts(array(
	    'style' => 'list-1',
    ), $atts));
    $content = str_replace('<ul>', '<ul class="'.$style.'">', do_shortcode($content));
    return $content;
}
add_shortcode('custom_list', 'custom_list_func');

// Shortcode: custom_table
// Usage: [custom_table]Table html goes here...[/custom_table]
function custom_table_func( $atts, $content = null ) {
    $content = str_replace('<table', '<table class="custom-table" ', do_shortcode($content));
    return $content;
}
add_shortcode('custom_table', 'custom_table_func');

// Shortcode: custom_frame_left
// Usage: [custom_frame_left]<img src="http://image-url-path-goes-here.jpg"/>[/custom_frame_left]
// Options: shadow="on"
function custom_frame_left_func( $atts, $content = null ) {
    extract(shortcode_atts(array(
	    'shadow' => 'off',
    ), $atts));
    $shadow_class = ($shadow == 'off') ? '': ' frame-shadow';
    $content = preg_replace('/\n|\r|<br>|<br \/>|alignleft|alignright/','',$content); // remove new line and carriage return characters accidentally added by user
    $content = preg_replace('/aligncenter|alignleft|alignright/','alignnone',$content); // replaces the 'aligncenter','alignleft' and 'alignright' classes added to img with 'alignnone'
    return  '<span class="custom-frame alignleft'.$shadow_class.'">' . do_shortcode($content) . '</span>';
}
add_shortcode('custom_frame_left', 'custom_frame_left_func');

// Shortcode: custom_frame_right
// Usage: [custom_frame_right]<img src="http://image-url-path-goes-here.jpg"/>[/custom_frame_right]
// Options: shadow="on"
function custom_frame_right_func( $atts, $content = null ) {
    extract(shortcode_atts(array(
	    'shadow' => 'off',
    ), $atts));
    $shadow_class = ($shadow == 'off') ? '': ' frame-shadow';
    $content = preg_replace('/\n|\r|<br>|<br \/>|alignleft|alignright/','',$content); // remove new line and carriage return characters accidentally added by user
    $content = preg_replace('/aligncenter|alignleft|alignright/','alignnone',$content); // replaces the 'aligncenter','alignleft' and 'alignright' classes added to img with 'alignnone'
    return  '<span class="custom-frame alignright'.$shadow_class.'">' . do_shortcode($content) . '</span>';
}
add_shortcode('custom_frame_right', 'custom_frame_right_func');

// Shortcode: custom_frame_center
// Usage: [custom_frame_center]<img src="http://image-url-path-goes-here.jpg"/>[/custom_frame_center]
// Options: shadow="on"
function custom_frame_center_func( $atts, $content = null ) {
    extract(shortcode_atts(array(
	    'shadow' => 'off',
    ), $atts));
    $shadow_class = ($shadow == 'off') ? '': ' frame-shadow';
    $content = preg_replace('/\n|\r|<br>|<br \/>|alignleft|alignright/','',$content); // remove new line and carriage return characters accidentally added by user
    $content = preg_replace('/aligncenter|alignleft|alignright/','alignnone',$content); // replaces the 'aligncenter','alignleft' and 'alignright' classes added to img with 'alignnone'
    return '<div style="text-align:center;"><span class="custom-frame aligncenter'.$shadow_class.'">' . do_shortcode($content) . '</span></div>';
}
add_shortcode('custom_frame_center', 'custom_frame_center_func');

/* 
 * Shortcode: betterwork_recent_posts
 * Usage: [betterwork_recent_posts]
 * Options: title="Recent Posts" category_id="9" num_posts="3" post_offset="0" num_words_limit="23" show_date_author="1" show_more_link="0" show_thumbs="1" thumb_frame_shadow="1" post_thumb_width="120" post_thumb_height="60"
 */
function betterwork_recent_posts_func( $atts, $content = null) {
    global $wp_widget_factory;
    extract(shortcode_atts(array(
        'title' => esc_html__('Latest Posts', 'betterwork'), 
        'category_id' => '', 
        'num_posts' => 3, 
        'post_offset' => 0, 
        'num_words_limit' => 13,
        'show_date_author' => false,
        'show_more_link' => false,
        'show_thumbs' => true,
        'thumb_frame_shadow' => false,
        'post_thumb_width' => 60,
        'post_thumb_height' => 60
    ), $atts));
    $widget_name = esc_html('Latest_Posts_Widget');
    if (!is_a($wp_widget_factory->widgets[$widget_name], 'WP_Widget')):
        $wp_class = 'WP_Widget_'.ucwords(strtolower($class));
        
        if (!is_a($wp_widget_factory->widgets[$wp_class], 'WP_Widget')):
            return '<p>'.sprintf(__("%s: Widget class not found. Make sure this widget exists and the class name is correct", 'betterwork'),'<strong>'.$class.'</strong>').'</p>';
        else:
            $class = $wp_class;
        endif;
    endif;
    ob_start();
    the_widget( $widget_name, 
       array(
            'title' => esc_html($title),
            'category_id' => $category_id,
            'num_posts' => $num_posts,
            'post_offset' => $post_offset,
            'num_words_limit' => $num_words_limit,
            'show_date_author' => $show_date_author,
            'show_more_link' => $show_more_link,
            'show_thumbs' => $show_thumbs,
            'thumb_frame_shadow' => $thumb_frame_shadow,
            'post_thumb_width' => $post_thumb_width,
            'post_thumb_height' => $post_thumb_height
       ), 
       array(
            'widget_id'=>'arbitrary-instance-'.$id,
            'before_widget' => '<div class="widget widget_latest_posts">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widgettitle">',
            'after_title' => '</h3>' 
        )
    );
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
    
}
add_shortcode('betterwork_recent_posts','betterwork_recent_posts_func'); 


/***************** END SHORTCODES ******************/

/* Widget Settings */

function recent_comment_author_link( $return ) {
	return str_replace( $return, "<span></span>$return", $return );
}
add_filter('get_comment_author_link', 'recent_comment_author_link');

function filter_widget( $params ) {
    switch( _get_widget_id_base($params[0]['widget_id']) ) {
	case 'recent-posts':
	case 'categories':
	case 'archives':
	case 'pages':
	case 'links':
	case 'meta':
	case 'custom-category-widget': // Betterwork: Custom Category
	case 'loginform-widget': // Betterwork: Login Form
	case 'subpages-widget': // Betterwork: Subpages
	case 'nav_menu': // WP 3 widget menu support
	      $params[0]['before_widget'] = str_replace( 'substitute_widget_class', 'custom-formatting', $params[0]['before_widget'] ); // add the 'custom-formatting' class
	      return $params;
	      break;
	case 'rss':
	      $params[0]['before_widget'] = str_replace( 'substitute_widget_class', 'custom-rss-formatting', $params[0]['before_widget'] ); // add the 'custom-formatting' class
	      return $params;
	      break;
	case 'newsletter':
		  $params[0]['before_widget'] = str_replace( 'substitute_widget_class', 'newsletter-custom', $params[0]['before_widget'] ); // add the 'custom-newsletter-formatting' class
	      return $params;
	      break;	  
	default:
	      //var_dump( _get_widget_id_base($params[0]['widget_id']) );
	      //var_dump( $params );
	      return $params;
    }
}
add_filter('dynamic_sidebar_params','filter_widget');

if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => 'Main Sidebar',
		'description' => esc_html__('A widget area, used as a sidebar for pages,post or single story.', 'betterwork'),
		'before_widget' => '<div id="%1$s" class="widget %2$s substitute_widget_class widget-box"><div class="box-top"></div><div class="box-mid"><div class="box-padding">',
		'after_widget' => '</div></div><div class="box-bot"></div></div>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>',
	));
	
	register_sidebar(array(
		'name' => 'Page Sidebar',
		'description' => esc_html__('A widget area, used as a sidebar for regular pages.', 'betterwork'),
		'before_widget' => '<div id="%1$s" class="widget %2$s substitute_widget_class widget-box"><div class="box-top"></div><div class="box-mid"><div class="box-padding">',
		'after_widget' => '</div></div><div class="box-bot"></div></div>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>',
	));
	
	register_sidebar(array(
		'name' => 'Single Story Sidebar',
		'description' => esc_html__('A widget area, used as a sidebar for regular single stories.', 'betterwork'),
		'before_widget' => '<div id="%1$s" class="widget %2$s substitute_widget_class widget-box"><div class="box-top"></div><div class="box-mid"><div class="box-padding">',
		'after_widget' => '</div></div><div class="box-bot"></div></div>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>',
	));
	
	register_sidebar(array(
		'name' => 'Contact Sidebar',
		'description' => esc_html__('A widget area, used as a sidebar for the Contact page.', 'betterwork'),
		'before_widget' => '<div id="%1$s" class="widget %2$s substitute_widget_class widget-box"><div class="box-top"></div><div class="box-mid"><div class="box-padding">',
		'after_widget' => '</div></div><div class="box-bot"></div></div>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>',
	));
	
	register_sidebar(array(
		'name' => '3 Cols Sidebar Home',
		'description' => esc_html__('A widget area, used as a sidebar for quick view on homepage', 'betterwork'),
		'before_widget' => '<div id="%1$s" class="widget %2$s substitute_widget_class widget-box"><div class="box-top"></div><div class="box-mid"><div class="box-padding">',
		'after_widget' => '</div></div><div class="box-bot"></div></div>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>',
	));
	
	register_sidebar(array(
		'name' => 'Donor Sidebar Home',
		'description' => esc_html__('A widget area, used as a sidebar for place Donor Widget.', 'betterwork'),
		'before_widget' => '<div id="%1$s" class="widget %2$s substitute_widget_class">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>',
	));
}

add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');

function optionsframework_custom_scripts() { ?>

<script type="text/javascript">
jQuery(document).ready(function() {

// Contact info	
	jQuery('#is_form_email_contact').parent().click(function() {
  		if (jQuery('#recaptcha_enabled:checked').val() == undefined) {
		jQuery('#section-recaptcha_publickey, #section-recaptcha_privatekey, #section-recaptcha_theme').hide();
		jQuery('#section-email_receipients, #section-recaptcha_enabled').fadeToggle(400);
		} else {
			jQuery('#section-email_receipients, #section-recaptcha_enabled, #section-recaptcha_publickey, #section-recaptcha_privatekey, #section-recaptcha_theme').fadeToggle(400);
			}
	});
	
	if (jQuery('#is_form_email_contact:checked').val() == undefined) {
		jQuery('#section-email_receipients, #section-recaptcha_enabled, #section-recaptcha_publickey, #section-recaptcha_privatekey, #section-recaptcha_theme').hide();
	}
	
	jQuery('#recaptcha_enabled').parent().click(function() {
  		jQuery('#section-recaptcha_publickey, #section-recaptcha_privatekey, #section-recaptcha_theme').fadeToggle(400);
	});
	
	if (jQuery('#recaptcha_enabled:checked').val() == undefined) {
		jQuery('#section-recaptcha_publickey, #section-recaptcha_privatekey, #section-recaptcha_theme').hide();
	}


});
</script>

<?php
}


?>