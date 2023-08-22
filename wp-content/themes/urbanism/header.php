<?php
/**
 * The Header: Logo and main menu
 *
 * @package URBANISM
 * @since URBANISM 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js<?php
	// Class scheme_xxx need in the <html> as context for the <body>!
	echo ' scheme_' . esc_attr( urbanism_get_theme_option( 'color_scheme' ) );
?>">

<head>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<?php
	if ( function_exists( 'wp_body_open' ) ) {
		wp_body_open();
	} else {
		do_action( 'wp_body_open' );
	}
	do_action( 'urbanism_action_before_body' );
	?>

	<div class="<?php echo esc_attr( apply_filters( 'urbanism_filter_body_wrap_class', 'body_wrap' ) ); ?>" <?php do_action('urbanism_action_body_wrap_attributes'); ?>>

		<?php do_action( 'urbanism_action_before_page_wrap' ); ?>

		<div class="<?php echo esc_attr( apply_filters( 'urbanism_filter_page_wrap_class', 'page_wrap' ) ); ?>" <?php do_action('urbanism_action_page_wrap_attributes'); ?>>

			<?php do_action( 'urbanism_action_page_wrap_start' ); ?>

			<?php
			$urbanism_full_post_loading = ( urbanism_is_singular( 'post' ) || urbanism_is_singular( 'attachment' ) ) && urbanism_get_value_gp( 'action' ) == 'full_post_loading';
			$urbanism_prev_post_loading = ( urbanism_is_singular( 'post' ) || urbanism_is_singular( 'attachment' ) ) && urbanism_get_value_gp( 'action' ) == 'prev_post_loading';

			// Don't display the header elements while actions 'full_post_loading' and 'prev_post_loading'
			if ( ! $urbanism_full_post_loading && ! $urbanism_prev_post_loading ) {

				// Short links to fast access to the content, sidebar and footer from the keyboard
				?>
				<a class="urbanism_skip_link skip_to_content_link" href="#content_skip_link_anchor" tabindex="<?php echo esc_attr( apply_filters( 'urbanism_filter_skip_links_tabindex', 1 ) ); ?>"><?php esc_html_e( "Skip to content", 'urbanism' ); ?></a>
				<?php if ( urbanism_sidebar_present() ) { ?>
				<a class="urbanism_skip_link skip_to_sidebar_link" href="#sidebar_skip_link_anchor" tabindex="<?php echo esc_attr( apply_filters( 'urbanism_filter_skip_links_tabindex', 1 ) ); ?>"><?php esc_html_e( "Skip to sidebar", 'urbanism' ); ?></a>
				<?php } ?>
				<a class="urbanism_skip_link skip_to_footer_link" href="#footer_skip_link_anchor" tabindex="<?php echo esc_attr( apply_filters( 'urbanism_filter_skip_links_tabindex', 1 ) ); ?>"><?php esc_html_e( "Skip to footer", 'urbanism' ); ?></a>

				<?php
				do_action( 'urbanism_action_before_header' );

				// Header
				$urbanism_header_type = urbanism_get_theme_option( 'header_type' );
				if ( 'custom' == $urbanism_header_type && ! urbanism_is_layouts_available() ) {
					$urbanism_header_type = 'default';
				}
				get_template_part( apply_filters( 'urbanism_filter_get_template_part', "templates/header-" . sanitize_file_name( $urbanism_header_type ) ) );

				// Side menu
				if ( in_array( urbanism_get_theme_option( 'menu_side' ), array( 'left', 'right' ) ) ) {
					get_template_part( apply_filters( 'urbanism_filter_get_template_part', 'templates/header-navi-side' ) );
				}

				// Mobile menu
				get_template_part( apply_filters( 'urbanism_filter_get_template_part', 'templates/header-navi-mobile' ) );

				do_action( 'urbanism_action_after_header' );

			}
			?>

			<?php do_action( 'urbanism_action_before_page_content_wrap' ); ?>

			<div class="page_content_wrap<?php
				if ( urbanism_is_off( urbanism_get_theme_option( 'remove_margins' ) ) ) {
					if ( empty( $urbanism_header_type ) ) {
						$urbanism_header_type = urbanism_get_theme_option( 'header_type' );
					}
					if ( 'custom' == $urbanism_header_type && urbanism_is_layouts_available() ) {
						$urbanism_header_id = urbanism_get_custom_header_id();
						if ( $urbanism_header_id > 0 ) {
							$urbanism_header_meta = urbanism_get_custom_layout_meta( $urbanism_header_id );
							if ( ! empty( $urbanism_header_meta['margin'] ) ) {
								?> page_content_wrap_custom_header_margin<?php
							}
						}
					}
					$urbanism_footer_type = urbanism_get_theme_option( 'footer_type' );
					if ( 'custom' == $urbanism_footer_type && urbanism_is_layouts_available() ) {
						$urbanism_footer_id = urbanism_get_custom_footer_id();
						if ( $urbanism_footer_id ) {
							$urbanism_footer_meta = urbanism_get_custom_layout_meta( $urbanism_footer_id );
							if ( ! empty( $urbanism_footer_meta['margin'] ) ) {
								?> page_content_wrap_custom_footer_margin<?php
							}
						}
					}
				}
				do_action( 'urbanism_action_page_content_wrap_class', $urbanism_prev_post_loading );
				?>"<?php
				if ( apply_filters( 'urbanism_filter_is_prev_post_loading', $urbanism_prev_post_loading ) ) {
					?> data-single-style="<?php echo esc_attr( urbanism_get_theme_option( 'single_style' ) ); ?>"<?php
				}
				do_action( 'urbanism_action_page_content_wrap_data', $urbanism_prev_post_loading );
			?>>
				<?php
				do_action( 'urbanism_action_page_content_wrap', $urbanism_full_post_loading || $urbanism_prev_post_loading );

				// Single posts banner
				if ( apply_filters( 'urbanism_filter_single_post_header', urbanism_is_singular( 'post' ) || urbanism_is_singular( 'attachment' ) ) ) {
					if ( $urbanism_prev_post_loading ) {
						if ( urbanism_get_theme_option( 'posts_navigation_scroll_which_block' ) != 'article' ) {
							do_action( 'urbanism_action_between_posts' );
						}
					}
					// Single post thumbnail and title
					$urbanism_path = apply_filters( 'urbanism_filter_get_template_part', 'templates/single-styles/' . urbanism_get_theme_option( 'single_style' ) );
					if ( urbanism_get_file_dir( $urbanism_path . '.php' ) != '' ) {
						get_template_part( $urbanism_path );
					}
				}

				// Widgets area above page
				$urbanism_body_style   = urbanism_get_theme_option( 'body_style' );
				$urbanism_widgets_name = urbanism_get_theme_option( 'widgets_above_page' );
				$urbanism_show_widgets = ! urbanism_is_off( $urbanism_widgets_name ) && is_active_sidebar( $urbanism_widgets_name );
				if ( $urbanism_show_widgets ) {
					if ( 'fullscreen' != $urbanism_body_style ) {
						?>
						<div class="content_wrap">
							<?php
					}
					urbanism_create_widgets_area( 'widgets_above_page' );
					if ( 'fullscreen' != $urbanism_body_style ) {
						?>
						</div>
						<?php
					}
				}

				// Content area
				do_action( 'urbanism_action_before_content_wrap' );
				?>
				<div class="content_wrap<?php echo 'fullscreen' == $urbanism_body_style ? '_fullscreen' : ''; ?>">

					<?php do_action( 'urbanism_action_content_wrap_start' ); ?>

					<div class="content">
						<?php
						do_action( 'urbanism_action_page_content_start' );

						// Skip link anchor to fast access to the content from keyboard
						?>
						<a id="content_skip_link_anchor" class="urbanism_skip_link_anchor" href="#"></a>
						<?php
						// Single posts banner between prev/next posts
						if ( ( urbanism_is_singular( 'post' ) || urbanism_is_singular( 'attachment' ) )
							&& $urbanism_prev_post_loading 
							&& urbanism_get_theme_option( 'posts_navigation_scroll_which_block' ) == 'article'
						) {
							do_action( 'urbanism_action_between_posts' );
						}

						// Widgets area above content
						urbanism_create_widgets_area( 'widgets_above_content' );

						do_action( 'urbanism_action_page_content_start_text' );
