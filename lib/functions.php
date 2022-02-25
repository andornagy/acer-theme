<?php

// Color shame changer 
// ====================================================================

function acer_color_shame() {
	
	$color = get_option('acer_color_scheme');
	
	if ($color == 'default') {
	} else { ?>
		
	<link rel="stylesheet" href="<?php echo bloginfo('template_directory') ?>/lib/colors/<?php echo $color ?>.css" type="text/css" media="screen" />	
		
	<?php }
	
	}
	
// Custom HomePage KeyWords
// ====================================================================

function acer_home_tags() {
	
	if ( get_option('acer_home_keyword_setting') == true ) {
	
		echo get_option('acer_home_keyword');
	
		}
	
	}	

// Custom Thumbnail Function
// ====================================================================

function acer_home_thumb() {

	if ( get_option('acer_thumb_index') == true ) {
        
		if ( has_post_thumbnail() ) { ?>
        
        	<section class="thumb"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( get_option('acer_thumb_size_index') ); ?></a></section>
        
<?php 	} 
	} 
} 

// Registering custom thumbnails and sizes
// ====================================================================

if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'page-thumbnails' );
    set_post_thumbnail_size( 890, 300 ); // default Post Thumbnail dimensions   
}

if ( function_exists( 'add_image_size' ) ) {
	add_image_size( 'extra-large-thumb', 970, 250, true ); //(cropped) 
	add_image_size( 'large-thumb', 630, 200, true ); //(cropped)
	add_image_size( 'medium-thumb', 340, 280, true ); //(cropped)
	add_image_size( 'small-thumb', 200, 200, true ); //(cropped)
	add_image_size( 'related-post', 122, 122, true ); //(cropped)
	add_image_size( 'widget', 60, 60, true ); //(cropped)
}

// Set Max Image Size
// ====================================================================

function acer_content_width() {
	
	$layout = get_option('acer_layout');
	
	if ( $layout = 'sidebar-right' or $layout = 'sidebar-left' ) {
	
		$GLOBALS['content_width'] == '650';
	
	} elseif ( $layout = 'full-width' ){
	
		$GLOBALS['content_width'] == '990';
	
	}
	
	return $GLOBALS['content_width'];
}

// Registering The Sidebars
// ====================================================================

