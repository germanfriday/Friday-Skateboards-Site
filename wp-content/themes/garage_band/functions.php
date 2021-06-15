<?php

function rssfeed(){ ?>
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> &raquo; <?php _e('Feed','garageband'); ?>" href="<?php rss(); ?>" />
<?php
}

add_theme_support( 'post-thumbnails' );
add_image_size('album_thumb',160,160,1);

add_thickbox();
	
if(function_exists('register_nav_menu')):

	register_nav_menu( 'primary_nav' , 'Primary Navigation' );
	register_nav_menu( 'footer_nav' , 'Footer Navigation' );

endif;

add_action('wp_head','rssfeed',1);

// Getting Theme and Child Theme Data
// Credits: Joern Kretzschmar

$themeData = get_theme_data(TEMPLATEPATH . '/style.css');
$version = trim($themeData['Version']);
if(!$version)
    $version = "unknown";

// set theme constants
define('THEMENAME', $themeData['Title']);
define('THEMEAUTHOR', $themeData['Author']);
define('THEMEURI', $themeData['URI']);
define('THEMATICVERSION', $version);

// Path constants
define('THEMELIB', TEMPLATEPATH . '/library');

function wp_page_menu_mod(){
	
	$menu = wp_list_pages( array('echo' => 0, 'title_li' => false ) );
	
	echo '<ul id="primary_nav" class="sf-menu">'.$menu.'</ul>';
	
}

// Load widgets
require_once(THEMELIB . '/extensions/widgets.php');

// Load custom header extensions
require_once(THEMELIB . '/extensions/header-extensions.php');

// Load custom content filters
require_once(THEMELIB . '/extensions/content-extensions.php');

// Load custom Comments filters
require_once(THEMELIB . '/extensions/comments-extensions.php');

// Load custom Widgets
require_once(THEMELIB . '/extensions/widgets-extensions.php');

// Load the Comments Template functions and callbacks
require_once(THEMELIB . '/extensions/discussion.php');

// Load custom sidebar hooks
require_once(THEMELIB . '/extensions/sidebar-extensions.php');

// Load custom footer hooks
require_once(THEMELIB . '/extensions/footer-extensions.php');

// Add Dynamic Contextual Semantic Classes
require_once(THEMELIB . '/extensions/dynamic-classes.php');

// Need a little help from our helper functions
require_once(THEMELIB . '/extensions/helpers.php');

// Load shortcodes
require_once(THEMELIB . '/extensions/shortcodes.php');

// Get The Image Plugin by Justin Tadlock
require_once(THEMELIB . '/extensions/get-the-image.php');

// WP Cycle
require_once(THEMELIB . '/featured-images/featured-images.php');

// UpThemes Admin Functions
require_once('admin/admin.php');

// Load in Custom Content Types
require_once(THEMELIB . '/content_types/albums.php');
require_once(THEMELIB . '/content_types/shows.php');
require_once(THEMELIB . '/content_types/fan_gallery.php');

// Adds filters for the description/meta content in archives.php
add_filter( 'archive_meta', 'wptexturize' );
add_filter( 'archive_meta', 'convert_smilies' );
add_filter( 'archive_meta', 'convert_chars' );
add_filter( 'archive_meta', 'wpautop' );

// Remove the WordPress Generator – via http://blog.ftwr.co.uk/archives/2007/10/06/improving-the-wordpress-generator/
function gar_remove_generators() { return ''; }  
add_filter('the_generator','gar_remove_generators');

// Translate, if applicable
load_theme_textdomain('garageband', THEMELIB . '/languages');
$locale = get_locale();
$locale_file = THEMELIB . "/languages/$locale.php";
if (is_readable($locale_file)) require_once($locale_file);

// Enqueue Scripts
function add_scripts(){
	
	global $up_options,$wp_query;
	
	wp_reset_query();
			
	if(!is_admin()):
				
		wp_enqueue_script('superfish',
			get_bloginfo('template_url') . '/library/scripts/superfish.js',
			array('jquery'),
			false );

		wp_enqueue_script('supersubs',
			get_bloginfo('template_url') . '/library/scripts/supersubs.js',
			array('jquery','superfish'),
			false );

		wp_enqueue_script('swfobject');
			
		wp_enqueue_script('hoverIntent',
			get_bloginfo('template_url') . '/library/scripts/hoverIntent.js',
			array('jquery','superfish','supersubs'),
			false );

		wp_enqueue_script('jquery.bgiframe',
			get_bloginfo('template_url') . '/library/scripts/jquery.bgiframe.min.js',
			array('jquery','hoverIntent'),
			false );

		wp_enqueue_script('jquery.validate',
			get_bloginfo('template_url') . '/library/scripts/jquery.validate.js',
			array('jquery'),
			false );

		wp_enqueue_script('global',
			get_bloginfo('template_url') . '/library/scripts/global.js',
			array('jquery'),
			false );
		
	endif;
  
}

