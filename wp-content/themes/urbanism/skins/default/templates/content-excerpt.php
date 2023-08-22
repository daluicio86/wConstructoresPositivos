<?php
/**
 * The default template to display the content
 *
 * Used for index/archive/search.
 *
 * @package URBANISM
 * @since URBANISM 1.0
 */

$urbanism_template_args = get_query_var( 'urbanism_template_args' );
$urbanism_columns = 1;
if ( is_array( $urbanism_template_args ) ) {
	$urbanism_columns    = empty( $urbanism_template_args['columns'] ) ? 1 : max( 1, $urbanism_template_args['columns'] );
	$urbanism_blog_style = array( $urbanism_template_args['type'], $urbanism_columns );
	if ( ! empty( $urbanism_template_args['slider'] ) ) {
		?><div class="slider-slide swiper-slide">
		<?php
	} elseif ( $urbanism_columns > 1 ) {
	    $urbanism_columns_class = urbanism_get_column_class( 1, $urbanism_columns, ! empty( $urbanism_template_args['columns_tablet']) ? $urbanism_template_args['columns_tablet'] : '', ! empty($urbanism_template_args['columns_mobile']) ? $urbanism_template_args['columns_mobile'] : '' );
		?>
		<div class="<?php echo esc_attr( $urbanism_columns_class ); ?>">
		<?php
	}
}
$urbanism_expanded    = ! urbanism_sidebar_present() && urbanism_get_theme_option( 'expand_content' ) == 'expand';
$urbanism_post_format = get_post_format();
$urbanism_post_format = empty( $urbanism_post_format ) ? 'standard' : str_replace( 'post-format-', '', $urbanism_post_format );
?>
<article id="post-<?php the_ID(); ?>" data-post-id="<?php the_ID(); ?>"
	<?php
	post_class( 'post_item post_item_container post_layout_excerpt post_format_' . esc_attr( $urbanism_post_format ) );
	urbanism_add_blog_animation( $urbanism_template_args );
	?>
>
	<?php

	// Sticky label
	if ( is_sticky() && ! is_paged() ) {
		?>
		<span class="post_label label_sticky"></span>
		<?php
	}

	// Featured image
	$urbanism_hover      = ! empty( $urbanism_template_args['hover'] ) && ! urbanism_is_inherit( $urbanism_template_args['hover'] )
							? $urbanism_template_args['hover']
							: urbanism_get_theme_option( 'image_hover' );
	$urbanism_components = ! empty( $urbanism_template_args['meta_parts'] )
							? ( is_array( $urbanism_template_args['meta_parts'] )
								? $urbanism_template_args['meta_parts']
								: array_map( 'trim', explode( ',', $urbanism_template_args['meta_parts'] ) )
								)
							: urbanism_array_get_keys_by_value( urbanism_get_theme_option( 'meta_parts' ) );
	urbanism_show_post_featured( apply_filters( 'urbanism_filter_args_featured',
		array(
			'no_links'   => ! empty( $urbanism_template_args['no_links'] ),
			'hover'      => $urbanism_hover,
			'meta_parts' => $urbanism_components,
			'thumb_size' => ! empty( $urbanism_template_args['thumb_size'] )
							? $urbanism_template_args['thumb_size']
							: urbanism_get_thumb_size( strpos( urbanism_get_theme_option( 'body_style' ), 'full' ) !== false
								? 'full'
								: ( $urbanism_expanded 
									? 'huge' 
									: 'big' 
									)
								),
		),
		'content-excerpt',
		$urbanism_template_args
	) );

	// Title and post meta
	$urbanism_show_title = get_the_title() != '';
	$urbanism_show_meta  = count( $urbanism_components ) > 0 && ! in_array( $urbanism_hover, array( 'border', 'pull', 'slide', 'fade', 'info' ) );

	if ( $urbanism_show_title ) {
		?>
		<div class="post_header entry-header">
			<?php
			// Post title
			if ( apply_filters( 'urbanism_filter_show_blog_title', true, 'excerpt' ) ) {
				do_action( 'urbanism_action_before_post_title' );
				if ( empty( $urbanism_template_args['no_links'] ) ) {
					the_title( sprintf( '<h3 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' );
				} else {
					the_title( '<h3 class="post_title entry-title">', '</h3>' );
				}
				do_action( 'urbanism_action_after_post_title' );
			}
			?>
		</div><!-- .post_header -->
		<?php
	}

	// Post content
	if ( apply_filters( 'urbanism_filter_show_blog_excerpt', empty( $urbanism_template_args['hide_excerpt'] ) && urbanism_get_theme_option( 'excerpt_length' ) > 0, 'excerpt' ) ) {
		?>
		<div class="post_content entry-content">
			<?php

			// Post meta
			if ( apply_filters( 'urbanism_filter_show_blog_meta', $urbanism_show_meta, $urbanism_components, 'excerpt' ) ) {
				if ( count( $urbanism_components ) > 0 ) {
					do_action( 'urbanism_action_before_post_meta' );
					urbanism_show_post_meta(
						apply_filters(
							'urbanism_filter_post_meta_args', array(
								'components' => join( ',', $urbanism_components ),
								'seo'        => false,
								'echo'       => true,
							), 'excerpt', 1
						)
					);
					do_action( 'urbanism_action_after_post_meta' );
				}
			}

			if ( urbanism_get_theme_option( 'blog_content' ) == 'fullpost' ) {
				// Post content area
				?>
				<div class="post_content_inner">
					<?php
					do_action( 'urbanism_action_before_full_post_content' );
					the_content( '' );
					do_action( 'urbanism_action_after_full_post_content' );
					?>
				</div>
				<?php
				// Inner pages
				wp_link_pages(
					array(
						'before'      => '<div class="page_links"><span class="page_links_title">' . esc_html__( 'Pages:', 'urbanism' ) . '</span>',
						'after'       => '</div>',
						'link_before' => '<span>',
						'link_after'  => '</span>',
						'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'urbanism' ) . ' </span>%',
						'separator'   => '<span class="screen-reader-text">, </span>',
					)
				);
			} else {
				// Post content area
				urbanism_show_post_content( $urbanism_template_args, '<div class="post_content_inner">', '</div>' );
			}

			// More button
			if ( apply_filters( 'urbanism_filter_show_blog_readmore',  ! isset( $urbanism_template_args['more_button'] ) || ! empty( $urbanism_template_args['more_button'] ), 'excerpt' ) ) {
				if ( empty( $urbanism_template_args['no_links'] ) ) {
					do_action( 'urbanism_action_before_post_readmore' );
					if ( urbanism_get_theme_option( 'blog_content' ) != 'fullpost' ) {
						urbanism_show_post_more_link( $urbanism_template_args, '<p>', '</p>' );
					} else {
						urbanism_show_post_comments_link( $urbanism_template_args, '<p>', '</p>' );
					}
					do_action( 'urbanism_action_after_post_readmore' );
				}
			}

			?>
		</div><!-- .entry-content -->
		<?php
	}
	?>
</article>
<?php

if ( is_array( $urbanism_template_args ) ) {
	if ( ! empty( $urbanism_template_args['slider'] ) || $urbanism_columns > 1 ) {
		?>
		</div>
		<?php
	}
}
