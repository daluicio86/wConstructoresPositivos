<?php
/**
 * The template to display custom header from the ThemeREX Addons Layouts
 *
 * @package URBANISM
 * @since URBANISM 1.0.06
 */

$urbanism_header_css   = '';
$urbanism_header_image = get_header_image();
$urbanism_header_video = urbanism_get_header_video();
if ( ! empty( $urbanism_header_image ) && urbanism_trx_addons_featured_image_override( is_singular() || urbanism_storage_isset( 'blog_archive' ) || is_category() ) ) {
	$urbanism_header_image = urbanism_get_current_mode_image( $urbanism_header_image );
}

$urbanism_header_id = urbanism_get_custom_header_id();
$urbanism_header_meta = get_post_meta( $urbanism_header_id, 'trx_addons_options', true );
if ( ! empty( $urbanism_header_meta['margin'] ) ) {
	urbanism_add_inline_css( sprintf( '.page_content_wrap{padding-top:%s}', esc_attr( urbanism_prepare_css_value( $urbanism_header_meta['margin'] ) ) ) );
}

?><header class="top_panel top_panel_custom top_panel_custom_<?php echo esc_attr( $urbanism_header_id ); ?> top_panel_custom_<?php echo esc_attr( sanitize_title( get_the_title( $urbanism_header_id ) ) ); ?>
				<?php
				echo ! empty( $urbanism_header_image ) || ! empty( $urbanism_header_video )
					? ' with_bg_image'
					: ' without_bg_image';
				if ( '' != $urbanism_header_video ) {
					echo ' with_bg_video';
				}
				if ( '' != $urbanism_header_image ) {
					echo ' ' . esc_attr( urbanism_add_inline_css_class( 'background-image: url(' . esc_url( $urbanism_header_image ) . ');' ) );
				}
				if ( is_single() && has_post_thumbnail() ) {
					echo ' with_featured_image';
				}
				if ( urbanism_is_on( urbanism_get_theme_option( 'header_fullheight' ) ) ) {
					echo ' header_fullheight urbanism-full-height';
				}
				$urbanism_header_scheme = urbanism_get_theme_option( 'header_scheme' );
				if ( ! empty( $urbanism_header_scheme ) && ! urbanism_is_inherit( $urbanism_header_scheme  ) ) {
					echo ' scheme_' . esc_attr( $urbanism_header_scheme );
				}
				?>
">
	<?php

	// Background video
	if ( ! empty( $urbanism_header_video ) ) {
		get_template_part( apply_filters( 'urbanism_filter_get_template_part', 'templates/header-video' ) );
	}

	// Custom header's layout
	do_action( 'urbanism_action_show_layout', $urbanism_header_id );

	// Header widgets area
	get_template_part( apply_filters( 'urbanism_filter_get_template_part', 'templates/header-widgets' ) );

	?>
</header>
