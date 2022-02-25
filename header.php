<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <title><?php bloginfo( 'sitename' ); WP_title('-') ?></title>
    <meta name="description" content="<?php bloginfo( 'description' ); ?>">
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" type="text/css" media="screen" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <meta name="keywords" content="<?php echo acer_home_tags() ?>" />
    <?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript">
	jQuery(function( $ ){
		$(window).scroll(function() {
			var yPos = ( $(window).scrollTop() );
			if(yPos > 300) { // show sticky menu after screen has scrolled down 300px from the top
				$("#sticky_menu_warp").fadeIn();
			} else {
				$("#sticky_menu_warp").fadeOut();
			}
		});
	});
    </script>
    <style type="text/css">
	<?php echo get_option('acer_custom_css') ?>
	<?php if ( header_image() ) { ?>
	#header_warp {
		background: top center no-repeat url('<?php header_image(); ?>');
		 }
	<?php } ?>	 
	</style>
<?php wp_head(); ?>
</head>

  
    
<body <?php body_class() ?>>
  
<div id="header_warp">

    <div id="header">
    	<div id="logo">
			<?php acer_logo(); ?>
    	</div>
        <div class="header_widget">
    		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar_header') ): ?>
    		<?php endif; ?>
    	</div>
        <div style="clear:right;"></div>     
    </div> 
</div>
    
    <div id="menu_warp">
		<?php acer_menu('primary'); ?>
    <div class="clear"></div>
    </div>
    
<div id="warp">    
<div id="constructor">