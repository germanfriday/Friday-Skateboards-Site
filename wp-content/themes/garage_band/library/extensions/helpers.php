<?php

// create bullet-proof excerpt for meta name="description"

function gar_trim_excerpt($text) {
	if ( '' == $text ) {
		$text = get_the_content('');

		$text = strip_shortcodes( $text );

		$text = str_replace(']]>', ']]&gt;', $text);
		$text = strip_tags($text);
	  $text = str_replace('"', '\'', $text);
		$excerpt_length = apply_filters('excerpt_length', 55);
		$words = explode(' ', $text, $excerpt_length + 1);
		if (count($words) > $excerpt_length) {
			array_pop($words);
			array_push($words, '[...]');
			$text = implode(' ', $words);
		}
	}
	return $text;
}

function convert_timestamp($timestamp, $format) {
	ereg("([0-9]{4})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})", $timestamp, $regs);
	$new_timestamp = mktime($regs[4],$regs[5],$regs[6],$regs[2],$regs[3],$regs[1]);
	$date = date($format, $new_timestamp);
	return $date;
}

function add_fancybox(){
	

	wp_register_script('jquery.easing',get_bloginfo('template_url') . "/library/fancybox/jquery.easing-1.3.pack.js");
	wp_register_script('jquery.mousewheel',get_bloginfo('template_url') . "/library/fancybox/jquery.mousewheel-3.0.2.pack.js");
	wp_register_script('fancybox',get_bloginfo('template_url') . "/library/fancybox/jquery.fancybox-1.3.1.pack.js",array('jquery.mousewheel','jquery.easing'));
	
	wp_register_style('fancybox',get_bloginfo('template_url') . "/library/fancybox/jquery.fancybox-1.3.1.css");
	
	wp_enqueue_style('fancybox');
	wp_enqueue_script('fancybox');
	
}

add_action('init','add_fancybox');

function format_date($format,$dateStr) {
	if (trim($dateStr) == '' || substr($dateStr,0,10) == '0000-00-00') {
		return '';
	}
	$ts = strtotime($dateStr);
	if ($ts === false) {
		return '';
	}
	return date($format,$ts);
} 

function get_terms_dropdown($taxonomies, $args){
	$myterms = get_terms($taxonomies, $args);
	$output ="<select>";
	foreach($myterms as $term){
		$root_url = get_bloginfo('url');
		$term_taxonomy=$term->taxonomy;
		$term_slug=$term->slug;
		$term_name =$term->name;
		$link = $root_url.'/'.$term_taxonomy.'/'.$term_slug;
		$output .="<option value='".$link."'>".$term_name."</option>";
	}
	$output .="</select>";
return $output;
}

function gar_the_excerpt($deprecated = '') {
	global $post;
	$output = '';
	$output = strip_tags($post->post_excerpt);
	$output = str_replace('"', '\'', $output);
	if ( post_password_required($post) ) {
		$output = __('There is no excerpt because this is a protected post.','garageband');
		return $output;
	}

	return $output;
	
}

function gar_excerpt_rss() {
	global $post;
	$output = '';
	$output = strip_tags($post->post_excerpt);
	if ( post_password_required($post) ) {
		$output = __('There is no excerpt because this is a protected post.','garageband');
		return $output;
}

	return apply_filters('gar_excerpt_rss', $output);

}

add_filter('gar_excerpt_rss', 'gar_trim_excerpt');

// create nice multi_tag_title
// Credits: Martin Kopischke for providing this code

function gar_tag_query() {
	$nice_tag_query = get_query_var('tag'); // tags in current query
	$nice_tag_query = str_replace(' ', '+', $nice_tag_query); // get_query_var returns ' ' for AND, replace by +
	$tag_slugs = preg_split('%[,+]%', $nice_tag_query, -1, PREG_SPLIT_NO_EMPTY); // create array of tag slugs
	$tag_ops = preg_split('%[^,+]*%', $nice_tag_query, -1, PREG_SPLIT_NO_EMPTY); // create array of operators

	$tag_ops_counter = 0;
	$nice_tag_query = '';

	foreach ($tag_slugs as $tag_slug) { 
		$tag = get_term_by('slug', $tag_slug ,'post_tag');
		// prettify tag operator, if any
		if ($tag_ops[$tag_ops_counter] == ',') {
			$tag_ops[$tag_ops_counter] = ', ';
		} elseif ($tag_ops[$tag_ops_counter] == '+') {
			$tag_ops[$tag_ops_counter] = ' + ';
		}
		// concatenate display name and prettified operators
		$nice_tag_query = $nice_tag_query.$tag->name.$tag_ops[$tag_ops_counter];
		$tag_ops_counter += 1;
	}
	 return $nice_tag_query;
}

