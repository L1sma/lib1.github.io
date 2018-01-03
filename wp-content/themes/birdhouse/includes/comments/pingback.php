<?php if ( !defined( 'ABSPATH' ) ) exit;

	if ( !function_exists( 'st_pingback' ) ) {
	
		function st_pingback( $comment, $args, $depth ) {
	
			$GLOBALS['comment'] = $comment;
	
			switch ( $comment->comment_type ) :

				case 'pingback' :
		
					global
						$birdhouse_Settings ?>

						<li id="comment-<?php comment_ID(); ?>" class="pingback">
	
							<?php
					

								$birdhouse_['out'] = '<div class="pingback-holder">';
	
	
									$birdhouse_['out'] .= '<div class="pingback-box">';
	
	
										// Title
										$birdhouse_['out'] .= '<div class="pingback-author" id="author-' . get_comment_ID() . '">' . get_comment_author_link();

											// Edit link
											if ( current_user_can('manage_options') ) {
												$birdhouse_['out'] .= ' - <a href="' . esc_url( get_edit_comment_link() ) . '"><small>' . esc_html__( 'Edit', 'birdhouse' ) . '</small></a>'; }

										$birdhouse_['out'] .= '</div>';

					
										// Date
										$birdhouse_['out'] .= '<div class="pingback-date">';
	
											if ( !empty( $birdhouse_Settings['nice_time'] ) && $birdhouse_Settings['nice_time'] == 'yes' && function_exists( 'st_niceTime' ) ) {
												$birdhouse_['out'] .= st_niceTime( get_comment_date( 'Y-m-d G:i:s ' . get_option( 'gmt_offset' ), get_comment_ID() ) );
											}
											else {
												$birdhouse_['out'] .= get_comment_date() . ' ' . esc_html__( 'at', 'birdhouse' ) . ' ' . get_comment_time();
											}
	
										$birdhouse_['out'] .= '</div>';
			
			
	
	
								$birdhouse_['out'] .= '</div>';
	
	
								$birdhouse_['out'] .= '<div class="clear"><!-- --></div>';
	
	
								echo $birdhouse_['out'];


				break;
		
			endswitch;
		
		}
	
	}

?>