<?php
/**
 * @package WordPress
 * @subpackage Betterwork
 */
 /**
 * Template Name: Full-width page
 */
?>
<?php get_header(); ?>

    <div class="container">
    <div class="box-outer">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<article class="cat-article">
		<h1 class="pagetitle"><?php the_title(); ?></h1>
    <div class="single_article_content">
        <?php the_content(); ?>
    </div> <!--Single Article content-->
    </article> <!--End Single Article-->
    <?php 
	    endwhile; endif;
	?>
    </div> <!--Box Outer-->
    
 </div> <!--End Container-->
 <?php get_footer(); ?>