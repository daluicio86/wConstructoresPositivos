<div class="front_page_section front_page_section_googlemap<?php
	$urbanism_scheme = urbanism_get_theme_option( 'front_page_googlemap_scheme' );
	if ( ! empty( $urbanism_scheme ) && ! urbanism_is_inherit( $urbanism_scheme ) ) {
		echo ' scheme_' . esc_attr( $urbanism_scheme );
	}
	echo ' front_page_section_paddings_' . esc_attr( urbanism_get_theme_option( 'front_page_googlemap_paddings' ) );
	if ( urbanism_get_theme_option( 'front_page_googlemap_stack' ) ) {
		echo ' sc_stack_section_on';
	}
?>"
		<?php
		$urbanism_css      = '';
		$urbanism_bg_image = urbanism_get_theme_option( 'front_page_googlemap_bg_image' );
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
	$urbanism_anchor_icon = urbanism_get_theme_option( 'front_page_googlemap_anchor_icon' );
	$urbanism_anchor_text = urbanism_get_theme_option( 'front_page_googlemap_anchor_text' );
if ( ( ! empty( $urbanism_anchor_icon ) || ! empty( $urbanism_anchor_text ) ) && shortcode_exists( 'trx_sc_anchor' ) ) {
	echo do_shortcode(
		'[trx_sc_anchor id="front_page_section_googlemap"'
									. ( ! empty( $urbanism_anchor_icon ) ? ' icon="' . esc_attr( $urbanism_anchor_icon ) . '"' : '' )
									. ( ! empty( $urbanism_anchor_text ) ? ' title="' . esc_attr( $urbanism_anchor_text ) . '"' : '' )
									. ']'
	);
}
?>
	<div class="front_page_section_inner front_page_section_googlemap_inner
		<?php
		$urbanism_layout = urbanism_get_theme_option( 'front_page_googlemap_layout' );
		echo ' front_page_section_layout_' . esc_attr( $urbanism_layout );
		if ( urbanism_get_theme_option( 'front_page_googlemap_fullheight' ) ) {
			echo ' urbanism-full-height sc_layouts_flex sc_layouts_columns_middle';
		}
		?>
		"
			<?php
			$urbanism_css      = '';
			$urbanism_bg_mask  = urbanism_get_theme_option( 'front_page_googlemap_bg_mask' );
			$urbanism_bg_color_type = urbanism_get_theme_option( 'front_page_googlemap_bg_color_type' );
			if ( 'custom' == $urbanism_bg_color_type ) {
				$urbanism_bg_color = urbanism_get_theme_option( 'front_page_googlemap_bg_color' );
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
		<div class="front_page_section_content_wrap front_page_section_googlemap_content_wrap
		<?php
		if ( 'fullwidth' != $urbanism_layout ) {
			echo ' content_wrap';
		}
		?>
		">
			<?php
			// Content wrap with title and description
			$urbanism_caption     = urbanism_get_theme_option( 'front_page_googlemap_caption' );
			$urbanism_description = urbanism_get_theme_option( 'front_page_googlemap_description' );
			if ( ! empty( $urbanism_caption ) || ! empty( $urbanism_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				if ( 'fullwidth' == $urbanism_layout ) {
					?>
					<div class="content_wrap">
					<?php
				}
					// Caption
				if ( ! empty( $urbanism_caption ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
					?>
					<h2 class="front_page_section_caption front_page_section_googlemap_caption front_page_block_<?php echo ! empty( $urbanism_caption ) ? 'filled' : 'empty'; ?>">
					<?php
					echo wp_kses( $urbanism_caption, 'urbanism_kses_content' );
					?>
					</h2>
					<?php
				}

					// Description (text)
				if ( ! empty( $urbanism_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
					?>
					<div class="front_page_section_description front_page_section_googlemap_description front_page_block_<?php echo ! empty( $urbanism_description ) ? 'filled' : 'empty'; ?>">
					<?php
					echo wp_kses( wpautop( $urbanism_description ), 'urbanism_kses_content' );
					?>
					</div>
					<?php
				}
				if ( 'fullwidth' == $urbanism_layout ) {
					?>
					</div>
					<?php
				}
			}

			// Content (text)
			$urbanism_content = urbanism_get_theme_option( 'front_page_googlemap_content' );
			if ( ! empty( $urbanism_content ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				if ( 'columns' == $urbanism_layout ) {
					?>
					<div class="front_page_section_columns front_page_section_googlemap_columns columns_wrap">
						<div class="column-1_3">
					<?php
				} elseif ( 'fullwidth' == $urbanism_layout ) {
					?>
					<div class="content_wrap">
					<?php
				}

				?>
				<div class="front_page_section_content front_page_section_googlemap_content front_page_block_<?php echo ! empty( $urbanism_content ) ? 'filled' : 'empty'; ?>">
				<?php
					echo wp_kses( $urbanism_content, 'urbanism_kses_content' );
				?>
				</div>
				<?php

				if ( 'columns' == $urbanism_layout ) {
					?>
					</div><div class="column-2_3">
					<?php
				} elseif ( 'fullwidth' == $urbanism_layout ) {
					?>
					</div>
					<?php
				}
			}

			// Widgets output
			?>
			<div class="front_page_section_output front_page_section_googlemap_output">
				<?php
				if ( is_active_sidebar( 'front_page_googlemap_widgets' ) ) {
					dynamic_sidebar( 'front_page_googlemap_widgets' );
				} elseif ( current_user_can( 'edit_theme_options' ) ) {
					if ( ! urbanism_exists_trx_addons() ) {
						urbanism_customizer_need_trx_addons_message();
					} else {
						urbanism_customizer_need_widgets_message( 'front_page_googlemap_caption', 'ThemeREX Addons - Google map' );
					}
				}
				?>
			</div>
			<?php

			if ( 'columns' == $urbanism_layout && ( ! empty( $urbanism_content ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) ) {
				?>
				</div></div>
				<?php
			}
			?>
		</div>
	</div>
</div>
