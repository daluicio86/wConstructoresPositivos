<?php
/**
 * The template to display the site logo in the footer
 *
 * @package URBANISM
 * @since URBANISM 1.0.10
 */

// Logo
if ( urbanism_is_on( urbanism_get_theme_option( 'logo_in_footer' ) ) ) {
	$urbanism_logo_image = urbanism_get_logo_image( 'footer' );
	$urbanism_logo_text  = get_bloginfo( 'name' );
	if ( ! empty( $urbanism_logo_image['logo'] ) || ! empty( $urbanism_logo_text ) ) {
		?>
		<div class="footer_logo_wrap">
			<div class="footer_logo_inner">
				<?php
				if ( ! empty( $urbanism_logo_image['logo'] ) ) {
					$urbanism_attr = urbanism_getimagesize( $urbanism_logo_image['logo'] );
					echo '<a href="' . esc_url( home_url( '/' ) ) . '">'
							. '<img src="' . esc_url( $urbanism_logo_image['logo'] ) . '"'
								. ( ! empty( $urbanism_logo_image['logo_retina'] ) ? ' srcset="' . esc_url( $urbanism_logo_image['logo_retina'] ) . ' 2x"' : '' )
								. ' class="logo_footer_image"'
								. ' alt="' . esc_attr__( 'Site logo', 'urbanism' ) . '"'
								. ( ! empty( $urbanism_attr[3] ) ? ' ' . wp_kses_data( $urbanism_attr[3] ) : '' )
							. '>'
						. '</a>';
				} elseif ( ! empty( $urbanism_logo_text ) ) {
					echo '<h1 class="logo_footer_text">'
							. '<a href="' . esc_url( home_url( '/' ) ) . '">'
								. esc_html( $urbanism_logo_text )
							. '</a>'
						. '</h1>';
				}
				?>
			</div>
		</div>
		<?php
	}
}
