<?php

// Located in archives.php
// Just after the content
function gar_archives() {
		do_action('gar_archives');
} // end gar_archives


// Located in archive.php, author.php, category.php, index.php, search.php, single.php, tag.php
// Just before the content
function gar_navigation_above() {
		do_action('gar_navigation_above');
} // end gar_navigation_above

// Located in archive.php, author.php, category.php, index.php, search.php, single.php, tag.php
// Just after the content
function gar_navigation_below() {
		do_action('gar_navigation_below');
} // end gar_navigation_below

// Located in index.php 
// Just before the loop
function gar_above_indexloop() {
    do_action('gar_above_indexloop');
} // end gar_above_indexloop

// Located in taxonomy-fan_gallery.php
// The Loop
function gar_fangalleryloop() {
		do_action('gar_fangalleryloop');
} // end gar_fangalleryloop

// Located in taxonomy-venue.php
// The Loop
function gar_venueloop() {
		do_action('gar_venueloop');
} // end gar_venueloop

// Located in tpl_music.php
// The Loop
function gar_albumloop() {
		do_action('gar_albumloop');
} // end gar_albumloop

// Located in archive.php
// The Loop
function gar_archiveloop() {
		do_action('gar_archiveloop');
} // end gar_archiveloop

// Located in author.php
// The Loop
function gar_authorloop() {
		do_action('gar_authorloop');
} // end gar_authorloop

// Located in category.php
// The Loop
function gar_categoryloop() {
		do_action('gar_categoryloop');
} // end gar_categoryloop

// Located in index.php
// The Loop
function gar_indexloop() {
		do_action('gar_indexloop');
} // end gar_indexloop

// Located in search.php
// The Loop
function gar_searchloop() {
		do_action('gar_searchloop');
} // end gar_searchloop

// Located in single.php
// The Post
function gar_singlepost() {
		do_action('gar_singlepost');
} //end gar_singlepost

// Located in tag.php
// The Loop
function gar_tagloop() {
		do_action('gar_tagloop');
} // end gar_tagloop

// Located in index.php 
// Just after the loop
function gar_below_indexloop() {
    do_action('gar_below_indexloop');
} // end gar_below_indexloop


// Located in category.php 
// Just before the loop
function gar_above_categoryloop() {
    do_action('gar_above_categoryloop');
} // end gar_above_categoryloop


// Located in category.php 
// Just after the loop
function gar_below_categoryloop() {
    do_action('gar_below_categoryloop');
} // end gar_below_categoryloop


// Located in search.php 
// Just before the loop
function gar_above_searchloop() {
    do_action('gar_above_searchloop');
} // end gar_above_searchloop


// Located in search.php 
// Just after the loop
function gar_below_searchloop() {
    do_action('gar_below_searchloop');
} // end gar_below_searchloop


// Located in tag.php 
// Just before the loop
function gar_above_tagloop() {
    do_action('gar_above_tagloop');
} // end gar_above_tagloop


// Located in tag.php 
// Just after the loop
function gar_below_tagloop() {
    do_action('gar_below_tagloop');
} // end gar_below_tagloop


