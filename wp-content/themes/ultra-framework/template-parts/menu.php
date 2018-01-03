<?php
/*
 * Template part for displaying primary menu. 
 */
?>

<nav class="main-navbar uk-navbar uk-navbar-attached">
	<div class="uk-container uk-container-center">
		
        <?php
			wp_nav_menu( array(
				'menu'              => 'primary',
				'theme_location'    => 'primary',
				'depth'             => 2,
				'container'         => '',
				'menu_class'        => 'uk-navbar-nav uk-hidden-small',
				'fallback_cb'       => 'ultra_framework_primary_menu::fallback',
				'walker'            => new ultra_framework_primary_menu())
			);
		?>
		
		<div class="uk-navbar-flip uk-visible-small">
			<a href="#offcanvas-menu" class="uk-navbar-toggle" data-uk-offcanvas></a>
		</div>
	</div>
		
		
	<div id="offcanvas-menu" class="uk-offcanvas">
		<div class="uk-offcanvas-bar uk-offcanvas-bar-flip">
			<?php
                wp_nav_menu( array(
                    'menu'           => 'primary',
                    'theme_location' => 'primary',
                    'depth'          => 2,
                    'container'      => '',
                    'menu_class'     => 'uk-nav uk-nav-offcanvas uk-nav-parent-icon',
                    'items_wrap'     => '<ul id="%1$s" class="%2$s" data-uk-nav>%3$s</ul>',
                    'fallback_cb'    => 'ultra_framework_offcanvas_menu::fallback',
                    'walker'         => new ultra_framework_offcanvas_menu())
                );
			?>
		</div>
    </div>
</nav>