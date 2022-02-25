<?php


add_action( 'widgets_init', create_function('', 'return register_widget("AcerRecentComments");') );

class AcerRecentComments extends WP_Widget
{
  function AcerRecentComments()
  {
    $widget_ops = array('classname' => 'AcerRecentComments', 'description' => 'The most recent posts on your site.' );
    $this->WP_Widget('AcerRecentComments', 'Acer - Recent Comments', $widget_ops);
  }
 
  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
    $title = $instance['title'];
 	$order = $instance['order'];
	$avatar   = $instance['avatar'];
	$num   = $instance['num'];
	$limit = $instance['limit'];
?>
  <p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
  
  <p><label for="<?php echo $this->get_field_id('avatar'); ?>"><input
type="checkbox"
id="<?php echo $this->get_field_id('avatar'); ?>"
name="<?php echo $this->get_field_name('avatar'); ?>"
<?php checked(isset($avatar) ? 1 : 0); ?> /> Show Author Avatar</label> </p> 
 
  <p><label for="<?php echo $this->get_field_id('num'); ?>">Number of Comments: <input class="wideslim" id="<?php echo $this->get_field_id('num'); ?>" name="<?php echo $this->get_field_name('num'); ?>" type="text" value="<?php echo esc_attr($num); ?>"  size="3" /></label></p>

  <p><label for="<?php echo $this->get_field_id('limit'); ?>">Excerpt Limit ( Words ): <input class="wideslim" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="text" value="<?php echo esc_attr($limit); ?>"  size="3" /></label></p>

  
  
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title']  = $new_instance['title'];
	$instance['num']    = $new_instance['num'];
	$instance['avatar'] = $new_instance['avatar'];
	$instance['limit']  = $new_instance['limit'];
    return $instance;
  }
 
  function widget($args, $instance)
  {
    extract($args, EXTR_SKIP);
 
    echo $before_widget;
    $title  = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
	$num    = $instance['num'];
	$limit  = $instance['limit'];
	$avatar = $instance['avatar'];
 	
 
    if (!empty($title))
      echo $before_title . $title . $after_title;;
 
    // WIDGET CODE GOES HERE
?>
<?php

global $wpdb;
$sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID,
comment_post_ID, comment_author, comment_date_gmt, comment_approved,
comment_type,comment_author_url,comment_content
FROM $wpdb->comments
LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID =
$wpdb->posts.ID)
WHERE comment_approved = '1' AND comment_type = '' AND
post_password = ''
ORDER BY comment_date_gmt DESC
LIMIT $num";
$comments = $wpdb->get_results($sql);

?>
<ul>
	<?php foreach ($comments as $comment) { 
	
		$com_excerpt = explode (' ', $comment->comment_content );
		$com_excerpt = array_slice ( $com_excerpt, 0, $limit );
		$com_excerpt = implode (' ', $com_excerpt);
		
	?>
		<li>
            <?php if ( $avatar == true ) { ?>
                <section class="thumb">
                <a href="<?php echo $comment->comment_author_url; ?>">
                    <?php echo get_avatar( get_comment_author_email( $comment->comment_ID ) ,'60'); ?>
                </a>
                </section>
            <?php } ?>
            <a href="<?php echo $comment->comment_author_url; ?>" title="<?php echo $comment->comment_author ?>"><?php echo $comment->comment_author ?></a> said: <br/>
            <a href="<?php echo get_permalink($comment->ID); ?>#comment-<?php echo $comment->comment_ID; ?>" title="on <?php echo $comment->post_title; ?>"><span class="info"><?php echo $com_excerpt ?>... </span></a>
        	<div class="clear"></div>
		</li>
	<?php }  ?>
</ul>
 <?php 
    echo $after_widget;
  }
 
}	