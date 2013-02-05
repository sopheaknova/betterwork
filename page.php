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
    <div class="single_article_content">
        <?php the_content(); ?>
    </div> <!--Single Article content-->
    </article> <!--End Single Article-->
    <?php 
	    endwhile; endif;
	?>
    </div> <!--Box Outer-->
    </div> <!--End Wrap box shadow-->
    </div> <!--End Main-->
    
    <?php get_sidebar(); ?>

 </div> <!--End Container-->
 <?php get_footer(); ?>