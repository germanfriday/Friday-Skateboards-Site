	<ul class="entry_list">
	
		<?php while ( have_posts() ) : the_post() ?>
		  
		<li id="post-<?php the_ID() ?>" <?php post_class(); ?>>
			
			<?php echo '<h2><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>'; ?>
			
			<?php the_excerpt(); ?>
			
			<?php gar_postfooter(); ?>

		</li><!-- .post.hentry -->
							
		<?php endwhile; ?>
		
	</ul><!-- /.entry-list -->
