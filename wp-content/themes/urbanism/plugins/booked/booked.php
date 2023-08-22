<?php
/* Booked Appointments support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'urbanism_booked_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'urbanism_booked_theme_setup9', 9 );
	function urbanism_booked_theme_setup9() {
		if ( urbanism_exists_booked() ) {
			add_action( 'wp_enqueue_scripts', 'urbanism_booked_frontend_scripts', 1100 );
			add_action( 'trx_addons_action_load_scripts_front_booked', 'urbanism_booked_frontend_scripts', 10, 1 );
			add_action( 'wp_enqueue_scripts', 'urbanism_booked_frontend_scripts_responsive', 2000 );
			add_action( 'trx_addons_action_load_scripts_front_booked', 'urbanism_booked_frontend_scripts_responsive', 10, 1 );
			add_filter( 'urbanism_filter_merge_styles', 'urbanism_booked_merge_styles' );
			add_filter( 'urbanism_filter_merge_styles_responsive', 'urbanism_booked_merge_styles_responsive' );
		}
		if ( is_admin() ) {
			add_filter( 'urbanism_filter_tgmpa_required_plugins', 'urbanism_booked_tgmpa_required_plugins' );
			add_filter( 'urbanism_filter_theme_plugins', 'urbanism_booked_theme_plugins' );
		}
	}
}


// Filter to add in the required plugins list
if ( ! function_exists( 'urbanism_booked_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('urbanism_filter_tgmpa_required_plugins',	'urbanism_booked_tgmpa_required_plugins');
	function urbanism_booked_tgmpa_required_plugins( $list = array() ) {
		if ( urbanism_storage_isset( 'required_plugins', 'booked' ) && urbanism_storage_get_array( 'required_plugins', 'booked', 'install' ) !== false && urbanism_is_theme_activated() ) {
			$path = urbanism_get_plugin_source_path( 'plugins/booked/booked.zip' );
			if ( ! empty( $path ) || urbanism_get_theme_setting( 'tgmpa_upload' ) ) {
				$list[] = array(
					'name'     => urbanism_storage_get_array( 'required_plugins', 'booked', 'title' ),
					'slug'     => 'booked',
					'source'   => ! empty( $path ) ? $path : 'upload://booked.zip',
					'version'  => '2.3',
					'required' => false,
				);
			}
		}
		return $list;
	}
}


// Filter theme-supported plugins list
if ( ! function_exists( 'urbanism_booked_theme_plugins' ) ) {
	//Handler of the add_filter( 'urbanism_filter_theme_plugins', 'urbanism_booked_theme_plugins' );
	function urbanism_booked_theme_plugins( $list = array() ) {
		return urbanism_add_group_and_logo_to_slave( $list, 'booked', 'booked-' );
	}
}


// Check if plugin installed and activated
if ( ! function_exists( 'urbanism_exists_booked' ) ) {
	function urbanism_exists_booked() {
		return class_exists( 'booked_plugin' );
	}
}


// Return a relative path to the plugin styles depend the version
if ( ! function_exists( 'urbanism_booked_get_styles_dir' ) ) {
	function urbanism_booked_get_styles_dir( $file ) {
		$base_dir = 'plugins/booked/';
		return $base_dir
				. ( defined( 'BOOKED_VERSION' ) && version_compare( BOOKED_VERSION, '2.4', '<' ) && urbanism_get_folder_dir( $base_dir . 'old' )
					? 'old/'
					: ''
					)
				. $file;
	}
}


// Enqueue styles for frontend
if ( ! function_exists( 'urbanism_booked_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'urbanism_booked_frontend_scripts', 1100 );
	//Handler of the add_action( 'trx_addons_action_load_scripts_front_booked', 'urbanism_booked_frontend_scripts', 10, 1 );
	function urbanism_booked_frontend_scripts( $force = false ) {
		static $loaded = false;
		if ( ! $loaded && (
			current_action() == 'wp_enqueue_scripts' && urbanism_need_frontend_scripts( 'booked' )
			||
			current_action() != 'wp_enqueue_scripts' && $force === true
			)
		) {
			$loaded = true;
			$urbanism_url = urbanism_get_file_url( urbanism_booked_get_styles_dir( 'booked.css' ) );
			if ( '' != $urbanism_url ) {
				wp_enqueue_style( 'urbanism-booked', $urbanism_url, array(), null );
			}
		}
	}
}


// Enqueue responsive styles for frontend
if ( ! function_exists( 'urbanism_booked_frontend_scripts_responsive' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'urbanism_booked_frontend_scripts_responsive', 2000 );
	//Handler of the add_action( 'trx_addons_action_load_scripts_front_booked', 'urbanism_booked_frontend_scripts_responsive', 10, 1 );
	function urbanism_booked_frontend_scripts_responsive( $force = false ) {
		static $loaded = false;
		if ( ! $loaded && (
			current_action() == 'wp_enqueue_scripts' && urbanism_need_frontend_scripts( 'booked' )
			||
			current_action() != 'wp_enqueue_scripts' && $force === true
			)
		) {
			$loaded = true;
			$urbanism_url = urbanism_get_file_url( urbanism_booked_get_styles_dir( 'booked-responsive.css' ) );
			if ( '' != $urbanism_url ) {
				wp_enqueue_style( 'urbanism-booked-responsive', $urbanism_url, array(), null, urbanism_media_for_load_css_responsive( 'booked' ) );
			}
		}
	}
}


// Merge custom styles
if ( ! function_exists( 'urbanism_booked_merge_styles' ) ) {
	//Handler of the add_filter('urbanism_filter_merge_styles', 'urbanism_booked_merge_styles');
	function urbanism_booked_merge_styles( $list ) {
		$list[ urbanism_booked_get_styles_dir( 'booked.css' ) ] = false;
		return $list;
	}
}


// Merge responsive styles
if ( ! function_exists( 'urbanism_booked_merge_styles_responsive' ) ) {
	//Handler of the add_filter('urbanism_filter_merge_styles_responsive', 'urbanism_booked_merge_styles_responsive');
	function urbanism_booked_merge_styles_responsive( $list ) {
		$list[ urbanism_booked_get_styles_dir( 'booked-responsive.css' ) ] = false;
		return $list;
	}
}


// Add plugin-specific colors and fonts to the custom CSS
if ( urbanism_exists_booked() ) {
	$urbanism_fdir = urbanism_get_file_dir( urbanism_booked_get_styles_dir( 'booked-style.php' ) );
	if ( ! empty( $urbanism_fdir ) ) {
		require_once $urbanism_fdir;
	}
}
