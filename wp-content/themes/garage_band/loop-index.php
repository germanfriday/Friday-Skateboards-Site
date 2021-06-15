	<ul class="entry_list">
	
		<?php 
		
		wp_reset_query();
		
		$count = 1; /* Count the number of posts so we can insert a widgetized area */ 
		  
		while ( have_posts() ) : the_post() ?>
		  
		<li id="post-<?php the_ID() ?>" <?php post_class(); ?>>
			
			<?php echo '<h2><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>'; ?>
			
			<?php the_excerpt(); ?>
			
			<?php gar_postfooter(); ?>
			
			<?php
			if ($count==$up_options->insert_position) {
			  get_sidebar('index-insert');
			}
			$count = $count++;
			?>
			
		</li><!-- .post.hentry -->
							
		<?php endwhile; ?>
		
	</ul><!-- /#blog -->
