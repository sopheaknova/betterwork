<?php get_header(); ?>

	<?php include( O2_INCLUDES . '/cycle-home.php' ); ?>
    
    <div id="sidebar-home-3col">
        
        <?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('3 Cols Sidebar Home')){ }else { ?>
         <div class="non-widget">
            <h3>About this Sidebar</h3>
            <ul>
            <li><?php _e('Go to admin backend <strong><em> -&gt; Widgets</em></strong>', 'betterwork'); ?></li>
            <li><?php _e('And place widgets into the <strong><em>3 Cols Sidebar Home</em></strong>', 'betterwork'); ?></li>
            </ul>
         </div>   
         <?php } ?>
        
    </div>
    <!--End Home Sidebar 3 Cols-->
    
    <div id="quick-view">
    <div class="donors-widget">
        <?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('Donor Sidebar Home')){ }else { ?>
         <div class="non-widget">
            <h3>About this Sidebar</h3>
            <ul>
            <li><?php _e('Go to admin backend <strong><em> -&gt; Widgets</em></strong>', 'betterwork'); ?></li>
            <li><?php _e('And place widgets into the <strong><em>Donor Sidebar Home</em></strong>', 'betterwork'); ?></li>
            </ul>
         </div>   
         <?php } ?>
    </div>
    <!-- End Donor -->
        
        <?php include( O2_INCLUDES . '/latest-updated.php' ); ?>
    
    </div>
    <!-- End Quick view -->
    
<?php get_footer(); ?>