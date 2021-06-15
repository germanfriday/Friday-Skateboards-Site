<?php

global $up_options;

get_header();

?>

        <div id="content">

        	<div class="primary">
                
                <h1><?php _e('Upcoming Shows by Venue:',"garageband"); ?> <?php $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); echo $term->name; ?></h1>
                
	            <?php gar_navigation_above(); ?>

				<?php shows_list(); ?>

                <?php gar_navigation_below(); ?> 
                
            </div><!-- /.primary -->
                
            <?php gar_sidebar() ?>
            
            <div class="clear"></div>
            
        </div><!-- /#content -->

<?php get_footer() ?>