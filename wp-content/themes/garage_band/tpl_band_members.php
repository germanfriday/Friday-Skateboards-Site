<?php

/*
Template Name: Band Members
*/

global $up_options;

get_header();

?>

        <div id="content">
    
        	<div class="primary">
	            	            
				<?php while ( have_posts() ) : the_post(); ?>
                  
                <div id="post-<?php the_ID() ?>" <?php post_class(); ?>>
                    
                    <h1 class="page-title"><?php the_title(); ?></h1>
                                            
					<?php the_content(); ?>
					
                </div><!-- .post.hentry -->

                <?php endwhile; ?>

				<?php band_members(); ?> 
                                
            </div><!-- /.primary -->
                
            <?php gar_sidebar(); ?>
            
            <div class="clear"></div>
            
        </div><!-- /#content -->

<?php get_footer(); ?>