<?php

/*
 * Custom Content Type for Fan Gallery
 ***********************************************/

add_action('init', 'fan_gallery');

function fan_gallery() {
	
	$show_labels = array(
		'name' => __( 'Fan Galleries' ),
		'singular_name' => __( 'Fan Gallery' ),
		'add_new' => __( 'Add New' ),
		'add_new_item' => __( 'Add New Fan Gallery' ),
		'edit' => __( 'Edit' ),
		'edit_item' => __( 'Edit Fan Gallery' ),
		'new_item' => __( 'New Fan Gallery' ),
		'view' => __( 'View Fan Gallery' ),
		'view_item' => __( 'View Fan Gallery' ),
		'search_items' => __( 'Search Fan Galleries' ),
		'not_found' => __( 'No fan galleries found' ),
		'not_found_in_trash' => __( 'No fan galleries found in Trash' ),
		'parent' => __( 'Parent Fan Gallery' ),
	);
	
	$args = array(
    	'labels' => $show_labels,
		'public' => true,
		'show_ui' => true,
		'menu_icon' => get_bloginfo('template_url') . '/images/ico_galleries.png',
		'menu_position' => 5,
		'capability_type' => 'page',
		'hierarchical' => true,
		'supports' => array('title', 'editor', 'thumbnail')
	);

	register_post_type( 'fan_gallery' , $args );

	$labels = array(
		'name' => _x( 'Collections', 'taxonomy general name' ),
		'singular_name' => _x( 'Collection', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search Collections' ),
		'all_items' => __( 'All Collections' ),
		'parent_item' => __( 'Parent Collection' ),
		'parent_item_colon' => __( 'Parent Collection:' ),
		'edit_item' => __( 'Edit Collection' ), 
		'update_item' => __( 'Update Collection' ),
		'add_new_item' => __( 'Add New Collection' ),
		'new_item_name' => __( 'New Collection Name' ),
	);

	register_taxonomy('collection',array('fan_gallery'), array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'collection' ),
	));
	
}

if( $_REQUEST['action'] == 'fan_gallery_submit' )
	define('CFCT_BUILD_DISABLE',true);

function submission_form(){
	
	global $up_options, $post;
	
	if( !empty($up_options->include_collections) && is_array($up_options->include_collections) ):
	
		$dropdown = '<select id="collections" name="collections">';
		$dropdown .= '<option>None</option>';
	
		foreach($up_options->include_collections as $collection):
		
			$term = get_term_by('slug',$collection,'collection');
						
			$dropdown .= '<option value="' . $term->slug . '">' . $term->name . '</option>';
			
		endforeach;
		
		$dropdown .= '</select>';
	
	endif;

	
?>
	
	<h1 class="page-title"><?php the_title(); ?></h1>
        
        <?php if( isset($errormsg) ) echo '<div class="messages">' . $errormsg . '</div>'; ?>
                                    
        <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" enctype="multipart/form-data" id="submission_form" name="submission_form">
            
            <input type="hidden" value="fan_gallery_submit" name="action" />
            <?php wp_nonce_field('gallery_submit'); ?>
            
            <fieldset>
                                
                <label for="title"><?php _e('Title','garageband'); ?></label>
                <input type="text" name="title" id="title" class="required" value="<?php if($_REQUEST['title']): echo $_REQUEST['title']; endif; ?>" />
                
                <?php if( $up_options->allow_descriptions == 1 ): ?>
                <label for="body"><?php _e('Description','garageband'); ?></label>
                <textarea name="body" id="body" class="required"><?php if($_REQUEST['body']): echo $_REQUEST['body']; endif; ?></textarea>
                <?php endif; ?>
                
                <?php if( !empty($up_options->include_collections) && is_array($up_options->include_collections) && $up_options->allow_collections == 1 ): ?>
                <label for="collections"><?php _e('Collection:','garageband'); ?></label>
                <?php echo $dropdown; ?>
                <?php endif; ?>
                
                <?php if( $up_options->allow_tags == 1 ): ?>
                <label for="tags"><?php _e('Tags (optional):','garageband'); ?></label>
                <input type="text" name="tags" id="tags" value="" class="haskbd" />
                <kbd><?php _e('Please separate tags with commas (ex: "web design,websites,red,blue,green").','garageband'); ?></kbd>
                <?php endif; ?>
                
                <?php if( $up_options->allow_image_submissions == 1 ): ?>
                <label for="image-attachment"><?php _e('Attach an Image (JPG, GIF, or PNG accepted)','garageband'); ?></label>
                <input type="file" name="image-attachment" id="image-attachment" />
                <?php endif; ?>
                
            </fieldset>
            
            <fieldset class="buttons">
            
            	<input type="submit" value="Submit" name="submit" />
            
            </fieldset>
        
        </form>

		<script type="text/javascript">
        jQuery('#submission_form').validate();
        </script>

<?php
}

