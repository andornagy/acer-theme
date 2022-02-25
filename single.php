<?php get_header(); ?>

<div id="container" class="<?php echo get_option('acer_layout') ?>">

	<div class="clear"></div>

	<div id="content">

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    
    <section id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    
        <h1 class="title"><?php the_title(); ?></h1>

        <div class="clear"></div>
        
        <p class="authorinfo">By <?php the_author_posts_link(); ?>  on <?php the_time('F jS, Y'); ?> </p>

        <?php if ( get_option('acer_thumb_single') == true ) { ?>
        
		<?php if ( has_post_thumbnail() ) { ?>
        
        <section class="thumb"><?php the_post_thumbnail( get_option('acer_thumb_size_single') ); ?></section>
        
        <?php } } ?>          
            
        <section class="entry">       
        
        <?php the_content(); ?>
        
        <?php wp_link_pages(); ?>
        
        </section>
        
        <div class="clear"></div>

    </section>
        
        <p class="postmetadata"> Filled under : <?php the_category(', '); ?> <br/> Tagged with : <?php the_tags(', '); ?> </p>
        
        <?php related_posts() ?>
        
        <div class="clear"></div>
            
		<?php comments_template( '/comments.php' ); ?> 
          
    <?php endwhile; endif; ?>

</div>

<?php get_sidebar(); ?>

	</div>
    <div class="clear"></div>

<?php get_footer(); ?>