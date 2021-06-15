<?php

/*
Template Name: Shows List
*/

global $up_options;

get_header();

?>

        <div id="content">
    
        	<div class="primary">
            
            	<h1><?php the_title(); ?></h1>

				<?php wp_reset_query(); ?>
            	
				<?php shows_list(); ?>
                
                <?php gar_navigation_below(); ?>
                                
            </div><!-- /.primary -->
                
            <?php gar_sidebar(); ?>
            
            <div class="clear"></div>
            
        </div><!-- /#content -->

<?php get_footer(); ?>