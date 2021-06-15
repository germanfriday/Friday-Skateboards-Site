<?php gar_aboveindexbottom() ?>

<?php if ( is_active_sidebar('index-bottom') ) { // there is active widgets for this sidebar
    echo '<div id="index-bottom" class="aside">'. "\n" . '<ul class="xoxo">' . "\n";
    dynamic_sidebar('index-bottom');
    echo '</ul>' . "\n" . '</div><!-- #index-bottom .aside -->'. "\n";
} ?>

<?php gar_belowindexbottom() ?>