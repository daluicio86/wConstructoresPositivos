<?php
/**
 * The template to display the logo or the site name and the slogan in the Header
 *
 * @package URBANISM
 * @since URBANISM 1.0
 */

$urbanism_args = get_query_var( 'urbanism_logo_args' );

// Site logo
$urbanism_logo_type   = isset( $urbanism_args['type'] ) ? $urbanism_args['type'] : '';
$urbanism_logo_image  = urbanism_get_logo_image( $urbanism_logo_type );
$urbanism_logo_text   = urbanism_is_on( urbanism_get_theme_option( 'logo_text' ) ) ? get_bloginfo( 'name' ) : '';
$urbanism_logo_slogan = get_bloginfo( 'description', 'display' );
if ( ! empty( $urbanism_logo_image['logo'] ) || ! empty( $urbanism_logo_text ) ) {
	?><a class="sc_layouts_logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
		<?php
		if ( ! empty( $urbanism_logo_image['logo'] ) ) {
			if ( empty( $urbanism_logo_type ) && function_exists( 'the_custom_logo' ) && is_numeric($urbanism_logo_image['logo']) && (int) $urbanism_logo_image['logo'] > 0 ) {
				the_custom_logo();
			} else {
				$urbanism_attr = urbanism_getimagesize( $urbanism_logo_image['logo'] );
				echo '<img src="' . esc_url( $urbanism_logo_image['logo'] ) . '"'
						. ( ! empty( $urbanism_logo_image['logo_retina'] ) ? ' srcset="' . esc_url( $urbanism_logo_image['logo_retina'] ) . ' 2x"' : '' )
						. ' alt="' . esc_attr( $urbanism_logo_text ) . '"'
						. ( ! empty( $urbanism_attr[3] ) ? ' ' . wp_kses_data( $urbanism_attr[3] ) : '' )
						. '>';
			}
		} else {
			urbanism_show_layout( urbanism_prepare_macros( $urbanism_logo_text ), '<span class="logo_text">', '</span>' );
			urbanism_show_layout( urbanism_prepare_macros( $urbanism_logo_slogan ), '<span class="logo_slogan">', '</span>' );
		}
		?>
	</a>
	<?php
}
