<?php
/**
 * The template to display the widgets area in the footer
 *
 * @package URBANISM
 * @since URBANISM 1.0.10
 */

// Footer sidebar
$urbanism_footer_name    = urbanism_get_theme_option( 'footer_widgets' );
$urbanism_footer_present = ! urbanism_is_off( $urbanism_footer_name ) && is_active_sidebar( $urbanism_footer_name );
if ( $urbanism_footer_present ) {
	urbanism_storage_set( 'current_sidebar', 'footer' );
	$urbanism_footer_wide = urbanism_get_theme_option( 'footer_wide' );
	ob_start();
	if ( is_active_sidebar( $urbanism_footer_name ) ) {
		dynamic_sidebar( $urbanism_footer_name );
	}
	$urbanism_out = trim( ob_get_contents() );
	ob_end_clean();
	if ( ! empty( $urbanism_out ) ) {
		$urbanism_out          = preg_replace( "/<\\/aside>[\r\n\s]*<aside/", '</aside><aside', $urbanism_out );
		$urbanism_need_columns = true;   //or check: strpos($urbanism_out, 'columns_wrap')===false;
		if ( $urbanism_need_columns ) {
			$urbanism_columns = max( 0, (int) urbanism_get_theme_option( 'footer_columns' ) );			
			if ( 0 == $urbanism_columns ) {
				$urbanism_columns = min( 4, max( 1, urbanism_tags_count( $urbanism_out, 'aside' ) ) );
			}
			if ( $urbanism_columns > 1 ) {
				$urbanism_out = preg_replace( '/<aside([^>]*)class="widget/', '<aside$1class="column-1_' . esc_attr( $urbanism_columns ) . ' widget', $urbanism_out );
			} else {
				$urbanism_need_columns = false;
			}
		}
		?>
		<div class="footer_widgets_wrap widget_area<?php echo ! empty( $urbanism_footer_wide ) ? ' footer_fullwidth' : ''; ?> sc_layouts_row sc_layouts_row_type_normal">
			<?php do_action( 'urbanism_action_before_sidebar_wrap', 'footer' ); ?>
			<div class="footer_widgets_inner widget_area_inner">
				<?php
				if ( ! $urbanism_footer_wide ) {
					?>
					<div class="content_wrap">
					<?php
				}
				if ( $urbanism_need_columns ) {
					?>
					<div class="columns_wrap">
					<?php
				}
				do_action( 'urbanism_action_before_sidebar', 'footer' );
				urbanism_show_layout( $urbanism_out );
				do_action( 'urbanism_action_after_sidebar', 'footer' );
				if ( $urbanism_need_columns ) {
					?>
					</div><!-- /.columns_wrap -->
					<?php
				}
				if ( ! $urbanism_footer_wide ) {
					?>
					</div><!-- /.content_wrap -->
					<?php
				}
				?>
			</div><!-- /.footer_widgets_inner -->
			<?php do_action( 'urbanism_action_after_sidebar_wrap', 'footer' ); ?>
		</div><!-- /.footer_widgets_wrap -->
		<?php
	}
}
