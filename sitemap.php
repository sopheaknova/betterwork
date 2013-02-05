<?php
/**
 * @package WordPress
 * @subpackage Betterwork
 */
/**
 * Template Name: Sitemap page
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
        <div class="single_article_content">
            <?php the_content(__('<p class="serif">Read the rest of this entry &raquo;</p>', 'betterwork')); ?>
           
        </div> <!--Single Article content-->
    </article> <!--End Single Article-->
     <?php 
	    endwhile; endif;
	?>
        
    <?php		if (have_posts()) : while (have_posts()) : the_post();
		    the_content();
		endwhile; endif; ?>
		
		<div class="one_third">
			<h3><?php esc_html_e('Site Feeds', 'betterwork'); ?></h3>
			<ul class="list-10">
				<li><a href="<?php bloginfo('rss2_url'); ?>"><?php esc_html_e('Main RSS Feed', 'betterwork'); ?></a></li>
				<li><a href="<?php bloginfo('comments_rss2_url'); ?>"><?php esc_html_e('Comments RSS Feed', 'betterwork'); ?></a></li>
			</ul>

			<h3><?php esc_html_e('Pages', 'betterwork'); ?></h3>
			<ul class="list-10">
				<li><a href="<?php bloginfo('url'); ?>">Home</a></li>
				<?php wp_list_pages('title_li='); ?>
			</ul>

			<h3><?php esc_html_e('Categories', 'betterwork'); ?></h3>
			<ul class="list-10">
				<?php wp_list_categories('title_li='); ?>
			</ul>

			<h3><?php esc_html_e('Monthly Archives', 'betterwork'); ?></h3>
			<ul class="list-10">
				<?php wp_get_archives('type=monthly'); ?>
			</ul>
<?php			if ( function_exists('wp_tag_cloud') ) : ?>
			    <h3><?php esc_html_e('Tags', 'betterwork'); ?></h3>
<?php			    echo preg_replace('/class=\"(.*?)\"|class=\'(.*?)\'/', 'class="list-10"', wp_tag_cloud('smallest=9&largest=9&format=list&echo=0'));
			endif; ?>
		</div>

		<div class="one_third last_column">
			<h3><?php esc_html_e('All Articles', 'betterwork'); ?></h3>
			<ol class="list-2">
<?php			    query_posts('showposts=-1');
			    if (have_posts()) : while (have_posts()) : the_post(); ?>
				<li style="margin-bottom:10px;"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a><br /><?php the_time('j-M-y') ?> &bull; <?php the_author_posts_link(); ?> &bull; <?php comments_popup_link( __( '0 Comment', 'betterwork' ), __( '1 Comment', 'betterwork' ), __( '% Comments', 'betterwork' ) ); ?></li>
<?php			    endwhile; endif; ?>
                        </ol>
		</div>
	    <div class="clear"></div>
            
<?php	    //Reset Query
	    wp_reset_query(); ?>
    </div> <!--Box Outer-->
    </div> <!--End Wrap box shadow-->
    </div> <!--End Main-->
    
    <?php get_sidebar(); ?>
    
    </div> <!--End Container-->
<?php get_footer(); ?>