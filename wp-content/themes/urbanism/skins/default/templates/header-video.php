<?php
/**
 * The template to display the background video in the header
 *
 * @package URBANISM
 * @since URBANISM 1.0.14
 */
$urbanism_header_video = urbanism_get_header_video();
$urbanism_embed_video  = '';
if ( ! empty( $urbanism_header_video ) && ! urbanism_is_from_uploads( $urbanism_header_video ) ) {
	if ( urbanism_is_youtube_url( $urbanism_header_video ) && preg_match( '/[=\/]([^=\/]*)$/', $urbanism_header_video, $matches ) && ! empty( $matches[1] ) ) {
		?><div id="background_video" data-youtube-code="<?php echo esc_attr( $matches[1] ); ?>"></div>
		<?php
	} else {
		?>
		<div id="background_video"><?php urbanism_show_layout( urbanism_get_embed_video( $urbanism_header_video ) ); ?></div>
		<?php
	}
}
