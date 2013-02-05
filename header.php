<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<?php
//show description
o2_show_description();
//Stylesheet
o2_create_stylesheet();
?>
<?php if ( of_get_option('custom_favicon') ) : ?>
<link rel="shortcut icon" href="<?php echo of_get_option('custom_favicon'); ?>" />
<?php else: ?>
<link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/favicon.ico" />
<?php endif; ?>

<!-- feeds, pingback -->
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo( 'name' ); ?> RSS Feed" href="<?php if (of_get_option('feedburner')) { echo of_get_option('feedburner'); } else { bloginfo( 'rss2_url' ); } ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<div class="wrapper">
<div class="top-wrapper"></div>
<div class="mid-wrapper">
    <div class="inner">
    
    
    <header>
        <div id="logo">
        <h1><a href="<?php echo home_url(); ?>">
        <?php if (of_get_option('logo_img')) : ?>
        <img src="<?php echo of_get_option('logo_img'); ?>" align="<?php bloginfo( 'name' ); ?>" />
        <?php else: ?>
        <img src="<?php echo O2_IMG.'/logo.png'; ?>" align="<?php bloginfo( 'name' ); ?>" />
        <?php endif; ?>
        </a><span><?php bloginfo( 'name' ); ?></span></h1>
        </div>
        <!--End Logo-->
        
        <div class="header-right">
        	<?php do_action('icl_language_selector'); ?>
            <!--End Swithch language-->
            
            <div class="search_box">
            <?php include TEMPLATEPATH . '/searchform.php'; ?>
            </div> 
            <!--End Search Box-->
        </div>
        <!--End Header right-->
        <div class="clear"></div>
        
    </header>
    
    <nav id="navigation" class="pngfix">
         <div class="nav_wrap">
			<?php bw_main_nav(); // this function calls the main menu ?>
        </div>
    </nav>
    <!--End Main Menu -->
    
    
    