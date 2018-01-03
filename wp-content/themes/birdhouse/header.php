<?php if ( !defined( 'ABSPATH' ) ) exit; ?><!DOCTYPE html>

<html <?php language_attributes(); ?>>

	<head>
		<?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?> itemtype="http://schema.org/WebPage" itemscope="itemscope">

		<div id="offset-sidebar-holder">
			<span class="close"><!-- X --></span>
			<div>
				<?php
				
					echo '<div class="sidebar sidebar-offset">';
				
						// Sidebar Offset
						if ( function_exists('dynamic_sidebar') && dynamic_sidebar('Offset Sidebar') );
				
					echo '</div>';
				
				?>
			</div>
		</div>

		<?php

			global
				$birdhouse_Options,
				$birdhouse_Settings,
				$paged;

			if ( !isset( $birdhouse_Settings['layout_type'] ) || $birdhouse_Options['panel']['style']['general']['responsive'] && !empty( $birdhouse_Settings['layout_type'] ) && $birdhouse_Settings['layout_type'] != 'standard' ) { ?>

				<div id="resp-top-panel">
					<span id="menu-resp-button"><!-- Menu button --></span>
					<span class="offset-sidebar-holder-button"><!-- Button --></span>
				</div><?php

			}
		?>

		<div id="layout" class="<?php echo !empty( $birdhouse_Settings['page-transition'] ) == 'yes' ? 'opacity-0' : ''; ?>">

			<?php
				// Get header template
				$birdhouse_['header'] = esc_html( !empty( $birdhouse_Settings['header_template'] ) ? $birdhouse_Settings['header_template'] : '3' );
			?>

			<div id="header" class="header-<?php echo $birdhouse_['header']; ?>">

				<?php

					// Header
					get_template_part( '/includes/header/t' . $birdhouse_['header'] );

					// Posts sticky
					get_template_part( '/includes/posts/sticky' );

					// Featured categories
					if ( $birdhouse_['is_featured'] = true ) { // If sticky posts
						get_template_part( '/includes/categories/featured' ); }

				?>

			</div><!-- #header -->

			<div id="content-parent">

				<div id="content-layout">

					<?php
				
						// Sidebar Ad B
						if ( is_front_page() && $paged == 1 ) {
							if ( is_active_sidebar( 'ad-sidebar-2' ) ) {
								get_template_part( '/includes/sidebars/sidebar_ad_b' ); }
						}

					?>