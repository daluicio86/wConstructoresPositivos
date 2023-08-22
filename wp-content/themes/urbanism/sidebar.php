<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package URBANISM
 * @since URBANISM 1.0
 */

if ( urbanism_sidebar_present() ) {
	
	$urbanism_sidebar_type = urbanism_get_theme_option( 'sidebar_type' );
	if ( 'custom' == $urbanism_sidebar_type && ! urbanism_is_layouts_available() ) {
		$urbanism_sidebar_type = 'default';
	}
	
	// Catch output to the buffer
	ob_start();
	if ( 'default' == $urbanism_sidebar_type ) {
		// Default sidebar with widgets
		$urbanism_sidebar_name = urbanism_get_theme_option( 'sidebar_widgets' );
		urbanism_storage_set( 'current_sidebar', 'sidebar' );
		if ( is_active_sidebar( $urbanism_sidebar_name ) ) {
			dynamic_sidebar( $urbanism_sidebar_name );
		}
	} else {
		// Custom sidebar from Layouts Builder
		$urbanism_sidebar_id = urbanism_get_custom_sidebar_id();
		do_action( 'urbanism_action_show_layout', $urbanism_sidebar_id );
	}
	$urbanism_out = trim( ob_get_contents() );
	ob_end_clean();
	
	// If any html is present - display it
	if ( ! empty( $urbanism_out ) ) {
		$urbanism_sidebar_position    = urbanism_get_theme_option( 'sidebar_position' );
		$urbanism_sidebar_position_ss = urbanism_get_theme_option( 'sidebar_position_ss' );
		?>
		<div class="sidebar widget_area
			<?php
			echo ' ' . esc_attr( $urbanism_sidebar_position );
			echo ' sidebar_' . esc_attr( $urbanism_sidebar_position_ss );
			echo ' sidebar_' . esc_attr( $urbanism_sidebar_type );

			$urbanism_sidebar_scheme = apply_filters( 'urbanism_filter_sidebar_scheme', urbanism_get_theme_option( 'sidebar_scheme' ) );
			if ( ! empty( $urbanism_sidebar_scheme ) && ! urbanism_is_inherit( $urbanism_sidebar_scheme ) && 'custom' != $urbanism_sidebar_type ) {
				echo ' scheme_' . esc_attr( $urbanism_sidebar_scheme );
			}
			?>
		" role="complementary">
			<?php

			// Skip link anchor to fast access to the sidebar from keyboard
			?>
			<a id="sidebar_skip_link_anchor" class="urbanism_skip_link_anchor" href="#"></a>
			<?php

			do_action( 'urbanism_action_before_sidebar_wrap', 'sidebar' );

			// Button to show/hide sidebar on mobile
			if ( in_array( $urbanism_sidebar_position_ss, array( 'above', 'float' ) ) ) {
				$urbanism_title = apply_filters( 'urbanism_filter_sidebar_control_title', 'float' == $urbanism_sidebar_position_ss ? esc_html__( 'Show Sidebar', 'urbanism' ) : '' );
				$urbanism_text  = apply_filters( 'urbanism_filter_sidebar_control_text', 'above' == $urbanism_sidebar_position_ss ? esc_html__( 'Show Sidebar', 'urbanism' ) : '' );
				?>
				<a href="#" class="sidebar_control" title="<?php echo esc_attr( $urbanism_title ); ?>"><?php echo esc_html( $urbanism_text ); ?></a>
				<?php
			}
			?>
			<div class="sidebar_inner">
				<?php
				do_action( 'urbanism_action_before_sidebar', 'sidebar' );
				urbanism_show_layout( preg_replace( "/<\/aside>[\r\n\s]*<aside/", '</aside><aside', $urbanism_out ) );
				do_action( 'urbanism_action_after_sidebar', 'sidebar' );
				?>
			</div>
			<?php

			do_action( 'urbanism_action_after_sidebar_wrap', 'sidebar' );

			?>
		</div>
		<div class="clearfix"></div>
		<?php
	}
}
