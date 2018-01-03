<?php if ( empty( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && strtolower( $_SERVER['HTTP_X_REQUESTED_WITH'] ) != 'xmlhttprequest' ) exit;

/*

	1 - INCLUDES

	2 - VARIABLES

	3 - LOOP

		- Retrieve data
		- Posts

*/

/*===============================================

	I N C L U D E S
	Required includes

===============================================*/

	define( 'WP_USE_THEMES', false );

	require_once('../../../../../../wp-load.php');


/*===============================================

	V A R I A B L E S
	Regured variables

===============================================*/

	$st_['post_type'] = sanitize_key ( isset( $_GET['post_type'] ) ? $_GET['post_type'] : 'none' );
	$st_['taxonomy'] = sanitize_key ( isset( $_GET['taxonomy'] ) ? $_GET['taxonomy'] : 'none' );
	$st_['field'] = sanitize_key ( isset( $_GET['field'] ) ? $_GET['field'] : 'none' );
	$st_['terms'] = isset( $_GET['terms'] ) ? explode( ' ', strtolower( preg_replace( '/\s+/', ' ', preg_replace( '/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $_GET['terms'] ) ) ) ) : array();
	$st_['paged'] = sanitize_key ( isset( $_GET['paged'] ) ? $_GET['paged'] : '1' );


	if ( $st_['post_type'] == 'none' ) {
		_e( 'The post type is not valid or do not exist.', 'birdhouse' ); return; }

	if ( $st_['taxonomy'] == 'none' ) {
		_e( 'The taxonomy is not valid or do not exist.', 'birdhouse' ); return; }

	if ( $st_['field'] == 'none' ) {
		_e( 'The field is not valid or do not exist.', 'birdhouse' ); return; }

	if ( empty( $st_['terms'] ) ) {
		_e( "The term is not valid or doesn't exist. Or you're using a some plugin which makes a changes within normal structure of permalinks for archives, such as removing the /category/ slug.", 'birdhouse' ); return; }


	// Arguments
	$st_['args'] = array(
		'post_type'				=> $st_['post_type'],
		'posts_per_page'		=> 4,
		'post_status'			=> 'publish',
		'order'					=> 'DESC',
		'orderby'   			=> 'date',
		'paged'					=> $st_['paged'],
		'ignore_sticky_posts'	=> 1,
		'tax_query'				=> array(
										array(
											'taxonomy'	=> $st_['taxonomy'],
											'field'		=> $st_['field'],
											'terms'		=> $st_['terms'],
										)
									),
	);


/*===============================================

	L O O P
	WordPress loop

===============================================*/

	// Transient
	$st_['transient_key'] = 'st_mega_' . $st_['taxonomy'] . ( sanitize_key ( strtolower( preg_replace('/\s+/', '-', $_GET['terms'] ) ) ) );

	$st_query = get_transient( $st_['transient_key'] );

	if ( $st_query == false ) {

		$temp = !empty( $st_query ) ? $st_query : '';
		$st_query = null;

		$st_query = new WP_Query( $st_['args'] );
		wp_reset_postdata();

		global
			$st_Options,
			$st_Settings;
	
			if ( $st_query->have_posts() ) {
	
				while ( $st_query->have_posts() ) : $st_query->the_post();
		
					echo $post->ID . ' - ';
		
				endwhile;

				//set_transient( $st_['transient_key'], $st_['out'], 60 * 60 );
	
			}
			
			else {
	
				_e( "Nothing found. Set a valid CSS class. Also make sure you're trying to set a mega menu on allowed menu item.", 'birdhouse' );
	
			}
	
		$st_query = null;
		$st_query = $temp;

	}

?>