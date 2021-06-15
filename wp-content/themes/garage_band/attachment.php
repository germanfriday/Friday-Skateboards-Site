<?php
global $up_options;
get_header()

?>

    <?php while ( have_posts() ) : the_post() ?>

    <div id="content" class="single attachment">
                                            
        <div id="post-<?php the_ID(); ?>">

            <h1 class="page-title"><?php the_title(); ?></h1>

            <div class="entry-attachment"><?php the_attachment_link($post->post_ID, true) ?></div>
<?php the_content(more_text()); ?>

                <?php wp_link_pages('before=<div class="page-link">' .__('Pages:', 'garageband') . '&after=</div>') ?>
            </div>

        </div><!-- .post -->            

    </div><!-- #content -->

    <div id="discussion">

        <?php gar_comments_template(); ?>
        
    </div>

    <?php endwhile; ?>
            
    <?php gar_sidebar() ?>

<?php get_footer() ?>