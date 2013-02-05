<?php
/**
 * @package WordPress
 * @subpackage Betterwork
 */
/**
 * Template Name: Landing category page
 */
?>

<?php get_header(); ?>
    <?php $cat_selectd = get_post_meta( $post->ID, '_cmb_cat_landingpage', true ); ?>
	
    <div class="container">
    <h1 class="pagetitle"><?php the_title(); ?></h1>
    
    <?php //include( O2_INCLUDES . '/cycle-landing-cat.php' ); ?>
    
    <script type="text/javascript">
    // Cycle plugin config
    jQuery(document).ready(function($){

            $('.cat-slideshow').cycle({ 
                    fx:     '<?php if ( of_get_option('cycle_effect') != '' ) { echo of_get_option('cycle_effect'); } else { echo 'fade'; } ?>', 
					easing: '<?php if ( of_get_option('cycle_ease') != '' ) { echo of_get_option('cycle_ease'); } else { echo 'easeInOutBack'; } ?>',
					speed: <?php if ( of_get_option('cycle_speed') != '' ) { echo of_get_option('cycle_speed'); } else { echo '1000'; } ?>,
					timeout: <?php if ( of_get_option('cycle_timeout') != '' ) { echo of_get_option('cycle_timeout'); } else { echo '5000'; } ?>,
                    pause:   1
            });
    });
    </script>

    <div class="cat-slideshow">
    <?php

    query_posts("cat=$cat_selectd[0]&posts_per_page=3");

    if (have_posts()) : 
            while (have_posts()) : the_post();
    ?>
            <div class="slide-items">
    <?php	
            $post_image_url = get_post_meta($post_id, 'post_image', true);
            if ( has_post_thumbnail( $post_id ) ) :
                    $tmp_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'single-post-thumbnail' );
            $post_image_url = $tmp_image[0];
            endif;	
			
			if ( is_rtl() ) : 
				$align = 'alignright'; 
			else: 
				$align = 'alignleft';
			endif;				

            if ( $post_image_url ) :
                    echo '<div class="cat-shadow-box '.$align.'">';
                    echo '<a href="'.get_permalink( $post_id ).'" title="' . esc_attr( get_post_field( 'post_title', $post_id ) ) . '">';
                    echo '<img src="'.betterwork_process_image( $post_image_url, 500, 300, 1, 100 ).'" alt="' . esc_attr( get_post_field( 'post_title', $post_id ) ) . '" class="custom-frame-round" />';	
                    echo '</a></div>';
            endif; ?>    
        	<span class="cat-slidename"><?php echo get_cat_name($cat_selectd[0]); ?>:</span>
            <h2><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
        <span class="postmeta-date"><?php  echo '&mdash; ' . get_the_date(); ?></span>
    <?php	
            the_excerpt();
            if ( of_get_option('readmore_link') != '' ) {
                    echo do_shortcode('[read_more text="'. of_get_option('readmore_link').'" title="'. of_get_option('readmore_link') .'" url="'.get_permalink().'" align="left"]');
                    echo '<div class="clear"></div>';
            } ?>
        </div>
        <!--End slide items -->
    <?php	
            endwhile; ?>

    <?php    
    else: ?>
            <div class="non-widget">
                    <h3>About this Slideshow</h3>
                    <ul>
                    <li><?php _e('Go to to admin backend <strong><em> -&gt; edit this page</em></strong>', 'betterwork'); ?></li>
                    <li><?php _e('Select Category name under <strong><em>Slideshow option</em></strong>', 'betterwork'); ?></li>
                    </ul>
            </div> 

    <?php
    endif; 
    wp_reset_query();
    ?> 

    </div>
    <!--End Category Slidesohw-->
    
    <div class="main">
    	<div class="wrap-box-shadow">
            <div class="box-outer">
        	
        <?php 
			$cat_tabs = array();
			$cat_tab1 = get_post_meta( $post->ID, '_cmb_cat_tab1', true );
			$cat_tab2 = get_post_meta( $post->ID, '_cmb_cat_tab2', true );
			$cat_tab3 = get_post_meta( $post->ID, '_cmb_cat_tab3', true );
			if (!empty($cat_tab1)) {
			  array_push( $cat_tabs, $cat_tab1 );
			}
			if (!empty($cat_tab2)) {
			  array_push( $cat_tabs, $cat_tab2 );
			}
			if (!empty($cat_tab3)) {
			  array_push( $cat_tabs, $cat_tab3 );
			}
			
        ?>
             <div class="cat-tabs-wrapper">             
             <table class="tabs">
                 <tr>
        <?php        
              $tabname_num = 1;
              foreach($cat_tabs as $cat){
                  
        ?>
                 <td><a href="javascript:void(0)" <?php if ($tabname_num <= 1) echo 'class="defaulttab"'; ?> rel="tab<?php echo $tabname_num; ?>"><span><?php echo get_cat_name($cat); ?></span></a></td>
        <?php     
                  $tabname_num++;	
              }
        ?>
                 </tr>
             </table>
             <!--End header tabs-->    
       <?php 
            $tabdetail_num = 1;
            foreach( $cat_tabs  as $tab_detail){ 
                $num_posts_query = new WP_Query( "cat=$tab_detail&showposts=1" ); 

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
                    <div class="clear"></div>
                </div>
            </div>
            <?php endif; 
                    wp_reset_postdata(); 
                  
                $tabdetail_num++;
            }      
            ?>      
             </div>
       
            </div><!--End Box outer-->
        </div>
        <!--End wrap-box-shadow-->
        
        
    </div> <!--End Main-->
    
    <?php get_sidebar(); ?>
    
    </div> <!--End Container-->
<?php get_footer(); ?>