<?php if ( !defined( 'ABSPATH' ) ) exit;

/*

	1 - GLOBAL

		1.1 - Content width
		1.2 - Automatic RSS feeds
		1.3 - Localization
		1.4 - Thumbnails
		1.5 - Editor styles
		1.6 - Custom Background
		1.7 - Custom Header
		1.8 - Title tag

	2 - FILTERS

		2.1 - Header meta
		2.2 - Favicon
		2.3 - Excerpt in search results
		2.4 - JS misc data
		2.5 - Browser name as body class
		2.6 - Default more text link
		2.7 - Custom fields on user profile

	3 - ACTIONS

		3.1 - Replace CSS class in Custom Menu widget
		3.2 - Tag widget fix
		3.3 - Remove rel attribute for validation
		3.4 - IE detection
		3.5 - After theme activation

	4 - FUNCTIONS
		
		4.1 - Get post meta
		4.2 - Get post terms
		4.3 - Get page id by template
		4.4 - Get the Redirect page
		4.5 - Logo
		4.6 - Drop-down menu
		4.7 - Dummy data for Sidebar
		4.8 - Display Sidebar
		4.9 - Prev/Next post link
		4.10 - Post meta
		4.11 - Fallback theme notice

*/

/*= 1 ===========================================

	G L O B A L
	Required WordPress settings

===============================================*/

	global
		$birdhouse_Options,
		$birdhouse_Settings;



	/*-------------------------------------------
		1.1 - Content width
	-------------------------------------------*/

	$content_width = $birdhouse_Options['global']['content_width'];



	/*-------------------------------------------
		1.2 - Automatic RSS feeds
	-------------------------------------------*/

	if ( $birdhouse_Options['global']['rss'] ) {
		add_theme_support( 'automatic-feed-links' ); }



	/*-------------------------------------------
		1.3 - Localization
	-------------------------------------------*/

	function st_textdomain() {
	
		global
			$birdhouse_Options;
	
			if ( $birdhouse_Options['global']['lang'] ) {

				if ( file_exists( get_stylesheet_directory() . '/assets/lang/' ) ) {
					load_theme_textdomain( 'birdhouse', get_stylesheet_directory() . '/assets/lang' ); }
			
				else {
					load_theme_textdomain( 'birdhouse', get_template_directory() . '/assets/lang' ); }

			}
	
	}
	
	add_action( 'after_setup_theme', 'st_textdomain' );


	/*-------------------------------------------
		1.4 - Thumbnails
	-------------------------------------------*/

	// Thumbs
	if ( function_exists( 'add_image_size' ) ) {

		foreach ( $birdhouse_Options['global']['images'] as $birdhouse_['key'] => $birdhouse_['value'] ) {

			if ( $birdhouse_Options['global']['images'][$birdhouse_['key']]['status'] ) { 

				// Normal size	
				$birdhouse_['width'] = esc_html( $birdhouse_Options['global']['images'][$birdhouse_['key']]['width'] );
				$birdhouse_['height'] = esc_html( $birdhouse_Options['global']['images'][$birdhouse_['key']]['height'] );
				$birdhouse_['crop'] = $birdhouse_Options['global']['images'][$birdhouse_['key']]['crop'] ? true : false;

				add_image_size( $birdhouse_['key'], $birdhouse_['width'], $birdhouse_['height'], $birdhouse_['crop'] );

				// HiDPI size
				if ( function_exists( 'st_kit' ) ) {

					if ( $birdhouse_Options['panel']['misc']['hidpi'] && !isset( $birdhouse_Settings['hidpi'] ) || !empty( $birdhouse_Settings['hidpi'] ) != 'no' ) {
	
						$birdhouse_['width'] = esc_html( $birdhouse_Options['global']['images'][$birdhouse_['key']]['width'] ) * 2;
						$birdhouse_['height'] = esc_html( $birdhouse_Options['global']['images'][$birdhouse_['key']]['height'] ) * 2;
			
						add_image_size( $birdhouse_['key'] . '-2x', $birdhouse_['width'], $birdhouse_['height'], $birdhouse_['crop'] );
	
					}

				}

			}

		}

	}

	add_theme_support( 'post-thumbnails' );



	/*-------------------------------------------
		1.5 - Editor styles
	-------------------------------------------*/

	function my_theme_add_editor_styles() {
		add_editor_style( 'style.css' );
	}

	add_action( 'init', 'my_theme_add_editor_styles' );



	/*-------------------------------------------
		1.6 - Custom Background
	-------------------------------------------*/

	if ( $birdhouse_Options['global']['custom-background'] ) {

		$birdhouse_['custom_background_cb'] = function_exists( 'st_custom_background_cb' ) ? 'st_custom_background_cb' : '_custom_background_cb';

		$birdhouse_['args'] = array(
			'default-color'			=> esc_html( isset( $birdhouse_Options['panel']['style']['general']['colors']['default'] ) ? $birdhouse_Options['panel']['style']['general']['colors']['default'] : $birdhouse_Options['panel']['style']['general']['colors']['primary']['hex'] ),
			'default-image'			=> esc_html( !empty( $birdhouse_Options['panel']['style']['general']['background-image'] ) ? get_template_directory_uri() . '/assets/images/' . $birdhouse_Options['panel']['style']['general']['background-image'] : '' ),
			'wp-head-callback'		=> $birdhouse_['custom_background_cb'],
		);

		add_theme_support( 'custom-background', $birdhouse_['args'] );

	}



	/*-------------------------------------------
		1.7 - Custom Header
	-------------------------------------------*/

	if ( $birdhouse_Options['global']['custom-header'] ) {

		$birdhouse_['args'] = array();

		add_theme_support( 'custom-header', $birdhouse_['args'] );

	}



	/*-------------------------------------------
		1.8 - Title tag
	-------------------------------------------*/

	if ( $birdhouse_Options['global']['title-tag'] ) {

		$birdhouse_['args'] = array();

		add_theme_support( 'title-tag' );

	}



