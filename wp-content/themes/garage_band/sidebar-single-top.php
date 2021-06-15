<?php gar_abovesingletop() ?>

<?php if ( is_active_sidebar('single-top') ) { // there is active widgets for this sidebar
    echo '<div id="single-top" class="aside">'. "\n" . '<ul class="xoxo">' . "\n";
    dynamic_sidebar('single-top');
    echo '</ul>' . "\n" . '</div><!-- #single-top .aside -->' . "\n";
} ?>

<?php gar_belowsingletop() ?>
