<?php
/**
 * The template to display Admin notices
 *
 * @package URBANISM
 * @since URBANISM 1.0.64
 */

$urbanism_skins_url  = get_admin_url( null, 'admin.php?page=trx_addons_theme_panel#trx_addons_theme_panel_section_skins' );
$urbanism_skins_args = get_query_var( 'urbanism_skins_notice_args' );
?>
<div class="urbanism_admin_notice urbanism_skins_notice notice notice-info is-dismissible" data-notice="skins">
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
		<?php esc_html_e( 'New skins available', 'urbanism' ); ?>
	</h3>
	<?php

	// Description
	$urbanism_total      = $urbanism_skins_args['update'];	// Store value to the separate variable to avoid warnings from ThemeCheck plugin!
	$urbanism_skins_msg  = $urbanism_total > 0
							// Translators: Add new skins number
							? '<strong>' . sprintf( _n( '%d new version', '%d new versions', $urbanism_total, 'urbanism' ), $urbanism_total ) . '</strong>'
							: '';
	$urbanism_total      = $urbanism_skins_args['free'];
	$urbanism_skins_msg .= $urbanism_total > 0
							? ( ! empty( $urbanism_skins_msg ) ? ' ' . esc_html__( 'and', 'urbanism' ) . ' ' : '' )
								// Translators: Add new skins number
								. '<strong>' . sprintf( _n( '%d free skin', '%d free skins', $urbanism_total, 'urbanism' ), $urbanism_total ) . '</strong>'
							: '';
	$urbanism_total      = $urbanism_skins_args['pay'];
	$urbanism_skins_msg .= $urbanism_skins_args['pay'] > 0
							? ( ! empty( $urbanism_skins_msg ) ? ' ' . esc_html__( 'and', 'urbanism' ) . ' ' : '' )
								// Translators: Add new skins number
								. '<strong>' . sprintf( _n( '%d paid skin', '%d paid skins', $urbanism_total, 'urbanism' ), $urbanism_total ) . '</strong>'
							: '';
	?>
	<div class="urbanism_notice_text">
		<p>
			<?php
			// Translators: Add new skins info
			echo wp_kses_data( sprintf( __( "We are pleased to announce that %s are available for your theme", 'urbanism' ), $urbanism_skins_msg ) );
			?>
		</p>
	</div>
	<?php

	// Buttons
	?>
	<div class="urbanism_notice_buttons">
		<?php
		// Link to the theme dashboard page
		?>
		<a href="<?php echo esc_url( $urbanism_skins_url ); ?>" class="button button-primary"><i class="dashicons dashicons-update"></i> 
			<?php
			// Translators: Add theme name
			esc_html_e( 'Go to Skins manager', 'urbanism' );
			?>
		</a>
	</div>
</div>
