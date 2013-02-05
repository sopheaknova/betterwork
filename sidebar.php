	<aside class="sidebar">
     <?php global $wp_query; $postid = $wp_query->post->ID; $cus = get_post_meta($postid, 'sbg_selected_sidebar_replacement', true);?>
	<?php if ($cus != '') { ?>
        <?php if ($cus[0] != '0') { ?>
             <?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar($cus[0])){ }else { ?>
             <div class="custom-formatting">
             <h3>About This Sidebar</h3>
        	<p class="noside"><?php _e('To edit this sidebar, go to admin backend\'s <strong><em>Appearance -&gt; Widgets</em></strong> and place widgets into the <strong><em>'.$cus[0].'</em></strong> Widget Area', 'uexpress'); ?></p>
            </div>
         <?php } ?>
	<?php } else { ?>
         <?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('Main sidebar')){ }else { ?>
         <div class="non-widget">
         	<h3>About this Sidebar</h3>
        	<ul>
            <li><?php _e('Go to admin backend <strong><em> -&gt; edit this page/post</em></strong>', 'uexpress'); ?></li>
            <li><?php _e('Select Sidebar name under <strong><em>Sidebar Panel</em></strong>', 'uexpress'); ?></li>
            <li><?php _e('<strong><em>Appearance -&gt; Widgets</em></strong> and place widgets into the <strong><em>Sidebar</em></strong> you selected', 'uexpress'); ?></li>
            </ul>
         </div>   
         <?php } ?>
	<?php } ?>
        <?php } else { ?>
         <?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('Main sidebar')){ }else { ?>
         <div class="non-widget">
        	<h3>About this Sidebar</h3>
        	<ul>
            <li><?php _e('Go to admin backend <strong><em> -&gt; edit this page/post</em></strong>', 'uexpress'); ?></li>
            <li><?php _e('Select Sidebar name under <strong><em>Sidebar Panel</em></strong>', 'uexpress'); ?></li>
            <li><?php _e('<strong><em>Appearance -&gt; Widgets</em></strong> and place widgets into the <strong><em>Sidebar</em></strong> you selected', 'uexpress'); ?></li>
            </ul>
         </div>   
         <?php } ?>
    <?php } ?>
    
    </aside> <!--End Sidebar-->
