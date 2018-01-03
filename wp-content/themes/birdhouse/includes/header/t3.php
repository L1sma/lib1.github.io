<?php if ( !defined( 'ABSPATH' ) ) exit; ?>

<div id="header-layout">

	<div id="header-holder">

		<div id="header-holder-2">
	
			<?php
	
				// Top Sidebar
				if ( is_active_sidebar( 'offset-sidebar' ) ) {
					echo '<span class="offset-sidebar-holder-button"><!-- Button --></span>'; }
	
				// Icons the Social
				if ( function_exists( 'st_icons_social' ) ) {
					st_icons_social( true, true, '', 'title' ); }
	
				// Menu Secondary
				echo '<div id="menu-2">';
					st_menu_secondary();
				echo '</div>';
	
			?>
	
			<div class="clear"><!-- --></div>
	
		</div><!-- #header-holder-2 -->

		<div id="menu">
			<?php
				// Menu Primary
				st_menu_primary();
			?>
			<div class="clear"><!-- --></div>
		</div><!-- #menu -->

		<div class="clear"><!-- --></div>

	</div><!-- #header-holder -->

</div><!-- #header-layout -->

<div id="logo">
	<?php
		// Logo
		st_logo();
	?>
</div><!-- #logo -->

<?php
	// Sidebar Ad A
	if ( is_active_sidebar( 'ad-sidebar-1' ) ) {
		get_template_part( '/includes/sidebars/sidebar_ad_a' ); }
?>
