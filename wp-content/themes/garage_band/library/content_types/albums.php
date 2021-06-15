<?php

/*
 * Custom Content Type for Albums
 ***********************************************/
 
add_action( 'init', 'albums' );

function albums() {
	
	$show_labels = array(
		'name' => __( 'Albums' ),
		'singular_name' => __( 'Album' ),
		'add_new' => __( 'Add New' ),
		'add_new_item' => __( 'Add New Album' ),
		'edit' => __( 'Edit' ),
		'edit_item' => __( 'Edit Album' ),
		'new_item' => __( 'New Album' ),
		'view' => __( 'View Album' ),
		'view_item' => __( 'View Album' ),
		'search_items' => __( 'Search Albums' ),
		'not_found' => __( 'No albums found' ),
		'not_found_in_trash' => __( 'No albums found in Trash' ),
		'parent' => __( 'Parent Album' ),
	);
	
	$args = array(
    	'labels' => $show_labels,
		'public' => true,
		'show_ui' => true,
		'capability_type' => 'page',
		'hierarchical' => true,
		'menu_position' => 5,
		'menu_icon' => get_bloginfo('template_url') . '/images/ico_albums.png',
		'register_meta_box_cb' => 'album_custom_meta',
		'taxonomies' => array('post_tags'),
		'rewrite' => 'album',
		'supports' => array('title', 'editor', 'thumbnail')
	);

	register_post_type( 'album' , $args );

}

add_action('admin_init', 'album_custom_init');
add_action('save_post', 'save_album_purchase_links');

