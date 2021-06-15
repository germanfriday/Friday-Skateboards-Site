<?php


// Filter to create the sidebar
function gar_sidebar() {

  $show = TRUE;

	// Filters should return Boolean 
	$show = apply_filters('gar_sidebar', $show);
	
	if ($show) {
    	get_sidebar();
	}
	
	return;
} // end gar_sidebar


// Main Aside Hooks


	// Located in sidebar.php 
	// Just before the main asides (commonly used as sidebars)
	function gar_abovemainasides() {
	    do_action('gar_abovemainasides');
	} // end gar_abovemainasides
	
	
	// Located in sidebar.php 
	// Between the main asides (commonly used as sidebars)
	function gar_betweenmainasides() {
	    do_action('gar_betweenmainasides');
	} // end gar_betweenmainasides
	
	
	// Located in sidebar.php 
	// after the main asides (commonly used as sidebars)
	function gar_belowmainasides() {
	    do_action('gar_belowmainasides');
	} // end gar_belowmainasides
	

// Index Aside Hooks

	
	// Located in sidebar-index-top.php
	function gar_aboveindextop() {
		do_action('gar_aboveindextop');
	} // end gar_aboveindextop
	
	
	// Located in sidebar-index-top.php
	function gar_belowindextop() {
		do_action('gar_belowindextop');
	} // end gar_belowindextop
	
	
	// Located in sidebar-index-insert.php
	function gar_aboveindexinsert() {
		do_action('gar_aboveindexinsert');
	} // end gar_aboveindexinsert
	
	
	// Located in sidebar-index-insert.php
	function gar_belowindexinsert() {
		do_action('gar_belowindexinsert');
	} // end gar_belowindexinsert	
	

	// Located in sidebar-index-bottom.php
	function gar_aboveindexbottom() {
		do_action('gar_aboveindexbottom');
	} // end gar_aboveindexbottom
	
	
	// Located in sidebar-index-bottom.php
	function gar_belowindexbottom() {
		do_action('gar_belowindexbottom');
	} // end gar_belowindexbottom	
	
	
// Single Post Asides


	// Located in sidebar-single-top.php
	function gar_abovesingletop() {
		do_action('gar_abovesingletop');
	} // end gar_abovesingletop
	
	
	// Located in sidebar-single-top.php
	function gar_belowsingletop() {
		do_action('gar_belowsingletop');
	} // end gar_belowsingletop
	
	
	// Located in sidebar-single-insert.php
	function gar_abovesingleinsert() {
		do_action('gar_abovesingleinsert');
	} // end gar_abovesingleinsert
	
	
	// Located in sidebar-single-insert.php
	function gar_belowsingleinsert() {
		do_action('gar_belowsingleinsert');
	} // end gar_belowsingleinsert	
	

	// Located in sidebar-single-bottom.php
	function gar_abovesinglebottom() {
		do_action('gar_abovesinglebottom');
	} // end gar_abovesinglebottom
	
	
	// Located in sidebar-single-bottom.php
	function gar_belowsinglebottom() {
		do_action('gar_belowsinglebottom');
	} // end gar_belowsinglebottom	
	


// Page Aside Hooks


	// Located in sidebar-page-top.php
	function gar_abovepagetop() {
		do_action('gar_abovepagetop');
	} // end gar_abovepagetop
	
	
	// Located in sidebar-page-top.php
	function gar_belowpagetop() {
		do_action('gar_belowpagetop');
	} // end gar_belowpagetop

	// Located in sidebar-page-bottom.php
	function gar_abovepagebottom() {
		do_action('gar_abovepagebottom');
	} // end gar_abovepagebottom
	
	
	// Located in sidebar-page-bottom.php
	function gar_belowpagebottom() {
		do_action('gar_belowpagebottom');
	} // end gar_belowpagebottom	



// Subsidiary Aside Hooks


	// Located in sidebar-subsidiary.php
	function gar_abovesubasides() {
		do_action('gar_abovesubasides');
	} // end gar_abovesubasides
	

	// Located in sidebar-subsidiary.php
	function gar_belowsubasides() {
		do_action('gar_belowsubasides');
	} // end gar_belowsubasides
	

	// Located in sidebar-subsidiary.php
	function gar_before_first_sub() {
		do_action('gar_before_first_sub');
	} // end gar_before_first_sub


	// Located in sidebar-subsidiary.php
	function gar_between_firstsecond_sub() {
		do_action('gar_between_firstsecond_sub');
	} // end gar_between_firstsecond_sub


	// Located in sidebar-subsidiary.php
	function gar_between_secondthird_sub() {
		do_action('gar_between_secondthird_sub');
	} // end gar_between_secondthird_sub
	
	
	// Located in sidebar-subsidiary.php
	function gar_after_third_sub() {
		do_action('gar_after_third_sub');
	} // end gar_after_third_sub	