// Filter the page title
// located in archive.php, attachement.php, author.php, category.php, search.php, tag.php
function gar_page_title() {
		$content = '';
		if (is_attachment()) {
				$content .= '<h2 class="page-title"><a href="';
				$content .= get_permalink($post->post_parent);
				$content .= '" rev="attachment"><span class="meta-nav">&laquo; </span>';
				$content .= get_the_title($post->post_parent);
				$content .= '</a></h2>';
		} elseif (is_author()) {
				$content .= '<h1 class="page-title author">';
				$author = get_the_author();
				$content .= __('Author Archives: ', 'garageband');
				$content .= '<span>';
				$content .= $author;
				$content .= '</span></h1>';
		} elseif (is_category()) {
				$content .= '<h1 class="page-title">';
				$content .= ' <span>';
				$content .= single_cat_title('', FALSE);
				$content .= '</span></h1>' . "\n";
				$content .= '<div class="archive-meta">';
				if ( !(''== category_description()) ) : $content .= apply_filters('archive_meta', category_description()); endif;
				$content .= '</div>';
		} elseif (is_search()) {
				$content .= '<h1 class="page-title">';
				$content .= __('Search Results for:', 'garageband');
				$content .= ' <span id="search-terms">';
				$content .= wp_specialchars(stripslashes($_GET['s']), true);
				$content .= '</span></h1>';
		} elseif (is_tag()) {
				$content .= '<h1 class="page-title">';
				$content .= __('Tag Archives:', 'garageband');
				$content .= ' <span>';
				$content .= __(gar_tag_query());
				$content .= '</span></h1>';
		}	elseif (is_day()) {
				$content .= '<h1 class="page-title">';
				$content .= sprintf(__('Daily Archives: <span>%s</span>', 'garageband'), get_the_time(get_option('date_format')));
				$content .= '</h1>';
		} elseif (is_month()) {
				$content .= '<h1 class="page-title">';
				$content .= sprintf(__('Monthly Archives: <span>%s</span>', 'garageband'), get_the_time('F Y'));
				$content .= '</h1>';
		} elseif (is_year()) {
				$content .= '<h1 class="page-title">';
				$content .= sprintf(__('Yearly Archives: <span>%s</span>', 'garageband'), get_the_time('Y'));
				$content .= '</h1>';

		} elseif (is_taxonomy($wp_query->query_vars['taxonomy'])) {
			if (is_term($wp_query->query_vars['term'])) {
				$content .= '<h2 class="pagetitle">' . $wp_query->query_vars['taxonomy'] . ' - ' . $wp_query->query_vars['term'] . '</h2>';
			} else {
				$content .= '<h2 class="pagetitle">' . $wp_query->query_vars['taxonomy'] . '</h2>';
			}
		} elseif ($post->post_type !== 'post') {
				$content .= '<h2 class="pagetitle">' . $post->post_type . '</h2>';
		} elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {
				$content .= '<h1 class="page-title">';
				$content .= __('Blog Archives', 'garageband');
				$content .= '</h1>';
		}
		$content .= "\n";
		echo apply_filters('gar_page_title', $content);
}

// Action to create the above navigation
function gar_nav_above() {
		if (is_single()) { ?>

			<div id="nav-above" class="navigation">
				<div class="nav-previous"><?php gar_previous_post_link() ?></div>
				<div class="nav-next"><?php gar_next_post_link() ?></div>
			</div>

<?php
		} else { ?>

			<div id="nav-above" class="navigation<?php if(function_exists('wp_pagenavi')) echo " pagenavi"; ?>">
                <?php if(function_exists('wp_pagenavi')) { ?>
                <?php wp_pagenavi(); ?>
                <?php } else { ?>  
				<div class="nav-previous"><?php next_posts_link(__('<span class="meta-nav">&laquo;</span> Older posts', 'garageband')) ?></div>
				<div class="nav-next"><?php previous_posts_link(__('Newer posts <span class="meta-nav">&raquo;</span>', 'garageband')) ?></div>
				<?php } ?>
			</div>	
	
<?php
		}
}
add_action('gar_navigation_above', 'gar_nav_above', 2);

// The Archive Loop
function gar_archive_loop() {
	
	get_template_part('loop','archive');
	
}
add_action('gar_archiveloop', 'gar_archive_loop');

// The Fan Gallery Loop
function gar_fan_gallery_loop() {
	
	get_template_part('loop','fangallery');

}
add_action('gar_fangalleryloop', 'gar_fan_gallery_loop');

