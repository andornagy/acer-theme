<?php get_header(); ?>

<div id="container" class="<?php echo get_option('acer_layout') ?>">

	<div class="clear"></div>

	<div id="content">

<?php
	 if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    
    <section id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php get_category_by_slug( 'slug' ) ?>>
    
        <h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        
        <div class="clear"></div>
        
        <p class="authorinfo">By <?php the_author_posts_link(); ?>  on <?php the_time('F jS, Y'); ?> </p>
        
        <?php if ( get_option( 'acer_thumb_pos_index' ) == 'above' ) { acer_home_thumb(); } ?>
        
        <section class="entry">

        <?php if ( get_option('acer_ex_index') == true ) { ?>
        
       		<?php the_excerpt(); ?>
        
        <?php } else { ?>
        
        	<?php the_content(); ?>
        
        <?php } ?>
         
        </section>
    
        <?php if ( get_option( 'acer_thumb_pos_index' ) == 'below' ) { acer_home_thumb(); } ?>
        
        <div class="clear"></div>
    
    </section>
    
    <?php endwhile; endif; ?>
        
    <?php if (show_posts_nav()) : ?>
        <div class='navigation'>
            <span style="float:left;" class='older'><?php next_posts_link('&laquo; Older Entries'); ?></span>
            <span style="float:right;" class='newer'><?php previous_posts_link('Newer Entries &raquo;'); ?></span>
        </div>
	<?php endif; ?>

</div>

<?php get_sidebar(); ?>

	</div>
    <div class="clear"></div>

<?php get_footer(); ?>