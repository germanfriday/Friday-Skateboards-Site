<?php


// CSS markup before the widget
function thematic_before_widget() {
	$content = '<li id="%1$s" class="widgetcontainer %2$s">';
	return apply_filters('thematic_before_widget', $content);
}

// CSS markup after the widget
function thematic_after_widget() {
	$content = '</li>';
	return apply_filters('thematic_after_widget', $content);
}

// CSS markup before the widget title
function thematic_before_title() {
	$content = "<h3 class=\"widgettitle\">";
	return apply_filters('thematic_before_title', $content);
}

// CSS markup after the widget title
function thematic_after_title() {
	$content = "</h3>\n";
	return apply_filters('thematic_after_title', $content);
}

/**
 * Search widget class
 *
 * @since 0.9.6.3
 */
class THM_Widget_Search extends WP_Widget {

	function THM_Widget_Search() {
		$widget_ops = array('classname' => 'widget_search', 'description' => __( "A search form for your blog") );
		$this->WP_Widget('search', __('Search', 'thematic'), $widget_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Search', 'thematic') : $instance['title']);

		echo $before_widget;
		if ( $title )
			echo $before_title ?><label for="s"><?php echo $title ?></label><?php echo $after_title;

		// Use current theme search form if it exists
		get_search_form();

		echo $after_widget;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '') );
		$title = $instance['title'];
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$new_instance = wp_parse_args((array) $new_instance, array( 'title' => ''));
		$instance['title'] = strip_tags($new_instance['title']);
		return $instance;
	}

}

/**
 * Meta widget class
 *
 * Displays log in/out
 *
 * @since 0.9.6.3
 */
class THM_Widget_Meta extends WP_Widget {

	function THM_Widget_Meta() {
		$widget_ops = array('classname' => 'widget_meta', 'description' => __( "Log in/out and admin", 'thematic') );
		$this->WP_Widget('twitter', __('Meta', 'thematic'), $widget_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Meta', 'thematic') : $instance['title']);

		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title;
?>
			<ul>
			<?php wp_register(); ?>
			<li><?php wp_loginout(); ?></li>
			<?php wp_meta(); ?>
			</ul>
<?php
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);

		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
		$title = strip_tags($instance['title']);
?>
			<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
<?php
	}
}
    
/**
 * RSS links widget class
 *
 * @since 0.9.6.3
 */
class THM_Widget_RSSlinks extends WP_Widget {

	function THM_Widget_RSSlinks() {
		$widget_ops = array( 'description' => __('Links to your posts and comments feed', 'thematic') );
		$this->WP_Widget( 'rss-links', __('RSS Links', 'thematic'), $widget_ops);
	}

	function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', empty($instance['title']) ? __('RSS Links', 'thematic') : $instance['title']);
		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title;
?>
			<ul>
				<li><a href="<?php bloginfo('rss2_url') ?>" title="<?php echo esc_html(get_bloginfo('name')) ?> <?php _e('Posts RSS feed', 'thematic'); ?>" rel="alternate nofollow" type="application/rss+xml"><?php _e('All posts', 'thematic') ?></a></li>
				<li><a href="<?php bloginfo('comments_rss2_url') ?>" title="<?php echo esc_html(get_bloginfo('name')) ?> <?php _e('Comments RSS feed', 'thematic'); ?>" rel="alternate nofollow" type="application/rss+xml"><?php _e('All comments', 'thematic') ?></a></li>
			</ul>
<?php
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);

		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
		$title = strip_tags($instance['title']);
?>
			<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
<?php
	}
}

/**
 * Twitter Widget class.
 *
 * @since 0.1
 */
class Twitter_Widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function Twitter_Widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'twitter', 'description' => __('A widget for displaying your twitter feed.', 'garageband') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'twitter-widget' );

		/* Create the widget. */
		$this->WP_Widget( 'twitter-widget', __('Twitter Widget', 'garageband'), $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );
		
		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$twitter = $instance['twitter'];
		$count = $instance['count'];

		/* Before widget (defined by themes). */
		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title;
		/* Display name from widget settings if one was input. */
		if ( $twitter ): ?>

			<div class="twitter">
            
            	<div class="<?php echo $args['widget_id']; ?>"></div>
                	<script src="<?php bloginfo('template_url'); ?>/library/scripts/jquery.tweet.js"></script>
				<script type="text/javascript">
                    jQuery("#<?php echo $args['widget_id']; ?> .<?php echo $args['widget_id']; ?>").tweet({
                        username: "<?php echo $twitter; ?>",
                        join_text: "auto",
                        avatar_size: 32,
                        count: <?php echo $count; ?>,
                        auto_join_text_default: "", 
                        auto_join_text_ed: "",
                        auto_join_text_ing: "",
                        auto_join_text_reply: "",
                        auto_join_text_url: "",
                        loading_text: "<?php _e("Loading tweets..."); ?>"
                    });
                </script>
				
                <a class="follow" href="http://twitter.com/<?php echo $twitter; ?>">Follow <?php echo $twitter; ?></a>
                
                <div class="clear"></div>
                
            </div>
			
			<?php
			endif;

		/* After widget (defined by themes). */
		echo $after_widget;
	}

	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['twitter'] = strip_tags( $new_instance['twitter'] );
		$instance['count'] = strip_tags( $new_instance['count'] );

		return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => __('Twitter Widget', 'garageband'), 'twitter' => __('upthemes', 'garageband') );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'garageband'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:93%;" />
		</p>

		<!-- Twitter: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'twitter' ); ?>"><?php _e('Twitter Username:', 'garageband'); ?></label>
			<input id="<?php echo $this->get_field_id( 'twitter' ); ?>" name="<?php echo $this->get_field_name( 'twitter' ); ?>" value="<?php echo $instance['twitter']; ?>" style="width:93%;" />
		</p>

		<!-- Count: Select -->
		<p>
			<label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php _e('Number of Tweets:', 'garageband'); ?></label>
			<select id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" value="<?php echo $instance['count']; ?>">
            	<option value="1"<?php if($instance['count']==1) echo " selected"; ?>>1</option>
            	<option value="2"<?php if($instance['count']==2) echo " selected"; ?>>2</option>
            	<option value="3"<?php if($instance['count']==3) echo " selected"; ?>>3</option>
            	<option value="4"<?php if($instance['count']==4) echo " selected"; ?>>4</option>
            	<option value="5"<?php if($instance['count']==5) echo " selected"; ?>>5</option>
            	<option value="6"<?php if($instance['count']==6) echo " selected"; ?>>6</option>
            	<option value="7"<?php if($instance['count']==7) echo " selected"; ?>>7</option>
            	<option value="8"<?php if($instance['count']==8) echo " selected"; ?>>8</option>
            	<option value="9"<?php if($instance['count']==9) echo " selected"; ?>>9</option>
            	<option value="10"<?php if($instance['count']==10) echo " selected"; ?>>10</option>
            </select>
		</p>

	<?php
	}
}