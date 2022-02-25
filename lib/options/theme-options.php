<?php

$themename = "Acer Options";
$shortname = "acer";

$categories = get_categories('hide_empty=0&orderby=name');
$wp_cats = array();
foreach ($categories as $category_list ) {
       $wp_cats[$category_list->cat_ID] = $category_list->cat_name;
}
array_unshift($wp_cats, "Choose a category"); 

$options = array (
 
array( "name" => $themename." Options",
	"type" => "title"),
 
// General Theme Options
// =====================
 
array( "name" => "General",
	"type" => "section"),
array( "type" => "open"),
 
array( "name" => "Layout",
	"desc" => "Select the colour scheme for the theme",
	"id" => $shortname."_layout",
	"type" => "select",
	"options" => array("sidebar-left", "sidebar-right","full-width"),
	"std" => "sidebar-right"),
	
array( "name" => "Logo URL",
	"desc" => "Enter the link to your logo image",
	"id" => $shortname."_logo",
	"type" => "text",
	"std" => ""),

array( "name" => "Custom Header",
	"desc" => "Enter the link to your logo image",
	"id" => $shortname."_custom_header",
	"type" => "text",
	"std" => ""),

array( "name" => "Custom Favicon",
	"desc" => "A favicon is a 16x16 pixel icon that represents your site; paste the URL to a .ico image that you want to use as the image",
	"id" => $shortname."_favicon",
	"type" => "text",
	"std" => home_url()  ."/favicon.ico"),	
	
array( "name" => "Feedburner URL",
	"desc" => "Feedburner is a Google service that takes care of your RSS feed. Paste your Feedburner URL here to let readers see it in your website",
	"id" => $shortname."_feedburner",
	"type" => "text",
	"std" => get_bloginfo('rss2_url')),

array( "name" => "Custom CSS",
	"desc" => "Want to add any custom CSS code? Put in here, and the rest is taken care of. This overrides any other stylesheets. eg: a.button{color:green}",
	"id" => $shortname."_custom_css",
	"type" => "textarea",
	"std" => ""),		
	
array( "type" => "close"),

// Home Page Options
// ===================

array( "name" => "Home Page",
	"type" => "section"),
array( "type" => "open"),

array( "name" => "Post Thumbnail",
	"desc" => "Enable or disable the post thumbnails.",
	"id" => $shortname."_thumb_index",
	"type" => "checkbox",
	"std" => false),
	
array( "name" => "Thumbnail Size",
	"desc" => "Select the colour scheme for the theme",
	"id" => $shortname."_thumb_size_index",
	"type" => "select",
	"options" => array("extra-large-thumb", "large-thumb", "medium-thumb", "small-thumb"),
	"std" => "large-thumb"),
	
array( "name" => "Thumbnail Position",
	"desc" => "Select the colour scheme for the theme",
	"id" => $shortname."_thumb_pos_index",
	"type" => "select",
	"options" => array("above", "below"),
	"std" => "below"),
	
array( "name" => "Excerpt",
	"desc" => "Check this to show only a part of the post's content.",
	"id" => $shortname."_ex_index",
	"type" => "checkbox",
	"std" => ""),

array( "name" => "Excerpt Length",
	"desc" => "How many words would you like to show? ( Only works if Excerpt is check )",
	"id" => $shortname."_ex_length_index",
	"type" => "text",
	"std" => "40"),

array( "type" => "close"),

// Single Post Options
// ===================

array( "name" => "Single Post/Page Settings",
	"type" => "section"),
array( "type" => "open"),

array( "name" => "Post Thumbnail",
	"desc" => "Enable or disable the post thumbnails.",
	"id" => $shortname."_thumb_single",
	"type" => "checkbox",
	"std" => false),

array( "name" => "Post Thumbnail Size",
	"desc" => "Select the colour scheme for the theme",
	"id" => $shortname."_thumb_size_single",
	"type" => "select",
	"options" => array("extra-large-thumb", "large-thumb", "medium-thumb", "small-thumb"),
	"std" => "large-thumb"),

array( "name" => "Page Thumbnail",
	"desc" => "Enable or disable the page thumbnails.",
	"id" => $shortname."_thumb_page",
	"type" => "checkbox",
	"std" => false),

array( "name" => "Page Thumbnail Size",
	"desc" => "Select the colour scheme for the theme",
	"id" => $shortname."_thumb_size_page",
	"type" => "select",
	"options" => array("extra-large-thumb", "large-thumb", "medium-thumb", "small-thumb"),
	"std" => "large-thumb"),
	
array( "type" => "close"),

// Footer Options
// ==============

array( "name" => "Footer",
	"type" => "section"),
array( "type" => "open"),
	
array( "name" => "Footer copyright text",
	"desc" => "Enter text used in the right side of the footer. It can be HTML",
	"id" => $shortname."_footer_text",
	"type" => "text",
	"std" => ""),
	
array( "name" => "Code in The footer",
	"desc" => "Add code to the theme's footer using this text box. ( ex: google analytics )",
	"id" => $shortname."_footer_code",
	"type" => "textarea",
	"std" => ""),	
 
array( "type" => "close"),
 
// SEO Options
// =====================
 
array( "name" => "SEO Settings",
	"type" => "section"),
array( "type" => "open"),
 
array( "name" => "Enable Homepage meta keywords",
	"desc" => "Enable or disable Homepage meta keywords.",
	"id" => $shortname."_home_keyword_setting",
	"type" => "checkbox",
	"std" => false), 
 
array( "name" => "Homepage meta keywords",
	"desc" => "Add keywords for you homepage. Seperate them with comma.",
	"id" => $shortname."_home_keyword",
	"type" => "text",
	"std" => ""),
	
array( "type" => "close"), 
 
);

