<?php
/**
 * @package WordPress
 * @subpackage Betterwork
 */

get_header();

$curauth = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));
?>

    <div class="container">
    <div class="main">
    <div class="wrap-box-shadow">
    <div class="box-outer">
    	<article class="cat-article">
            <h1 class="pagetitle"><?php esc_html_e('Author Archive', 'betterwork'); ?></h1>
            <h2 class="margin-top-3"><?php esc_html_e('About:', 'betterwork'); ?> <?php echo $curauth->display_name; ?></h2>
            <p>
                <span class="custom-frame alignleft"><?php echo get_avatar($curauth->user_email, 100); ?></span>
                <strong><?php esc_html_e('Profile:', 'betterwork'); ?></strong> <br />
                <?php echo $curauth->user_description; ?>
            </p>
            <div class="clear"></div>
            <h2><?php esc_html_e('Posts by', 'betterwork'); ?> <?php echo $curauth->display_name; ?>:</h2>
<?php       if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <ul class="list-11">
                    <li>
                        <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a> (<?php echo get_the_date(); ?> - <?php the_category('&');?>)
                    </li>
                </ul>
<?php       endwhile; else: ?>
                <p><?php esc_html_e('No posts by this author.', 'betterwork'); ?></p>
<?php       endif; ?>
	    <div class="clear"></div>
<?php	    edit_post_link(esc_html__('Edit this entry.', 'betterwork'), '<p class="editLink">', '</p>'); ?>
		</article> <!--End Single Article-->
	</div> <!--Box Outer-->
    </div> <!--End Wrap box shadow-->
    </div> <!--End Main-->
    
    <?php get_sidebar(); ?>
    
    </div> <!--End Container-->
<?php get_footer(); ?>