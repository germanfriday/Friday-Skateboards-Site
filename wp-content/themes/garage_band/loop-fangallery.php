<?php gar_page_title(); ?>

	<ul id="fan_gallery">
	
		<?php while ( have_posts() ) : the_post() ?>
        
        <?php $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large', false, '' ); ?>
		  
		<li id="post-<?php the_ID() ?>" <?php post_class(); ?>>
						
			<a title="<?php the_title(); ?>" href="<?php echo $src[0]; ?>" class="fancybox" rel="collection"><?php the_post_thumbnail('thumbnail'); ?></a>

		</li><!-- .post.hentry -->
					
		<?php endwhile; ?>
		
	</ul><!-- /#fan_gallery -->
    
    <div class="clear"></div>