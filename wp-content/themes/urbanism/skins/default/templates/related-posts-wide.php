<?php
/**
 * The template 'Style 5' to displaying related posts
 *
 * @package URBANISM
 * @since URBANISM 1.0.54
 */

$urbanism_link        = get_permalink();
$urbanism_post_format = get_post_format();
$urbanism_post_format = empty( $urbanism_post_format ) ? 'standard' : str_replace( 'post-format-', '', $urbanism_post_format );
?><div id="post-<?php the_ID(); ?>" <?php post_class( 'related_item post_format_' . esc_attr( $urbanism_post_format ) ); ?> data-post-id="<?php the_ID(); ?>">
	<?php
	urbanism_show_post_featured(
		array(
			'thumb_size'    => apply_filters( 'urbanism_filter_related_thumb_size', urbanism_get_thumb_size( (int) urbanism_get_theme_option( 'related_posts' ) == 1 ? 'big' : 'med' ) ),
		)
	);
	?>
	<div class="post_header entry-header">
		<h6 class="post_title entry-title"><a href="<?php echo esc_url( $urbanism_link ); ?>"><?php
			if ( '' == get_the_title() ) {
				esc_html_e( '- No title -', 'urbanism' );
			} else {
				the_title();
			}
		?></a></h6>
		<?php
		if ( in_array( get_post_type(), array( 'post', 'attachment' ) ) ) {
			?>
			<div class="post_meta">
				<a href="<?php echo esc_url( $urbanism_link ); ?>" class="post_meta_item post_date"><?php echo wp_kses_data( urbanism_get_date() ); ?></a>
			</div>
			<?php
		}
		?>
	</div>
</div>
