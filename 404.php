<?php
/**
 * @package WordPress
 * @subpackage Betterwork
 */
?>
<?php get_header(); ?>

    <div class="container">
    <div class="full-width">
    <div class="wrap-box-shadow">
    <div class="box-outer">
    <h1 class="pagetitle"><?php esc_html_e('Page Not Found (Error 404)', 'betterwork'); ?></h1>
    
    <h2 class="center warning"><div class="msg-box-icon pngfix"><?php esc_html_e('Oops..., I cannot find that page you are looking for, sorry... (Error 404)', 'betterwork'); ?></div></h2>

		<div class="grid_18 prefix_2 suffix_2">
		<h3><?php esc_html_e('Let me help you find it:', 'betterwork'); ?></h3>
		    <ol>
			<li>
			    <?php _e('<strong>Search</strong> for it:', 'betterwork'); ?>
			    <?php get_search_form(); ?>
			</li>
			<li>
			    <?php _e('<strong>If you typed in a URL...</strong> check the spelling and try reloading the page.', 'betterwork' ); ?>
			</li>
			<li>
			<?php printf( __('<strong>Start over again</strong> with the %1$sHomepage%2$s.', 'betterwork'), '<a href="'.get_bloginfo('url').'">', '</a>' ); ?>
			    
			</li>
		    </ol>
         </div>   
    
    </div> <!--End Box Outer-->
    </div> <!--End Wrap box shadow-->
    </div> <!--End Full Width-->
    
     </div> <!--End Container-->
 <?php get_footer(); ?>