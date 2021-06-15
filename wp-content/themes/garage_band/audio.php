
<ipod>

<title><?php wp_title(); ?></title>

<?php 
query_posts('post_type=album');
?>

<?php if( have_posts() ): while ( have_posts() ): the_post();
		
		$album = get_post_meta(get_the_ID(),'album',true);
		
		if($album):		
		
			$counter = 0;
			foreach ($album as $track):
				
				$counter++; ?>
					<song>
						<title><?php echo $counter; ?>. <?php echo $track['name']; ?></title>
						<url><?php echo wp_get_attachment_url($track['audioclip']); ?></url>
					</song>
				
				<?php
	
			endforeach;
			
			if( $counter == 1 )
				echo "<song><title></title><url></url></song>";
			
			if( $counter == 2 )
				echo "<song><title></title><url></url></song>";

		endif;

	endwhile;
	
endif;
?>
</ipod>