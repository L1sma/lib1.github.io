<?php if ( !defined( 'ABSPATH' ) ) exit;

	global
		$birdhouse_,
		$birdhouse_Settings;

		// Sidebar name
		$birdhouse_['sidebar'] = esc_html( !empty( $birdhouse_['sidebar'] ) ? $birdhouse_['sidebar'] : 'default-sidebar' );

		// Sidebar sticky
		$birdhouse_['sidebar_primary_sticky'] = esc_html( !empty( $birdhouse_Settings['sidebar_primary_sticky'] ) ? ' st-sticky' : '' );

		echo '<div role="complementary" class="sidebar-primary' . $birdhouse_['sidebar_primary_sticky'] . '" data-master="content-box"><div class="sidebar">';
	
			dynamic_sidebar( $birdhouse_['sidebar'] );
	
		echo '</div></div>';

?>