function shows_list(){ 
	global $post, $wp_query;
	wp_reset_query();
	?>

    <table>
    
    <thead>
    
        <tr>
            <th><?php _e('Show',"garageband"); ?></th>
            <th><?php _e('Date/Time',"garageband"); ?></th>
            <th><?php _e('Location',"garageband"); ?></th>
            <th><?php _e('Venue',"garageband"); ?></th>
        </tr>
        
    </thead>
    
    <?php 
	
	$query  = 'post_type=show&orderby=datetime&meta_key=datetime&order=ASC';
	
	if( get_query_var( 'term' ) && get_query_var( 'taxonomy' ) )
		$query .= '&' . get_query_var( 'taxonomy' ) . "=" . get_query_var( 'term' );
	
	?>

    <?php query_posts($query); ?>
               
    <?php while ( have_posts() ) : the_post(); ?>
      
    <tr id="post-<?php the_ID() ?>" <?php post_class(); ?>>
        <td>
            <a href="<?php echo the_permalink(); ?>"><?php the_title(); ?></a>
        </td>
        <td>
            <?php
            $timestamp = get_post_meta(get_the_ID(), 'datetime', true);
            echo convert_timestamp($timestamp, "g:s A, F d, Y") . " ";
            ?>
        </td>
        <td>
            <?php echo get_the_term_list( $post->ID, 'location', '', ', ', '' ); ?>
        </td>
        <td>
            <?php echo get_the_term_list( $post->ID, 'venue', '', ', ', '' ); ?>
        </td>
    </tr><!-- .post.hentry -->

    <?php endwhile; ?>
    
    </table>
<?php	
}

// The Author Loop
function gar_author_loop() {

	get_template_part('loop','author');
	
}
add_action('gar_authorloop', 'gar_author_loop');

// The Category Loop
function gar_category_loop() {

	get_template_part('loop','category');

}
add_action('gar_categoryloop', 'gar_category_loop');

// The Category Loop
function gar_album_loop() {

	get_template_part('loop','album');

}
add_action('gar_albumloop', 'gar_album_loop');

// The Index Loop
function gar_index_loop() {

	get_template_part('loop','index');

}
add_action('gar_indexloop', 'gar_index_loop');

// The Single Post
function gar_single_post() {

	get_template_part('loop','single');

}
add_action('gar_singlepost', 'gar_single_post');

// The Search Loop
function gar_search_loop() {

	get_template_part('loop','search');

}
add_action('gar_searchloop', 'gar_search_loop');

// The Tag Loop
function gar_tag_loop() {

	get_template_part('loop','tag');

}
add_action('gar_tagloop', 'gar_tag_loop');

// Filter to create the time url title displayed in Post Header
function gar_time_title() {

  $time_title = 'Y-m-d\TH:i:sO';

	// Filters should return correct 
	$time_title = apply_filters('gar_time_title', $time_title);
	
	return $time_title;
} // end gar_time_title


// Filter to create the time displayed in Post Header
function gar_time_display() {

  $time_display = get_option('date_format');

	// Filters should return correct 
	$time_display = apply_filters('gar_time_display', $time_display);
	
	return $time_display;
} // end gar_time_display

// Information in Post Header
function gar_postheader() {
    global $id, $post, $authordata;

	echo '<h1><a href="' . get_permalink() . '">' . get_the_title() . '</a></h1>';
    if( is_single() ){
    	echo '<p class="posted_by">' . __('Posted in',"garageband") . ' ' . get_the_category_list(", ") . ' ' . __('by',"garageband") . ' ' . get_the_author(). '</p>';
	}
	
} // end gar_postheader


