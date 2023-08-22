<?php
/**
 * The template to display the socials in the footer
 *
 * @package URBANISM
 * @since URBANISM 1.0.10
 */


// Socials
if ( urbanism_is_on( urbanism_get_theme_option( 'socials_in_footer' ) ) ) {
	$urbanism_output = urbanism_get_socials_links();
	if ( '' != $urbanism_output ) {
		?>
		<div class="footer_socials_wrap socials_wrap">
			<div class="footer_socials_inner">
				<?php urbanism_show_layout( $urbanism_output ); ?>
			</div>
		</div>
		<?php
	}
}
