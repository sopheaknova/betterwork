<div class="latest-updated">
	<?php 
    $latest_updated = array();
    if (of_get_option('show_tab1')) : 
        $tab1 = of_get_option('tab_1');
        array_push( $latest_updated, $tab1 );
    endif;		
    
    if (of_get_option('show_tab2')) :
        $tab2 = of_get_option('tab_2');
        array_push( $latest_updated, $tab2 );
    endif;
        
    if (of_get_option('show_tab3')) :
        $tab3 = of_get_option('tab_3');
        array_push( $latest_updated, $tab3 );
    endif;
        
    if (of_get_option('show_tab4')) : 
        $tab4 = of_get_option('tab_4');
        array_push( $latest_updated, $tab4 );
    endif;	
        
    if (of_get_option('show_tab5')) : 
        $tab5 = of_get_option('tab_5');
        array_push( $latest_updated, $tab5 );
    endif;
    ?>
    
    <h3><?php echo of_get_option('latest_update_txt'); ?></h3>
    <?php if ($latest_updated) : ?>
    <div class="tabs-wrapper">
        <ul class="tabs">
    
    <?php
		$tabname_num = 1; 
		foreach( $latest_updated  as $tabname){ ?>
        <li><a href="javascript:void(0)" <?php if ($tabname_num <= 1) echo 'class="defaulttab"'; ?> rel="tab<?php echo $tabname_num; ?>"><?php echo get_cat_name($tabname); ?></a></li>
    <?php
        $tabname_num++;		
        }
        
        $tabdetail_num = 1;
    ?>
            
            
        </ul>
        
     <?php foreach( $latest_updated  as $tab_detail){ ?>
     <?php $num_posts_query = new WP_Query( "cat=$tab_detail&showposts=3" ); 
        
            if( $num_posts_query->have_posts()) : ?>   
            
        <div class="tab-content" id="tab<?php echo $tabdetail_num; ?>">
            <div class="tabs-inner-padding">
                <ul class="small-thumb">
                <?php while( $num_posts_query->have_posts()) : $num_posts_query->the_post();
                    update_post_caches($posts); ?>
                    <li>
                    <a class="teaser-title" title="<?php the_title(); ?>" href="<?php the_permalink() ?>"><?php the_title(); ?></a>
                    <div class="date-author">&mdash; <?php printf( __('%1$s by %2$s ', 'betterwork'), get_the_date(), betterwork_get_the_author_page_link() ); ?></div>
                    
                        <div class="clear"></div>
                    </li>
                <?php endwhile; ?>
                </ul>
                <a class="learn-more" href="<?php echo esc_url(get_category_link($tab_detail)); ?>"><?php echo of_get_option('see_all_txt'); ?> <?php echo get_cat_name($tab_detail); ?></a>
            </div>
        </div>
        <?php endif; 
                wp_reset_postdata(); 
        
        $tabdetail_num++		
        ?>
        
     <?php } ?>   
    </div>
    <!-- End tabs -->
    <div class="clear"></div>
    
    <?php 
	else: 
		echo of_get_option('latest_update_desc');
	endif; 
	?>
</div>
<!-- End Letest Updated -->