// Returns the distance of time in words between two dates
function distance_of_time_in_words($from_time, $to_time = null, $include_seconds = false)
{
  $to_time = $to_time? $to_time: time();
 
  $distance_in_minutes = floor(abs($to_time - $from_time) / 60);
  $distance_in_seconds = floor(abs($to_time - $from_time));
 
  $string = '';
  $parameters = array();
 
  if ($distance_in_minutes <= 1)
  {
    if (!$include_seconds)
    {
      $string = $distance_in_minutes == 0 ? 'less than a minute' : '1 minute';
    }
    else
    {
      if ($distance_in_seconds <= 5)
      {
        $string = 'less than 5 seconds';
      }
      else if ($distance_in_seconds >= 6 && $distance_in_seconds <= 10)
      {
        $string = 'less than 10 seconds';
      }
      else if ($distance_in_seconds >= 11 && $distance_in_seconds <= 20)
      {
        $string = 'less than 20 seconds';
      }
      else if ($distance_in_seconds >= 21 && $distance_in_seconds <= 40)
      {
        $string = 'half a minute';
      }
      else if ($distance_in_seconds >= 41 && $distance_in_seconds <= 59)
      {
        $string = 'less than a minute';
      }
      else
      {
        $string = '1 minute';
      }
    }
  }
  else if ($distance_in_minutes >= 2 && $distance_in_minutes <= 44)
  {
    $string = '%minutes% minutes';
    $parameters['%minutes%'] = $distance_in_minutes;
  }
  else if ($distance_in_minutes >= 45 && $distance_in_minutes <= 89)
  {
    $string = 'about 1 hour';
  }
  else if ($distance_in_minutes >= 90 && $distance_in_minutes <= 1439)
  {
    $string = 'about %hours% hours';
    $parameters['%hours%'] = round($distance_in_minutes / 60);
  }
  else if ($distance_in_minutes >= 1440 && $distance_in_minutes <= 2879)
  {
    $string = '1 day';
  }
  else if ($distance_in_minutes >= 2880 && $distance_in_minutes <= 43199)
  {
    $string = '%days% days';
    $parameters['%days%'] = round($distance_in_minutes / 1440);
  }
  else if ($distance_in_minutes >= 43200 && $distance_in_minutes <= 86399)
  {
    $string = 'about 1 month';
  }
  else if ($distance_in_minutes >= 86400 && $distance_in_minutes <= 525959)
  {
    $string = '%months% months';
    $parameters['%months%'] = round($distance_in_minutes / 43200);
  }
  else if ($distance_in_minutes >= 525960 && $distance_in_minutes <= 1051919)
  {
    $string = 'about 1 year';
  }
  else
  {
    $string = 'over %years% years';
    $parameters['%years%'] = floor($distance_in_minutes / 525960);
  }
 
  return strtr($string, $parameters);
}

add_action( 'show_user_profile', 'band_extra_profile_fields' );
add_action( 'edit_user_profile', 'band_extra_profile_fields' );

function band_extra_profile_fields( $user ) { ?>

	<h3><?php _e('Band Member Information','garageband'); ?></h3>

	<table class="form-table">

		<tr>
			<th>Is Band Member</th>

			<td>
				<label for="is_band_member"><input type="checkbox" name="is_band_member" id="is_band_member" class="checkbox" <?php if( get_the_author_meta( 'is_band_member', $user->ID) ) echo "checked"; ?> /> 
				 <?php _e('Is this user a member of the band?','garageband'); ?></label>
			</td>
		</tr>

		<tr>
			<th><label for="band_role"><?php _e('Role in Band','garageband'); ?></label></th>

			<td>
				<input type="text" name="band_role" id="band_role" value="<?php echo esc_attr( get_the_author_meta( 'band_role', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php _e('Please enter your role in the band (if you have one).','garageband'); ?></span>
			</td>
		</tr>

	</table>
<?php }

add_action( 'personal_options_update', 'band_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'band_save_extra_profile_fields' );

function band_save_extra_profile_fields( $user_id ) {

	if ( !current_user_can( 'edit_user', $user_id ) )
		return false;

	/* Copy and paste this line for additional fields. Make sure to change 'twitter' to the field ID. */
	update_usermeta( $user_id, 'band_role', $_POST['band_role'] );
	update_usermeta( $user_id, 'is_band_member', $_POST['is_band_member'] );
}

?>