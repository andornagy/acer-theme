<?php


add_action( 'widgets_init', create_function('', 'return register_widget("AcerRecentPosts");') );

class AcerRecentPosts extends WP_Widget
{
  function AcerRecentPosts()
  {
    $widget_ops = array('classname' => 'AcerRecentPosts', 'description' => 'The most recent posts with thumbnails on your site.' );
    $this->WP_Widget('AcerRecentPosts', 'Acer - Recent Posts', $widget_ops);
  }
 
  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
    $title = $instance['title'];
	$num   = $instance['num'];
	$thumb = $instance['thumb'];
	$info  = $instance['info'];
?>

  <p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
  
  <p><label for="<?php echo $this->get_field_id('thumb'); ?>"><input
type="checkbox"
id="<?php echo $this->get_field_id('thumb'); ?>"
name="<?php echo $this->get_field_name('thumb'); ?>"
<?php checked(isset($thumb) ? 1 : 0); ?> /> Show Thumbnail</label> </p>  

  <p><label for="<?php echo $this->get_field_id('info'); ?>"><input
type="checkbox"
id="<?php echo $this->get_field_id('info'); ?>"
name="<?php echo $this->get_field_name('info'); ?>"
<?php checked(isset($info) ? 1 : 0); ?> /> Show Post Info</label> </p> 
  
  <p><label for="<?php echo $this->get_field_id('num'); ?>">Number of post: <input class="wideslim" id="<?php echo $this->get_field_id('num'); ?>" name="<?php echo $this->get_field_name('num'); ?>" type="text" value="<?php echo esc_attr($num); ?>"  size="3" /></label></p>
  
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
	$instance['num'] = $new_instance['num'];
	$instance['thumb'] = $new_instance['thumb'];
	$instance['info'] = $new_instance['info'];
    return $instance;
  }
 
  function widget($args, $instance)
  {
    extract($args, EXTR_SKIP);
 
    echo $before_widget;
    $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
	$num = $instance['num'];
	$thumb = $instance['thumb'];
	$info = $instance['info'];
 	
 
    if (!empty($title))
      echo $before_title . $title . $after_title;;
 
    // WIDGET CODE GOES HERE
 
 
	query_posts( array( 'posts_per_page' => $num,
						'orderby' => 'date',
						'order' => 'DESC',
						'offset' => 0
						) 
				);
						
	if (have_posts()) :
		echo "<ul>";
		while (have_posts()) : the_post(); 
			if ( is_sticky() ) { } else {
				?>
				<li>
					<?php if ( ( $thumb == true ) && has_post_thumbnail() ) { ?>
                
                    <section class="thumb"><a href='<?php echo get_permalink() ?>'><?php the_post_thumbnail('widget'); ?></a></section>
                    
                    <?php } ?>
                    <a href='<?php echo get_permalink() ?>'><?php echo get_the_title() ?> </a><br/>        
                    <?php if ( $info == true ) { ?>
                        <span class="info">Posted on <?php the_time('F jS, Y'); ?> </span>
                    <?php } ?>
                    
                    <div class="clear"></div>
				</li>
				<?php 
			} // end of if ( is_sticky )
		endwhile;
		echo "</ul><div class='clear'></div>";
	endif; 
	wp_reset_query(); 
 
    echo $after_widget;
  }
 
}	