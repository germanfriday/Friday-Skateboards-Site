	<ul class="entry_list">
	
		<?php while ( have_posts() ) : the_post() ?>
		  
		<li id="post-<?php the_ID() ?>" <?php post_class(); ?>>
			
			<?php gar_postheader(); ?>
			
			<?php the_excerpt(); ?>
			
			<?php gar_postfooter(); ?>
						
		</li><!-- .post.hentry -->
							
		<?php endwhile; ?>
		
	</ul><!-- /#blog -->