function mytheme_add_admin() {
 
global $themename, $shortname, $options;
 
if ( $_GET['page'] == basename(__FILE__) ) {
 
	if ( 'save' == @$_REQUEST['action'] ) {
 
		foreach ($options as $value) {
		update_option( @$value['id'], @$_REQUEST[ @$value['id'] ] ); }
 
foreach ($options as $value) {
	if(  $_REQUEST[ @$value['id'] ]  ) { update_option( $value['id'], $_REQUEST[ @$value['id'] ]  ); } else { delete_option( @$value['id'] ); } }
 
	header("Location: admin.php?page=theme-options.php&saved=true");
die;
 
} 
else if( 'reset' == @$_REQUEST['action'] ) {
 
	foreach ($options as $value) {
		delete_option( @$value['id'] ); }
 
	header("Location: admin.php?page=theme-options.php&reset=true");
die;
 
}
}
 

add_theme_page($themename, $themename, 'administrator', basename(__FILE__), 'mytheme_admin');
}

function mytheme_add_init() {

$file_dir=get_bloginfo('template_directory');
wp_enqueue_style("functions", $file_dir."/lib/options/theme-options.css", false, "1.0", "all");
wp_enqueue_script("rm_script", $file_dir."/lib/options/rm_script.js", false, "1.0");

}
function mytheme_admin() {
 
global $themename, $shortname, $options;
$i=0;
 
if ( @$_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p></div>';
if ( @$_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings reset.</strong></p></div>';
 
?>
<div class="widgets-holder-wrap inactive-sidebar">
<div class="wrap rm_wrap">
<h2><?php echo $themename; ?> Settings</h2>
 
<div class="rm_opts">
<form method="post">
<?php foreach ($options as $value) {
switch ( $value['type'] ) {
 
case "open":
?>
 
<?php break;
 
case "close":
?>
 
</div>
</div>
<br />

 
<?php break;
 
case "title":
?>
<p>To easily use the <?php echo $themename;?> theme, you can use the menu below.</p>

 
<?php break;
 
case 'text':
?>

<div class="rm_input rm_text">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
 	<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id'])  ); } else { echo $value['std']; } ?>" />
 <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
 
 </div>
<?php
break;
 
case 'textarea':
?>

<div class="rm_input rm_textarea">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
 	<textarea name="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" cols="" rows=""><?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id']) ); } else { echo $value['std']; } ?></textarea>
 <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
 
 </div>
  
<?php
break;
 
case 'select':
?>

<div class="rm_input rm_select">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
	
<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
<?php foreach ($value['options'] as $option) { ?>
		<option <?php if (get_option( $value['id'] ) == $option) { echo 'selected="selected"'; } ?>><?php echo $option; ?></option><?php } ?>
</select>

	<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
</div>
<?php
break;
 
case 'upload':
?>

<div class="rm_input rm_text">
<label for="">
<input name="" id="" type="text" value="" style="width:222px;" />


 <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
 
 </div>

<?php
break;
 
case "checkbox":
?>

<div class="rm_input rm_checkbox">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
	
<?php if(get_option($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = "";} ?>
<input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />


	<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
 </div>
<?php break; 
case "section":

$i++;

?>

<div class="rm_section">
<div class="rm_title"><h3><img src="<?php echo get_template_directory_uri() ?>/lib/images/trans2.png" class="inactive" alt="""><?php echo $value['name']; ?></h3><span class="submit"><input name="save<?php echo $i; ?>" type="submit" class="button action" value="Save changes" />
</span><div class="clearfix"></div></div>
<div class="rm_options">

 
<?php break;
 
}
}
function my_admin_scripts() {
if(is_admin()) {
$file_dir = get_bloginfo('template_directory');
wp_enqueue_script('media-upload');
wp_enqueue_script('thickbox');
wp_register_script('my-upload', $file_dir."/lib/my-script.js", array('jquery','media-upload','thickbox'));
wp_enqueue_script('my-upload');
}
}

function my_admin_styles() {
if(is_admin()) {
wp_enqueue_style('thickbox');
}
}
add_action('admin_print_scripts','my_admin_scripts');
add_action('admin_print_styles', 'my_admin_styles');

?> 
 
<input type="hidden" class="button action" name="action" value="save" />
</form>
<form method="post">
<p class="submit">
<input name="reset" class="button action" type="submit" value="Reset" />
<input type="hidden" name="action" value="reset" />
</p>
</form>

 </div> 
</div>
<div class="widget-liquid-right">
<div id="widgets-right">
<div class="widgets-holder-wrap">
    <div class="sidebar-name">
   		
        <h3 style="color: #F00" >Support and Help<span class="spinner"></span></h3></div>
        
        <div id='sidebar_footer_three' class='widgets-sortables'>
            <div class='sidebar-description'>
If you need any help or want to digg deeper follow the links below.
<ul>

<li>Home Page - <a href="http://www.themeacer.com" target="_blank">ThemeAcer.com</a></li>
<li>Changle Log - <a href="http://bit.ly/XUUbT8" target="_blank"> Changelog</a></li>
<li>Community - <a href="http://bit.ly/16PbqHi" target="_blank">Google+</a></li>
<p style="color:red;">To report a bug or you just want to suggest something, or need help with the theme, join our Google+ community!<p>
</ul>

        </div>
    </div>
    </div>
    
<div id="widgets-right">
<div class="widgets-holder-wrap">
    <div class="sidebar-name">
	<h3>Help us create!	<span class="spinner"></span></h3></div>
        
        <div id='sidebar_footer_three' class='widgets-sortables'>
            <div class='sidebar-description'>
            <p class='description'>
            
            If you like this theme and what we do, donate a few $$ to help us create and keep everything free.
           
            <center><form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="SDHFBWATS4MFG">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form></center>

</p>   
        	</div>
        </div>
    </div>
    </div>
    
    
<div class="widgets-holder-wrap">
    <div class="sidebar-name">
   		
        <h3>Stay Connected!<span class="spinner"></span></h3></div>
        
        <div id='sidebar_footer_three' class='widgets-sortables'>
            <div class='sidebar-description'>
<a href="https://twitter.com/AndorNagy" class="twitter-follow-button" data-show-count="false" data-size="large">Follow @AndorNagy</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

<iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2Fpages%2FAndor-Nagy%2F556208011064465&amp;width=292&amp;height=62&amp;show_faces=false&amp;colorscheme=light&amp;stream=false&amp;border_color&amp;header=false" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:292px; height:62px;" allowTransparency="true"></iframe>


        </div>
    </div>
    </div> 
</div>
<div class="clear"></div>

</div>



<?php
}

function wp_theme_options() {
    global $wp_admin_bar;
	$url = site_url();
    /* Add the main siteadmin menu item */
    $wp_admin_bar->add_menu( array( 'id' => 'codex_search', 'title' => __( 'Acer Options', 'acer' ), 'href' => $url . '/wp-admin/themes.php?page=theme-options.php' ) );
}
add_action( 'admin_bar_menu', 'wp_theme_options', 1000 );

add_action('admin_init', 'mytheme_add_init');
add_action('admin_menu', 'mytheme_add_admin');