//creates the content
function gar_content() {

	if (is_home() || is_front_page()) { 
		$content = 'full';
	} elseif (is_single()) {
		$content = 'full';
	} elseif (is_tag()) {
		$content = 'excerpt';
	} elseif (is_search()) {
		$content = 'excerpt';	
	} elseif (is_category()) {
		$content = 'excerpt';
	} elseif (is_author()) {
		$content = 'excerpt';
	} elseif (is_archive()) {
		$content = 'excerpt';
	}
	
	$content = apply_filters('gar_content', $content);

	if ( strtolower($content) == 'full' ) {
		$post = get_the_content(more_text());
		$post = apply_filters('the_content', $post);
		$post = str_replace(']]>', ']]&gt;', $post);
	} elseif ( strtolower($content) == 'excerpt') {
		$post = get_the_excerpt();
	} elseif ( strtolower($content) == 'none') {
	} else {
		$post = get_the_content(more_text());
		$post = apply_filters('the_content', $post);
		$post = str_replace(']]>', ']]&gt;', $post);
	}
	echo apply_filters('gar_post', $post);
} // end gar_content

// Functions that hook into gar_archives()

		// Open .archives-page
		function gar_archivesopen() { ?>
				<ul id="archives-page" class="xoxo">
		<?php }
		add_action('gar_archives', 'gar_archivesopen', 1);

		// Display the Category Archives
		function gar_category_archives() { ?>
						<li id="category-archives" class="content-column">
							<h2><?php _e('Archives by Category', 'garageband') ?></h2>
							<ul>
								<?php wp_list_categories('optioncount=1&feed=RSS&title_li=&show_count=1') ?> 
							</ul>
						</li>
		<?php }
		add_action('gar_archives', 'gar_category_archives', 3);

		// Display the Monthly Archives
		function gar_monthly_archives() { ?>
						<li id="monthly-archives" class="content-column">
							<h2><?php _e('Archives by Month', 'garageband') ?></h2>
							<ul>
								<?php wp_get_archives('type=monthly&show_post_count=1') ?>
							</ul>
						</li>
		<?php }
		add_action('gar_archives', 'gar_monthly_archives', 5);

		// Close .archives-page
		function gar_archivesclose() { ?>
				</ul>
		<?php }
		add_action('gar_archives', 'gar_archivesclose', 9);
		
// End of functions that hook into gar_archives()


// Action hook called in 404.php
function gar_404() {
	do_action('gar_404');
} // end gar_404


	// 404 content injected into gar_404
	function gar_404_content() { ?>
   			<?php gar_postheader(); ?>
   			
				<div class="entry-content">
					<p><?php _e('Apologies, but we were unable to find what you were looking for. Perhaps  searching will help.', 'garageband') ?></p>
				</div>
				
				<form id="error404-searchform" method="get" action="<?php bloginfo('home') ?>">
					<div>
						<input id="error404-s" name="s" type="text" value="<?php echo wp_specialchars(stripslashes($_GET['s']), true) ?>" size="40" />
						<input id="error404-searchsubmit" name="searchsubmit" type="submit" value="<?php _e('Find', 'garageband') ?>" />
					</div>
				</form>
	<?php } // end gar_404_content
	
	add_action('gar_404','gar_404_content');


// creates the $more_link_text for the_content
function more_text() {
	$content = ''.__('Read More <span class="meta-nav">&raquo;</span>', 'garageband').'';
	return apply_filters('more_text', $content);
} // end more_text


// creates the $more_link_text for the_content
function list_bookmarks_args() {
	$content = 'title_before=<h2>&title_after=</h2>';
	return apply_filters('list_bookmarks_args', $content);
} // end more_text


// Information in Post Footer
function gar_postfooter() {
    global $id, $post;

	the_tags('<p class="tags"> #'," #","</p>"); ?>
	
	<div class="meta">
		<div class="date"><?php the_time('n.j.Y'); ?></div>
		<ul>
			<li><?php comments_popup_link('0', '1', '%', __('comments',"garageband"), __('Off',"garageband")); ?></li>
		</ul>
	</div>
<?php
} // end gar_postfooter


