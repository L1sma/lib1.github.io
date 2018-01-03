<?php if ( !defined( 'ABSPATH' ) ) exit;

	global
		$birdhouse_Options,
		$birdhouse_Settings;

		$birdhouse_ = array();

		$birdhouse_['scheme'] = !empty( $birdhouse_Settings['footer_sidebars'] ) ? $birdhouse_Settings['footer_sidebars'] : $birdhouse_Options['panel']['layout']['footer']['scheme']['default']; ?>
	
	
		<div id="footer-box" class="footer-box-v<?php echo esc_attr( $birdhouse_['scheme'] ); ?>"><?php
	
	
			if (
	
			   !$birdhouse_['scheme'] ||
				$birdhouse_['scheme'] == 'none' ):	// None
	
					echo '<div class="clear"><!-- --></div>';
	
			
			elseif (
	
				$birdhouse_['scheme'] == 1 ||	// 1/3 + 1/3 + 1/3
				$birdhouse_['scheme'] == 2 ||	// 1/4 + 1/4 + 2/4
				$birdhouse_['scheme'] == 3 ||	// 1/4 + 2/4 + 1/4
				$birdhouse_['scheme'] == 4 ):	// 2/4 + 1/4 + 1/4
	
					echo '<div class="sidebar-footer"><div>';
						if ( function_exists('dynamic_sidebar' ) && dynamic_sidebar( 'Footer Sidebar 1' ) ); else st_sidebar_dummy( 'h5', 'Footer Sidebar 1' );
					echo '</div></div>';
		
					echo '<div class="sidebar-footer"><div>';
						if ( function_exists('dynamic_sidebar' ) && dynamic_sidebar( 'Footer Sidebar 2' ) ); else st_sidebar_dummy( 'h5', 'Footer Sidebar 2' );
					echo '</div></div>';
		
					echo '<div class="sidebar-footer last"><div>';
						if ( function_exists('dynamic_sidebar' ) && dynamic_sidebar( 'Footer Sidebar 3' ) ); else st_sidebar_dummy( 'h5', 'Footer Sidebar 3' );
					echo '</div></div>';
					
					echo '<div class="clear"><!-- --></div>';
	
	
			elseif (
	
				$birdhouse_['scheme'] == 5 ):	// 1/4 + 1/4 + 1/4 + 1/4
	
					echo '<div class="sidebar-footer"><div>';
						if ( function_exists('dynamic_sidebar' ) && dynamic_sidebar( 'Footer Sidebar 1' ) ); else st_sidebar_dummy( 'h5', 'Footer Sidebar 1' );
					echo '</div></div>';
		
					echo '<div class="sidebar-footer"><div>';
						if ( function_exists('dynamic_sidebar' ) && dynamic_sidebar( 'Footer Sidebar 2' ) ); else st_sidebar_dummy( 'h5', 'Footer Sidebar 2' );
					echo '</div></div>';
		
					echo '<div class="sidebar-footer"><div>';
						if ( function_exists('dynamic_sidebar' ) && dynamic_sidebar( 'Footer Sidebar 3' ) ); else st_sidebar_dummy( 'h5', 'Footer Sidebar 3' );
					echo '</div></div>';
		
					echo '<div class="sidebar-footer last"><div>';
						if ( function_exists('dynamic_sidebar' ) && dynamic_sidebar( 'Footer Sidebar 4' ) ); else st_sidebar_dummy( 'h5', 'Footer Sidebar 4' );
					echo '</div></div>';
					
					echo '<div class="clear"><!-- --></div>';
	
	
			elseif (
	
				$birdhouse_['scheme'] == 6 ):	// 2/3 + 1/3
	
				echo '<div class="sidebar-footer"><div>';
					if ( function_exists('dynamic_sidebar' ) && dynamic_sidebar( 'Footer Sidebar 1' ) ); else st_sidebar_dummy( 'h5', 'Footer Sidebar 1' );
				echo '</div></div>';
	
				echo '<div class="sidebar-footer last"><div>';
					if ( function_exists('dynamic_sidebar' ) && dynamic_sidebar( 'Footer Sidebar 2' ) ); else st_sidebar_dummy( 'h5', 'Footer Sidebar 2' );
				echo '</div></div>';
				
				echo '<div class="clear"><!-- --></div>';
	
	
			endif; ?>
	
		</div><!-- end footer-box -->