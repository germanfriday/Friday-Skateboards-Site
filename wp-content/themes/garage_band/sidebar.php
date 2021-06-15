<?php 

global $up_options;

?>

<?php if (is_active_sidebar('primary-aside')) { ?>
        
	<ul class="aside">
    
        <?php dynamic_sidebar('primary-aside'); ?>

    </ul><!-- /.aside -->

<?php } ?>