// Action to create the below navigation
function gar_nav_below() {
		if (is_single()) { ?>

			<div id="nav-below" class="navigation">
				<div class="nav-previous"><?php gar_previous_post_link() ?></div>
				<div class="nav-next"><?php gar_next_post_link() ?></div>
			</div>

<?php
		} else { ?>

			<div id="nav-below" class="navigation<?php if(function_exists('wp_pagenavi')) echo " pagenavi"; ?>">
                <?php if(function_exists('wp_pagenavi')) { ?>
                <?php wp_pagenavi(); ?>
                <?php } else { ?>  
				<div class="nav-previous"><?php next_posts_link(__('<span class="meta-nav">&laquo;</span> Older posts', 'garageband')) ?></div>
				<div class="nav-next"><?php previous_posts_link(__('Newer posts <span class="meta-nav">&raquo;</span>', 'garageband')) ?></div>
				<?php } ?>
			</div>	
	
<?php
		}
}
add_action('gar_navigation_below', 'gar_nav_below', 2);


// creates the previous_post_link
function gar_previous_post_link() {
	$args = array ('format'              => '%link',
								 'link'                => '<span class="meta-nav">&laquo;</span> %title',
								 'in_same_cat'         => FALSE,
								 'excluded_categories' => '');
	$args = apply_filters('gar_previous_post_link_args', $args );
	previous_post_link($args['format'], $args['link'], $args['in_same_cat'], $args['excluded_categories']);
} // end gar_previous_post_link


// creates the next_post_link
function gar_next_post_link() {
	$args = array ('format'              => '%link',
								 'link'                => '%title <span class="meta-nav">&raquo;</span>',
								 'in_same_cat'         => FALSE,
								 'excluded_categories' => '');
	$args = apply_filters('gar_next_post_link_args', $args );
	next_post_link($args['format'], $args['link'], $args['in_same_cat'], $args['excluded_categories']);
} // end gar_next_post_link


// Produces an avatar image with the hCard-compliant photo class for author info
function gar_author_info_avatar() {
    global $wp_query; $curauth = $wp_query->get_queried_object();
	$email = $curauth->user_email;
	$avatar = str_replace( "class='avatar", "class='photo avatar", get_avatar("$email") );
	echo $avatar;
} // end gar_author_info_avatar


function band_members() {
	global $wpdb;
	$authors = $wpdb->get_results("SELECT ID, user_nicename from $wpdb->users ORDER BY display_name");
	echo '<ul class="band_members">';
	$counter = 0;
	foreach($authors as $author) {
		if(get_the_author_meta('user_level',$author->ID) > 1 && get_the_author_meta( 'is_band_member', $author->ID ) ):
			$counter++;
			echo '<li class="band_member">';
			echo "<div class='profile_image'>" . get_avatar( $author->ID ) . "</div>";
			echo "<h3>";
			the_author_meta( 'display_name', $author->ID );
			echo "<span class='role'>";
			the_author_meta( 'band_role', $author->ID );
			echo "</span>";
			echo "</h3>";
			echo "<p>";
			the_author_meta( 'user_description', $author->ID );
			echo "</p>";
			echo '<div class="clear"></div>';
			echo '</li>';
		endif;
	}
	if( $counter == 0 ) echo "<p>" . __('No band members found.',"garageband") . "</p>";
	echo '</ul>';
}

