<?php

global $up_options;

get_header();

?>

        <div id="content">
    
        	<div class="primary">
	            	            
	            <?php gar_above_searchloop() ?>

				<?php gar_searchloop(); ?>
                
                <?php gar_navigation_below(); ?>
                
                <?php gar_below_searchloop() ?>
                
            </div><!-- /.primary -->
                
            <?php gar_sidebar() ?>
            
            <div class="clear"></div>
            
        </div><!-- /#content -->

<?php get_footer() ?>