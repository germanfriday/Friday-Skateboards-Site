<?php gar_abovepagetop() ?>

<?php if ( is_active_sidebar('page-top') ) { // there is active widgets for this sidebar
    echo '<div id="page-top" class="aside">'. "\n" . '<ul class="xoxo">' . "\n";
    dynamic_sidebar('page-top');
    echo '</ul>' . "\n" . '</div><!-- #page-top .aside -->'. "\n";
} ?>

<?php gar_belowpagetop() ?>