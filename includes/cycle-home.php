<script type="text/javascript">
// Cycle plugin config
jQuery(document).ready(function($){
    
	$('.inner-slide').cycle({ 
		fx:     '<?php if ( of_get_option('cycle_effect') != '' ) { echo of_get_option('cycle_effect'); } else { echo 'fade'; } ?>', 
		easing: '<?php if ( of_get_option('cycle_ease') != '' ) { echo of_get_option('cycle_ease'); } else { echo 'easeInOutBack'; } ?>',
		speed: <?php if ( of_get_option('cycle_speed') != '' ) { echo of_get_option('cycle_speed'); } else { echo '1000'; } ?>,
     	timeout: <?php if ( of_get_option('cycle_timeout') != '' ) { echo of_get_option('cycle_timeout'); } else { echo '5000'; } ?>,
		pause:   1,
		pager:	'#pager'
	});
});
</script>

<div id="slideshow">
	<div class="slide-container">
    <div class="inner-slide">
    
	<?php
    query_posts("post_type=slideshow&posts_per_page=5");
    
    if (have_posts()) : while (have_posts()) : the_post();
		
		$img_slide_link = get_post_meta($post->ID, '_cmb_url_slideshow', true);
		if (has_post_thumbnail()) :
    ?>  
    <?php if($img_slide_link) :    ?>
        <a href="<?php echo $img_slide_link; ?>"><?php the_post_thumbnail('homeslide-thumb', array('class' => 'custom-frame-round')); ?></a>
    <?php 	else: 
				the_post_thumbnail('homeslide-thumb', array('class' => 'custom-frame-round'));
			endif;
		endif;
		
		endwhile; 
	else: ?>
	<?php $img_slide_src = O2_IMG . '/952x330-slide-01.gif'; ?>
    <img src="<?php echo betterwork_process_image( $img_slide_src, 952, 330, 1, 100 ); ?>" alt="<?php esc_attr( the_title() ); ?>" />
    
    <?php
	endif; 
	wp_reset_query();
	?> 
    
    </div>
    </div>
    <!--End Slide Container-->
    <div class="slide-nav">
    	<div id="pager"></div>
    </div>
</div>
<!--End Slidesohw-->    