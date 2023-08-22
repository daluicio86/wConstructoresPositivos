<?php
/**
 * The Classic template to display the content
 *
 * Used for index/archive/search.
 *
 * @package URBANISM
 * @since URBANISM 1.0
 */

$urbanism_template_args = get_query_var( 'urbanism_template_args' );

if ( is_array( $urbanism_template_args ) ) {
	$urbanism_columns    = empty( $urbanism_template_args['columns'] ) ? 2 : max( 1, $urbanism_template_args['columns'] );
	$urbanism_blog_style = array( $urbanism_template_args['type'], $urbanism_columns );
    $urbanism_columns_class = urbanism_get_column_class( 1, $urbanism_columns, ! empty( $urbanism_template_args['columns_tablet']) ? $urbanism_template_args['columns_tablet'] : '', ! empty($urbanism_template_args['columns_mobile']) ? $urbanism_template_args['columns_mobile'] : '' );
} else {
	$urbanism_blog_style = explode( '_', urbanism_get_theme_option( 'blog_style' ) );
	$urbanism_columns    = empty( $urbanism_blog_style[1] ) ? 2 : max( 1, $urbanism_blog_style[1] );
    $urbanism_columns_class = urbanism_get_column_class( 1, $urbanism_columns );
}
$urbanism_expanded   = ! urbanism_sidebar_present() && urbanism_get_theme_option( 'expand_content' ) == 'expand';

$urbanism_post_format = get_post_format();
$urbanism_post_format = empty( $urbanism_post_format ) ? 'standard' : str_replace( 'post-format-', '', $urbanism_post_format );

?><div class="<?php
	if ( ! empty( $urbanism_template_args['slider'] ) ) {
		echo ' slider-slide swiper-slide';
	} else {
		echo ( urbanism_is_blog_style_use_masonry( $urbanism_blog_style[0] ) ? 'masonry_item masonry_item-1_' . esc_attr( $urbanism_columns ) : esc_attr( $urbanism_columns_class ) );
	}
?>"><article id="post-<?php the_ID(); ?>" data-post-id="<?php the_ID(); ?>"
	<?php
	post_class(
		'post_item post_item_container post_format_' . esc_attr( $urbanism_post_format )
				. ' post_layout_classic post_layout_classic_' . esc_attr( $urbanism_columns )
				. ' post_layout_' . esc_attr( $urbanism_blog_style[0] )
				. ' post_layout_' . esc_attr( $urbanism_blog_style[0] ) . '_' . esc_attr( $urbanism_columns )
	);
	urbanism_add_blog_animation( $urbanism_template_args );
	?>