/*= 2 ===========================================

	F I L T E R S
	Permanent custom filters

===============================================*/

	/*-------------------------------------------
		2.1 - Header meta
	-------------------------------------------*/

	function st_head_meta() {

		$birdhouse_['array'] = array (
			"<meta charset='UTF-8' />",
			"<meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=3' />",
			"<meta name='dcterms.audience' content='Global' />"
			);

		foreach ( $birdhouse_['array'] as $birdhouse_['key'] ) {
			echo $birdhouse_['key'] . "\n"; }

	}

	add_filter( 'wp_head', 'st_head_meta', 1 );



	/*-------------------------------------------
		2.2 - Favicon
	-------------------------------------------*/

	/* n/a */



	/*-------------------------------------------
		2.3 - Excerpt in search results
	-------------------------------------------*/

	if ( $birdhouse_Options['global']['excerpt-in-search'] && is_search() ) {

		function st_search_where( $where ) {

			return preg_replace( "/post_title\s+LIKE\s*(\'[^\']+\')/", "post_title LIKE $1) OR (post_excerpt LIKE $1", $where );

		}

		add_filter( 'posts_where', 'st_search_where' );

	}



	/*-------------------------------------------
		2.4 - JS misc data
	-------------------------------------------*/

	function st_js_data() {

		global
			$birdhouse_Options,
			$birdhouse_Settings;

			/*
				stData[0] - Primary color
				stData[1] - Secondary color
				stData[2] - Template URL
				stData[3] - Site URL
				stData[4] - Current post ID
				stData[5] - Plugins path
				stData[6] - Boxed version
				
			*/

			/*--- Primary color ------------------------------*/

			$color = $birdhouse_Options['panel']['style']['general']['colors']['primary']['hex'];
				$primary = ( !empty( $birdhouse_Settings['color-primary'] ) && function_exists( 'st_kit' ) ) ? $birdhouse_Settings['color-primary'] : $color;

			/*--- Secondary color ------------------------------*/

			$color = $birdhouse_Options['panel']['style']['general']['colors']['secondary']['hex'];
				$secondary = ( !empty( $birdhouse_Settings['color-secondary'] ) && function_exists( 'st_kit' ) ) ? $birdhouse_Settings['color-secondary'] : $color;

			?><script type='text/javascript'>/* <![CDATA[ */var stData = new Array();
			stData[0] = "<?php echo esc_html( $primary ) ?>";
			stData[1] = "<?php echo esc_html( $secondary ) ?>";
			stData[2] = "<?php echo esc_url( get_template_directory_uri() ) ?>";
			stData[3] = "<?php echo esc_url( get_site_url() ) ?>";
			stData[4] = "<?php echo is_single() ? get_queried_object_id() : 0 ?>";
			stData[5] = "<?php echo esc_url( plugins_url() ) ?>";
			stData[6] = "<?php echo esc_html( !empty( $birdhouse_Options['panel']['layout']['general']['layout_design'] ) == true ? 'boxed' : 'wide' ); ?>";/* ]]> */</script><?php echo "\n";

	}

	add_filter( 'wp_footer', 'st_js_data' );



	/*-------------------------------------------
		2.5 - Browser name as body class
	-------------------------------------------*/

	function st_browser_body_class( $classes ) {

		global
			$is_lynx,
			$is_gecko,
			$is_IE,
			$is_opera,
			$is_NS4,
			$is_safari,
			$is_chrome,
			$is_iphone;

		if ( $is_lynx ) {
			$classes[] = 'lynx'; }

		elseif ( $is_gecko ) {
			$classes[] = 'gecko'; }

		elseif ( $is_opera ) {
			$classes[] = 'opera'; }

		elseif ( $is_NS4 ) {
			$classes[] = 'ns4'; }

		elseif ( $is_safari ) {
			$classes[] = 'safari'; }

		elseif ( $is_chrome ) {
			$classes[] = 'chrome'; }

		elseif ( $is_IE ) {
			$classes[] = 'ie'; }

		elseif ( $is_iphone ) {
			$classes[] = 'iphone'; }

		else {
			$classes[] = 'unknown'; }

		return
			$classes;

	}

	add_filter( 'body_class', 'st_browser_body_class' );



	/*-------------------------------------------
		2.6 - Default more text link
	-------------------------------------------*/

	function modify_read_more_link() {
	
		return '<a class="more-link" href="' . esc_url( get_permalink() ) . '">' . esc_html__( 'Continue Reading', 'birdhouse' ) . '</a>';

	}
	add_filter( 'the_content_more_link', 'modify_read_more_link' );



	/*-------------------------------------------
		2.7 - Custom fields on user profile
	-------------------------------------------*/

	function modify_contact_methods($profile_fields) {
	
		// Social networks
		$profile_fields['instagram'] = 'Instagram';
		$profile_fields['pinterest'] = 'Pinterest';
		$profile_fields['linkedin'] = 'LinkedIn';
		$profile_fields['vk'] = 'VK';
		$profile_fields['youtube'] = 'YouTube';
	
		return $profile_fields;
	}
	add_filter('user_contactmethods', 'modify_contact_methods');