function acer_widgets_init() {
	//Registering Header Widget Area
	register_sidebar( array(
		'name'      	=> __( 'Header Sidebar', 'acer' ),
		'id'         	=> 'sidebar_header',
		'description'   => __( 'Is in the Header of the theme', 'acer' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
   		'before_title'  => '<div class="title"><h3>',
   		'after_title'   => '</h3></div>'
	) );
	//Registering General Sidebar
	register_sidebar( array(
		'name'         	=> __( 'General Sidebar', 'acer' ),
		'id'        	=> 'sidebar_general',
		'description'   => __( 'Is at the right middle side of the theme', 'acer' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
   		'before_title'  => '<div class="title"><h3>',
   		'after_title'   => '</h3></div>'
	) );

	//Registering Footer Sidebar 1
	register_sidebar( array(
		'name'      	=> __( 'Footer Sidebar 1', 'acer' ),
		'id'         	=> 'sidebar_footer_one',
		'description'   => __( 'Is at the footer of the theme', 'acer' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
   		'before_title'  => '<div class="title"><h3>',
   		'after_title'   => '</h3></div>'
	) );
	//Registering Footer Sidebar 2
	register_sidebar( array(
		'name'      	=> __( 'Footer Sidebar 2', 'acer' ),
		'id'         	=> 'sidebar_footer_two',
		'description'   => __( 'Is at the footer of the theme', 'acer' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
   		'before_title'  => '<div class="title"><h3>',
   		'after_title'   => '</h3></div>'
	) );
	//Registering Footer Sidebar 3
	register_sidebar( array(
		'name'      	=> __( 'Footer Sidebar 3', 'acer' ),
		'id'         	=> 'sidebar_footer_three',
		'description'   => __( 'Is at the footer of the theme', 'acer' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
   		'before_title'  => '<div class="title"><h3>',
   		'after_title'   => '</h3></div>'
	) );
 }
 
add_action( 'widgets_init', 'acer_widgets_init');
	
// Registering Custom Menus
// ====================================================================
	
function acer_register_menus() {
    register_nav_menus(
        array(
            'primary-menu' => __( 'Primary Menu', 'acer' ),
            'secondary-menu' => __( 'Secondary Menu', 'acer' ),
        )
    );
}

add_action( 'init', 'acer_register_menus' );

function acer_menu($menu) { 

if ( has_nav_menu( $menu.'-menu' ) ) {

?>
 
<div id="<?php echo $menu ?>-menu"> <?php

	wp_nav_menu( array( 
	'theme_location' => $menu.'-menu', 
	'menu_class' => $menu, 
	'fallback_cb' => '|', 
	'walker' => new acer_Nav_Walker()
	));
	?>
    
</div> 

<?php
	}
}

class acer_Nav_Walker extends Walker_Nav_Menu{
  public function display_element($el, &$children, $max_depth, $depth = 0, $args, &$output){
    $id = $this->db_fields['id'];    

    if(isset($children[$el->$id]))
      $el->classes[] = 'has_children';    

    parent::display_element($el, $children, $max_depth, $depth, $args, $output);	
       
	$class_names = $value = '';
 
    $classes = empty( $item->classes ) ? array() : (array) $item->classes;
 
    $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), @$item ) );
    $class_names = '';	

  }  
  
}

// Sticky Menu fix
// ====================================================================

function move_admin_bar() {
    echo '<style type="text/css">
	#sticky_menu_warp { top: 28px; }	
	</style>';
}
add_action( 'admin_bar_menu', 'move_admin_bar' );



// The Excerpt 
// ====================================================================

function custom_excerpt_length( $length ) {
	return get_option('acer_ex_length_index');
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function new_excerpt_more( $more ) {
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');

// Custom background support
// ====================================================================	
	
add_theme_support( 'custom-background', array(
	// Background color default
	'default-color' => 'CCCCCC',
) );

$args = array(
	'width'         => 0,
	'height'        => 230,
	'default-image' => get_template_directory_uri() . '/images/header.jpg',
	'uploads'       => true,
	'header-text'   => false,
);
add_theme_support( 'custom-header', $args , false);

add_theme_support('post-thumbnails' ); 
add_theme_support( 'automatic-feed-links' ); 
add_editor_style();

if ( ! isset( $content_width ) ) $content_width = 700;

function show_posts_nav() {
global $wp_query;
return ($wp_query->max_num_pages > 1);
}

// Custom Logo or Normal Title 
// ====================================================================

function acer_logo() { ?>
	
    <?php
	
	$logo = get_option('acer_logo');
	
	if ( empty ( $logo )  ) { 
	
		?>
		
		<h1><a href="<?php echo site_url(); ?>"><?php echo get_bloginfo('name'); ?></a></h1>
<h3><?php echo get_bloginfo('description') ?></h3>
		
	    <?php 
	
	} else {
		
		?>
			
		<a href="<?php echo site_url(); ?>"><img alt="<?php echo get_bloginfo('name'); ?>" title="<?php echo get_bloginfo('name'); ?>" src="<?php echo $logo ?>"/></a>
			
        <?php    
            
		} 
	
	}
	

// Ralated Posts 
// ====================================================================

function related_posts() {
	
	$tags = wp_get_post_tags(@$post->ID);

	$args = array(
		'posts_per_page' => 4,
		'post__in'  => $tags,
		'orderby' => 'rand'
	);

	$the_query = new WP_Query( $args );

	echo '<ul id="relatedPosts"><h3>Related Articles</h3>';

    while ( $the_query->have_posts() ) : $the_query->the_post();
    	
		if ( is_sticky() ) { } else {
		
		?>
        
			<li class="item">			
			<?php if ( has_post_thumbnail() ) { ?>
				<section class="thumb"><a href='<?php echo get_permalink() ?>'><?php the_post_thumbnail('widget'); ?></a></section>
			<?php } else { ?> <section class="thumb"><a href='<?php echo get_permalink() ?>'><img src="<?php echo get_stylesheet_directory_uri(); ?>/lib/images/thumb.png"/></a></section> 
			<?php } ?>
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </li>
		<?php 
		
		}
	endwhile;

	echo '</ul>';

	wp_reset_postdata();
	
	}	
	
// Custom Profile Fields 
// ====================================================================	
	 
function twitter_add_custom_user_profile_fields( $user ) {
?>
    <h3><?php _e('Extra Profile Information', 'acer'); ?></h3>
    
    <table class="form-table">
        <tr>
            <th>
                <label for="address"><?php _e('twitter', 'acer'); ?>
            </label></th>
            <td>
                <input type="text" name="address" id="address" value="<?php echo esc_attr( get_the_author_meta( 'twitter', $user->ID ) ); ?>" class="regular-text" /><br />
                <span class="description"><?php _e('Please enter your address.', 'acer'); ?></span>
            </td>
        </tr>
    </table>
<?php }
 
add_filter('user_contactmethods', 'my_user_contactmethods');  
               
function my_user_contactmethods($user_contactmethods){  
  
  $user_contactmethods['twitter'] = 'Twitter Username';  
  $user_contactmethods['facebook'] = 'Facebook URL';  
  $user_contactmethods['google'] = 'Google Profile Link';  
  $user_contactmethods['pinterest'] = 'Printerest Username';  
  $user_contactmethods['linked'] = 'Linkedin Username';  
  
  return $user_contactmethods;  
}  

// Custom Comments List
// ====================================================================

if ( ! function_exists( 'acer_comment' ) ) :

function acer_comment( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    switch ( $comment->comment_type ) :
        case 'pingback' :
        case 'trackback' :
    ?>
    <li class="post pingback">
        <p><?php _e( 'Pingback:', 'acer' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'acer' ), ' ' ); ?></p>
    <?php
            break;
        default :
    ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
        <article id="comment-<?php comment_ID(); ?>" class="comment">
            <footer>
                <div class="comment-author vcard">
                    <?php echo get_avatar( $comment, 40 ); ?>
                    <?php printf( __( '<span class="says"> %s says:</span>', 'acer' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
					
<div class="twitter_follow"><a href="https://twitter.com/<?php echo get_comment_meta( $comment->comment_ID, 'comment_twitter', true ); ?>" class="twitter-follow-button" data-show-count="false">Follow @AndorNagy</a></div>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>					
                    
                </div><!-- .comment-author .vcard -->
                <?php if ( $comment->comment_approved == '0' ) : ?>
                    <em><?php _e( 'Your comment is awaiting moderation.', 'acer' ); ?></em>
                    <br />
                <?php endif; ?>
 
                <div class="comment-meta commentmetadata">
                    <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time pubdate datetime="<?php comment_time( 'c' ); ?>">
                    <?php
                        /* translators: 1: date, 2: time */
                        printf( __( '%1$s at %2$s', 'acer' ), get_comment_date(), get_comment_time() ); ?>
                    </time></a>
                    <?php edit_comment_link( __( '(Edit)', 'acer' ), ' ' );
                    ?>
                </div><!-- .comment-meta .commentmetadata -->
            </footer>
 
            <div class="comment-content"><?php comment_text(); ?></div>
 
            <div class="reply">
                <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
            </div><!-- .reply -->
            <div class="clear"></div>
        </article><!-- #comment-## -->
 
    <?php
            break;
    endswitch;
}
endif; // ends check for acer_comment()

// Adding custom Twitter field to the Comment form

function comment_twitter_field() { ?>
	<p><label for="comment_twitter">Twitter:</label><input id="twitter" type="text"  name="comment_twitter" id="comment_twitter"></p>
<?php }
 
add_action( 'comment_form_logged_in_after', 'comment_twitter_field' );

function save_comment_twitter_field( $comment_id ) {
add_comment_meta( $comment_id, 'comment_twitter', $_POST[ 'comment_twitter' ] );
}
add_action( 'comment_post', 'save_comment_twitter_field' );
