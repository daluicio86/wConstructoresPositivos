<?php
$urbanism_woocommerce_sc = urbanism_get_theme_option( 'front_page_woocommerce_products' );
if ( ! empty( $urbanism_woocommerce_sc ) ) {
	?><div class="front_page_section front_page_section_woocommerce<?php
		$urbanism_scheme = urbanism_get_theme_option( 'front_page_woocommerce_scheme' );
		if ( ! empty( $urbanism_scheme ) && ! urbanism_is_inherit( $urbanism_scheme ) ) {
			echo ' scheme_' . esc_attr( $urbanism_scheme );
		}
		echo ' front_page_section_paddings_' . esc_attr( urbanism_get_theme_option( 'front_page_woocommerce_paddings' ) );
		if ( urbanism_get_theme_option( 'front_page_woocommerce_stack' ) ) {
			echo ' sc_stack_section_on';
		}
	?>"
			<?php
			$urbanism_css      = '';
			$urbanism_bg_image = urbanism_get_theme_option( 'front_page_woocommerce_bg_image' );
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
		$urbanism_anchor_icon = urbanism_get_theme_option( 'front_page_woocommerce_anchor_icon' );
		$urbanism_anchor_text = urbanism_get_theme_option( 'front_page_woocommerce_anchor_text' );
		if ( ( ! empty( $urbanism_anchor_icon ) || ! empty( $urbanism_anchor_text ) ) && shortcode_exists( 'trx_sc_anchor' ) ) {
			echo do_shortcode(
				'[trx_sc_anchor id="front_page_section_woocommerce"'
											. ( ! empty( $urbanism_anchor_icon ) ? ' icon="' . esc_attr( $urbanism_anchor_icon ) . '"' : '' )
											. ( ! empty( $urbanism_anchor_text ) ? ' title="' . esc_attr( $urbanism_anchor_text ) . '"' : '' )
											. ']'
			);
		}
	?>
		<div class="front_page_section_inner front_page_section_woocommerce_inner
			<?php
			if ( urbanism_get_theme_option( 'front_page_woocommerce_fullheight' ) ) {
				echo ' urbanism-full-height sc_layouts_flex sc_layouts_columns_middle';
			}
			?>
				"
				<?php
				$urbanism_css      = '';
				$urbanism_bg_mask  = urbanism_get_theme_option( 'front_page_woocommerce_bg_mask' );
				$urbanism_bg_color_type = urbanism_get_theme_option( 'front_page_woocommerce_bg_color_type' );
				if ( 'custom' == $urbanism_bg_color_type ) {
					$urbanism_bg_color = urbanism_get_theme_option( 'front_page_woocommerce_bg_color' );
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
			<div class="front_page_section_content_wrap front_page_section_woocommerce_content_wrap content_wrap woocommerce">
				<?php
				// Content wrap with title and description
				$urbanism_caption     = urbanism_get_theme_option( 'front_page_woocommerce_caption' );
				$urbanism_description = urbanism_get_theme_option( 'front_page_woocommerce_description' );
				if ( ! empty( $urbanism_caption ) || ! empty( $urbanism_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
					// Caption
					if ( ! empty( $urbanism_caption ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
						?>
						<h2 class="front_page_section_caption front_page_section_woocommerce_caption front_page_block_<?php echo ! empty( $urbanism_caption ) ? 'filled' : 'empty'; ?>">
						<?php
							echo wp_kses( $urbanism_caption, 'urbanism_kses_content' );
						?>
						</h2>
						<?php
					}

					// Description (text)
					if ( ! empty( $urbanism_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
						?>
						<div class="front_page_section_description front_page_section_woocommerce_description front_page_block_<?php echo ! empty( $urbanism_description ) ? 'filled' : 'empty'; ?>">
						<?php
							echo wp_kses( wpautop( $urbanism_description ), 'urbanism_kses_content' );
						?>
						</div>
						<?php
					}
				}

				// Content (widgets)
				?>
				<div class="front_page_section_output front_page_section_woocommerce_output list_products shop_mode_thumbs">
					<?php
					if ( 'products' == $urbanism_woocommerce_sc ) {
						$urbanism_woocommerce_sc_ids      = urbanism_get_theme_option( 'front_page_woocommerce_products_per_page' );
						$urbanism_woocommerce_sc_per_page = count( explode( ',', $urbanism_woocommerce_sc_ids ) );
					} else {
						$urbanism_woocommerce_sc_per_page = max( 1, (int) urbanism_get_theme_option( 'front_page_woocommerce_products_per_page' ) );
					}
					$urbanism_woocommerce_sc_columns = max( 1, min( $urbanism_woocommerce_sc_per_page, (int) urbanism_get_theme_option( 'front_page_woocommerce_products_columns' ) ) );
					echo do_shortcode(
						"[{$urbanism_woocommerce_sc}"
										. ( 'products' == $urbanism_woocommerce_sc
												? ' ids="' . esc_attr( $urbanism_woocommerce_sc_ids ) . '"'
												: '' )
										. ( 'product_category' == $urbanism_woocommerce_sc
												? ' category="' . esc_attr( urbanism_get_theme_option( 'front_page_woocommerce_products_categories' ) ) . '"'
												: '' )
										. ( 'best_selling_products' != $urbanism_woocommerce_sc
												? ' orderby="' . esc_attr( urbanism_get_theme_option( 'front_page_woocommerce_products_orderby' ) ) . '"'
													. ' order="' . esc_attr( urbanism_get_theme_option( 'front_page_woocommerce_products_order' ) ) . '"'
												: '' )
										. ' per_page="' . esc_attr( $urbanism_woocommerce_sc_per_page ) . '"'
										. ' columns="' . esc_attr( $urbanism_woocommerce_sc_columns ) . '"'
						. ']'
					);
					?>
				</div>
			</div>
		</div>
	</div>
	<?php
}