function album_custom_init(){
	
        wp_enqueue_script( 'ui.core', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.10/jquery-ui.js', array('jquery') );
	wp_enqueue_style( 'ui.theme', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.10/themes/start/jquery-ui.css' );
	wp_enqueue_style( 'album_admin', get_bloginfo('template_url') . '/library/styles/album_admin.css' );

}

function album_custom_meta(){
	
	add_meta_box("album_custom_tracks", __("Album Track Information",'garageband'), "album_custom_tracks", "album", "normal", "low");
	add_meta_box("album_purchase_links", __("Album Purchasing Info",'garageband'), "album_purchase_links", "album", "side", "high");

}

function album_purchase_links(){
	global $post;
	$itunes_link = get_post_meta($post->ID, "itunes_link", true);
	$amazon_link = get_post_meta($post->ID, "amazon_link", true);
	$custom_link = get_post_meta($post->ID, "custom_link", true);
	$album_price = get_post_meta($post->ID, "album_price", true);
	$release_date= get_post_meta($post->ID, "release_date", true);
	
	echo "<div class='purchase'>";
	echo "<p>" . __('Please enter the price for the full album.','garageband') . "</p>";
	echo '<label>' . __('Album Price') . '</label> <input type="text" name="album_price" value="' . $album_price . '"><br><br>';
	echo "<p>" . __('Please enter the URL(s) where this album can be purchased.','garageband') . "</p>";
	echo '<label>' . __('iTunes Link') . '</label> <input type="text" name="itunes_link" value="' . $itunes_link . '">';
	echo '<label>' . __('Amazon Link') . '</label> <input type="text" name="amazon_link" value="' . $amazon_link . '">';
	echo '<label>' . __('Custom Link') . '</label> <input type="text" name="custom_link" value="' . $custom_link . '">';
	echo "<p>" . __('Please enter the release date for this album.','garageband') . "</p>";
	echo '<label>' . __('Release Date') . '</label> <input type="text" name="release_date" value="' . $release_date . '">';
	echo "</div>";
	
}

function save_album_purchase_links(){

	global $post;
	
	if($_REQUEST['action'] != 'autosave'):
	
		$album_price = $_REQUEST['album_price'];
		$itunes_link = $_REQUEST['itunes_link'];
		$amazon_link = $_REQUEST['amazon_link'];
		$custom_link = $_REQUEST['custom_link'];
		$release_date= $_REQUEST['release_date'];
		
		update_post_meta($post->ID, "album_price", $album_price);
		update_post_meta($post->ID, "itunes_link", $itunes_link);
		update_post_meta($post->ID, "amazon_link", $amazon_link);
		update_post_meta($post->ID, "custom_link", $custom_link);
		update_post_meta($post->ID, "release_date", $release_date);
	
	endif;
	
}

add_action('save_post','save_album_purchase_links');

function album_custom_tracks(){
	global $post;
	$album = get_post_meta($post->ID, "album", true);
	?>
	<div id="album_edit">
        <table id="tracks" width="100%">
        	<thead>
                <tr>
                    <th><?php _e('Track #',"garageband"); ?></th>
                    <th><?php _e('Name',"garageband"); ?></th>
                    <th><?php _e('Listen',"garageband"); ?></th>
                    <th><?php _e('MP3 File',"garageband"); ?></th>
                    <th><?php _e('iTunes Link',"garageband"); ?></th>
                    <th><?php _e('Amazon Link',"garageband"); ?></th>
                    <th><?php _e('Custom Link',"garageband"); ?></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php
            if(is_array($album)):
				$count = 0;
				foreach($album as $track):
					$count++;?>
					<tr id="<?php echo $count; ?>">
						<th><span class="number"><?php echo $count; ?></span></th>
						<td><input type="text" name="name" value="<?php echo $track['name']; ?>" /></td>
						<td class="preview">
	                    <?php if($track['audioclip']):?>
                        
                        	<div id="<?php echo $count . "-" . $track['audioclip']; ?>">
                            	<a href="<?php echo $track['audioclip']; ?>"><?php _e('Listen',"garageband"); ?></a>
                            </div>
                            
                            <script type="text/javascript">
							swfobject.embedSWF("<?php bloginfo('template_url') ?>/library/flash/audioplay.swf?auto=no&bgcolor=0x404040&repeat=0&file=<?php echo wp_get_attachment_url($track['audioclip']); ?>&buttondir=<?php echo bloginfo('template_url'); ?>/library/flash/buttons/&mode=playpause&listenstop=no&sendstop=yes&mastervol=80","<?php echo $count . "-" . $track['audioclip']; ?>","30","30","9.0.0",false, false, {wmode:"transparent"}, {id:"<?php echo $track['audioclip']; ?>",name:"<?php echo $track['audioclip']; ?>"});
							</script>

	                    <?php endif; ?>
						</td>
						<td class="audio">
                        	<input type="hidden" name="audioclip" value="<?php echo $track['audioclip']; ?>" />
                        	<span class="audio">
		                    <?php if($track['audioclip']):?>
								<a class="edit" href="<?php echo $track['audioclip']; ?>"><?php _e('Change',"garageband"); ?></a>
                            <?php else: ?>
                            	<a class="add_track" href="#"><?php _e('Add',"garageband"); ?></a>
		                    <?php endif; ?>
                            </span>
						</td>
						<td><input type="text" name="itunes" value="<?php echo $track['itunes']; ?>" /></td>
						<td><input type="text" name="amazon" value="<?php echo $track['amazon']; ?>" /></td>
						<td><input type="text" name="custom" value="<?php echo $track['custom']; ?>" /></td>
						<td class="actions"><a href="#" class="move_up"><?php _e('Move Up',"garageband"); ?></a> <a href="#" class="move_down"><?php _e('Move Down',"garageband"); ?></a> <a class="delete" href="#"><?php _e('Delete',"garageband"); ?></a></a></td>
					</tr>
				<?php
                endforeach;
			endif;
			$count++;; 
			
			if($count==1): ?>
					<tr id="<?php echo $count; ?>">
						<th><span class="number"><?php echo $count; ?></span></th>
						<td><input type="text" name="name" value="" /></td>
						<td class="listen">
                        </td>
						<td class="audio">
							<input type="hidden" name="audioclip" value="" />
                        	<span class="audio">
                            	<a class="add_track" href="#"><?php _e('Add',"garageband"); ?></a>
                            </span>
                        </td>
						<td><input type="text" name="itunes" value="" /></td>
						<td><input type="text" name="amazon" value="" /></td>
						<td><input type="text" name="custom" value="" /></td>
						<td><a href="#" class="move_up"><?php _e('Move Up',"garageband"); ?></a> <a href="#" class="move_down"><?php _e('Move Down',"garageband"); ?></a> <a class="delete" href="#"><?php _e('Delete',"garageband"); ?></a></td>
					</tr>
            <?php endif; ?>
            </tbody>
            <tfoot style="display: none;">
                <tr>
                    <th><span class="number"></span></th>
                    <td><input type="text" name="name" value="" /></td>
					<td class="listen"></td>
					<td class="audio">
						<input type="hidden" name="audioclip" value="" />
                    	<span class="audio">
                        	<a class="add_track" href="#"><?php _e('Add',"garageband"); ?></a>
                        </span>
                    </td>
                    <td><input type="text" name="itunes" value="" /></td>
                    <td><input type="text" name="amazon" value="" /></td>
                    <td><input type="text" name="custom" value="" /></td>
                    <td><a href="#" class="move_up"><?php _e('Move Up',"garageband"); ?></a> <a href="#" class="move_down"><?php _e('Move Down',"garageband"); ?></a> <a class="delete" href="#"><?php _e('Delete',"garageband"); ?></a></td>
                </tr>
            </tfoot>
        </table>
                
        <div id="album_track_submit" class="submitbox">
	        <button class="button-secondary alignleft" id="add_track"><span><?php _e('Add Track'); ?></span></button>
            <input name="save-album" class="button-primary alignright" id="save-album" accesskey="t" value="<?php _e('Save Tracks',"garageband"); ?>" type="submit">
            <img alt="" style="visibility: hidden;" id="loading-ajax" class="alignright" src="<?php bloginfo('url'); ?>/wp-admin/images/wpspin_light.gif">
        </div>

        <div id="dialog-form" title="Select Audio Clip"></div>

        <script type="text/javascript">
		
		$tracktable = jQuery("#tracks");
		$newTR = $tracktable.find("tfoot tr:last").clone();
		
		jQuery("#add_track").live("click",function(e){
			
			e.preventDefault();
			$tracktable.append($newTR);
			$newTR = $tracktable.find("tfoot tr:last").clone();
			
		});
		
		jQuery("#tracks").find(".delete").live("click",function(e){
			
			e.preventDefault();
			jQuery(this).parents('tr').slideUp('fast').remove();
			
		});

		var update_rows = function(e){
			
			e.preventDefault();
			
			count = 0;
			
			jQuery('#tracks tbody tr').each(function(e){
				count++;
				jQuery(this).attr('id',count).find('th:first').find('span').text(count);
				
			});
			
		}

		var move_row_up = function(e){
			
			e.preventDefault();
			
			$thisRow = jQuery(this).parents('tr');
			$previousSibling = $thisRow.prev();
			
			$previousSibling.before($thisRow);
			update_rows(e);

		}

		var move_row_down = function(e){
			
			e.preventDefault();

			$thisRow = jQuery(this).parents('tr');
			$nextSibling = $thisRow.next();
			
			$nextSibling.after($thisRow);
			update_rows(e);
			
		}

		jQuery('#add_track').live('click',update_rows);
		jQuery('#tracks').find('.move_up,.move_down,.delete').live('click',update_rows);
		jQuery('#tracks').find('.move_up').live('click',move_row_up);
		jQuery('#tracks').find('.move_down').live('click',move_row_down);
		
		jQuery("#dialog-form .submitbox .deletion").live('click',function(e){
			jQuery("#dialog-form").dialog('close');
		});
		
		jQuery("#dialog-form").dialog({
			autoOpen: false,
			width: 350,
			modal: true,
			open: function(){
				jQuery.get(ajaxurl, { selectedClip: global.selectedRow, action: "select_clip", post_ID: <?php echo $post->ID; ?> }, function(data){
				
					jQuery("#dialog-form").html(data);
				
				});
			},
			close: function() {

				audioclip = jQuery(this).find('input:checked').val();
				audiolink = jQuery(this).find('input:checked').parents('.track').find('a').attr('href');
				rowID = jQuery('tr.selected').index()+1;
				replaceDiv = rowID+"-"+audioclip;
				
				if(audioclip){
					
					jQuery('tr.selected')
					.find('td.preview')
					.html('<div id="'+replaceDiv+'"></div>')
					.ready(function(){
					    swfobject.embedSWF("<?php bloginfo('template_url') ?>/library/flash/audioplay.swf?auto=no&bgcolor=0x404040&repeat=0&file="+audiolink+"&buttondir=<?php echo bloginfo('template_url'); ?>/library/flash/buttons/&mode=playpause&listenstop=no&sendstop=yes&mastervol=80",replaceDiv,"30","30","9.0.0",false, false, {wmode:"transparent"}, {id:rowID,name:rowID});					
					});
						
					jQuery('tr.selected')
					.find('input[name="audioclip"]')
					.val(audioclip);
					
					jQuery('tr.selected')
					.find('span.audio')
					.html("<a class='edit' href='"+audioclip+"'><?php _e('Edit',"garageband"); ?></a>")
					.parents('.selected')
					.removeClass('selected');
				}else{
					alert("No audio clip found, please try again.");	
				}
			}
		});
		
		var global = [];
		
		jQuery('#tracks')
		.find('.add_track,.edit')
		.live('click',function(e) {
			e.preventDefault();
			jQuery(this).parents('tr').addClass('selected');

			global.selectedRow = jQuery(this).attr('href');
			
			jQuery('#dialog-form').dialog('open');
			
			$link = jQuery(this);
			$radio = jQuery("#dialog-form").find('input[type="radio"]');
			
			$radio.each(function(i){
									 
				if($link.hasClass('edit') && ($link.attr('href') == jQuery(this).val())){
					
					jQuery(this).attr('checked','checked');
					
				} else {
					
					jQuery(this).removeAttr('checked');
	
				}
			
			});
			
		});
		
		jQuery('#assign_track').live('click',function(e){
			
			e.preventDefault();
			jQuery("#dialog-form").dialog('close');
	
		});

		var save_tracks = function(e){
			
			e.preventDefault();
			
			jQuery('#album_track_submit img').css('visibility','visible');
			jQuery('#album_track_submit input').attr('disabled', 'disabled');;
			
			var tracks = [];
			
			var trackcount = 0;
			
			jQuery('#tracks tbody tr').each(function(){
				
				if(jQuery(this).find('input[name="name"]').val()){
					
					tracks[trackcount] = {
						id 			: jQuery(this).attr('id'),
						name 		: jQuery(this).find('input[name="name"]').val(),
						audioclip	: jQuery(this).find('input[name="audioclip"]').val(),
						itunes 		: jQuery(this).find('input[name="itunes"]').val(),
						amazon 		: jQuery(this).find('input[name="amazon"]').val(),
						custom 		: jQuery(this).find('input[name="custom"]').val()
					}
					
				}
				
				trackcount++;
	
			});
			
			jQuery.post(

				ajaxurl,
				{
					postID : '<?php echo $post->ID; ?>',
					action : 'save_album',
					album : tracks
				},
				function( response ) {
					
					jQuery('#album_custom_tracks .inside').find("#message").remove();
					
					if(response.success){

						jQuery('#album_track_submit img').css('visibility','hidden');
						jQuery('#album_track_submit input').removeAttr('disabled');

						jQuery('#album_custom_tracks .inside').prepend("<div id='message' class='updated below-h2'><p><?php _e('Album track information updated.',"garageband"); ?></p></div>").parents('div').find('#message').delay(4000).fadeOut('slow');
						
						
					}
					
				},
				'json'
			);
		
		}
		
		jQuery('#save-album').click(save_tracks);
				
        </script>
	</div>
    <div class="clear"></div>

<?php

}

add_action( 'wp_ajax_select_clip', 'wp_ajax_select_clip' );

function wp_ajax_select_clip(){
	$post_ID = $_REQUEST['post_ID'];
?>
            <form id="select_clip" name="select_clip">
            
                <?php
                
                $args = array(
                    'post_type' => 'attachment',
                    'numberposts' => null,
                    'post_status' => null,
                    'post_parent' => $post_ID,
                    'posts_per_page' => 50
                );
                $attachments = get_posts($args);
                $counter = 0;
				
				function is_selected($attachment_ID){
					if( $attachment_ID == $_REQUEST['selectedClip'] )
						return " checked";
				}
				
                if ($attachments):
                    foreach ($attachments as $attachment):
                        if($attachment->post_mime_type=='audio/mpeg'):
                            $counter++;
                            echo "<fieldset class='track'> \n";
                            echo "<label><input type='radio' name='audio_clip[]' id='audio_clip_" . $counter . "' value='" . $attachment->ID . "' ".is_selected($attachment->ID)."/> " . __('Select Clip',"garageband") . "</label> \n";					
                            echo "<a href='" . $attachment->guid . "' target='_blank'>" . apply_filters('the_title', $attachment->post_title) . "</a> \n";
                            echo "</fieldset>";
                        endif;
                    endforeach;
                    if($counter==0)
                    	echo "<p>No MP3s found. Please upload new MP3 files to this post by clicking the audio icon below the page title field. Then return to this screen by clicking the upload icon in the tracklist edit widget.</p>";
                endif;
                ?>
                <div class="submitbox">
                    <button class="button-secondary alignright" id="assign_track"><?php _e('Assign Audio to Track',"garageband"); ?></button>
                    <a class="alignright deletion"><?php _e('Cancel',"garageband"); ?></a>
                </div>
            </form>
		<?php
		exit;
}

function wp_ajax_album_save(){
	
	global $post;
	$postID = $_POST["postID"];
	$album = $_POST["album"];
	delete_post_meta($postID, "album");
	update_post_meta($postID, "album", $album);
	
	$response = json_encode( array( 'success' => true, 'album' => $album ) );

	header( "Content-Type: application/json" );
	echo $response;

	exit;

}

do_action( 'wp_ajax_' . $_POST['action'] );
add_action( 'wp_ajax_save_album', 'wp_ajax_album_save' );

add_filter("manage_upload_columns", 'upload_columns');
add_action("manage_media_custom_column", 'media_custom_columns', 0, 2);

function upload_columns($columns) {

	unset($columns['parent']);
	$columns['better_parent'] = "Parent";

	return $columns;

}
 function media_custom_columns($column_name, $id) {

	$post = get_post($id);

	if($column_name != 'better_parent')
		return;

		if ( $post->post_parent > 0 ) {
			if ( get_post($post->post_parent) ) {
				$title =_draft_or_post_title($post->post_parent);
			}
			?>
			<strong><a href="<?php echo get_edit_post_link( $post->post_parent ); ?>"><?php echo $title ?></a></strong>, <?php echo get_the_time(__('Y/m/d')); ?>
			<br />
			<a class="hide-if-no-js" onclick="findPosts.open('media[]','<?php echo $post->ID ?>');return false;" href="#the-list"><?php _e('Re-Attach'); ?></a></td>

			<?php
		} else {
			?>
			<?php _e('(Unattached)'); ?><br />
			<a class="hide-if-no-js" onclick="findPosts.open('media[]','<?php echo $post->ID ?>');return false;" href="#the-list"><?php _e('Attach'); ?></a>
			<?php
		}

}