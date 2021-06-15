<?php

global $up_options;

get_header();

?>

        <div id="content">

			<?php do_action('above_index_content'); ?>
    
        	<div class="primary">
	            
	            <?php get_sidebar('index-top') ?>
	            
	            <?php gar_above_indexloop() ?>

				<?php gar_indexloop(); ?>
                
                <?php gar_navigation_below(); ?>
                
                <?php gar_below_indexloop() ?>
            
            	<?php get_sidebar('index-bottom') ?>    
                
            </div><!-- /.primary -->
                
            <?php gar_sidebar() ?>
            
            <div class="clear"></div>
            
        </div><!-- /#content -->

<?php get_footer() ?>