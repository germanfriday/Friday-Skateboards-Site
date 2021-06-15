<?php

/*
Template Name: Music
*/

global $up_options;

get_header();

?>

        <div id="content">

        	<div class="primary">
        	    
				<?php gar_albumloop(); ?>

                <?php gar_navigation_below(); ?>
                
            </div><!-- /.primary -->
                
            <?php gar_sidebar() ?>
            
            <div class="clear"></div>
            
        </div><!-- /#content -->

<?php get_footer() ?>