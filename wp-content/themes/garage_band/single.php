<?php

global $up_options;

get_header();

?>

        <div id="content">
    
        	<div class="primary">

	            <?php get_sidebar('single-top') ?>
	            	            
	            <?php gar_single_post();?>
                
                <?php gar_navigation_below(); ?>
                            
            	<?php get_sidebar('single-bottom') ?>
                
            </div><!-- /.primary -->
                
            <?php gar_sidebar() ?>
            
            <div class="clear"></div>
            
        </div><!-- /#content -->

<?php get_footer() ?>