function fan_gallery_submission_form(){

	global $up_options, $user_ID, $current_user;
			
	if ( $current_user->user_level >= $up_options->submission_permissions ):
		
		if( $_REQUEST['action'] == 'fan_gallery_submit' ):
	
			$new_post = array();
	
			$wp_nonce = $_REQUEST['_wpnonce'];
	
			if( !wp_verify_nonce($wp_nonce, 'gallery_submit') ):
				wp_die( __($_REQUEST['_wpnonce'] . ' Security error, please try your submission again.','garageband') );
			endif;
		
			if( !$_REQUEST['title'] ):
				wp_die( __('Please enter a title.','garageband') );
			else:
				$new_post['post_title'] = $_REQUEST['title'];
			endif;
	
			if( $up_options->allow_descriptions == 1 ):
				
				if( empty($_REQUEST['body']) ):
					wp_die( __('Please enter a description.','garageband') );
				else:
					$new_post['post_content'] = $_REQUEST['body'];
				endif;
			
			endif;
			
			if( $up_options->allow_image_submissions == 1 ):
			
				if( $_FILES['image-attachment']['error'] ):
					wp_die( __('Please attach a valid image (PNG, GIF, or JPG).','garageband') );
				else:
		
				endif;
			
			endif;
			
			if( $error != 1 ):
			
				if( isset( $up_options->post_status ) )
					$new_post['post_status'] = $up_options->post_status;
				else
					$new_post['post_status'] = 'draft';
				
				if( $user_ID )
					$new_post['post_author'] = $user_ID;

				if( !empty($_REQUEST['tags']) )
					$new_post['tags_input'] = explode(',',$_REQUEST['tags']);

				$result = wp_insert_post( $new_post, true );
								
				set_post_type($result,'fan_gallery');
			
				if(is_wp_error($result))
					wp_die( $result->get_error_message() );
				
				$post_ID = $result;
				
				if( isset($_REQUEST['collections']) ):
					$collections = $_REQUEST['collections'];
					wp_set_object_terms($post_ID, $collections, 'collection');
				endif;
				
				$image_attachment = $_FILES['image-attachment'];
			
				$counter=0;
				foreach ($_FILES as $file): 
					$counter++;
					if ($file['tmp_name'] > ''): 
						
						$uploaded_file[$counter] = wp_upload_bits($file["name"], null, file_get_contents($file["tmp_name"]));
						
						if( !empty($uploaded_file[$counter]['error']) ):
							die($uploaded_file[$counter]['error']);
						else:
							
							$filename = $uploaded_file[$counter]['file'];
							
							$wp_filetype = wp_check_filetype(basename($filename), null );
							$attachment = array(
								 'post_mime_type' => $wp_filetype['type'],
								 'post_title' => preg_replace('/\.[^.]+$/', '', basename($filename)),
								 'post_content' => '',
								 'post_status' => 'inherit'
							);
							$attach_id = wp_insert_attachment( $attachment, $filename, $post_ID);
							
							// you must first include the image.php file
							// for the function wp_generate_attachment_metadata() to work
							require_once(ABSPATH . "wp-admin" . '/includes/image.php');
							$attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
							wp_update_attachment_metadata( $attach_id,  $attach_data );
	
							if( preg_match("/image/",$wp_filetype['type']) && !get_post_meta($post_ID,'_thumbnail_id',true) ):
	
								$thumbnail_html = wp_get_attachment_image( $attach_id, 'thumbnail' );
								if ( !empty($thumbnail_html) ) {
									update_post_meta( $post_ID, '_thumbnail_id', $attach_id );
								}
				
							endif;

						endif;
						
					endif;
	
				endforeach;
				
				if( $up_options->send_email == '1' ):
				
					$admin_email = get_option('admin_email');
					
					$title = __('New Submission from ','garageband') . get_bloginfo('name');
					$body = __('A new submission has been created on ','garageband') . get_bloginfo('name') . __('. Please visit ','garageband') . get_bloginfo('url') . '/wp-admin/post.php?post=' . $post_ID . '&action=edit ' . __('to edit (or publish) this submission.','garageband');
					
					wp_mail( $admin_email, $title, $body );
					
				endif;
	
				echo "<h1>" . $up_options->submission_accepted_title . "</h1>";
				echo "<p>" . $up_options->submission_accepted_message . "</p>";
			
			endif;
	
		else:
			
			submission_form();
	
		endif;
	
	else:
	
	?>
                
        <h1><?php echo $up_options->user_level_denied_title; ?></h1>
        <p><?php echo $up_options->user_level_denied_message; ?></p>
        
        <?php if( !is_user_logged_in() ): ?>

        <p><a class="button" href="<?php echo wp_login_url( get_permalink() ); ?>" title="Sign In"><?php _e('Sign In','garageband'); ?></a></p>
        
        <?php endif; ?>
	
	<?php
	
	endif;

}