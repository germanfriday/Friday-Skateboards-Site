<?php gar_abovesubasides() ?>

    <?php if ( is_active_sidebar('1st-subsidiary-aside') || is_active_sidebar('2nd-subsidiary-aside') || is_active_sidebar('3rd-subsidiary-aside') ) { // one of the subsidiary asides has a widget ?>
    <div id="subsidiary">
    
    		<?php gar_before_first_sub() ?>
    
        <?php if ( is_active_sidebar('1st-subsidiary-aside') ) { // there are active widgets for this aside
            echo '<div id="first" class="aside sub-aside">'. "\n" . '<ul class="xoxo">' . "\n";
            dynamic_sidebar('1st-subsidiary-aside');
            echo '</ul>' . "\n" . '</div><!-- #first .aside -->'. "\n";
        } ?>         
        
        <?php gar_between_firstsecond_sub() ?>       
    
        <?php if ( is_active_sidebar('2nd-subsidiary-aside') ) { // there are active widgets for this aside
            echo '<div id="second" class="aside sub-aside">'. "\n" . '<ul class="xoxo">' . "\n";
            dynamic_sidebar('2nd-subsidiary-aside');
            echo '</ul>' . "\n" . '</div><!-- #second .aside -->'. "\n";
        } ?>       
        
        <?php gar_between_secondthird_sub() ?>
   
        <?php if ( is_active_sidebar('3rd-subsidiary-aside') ) { // there are active widgets for this aside
            echo '<div id="third" class="aside sub-aside">'. "\n" . '<ul class="xoxo">' . "\n";
            dynamic_sidebar('3rd-subsidiary-aside');
            echo '</ul>' . "\n" . '</div><!-- #third .aside -->'. "\n";
        } ?>       
        
        <?php gar_after_third_sub() ?> 
        
    </div><!-- #subsidiary -->
    <?php } ?>


<?php gar_belowsubasides() ?>
