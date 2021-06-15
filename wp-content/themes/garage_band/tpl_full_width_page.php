<?php

/*
Template Name: Full-Width Page
*/

global $up_options;

get_header();

?>

        <div id="content">
    
        	<div class="primary full_width">
	                                                  
                    <?php if( have_posts() ): while ( have_posts() ) : the_post(); ?>
                      
                    <div id="post-<?php the_ID() ?>" <?php post_class(); ?>>
                        
                        <h1 class="page-title"><?php the_title(); ?></h1>
                                                
						<?php the_content(); ?>
						
                    </div>
                                                                
                    <?php endwhile; endif; ?>
                
            </div><!-- /.primary -->
            
            <div class="clear"></div>
            
        </div><!-- /#content -->

<?php get_footer() ?>