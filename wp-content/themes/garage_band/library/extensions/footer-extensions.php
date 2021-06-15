<?php


// Located in footer.php
// Just before the footer div
function gar_abovefooter() {
    do_action('gar_abovefooter');
} // end gar_abovefooter


// located in footer.php
// the footer text can now be filtered and controlled from your own functions.php
function gar_footertext($thm_footertext) {
    $thm_footertext = apply_filters('gar_footertext', $thm_footertext);
    return $thm_footertext;
} // end gar_footertext


// Located in footer.php
// Just after the footer div
function gar_belowfooter() {
    do_action('gar_belowfooter');
} // end gar_belowfooter


// Located in footer.php 
// Just before the closing body tag, after everything else.
function gar_after() {
    do_action('gar_after');
} // end gar_after