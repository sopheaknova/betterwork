    </div>
    <!--End Inner-->
    </div>
    <!-- End wrapper middle -->
    </div>
    <!--End Wraper-->

	<div class="bot-wrapper">
    	<div class="inner-bot-wrapper">
        	<img src="<?php echo O2_IMG.'/bg-bot-wrapper.png'; ?>" width="1080" height="84" />
        </div>
    </div>
    <!--End wrapper bottom-->
    
    <footer>
    <div class="footer-wrapper">
    <div class="inner">
    <div class="footer-content">
        <div class="copyright">
        <?php bw_footer_nav(); // this function calls the footer menu ?>
        
        <?php if ( of_get_option('copyrights') !== '' ) : ?>
        <div><?php echo of_get_option('copyrights'); ?>	</div>
        <?php else: ?>        
        <div>&copy; <?php echo Date('Y') ?> Betterwork. All rights reserveds.</div>
        <?php endif; ?>
        </div>
        <!--End Footer Menu and Copyright-->
        
        <div class="social-network">
            <span><?php echo of_get_option('join_us_text'); ?> </span>
            <?php if (of_get_option('facebook_url')) : ?>
            <a href="<?php echo of_get_option('facebook_url'); ?>" target="_blank" title="Facebook"><img src="<?php echo O2_IMG.'/common-images/facebook-icon.png'; ?>" width="32" height="32" /></a>
            <?php endif; ?>
            <?php if (of_get_option('youtube_url')) : ?>
            <a href="<?php echo of_get_option('youtube_url'); ?>" target="_blank" title="Youtube"><img src="<?php echo O2_IMG.'/common-images/you-tube-icon.png'; ?>" width="32" height="32" /></a>
            <?php endif; ?>
            <?php if (of_get_option('twitter_url')) : ?>
            <a href="<?php echo of_get_option('twitter_url'); ?>" target="_blank" title="Twitter"><img src="<?php echo O2_IMG.'/common-images/twitter-icon.png'; ?>" width="32" height="32" /></a>
            <?php endif; ?>
            <?php if (of_get_option('linkedin_url')) : ?>
            <a href="<?php echo of_get_option('linkedin_url'); ?>" target="_blank" title="Linkedin"><img src="<?php echo O2_IMG.'/common-images/linkedin-icon.png'; ?>" width="32" height="32" /></a>
            <?php endif; ?>
            <a href="<?php if (of_get_option('feedburner')) { echo of_get_option('feedburner'); } else { bloginfo( 'rss2_url' ); } ?>" target="_blank" title="RSS Feed"><img src="<?php echo O2_IMG.'/common-images/rss-icon.png'; ?>" width="32" height="32" /></a>
        </div>
        <!--End Social network-->
    </div>
    <!--End sub footer-->
    
    <div class="poweredby">
    <a href="<?php echo of_get_option('footer_url_custom_logo1'); ?>" target="_blank">
    <?php if (of_get_option('footer_custom_logo1')) : ?>
    	<img src="<?php echo of_get_option('footer_custom_logo1'); ?>" />
    <?php else: ?>
    	<img src="<?php echo O2_IMG.'/ilo-logo.png'; ?>" />
    <?php endif; ?>  
    </a>
    <a href="<?php echo of_get_option('footer_url_custom_logo2'); ?>" target="_blank">
    <?php if (of_get_option('footer_custom_logo2')) : ?>
    	<img src="<?php echo of_get_option('footer_custom_logo2'); ?>" />
    <?php else: ?>
    	<img src="<?php echo O2_IMG.'/ifc-logo.png'; ?>" />
    <?php endif; ?>  
    </a>  
    </div>
    <!--End Powered by-->
    
    </div>
    <!--End inner-->
    </div>
    <!--End wrapper footer-->
    </footer>
    <!--End Footer-->
    
    

<?php wp_footer(); ?>

<?php if(of_get_option('scroll_top_bt') != false) { ?>
<div class="scrollTo_top">
    <a title="<?php _e('Scroll to top', 'theme'); ?>" href="#">
    	<?php if(of_get_option('scroll_top_bt_img')){ ?>
	<img src="<?php echo of_get_option('scroll_top_bt_img'); ?>" alt="<?php _e('Scroll to top', 'theme'); ?>" />
	<?php } else { ?>
    <img src="<?php echo O2_IMG; ?>/up.png" alt="<?php _e('Scroll to top', 'theme'); ?>">
    <?php } ?>
    </a>
</div>
<?php } ?>

<?php echo of_get_option('footer_script'); ?>

</body>

</html>