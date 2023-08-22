<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: //codex.wordpress.org/Template_Hierarchy
 *
 * @package URBANISM
 * @since URBANISM 1.0
 */

$urbanism_template = apply_filters( 'urbanism_filter_get_template_part', urbanism_blog_archive_get_template() );

if ( ! empty( $urbanism_template ) && 'index' != $urbanism_template ) {

	get_template_part( $urbanism_template );

} else {

	urbanism_storage_set( 'blog_archive', true );

	get_header();

	if ( have_posts() ) {

		// Query params
		$urbanism_stickies   = is_home()
								|| ( in_array( urbanism_get_theme_option( 'post_type' ), array( '', 'post' ) )
									&& (int) urbanism_get_theme_option( 'parent_cat' ) == 0
									)
										? get_option( 'sticky_posts' )
										: false;
		$urbanism_post_type  = urbanism_get_theme_option( 'post_type' );
		$urbanism_args       = array(
								'blog_style'     => urbanism_get_theme_option( 'blog_style' ),
								'post_type'      => $urbanism_post_type,
								'taxonomy'       => urbanism_get_post_type_taxonomy( $urbanism_post_type ),
								'parent_cat'     => urbanism_get_theme_option( 'parent_cat' ),
								'posts_per_page' => urbanism_get_theme_option( 'posts_per_page' ),
								'sticky'         => urbanism_get_theme_option( 'sticky_style' ) == 'columns'
															&& is_array( $urbanism_stickies )
															&& count( $urbanism_stickies ) > 0
															&& get_query_var( 'paged' ) < 1
								);

		urbanism_blog_archive_start();

		do_action( 'urbanism_action_blog_archive_start' );

		if ( is_author() ) {
			do_action( 'urbanism_action_before_page_author' );
			get_template_part( apply_filters( 'urbanism_filter_get_template_part', 'templates/author-page' ) );
			do_action( 'urbanism_action_after_page_author' );
		}

		if ( urbanism_get_theme_option( 'show_filters' ) ) {
			do_action( 'urbanism_action_before_page_filters' );
			urbanism_show_filters( $urbanism_args );
			do_action( 'urbanism_action_after_page_filters' );
		} else {
			do_action( 'urbanism_action_before_page_posts' );
			urbanism_show_posts( array_merge( $urbanism_args, array( 'cat' => $urbanism_args['parent_cat'] ) ) );
			do_action( 'urbanism_action_after_page_posts' );
		}

		do_action( 'urbanism_action_blog_archive_end' );

		urbanism_blog_archive_end();

	} else {

		if ( is_search() ) {
			get_template_part( apply_filters( 'urbanism_filter_get_template_part', 'templates/content', 'none-search' ), 'none-search' );
		} else {
			get_template_part( apply_filters( 'urbanism_filter_get_template_part', 'templates/content', 'none-archive' ), 'none-archive' );
		}
	}

	get_footer();
}
