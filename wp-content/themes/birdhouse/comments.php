<?php if ( !defined( 'ABSPATH' ) ) exit;

/*

	1 - COMMENTS

		1.1 - Tabs
		1.2 - Comments
		1.3 - Pagination

	2 - COMMENT FORM

		2.1 - Form

*/

	global
		$birdhouse_Settings;

		$birdhouse_ = array();



		// If comments enabled on theme panel
		if (
			!isset( $birdhouse_Settings['post_comments'] ) ||
			is_single() && !empty( $birdhouse_Settings['post_comments'] ) && $birdhouse_Settings['post_comments'] == 'yes' ||
			is_page() && !empty( $birdhouse_Settings['page_comments'] ) && $birdhouse_Settings['page_comments'] == 'yes' ) : 



			// If password protected
			if ( post_password_required() ) {

				echo '<div id="password-protected-message">';
					esc_html_e( 'This post is password protected. Enter the password to view any comments.', 'birdhouse' );
				echo '</div>';

				return;

			}



			/*===============================================
			
				C O M M E N T S
				Display comments
			
			===============================================*/

			// If comments exists
			if ( have_comments() ) : 


				$birdhouse_['tb'] = array(); // trackbacks

				foreach ( $comments as $comment ) {

					$birdhouse_['comment_type'] = get_comment_type();

					if ( $birdhouse_['comment_type'] != 'comment' ) {
						$birdhouse_['tb'][] = $comment; }

				}

				$birdhouse_['total_tb'] = sizeof( $birdhouse_['tb'] );

				$birdhouse_['comments_number'] = esc_html( get_comments_number() - $birdhouse_['total_tb'] );


				/*-------------------------------------------
					1.1 - Tabs
				-------------------------------------------*/

				echo
					'<div id="tabs-comments">' .
						'<span data-label="respond" class="tab-comments-active">' . esc_html__( 'Leave a reply', 'birdhouse' ) . '</span>' .
						'<span data-label="comments">' . esc_html__( 'Comments', 'birdhouse' ) . ' (' . $birdhouse_['comments_number'] . ')</span>' .
					'</div>';


				/*-------------------------------------------
					1.2 - Comments
				-------------------------------------------*/

				echo '<ol id="comments" class="none">';

						wp_list_comments( array('callback' => 'st_comment' ));

				echo '</ol>';


				/*-------------------------------------------
					1.2 - Pingbacks
				-------------------------------------------*/
	
				if (
					$birdhouse_['total_tb'] > 0 && !empty( $birdhouse_Settings['pingbacks'] ) && $birdhouse_Settings['pingbacks'] == 'yes' ||
					$birdhouse_['total_tb'] > 0 && !isset( $birdhouse_Settings['pingbacks'] ) ) {
	
					echo '<div class="comments-title pingback-title">' . esc_html__( 'Pingbacks', 'birdhouse' ) . ': ' . $birdhouse_['total_tb'] . '</div>';
		
					echo '<ol id="pingbacks">';
		
							wp_list_comments( array('callback' => 'st_pingback' ));
		
					echo '</ol>';
	
				}


				/*-------------------------------------------
					1.3 - Pagination
				-------------------------------------------*/

				if ( get_comment_pages_count() > 1 && get_option('page_comments') ) : ?>
					<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older comments', 'birdhouse' ) ); ?></div>
					<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer comments', 'birdhouse' ) ); ?></div><?php
				endif;


			// If no comments yet
			else :


				echo
					'<div id="tabs-comments">' .
						'<span data-label="respond" class="tab-comments-active">' . esc_html__( 'Leave a reply', 'birdhouse' ) . '</span>' .
					'</div>';


			endif;



			/*===============================================
			
				C O M M E N T   F O R M
				Forms for leaving a comments
			
			===============================================*/

			// If comments open
			if ( comments_open() ) :



				if ( get_option('comment_registration') && !is_user_logged_in() ) : 


					echo '<p>' . esc_html__( 'You must be logged in to post a comment.', 'birdhouse' ) . ' - <a href="' . esc_url( wp_login_url( get_permalink() ) ) . '">' . esc_html__( 'Log in', 'birdhouse' ) . '</a></p>';

	
				else :

	
					$birdhouse_['comments_args'] = array(
					
						'fields' => apply_filters( 'comment_form_default_fields', array(
					
							'author' => '
								<div class="input-text-box input-text-name">
									<div>
										<input
											type="text"
											name="author"
											id="author"
											value="' . esc_html( $commenter['comment_author'] ? $commenter['comment_author'] : '' ) . '"
											placeholder="' . esc_html__( 'Name', 'birdhouse' ) . '"
											/>
									</div>
								</div>',
					
							'email' => '
								<div class="input-text-box input-text-email">
									<div>
										<input
											type="email"
											name="email"
											id="email"
											value="' . esc_attr( $commenter['comment_author_email'] ? $commenter['comment_author_email'] : '' ) . '"
											placeholder="' . esc_html__( 'Email', 'birdhouse' ) . '"
											/>
									</div>
								</div>
								<div class="clear"><!-- --></div>',
					
							'url' => !empty( $birdhouse_Settings['website_on_comments'] ) && $birdhouse_Settings['website_on_comments'] == 'yes' ? '
								<div class="input-text-box">
									<div>
										<input
											type="url"
											name="url"
											id="url"
											value="' . esc_url( $commenter['comment_author_url'] ? $commenter['comment_author_url'] : '' ) . '"
											placeholder="' . esc_html__( 'Website', 'birdhouse' ) . '"
											/>
									</div>
								</div>' : '',
					
						)),
	
						'comment_notes_before' => '',
					
						'comment_field' => '
							<div class="textarea-box">
								<textarea
									name="comment"
									id="comment"
									cols="100"
									rows="3"
									placeholder="' . esc_html__( 'Type here', 'birdhouse' ) . '"></textarea>
								<div class="clear"><!-- --></div>
							</div>',
					
						'comment_notes_after' => '',
					
					);
					
					comment_form( $birdhouse_['comments_args'] );


				endif; // if ( get_option('comment_registration')



			endif; // If comments open


	
		endif; // If comments enabled on theme panel



?>