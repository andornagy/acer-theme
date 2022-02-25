<?php


add_action( 'widgets_init', create_function('', 'return register_widget("AcerPages");') );

class AcerPages extends WP_Widget
{
  function AcerPages()
  {
    $widget_ops = array('classname' => 'AcerPages', 'description' => 'Display Pages with thumbnails on your site.' );
    $this->WP_Widget('AcerPages', 'Acer - Pages', $widget_ops);
  }
 
  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
    $title = $instance['title'];
	$num   = $instance['num'];
	$thumb = $instance['thumb'];
	$pages = $instance['pages'];
?>

  <p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
  
<?php if ( add_theme_support( 'page-thumbnails' ) ) { ?>
  
  <p><label for="<?php echo $this->get_field_id('thumb'); ?>"><input
type="checkbox"
id="<?php echo $this->get_field_id('thumb'); ?>"
name="<?php echo $this->get_field_name('thumb'); ?>"
<?php checked(isset($thumb) ? 1 : 0); ?> /> Show Thumbnail</label> </p>  

<?php } ?>

  <p><label for="<?php echo $this->get_field_id('num'); ?>">Number of Pages: <input class="wideslim" id="<?php echo $this->get_field_id('num'); ?>" name="<?php echo $this->get_field_name('num'); ?>" type="text" value="<?php echo esc_attr($num); ?>"  size="3" /></label></p>
 
  <p><label for="<?php echo $this->get_field_id('pages'); ?>">Pages to show ( IDs ): <input class="widefat" id="<?php echo $this->get_field_id('pages'); ?>" name="<?php echo $this->get_field_name('pages'); ?>" type="text" value="<?php echo esc_attr($pages); ?>"  size="3" /></label></p>
 <span>Use the field above to specify what page are show ( use page ID and separate with , ) or leave it empty to show the recently added pages.</span> 
   
  
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
	$instance['num']   = $new_instance['num'];
	$instance['thumb'] = $new_instance['thumb'];
	$instance['pages'] = $new_instance['pages'];
    return $instance;
  }
 
  function widget($args, $instance)
  {
    extract($args, EXTR_SKIP);
 
    echo $before_widget;
    $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
	$num   = $instance['num'];
	$thumb = $instance['thumb'];
	$pages = $instance['pages'];
	
	if ( !empty ( $pages ) ) { $pages=explode(",",$pages); };
 
    if (!empty($title))
      echo $before_title . $title . $after_title;;
 
    // WIDGET CODE GOES HERE
 
 
	query_posts( array( 'posts_per_page' => $num,
						'orderby' => 'date',
						'order' => 'DESC',
						'offset' => 0,
						'post_type' => 'page',
						'post__in' => $pages
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