>
	<?php

	// Sticky label
	if ( is_sticky() && ! is_paged() ) {
		?>
		<span class="post_label label_sticky"></span>
		<?php
	}

	// Featured image
	$urbanism_hover      = ! empty( $urbanism_template_args['hover'] ) && ! urbanism_is_inherit( $urbanism_template_args['hover'] )
							? $urbanism_template_args['hover']
							: urbanism_get_theme_option( 'image_hover' );

	$urbanism_components = ! empty( $urbanism_template_args['meta_parts'] )
							? ( is_array( $urbanism_template_args['meta_parts'] )
								? $urbanism_template_args['meta_parts']
								: explode( ',', $urbanism_template_args['meta_parts'] )
								)
							: urbanism_array_get_keys_by_value( urbanism_get_theme_option( 'meta_parts' ) );

	urbanism_show_post_featured( apply_filters( 'urbanism_filter_args_featured',
		array(
			'thumb_size' => ! empty( $urbanism_template_args['thumb_size'] )
				? $urbanism_template_args['thumb_size']
				: urbanism_get_thumb_size(
					'classic' == $urbanism_blog_style[0]
						? ( strpos( urbanism_get_theme_option( 'body_style' ), 'full' ) !== false
								? ( $urbanism_columns > 2 ? 'big' : 'huge' )
								: ( $urbanism_columns > 2
									? ( $urbanism_expanded ? 'square' : 'square' )
									: ($urbanism_columns > 1 ? 'square' : ( $urbanism_expanded ? 'huge' : 'big' ))
									)
							)
						: ( strpos( urbanism_get_theme_option( 'body_style' ), 'full' ) !== false
								? ( $urbanism_columns > 2 ? 'masonry-big' : 'full' )
								: ($urbanism_columns === 1 ? ( $urbanism_expanded ? 'huge' : 'big' ) : ( $urbanism_columns <= 2 && $urbanism_expanded ? 'masonry-big' : 'masonry' ))
							)
			),
			'hover'      => $urbanism_hover,
			'meta_parts' => $urbanism_components,
			'no_links'   => ! empty( $urbanism_template_args['no_links'] ),
        ),
        'content-classic',
        $urbanism_template_args
    ) );

	// Title and post meta
	$urbanism_show_title = get_the_title() != '';
	$urbanism_show_meta  = count( $urbanism_components ) > 0 && ! in_array( $urbanism_hover, array( 'border', 'pull', 'slide', 'fade', 'info' ) );

	if ( $urbanism_show_title ) {
		?>
		<div class="post_header entry-header">
			<?php

			// Post meta
			if ( apply_filters( 'urbanism_filter_show_blog_meta', $urbanism_show_meta, $urbanism_components, 'classic' ) ) {
				if ( count( $urbanism_components ) > 0 ) {
					do_action( 'urbanism_action_before_post_meta' );
					urbanism_show_post_meta(
						apply_filters(
							'urbanism_filter_post_meta_args', array(
							'components' => join( ',', $urbanism_components ),
							'seo'        => false,
							'echo'       => true,
						), $urbanism_blog_style[0], $urbanism_columns
						)
					);
					do_action( 'urbanism_action_after_post_meta' );
				}
			}

			// Post title
			if ( apply_filters( 'urbanism_filter_show_blog_title', true, 'classic' ) ) {
				do_action( 'urbanism_action_before_post_title' );
				if ( empty( $urbanism_template_args['no_links'] ) ) {
					the_title( sprintf( '<h4 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' );
				} else {
					the_title( '<h4 class="post_title entry-title">', '</h4>' );
				}
				do_action( 'urbanism_action_after_post_title' );
			}

			if( !in_array( $urbanism_post_format, array( 'quote', 'aside', 'link', 'status' ) ) ) {
				// More button
				if ( apply_filters( 'urbanism_filter_show_blog_readmore', ! $urbanism_show_title || ! empty( $urbanism_template_args['more_button'] ), 'classic' ) ) {
					if ( empty( $urbanism_template_args['no_links'] ) ) {
						do_action( 'urbanism_action_before_post_readmore' );
						urbanism_show_post_more_link( $urbanism_template_args, '<div class="more-wrap">', '</div>' );
						do_action( 'urbanism_action_after_post_readmore' );
					}
				}
			}
			?>
		</div><!-- .entry-header -->
		<?php
	}

	// Post content
	if( in_array( $urbanism_post_format, array( 'quote', 'aside', 'link', 'status' ) ) ) {
		ob_start();
		if (apply_filters('urbanism_filter_show_blog_excerpt', empty($urbanism_template_args['hide_excerpt']) && urbanism_get_theme_option('excerpt_length') > 0, 'classic')) {
			urbanism_show_post_content($urbanism_template_args, '<div class="post_content_inner">', '</div>');
		}
		// More button
		if(! empty( $urbanism_template_args['more_button'] )) {
			if ( empty( $urbanism_template_args['no_links'] ) ) {
				do_action( 'urbanism_action_before_post_readmore' );
				urbanism_show_post_more_link( $urbanism_template_args, '<div class="more-wrap">', '</div>' );
				do_action( 'urbanism_action_after_post_readmore' );
			}
		}
		$urbanism_content = ob_get_contents();
		ob_end_clean();
		urbanism_show_layout($urbanism_content, '<div class="post_content entry-content">', '</div><!-- .entry-content -->');
	}
	?>

</article></div><?php
// Need opening PHP-tag above, because <div> is a inline-block element (used as column)!
