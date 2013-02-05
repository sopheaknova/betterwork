<?php
/**
 * @package WordPress
 * @subpackage Betterwork
 */
?>
<?php get_header(); ?>

    <div class="container">
    <div class="main">
    <?php if (have_posts()) : ?>
    <div class="wrap-box-shadow">
    <div class="box-outer">
	<h1 class="pagetitle">
	<?php if ( is_day() ) : ?>
		<?php printf( __( 'Daily Archives: %s', 'betterwork' ), '<span>' . get_the_date() . '</span>' ); ?>
    <?php elseif ( is_month() ) : ?>
        <?php printf( __( 'Monthly Archives: %s', 'betterwork' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'betterwork' ) ) . '</span>' ); ?>
    <?php elseif ( is_year() ) : ?>
        <?php printf( __( 'Yearly Archives: %s', 'betterwork' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'betterwork' ) ) . '</span>' ); ?>
    <?php else : ?>
        <?php printf( __('Archive for the &#8216;%s&#8217; Category', 'betterwork' ), single_cat_title("", false) );  ?>
    <?php endif; ?>
    </h1>
    
    <?php
		$category_description = category_description();
		if ( ! empty( $category_description ) )
			echo apply_filters( 'category_archive_meta', '<div class="category-archive-meta">' . $category_description . '</div>' );
	?>
	
    <?php 		while (have_posts()) : the_post(); ?>
	<article class="cat-article">
		<h2><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
        <div class="postmetadata">
            <?php if( of_get_option('show_postmetadata_authors')) : ?>
            <span class="postmeta-date"><?php  echo get_the_date() ; ?></span>
            <span class="postmeta-author"><?php echo betterwork_get_the_author_page_link(); ?></span>
            <?php else : ?>
            <span class="postmeta-date"><?php  echo get_the_date(); ?></span>
          
            <?php endif; ?>
            </span>
            <span class="postmeta-cat"><?php printf( __('In category: ', 'betterwork') ); ?> <?php the_category(', '); ?></span> &nbsp; / &nbsp; 
			<span class="postmeta-comment"><?php comments_popup_link( __( 'Leave a comment', 'betterwork' ), __( '1 Comment', 'betterwork' ), __( '% Comments', 'betterwork' ) ); ?> </span>
			<?php edit_post_link(__('Edit', 'betterwork'), '<div style="float:right;margin:0 10px;">', '</div>'); ?>  
			<?php echo ( of_get_option('show_postmetadata_tags') ) ? the_tags(__('<div>Tags: ', 'betterwork'), ', ', '</div>') : ''; ?>
            <div class="clear"></div>
        </div>
        
    <div class="single_article_content">
	<?php // Post Image
          display_post_image_fn( $post->ID, true ); ?>
         
	<?php if ( of_get_option('show_excerpt') !== '') {
	        the_excerpt();
        	if ( of_get_option('readmore_link') !== '' ) {
            echo do_shortcode('[read_more text="'. of_get_option('readmore_link').'" title="'. of_get_option('readmore_link') .'" url="'.get_permalink().'" align="left"]');
            echo '<div class="clear"></div>';
        	}
    } else {
        the_content( of_get_option('readmore_link') );
    } ?>
        
    </div> <!--Single Article content-->
    
    </article> <!--End Single Article-->

    <?php endwhile; ?>
	</div> <!--Box Outer-->
    </div> <!--End Wrap box shadow-->
    <?php 		
		// Pagination
		if(function_exists('wp_pagenavi')) :
		    wp_pagenavi();
		else : ?>
		    <div class="navigation">
			    <div class="alignleft"><?php previous_posts_link() ?></div>
			    <div class="alignright"><?php next_posts_link() ?></div>
		    </div>
    <?php endif;
		else:
	?>
    <div class="wrap-box-shadow">
    <div class="box-outer">
    <?php	
		if ( is_category() ) { // If this is a category archive
			printf(__("<h2 class='center'>Sorry, but there aren't any posts in the %s category yet.</h2>", 'betterwork'), single_cat_title('',false));
		} else if ( is_date() ) { // If this is a date archive
			_e("<h2>Sorry, but there aren't any posts with this date.</h2>", 'betterwork');
		} else if ( is_author() ) { // If this is a category archive
			$userdata = get_userdatabylogin(get_query_var('author_name'));
			printf(__("<h2 class='center'>Sorry, but there aren't any posts by %s yet.</h2>", 'betterwork'), $userdata->display_name);
		} else {
			_e("<h2 class='center'>No posts found.</h2>", 'betterwork');
		}
	?>
    </div> <!--Box Outer-->	
    </div> <!--End Wrap box shadow-->
	<?php	
	    endif; 
			wp_reset_query();
		
	?>
    
    </div> <!--End Main-->
    
    <?php get_sidebar(); ?>
    
    </div> <!--End Container-->

<?php get_footer(); ?>