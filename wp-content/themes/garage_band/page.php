<?php

global $up_options;

get_header();

?>

        <div id="content">

            <?php do_action('above_page_content'); ?>

        	<div class="primary">

	            <?php gar_navigation_above();?>	            
	            
	            <?php get_sidebar('page-top') ?>
	                            
					<?php $count = 1; /* Count the number of posts so we can insert a widgetized area */ 
                      
                    while ( have_posts() ) : the_post(); ?>
                      
                    <div id="post-<?php the_ID() ?>" <?php post_class(); ?>>
                        
                        <h1><?php the_title(); ?></h1>
                                                
						<?php the_content(); ?>
						
                        <?php the_tags('<p class="tags"> #'," #","</p>"); ?>

                    </div>
                                                                
                    <?php endwhile; ?>

					<?php gar_comments_template(); ?>
                
                <?php gar_navigation_below(); ?>
                            
            	<?php get_sidebar('page-bottom') ?>    
                
            </div><!-- /.primary -->
                
            <?php gar_sidebar() ?>
            
            <div class="clear"></div>
            
        </div><!-- /#content -->

<?php get_footer() ?>