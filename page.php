<?php get_header(); ?>

<div id="container" class="<?php echo get_option('acer_layout') ?>">

	<div class="clear"></div>

	<div id="content">

    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    
    <section class="post">
    
        <h1 class="title"><?php the_title(); ?></h1>

        <div class="clear"></div>
 
        <?php if ( get_option('acer_thumb_page') == true ) { ?>
        
		<?php if ( has_post_thumbnail() ) { ?>
        
        <section class="thumb"><?php the_post_thumbnail( get_option('acer_thumb_size_page') ); ?></section>
        
        <?php } } ?>  
        
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
