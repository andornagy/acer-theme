<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to shape_comment() which is
 * located in the inc/template-tags.php file.
 *
 * @package acer
 * @since acer 1.0.3
 */
?>
 
<?php
    /*
     * If the current post is protected by a password and
     * the visitor has not yet entered the password we will
     * return early without loading the comments.
     */
    if ( post_password_required() )
        return;
?>
 
    <div id="comments" class="comments-area">
 
    <?php // You can start editing here -- including this comment! ?>
 
    <?php if ( have_comments() ) : ?>
        <h2 class="comments-title">
            <?php
                printf( _n( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'acer' ),
                    number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
            ?>
        </h2>
 
        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through? If so, show navigation ?>
        <nav role="navigation" id="comment-nav-above" class="site-navigation comment-navigation">
            <h1 class="assistive-text"><?php _e( 'Comment navigation', 'acer' ); ?></h1>
            <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'acer' ) ); ?></div>
            <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'acer' ) ); ?></div>
        </nav><!-- #comment-nav-before .site-navigation .comment-navigation -->
        <?php endif; // check for comment navigation ?>
 
        <ol class="commentlist">
            <?php
                /* Loop through and list the comments. Tell wp_list_comments()
                 * to use shape_comment() to format the comments.
                 * If you want to overload this in a child theme then you can
                 * define shape_comment() and that will be used instead.
                 * See shape_comment() in inc/template-tags.php for more.
                 */
                wp_list_comments( array( 'callback' => 'acer_comment' ) );
            ?>
        </ol><!-- .commentlist -->
 
        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through? If so, show navigation ?>
        <nav role="navigation" id="comment-nav-below" class="site-navigation comment-navigation">
            <h1 class="assistive-text"><?php _e( 'Comment navigation', 'acer' ); ?></h1>
            <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'acer' ) ); ?></div>
            <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'acer' ) ); ?></div>
        </nav><!-- #comment-nav-below .site-navigation .comment-navigation -->
        <?php endif; // check for comment navigation ?>
 
    <?php endif; // have_comments() ?>
 
    <?php
        // If comments are closed and there are comments, let's leave a little note, shall we?
        if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
    ?>
        <p class="nocomments"><?php _e( 'Comments are closed.', 'acer' ); ?></p>
    <?php endif; ?>
 
    <?php 
	
$args = array(
  'id_form'           => 'commentform',
  'id_submit'         => 'button',
  'title_reply'       => __( 'Leave a Reply' ),
  'title_reply_to'    => __( 'Leave a Reply to %s' ),
  'cancel_reply_link' => __( 'Cancel Reply' ),
  'label_submit'      => __( 'Post Comment' ),

  'comment_field' =>  '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun' ) .
    '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true">' .
    '</textarea></p>',

  'must_log_in' => '<p class="must-log-in">' .
    sprintf(
      __( 'You must be <a href="%s">logged in</a> to post a comment.' ),
      wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )
    ) . '</p>',

  'logged_in_as' => '<p class="logged-in-as">' .
    sprintf(
    __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ),
      admin_url( 'profile.php' ),
      $user_identity,
      wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )
    ) . '</p>',

  'comment_notes_before' => '<p class="comment-notes">' .
    __( 'Your email address will not be published.' ) . ( $req ? @$required_text : '' ) .
    '</p>',

  'comment_notes_after' => '<p class="form-allowed-tags">' .
    sprintf(
      __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s' ),
      ' <code>' . allowed_tags() . '</code>'
    ) . '</p>',

  'fields' => apply_filters( 'comment_form_default_fields', array(

    'author' =>
	'<table class="none">
 		<tr>
    		<td>',
			  '<p class="comment-form-author">' .
			  '<label for="author">' . __( 'Name', 'acer' ) . '</label> ' .
			  ( $req ? '<span class="required"> ( Required )</span>' : '' ) .
			  '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
			  '" size="30"' . @$aria_req . ' /></p>',
			'</td>',

    'url' =>
			'<td>',			  '<p class="comment-form-url"><label for="url">' .
			  __( 'Website', 'acer' ) . '</label>' .
			  '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
			  '" size="30" /></p>',

			'</td>
  		</tr>',

    'email' =>
		'<tr>
    		<td>',
			  '<p class="comment-form-email"><label for="email">' . __( 'Email', 'acer' ) . '</label> ' .
			  ( $req ? '<span class="required"> ( Required )</span>' : '' ) .
			  '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
			  '" size="30"' . @$aria_req . ' />
			  </p>',
			'</td>    
			 <td><p class="comment-form-twitter"><label for="comment_twitter">Twitter: <span class="required"> ( Without @ )</span></label><input id="twitter" type="text"  name="comment_twitter" value="' . esc_attr( @$commenter['comment_twitter'] ) .
			  '" size="30"></p></td>
  		</tr>
	</table>',
    )
  ),
);
	
	comment_form($args); ?>
 
</div><!-- #comments .comments-area -->