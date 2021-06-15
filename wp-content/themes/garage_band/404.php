<?php @header("HTTP/1.1 404 Not found", TRUE, 404); ?>
<?php

global $up_options;

get_header();

?>

        <div id="content">
    
        	<div class="primary">

	            <?php gar_navigation_above();?>
	            
	            <?php get_sidebar('single-top') ?>
	            
                <ul id="blog">
                                      
                    <li id="post-<?php the_ID() ?>" <?php post_class(); ?>>
                        
                        <h1><?php _e("404: Page Not Found","evo"); ?></h1>
                    
                    	<p><?php _e("Unfortunately, the page you are looking for is in this particular location. Please click the back button or try a search below.","evo"); ?></p>
                    
                    	<?php get_search_form(); ?>
                    
                    </li><!-- .post.hentry -->

                </ul><!-- /#blog -->
                
                <?php gar_navigation_below(); ?>
                            
            	<?php get_sidebar('single-bottom') ?>    
                
            </div><!-- /.primary -->
                
            <?php gar_sidebar() ?>
            
            <div class="clear"></div>
            
        </div><!-- /#content -->

<?php get_footer() ?>