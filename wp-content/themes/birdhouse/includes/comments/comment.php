<?php if ( !defined( 'ABSPATH' ) ) exit;

	if ( !function_exists( 'st_comment' ) ) {
	
		function st_comment( $comment, $args, $depth ) {
	
			$GLOBALS['comment'] = $comment;
	
			switch ( $comment->comment_type ) :

				case 'comment' :
		
					global
						$birdhouse_Settings ?>

						<li id="comment-<?php comment_ID(); ?>" class="comment">
	
							<?php

								$avatar_size = '0' != $comment->comment_parent ? 50 : 75;
								$comment_author = get_the_author_meta( 'user_email' ) == $comment->comment_author_email ? ' bypostauthor' : '';
								$comment_level = '0' == $comment->comment_parent ? ' class="comment-holder comment-top-level' . $comment_author . '"' : ' class="comment-holder comment-low-level' . $comment_author . '"';
	
	
								$out = '<div' . $comment_level . '>';
	
	
									// Gravatar
									$out .= '<div class="avatar-box">' . get_avatar( $comment, $avatar_size ) . '</div>';
	
					
									$out .= '<div class="comment-box">';
	

										// Author name
										$out .= '<div class="comment-author" id="author-' . get_comment_ID() . '">' . get_comment_author_link();
	
											// Date
											$out .= ' <span class="comment-date">';
		
												if ( !empty( $birdhouse_Settings['nice_time'] ) && $birdhouse_Settings['nice_time'] == 'yes' && function_exists( 'st_niceTime' ) ) {
													$out .= st_niceTime( get_comment_date( ( get_option( 'gmt_offset' ) < 0 ? 'Y-m-d G:i:s ' . get_option( 'gmt_offset' ) : 'c' ), get_comment_ID() ) );
												}
												else {
													$out .= get_comment_date() . ' ' . esc_html__( 'at', 'birdhouse' ) . ' ' . get_comment_time();
												}
		
											$out .= '</span>';

										$out .= '</div>';

	
										// Comment
										$out .= wpautop( wptexturize( convert_smilies( get_comment_text() ) ) );
	
	
										if ( comments_open() ) {
			
											// Reply/Cancel links
											$out .=
												'<span class="reply non-selectable">' .
			
													'<a rel="nofollow" title="' . get_comment_ID() . '" class="quick-reply" href="' . esc_url( get_permalink() ) . '?replytocom=' . get_comment_ID() . '#respond">' . esc_html__( 'Reply', 'birdhouse' ) . '</a>' .

													'<a rel="nofollow" class="quick-reply-cancel none" href="#">' . esc_html__( 'Cancel', 'birdhouse' ) . '</a>' .
			
												'</span>';
			
										}
			
			
										// Edit link
										if ( current_user_can('manage_options') ) {
											$out .= '<a class="reply non-selectable" rel="nofollow" href="' . esc_url( get_edit_comment_link() ) . '">' . esc_html__( 'Edit', 'birdhouse' ) . '</a>'; }
			
			
										// Pre-moderation
										if ( $comment->comment_approved == '0' ) {
											$out .= '<p><em class="comment-awaiting-moderation">' . esc_html__( 'Your comment is awaiting moderation.', 'birdhouse' ) . '</em></p>'; }
	
	
									$out .= '<div class="quick-holder" id="quick-holder-' . get_comment_ID() . '"></div></div><div class="clear"><!-- --></div>'; // .comment-box
	
	
								$out .= '</div>'; // .$comment_level
	
	
								$out .= '<div class="clear"><!-- --></div>';
	
	
								echo $out;


				break;
		
			endswitch;
		
		}
	
	}

?>