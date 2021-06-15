<?php

global $up_options;

get_header();

?>

        <div id="content">

        	<div class="primary full_width">
                            
            	<h1><?php $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); echo $term->name; ?></h1>

	            <?php gar_navigation_above();?>

				<?php gar_fangalleryloop(); ?>

                <?php gar_navigation_below(); ?> 
                
            </div><!-- /.primary -->
                
            <div class="clear"></div>
            
        </div><!-- /#content -->

<?php get_footer() ?>