<?php
/**
 * @package WordPress
 * @subpackage Betterwork
 */
?>
<?php get_header(); ?>

    <div class="container">
    <div class="main">
    <div class="wrap-box-shadow">
    <div class="box-outer">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<article class="cat-article">
		<h1 class="pagetitle"><?php the_title(); ?></h1>
        <div class="postmetadata">
            <?php if( of_get_option('show_postmetadata_authors')) : ?>
            <span class="postmeta-date"><?php  echo get_the_date() ; ?></span>
            <span class="postmeta-author"><?php echo betterwork_get_the_author_page_link(); ?></span>
            <?php else : ?>
            <span class="postmeta-date"><?php  echo get_the_date(); ?></span>
          
            <?php endif; ?>
            </span>
            <span class="postmeta-cat"><?php printf( __('In category: ', 'betterwork') ); ?> <?php the_category(', '); ?></span> &nbsp; / &nbsp; 
			<span class="postmetat-comment"><?php comments_popup_link( __( 'Leave a comment', 'betterwork' ), __( '1 Comment', 'betterwork' ), __( '% Comments', 'betterwork' ) ); ?> </span>
			<?php edit_post_link(__('Edit', 'betterwork'), '<div style="float:right;margin:0 10px;">', '</div>'); ?>  
			<?php echo ( of_get_option('show_postmetadata_tags') ) ? the_tags(__('<div>Tags: ', 'betterwork'), ', ', '</div>') : ''; ?>
            <div class="clear"></div>
        </div>
        
    <div class="single_article_content">
        <?php the_content(); ?>
    </div> <!--Single Article content-->
    </article> <!--End Single Article-->
    <?php 
	    	endwhile; 
		else: 
	?>
    	<p><?php esc_html_e("Sorry, no posts matched your criteria.", 'betterwork'); ?></p>    
    <?php    
		endif;
	?>
    
    </div> <!--Box Outer-->
    </div> <!--End Wrap box shadow-->
    <?php comments_template(); ?>
    </div> <!--End Main-->
    
    <?php get_sidebar(); ?>
    
    </div> <!--End Container-->
<?php get_footer(); ?>