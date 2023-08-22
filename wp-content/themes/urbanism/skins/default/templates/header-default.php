<?php
/**
 * The template to display default site header
 *
 * @package URBANISM
 * @since URBANISM 1.0
 */

$urbanism_header_css   = '';
$urbanism_header_image = get_header_image();
$urbanism_header_video = urbanism_get_header_video();
if ( ! empty( $urbanism_header_image ) && urbanism_trx_addons_featured_image_override( is_singular() || urbanism_storage_isset( 'blog_archive' ) || is_category() ) ) {
	$urbanism_header_image = urbanism_get_current_mode_image( $urbanism_header_image );
}

?><header class="top_panel top_panel_default
	<?php
	echo ! empty( $urbanism_header_image ) || ! empty( $urbanism_header_video ) ? ' with_bg_image' : ' without_bg_image';
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

	// Main menu
	get_template_part( apply_filters( 'urbanism_filter_get_template_part', 'templates/header-navi' ) );

	// Mobile header
	if ( urbanism_is_on( urbanism_get_theme_option( 'header_mobile_enabled' ) ) ) {
		get_template_part( apply_filters( 'urbanism_filter_get_template_part', 'templates/header-mobile' ) );
	}

	// Page title and breadcrumbs area
	if ( ! is_single() ) {
		get_template_part( apply_filters( 'urbanism_filter_get_template_part', 'templates/header-title' ) );
	}

	// Header widgets area
	get_template_part( apply_filters( 'urbanism_filter_get_template_part', 'templates/header-widgets' ) );
	?>
</header>
