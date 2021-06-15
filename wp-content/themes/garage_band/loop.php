	<?php gar_page_title(); ?>
    
    <ul class="entry_list">
              
        <?php while ( have_posts() ) : the_post() ?>
          
        <li id="post-<?php the_ID() ?>" <?php post_class(); ?>>

            <?php if( get_post_type() == 'album' || get_post_type() == 'fan_gallery' ) the_post_thumbnail('thumbnail'); ?>
            
            <?php gar_postheader(); ?>
                        
            <?php the_excerpt(); ?>
            
            <?php if( get_post_type() == 'post' ) gar_postfooter(); ?>
            
            <div class="clear"></div>
            
        </li><!-- .post.hentry -->
                            
        <?php endwhile; ?>
        
    </ul><!-- /.entry-list -->