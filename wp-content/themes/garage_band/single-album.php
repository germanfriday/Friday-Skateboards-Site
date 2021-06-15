<?php

global $up_options;

get_header();

$myterms = get_terms('show', 'orderby=count&hide_empty=0');

//print_r($myterms);

?>

        <div id="content">

        	<div class="primary">
                
					<?php while ( have_posts() ) : the_post() ?>
                      
                    <?php grgbnd_show_album(); ?>
                                        
                    <?php endwhile; ?>

            </div><!-- /.primary -->
                
            <?php gar_sidebar(); ?>
            
            <div class="clear"></div>
            
        </div><!-- /#content -->

<?php get_footer() ?>