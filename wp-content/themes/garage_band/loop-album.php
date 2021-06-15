<?php

	global $post;

	while( have_posts() ): the_post();
	
		echo "<h1>" . get_the_title() . "</h1>";
		
		the_content();
		
	endwhile;
	
	wp_reset_query();

	$query_string = 'post_type=album&posts_per_page=40';

	query_posts($query_string); ?>
    
	<ul class="entry_list grid_three">
	
		<?php $count = 1; /* Count the number of posts so we can insert a widgetized area */ 
				
		while ( have_posts() ) : the_post();
		
		if( $count % 3 == 1 )
			echo '<li class="alpha">';
		elseif( $count % 3 == 0 )
			echo '<li class="omega">';
		else
			echo '<li>';
			
			
			echo "<div>";
		
			$release_date	= get_post_meta($post->ID, "release_date", true);
			$album_price	= get_post_meta($post->ID, "album_price", true);

			echo "<a href=" . get_permalink() . ">";
			the_post_thumbnail('album_thumb');
			echo "</a>";
							
			echo "<h3><a href=" . get_permalink() . ">" . get_the_title() . "</a></h3>";
			
			if( $release_date )
				echo '<div class="release_date">' . __('Release Date:','garageband') . " " . $release_date . "</div>";
									
			if( $album_price )
				echo '<div class="album_price">' . __('Price:','garageband') . " " . __('$') . $album_price . "</div>";

			echo "<p><a href=" . get_permalink() . ">" . __('View Album &raquo;','garageband') . "</a></p>";

			echo "</div></li>";
			
			$count++;

		endwhile; ?>
		
	</ul><!-- /#blog -->