<?php

global $up_options;

get_header();

?>

        <div id="content">

        	<div class="primary">
                
				<?php gar_categoryloop(); ?>

                <?php gar_navigation_below(); ?> 
                
            </div><!-- /.primary -->
                
            <?php gar_sidebar() ?>
            
            <div class="clear"></div>
            
        </div><!-- /#content -->

<?php get_footer() ?>