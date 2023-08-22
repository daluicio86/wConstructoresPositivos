<?php
/**
 * The template to display the page title and breadcrumbs
 *
 * @package URBANISM
 * @since URBANISM 1.0
 */

// Page (category, tag, archive, author) title

if ( urbanism_need_page_title() ) {
	urbanism_sc_layouts_showed( 'title', true );
	urbanism_sc_layouts_showed( 'postmeta', true );
	?>
	<div class="top_panel_title sc_layouts_row sc_layouts_row_type_normal">
		<div class="content_wrap">
			<div class="sc_layouts_column sc_layouts_column_align_center">
				<div class="sc_layouts_item">
					<div class="sc_layouts_title sc_align_center">
						<?php
						// Post meta on the single post
						if ( is_single() ) {
							?>
							<div class="sc_layouts_title_meta">
							<?php
								urbanism_show_post_meta(
									apply_filters(
										'urbanism_filter_post_meta_args', array(
											'components' => join( ',', urbanism_array_get_keys_by_value( urbanism_get_theme_option( 'meta_parts' ) ) ),
											'counters'   => join( ',', urbanism_array_get_keys_by_value( urbanism_get_theme_option( 'counters' ) ) ),
											'seo'        => urbanism_is_on( urbanism_get_theme_option( 'seo_snippets' ) ),
										), 'header', 1
									)
								);
							?>
							</div>
							<?php
						}

						// Blog/Post title
						?>
						<div class="sc_layouts_title_title">
							<?php
							$urbanism_blog_title           = urbanism_get_blog_title();
							$urbanism_blog_title_text      = '';
							$urbanism_blog_title_class     = '';
							$urbanism_blog_title_link      = '';
							$urbanism_blog_title_link_text = '';
							if ( is_array( $urbanism_blog_title ) ) {
								$urbanism_blog_title_text      = $urbanism_blog_title['text'];
								$urbanism_blog_title_class     = ! empty( $urbanism_blog_title['class'] ) ? ' ' . $urbanism_blog_title['class'] : '';
								$urbanism_blog_title_link      = ! empty( $urbanism_blog_title['link'] ) ? $urbanism_blog_title['link'] : '';
								$urbanism_blog_title_link_text = ! empty( $urbanism_blog_title['link_text'] ) ? $urbanism_blog_title['link_text'] : '';
							} else {
								$urbanism_blog_title_text = $urbanism_blog_title;
							}
							?>
							<h1 itemprop="headline" class="sc_layouts_title_caption<?php echo esc_attr( $urbanism_blog_title_class ); ?>">
								<?php
								$urbanism_top_icon = urbanism_get_term_image_small();
								if ( ! empty( $urbanism_top_icon ) ) {
									$urbanism_attr = urbanism_getimagesize( $urbanism_top_icon );
									?>
									<img src="<?php echo esc_url( $urbanism_top_icon ); ?>" alt="<?php esc_attr_e( 'Site icon', 'urbanism' ); ?>"
										<?php
										if ( ! empty( $urbanism_attr[3] ) ) {
											urbanism_show_layout( $urbanism_attr[3] );
										}
										?>
									>
									<?php
								}
								echo wp_kses_data( $urbanism_blog_title_text );
								?>
							</h1>
							<?php
							if ( ! empty( $urbanism_blog_title_link ) && ! empty( $urbanism_blog_title_link_text ) ) {
								?>
								<a href="<?php echo esc_url( $urbanism_blog_title_link ); ?>" class="theme_button theme_button_small sc_layouts_title_link"><?php echo esc_html( $urbanism_blog_title_link_text ); ?></a>
								<?php
							}

							// Category/Tag description
							if ( ! is_paged() && ( is_category() || is_tag() || is_tax() ) ) {
								the_archive_description( '<div class="sc_layouts_title_description">', '</div>' );
							}

							?>
						</div>
						<?php

						// Breadcrumbs
						ob_start();
						do_action( 'urbanism_action_breadcrumbs' );
						$urbanism_breadcrumbs = ob_get_contents();
						ob_end_clean();
						urbanism_show_layout( $urbanism_breadcrumbs, '<div class="sc_layouts_title_breadcrumbs">', '</div>' );
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
}
