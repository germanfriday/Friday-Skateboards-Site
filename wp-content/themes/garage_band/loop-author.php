<?php
		rewind_posts();
		while (have_posts()) : the_post(); ?>

			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    			<?php gar_postheader(); ?>
				<div class="entry-content ">
					<?php gar_content(); ?>
				</div>
				<?php gar_postfooter(); ?>
			</div><!-- .post -->

		<?php endwhile;