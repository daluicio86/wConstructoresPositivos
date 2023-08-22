<?php
/**
 * The Portfolio template to display the content
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

$urbanism_post_format = get_post_format();
$urbanism_post_format = empty( $urbanism_post_format ) ? 'standard' : str_replace( 'post-format-', '', $urbanism_post_format );

?><div class="
<?php
if ( ! empty( $urbanism_template_args['slider'] ) ) {
	echo ' slider-slide swiper-slide';
} else {
	echo ( urbanism_is_blog_style_use_masonry( $urbanism_blog_style[0] ) ? 'masonry_item masonry_item-1_' . esc_attr( $urbanism_columns ) : esc_attr( $urbanism_columns_class ));
}
?>
"><article id="post-<?php the_ID(); ?>" 
	<?php
	post_class(
		'post_item post_item_container post_format_' . esc_attr( $urbanism_post_format )
		. ' post_layout_portfolio'
		. ' post_layout_portfolio_' . esc_attr( $urbanism_columns )
		. ( 'portfolio' != $urbanism_blog_style[0] ? ' ' . esc_attr( $urbanism_blog_style[0] )  . '_' . esc_attr( $urbanism_columns ) : '' )
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

	$urbanism_hover   = ! empty( $urbanism_template_args['hover'] ) && ! urbanism_is_inherit( $urbanism_template_args['hover'] )
								? $urbanism_template_args['hover']
								: urbanism_get_theme_option( 'image_hover' );

	if ( 'dots' == $urbanism_hover ) {
		$urbanism_post_link = empty( $urbanism_template_args['no_links'] )
								? ( ! empty( $urbanism_template_args['link'] )
									? $urbanism_template_args['link']
									: get_permalink()
									)
								: '';
		$urbanism_target    = ! empty( $urbanism_post_link ) && false === strpos( $urbanism_post_link, home_url() )
								? ' target="_blank" rel="nofollow"'
								: '';
	}
	
	// Meta parts
	$urbanism_components = ! empty( $urbanism_template_args['meta_parts'] )
							? ( is_array( $urbanism_template_args['meta_parts'] )
								? $urbanism_template_args['meta_parts']
								: explode( ',', $urbanism_template_args['meta_parts'] )
								)
							: urbanism_array_get_keys_by_value( urbanism_get_theme_option( 'meta_parts' ) );

	// Featured image
	urbanism_show_post_featured( apply_filters( 'urbanism_filter_args_featured',
        array(
			'hover'         => $urbanism_hover,
			'no_links'      => ! empty( $urbanism_template_args['no_links'] ),
			'thumb_size'    => ! empty( $urbanism_template_args['thumb_size'] )
								? $urbanism_template_args['thumb_size']
								: urbanism_get_thumb_size(
									urbanism_is_blog_style_use_masonry( $urbanism_blog_style[0] )
										? (	strpos( urbanism_get_theme_option( 'body_style' ), 'full' ) !== false || $urbanism_columns < 3
											? 'masonry-big'
											: 'masonry'
											)
										: (	strpos( urbanism_get_theme_option( 'body_style' ), 'full' ) !== false || $urbanism_columns < 3
											? 'square'
											: 'square'
											)
								),
			'thumb_bg' => urbanism_is_blog_style_use_masonry( $urbanism_blog_style[0] ) ? false : true,
			'show_no_image' => true,
			'meta_parts'    => $urbanism_components,
			'class'         => 'dots' == $urbanism_hover ? 'hover_with_info' : '',
			'post_info'     => 'dots' == $urbanism_hover
										? '<div class="post_info"><h5 class="post_title">'
											. ( ! empty( $urbanism_post_link )
												? '<a href="' . esc_url( $urbanism_post_link ) . '"' . ( ! empty( $target ) ? $target : '' ) . '>'
												: ''
												)
												. esc_html( get_the_title() ) 
											. ( ! empty( $urbanism_post_link )
												? '</a>'
												: ''
												)
											. '</h5></div>'
										: '',
            'thumb_ratio'   => 'info' == $urbanism_hover ?  '100:102' : '',
        ),
        'content-portfolio',
        $urbanism_template_args
    ) );
	?>
</article></div><?php
// Need opening PHP-tag above, because <article> is a inline-block element (used as column)!