<?php

global $up_options;

get_header();

$myterms = get_terms('show', 'orderby=count&hide_empty=0');

//print_r($myterms);

?>

        <div id="content">

        	<div class="primary">

				<?php while ( have_posts() ) : the_post() ?>
                
                <div id="post-<?php the_ID() ?>" <?php post_class(); ?>>
                
					<?php the_post_thumbnail(array(570,9999)); ?>
                                        
                    <h1 class="page-title"><?php the_title(); ?></h1>

					<?php
                    
                    $timestamp = get_post_meta(get_the_ID(), 'datetime', true);
                    echo convert_timestamp($timestamp, "g:s A, F d, Y") . " ";

                    $location = get_post_meta(get_the_ID(), 'location', true);
                    
                    $ticketlink = get_post_meta(get_the_ID(), 'ticketlink', true);
                    
                    if( $ticketlink )
	                    echo "<p><a href='" . $ticketlink . "'>" . __('Buy Tickets','garageband') . "</a></p>";

                    $admission = get_post_meta(get_the_ID(), 'admission', true);
                    
                    if( $admission )
	                    echo "<p>" . $admission . "</p>";

					?>
					                    
					<?php the_content(); ?>
                                                            
                </div>

                <?php gar_comments_template(); ?>

                <?php endwhile; ?>
                    
            </div><!-- /.primary -->
                
            <?php gar_sidebar(); ?>
            
            <div class="clear"></div>
            
        </div><!-- /#content -->

<?php get_footer() ?>