<?php
/**
 * The template to display the widgets area in the header
 *
 * @package URBANISM
 * @since URBANISM 1.0
 */

// Header sidebar
$urbanism_header_name    = urbanism_get_theme_option( 'header_widgets' );
$urbanism_header_present = ! urbanism_is_off( $urbanism_header_name ) && is_active_sidebar( $urbanism_header_name );
if ( $urbanism_header_present ) {
	urbanism_storage_set( 'current_sidebar', 'header' );
	$urbanism_header_wide = urbanism_get_theme_option( 'header_wide' );
	ob_start();
	if ( is_active_sidebar( $urbanism_header_name ) ) {
		dynamic_sidebar( $urbanism_header_name );
	}
	$urbanism_widgets_output = ob_get_contents();
	ob_end_clean();
	if ( ! empty( $urbanism_widgets_output ) ) {
		$urbanism_widgets_output = preg_replace( "/<\/aside>[\r\n\s]*<aside/", '</aside><aside', $urbanism_widgets_output );
		$urbanism_need_columns   = strpos( $urbanism_widgets_output, 'columns_wrap' ) === false;
		if ( $urbanism_need_columns ) {
			$urbanism_columns = max( 0, (int) urbanism_get_theme_option( 'header_columns' ) );
			if ( 0 == $urbanism_columns ) {
				$urbanism_columns = min( 6, max( 1, urbanism_tags_count( $urbanism_widgets_output, 'aside' ) ) );
			}
			if ( $urbanism_columns > 1 ) {
				$urbanism_widgets_output = preg_replace( '/<aside([^>]*)class="widget/', '<aside$1class="column-1_' . esc_attr( $urbanism_columns ) . ' widget', $urbanism_widgets_output );
			} else {
				$urbanism_need_columns = false;
			}
		}
		?>
		<div class="header_widgets_wrap widget_area<?php echo ! empty( $urbanism_header_wide ) ? ' header_fullwidth' : ' header_boxed'; ?>">
			<?php do_action( 'urbanism_action_before_sidebar_wrap', 'header' ); ?>
			<div class="header_widgets_inner widget_area_inner">
				<?php
				if ( ! $urbanism_header_wide ) {
					?>
					<div class="content_wrap">
					<?php
				}
				if ( $urbanism_need_columns ) {
					?>
					<div class="columns_wrap">
					<?php
				}
				do_action( 'urbanism_action_before_sidebar', 'header' );
				urbanism_show_layout( $urbanism_widgets_output );
				do_action( 'urbanism_action_after_sidebar', 'header' );
				if ( $urbanism_need_columns ) {
					?>
					</div>	<!-- /.columns_wrap -->
					<?php
				}
				if ( ! $urbanism_header_wide ) {
					?>
					</div>	<!-- /.content_wrap -->
					<?php
				}
				?>
			</div>	<!-- /.header_widgets_inner -->
			<?php do_action( 'urbanism_action_after_sidebar_wrap', 'header' ); ?>
		</div>	<!-- /.header_widgets_wrap -->
		<?php
	}
}
