<?php if ( !defined( 'ABSPATH' ) ) exit;

/*

	- general
	- global
	- js
	- menu
	- sidebars
	- widgets
	- metaboxes
	- shortcodes
	- breadcrumbs
	- networks
	- networks_path
	- panel

*/

/*===============================================

	T H E M E   O P T I O N S
	Unique options of the theme

===============================================*/

	global
		$birdhouse_Options,
		$birdhouse_Settings;

	$birdhouse_Options = array (
	
		'general'		=>	array (
								'name'				=>	'birdhouse_',
								'label'				=>	'BirdHouse',
								'prefix'			=>	'birdhouse-',
								'version'			=>	'1.0.2',
								'url'				=>	'http://strictthemes.com/to/BirdHouse',
								'url-demo'			=>	'http://strictthemes.com/to/LivePreview-BirdHouse',
								'documentation'		=>	'http://strictthemes.com/',
								'developer'			=>	'StrictThemes',
								'developer-url'		=>	'http://strictthemes.com',
								'stkit-min'			=>	'1.8.9',
								),
		'global'		=>	array (
								'content_width'		=>	849,
								'rss'				=>	true,
								'lang'				=>	true,
								'rtl'				=>	false,
								'excerpt'			=>	25, // words
								'excerpt-in-search'	=>	true,
								'tag-cloud'			=>	13, // px
								'post-formats'		=>	array(
															'enabled'		=>	true,
															'post-title'	=>	true, // metabox option
															'aside'			=>	array(
																						'status'		=>	false,
																						'label'			=>	esc_html__( 'Aside', 'birdhouse' ),
																					),
															'image'			=>	array(
																						'status'		=>	true,
																						'label'			=>	esc_html__( 'Image', 'birdhouse' ),
																					),
															'gallery'		=>	array(
																						'status'		=>	true,
																						'label'			=>	esc_html__( 'Gallery', 'birdhouse' ),
																					),
															'audio'			=>	array(
																						'status'		=>	true,
																						'label'			=>	esc_html__( 'Audio', 'birdhouse' ),
																					),
															'video'			=>	array(
																						'status'		=>	true,
																						'label'			=>	esc_html__( 'Video', 'birdhouse' ),
																					),
															'link'			=>	array(
																						'status'		=>	true,
																						'label'			=>	esc_html__( 'Link', 'birdhouse' ),
																					),
															'quote'			=>	array(
																						'status'		=>	true,
																						'label'			=>	esc_html__( 'Quote', 'birdhouse' ),
																					),
															'status'		=>	array(
																						'status'		=>	true,
																						'label'			=>	esc_html__( 'Status', 'birdhouse' ),
																					),
															'chat'			=>	array(
																						'status'		=>	false,
																						'label'			=>	esc_html__( 'Chat', 'birdhouse' ),
																					),
															),
								'images'			=>	array(
															//'st-thumbnail'		=>	array(
															'birdhouse-thumbnail'		=>	array(
																						'status'		=>	true,
																						'width'			=>	150,
																						'height'		=>	150,
																						'crop'			=>	true,
																						),
															//'st-medium'			=>	array(
															'birdhouse-medium'			=>	array(
																						'status'		=>	false,
																						'width'			=>	300,
																						'height'		=>	300,
																						'crop'			=>	true,
																						),
															//'st-large'			=>	array(
															'birdhouse-large'			=>	array(
																						'status'		=>	true,
																						'width'			=>	1200,
																						'height'		=>	9999,
																						'crop'			=>	false,
																						),
															//'st-archive-image'	=>	array(
															'birdhouse-archive-image'	=>	array(
																						'status'		=>	true,
																						'width'			=>	850,
																						'height'		=>	9999,
																						'crop'			=>	false,
																						),
															//'st-post-image'		=>	array(
															'birdhouse-post-image'		=>	array(
																						'status'		=>	true,
																						'width'			=>	640,
																						'height'		=>	9999,
																						'crop'			=>	false,
																						),
															//'st-project-thumb'	=>	array(
															'birdhouse-project-thumb'	=>	array(
																						'status'		=>	true,
																						'width'			=>	262,
																						'height'		=>	180,
																						'crop'			=>	true,
																						),
															//'st-project-medium'	=>	array(
															'birdhouse-project-medium'	=>	array(
																						'status'		=>	true,
																						'width'			=>	574,
																						'height'		=>	408,
																						'crop'			=>	true,
																						),
															),
								'custom-background'	=>	true,
								'custom-header'		=>	false,
								'category-image'	=>	true,
								'category-sidebar'	=>	true,
								'title-tag'			=>	true,
								'st_the_content_article'		=>	false,
								'st_the_content_article_end'	=>	false,
								'demo'				=>	array(
																'status'		=>	true,
																'frontpage'		=>	'Frontpage',
																'posts_per_page'=>	6,
																'content'		=>	array( // content parts
																						'pages'			=>	true,
																						'categories'	=>	true,
																						'menu'			=>	true,
																						'widgets'		=>	true,
																						'settings'		=>	true,
																						),
																'options'		=>	array( 'sb_instagram_settings' ), // other options which must be updated
														),
								),
		'ctp'			=>	array (
								'query'			=>	'main', /* needed for action */
								'assets'		=>	'disabled',
								'qty'			=>	'12',
								'qty_another'	=>	'8',
								'post'			=>	'st_project',
								'category'		=>	'st_category',
								'tag'			=>	'st_tag',
								'ctp-formats'	=>	array(
														'enabled'		=>	true,
														'gallery'		=>	array(
																					'status'		=>	false,
																					'label'			=>	esc_html__( 'Gallery', 'birdhouse' ),
																				),
														'audio'			=>	array(
																					'status'		=>	false,
																					'label'			=>	esc_html__( 'Audio', 'birdhouse' ),
																				),
														'video'			=>	array(
																					'status'		=>	false,
																					'label'			=>	esc_html__( 'Video', 'birdhouse' ),
																				),
														'bg-color'		=>	'disabled',
														'bg-image'		=>	'disabled',
														'formats'		=>	array(
																					'tag'			=>	'st_format',
																					'slug'			=>	'only',
																				),
														),
								),
		'js'			=>	array (
								'st'			=>	true,
								'menu'			=>	false,
								'theme'			=>	false,
								'prettyPhoto'	=>	false,
								'picbox'		=>	true,
								'mediaelement'	=>	true,
								'owl'			=>	true,
								'owl-options'	=>	array(
														'content-1200' => '2',
													),
								),
		'menu'			=>	array (
								'primary'		=>	true,
								'secondary'		=>	true,
								),
		'sidebars'		=>	array (
								'default'		=>	true,
								'secondary'		=>	false,
								'post-sidebar'	=>	false,
								'top'			=>	false,
								'offset'		=>	true,
								'homepage'		=>	false,
								'ads'			=>	array(
														esc_html__( 'Appears on the header of all pages.', 'birdhouse' ),
														esc_html__( 'Appears on the middle of homepage.', 'birdhouse' ),
														esc_html__( 'Appears on the bottom of all pages.', 'birdhouse' )
													),
								'projects'		=>	false,
								'footer'		=>	4,
								'bbPress'		=>	false,
								'buddyPress'	=>	false,
								'woocommerce'	=>	false,
								),
		'widgets'		=>	array (
								'sharrre'		=>	false,
								'contact-info'	=>	false,
								'flickr'		=>	false,
								'recent-posts'	=>	false,
								'recent-posts-v2'=>	true,
								'recent-posts-subtitle'	=>	true,
								'subscribe'		=>	false,
								'categories'	=>	true,
								),
		'metaboxes'		=>	array (
								'sidebar'		=>	true,
								'post-options'	=>	true,
								),
		'megamenu'		=>	array (
								'sidebar'		=>	true,
								),
		'shortcodes'	=>	array (
								'status'		=>	true,
								'column'		=>	true,
								'ul'			=>	true,
								'button'		=>	true,
								'alert'			=>	true,
								'highlight'		=>	true,
								'dropcap'		=>	true,
								'pullquote'		=>	true,
								'toggle'		=>	true,
								'accordion'		=>	true,
								'tabs'			=>	true,
								'googlemap'		=>	true,
								'pricing-table'	=>	true,
								'sidebar'		=>	true,
								'clear'			=>	true,
								'notice'		=>	true,
								'skill'			=>	true,
								'icon-box'		=>	true,
								'gallery'		=>	false,	// ST gallery // [st-gallery]
								'gallery-owl'	=>	true,	// Owl gallery // [st-gallery]
								'gallery-by'	=>	'owl',	// Override default [gallery] shortcode by Owl gallery
								),
		'breadcrumbs'	=>	true,
		'font-st'		=>	true,
		'networks'		=>	array (
								'life_RSS',
								'life_Facebook',
								'life_GooglePlus',
								'life_VK',
								//'life_500px',
								'life_Behance',
								'life_Blogger',
								'life_Delicious',
								'life_DeviantART',
								//'life_Digg',
								//'life_Dopplr',
								'life_Dribbble',
								'life_Evernote',
								'life_Flickr',
								'life_Forrst',
								'life_GitHub',
								//'life_Grooveshark',
								'life_Instagram',
								'life_Lastfm',
								'life_LinkedIn',
								//'life_MySpace',
								//'life_Path',
								'life_Picasa',
								'life_Pinterest',
								//'life_Posterous',
								'life_Reddit',
								'life_Skype',
								'life_SoundCloud',
								'life_Spotify',
								'life_Stumbleupon',
								'life_Tumblr',
								'life_Twitter',
								//'life_Viddler',
								'life_Vimeo',
								//'life_Virb',
								'life_WordPress',
								'life_Youtube',
								//'life_Zerply'
								),
		'networks_path'	=>	'18/social/color/',
		'compatibility'	=>	array(
								'yoast'			=>	true,
								'woocommerce'	=>	array(
														'qty'			=>	9,
														'per-row'		=>	3,
														'related'		=>	3,
														'catalog'		=>	array( 250, 250, 1 ),
														'single'		=>	array( 400, 400, 0 ),
														'thumbnail'		=>	array( 150, 150, 1 ),
													),
								'wp-review'	=>	array(
														'hide'			=>	array( 'custom_colors', 'color', 'fontcolor', 'bgcolor1', 'bgcolor2', 'bordercolor' ),
														'exclude'		=>	array( 'page', 'product' ),
													),
							),
		'tags_empty'	=>	array(), // needed
		'tags_allowed'	=>	array(
								'a'			=>	array(
													'class'				=> array(),
													'id'				=> array(),
													'href'				=> array(),
													'title'				=> array(),
													'target'			=> array(),
													),
								'b'			=>	array(),
								'br'		=>	array(),
								'blockquote'=>	array(
													'cite'				=> array(),
													),
								'code'		=>	array(),
								'div'		=>	array(
													'class'				=> array(),
													'id'				=> array(),
													),
								'em'		=>	array(),
								'h1'		=>	array(),
								'h2'		=>	array(),
								'h3'		=>	array(),
								'h4'		=>	array(),
								'h5'		=>	array(),
								'h6'		=>	array(),
								'i'			=>	array(),
								'img'		=>	array(
													'alt'				=> array(),
													'class'				=> array(),
													'id'				=> array(),
													'src'				=> array(),
													'title'				=> array(),
													),
								'iframe'	=>	array(
													'src'				=> array(),
													'width'				=> array(),
													'height'			=> array(),
													'scrolling'			=> array(),
													'frameborder'		=> array(),
													'allowfullscreen'	=> array(),
													),
								'link'		=>	array(
													'href'				=> array(),
													'rel'				=> array(),
													'type'				=> array(),
													),
								'p'			=>	array(),
								'pre'		=>	array(),
								'q'			=>	array(
													'cite'				=> array(),
													),
								'script'	=>	array(
													'type'				=> array(),
													'src'				=> array(),
													'id'				=> array(),
													),
								'span'		=>	array(
													'class'				=> array(),
													'id'				=> array(),
													),
								'strike'	=>	array(),
								'strong'	=>	array(),
								'table'		=>	array(
													'class'				=> array(),
													'id'				=> array(),
													),
								'td'		=>	array(),
								'tr'		=>	array(),
								),
		'panel'			=>	array(
								'major'			=>	array (
														'status'	=>	true,
														'general'	=>	array(
																			'status'		=>	true,
																			'logo_img'		=>	true,
																			'favicon'		=>	false,
																			'copyrights'	=>	true,
																			'dev_link'		=>	true,
																			'analytics'		=>	false,
																			),
														'blog'		=>	array(
																			'status'		=>	true,
																			'template'		=>	array(
																									'default'			=>	array (
																																'label'			=> esc_html__( 'Default', 'birdhouse' ),
																																'status'		=> true,
																																'desc'			=> esc_html__( 'This is standard template.', 'birdhouse' ),
																																),
																									't1'				=>	array (
																																'label'			=> '1',
																																'status'		=> true,
																																'desc'			=> '',
																																),
																									't2'				=>	array (
																																'label'			=> '2',
																																'status'		=> false,
																																'desc'			=> '',
																																),
																									't3'				=>	array (
																																'label'			=> '3',
																																'status'		=> false,
																																'desc'			=> '',
																																),
																									't4'				=>	array (
																																'label'			=> '4',
																																'status'		=> false,
																																'desc'			=> '',
																																),
																									't5'				=>	array (
																																'label'			=> '5',
																																'status'		=> false,
																																'desc'			=> '',
																																),
																									't6'				=>	array (
																																'label'			=> '6',
																																'status'		=> false,
																																'desc'			=> '',
																																),
																									't7'				=>	array (
																																'label'			=> '7',
																																'status'		=> false,
																																'desc'			=> '',
																																),
																									't8'				=>	array (
																																'label'			=> '8',
																																'status'		=> false,
																																'desc'			=> '',
																																),
																									't9'				=>	array (
																																'label'			=> '9',
																																'status'		=> false,
																																'desc'			=> '',
																																),
																									't10'				=>	array (
																																'label'			=> '10',
																																'status'		=> false,
																																'desc'			=> '',
																																),
																									't11'				=>	array (
																																'label'			=> '11',
																																'status'		=> false,
																																'desc'			=> '',
																																),
																									't12'				=>	array (
																																'label'			=> '12',
																																'status'		=> false,
																																'desc'			=> '',
																																),
																									't13'				=>	array (
																																'label'			=> '13',
																																'status'		=> false,
																																'desc'			=> '',
																																),
																									),
																			'featured'		=> array(
																									'sticky-status'				=>	true,
																									'sticky'					=>	false,
																									'sticky-cats'				=>	false,
																									'not-in-blogroll'			=>	true,
																									'on-frontpage'				=>	true,
																									'on-archives'				=>	false,
																									'on-single'					=>	false,
																									'on-others'					=>	false,
																									'cache'						=>	true,
																									'autoplay'					=>	true,
																									'most-viewed-status'		=>	false,
																									'most-viewed-period'		=>	true,
																									'most-viewed-on-frontpage'	=>	true,
																									'most-viewed-on-archives'	=>	true,
																									'most-viewed-on-single'		=>	true,
																									'most-viewed-on-others'		=>	true,
																									'most-viewed-cache'			=>	true,
																									),
																			'feat-cats'		=> array(
																									'status'					=>	true,
																									),
																			),
														'post'		=> array(
																			'status'			=>	true,
																			'after_title'		=>	true,
																			'before_post'		=>	true,
																			'post_feat_image'	=>	true,
																			'excerpt'			=>	true,
																			'post_meta'			=>	array(
																										'status'		=>	true,
																										'author_info'	=>	true,
																										'post_views'	=>	true,
																										'nice_time'		=>	true
																										),
																			'after_post'		=>	true,
																			'post_comments'		=>	true,
																			'related'			=>	true,
																			'related-period'	=>	true,
																			),
														'page'		=> array(
																			'status'			=>	true,
																			'page_comments'		=>	true
																			),
														'sidebar'		=> array(
																			'status'			=>	true,
																			'additional'		=>	true,
																			'labels'			=>	true,
																			'options'			=>	true,
																			'position'			=>	array(
																										'status'		=>	true,
																										'default'		=>	'right',
																										),
																			),
														),
								'layout'		=>	array(
														'status'	=> true,
														'general'	=>	array(
																			'status'			=>	true,
																			'layout_type'		=>	true,
																			'layout_design'		=>	true,
																			),
														'header'	=>	array(
																			'status'			=>	true,
																			'templates'			=>	array('3'),
																			'scheme'			=>	array(
																										'status'			=>	true,
																										'default'			=>	'3',
																									),
																			),
														'footer'	=>	array(
																			'status'			=>	true,
																			'scheme'			=>	array(
																										'status'			=>	true,
																										'default'			=>	'1',
																									),
																			),
														'social'	=>	array(
																			'status'			=>	true,
																			),
														),
								'projects'		=>	array (
														'status'	=>	false,
														'general'	=>	array(
																			'status'			=>	true,
																			'slugs'				=>	true,
																			),
														'portfolio'	=>	array(
																			'status'			=>	true,
																			'projects_qty'		=>	true,
																			'templates'			=>	array (
																										'status'		=>	false,
																										'default'		=>	array (
																																'status'		=>	false,
																																'label'			=>	esc_html__( 'Default', 'birdhouse' ),
																																'dummy'			=>	false,
																																),
																										't1'			=>	array (
																																'status'		=>	false,
																																'label'			=>	'1',
																																'dummy'			=>	false,
																																),
																										't2'			=>	array (
																																'status'		=>	false,
																																'label'			=>	'2',
																																'dummy'			=>	false,
																																),
																										't3'			=>	array (
																																'status'		=>	false,
																																'label'			=>	'3',
																																'dummy'			=>	false,
																																),
																										't4'			=>	array (
																																'status'		=>	false,
																																'label'			=>	'4',
																																'dummy'			=>	false,
																																),
																										't5'			=>	array (
																																'status'		=>	false,
																																'label'			=>	'5',
																																'dummy'			=>	false,
																																),
																										't6'			=>	array (
																																'status'		=>	false,
																																'label'			=>	'6',
																																'dummy'			=>	false,
																																)
																										),
																			'template-default'	=>	't5',
																			'another'			=>	true,
																			'another_qty'			=>	true,
																			'another_type'			=>	true,
																			'another_on-frontpage'	=>	true,
																			'another_on-archives'	=>	true,
																			'another_on-single'		=>	true,
																			'another_on-others'		=>	true,
																			'another_cache'			=>	true,
																			),
														'taxonomy'	=>	array(
																			'status'			=>	true,
																			),
														),
								'fonts'			=>	array(
														'status'	=>	true,
														'general'	=>	array(
																			'status'			=>	true,
																			'font_size'			=>	true,
																			'font_type'			=>	true,
																			'font_custom'		=>	true,
																			'font_custom_code'	=>	"<link href='https://fonts.googleapis.com/css?family=Lato:400,300,300italic,400italic,700' rel='stylesheet' type='text/css'>",
																			'font_custom_css'	=>	"font-family: 'Lato', sans-serif;",
																			),
														),
								'style'			=>	array(
														'status'	=>	true,
														'general'	=>	array(
																			'status'			=>	true,
																			'styles'			=>	array(
																										'status'		=>	false,
																										'light' 		=>	array (
																																'status'		=>	'default',
																																'label'			=>	esc_html__( 'Light', 'birdhouse' ),
																																),
																										'dark'			=>	array (
																																'status'		=>	true,
																																'label'			=>	esc_html__( 'Dark', 'birdhouse' ),
																																),
																										),
																			'colors'			=>	array(
																										'status'		=>	true,
																										'default'		=>	'',
																										'primary'		=>	array(
																																'hex'			=>	'1e2225',
																																'free'			=>	array(
																																						'.post-title-with-img:before { background: linear-gradient( to bottom, rgba(@@2rgb,1) 0%, rgba(@@2rgb,0.25) 100% ); }',
																																						'.post-sticky-a-yes-thumb a > div:before { background: linear-gradient( to bottom, rgba(@@2rgb,0.25) 0%, rgba(@@2rgb,0.8) 100% ); }',
																																						'#resp-top-panel { background-color: @@; border-top-color: @@; }',
																																						'@media only screen and ( min-width: 640px ) and ( max-width: 959px ) { #title-after { background: linear-gradient( to bottom, rgba(@@2rgb,0) 0%, rgba(@@2rgb,1) 100% ); } }',
																																						'@media only screen and ( min-width: 480px ) and ( max-width: 639px ) { #title-after { background: linear-gradient( to bottom, rgba(@@2rgb,0) 0%, rgba(@@2rgb,1) 100% ); } }',
																																						'@media only screen and ( max-width: 479px ) { #title-after { background: linear-gradient( to bottom, rgba(@@2rgb,0) 0%, rgba(@@2rgb,1) 100% ); } }',
																																						),
																																'color'			=>	array(
																																						'h1 a, h2 a, h3 a, h4 a, h5 a, h6 a',
																																						'ul.menu-2 > li > a',
																																						'.nav-next a, .nav-previous a',
																																						'#but-prev-next a',
																																						),
																																'background-color'	=>	array(
																																						'caption',
																																						'#header-holder',
																																						'input[type="button"]:hover',
																																						'#pbOverlay',
																																						'#pbImage',
																																						'.pricing-table-gray .pricing-table-title, .pricing-table-gray .pricing-table-price, .pricing-table-gray .button',
																																						'.pricing-table-dark .pricing-table-title, .pricing-table-dark .pricing-table-price, .pricing-table-dark .button',
																																						'.newsletter-widget',
																																						'#owl-sticky .post-sticky-a-yes-thumb picture:before',
																																						'.featured-categories a:before',
																																						'.featured-categories',
																																						'.st-feat-cat:before',
																																						'.st-feat-cat',
																																						'#menu-resp-holder',
																																						),
																																'border-top'	=>	array(
																																						),
																																'border-right'	=>	array(
																																						),
																																'border-bottom'	=>	array(
																																						),
																																'border-left'	=>	array(
																																						),
																																),
																										'primary-alt-a'	=>	array(
																																'steps'			=>	'20',
																																'free'			=>	array(
																																						//'.header-3 #menu-box:before { background: @@; }',
																																						),
																																'background-color'=> array(
																																						/*'.header-3 #menu-box:before',*/
																																						),
																																),
																										'secondary'		=>	array(
																																'hex'			=>	'56646f',
																																'free'			=>	array(
																																						'.status-header-links .ico16:hover:after { box-shadow: 0 0 0 13px @@ inset; }',
																																						'span.format-before { border-color: @@; }',
																																						),
																																'color'			=>	array(
																																						'h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover, h6 a:hover',
																																						'.title-sub',
																																						'a',
																																						'blockquote p:before',
																																						'blockquote cite',
																																						'#subscription-toggle a:before, #favorite-toggle a:before',
																																						'.widget_display_stats dd',
																																						'ul.menu ul.sub-menu li.hasUl > a:before',
																																						'#header li[class*="st-menu-col"] .st-menu-holder ul li a:before',
																																						'#menu-resp-holder > ul > li.stCurrent > span:before',
																																						'#menu-resp-holder ul ul ul li a:before',
																																						'#menu-resp-holder ul a i:before',
																																						'#menu-resp-holder li.current-menu-item a',
																																						'h1.post-title em',
																																						'#pre_next_post a em',
																																						'#owl-most-viewed-nav span.prev:before, #owl-most-viewed-nav span.next:after',
																																						'#owl-sticky-nav span.prev:before',
																																						'#owl-sticky-nav span.next:after',
																																						'#prev a:hover:before, #next a:hover:after',
																																						'.widget_custom_menu i:before',
																																						'.widget_custom_menu > li.stCurrent > span:before',
																																						'.widget_custom_menu ul ul li a:before',
																																						'.widget_custom_menu > li > ul > li > ul > li.current-menu-item > a',
																																						'.icons-social a:after',
																																						'.pullquote:after',
																																						'.accordion .toggle-opened .toggle-title',
																																						'.st-ul li.st-current',
																																						),
																																'background-color'	=>	array(
																																						'#layout .mejs-time-total, #layout .mejs-horizontal-volume-total',
																																						'#menu-box',
																																						'ul.menu-2 > li > a:after',
																																						'input[type="button"]',
																																						'input[type="submit"], button',
																																						'input[type="submit"]:hover, input[type="button"], button:hover',
																																						'#pre_next_post .p:after, #pre_next_post .n:after',
																																						'.post-sticky-a a > div:after',
																																						'#tabs-comments span.tab-comments-active:before',
																																						'.widget_rss h5 > a.rsswidget:first-child:before',
																																						'#wp-pagenavibox span.current:before',
																																						'#scroll-to-top',
																																						'.button-st',
																																						'.pricing-table-featured .pricing-table-title, .pricing-table-featured .pricing-table-price, .pricing-table-featured .button',
																																						'.skill-bar',
																																						'.header-3 ul.menu > li:before',
																																						'.header-3 #menu-box:not(.menu-box-fixed) ul.menu > li:before',
																																						'.st-format-link a:hover',
																																						'.format-before:before',
																																						'#wp-pagenavibox a.previouspostslink, #wp-pagenavibox a.nextpostslink',
																																						),
																																'border-top'	=>	array(
																																						),
																																'border-right'	=>	array(
																																						),
																																'border-bottom'	=>	array(
																																						),
																																'border-left'	=>	array(
																																						),
																																),
																										),
																			'background-image'	=>	'',
																			'responsive'		=>	true,
																			),
														'custom'	=>	array(
																			'status'			=>	true,
																			),
														),
								'misc'			=>	array(
														'status'	=>	true,
														'general'	=>	array(
																			'status'		=>	true,
																			),
														'admin_bar'		=>	true,
														'hidpi'			=>	false,
														'redirect'		=>	false,
														'stickymenu'	=>	false,
														'sidebar-alt'	=>	false,
														'cache-megamenu'=>	false,
														'smooth-scroll'	=>	true,
														'page-transition'=>	true,
														'gallery-default'=>	true,
														'adsense'		=>	false,
														'woocommerce'	=>	array(
																			'status'		=>	false,
																			'qty'			=>	true,
																			'assets'		=>	true,
																			),
														),
								'import'		=>	array(
														'status'	=>	false,
														),
								'update'		=>	array(
														'status'	=>	false,
														'general'	=>	array(
																			'status'		=>	true,
																			'source'		=>	'themeforest',
																			),
														),
								),
	); // $birdhouse_Options

?>