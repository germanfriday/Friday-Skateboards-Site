<?php gar_abovesingleinsert() ?>

<?php if ( is_active_sidebar('single-insert') ) { // there is active widgets for this sidebar
    echo '<div id="single-insert" class="aside">'. "\n" . '<ul class="xoxo">' . "\n";
    dynamic_sidebar('single-insert');
    echo '</ul>' . "\n" . '</div><!-- #single-insert .aside -->' . "\n";
} ?>

<?php gar_belowsingleinsert() ?>