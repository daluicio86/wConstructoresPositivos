<?php
/**
 * The template to display the copyright info in the footer
 *
 * @package URBANISM
 * @since URBANISM 1.0.10
 */

// Copyright area
?> 
<div class="footer_copyright_wrap
<?php
$urbanism_copyright_scheme = urbanism_get_theme_option( 'copyright_scheme' );
if ( ! empty( $urbanism_copyright_scheme ) && ! urbanism_is_inherit( $urbanism_copyright_scheme  ) ) {
	echo ' scheme_' . esc_attr( $urbanism_copyright_scheme );
}
?>
				">
	<div class="footer_copyright_inner">
		<div class="content_wrap">
			<div class="copyright_text">
			<?php
				$urbanism_copyright = urbanism_get_theme_option( 'copyright' );
			if ( ! empty( $urbanism_copyright ) ) {
				// Replace {{Y}} or {Y} with the current year
				$urbanism_copyright = str_replace( array( '{{Y}}', '{Y}' ), date( 'Y' ), $urbanism_copyright );
				// Replace {{...}} and ((...)) on the <i>...</i> and <b>...</b>
				$urbanism_copyright = urbanism_prepare_macros( $urbanism_copyright );
				// Display copyright
				echo wp_kses( nl2br( $urbanism_copyright ), 'urbanism_kses_content' );
			}
			?>
			</div>
		</div>
	</div>
</div>
