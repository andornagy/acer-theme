<?php get_header(); ?>

<div id="container" class="<?php echo get_option('acer_layout') ?>">

	<div class="clear"></div>

	<div id="content">

<h1><?php printf( __( 'Search Results for: %s', 'acer' ), '<span>' . get_search_query() . '</span>'); ?></h1>

<?php get_search_form( $echo ); ?>

<?php

	 if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    
    <section class="post">
    
        <h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        
        <div class="clear"></div>
        
        <p class="authorinfo">By <?php the_author_posts_link(); ?>  on <?php the_time('F jS, Y'); ?> </p>
        
        <?php if ( get_option( 'acer_thumb_pos_index' ) == 'above' ) {
			acer_home_thumb(); } ?>
        
        <section class="entry">

        <?php if ( get_option('acer_ex_index') == true ) { ?>
        
        <?php the_excerpt(); ?>
        
        <?php } else { ?>
        
        <?php the_content(); ?>
        
        <?php } ?>
         
        </section>
    
        <?php if ( get_option( 'acer_thumb_pos_index' ) == 'below' ) {
			acer_home_thumb(); } ?>
            
        <a class="read-more" href="<?php the_permalink(); ?>"> Continue Reading &rarr;</a>
        
        <div class="clear"></div>
    
    </section>
    
    <?php endwhile; endif; ?>
        
    <?php if (show_posts_nav()) : ?>
        <div class='navigation'>
            <span class='older'><?php next_posts_link('&laquo; Older Entries'); ?></span>
            <span class='newer'><?php previous_posts_link('Newer Entries &raquo;'); ?></span>
        </div>
	<?php endif; ?>

</div>

<?php get_sidebar(); ?>

	</div>
    <div class="clear"></div>

<?php get_footer(); ?>
