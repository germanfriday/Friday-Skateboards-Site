<?php

/*
Template Name: Fan Gallery Submission Page
*/

get_header();

?>

	<div id="content">
	
        <div class="primary">
        
		<?php fan_gallery_submission_form(); ?>

	    </div><!-- /.primary -->

		<?php gar_sidebar() ?>
        
        <div class="clear"></div>

	</div><!-- /#content -->

<?php get_footer() ?>