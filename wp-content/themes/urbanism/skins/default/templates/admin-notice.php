<?php
/**
 * The template to display Admin notices
 *
 * @package URBANISM
 * @since URBANISM 1.0.1
 */

$urbanism_theme_slug = get_option( 'template' );
$urbanism_theme_obj  = wp_get_theme( $urbanism_theme_slug );
?>
<div class="urbanism_admin_notice urbanism_welcome_notice notice notice-info is-dismissible" data-notice="admin">
	<?php
	// Theme image
	$urbanism_theme_img = urbanism_get_file_url( 'screenshot.jpg' );
	if ( '' != $urbanism_theme_img ) {
		?>
		<div class="urbanism_notice_image"><img src="<?php echo esc_url( $urbanism_theme_img ); ?>" alt="<?php esc_attr_e( 'Theme screenshot', 'urbanism' ); ?>"></div>
		<?php
	}

	// Title
	?>
	<h3 class="urbanism_notice_title">
		<?php
		echo esc_html(
			sprintf(
				// Translators: Add theme name and version to the 'Welcome' message
				__( 'Welcome to %1$s v.%2$s', 'urbanism' ),
				$urbanism_theme_obj->get( 'Name' ) . ( URBANISM_THEME_FREE ? ' ' . __( 'Free', 'urbanism' ) : '' ),
				$urbanism_theme_obj->get( 'Version' )
			)
		);
		?>
	</h3>
	<?php

	// Description
	?>
	<div class="urbanism_notice_text">
		<p class="urbanism_notice_text_description">
			<?php
			echo str_replace( '. ', '.<br>', wp_kses_data( $urbanism_theme_obj->description ) );
			?>
		</p>
		<p class="urbanism_notice_text_info">
			<?php
			echo wp_kses_data( __( 'Attention! Plugin "ThemeREX Addons" is required! Please, install and activate it!', 'urbanism' ) );
			?>
		</p>
	</div>
	<?php

	// Buttons
	?>
	<div class="urbanism_notice_buttons">
		<?php
		// Link to the page 'About Theme'
		?>
		<a href="<?php echo esc_url( admin_url() . 'themes.php?page=urbanism_about' ); ?>" class="button button-primary"><i class="dashicons dashicons-nametag"></i> 
			<?php
			echo esc_html__( 'Install plugin "ThemeREX Addons"', 'urbanism' );
			?>
		</a>
	</div>
</div>