/*= 3 ===========================================

	A C T I O N S
	Permanent custom actions

===============================================*/

	/*-------------------------------------------
		3.1 - Replace CSS class in Custom Menu widget
	-------------------------------------------*/

	function st_class_custom_menu( $args = array() ) {

		$args['menu_class'] = 'widget_custom_menu';

		return $args;
	}

	add_action( 'wp_nav_menu_args', 'st_class_custom_menu' );



	/*-------------------------------------------
		3.2 - Tag widget fix
	-------------------------------------------*/

	function st_tag_cloud( $args = array() ) {

		global
			$birdhouse_Options;

			$args['smallest'] = esc_html( $birdhouse_Options['global']['tag-cloud'] );
			$args['largest'] = esc_html( $birdhouse_Options['global']['tag-cloud'] );
			$args['unit'] = 'px';
			$args['separator'] = '';
			$args['orderby'] = 'count';
			$args['order'] = 'DESC';

		return
			$args;

	}

	add_action( 'widget_tag_cloud_args', 'st_tag_cloud' );



	/*-------------------------------------------
		3.3 - Remove rel attribute for validation
	-------------------------------------------*/

	function remove_category_list_rel( $output ) {

		return str_replace( ' rel="category tag"', '', $output );

	}
	 
	add_filter( 'wp_list_categories', 'remove_category_list_rel' );
	add_filter( 'the_category', 'remove_category_list_rel' );



	/*-------------------------------------------
		3.4 - IE detection
	-------------------------------------------*/

	function st_ie_detect() {

		echo
			'<!--[if IE 8 ]><div id="ie8-detect"></div><![endif]-->' . "\n" .
			'<!--[if IE 9 ]><div id="ie9-detect"></div><![endif]-->' . "\n";

	}
	 
	add_filter( 'wp_head', 'st_ie_detect', 999 );



	/*-------------------------------------------
		3.5 - After theme activation
	-------------------------------------------*/

	if ( is_admin() ) {

		// Add Welcome page
		function st_welcome_page() {
			include( get_template_directory() . '/framework/welcome.php' );
		}
		
		function st_welcome_screen_page() {

			global
				$birdhouse_Options;

			$birdhouse_['label'] = sprintf( esc_html__( "%s Setup", 'birdhouse' ), $birdhouse_Options['general']['label'] );

			add_theme_page( $birdhouse_['label'], $birdhouse_['label'], 'edit_theme_options', 'st-theme-welcome', 'st_welcome_page' );

		}

		if ( empty( $birdhouse_Settings ) ) {
			add_action( 'admin_menu', 'st_welcome_screen_page' ); }

		// Single redirection for fresh theme
		if ( empty( $birdhouse_Settings ) ) {
	
			$birdhouse_['current_theme'] = wp_get_theme();
			$birdhouse_['theme_name'] = strtolower( preg_replace( '#[^a-zA-Z]#','', $birdhouse_['current_theme']->get( 'Name' ) ) );
			$birdhouse_['redirect_check'] = get_option( $birdhouse_['theme_name'] . '_after_switch_theme_redirect' );
	
			if ( empty( $birdhouse_['redirect_check'] ) ) {
	
				update_option( $birdhouse_['theme_name'] . '_after_switch_theme_redirect', 'done' );
	
				exit( wp_redirect( admin_url( 'themes.php?page=st-theme-welcome' ) ) );
				die();
	
			}
	
		}

	}



