<?php gar_aboveindextop() ?>

<?php if ( is_active_sidebar('index-top') ) { // there is active widgets for this sidebar
    echo '<div id="index-top" class="aside">'. "\n" . '<ul class="xoxo">' . "\n";
    dynamic_sidebar('index-top');
    echo '</ul>' . "\n" . '</div><!-- #index-top .aside -->'. "\n";
} ?>

<?php gar_belowindextop() ?>
