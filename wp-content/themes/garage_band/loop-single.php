    <ul class="entry_list">
    
        <?php $count = 1; /* Count the number of posts so we can insert a widgetized area */ 
          
        while ( have_posts() ) : the_post(); ?>
          
        <li id="post-<?php the_ID() ?>" <?php post_class(); ?>>
            
            <?php gar_postheader(); ?>
            
            <?php the_content(); ?>
            
            <?php gar_postfooter(); ?>

        </li><!-- .post.hentry -->
                                                    
        <?php endwhile; ?>

        <li><?php gar_comments_template(); ?></li>

    </ul><!-- /#blog -->