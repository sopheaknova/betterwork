<?php
/**
 * @package WordPress
 * @subpackage Betterwork
 */
?>
<?php get_header(); ?>

<?php
	include O2_FUN . '/ylsy_search_excerpt.php';
	query_posts($query_string . '&showposts=10');
?>

    <div class="container">
    <div class="main">
    <?php if (have_posts()) : ?>
    	
	    <div class="wrap-box-shadow">
    	<div class="box-outer">
		<h1 class="pagetitle"><?php printf( __('Search Results for &#8216;<em>%s</em>&#8217;', 'betterwork' ), get_search_query() ); ?></h1>
		
		<?php while (have_posts()) : the_post(); ?>
			<article class="cat-article">
			<?php
				$title = get_the_title();
				$search_term = preg_replace('/\/|\+|\*|\[|\]/iu','',$s);
				$keys= explode(" ",$search_term);
				$title = preg_replace( '/('.implode('|', $keys) .')/iu', '<strong class="search-excerpt">\0</strong>', $title );
			?>
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
				
				<?php
				    $excerpt = new SearchExcerpt();
                    echo strip_shortcodes( $excerpt->the_excerpt( get_the_excerpt() ) );
				?>
                
			</article>

		<?php endwhile; ?>
        </div> <!--Box Outer-->
        </div> <!--End Wrap box shadow-->
		    
        <div class="clear"></div>

		<?php // Pagination
		    if(function_exists('wp_pagenavi')) :
			wp_pagenavi();
		    else : ?>
			<div class="navigation">
				<div class="alignleft"><?php previous_posts_link() ?></div>
				<div class="alignright"><?php next_posts_link() ?></div>
			</div>
		<?php endif; ?>

	<?php else : ?>
    	<div class="wrap-box-shadow">
    	<div class="box-outer">
		<h2 class="center"><?php esc_html_e("Didn't find what you were looking for? Refine your search again!", 'betterwork'); ?></h2>
        </div> <!--Box Outer--> 
        </div> <!--End Wrap box shadow-->
		<div class="clear"></div>
	<?php endif; ?>
    
    
    </div> <!--End Main-->
    
    <?php get_sidebar(); ?>
    
     </div> <!--End Container-->
 <?php get_footer(); ?>