add_action('init','add_scripts');

function instantiate_audio_player(){

	wp_enqueue_script('swfobject');
	
	wp_enqueue_script('audioplayer',
		get_bloginfo('template_url') . '/library/scripts/audioplayer.js',
		array('jquery'),
		false);

	wp_localize_script('audioplayer',
					   'audio',
						array( 
							'url' => get_bloginfo('url'),
							'template_url' => get_bloginfo('template_url')
						));

}

add_action('init','instantiate_audio_player');

// Enqueue Styles
function add_styles(){

  if(!is_admin()){
    global $up_options;

  	$stylesheet_dir = get_bloginfo('template_directory');

	if($up_options->style):
	    $theme_color = $up_options->style;
		$myStyleUrl =  $stylesheet_dir . "/style-" . $theme_color . ".css";
		wp_enqueue_style('color_scheme', $myStyleUrl, array(), false, 'screen');
	endif;
    
  }
}

add_action('wp_print_styles','add_styles');

function slideshow(){

	if( is_single() ):
	
		echo '<script>
		if(jQuery("#mySlides img").length > 1 && jQuery("#myController").length >= 1){
			jQuery("#myController").jFlow({
				slides: "#mySlides",
				duration: 400
			});
		}
		</script>';
	
	endif;
	
}

add_action('wp_footer','slideshow');

function custom_css(){
    global $up_options;
    $custom_css = '<style type="text/css">';
			
		$custom_css .= 'body{';		
		if($up_options->background)				$custom_css .= 'background-image: url("' . $up_options->background . '");';
		if($up_options->backgroundcolor) 		$custom_css .= 'background-color: ' . $up_options->backgroundcolor . ';';
		if($up_options->background_position) 	$custom_css .= 'background-position: ' . $up_options->background_position . ';';
		if($up_options->background_attachment) 	$custom_css .= 'background-attachment: ' . $up_options->background_attachment . ';';
		if($up_options->background_repeat) 		$custom_css .= 'background-repeat: ' . $up_options->background_repeat . ';';
		$custom_css .= "}";

		if($up_options->linkcolor)				$custom_css .= "a{ color: ".$up_options->linkcolor.";}";

		if($up_options->hovercolor)				$custom_css .= "a:hover{ color: ".$up_options->hovercolor.";}";

		if($up_options->activecolor)			$custom_css .= "a:active{ color: ".$up_options->activecolor.";}";


    $custom_css .= '</style>';

	echo $custom_css;
}

add_action('wp_head', 'custom_css');

// Create Header Ads
function ads_above_header(){

	global $up_options;
		
	if($up_options->above_header_ads): ?>
	
	<div id="ads_above_header">
		<?php echo $up_options->above_header_ads; ?>
	</div>
	
	<?php
	endif;

}
add_action('gar_aboveheader', 'ads_above_header');

// Create Header Ads
function ads_below_header(){

	global $up_options;
		
	if($up_options->top_ads): ?>
	
	<div id="ads_below_header">
		<?php echo $up_options->top_ads; ?>
	</div>
	
	<?php
	endif;

}
add_action('gar_belowheader', 'ads_below_header');

add_filter('query_vars','audioxml_add_trigger');

function audioxml_add_trigger($vars) {
    $vars[] = 'audioxml';
    return $vars;
}

add_action('template_redirect', 'audioxml_trigger_check');

function audioxml_trigger_check() {
	global $wp_query;
	if(intval(get_query_var('audioxml')) == 1) {
		
		include( TEMPLATEPATH . "/audio.php" );
		exit;
	}
}

// Create Footer Ads
function ads_above_footer(){
	global $up_options;

  if($up_options->bottom_ads){ ?>
  
    <div id="ads_above_footer">
     <?php echo $up_options->bottom_ads; ?>
    </div>
    
	<?php
	}
}
add_action('gar_abovefooter', 'ads_above_footer');

require_once(TEMPLATEPATH . '/carrington-build/carrington-build.php');

function featured_image_module($dirs) {
	array_push($dirs, trailingslashit(get_stylesheet_directory()).'library/cb_modules');
	return $dirs;
}
add_filter('cfct-module-dirs', 'featured_image_module', 11);

function add_slider_to_page(){

	if( is_page('sample-page') )
		add_action('above_page_content','audio_slider');

}

add_action('wp_head','add_slider_to_page');