function grgbnd_show_tracks(){ 

	global $post;
	
?>

        <?php $album = get_post_meta($post->ID,'album',true); ?>
        
        <table>
        <?php
        if(is_array($album)):
            $count = 0;
            foreach($album as $track):
                $count++;?>
                <tr id="<?php echo $count; ?>">
                    <th><span class="number"><?php echo $count; ?></span></th>
                    <td class="player">
                    <?php if($track['audioclip']):?>
                    	<div id="player-<?php echo $count; ?>"></div>
						<script type="text/javascript">
                        swfobject.embedSWF("<?php bloginfo('template_url') ?>/library/flash/audioplay.swf?auto=no&bgcolor=0x404040&repeat=0&file=<?php echo wp_get_attachment_url($track['audioclip']); ?>&buttondir=<?php bloginfo('template_url'); ?>/library/flash/buttons/&mode=playpause&listenstop=no&sendstop=yes&mastervol=80","player-<?php echo $count; ?>"	,"30","30","9.0.0",false, false, {wmode:"transparent"});
                        </script>                        
                    <?php endif; ?>
					</td>
                    <td>
						<?php echo $track['name']; ?>
                    </td>
                    <td>
						<?php if($track['itunes'] != '' ): ?>
                        <a class="itunes" href="<?php echo $track['itunes']; ?>"><img src="<?php bloginfo('template_url') ?>/images/ico_standard_itunes.png" alt="<?php _e('Buy from iTunes',"garageband") ?>"></a> 
                        <?php endif; ?>
                        <?php if($track['amazon'] != '' ): ?>
                        <a href="<?php echo $track['amazon']; ?>" class="amazon"><img src="<?php bloginfo('template_url') ?>/images/ico_standard_amazon.png" alt="<?php _e('Buy from Amazon',"garageband") ?>"></a> 
                        <?php endif; ?>
                        <?php if($track['custom'] != '' ): ?>
                        <a href="<?php echo $track['custom']; ?>" class="custom"><?php _e('Buy Track',"garageband"); ?></a> 
                        <?php endif; ?>
                    </td>
                </tr>
            <?php
            endforeach;
        endif;
        ?>
        </table>
<?php

}

function grgbnd_show_album(){

	global $post;
	
?>
                    <div id="post-<?php the_ID() ?>" <?php post_class(); ?>>
						
                        <?php if(is_single()): ?>
                        <h1><?php the_title(); ?></h1>
						<?php else: ?>
                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <?php endif;
						
						the_post_thumbnail('album_thumb'); 

						$itunes_link = get_post_meta(get_the_ID(), "itunes_link", true);
						$amazon_link = get_post_meta(get_the_ID(), "amazon_link", true);
						$custom_link = get_post_meta(get_the_ID(), "custom_link", true);
						$album_price = get_post_meta(get_the_ID(), "album_price", true);
	            			
						if( $itunes_link || $amazon_link || $custom_link || $album_price ): ?>

						<div class="album_purchase tracklist">
	            			
	            			<ul>
	            				<?php if($album_price): ?>
                                	<li class="price"><strong><?php _e('Price:','garageband'); ?></strong> <?php echo $album_price; ?></li>
								<?php else: ?>
                                	<li class="heading"><strong><?php _e('Buy This Album','garageband'); ?></strong></li>                                
								<?php endif; ?>
	            				<?php if($itunes_link != ''): ?><li class="itunes"><a href="<?php echo $itunes_link; ?>"><?php _e('Buy Album from iTunes','garageband'); ?></a></li><?php endif; ?>
	            				<?php if($amazon_link != ''): ?><li class="amazon"><a href="<?php echo $amazon_link; ?>"><?php _e('Buy Album from Amazon','garageband'); ?></a></li><?php endif; ?>
	            				<?php if($custom_link != ''): ?><li class="custom"><a href="<?php echo $custom_link; ?>"><?php _e('Buy Album','garageband'); ?></a></li><?php endif; ?>
	            			</ul>
            			
            			</div>
                        
                        <?php endif; ?>
                        
                        <?php if(is_single()): ?>
                        <?php the_content(); ?>
						<?php else: ?>
                        <?php the_excerpt(); ?>
                        <?php endif; ?>
                        						                        
                        <div class="clear"></div>
                        
                        <div class="tracklist">
                        	<h3><?php _e('Album Tracks',"garageband"); ?></h3>
                            <?php grgbnd_show_tracks(); ?>
                        </div>
                        	                                                
	                    <?php the_tags('<p class="tags"> #'," #","</p>"); ?>
                        
                    </div><!-- .post.hentry -->
<?php
}
?>