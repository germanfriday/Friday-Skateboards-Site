<?php 

gar_abovefooter(); 

global $up_options;

?>

        <div id="footer">
        
        	<div class="inner">

		        <?php get_sidebar('subsidiary'); ?>
    
                <?php if($up_options->footer_logo): ?>
            
                    <?php if(is_front_page()): ?>
                        <h6 class="logo"><a href="<?php bloginfo('url') ?>" title="<?php bloginfo('name') ?>" rel="home"><img src="<?php echo $up_options->footer_logo; ?>" alt="<?php bloginfo('name') ?>" /></a></h6>            
                    <?php endif; ?>
                        
                <?php else: ?>
    
                    <h6 class="logo"><a href="<?php bloginfo('url') ?>" title="<?php bloginfo('name') ?>" rel="home"><img src="<?php echo $up_options->footer_logo; ?>" alt="<?php bloginfo('name') ?>" /></a></h6>
                                        
                <?php endif; ?>
                
		        <?php
				wp_nav_menu(array(
					'theme_location' => 'footer_nav',
					'menu_id' => 'footer_nav',
					'container' => 'div',
					'container_class' => 'menu'
				));
				?>
                
				<?php if( $up_options->footertext ): ?>
                    <?php echo '<p class="footertext">' . $up_options->footertext . '</p>'; ?>
                <?php endif; ?>
                
            	<div class="clear"></div>
            
            </div>
        
        </div><!-- /#footer -->

		<?php gar_belowfooter(); ?>  
        
    </div><!-- /#container -->

<?php wp_footer(); ?>

<?php gar_after(); ?>

</body>
</html>