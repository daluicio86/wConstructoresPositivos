<?php
/**
 * The template to display single post
 *
 * @package URBANISM
 * @since URBANISM 1.0
 */

// Full post loading
$full_post_loading          = urbanism_get_value_gp( 'action' ) == 'full_post_loading';

// Prev post loading
$prev_post_loading          = urbanism_get_value_gp( 'action' ) == 'prev_post_loading';
$prev_post_loading_type     = urbanism_get_theme_option( 'posts_navigation_scroll_which_block' );

// Position of the related posts
$urbanism_related_position   = urbanism_get_theme_option( 'related_position' );

// Type of the prev/next post navigation
$urbanism_posts_navigation   = urbanism_get_theme_option( 'posts_navigation' );
$urbanism_prev_post          = false;
$urbanism_prev_post_same_cat = urbanism_get_theme_option( 'posts_navigation_scroll_same_cat' );

// Rewrite style of the single post if current post loading via AJAX and featured image and title is not in the content
if ( ( $full_post_loading 
		|| 
		( $prev_post_loading && 'article' == $prev_post_loading_type )
	) 
	&& 
	! in_array( urbanism_get_theme_option( 'single_style' ), array( 'style-6' ) )
) {
	urbanism_storage_set_array( 'options_meta', 'single_style', 'style-6' );
}

do_action( 'urbanism_action_prev_post_loading', $prev_post_loading, $prev_post_loading_type );

get_header();

while ( have_posts() ) {

	the_post();

	// Type of the prev/next post navigation
	if ( 'scroll' == $urbanism_posts_navigation ) {
		$urbanism_prev_post = get_previous_post( $urbanism_prev_post_same_cat );  // Get post from same category
		if ( ! $urbanism_prev_post && $urbanism_prev_post_same_cat ) {
			$urbanism_prev_post = get_previous_post( false );                    // Get post from any category
		}
		if ( ! $urbanism_prev_post ) {
			$urbanism_posts_navigation = 'links';
		}
	}

	// Override some theme options to display featured image, title and post meta in the dynamic loaded posts
	if ( $full_post_loading || ( $prev_post_loading && $urbanism_prev_post ) ) {
		urbanism_sc_layouts_showed( 'featured', false );
		urbanism_sc_layouts_showed( 'title', false );
		urbanism_sc_layouts_showed( 'postmeta', false );
	}

	// If related posts should be inside the content
	if ( strpos( $urbanism_related_position, 'inside' ) === 0 ) {
		ob_start();
	}

	// Display post's content
	get_template_part( apply_filters( 'urbanism_filter_get_template_part', 'templates/content', 'single-' . urbanism_get_theme_option( 'single_style' ) ), 'single-' . urbanism_get_theme_option( 'single_style' ) );

	// If related posts should be inside the content
	if ( strpos( $urbanism_related_position, 'inside' ) === 0 ) {
		$urbanism_content = ob_get_contents();
		ob_end_clean();

		ob_start();
		do_action( 'urbanism_action_related_posts' );
		$urbanism_related_content = ob_get_contents();
		ob_end_clean();

		if ( ! empty( $urbanism_related_content ) ) {
			$urbanism_related_position_inside = max( 0, min( 9, urbanism_get_theme_option( 'related_position_inside' ) ) );
			if ( 0 == $urbanism_related_position_inside ) {
				$urbanism_related_position_inside = mt_rand( 1, 9 );
			}

			$urbanism_p_number         = 0;
			$urbanism_related_inserted = false;
			$urbanism_in_block         = false;
			$urbanism_content_start    = strpos( $urbanism_content, '<div class="post_content' );
			$urbanism_content_end      = strrpos( $urbanism_content, '</div>' );

			for ( $i = max( 0, $urbanism_content_start ); $i < min( strlen( $urbanism_content ) - 3, $urbanism_content_end ); $i++ ) {
				if ( $urbanism_content[ $i ] != '<' ) {
					continue;
				}
				if ( $urbanism_in_block ) {
					if ( strtolower( substr( $urbanism_content, $i + 1, 12 ) ) == '/blockquote>' ) {
						$urbanism_in_block = false;
						$i += 12;
					}
					continue;
				} else if ( strtolower( substr( $urbanism_content, $i + 1, 10 ) ) == 'blockquote' && in_array( $urbanism_content[ $i + 11 ], array( '>', ' ' ) ) ) {
					$urbanism_in_block = true;
					$i += 11;
					continue;
				} else if ( 'p' == $urbanism_content[ $i + 1 ] && in_array( $urbanism_content[ $i + 2 ], array( '>', ' ' ) ) ) {
					$urbanism_p_number++;
					if ( $urbanism_related_position_inside == $urbanism_p_number ) {
						$urbanism_related_inserted = true;
						$urbanism_content = ( $i > 0 ? substr( $urbanism_content, 0, $i ) : '' )
											. $urbanism_related_content
											. substr( $urbanism_content, $i );
					}
				}
			}
			if ( ! $urbanism_related_inserted ) {
				if ( $urbanism_content_end > 0 ) {
					$urbanism_content = substr( $urbanism_content, 0, $urbanism_content_end ) . $urbanism_related_content . substr( $urbanism_content, $urbanism_content_end );
				} else {
					$urbanism_content .= $urbanism_related_content;
				}
			}
		}

		urbanism_show_layout( $urbanism_content );
	}

	// Comments
	do_action( 'urbanism_action_before_comments' );
	comments_template();
	do_action( 'urbanism_action_after_comments' );

	// Related posts
	if ( 'below_content' == $urbanism_related_position
		&& ( 'scroll' != $urbanism_posts_navigation || urbanism_get_theme_option( 'posts_navigation_scroll_hide_related' ) == 0 )
		&& ( ! $full_post_loading || urbanism_get_theme_option( 'open_full_post_hide_related' ) == 0 )
	) {
		do_action( 'urbanism_action_related_posts' );
	}

	// Post navigation: type 'scroll'
	if ( 'scroll' == $urbanism_posts_navigation && ! $full_post_loading ) {
		?>
		<div class="nav-links-single-scroll"
			data-post-id="<?php echo esc_attr( get_the_ID( $urbanism_prev_post ) ); ?>"
			data-post-link="<?php echo esc_attr( get_permalink( $urbanism_prev_post ) ); ?>"
			data-post-title="<?php the_title_attribute( array( 'post' => $urbanism_prev_post ) ); ?>"
			<?php do_action( 'urbanism_action_nav_links_single_scroll_data', $urbanism_prev_post ); ?>
		></div>
		<?php
	}
}

get_footer();
