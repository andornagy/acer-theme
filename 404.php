<?php get_header(); ?>

<div id="container" class="<?php echo get_option('acer_layout') ?>">

	<div class="clear"></div>

	<div id="content">

<h1 id="title"> 404 Error - Page not found </h1>

This page dose not exists or had been deleted. Please go back or use the search below!


<h3>Search</h3>
<?php get_search_form( $echo ); ?>

</div>

<?php get_sidebar(); ?>

	</div>
    <div class="clear"></div>

<?php get_footer(); ?>