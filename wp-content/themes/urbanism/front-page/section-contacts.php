<div class="front_page_section front_page_section_contacts<?php
	$urbanism_scheme = urbanism_get_theme_option( 'front_page_contacts_scheme' );
	if ( ! empty( $urbanism_scheme ) && ! urbanism_is_inherit( $urbanism_scheme ) ) {
		echo ' scheme_' . esc_attr( $urbanism_scheme );
	}
	echo ' front_page_section_paddings_' . esc_attr( urbanism_get_theme_option( 'front_page_contacts_paddings' ) );
	if ( urbanism_get_theme_option( 'front_page_contacts_stack' ) ) {
		echo ' sc_stack_section_on';
	}
?>"
		<?php
		$urbanism_css      = '';
		$urbanism_bg_image = urbanism_get_theme_option( 'front_page_contacts_bg_image' );
		if ( ! empty( $urbanism_bg_image ) ) {
			$urbanism_css .= 'background-image: url(' . esc_url( urbanism_get_attachment_url( $urbanism_bg_image ) ) . ');';
		}
		if ( ! empty( $urbanism_css ) ) {
			echo ' style="' . esc_attr( $urbanism_css ) . '"';
		}
		?>
>
<?php
	// Add anchor
	$urbanism_anchor_icon = urbanism_get_theme_option( 'front_page_contacts_anchor_icon' );
	$urbanism_anchor_text = urbanism_get_theme_option( 'front_page_contacts_anchor_text' );
if ( ( ! empty( $urbanism_anchor_icon ) || ! empty( $urbanism_anchor_text ) ) && shortcode_exists( 'trx_sc_anchor' ) ) {
	echo do_shortcode(
		'[trx_sc_anchor id="front_page_section_contacts"'
									. ( ! empty( $urbanism_anchor_icon ) ? ' icon="' . esc_attr( $urbanism_anchor_icon ) . '"' : '' )
									. ( ! empty( $urbanism_anchor_text ) ? ' title="' . esc_attr( $urbanism_anchor_text ) . '"' : '' )
									. ']'
	);
}
?>
	<div class="front_page_section_inner front_page_section_contacts_inner
	<?php
	if ( urbanism_get_theme_option( 'front_page_contacts_fullheight' ) ) {
		echo ' urbanism-full-height sc_layouts_flex sc_layouts_columns_middle';
	}
	?>
			"
			<?php
			$urbanism_css      = '';
			$urbanism_bg_mask  = urbanism_get_theme_option( 'front_page_contacts_bg_mask' );
			$urbanism_bg_color_type = urbanism_get_theme_option( 'front_page_contacts_bg_color_type' );
			if ( 'custom' == $urbanism_bg_color_type ) {
				$urbanism_bg_color = urbanism_get_theme_option( 'front_page_contacts_bg_color' );
			} elseif ( 'scheme_bg_color' == $urbanism_bg_color_type ) {
				$urbanism_bg_color = urbanism_get_scheme_color( 'bg_color', $urbanism_scheme );
			} else {
				$urbanism_bg_color = '';
			}
			if ( ! empty( $urbanism_bg_color ) && $urbanism_bg_mask > 0 ) {
				$urbanism_css .= 'background-color: ' . esc_attr(
					1 == $urbanism_bg_mask ? $urbanism_bg_color : urbanism_hex2rgba( $urbanism_bg_color, $urbanism_bg_mask )
				) . ';';
			}
			if ( ! empty( $urbanism_css ) ) {
				echo ' style="' . esc_attr( $urbanism_css ) . '"';
			}
			?>
	>
		<div class="front_page_section_content_wrap front_page_section_contacts_content_wrap content_wrap">
			<?php

			// Title and description
			$urbanism_caption     = urbanism_get_theme_option( 'front_page_contacts_caption' );
			$urbanism_description = urbanism_get_theme_option( 'front_page_contacts_description' );
			if ( ! empty( $urbanism_caption ) || ! empty( $urbanism_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				// Caption
				if ( ! empty( $urbanism_caption ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
					?>
					<h2 class="front_page_section_caption front_page_section_contacts_caption front_page_block_<?php echo ! empty( $urbanism_caption ) ? 'filled' : 'empty'; ?>">
					<?php
						echo wp_kses( $urbanism_caption, 'urbanism_kses_content' );
					?>
					</h2>
					<?php
				}

				// Description
				if ( ! empty( $urbanism_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
					?>
					<div class="front_page_section_description front_page_section_contacts_description front_page_block_<?php echo ! empty( $urbanism_description ) ? 'filled' : 'empty'; ?>">
					<?php
						echo wp_kses( wpautop( $urbanism_description ), 'urbanism_kses_content' );
					?>
					</div>
					<?php
				}
			}

			// Content (text)
			$urbanism_content = urbanism_get_theme_option( 'front_page_contacts_content' );
			$urbanism_layout  = urbanism_get_theme_option( 'front_page_contacts_layout' );
			if ( 'columns' == $urbanism_layout && ( ! empty( $urbanism_content ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) ) {
				?>
				<div class="front_page_section_columns front_page_section_contacts_columns columns_wrap">
					<div class="column-1_3">
				<?php
			}

			if ( ( ! empty( $urbanism_content ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) ) {
				?>
				<div class="front_page_section_content front_page_section_contacts_content front_page_block_<?php echo ! empty( $urbanism_content ) ? 'filled' : 'empty'; ?>">
					<?php
					echo wp_kses( $urbanism_content, 'urbanism_kses_content' );
					?>
				</div>
				<?php
			}

			if ( 'columns' == $urbanism_layout && ( ! empty( $urbanism_content ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) ) {
				?>
				</div><div class="column-2_3">
				<?php
			}

			// Shortcode output
			$urbanism_sc = urbanism_get_theme_option( 'front_page_contacts_shortcode' );
			if ( ! empty( $urbanism_sc ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				?>
				<div class="front_page_section_output front_page_section_contacts_output front_page_block_<?php echo ! empty( $urbanism_sc ) ? 'filled' : 'empty'; ?>">
					<?php
					urbanism_show_layout( do_shortcode( $urbanism_sc ) );
					?>
				</div>
				<?php
			}

			if ( 'columns' == $urbanism_layout && ( ! empty( $urbanism_content ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) ) {
				?>
				</div></div>
				<?php
			}
			?>

		</div>
	</div>
</div>
