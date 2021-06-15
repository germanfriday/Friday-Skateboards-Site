<?php

global $up_options,$post;

get_header();

$myterms = get_terms('show', 'orderby=count&hide_empty=0');

//print_r($myterms);

?>

        <div id="content">

        	<div class="primary">

                <h1><?php _e("Fan Gallery for","garageband"); ?> <?php echo get_the_term_list($post->ID,'collection','',', ',''); ?></h1>

	            <?php gar_navigation_above();?>
                
                <ul id="blog">
                
					<?php $count = 1; /* Count the number of posts so we can insert a widgetized area */ 
                      
                    while ( have_posts() ) : the_post() ?>
                      
                    <li id="post-<?php the_ID() ?>" <?php post_class(); ?>>
                        
                        <?php the_post_thumbnail(array(570,9999)); ?>
                        
                        <h2><?php the_title(); ?></h2>
                        
                        <?php echo __('Posted by') . " " . get_the_author_link(); ?>

						<?php the_content(); ?>
						
                        <?php the_tags('<p class="tags"> #'," #","</p>"); ?>
                        
                        <?php
                        if ($count==$up_options->insert_position) {
                          get_sidebar('index-insert');
                        }
                        $count = $count++;
                        ?>
                        
                    </li><!-- .post.hentry -->
                                        
                    <?php endwhile; ?>
                    
                </ul><!-- /#blog -->
                
                <?php gar_navigation_below(); ?> 
                
            </div><!-- /.primary -->
                
            <?php gar_sidebar(); ?>
            
            <div class="clear"></div>
            
        </div><!-- /#content -->

<?php get_footer() ?>