<?php
/**
 * @package WordPress
 * @subpackage Betterwork
 */
/**
 * Template Name: Archives
 */
?>

<?php get_header(); ?>

    <div class="container">
    <div class="main">
    <div class="wrap-box-shadow">
    <div class="box-outer">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<article class="cat-article">
		<h1 class="pagetitle"><?php esc_html_e('Archive Index Page', 'betterwork'); ?></h1>
        <div class="single_article_content">
            <?php the_content(__('<p class="serif">Read the rest of this entry &raquo;</p>', 'betterwork')); ?>
           
        </div> <!--Single Article content-->
    </article> <!--End Single Article-->
     <?php 
	    endwhile; endif;
	?>
        
    <h2><?php esc_html_e('Archives by Year:', 'betterwork'); ?></h2>
    <ul class="list-10">
    <?php wp_get_archives('type=yearly'); ?>
    </ul>

    <h2><?php esc_html_e('Archives by Month:', 'betterwork'); ?></h2>
    <ul class="list-10">
    <?php wp_get_archives('type=monthly'); ?>
    </ul>

    <h2><?php esc_html_e('Archives by Subject:', 'betterwork'); ?></h2>
    <ul class="list-10">
    <?php wp_list_categories(); ?>
    </ul>
    </div> <!--Box Outer-->
    </div> <!--End Wrap box shadow-->
    </div> <!--End Main-->
    
    <?php get_sidebar(); ?>
    
    </div> <!--End Container-->
<?php get_footer(); ?>