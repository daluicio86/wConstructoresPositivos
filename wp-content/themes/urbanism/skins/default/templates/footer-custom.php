<?php
/**
 * The template to display default site footer
 *
 * @package URBANISM
 * @since URBANISM 1.0.10
 */

$urbanism_footer_id = urbanism_get_custom_footer_id();
$urbanism_footer_meta = get_post_meta( $urbanism_footer_id, 'trx_addons_options', true );
if ( ! empty( $urbanism_footer_meta['margin'] ) ) {
	urbanism_add_inline_css( sprintf( '.page_content_wrap{padding-bottom:%s}', esc_attr( urbanism_prepare_css_value( $urbanism_footer_meta['margin'] ) ) ) );
}
?>
<footer class="footer_wrap footer_custom footer_custom_<?php echo esc_attr( $urbanism_footer_id ); ?> footer_custom_<?php echo esc_attr( sanitize_title( get_the_title( $urbanism_footer_id ) ) ); ?>
						<?php
						$urbanism_footer_scheme = urbanism_get_theme_option( 'footer_scheme' );
						if ( ! empty( $urbanism_footer_scheme ) && ! urbanism_is_inherit( $urbanism_footer_scheme  ) ) {
							echo ' scheme_' . esc_attr( $urbanism_footer_scheme );
						}
						?>
						">
	<?php
	// Custom footer's layout
	do_action( 'urbanism_action_show_layout', $urbanism_footer_id );
	?>
</footer><!-- /.footer_wrap -->
