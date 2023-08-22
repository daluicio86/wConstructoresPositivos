<?php
/**
 * The custom template to display the content
 *
 * Used for index/archive/search.
 *
 * @package URBANISM
 * @since URBANISM 1.0.50
 */

$urbanism_template_args = get_query_var( 'urbanism_template_args' );
if ( is_array( $urbanism_template_args ) ) {
	$urbanism_columns    = empty( $urbanism_template_args['columns'] ) ? 2 : max( 1, $urbanism_template_args['columns'] );
	$urbanism_blog_style = array( $urbanism_template_args['type'], $urbanism_columns );
} else {
	$urbanism_blog_style = explode( '_', urbanism_get_theme_option( 'blog_style' ) );
	$urbanism_columns    = empty( $urbanism_blog_style[1] ) ? 2 : max( 1, $urbanism_blog_style[1] );
}
$urbanism_blog_id       = urbanism_get_custom_blog_id( join( '_', $urbanism_blog_style ) );
$urbanism_blog_style[0] = str_replace( 'blog-custom-', '', $urbanism_blog_style[0] );
$urbanism_expanded      = ! urbanism_sidebar_present() && urbanism_get_theme_option( 'expand_content' ) == 'expand';
$urbanism_components    = ! empty( $urbanism_template_args['meta_parts'] )
							? ( is_array( $urbanism_template_args['meta_parts'] )
								? join( ',', $urbanism_template_args['meta_parts'] )
								: $urbanism_template_args['meta_parts']
								)
							: urbanism_array_get_keys_by_value( urbanism_get_theme_option( 'meta_parts' ) );
$urbanism_post_format   = get_post_format();
$urbanism_post_format   = empty( $urbanism_post_format ) ? 'standard' : str_replace( 'post-format-', '', $urbanism_post_format );

$urbanism_blog_meta     = urbanism_get_custom_layout_meta( $urbanism_blog_id );
$urbanism_custom_style  = ! empty( $urbanism_blog_meta['scripts_required'] ) ? $urbanism_blog_meta['scripts_required'] : 'none';

if ( ! empty( $urbanism_template_args['slider'] ) || $urbanism_columns > 1 || ! urbanism_is_off( $urbanism_custom_style ) ) {
	?><div class="
		<?php
		if ( ! empty( $urbanism_template_args['slider'] ) ) {
			echo 'slider-slide swiper-slide';
		} else {
			echo esc_attr( ( urbanism_is_off( $urbanism_custom_style ) ? 'column' : sprintf( '%1$s_item %1$s_item', $urbanism_custom_style ) ) . "-1_{$urbanism_columns}" );
		}
		?>
	">
	<?php
}
?>
<article id="post-<?php the_ID(); ?>" data-post-id="<?php the_ID(); ?>"
	<?php
	post_class(
			'post_item post_item_container post_format_' . esc_attr( $urbanism_post_format )
					. ' post_layout_custom post_layout_custom_' . esc_attr( $urbanism_columns )
					. ' post_layout_' . esc_attr( $urbanism_blog_style[0] )
					. ' post_layout_' . esc_attr( $urbanism_blog_style[0] ) . '_' . esc_attr( $urbanism_columns )
					. ( ! urbanism_is_off( $urbanism_custom_style )
						? ' post_layout_' . esc_attr( $urbanism_custom_style )
							. ' post_layout_' . esc_attr( $urbanism_custom_style ) . '_' . esc_attr( $urbanism_columns )
						: ''
						)
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
	// Custom layout
	do_action( 'urbanism_action_show_layout', $urbanism_blog_id, get_the_ID() );
	?>
</article><?php
if ( ! empty( $urbanism_template_args['slider'] ) || $urbanism_columns > 1 || ! urbanism_is_off( $urbanism_custom_style ) ) {
	?></div><?php
	// Need opening PHP-tag above just after </div>, because <div> is a inline-block element (used as column)!
}
