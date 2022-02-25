<?php
/*
Template Name: Sidebar Right
*/
?>

<?php get_header(); ?>

<div id="container" class="sidebar-right">

	<div class="clear"></div>

	<div id="content">

    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    
    <section class="post">
    
        <h1 class="title"><?php the_title(); ?></h1>

        <div class="clear"></div>
        
        <section class="entry">
        
        <?php the_content(); ?>
        
        </section>
        
    </section>
    
        <div class="clear"></div>
        
        <div id="comments">
			<?php comments_template('',true); ?>
		</div><!-- Comments ends -->
    
    <?php endwhile; endif; ?>

</div>

<?php get_sidebar(); ?>

	</div>
    <div class="clear"></div>

<?php get_footer(); ?>
