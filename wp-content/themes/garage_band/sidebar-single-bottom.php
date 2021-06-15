<?php gar_abovesinglebottom() ?>

<?php if ( is_active_sidebar('single-bottom') ) { // there is active widgets for this sidebar
    echo '<div id="single-bottom" class="aside">'. "\n" . '<ul class="xoxo">' . "\n";
    dynamic_sidebar('single-bottom');
    echo '</ul>' . "\n" . '</div><!-- #single-bottom .aside -->'. "\n";
} ?>

<?php gar_belowsinglebottom() ?>