<?php
/**
 * The Footer: widgets area, logo, footer menu and socials
 *
 * @package URBANISM
 * @since URBANISM 1.0
 */

							do_action( 'urbanism_action_page_content_end_text' );
							
							// Widgets area below the content
							urbanism_create_widgets_area( 'widgets_below_content' );
						
							do_action( 'urbanism_action_page_content_end' );
							?>
						</div>
						<?php
						
						do_action( 'urbanism_action_after_page_content' );

						// Show main sidebar
						get_sidebar();

						do_action( 'urbanism_action_content_wrap_end' );
						?>
					</div>
					<?php

					do_action( 'urbanism_action_after_content_wrap' );

					// Widgets area below the page and related posts below the page
					$urbanism_body_style = urbanism_get_theme_option( 'body_style' );
					$urbanism_widgets_name = urbanism_get_theme_option( 'widgets_below_page' );
					$urbanism_show_widgets = ! urbanism_is_off( $urbanism_widgets_name ) && is_active_sidebar( $urbanism_widgets_name );
					$urbanism_show_related = urbanism_is_single() && urbanism_get_theme_option( 'related_position' ) == 'below_page';
					if ( $urbanism_show_widgets || $urbanism_show_related ) {
						if ( 'fullscreen' != $urbanism_body_style ) {
							?>
							<div class="content_wrap">
							<?php
						}
						// Show related posts before footer
						if ( $urbanism_show_related ) {
							do_action( 'urbanism_action_related_posts' );
						}

						// Widgets area below page content
						if ( $urbanism_show_widgets ) {
							urbanism_create_widgets_area( 'widgets_below_page' );
						}
						if ( 'fullscreen' != $urbanism_body_style ) {
							?>
							</div>
							<?php
						}
					}
					do_action( 'urbanism_action_page_content_wrap_end' );
					?>
			</div>
			<?php
			do_action( 'urbanism_action_after_page_content_wrap' );

			// Don't display the footer elements while actions 'full_post_loading' and 'prev_post_loading'
			if ( ( ! urbanism_is_singular( 'post' ) && ! urbanism_is_singular( 'attachment' ) ) || ! in_array ( urbanism_get_value_gp( 'action' ), array( 'full_post_loading', 'prev_post_loading' ) ) ) {
				
				// Skip link anchor to fast access to the footer from keyboard
				?>
				<a id="footer_skip_link_anchor" class="urbanism_skip_link_anchor" href="#"></a>
				<?php

				do_action( 'urbanism_action_before_footer' );

				// Footer
				$urbanism_footer_type = urbanism_get_theme_option( 'footer_type' );
				if ( 'custom' == $urbanism_footer_type && ! urbanism_is_layouts_available() ) {
					$urbanism_footer_type = 'default';
				}
				get_template_part( apply_filters( 'urbanism_filter_get_template_part', "templates/footer-" . sanitize_file_name( $urbanism_footer_type ) ) );

				do_action( 'urbanism_action_after_footer' );

			}
			?>

			<?php do_action( 'urbanism_action_page_wrap_end' ); ?>

		</div>

		<?php do_action( 'urbanism_action_after_page_wrap' ); ?>

	</div>

	<?php do_action( 'urbanism_action_after_body' ); ?>

	<?php wp_footer(); ?>

</body>
</html>