/*= 4 ===========================================

	F U N C T I O N S
	Permanent custom functions

===============================================*/

	/*-------------------------------------------
		4.1 - Get post meta
	-------------------------------------------*/

	function st_get_post_meta( $post_id, $key, $single, $default ) {

		$meta = get_post_meta( $post_id, $key, $single );
		$meta = $meta ? $meta : $default;

		return $meta;

	}



	/*-------------------------------------------
		4.2 - Get post terms
	-------------------------------------------*/


	function st_wp_get_post_terms( $post, $taxonomy, $link = true, $label = 'name', $divider = 'comma' ) {

		$out = '';
		$terms = wp_get_post_terms( $post, $taxonomy );
		$d = $divider == 'comma' ? ', ' : $divider;

		if ( is_array( $terms ) ) {

			foreach ( $terms as $term ) {

				if ( $link ) {
					$out .= '<a href="' . esc_url( get_term_link( $term, $taxonomy ) ) . '">' . $term->$label . '</a>' . $d; }

				else {
					$out .= $term->$label . $d; }

			}

			$out = $divider == 'comma' ? substr( $out, 0, -2 ) : substr( $out, 0, -1 ); // Cut last divider

		}

		return $out;

	}



	/*-------------------------------------------
		4.3 - Get page id by template
	-------------------------------------------*/

	function st_get_page_by_template( $filename ) {

		$birdhouse_['pages'] = get_pages(
			array(
				'meta_key'		=> '_wp_page_template',
				'meta_value'	=> $filename . '.php'
				)
		);

		$birdhouse_['id'] = '';

		foreach ( $birdhouse_['pages'] as $birdhouse_['page'] ) {
			$birdhouse_['id'] = $birdhouse_['page']->ID; }

		return $birdhouse_['id'];

	}



	/*-------------------------------------------
		4.4 - Get the Redirect page
	-------------------------------------------*/

	function st_get_redirect_page_url() {

		return;

	}



	/*-------------------------------------------
		4.5 - Logo
	-------------------------------------------*/

	function st_logo() {

		if ( function_exists( 'st_kit' ) ) {

			global
				$birdhouse_Options,
				$birdhouse_Settings;
	
				$birdhouse_['logo_type'] = !empty( $birdhouse_Settings['logo_type'] ) ? $birdhouse_Settings['logo_type'] : 'image';
				$birdhouse_['text'] = !empty( $birdhouse_Settings['sitename'] ) ? $birdhouse_Settings['sitename'] : $birdhouse_Options['general']['label'];
				$birdhouse_['logo'] = $birdhouse_['logo_type'] == 'image' && !empty( $birdhouse_Settings['logo'] ) ? $birdhouse_Settings['logo'] : get_template_directory_uri() . '/assets/images/logo.png';

				// Image
				if ( $birdhouse_['logo_type'] == 'image' ) {
					echo '<h2><a href="' . esc_url( home_url( '/' ) ) . '"><img src="' . esc_url( $birdhouse_['logo'] ) . '" alt="' . esc_html( $birdhouse_['text'] ) . '"/></a></h2>'; }
	
				// Text or Default
				else {
					echo '<h2><a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html( $birdhouse_['text'] ) . '</a></h2>'; }

		}

		else {

			// Standard Site name
			echo '<h2><a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html( get_bloginfo( 'sitename' ) ) . '</a></h2>';

		}

	}



	/*-------------------------------------------
		4.6 - Drop-down menu
	-------------------------------------------*/

	function st_the_menu_drop_down() {

		global
			$birdhouse_Settings;

			if ( !isset( $birdhouse_Settings['layout_type'] ) || !empty( $birdhouse_Settings['layout_type'] ) && $birdhouse_Settings['layout_type'] != 'standard' ) {
				st_menu_drop_down(); }

		return;

	}



	/*-------------------------------------------
		4.7 - Dummy data for Sidebar
	-------------------------------------------*/

	function st_sidebar_dummy( $tag, $name ) {

		echo
			"\n" . '<div class="widget">' .

				"\n" . '<'.$tag.'><span>' . $name . '</span></'.$tag.'>' .
	
				"\n" . '<p>' . sprintf( esc_html__( 'Drop a widget on "%s" sidebar at Appearance > Widgets page.', 'birdhouse' ), $name ) . '</p>' .

			"\n" . '</div>';

	}



	/*-------------------------------------------
		4.8 - Display Sidebar
	-------------------------------------------*/

	function st_get_sidebar( $name ) {

		$sidebar = $name == 'Secondary Sidebar' ? 'sidebar-secondary' : 'sidebar';

			echo '<div id="' . $sidebar . '"><div class="sidebar">';
	
				if ( function_exists('dynamic_sidebar') && dynamic_sidebar( $name ) );
	
			echo '</div></div>';

	}



	/*-------------------------------------------
		4.9 - Prev/Next post link
	-------------------------------------------*/

	function st_prev_next_post() {

		$prev = get_previous_post();
		$next = get_next_post();
		$prev_link = '';
		$next_link = '';
		$birdhouse_['is_thumb'] = false;
		$birdhouse_['thumb'] = '<span><!-- Img --></span>';

		if ( $prev ) {

			if ( has_post_thumbnail( $prev->ID ) ) {
				$birdhouse_['url'] = wp_get_attachment_image_src( get_post_thumbnail_id( $prev->ID ), ( 'birdhouse-thumbnail' ) );
				$birdhouse_['thumb'] = '<img src="' . esc_url( $birdhouse_['url'][0] ) . '" alt="" />';
				$birdhouse_['is_thumb'] = true;
			}

			$prev_link = '<div class="p"><div' . ( $birdhouse_['is_thumb'] ? ' class="thumb-yes"' : '' ) . '>' . $birdhouse_['thumb'] . '<a href="' . get_permalink( $prev->ID ) . '">' . $prev->post_title . '</a></div></div>';

		}
		
		if ( $next ) {

			if ( has_post_thumbnail( $next->ID ) ) {
				$birdhouse_['url'] = wp_get_attachment_image_src( get_post_thumbnail_id( $next->ID ), ( 'birdhouse-thumbnail' ) );
				$birdhouse_['thumb'] = '<img src="' . esc_url( $birdhouse_['url'][0] ) . '" alt="" />';
				$birdhouse_['is_thumb'] = true;
			}

			$next_link = '<div class="n"><div' . ( $birdhouse_['is_thumb'] ? ' class="thumb-yes"' : '' ) . '>' . $birdhouse_['thumb'] . '<a href="' . get_permalink( $next->ID ) . '">' . $next->post_title . '</a></div></div>';

		}


		if ( $prev_link || $next_link ) {
			return '<div id="pre_next_post">' . $prev_link . $next_link . '<div class="clear"><!-- --></div></div>'; }

		else {
			return; }

	}



	/*-------------------------------------------
		4.10 - Post meta
	-------------------------------------------*/

	function st_post_meta(
			$format		= true,
			$date		= true,
			$category	= true,
			$comments	= true,
			$tags		= true,
			$views		= false,
			$permalink	= false,
			$id 		= '',
			$wrapper	= true
		) {

		global
			$birdhouse_Options,
			$birdhouse_Settings,
			$post;

			$id = $id ? $id : $post->ID;

			$birdhouse_ = array();

			// Post type names
			$birdhouse_['st_post'] = esc_html( !empty( $birdhouse_Settings['ctp_post'] ) ? $birdhouse_Settings['ctp_post'] : $birdhouse_Options['ctp']['post'] );
			$birdhouse_['st_category'] = esc_html( !empty( $birdhouse_Settings['ctp_category'] ) ? $birdhouse_Settings['ctp_category'] : $birdhouse_Options['ctp']['category'] );
			$birdhouse_['st_tag'] = esc_html( !empty( $birdhouse_Settings['ctp_tag'] ) ? $birdhouse_Settings['ctp_tag'] : $birdhouse_Options['ctp']['tag'] );

			// Post format
			$birdhouse_['format'] = ( get_post_format( $id ) && $birdhouse_Options['global']['post-formats'][get_post_format( $id )]['status'] ) ? get_post_format( $id ) : 'standard';


				if ( $wrapper ) {
					echo '<div class="meta">'; }
			
						// If meta enabled
						if ( !isset( $birdhouse_Settings['post_meta'] ) || !empty( $birdhouse_Settings['post_meta'] ) && $birdhouse_Settings['post_meta'] == 'yes' ) {


							/*-------------------------------------------
								4.10.1 - Post format
							-------------------------------------------*/

							if ( $format == true && function_exists( 'st_kit' ) ) {

								$birdhouse_['format_label'] = '';

								if ( $birdhouse_['format'] != 'standard' ) {

									$birdhouse_['formats'] = array(
										'aside'		=> esc_html__( 'Aside', 'birdhouse' ),
										'image'		=> esc_html__( 'Image', 'birdhouse' ),
										'gallery'	=> esc_html__( 'Gallery', 'birdhouse' ),
										'audio'		=> esc_html__( 'Audio', 'birdhouse' ),
										'video'		=> esc_html__( 'Video', 'birdhouse' ),
										'link'		=> esc_html__( 'Link', 'birdhouse' ),
										'quote'		=> esc_html__( 'Quote', 'birdhouse' ),
										'status'	=> esc_html__( 'Status', 'birdhouse' ),
										'chat'		=> esc_html__( 'Chat', 'birdhouse' )
									);

									foreach ( $birdhouse_['formats'] as $birdhouse_['key'] => $birdhouse_['value'] ) {
										if ( $birdhouse_['key'] == $birdhouse_['format'] ) {
											$birdhouse_['format_label'] = $birdhouse_['value']; }
									}

									echo '<span class="ico16 ico16-' . $birdhouse_['format'] . '"><a href="' . esc_url( get_post_format_link( $birdhouse_['format'] ) ) . '">' . esc_html( $birdhouse_['format_label'] ) . '</a></span>';

								}

							}


							/*-------------------------------------------
								4.10.2 - Date
							-------------------------------------------*/

							if ( $date == true ) {

								echo '<span class="ico16 ico16-calendar">';
				
									if ( !empty( $birdhouse_Settings['nice_time'] ) && $birdhouse_Settings['nice_time'] == 'yes' && function_exists( 'st_niceTime' ) ) {
										$birdhouse_['date'] = st_niceTime( $post->post_date_gmt ); }
				
									else {
										$birdhouse_['date'] = get_the_time( get_option('date_format'), $id ); }
				
									if ( is_single() || function_exists( 'st_kit' ) ) {
										echo $birdhouse_['date']; }

									else {
										echo '<a href="' . esc_url( get_permalink( $id ) ) . '">' . esc_html( $birdhouse_['date'] ) . '</a>'; }
				
								echo '</span>';

							}

				
							/*-------------------------------------------
								4.10.3 - Comments
							-------------------------------------------*/

							if ( $comments == true ) {

								if ( !empty( $birdhouse_Settings['post_comments'] ) && $birdhouse_Settings['post_comments'] == 'yes' && comments_open( $id ) && get_comments_number( $id ) != 0 ) { ?>

									<span class="ico16 ico16-comment-2"><?php

										if ( $comments === true ) {
											comments_popup_link( esc_html__( 'Leave a reply', 'birdhouse' ), esc_html__( '1 Comment', 'birdhouse' ), esc_html__( '% Comments', 'birdhouse' ), '', '' ); }
										else {
											comments_popup_link( '0', '1', '%', '', '' ); } ?>

									</span><?php

								}

							}


							/*-------------------------------------------
								4.10.4/5 - Category & Tags
							-------------------------------------------*/

							if ( $post->post_type != 'page' ) {

								// If project
								if ( get_post_type() == $birdhouse_['st_post'] ){
	
									if ( $category == true && $birdhouse_['posted_in'] = st_wp_get_post_terms( $id, $birdhouse_['st_category'] ) ) {
										echo '<span class="ico16 ico16-folder">' . esc_html( $birdhouse_['posted_in'] ) . '</span>'; }
	
									if ( $tags == true && $birdhouse_['tagged_by'] = st_wp_get_post_terms( $id, $birdhouse_['st_tag'] ) ) {
										echo '<span class="ico16 ico16-tag">' . esc_html( $birdhouse_['tagged_by'] ) . '</span>'; }
	
								}
	
								// If post
								else {

									if ( $category == true ) { ?>
										<span class="ico16 ico16-folder"><?php the_category(', ') ?></span><?php }

									if ( $tags == true ) {
										the_tags('<span class="ico16 ico16-tag">', ', ', '</span>'); }
	
								}

							}


							/*-------------------------------------------
								4.10.6 - Views
							-------------------------------------------*/

							if ( $views == true ) {
								if ( !empty( $birdhouse_Settings['post_views'] ) && $birdhouse_Settings['post_views'] == 'yes' && function_exists( 'st_getPostViews' ) ) {
									echo '<span class="ico16 ico16-views">' . esc_html( st_getPostViews( $id ) ) . '</span>'; }
							}


							/*-------------------------------------------
								4.10.7 - Permalink
							-------------------------------------------*/

							if ( $permalink == true ) { ?>
								<span class="ico16 ico16-link"><a href="<?php the_permalink( $id ); ?>"><?php echo esc_url( $permalink === true ? get_permalink( $id ) : $permalink ); ?></a></span><?php }


						}

				if ( $wrapper ) {
					echo '</div><!-- .meta -->'; }

	}



	/*-------------------------------------------
		4.11 - Fallback theme notice
	-------------------------------------------*/

	function st_fallback_theme_notice() {

		global
			$birdhouse_,
			$birdhouse_Options; ?>
	
			<div class="updated">
				<p>
					<?php echo wp_kses( !empty( $birdhouse_['fallback_theme_notice'] ) ? $birdhouse_['fallback_theme_notice'] : ':)', $birdhouse_Options['tags_allowed'] ) ?>
				</p>
			</div><?php

	}



?>