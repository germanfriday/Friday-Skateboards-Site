<?php gar_abovepagebottom() ?>

<?php if ( is_active_sidebar('page-bottom') ) { // there is active widgets for this sidebar
    echo '<div id="page-bottom" class="aside">'. "\n" . '<ul class="xoxo">' . "\n";
    dynamic_sidebar('page-bottom');
    echo '</ul>' . "\n" . '</div><!-- #page-bottom .aside -->'. "\n";
} ?>

<?php gar_belowpagebottom() ?>