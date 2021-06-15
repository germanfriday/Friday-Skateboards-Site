<?php


// Located in comments.php
// Just before #comments
function gar_abovecomments() {
    do_action('gar_abovecomments');
}


// Located in comments.php
// Just before #comments-list
function gar_abovecommentslist() {
    do_action('gar_abovecommentslist');
}


// Located in comments.php
// Just after #comments-list
function gar_belowcommentslist() {
    do_action('gar_belowcommentslist');
}


// Located in comments.php
// Just before #trackbacks-list
function gar_abovetrackbackslist() {
    do_action('gar_abovetrackbackslist');
}


// Located in comments.php
// Just after #trackbacks-list
function gar_belowtrackbackslist() {
    do_action('gar_belowtrackbackslist');
}


// Located in comments.php
// Just before the comments form
function gar_abovecommentsform() {
    do_action('gar_abovecommentsform');
}


// Adds the Subscribe to comments button
function gar_show_subscription_checkbox() {
    if(function_exists('show_subscription_checkbox')) { show_subscription_checkbox(); }
}
add_action('comment_form', 'gar_show_subscription_checkbox', 98);


// Located in comments.php
// Just after the comments form
function gar_belowcommentsform() {
    do_action('gar_belowcommentsform');
}


// Adds the Subscribe without commenting button
function gar_show_manual_subscription_form() {
    if(function_exists('show_manual_subscription_form')) { show_manual_subscription_form(); }
}
add_action('gar_belowcommentsform', 'gar_show_manual_subscription_form', 5);


// Located in comments.php
// Just after #comments
function gar_belowcomments() {
    do_action('gar_belowcomments');
}


// creates the list comments arguments
function list_comments_arg() {
	$content = 'type=comment&callback=gar_comments';
	return apply_filters('list_comments_arg', $content);
}


// Produces an avatar image with the hCard-compliant photo class
function gar_commenter_link() {

	$GLOBALS['comment'] = $comment; 
	list($year, $month, $day, $hour, $minute, $second) = preg_Split('~[\- :]~', $comment->comment_date);
	echo $year;
	$comment_timestamp = mktime($hour, $minute, $second, $month, $day, $year);

	$commenter = get_comment_author_link();
	if ( ereg( '<a[^>]* class=[^>]+>', $commenter ) ) {
		$commenter = ereg_replace( '(<a[^>]* class=[\'"]?)', '\\1url ' , $commenter );
	} else {
		$commenter = ereg_replace( '(<a )/', '\\1class="url "' , $commenter );
	}
	$avatar_email = get_comment_author_email();
	$avatar_size = apply_filters( 'avatar_size', '64' ); // Available filter: avatar_size
	$avatar = str_replace( "class='avatar", "class='photo avatar", get_avatar( $avatar_email, $avatar_size ) );
	echo $avatar . ' <span class="said"><span class="fn n">' . $commenter . '</span> ' . __('said','garageband') . '</span>';
	echo '<span class="time">' . distance_of_time_in_words($comment_timestamp, time(), true);
	edit_comment_link(__('(Edit)'),'  ','');
	echo '</span>';
} // end gar_commenter_link


// A hook for the standard comments template
function gar_comments_template() {
	do_action('gar_comments_template');
} // end gar_comments


	// The standard comments template is injected into gar_comments_template() by default
	function gar_include_comments() {
		comments_template('', true);
	} // end gar_include_comments
	
	add_action('gar_comments_template','gar_include_comments',5);
	
	