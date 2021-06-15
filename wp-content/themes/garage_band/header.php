<?php global $up_options; gar_create_doctype(); echo " "; language_attributes(); echo ">\n";?>
<head profile="http://gmpg.org/xfn/11">

<?php 

gar_doctitle();
gar_create_contenttype();
gar_show_description();
gar_show_robots();
gar_canonical_url();
gar_create_stylesheet();
gar_show_pingback();
gar_show_commentreply();

wp_head(); ?>

</head>

<body <?php body_class() ?>>

<?php gar_before(); ?>

	<div id="above_header" class="container">

		<?php gar_aboveheader(); ?>   
    	        
        <?php if($up_options->search_enabled) echo get_search_form(); ?>
        
        <div class="clear"></div>
        
    </div>

    <div id="main" class="container">
    	
        <div id="header">

			<?php if($up_options->logo): ?>
        
        		<?php if(is_front_page()): ?>
		    		<h1 id="logo"><a href="<?php bloginfo('wpurl') ?>" title="<?php bloginfo('name') ?>" rel="home"><img src="<?php echo $up_options->logo; ?>" alt="<?php bloginfo('name') ?>" /></a></h1>
                <?php else: ?>
		    		<div id="logo"><a href="<?php bloginfo('wpurl') ?>" title="<?php bloginfo('name') ?>" rel="home"><img src="<?php echo $up_options->logo; ?>" alt="<?php bloginfo('name') ?>" /></a></div>            
                <?php endif; ?>
                    
			<?php else: ?>

		    	<h1 id="title"><a href="<?php bloginfo('wpurl') ?>" title="<?php bloginfo('name') ?>" rel="home"><img src="<?php echo $up_options->logo; ?>" alt="<?php bloginfo('name') ?>" /></a></h1>
		    	                    
			<?php endif; ?>
			
	        <?php
			wp_nav_menu(array(
				'theme_location' => 'primary_nav',
				'menu_id' => 'primary_nav',
				'menu_class' => 'sf-menu',
				'container' => false,
				'fallback_cb' => 'wp_page_menu_mod'
			));
			?>
            
            <div class="clear"></div>
        
        </div><!-- /#header -->

<?php gar_belowheader(); ?>   
