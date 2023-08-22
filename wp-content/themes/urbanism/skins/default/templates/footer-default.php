<?php
/**
 * The template to display default site footer
 *
 * @package URBANISM
 * @since URBANISM 1.0.10
 */

?>
<footer class="footer_wrap footer_default
<?php
$urbanism_footer_scheme = urbanism_get_theme_option( 'footer_scheme' );
if ( ! empty( $urbanism_footer_scheme ) && ! urbanism_is_inherit( $urbanism_footer_scheme  ) ) {
	echo ' scheme_' . esc_attr( $urbanism_footer_scheme );
}
?>
				">
	<?php

	// Footer widgets area
	get_template_part( apply_filters( 'urbanism_filter_get_template_part', 'templates/footer-widgets' ) );

	// Logo
	get_template_part( apply_filters( 'urbanism_filter_get_template_part', 'templates/footer-logo' ) );

	// Socials
	get_template_part( apply_filters( 'urbanism_filter_get_template_part', 'templates/footer-socials' ) );

	// Copyright area
	get_template_part( apply_filters( 'urbanism_filter_get_template_part', 'templates/footer-copyright' ) );

	?>
</footer><!-- /.footer_wrap -->
