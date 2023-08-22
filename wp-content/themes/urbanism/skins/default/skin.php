<?php
/**
 * Skins support: Main skin file for the skin 'Default'
 *
 * Load scripts and styles,
 * and other operations that affect the appearance and behavior of the theme
 * when the skin is activated
 *
 * @package URBANISM
 * @since URBANISM 1.0.46
 */



// SKIN SETUP
//--------------------------------------------------------------------

// Setup fonts, colors, blog and single styles, etc.
$urbanism_skin_path = urbanism_get_file_dir( urbanism_skins_get_current_skin_dir() . 'skin-setup.php' );
if ( ! empty( $urbanism_skin_path ) ) {
	require_once $urbanism_skin_path;
}

// Skin options
$urbanism_skin_path = urbanism_get_file_dir( urbanism_skins_get_current_skin_dir() . 'skin-options.php' );
if ( ! empty( $urbanism_skin_path ) ) {
	require_once $urbanism_skin_path;
}

// Required plugins
$urbanism_skin_path = urbanism_get_file_dir( urbanism_skins_get_current_skin_dir() . 'skin-plugins.php' );
if ( ! empty( $urbanism_skin_path ) ) {
	require_once $urbanism_skin_path;
}

// Demo import
$urbanism_skin_path = urbanism_get_file_dir( urbanism_skins_get_current_skin_dir() . 'skin-demo-importer.php' );
if ( ! empty( $urbanism_skin_path ) ) {
	require_once $urbanism_skin_path;
}


// TRX_ADDONS SETUP
//--------------------------------------------------------------------

// Filter to add in the required plugins list
// Priority 11 to add new plugins to the end of the list
if ( ! function_exists( 'urbanism_skin_tgmpa_required_plugins' ) ) {
	add_filter( 'urbanism_filter_tgmpa_required_plugins', 'urbanism_skin_tgmpa_required_plugins', 11 );
	function urbanism_skin_tgmpa_required_plugins( $list = array() ) {
		// ToDo: Check if plugin is in the 'required_plugins' and add his parameters to the TGMPA-list
		//       Replace 'skin-specific-plugin-slug' to the real slug of the plugin
		if ( urbanism_storage_isset( 'required_plugins', 'skin-specific-plugin-slug' ) ) {
			$list[] = array(
				'name'     => urbanism_storage_get_array( 'required_plugins', 'skin-specific-plugin-slug', 'title' ),
				'slug'     => 'skin-specific-plugin-slug',
				'required' => false,
			);
		}
		return $list;
	}
}

// Filter to add/remove components of ThemeREX Addons when current skin is active
if ( ! function_exists( 'urbanism_skin_trx_addons_default_components' ) ) {
    add_filter('trx_addons_filter_load_options', 'urbanism_skin_trx_addons_default_components', 20);
	function urbanism_skin_trx_addons_default_components($components) {
        // ToDo: Set key value in the array $components to 0 (disable component) or 1 (enable component)
		//---> For example (enable reviews for posts):
		//---> $components['components_components_reviews'] = 1;
		return $components;
	}
}

// Filter to add/remove CPT
if ( ! function_exists( 'urbanism_skin_trx_addons_cpt_list' ) ) {
	add_filter('trx_addons_cpt_list', 'urbanism_skin_trx_addons_cpt_list');
	function urbanism_skin_trx_addons_cpt_list( $list = array() ) {
		// ToDo: Unset CPT slug from list to disable CPT when current skin is active
		//---> For example to disable CPT 'Portfolio':
		//---> unset( $list['portfolio'] );
		return $list;
	}
}

// Filter to add/remove shortcodes
if ( ! function_exists( 'urbanism_skin_trx_addons_sc_list' ) ) {
	add_filter('trx_addons_sc_list', 'urbanism_skin_trx_addons_sc_list');
	function urbanism_skin_trx_addons_sc_list( $list = array() ) {

		unset( $list['blogger']['templates']['default']['classic_2']);
		unset( $list['blogger']['templates']['default']['over_centered']);
		unset( $list['blogger']['templates']['news']['announce']);

        $list['blogger']['templates']['portestate']['default'] = array(
            'title'  => esc_html__('default', 'urbanism'),
            'layout' => array(
                'featured' => array(
                ),
                'content' => array(
                    'title','meta_categories'
                )
            )
        );
        $list['blogger']['templates']['portmodern']['image-over'] = array(
            'title'  => esc_html__('Image over', 'urbanism'),
            'args' => array( 'image_ratio' =>  '10:9' ),
            'layout' => array(
                'content' => array(
                    'title'
                )
            )
        );
        $list['blogger']['templates']['lay_portfolio']['style-1'] = array(
            'title'  => esc_html__('Style 1', 'urbanism'),
            'layout' => array(
                'featured' => array(
                ),
                'content' => array(
                    'title', 'meta_categories', 'meta', 'excerpt', 'readmore'
                )
            )
        );
        $list['blogger']['templates']['lay_portfolio']['style_5'] = array (
            'title'  => esc_html__('Style 5', 'urbanism'),
            'args' => array( 'image_ratio' =>  '10:9', 'hover' => 'link' ),
            'layout' => array (
                'featured' => array (
                    'bl' => array (
                        'title', 'meta_categories', 'meta', 'excerpt', 'readmore'
                    )
                )
            )
        );
        $list['blogger']['templates']['lay_portfolio']['style_6'] = array (
            'title'  => esc_html__('Style 6', 'urbanism'),
            'args' => array( 'image_ratio' =>  '10:9', 'hover' => 'link' ),
            'layout' => array (
                'featured' => array (
                    'bc' => array (
                        'title', 'meta_categories', 'meta', 'excerpt', 'readmore'
                    )
                )
            )
        );
        $list['blogger']['templates']['lay_portfolio']['style_7'] = array (
            'title'  => esc_html__('Style 7', 'urbanism'),
            'args' => array( 'image_ratio' =>  '1:1', 'hover' => 'link' ),
            'layout' => array (
                'featured' => array (
                    'bl' => array (
                        'title', 'meta_categories'
                    )
                )
            )
        );
        $list['blogger']['templates']['lay_portfolio']['style-8'] = array(
            'title'  => esc_html__('Style 8', 'urbanism'),
            'layout' => array(
                'featured' => array(
                ),
                'content' => array(
                    'title', 'meta_categories', 'meta', 'excerpt', 'readmore'
                )
            )
        );
        $list['blogger']['templates']['lay_portfolio']['style_14'] = array (
            'title'  => esc_html__('Style 14', 'urbanism'),
            'args' => array( 'image_ratio' =>  '10:7','no_links'  => false, 'hover' => 'link' ),
            'layout' => array (
                'featured' => array (
                    'bc' => array (
                        'title', 'meta_categories'
                    )
                )
            )
        );
        $list['blogger']['templates']['lay_portfolio']['style_15'] = array (
            'title'  => esc_html__('Style 15', 'urbanism'),
            'args' => array( 'image_ratio' =>  '1:1','no_links'  => false, 'hover' => 'link' ),
            'layout' => array (
                'featured' => array (
                    'bc' => array (
                        'title', 'meta_categories'
                    )
                )
            )
        );
        $list['blogger']['templates']['lay_portfolio']['style_16'] = array (
            'title'  => esc_html__('Style 16', 'urbanism'),
            'args' => array( 'image_ratio' =>  '10:9','hover' => 'link' ),
            'layout' => array (
                'featured' => array (
                    'bl' => array (
                        'title', 'meta_categories', 'readmore'
                    )
                )
            )
        );

        // Grid portfolio
        // Grid Style 3
        $list['blogger']['templates']['lay_portfolio_grid']['grid_style_3'] = array (
            'title'  => esc_html__('Grid style 3', 'urbanism'),
            'args'  => array(  'hover' => 'link' ),
            'grid'  => array(
                // One post
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Two posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Three posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                    )
                ),
                // Four posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                    )
                ),
                // Five posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                    )
                ),
                // Six posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                    )
                ),
                // Seven posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                    )
                ),
                // Eight posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                    )
                ),
                // Nine posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                    )
                ),
                // Ten posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                    )
                ),
                // Eleven posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Twelve posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                    )
                ),
            )
        );

        // grid Style 4
        $list['blogger']['templates']['lay_portfolio_grid']['grid_style_4'] = array (
            'title'  => esc_html__('Grid style 4', 'urbanism'),
            'args'  => array( 'hover' => 'link' ),
            'grid'  => array(
                // One post
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Two posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Three posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                    )
                ),
                // Four posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Five posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                    )
                ),
                // Six posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                    )
                ),
                // Seven posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Eight posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Nine posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                    )
                ),
                // Ten posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                    )
                ),
                // Eleven posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'big' )
                        ),
                    )
                ),
                // Twelve posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'big' )
                        ),
                    )
                ),
            )
        );

        // Grid Style 5
        $list['blogger']['templates']['lay_portfolio_grid']['grid_style_5'] = array (
            'title'  => esc_html__('Grid style 5', 'urbanism'),
            'args'  => array(  'hover' => 'link' ),
            'grid'  => array(
                // One post
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Two posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Three posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                    )
                ),
                // Four posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Five posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                    )
                ),
                // Six posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                    )
                ),
            )
        );

        // Grid Style 7
        $list['blogger']['templates']['lay_portfolio_grid']['grid_style_7'] = array(
            'title'  => esc_html__('Grid style 7', 'urbanism'),
            'args' => array( /*'hover' => 'link' - specific hovers work satisfactorily*/ ),
            'grid'  => array(
                // One post
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Two posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Three posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                    )
                ),
                // Four posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                    )
                ),
                // Five posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                    )
                ),
                // Six posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                    )
                ),
                // Seven posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Eight posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                    )
                ),
                // Nine posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Ten posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Eleven posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Twelve posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                    )
                ),
            )
        );

        // Grid Style 8
        $list['blogger']['templates']['lay_portfolio_grid']['grid_style_8'] = array (
            'title'  => esc_html__('Grid style 8', 'urbanism'),
            'args' => array( 'hover' => 'link' ),
            'grid'  => array(
                // One post
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Two posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Three posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                    )
                ),
                // Four posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Five posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                    )
                ),
                // Six posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                    )
                ),
                // Seven posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                    )
                ),
                // Eight posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                )
                ),
                // Nine posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Ten posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Eleven posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Twelve posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        )
                    )
                ),
            )
        );

        // Grid Style 9
        $list['blogger']['templates']['lay_portfolio_grid']['grid_style_9'] = array (
            'title'  => esc_html__('Grid style 9', 'urbanism'),
            'args'  => array(  /*'hover' => 'link' - specific hovers work satisfactorily*/ ),
            'grid'  => array(
                // One post
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Two posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Three posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                    )
                ),
                // Four posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                    )
                ),
                // Five posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                    )
                ),
                // Six posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                    )
                ),
                // Seven posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                    )
                ),
                // Eight posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                    )
                ),
                // Nine posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Ten posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Eleven posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Twelve posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                    )
                ),
            )
        );

        // grid Style 13
        $list['blogger']['templates']['lay_portfolio_grid']['grid_style_13'] = array (
            'title'  => esc_html__('Grid style 13', 'urbanism'),
            'args'  => array(  'hover' => 'link' ),
            'grid'  => array(
                // One post
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Two posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Three posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                    )
                ),
                // Four posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Five posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                    )
                ),
                // Six posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'masonry-big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'masonry-big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'masonry-big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                    )
                ),
                // Seven posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'masonry-big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                    )
                ),
                // Eight posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'masonry-big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                    )
                ),
                // Nine posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'masonry-big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'big' )
                        ),
                    )
                ),
                // Ten posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'masonry-big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'masonry-big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'masonry-big' )
                        ),
                    )
                ),
                // Eleven posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'masonry-big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'masonry-big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                    )
                ),
                // Twelve posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'masonry-big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'masonry-big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'masonry-big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'masonry-big' )
                        ),
                    )
                ),
            )
        );



		$list['blogger']['templates']['list']['simple'] = array(
			'title'  => esc_html__('Simple', 'urbanism'),
			'layout' => array(
				'content' => array(
					'meta', 'title', 'readmore'
				)
			)
		);
		$list['blogger']['templates']['list']['hover'] = array(
			'title'  => esc_html__('Simple (hover)', 'urbanism'),
			'layout' => array(
				'content' => array(
					'meta', 'title', 'readmore'
				)
			)
		);
		$list['blogger']['templates']['list']['hover_2'] = array(
			'title'  => esc_html__('Simple (hover 2)', 'urbanism'),
			'layout' => array(
				'content' => array(
					'meta', 'title', 'excerpt', 'readmore'
				)
			)
		);
		$list['blogger']['templates']['list']['with_image'] = array(
			'title'  => esc_html__('With image', 'urbanism'),
			'layout' => array(
				'featured' => array(
				),
				'content' => array(
					'meta', 'title', 'readmore'
				)
			)
		);
		$list['blogger']['templates']['default']['classic_simple'] = array(
			'title'  => esc_html__('Classic Grid (simple)', 'urbanism'),
			'layout' => array(
				'featured' => array(
				),
				'content' => array(
					'meta', 'title', 'excerpt', 'readmore'
				)
			)
		);
		$list['blogger']['templates']['default']['classic_3'] = array(
			'title'  => esc_html__('Classic with header above', 'urbanism'),
			'layout' => array(
				'header' => array(
					'meta', 'title'
				),
				'featured' => array(
				),
				'content' => array(
					'excerpt', 'readmore'
				)
			)
		);
		$list['blogger']['templates']['default']['classic_time'] = array(
			'title'  => esc_html__('Classic Grid (date)', 'urbanism'),
			'layout' => array(
				'featured' => array(
				),
				'content' => array(
					'meta_date', 'meta', 'title', 'excerpt', 'readmore'
				)
			)
		);
		$list['blogger']['templates']['default']['classic_time_2'] = array(
			'title'  => esc_html__('Classic Grid (date 2)', 'urbanism'),
			'layout' => array(
				'featured' => array(
					'tl' => array(
						'meta_categories'
					)
				),
				'content' => array(
					'meta_date', 'title', 'excerpt', 'meta', 'readmore'
				)
			)
		);
		$list['blogger']['templates']['default']['over_bottom'] = array(
			'title'  => esc_html__('Info over image (bottom)', 'urbanism'),
			'layout' => array(
				'featured' => array(
					'bc' => array(
						'meta', 'title', 'readmore'
					)
				),
			)
		);
		$list['blogger']['templates']['default']['over_centered_hover'] = array(
			'title'  => esc_html__('Info over image (hover)', 'urbanism'),
			'layout' => array(
				'featured' => array(
					'mc' => array(
						'meta', 'title', 'excerpt', 'readmore'
					)
				),
			)
		);
		$list['blogger']['templates']['default']['over_centered_hover_2'] = array(
			'title'  => esc_html__('Info over image (hover 2)', 'urbanism'),
			'layout' => array(
				'featured' => array(
					'mc' => array(
						'meta_categories', 'title', 'meta'
					)
				),
			)
		);
		$list['blogger']['templates']['default']['over_centered_hover_3'] = array(
			'title'  => esc_html__('Info over image (hover 3)', 'urbanism'),
			'layout' => array(
				'featured' => array(
					'mc' => array(
						'meta_categories', 'title', 'meta'
					)
				),
			)
		);
		$list['blogger']['templates']['default']['over_centered_hover'] = array(
			'title'  => esc_html__('Info over image (hover)', 'urbanism'),
			'layout' => array(
				'featured' => array(
					'mc' => array(
						'meta', 'title', 'excerpt', 'readmore'
					)
				),
			)
		);

		return $list;
	}
}

// Filter to add/remove widgets
if ( ! function_exists( 'urbanism_skin_trx_addons_widgets_list' ) ) {
	add_filter('trx_addons_widgets_list', 'urbanism_skin_trx_addons_widgets_list');
	function urbanism_skin_trx_addons_widgets_list( $list = array() ) {
		// ToDo: Unset widget's slug from list to disable widget when current skin is active
		//---> For example to disable widget 'About Me':
		//---> unset( $list['aboutme'] );

		$list['categories_list']['layouts_sc'][4] = esc_html__('Extra 1', 'urbanism');
		$list['categories_list']['layouts_sc'][5] = esc_html__('Extra 2', 'urbanism');
		$list['categories_list']['layouts_sc'][6] = esc_html__('Extra 3', 'urbanism');
		$list['categories_list']['layouts_sc'][7] = esc_html__('Grid 1', 'urbanism');
		$list['categories_list']['layouts_sc'][8] = esc_html__('Grid 2', 'urbanism');

		return $list;
	}
}


// SCRIPTS AND STYLES
//--------------------------------------------------

// Localize a theme-specific scripts: add variables to use in JS in the frontend.
if ( ! function_exists( 'urbanism_skin_localize_script' ) ) {
	add_action( 'urbanism_filter_localize_script', 'urbanism_skin_localize_script' );
	function urbanism_skin_localize_script( $vars = array() ) {
		$vars['msg_copied'] = addslashes(esc_html__("Copied!", 'urbanism'));
        return $vars;
	}
}


// Enqueue skin-specific scripts
// Priority 1050 -  before main theme plugins-specific (1100)
if ( ! function_exists( 'urbanism_skin_frontend_scripts' ) ) {
	add_action( 'wp_enqueue_scripts', 'urbanism_skin_frontend_scripts', 1050 );
	function urbanism_skin_frontend_scripts() {
		$urbanism_url = urbanism_get_file_url( urbanism_skins_get_current_skin_dir() . 'css/style.css' );
		if ( '' != $urbanism_url ) {
			wp_enqueue_style( 'urbanism-skin-' . esc_attr( urbanism_skins_get_current_skin_name() ), $urbanism_url, array(), null );
		}
		$urbanism_url = urbanism_get_file_url( urbanism_skins_get_current_skin_dir() . 'skin.js' );
		if ( '' != $urbanism_url ) {
			wp_enqueue_script( 'urbanism-skin-' . esc_attr( urbanism_skins_get_current_skin_name() ), $urbanism_url, array( 'jquery' ), null, true );
		}
	}
}


// Enqueue additional responsive styles for frontend
// Priority 2050 -  after main theme plugins-specific responsive (2000)
if ( ! function_exists( 'urbanism_skin_trx_addons_responsive_styles' ) ) {
	add_action( 'wp_enqueue_scripts', 'urbanism_skin_trx_addons_responsive_styles', 2050 );
	function urbanism_skin_trx_addons_responsive_styles() {
		if ( urbanism_is_on( urbanism_get_theme_option( 'debug_mode' ) ) ) {
			$urbanism_url_additional_1 = urbanism_get_file_url( 'plugins/trx_addons/trx_addons-additional-responsive-1.css' );
			$urbanism_url_additional_2 = urbanism_get_file_url( 'plugins/trx_addons/trx_addons-additional-responsive-2.css' );
			$urbanism_url_additional_3 = urbanism_get_file_url( 'plugins/trx_addons/trx_addons-additional-responsive-3.css' );
            if ( '' != $urbanism_url_additional_1 ) {
                wp_enqueue_style( 'urbanism-trx-addons-additional-responsive-1', $urbanism_url_additional_1, array(), null, urbanism_media_for_load_css_responsive( 'trx-addons-1' ) );
			}
            if ( '' != $urbanism_url_additional_2 ) {
                wp_enqueue_style( 'urbanism-trx-addons-additional-responsive-2', $urbanism_url_additional_2, array(), null, urbanism_media_for_load_css_responsive( 'trx-addons-2' ) );
            }
            if ( '' != $urbanism_url_additional_3 ) {
                wp_enqueue_style( 'urbanism-trx-addons-additional-responsive-3', $urbanism_url_additional_3, array(), null, urbanism_media_for_load_css_responsive( 'trx-addons-3' ) );
            }
		}
	}
}

// Merge responsive styles
if ( ! function_exists( 'urbanism_skin_trx_addons_merge_styles_responsive' ) ) {
	add_filter('urbanism_filter_merge_styles_responsive', 'urbanism_skin_trx_addons_merge_styles_responsive', 20);
	function urbanism_skin_trx_addons_merge_styles_responsive( $list ) {
		$list[] = 'plugins/trx_addons/trx_addons-additional-responsive-1.css';
		$list[] = 'plugins/trx_addons/trx_addons-additional-responsive-2.css';
		$list[] = 'plugins/trx_addons/trx_addons-additional-responsive-3.css';
		return $list;
	}
}


// Custom styles
$urbanism_style_path = urbanism_get_file_dir( urbanism_skins_get_current_skin_dir() . 'css/style.php' );
if ( ! empty( $urbanism_style_path ) ) {
	require_once $urbanism_style_path;
}



// ADD NEW PARAMS
//--------------------------------------------------


// Add new output types (layouts) in the shortcodes
if ( ! function_exists( 'urbanism_skin_trx_addons_sc_type' ) ) {
	add_filter( 'trx_addons_sc_type', 'urbanism_skin_trx_addons_sc_type', 10, 2 );
	function urbanism_skin_trx_addons_sc_type( $list, $sc ) {

		if ( 'trx_sc_button' == $sc ) {
			$list['decoration'] = esc_html__( 'Decoration', 'urbanism' );
			$list['hover'] = esc_html__( 'Hover', 'urbanism' );
		}
        if ( 'trx_sc_title' == $sc ) {
            $list['icon'] = esc_html__( 'Icon', 'urbanism' );
            $list['icon_bottom'] = esc_html__( 'Icon (bottom)', 'urbanism' );
        }
        if ( 'trx_sc_price' == $sc ) {
            $list['light'] = esc_html__( 'Light', 'urbanism' );
            $list['simple'] = esc_html__( 'Simple', 'urbanism' );
            $list['simple_shadow'] = esc_html__( 'Simple (shadow)', 'urbanism' );
            $list['plain'] = esc_html__( 'Plain', 'urbanism' );
            $list['focus'] = esc_html__( 'Focus', 'urbanism' );
            $list['metro'] = esc_html__( 'Metro', 'urbanism' );
        }
        if ( 'trx_sc_skills' == $sc ) {
            $list['alter'] = esc_html__( 'Alter', 'urbanism' );
            $list['extra'] = esc_html__( 'Extra', 'urbanism' );
            $list['modern'] = esc_html__( 'Modern', 'urbanism' );
            $list['simple'] = esc_html__( 'Simple', 'urbanism' );
        }
        if ( 'trx_sc_icons' == $sc ) {
            $list['alter'] = esc_html__( 'Alter', 'urbanism' );
            $list['light'] = esc_html__( 'Light', 'urbanism' );
            $list['hover'] = esc_html__( 'Hover', 'urbanism' );
            $list['hover2'] = esc_html__( 'Hover 2', 'urbanism' );
            $list['simple'] = esc_html__( 'Simple', 'urbanism' );
            $list['plate'] = esc_html__( 'Plate', 'urbanism' );
            $list['extra'] = esc_html__( 'Extra', 'urbanism' );
            $list['plain'] = esc_html__( 'Plain', 'urbanism' );
            $list['bordered'] = esc_html__( 'Bordered', 'urbanism' );
            $list['card'] = esc_html__( 'Card', 'urbanism' );
            $list['creative'] = esc_html__( 'Creative', 'urbanism' );
            $list['accent'] = esc_html__( 'Accent', 'urbanism' );
            $list['accent2'] = esc_html__( 'Accent 2', 'urbanism' );
            $list['motley'] = esc_html__( 'Motley', 'urbanism' );
            $list['decoration'] = esc_html__( 'Decoration', 'urbanism' );
            $list['figure'] = esc_html__( 'Figure', 'urbanism' );
            $list['number'] = esc_html__( 'Number', 'urbanism' );
            $list['rounded'] = esc_html__( 'Rounded', 'urbanism' );
            $list['common'] = esc_html__( 'Common', 'urbanism' );
            $list['divider'] = esc_html__( 'Divider', 'urbanism' );
            $list['divider2'] = esc_html__( 'Divider 2', 'urbanism' );
            $list['divider3'] = esc_html__( 'Divider 3', 'urbanism' );
            $list['divider4'] = esc_html__( 'Divider 4', 'urbanism' );
            $list['partners'] = esc_html__( 'Partners', 'urbanism' );
            $list['fill'] = esc_html__( 'Fill', 'urbanism' );
        }

        if ( 'trx_sc_services' == $sc ) {
            $list['alter'] = esc_html__( 'Alter', 'urbanism' );
            $list['modern'] = esc_html__( 'Modern', 'urbanism' );
            $list['breezy'] = esc_html__( 'Breezy', 'urbanism' );
            $list['cool'] = esc_html__( 'Cool', 'urbanism' );
            $list['extra'] = esc_html__( 'Extra', 'urbanism' );
            $list['strong'] = esc_html__( 'Strong', 'urbanism' );
            $list['minimal'] = esc_html__( 'Minimal', 'urbanism' );
            $list['creative'] = esc_html__( 'Creative', 'urbanism' );
            $list['shine'] = esc_html__( 'Shine', 'urbanism' );
            $list['motley'] = esc_html__( 'Motley', 'urbanism' );
            $list['classic'] = esc_html__( 'Classic', 'urbanism' );
            $list['fashion'] = esc_html__( 'Fashion', 'urbanism' );
            $list['backward'] = esc_html__( 'Backward', 'urbanism' );
            $list['accent'] = esc_html__( 'Accent', 'urbanism' );
            $list['strange'] = esc_html__( 'Strange', 'urbanism' );
            $list['unusual'] = esc_html__( 'Unusual', 'urbanism' );
            $list['price'] = esc_html__( 'Price', 'urbanism' );
            $list['price2'] = esc_html__( 'Price 2', 'urbanism' );
        }
		if ( 'trx_sc_team' == $sc ) {
			$list['alter'] = esc_html__( 'Alter', 'urbanism' );
			$list['3d'] = esc_html__( '3D', 'urbanism' );
			$list['3d-simple'] = esc_html__( '3D (simple)', 'urbanism' );
			$list['plain'] = esc_html__( 'Plain', 'urbanism' );
			$list['list'] = esc_html__( 'List', 'urbanism' );
			$list['metro'] = esc_html__( 'Metro', 'urbanism' );
			$list['hover'] = esc_html__( 'Hover', 'urbanism' );
			$list['creative'] = esc_html__( 'Creative', 'urbanism' );
			$list['accent'] = esc_html__( 'Accent', 'urbanism' );
			$list['light'] = esc_html__( 'Light', 'urbanism' );
		}
		if ( 'trx_sc_testimonials' == $sc ) {
			$list['classic'] = esc_html__( 'Classic', 'urbanism' );
			$list['plain'] = esc_html__( 'Plain', 'urbanism' );
			$list['extra'] = esc_html__( 'Plain (extra)', 'urbanism' );
			$list['light'] = esc_html__( 'Light', 'urbanism' );
			$list['list'] = esc_html__( 'List', 'urbanism' );
			$list['common'] = esc_html__( 'Common', 'urbanism' );
			$list['modern'] = esc_html__( 'Modern', 'urbanism' );
			$list['hover'] = esc_html__( 'Hover', 'urbanism' );
			$list['accent'] = esc_html__( 'Accent', 'urbanism' );
			$list['accent2'] = esc_html__( 'Accent 2', 'urbanism' );
			$list['creative'] = esc_html__( 'Creative', 'urbanism' );
			$list['fashion'] = esc_html__( 'Fashion', 'urbanism' );
			$list['alter'] = esc_html__( 'Alter', 'urbanism' );
			$list['alter2'] = esc_html__( 'Alter 2', 'urbanism' );
			$list['decoration'] = esc_html__( 'Decoration', 'urbanism' );
			$list['chit'] = esc_html__( 'Chit', 'urbanism' );
			$list['bred'] = esc_html__( 'Bred', 'urbanism' );
		}
        if ( 'trx_sc_blogger' == $sc ) {
            $list['lay_portfolio'] = esc_html__('Layout Portfolio', 'urbanism' );
            $list['lay_portfolio_grid'] = esc_html__('Layout Portfolio grid', 'urbanism' );
            $list['portmodern'] = esc_html__('Portfolio Modern', 'urbanism' );
            $list['portestate'] = esc_html__('Portfolio Real Estate', 'urbanism' );
        }
        if ( 'trx_sc_portfolio' == $sc ) {
            $list['extra'] = esc_html__('Extra', 'urbanism' );
            $list['eclipse'] = esc_html__('Eclipse', 'urbanism' );
            $list['simple'] = esc_html__('Simple', 'urbanism' );
            $list['band'] = esc_html__('Band', 'urbanism' );
            $list['fill'] = esc_html__('Fill', 'urbanism' );
        }
        if ( 'trx_sc_layouts_search' == $sc ) {
            $list['modern'] = esc_html__('Modern', 'urbanism' );
        }
		if ( 'trx_sc_socials' == $sc ) {
			$list['modern'] = esc_html__('Modern', 'urbanism' );
			$list['modern_2'] = esc_html__('Modern 2', 'urbanism' );
			$list['alter'] = esc_html__('Alter (icon+name)', 'urbanism' );
			$list['extra'] = esc_html__('Extra (icon+name)', 'urbanism' );
			$list['simple'] = esc_html__('Simple', 'urbanism' );
		}
		if ( 'trx_sc_layouts_cart' == $sc ) {
			$list['modern'] = esc_html__('Modern', 'urbanism' );
		}
        if ( 'trx_sc_events' == $sc ) {
            $list['modern'] = esc_html__('Modern', 'urbanism' );
            $list['alter'] = esc_html__('Alter', 'urbanism' );
        }
        if ( 'trx_widget_instagram' == $sc ) {
            $list['simple'] = esc_html__('Simple', 'urbanism' );
            $list['alter'] = esc_html__('Alter', 'urbanism' );
            $list['modern'] = esc_html__('Modern', 'urbanism' );
        }

        return $list;
	}
}

// Add new params to the default shortcode's atts
if ( ! function_exists( 'urbanism_skin_trx_addons_sc_atts' ) ) {
    add_filter('trx_addons_sc_atts', 'urbanism_skin_trx_addons_sc_atts', 10, 2);
    function urbanism_skin_trx_addons_sc_atts($atts, $sc)  {
        if ( 'trx_sc_skills' == $sc ) {
            $atts['align'] = 'none';
            $atts['show_divider'] = '';
        }
        if ('trx_sc_icons' == $sc ) {
            $atts['link_text'] = '';
        }
        if ( 'trx_sc_services' == $sc ) {
            $atts['show_subtitle'] = '';
        }
        if ( 'trx_sc_layouts' == $sc ) {
            $atts['panel_menu_style'] = '';
            $atts['vertical_menu_style'] = '';
        }
        if ( 'trx_sc_layouts_search' == $sc ) {
            $atts['logo_search'] = 'url';
            $atts['logo_search_retina'] = 'url';
            $atts['scheme_search'] = '';
        }
        if ( 'trx_sc_events' == $sc ) {
            $atts['hide_excerpt'] = '';
            $atts['more_text'] = '';
        }
        return $atts;
    }
}

// Add item params to icons
if ( ! function_exists( 'urbanism_skin_filter_icons_add_param' ) ) {
    add_filter( 'trx_addons_sc_param_group_params', 'urbanism_skin_filter_icons_add_param', 10, 2 );
    function urbanism_skin_filter_icons_add_param( $params, $sc ) {

        if ( in_array( $sc, array( 'trx_sc_icons' ) ) ) {
            if ( isset( $params[0]['name'] ) && isset( $params[0]['label'] ) ) {
                array_splice($params, 6, 0, array( array(
                    'name'        => 'link_text',
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'label'       => esc_html__( 'Link text', 'urbanism' ),
                    'label_block' => false,
                    'default' => esc_html__('Read more', 'urbanism'),
                ) ) );
            }
        }
        return $params;
    }
}


// Add/Remove params
if (!function_exists('urbanism_add_portfolio_params_to_elements')) {
    add_action( 'elementor/element/before_section_end', 'urbanism_add_portfolio_params_to_elements', 11, 3 );
    function urbanism_add_portfolio_params_to_elements($element, $section_id, $args)  {
        if ( is_object( $element ) ) {
            $el_name = $element->get_name();
            if ( 'trx_sc_portfolio' == $el_name  && 'section_sc_portfolio' === $section_id ) {
                $element->remove_control( 'use_masonry' );
                $element->remove_control( 'use_gallery' );

                if ( 'trx_sc_portfolio' == $el_name  && 'section_sc_portfolio' === $section_id ) {
                    $element->add_control(
                        'use_masonry', array(
                            'label' => esc_html__('Use masonry', 'urbanism'),
                            'label_block' => false,
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'label_off' => esc_html__('Off', 'urbanism'),
                            'label_on' => esc_html__('On', 'urbanism'),
                            'return_value' => '1',
                            'condition' => [
                                'type' => ['eclipse']
                            ],
                        )
                    );
                    $element->add_control(
                        'use_gallery', array(
                            'label' => esc_html__('Use gallery', 'urbanism'),
                            'label_block' => false,
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'label_off' => esc_html__('Off', 'urbanism'),
                            'label_on' => esc_html__('On', 'urbanism'),
                            'default' => trx_addons_is_on(trx_addons_get_option('portfolio_use_gallery')) ? '1' : '',
                            'return_value' => '1',
                            'condition' => [
                                'type' => ['eclipse']
                            ],
                        )
                    );
                }

            }
        }
    }
}


// Add/Remove params to the existings sections: use templates as Tab content
if (!function_exists('urbanism_skin_elm_add_params_new_set_after')) {
    add_action('elementor/element/after_section_start', 'urbanism_skin_elm_add_params_new_set_after', 10, 3);
    function urbanism_skin_elm_add_params_new_set_after($element, $section_id, $args)  {
        if (is_object($element)) {
            $el_name = $element->get_name();
            if ('trx_sc_skills' == $el_name && $section_id == 'section_sc_skills') {
                $element->add_control(
                    'align', array(
                        'label_block' => false,
                        'type' => \Elementor\Controls_Manager::SELECT,
                        'label' => __("Skills alignment", 'urbanism'),
                        'options' => array(
                            'none' => esc_html__("Default", 'urbanism'),
                            'left' => esc_html__('Left', 'urbanism'),
                            'center' => esc_html__('Center', 'urbanism'),
                            'right' => esc_html__('Right', 'urbanism'),
                        ),
                        'default' => 'none',
                        'condition' => array(
                            'type' => array('counter','alter','extra', 'simple')
                        )
                    )
                );
            }

            if ('trx_sc_services' == $el_name && $section_id == 'section_sc_services_details') {
                $element->add_control(
                    'show_subtitle', array(
                        'type' => \Elementor\Controls_Manager::SWITCHER,
                        'label' => esc_html__('Subtitle', 'urbanism'),
                        'label_off' => esc_html__('Show', 'urbanism'),
                        'label_on' => esc_html__('Hide', 'urbanism'),
                        'return_value' => '1',
                        'condition' => array(
                            'type' => array('default', 'panel', 'alter', 'extra', 'price', 'price2', 'modern', 'hover', 'breezy', 'creative', 'shine', 'motley', 'classic', 'fashion', 'backward', 'accent', 'strange', 'unusual', 'cool', 'strong', 'minimal')
                        )
                    )
                );
            }
        }
    }
}

// Add Tab section and params to shortcode events
if (!function_exists('urbanism_skin_events_elm_add_params_new_set')) {
    add_action('elementor/element/before_section_start', 'urbanism_skin_events_elm_add_params_new_set', 10, 3);
    function urbanism_skin_events_elm_add_params_new_set($element, $section_id, $args) {

        if (!is_object($element)) return;
        $el_name = $element->get_name();

        // Add control 'More Text' Events
        if ('trx_sc_events' == $el_name && $section_id == 'section_slider_params') {

            $element->start_controls_section(
                'section_sc_events_details', array(
                    'label' => esc_html__('Details', 'urbanism'),
                    'tab' => \Elementor\Controls_Manager::TAB_LAYOUT
                )
            );
            $element->add_control(
                'more_text', array(
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'label' => esc_html__('More text', 'urbanism'),
                    'label_block' => false,
                    'default' => esc_html__('Read more', 'urbanism'),
                    'condition' => array(
                        'type' => array('default', 'classic', 'modern', 'alter')
                    )
                )
            );
            $element->add_control(
                'hide_excerpt', array(
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label' => esc_html__('Hide excerpt', 'urbanism'),
                    'label_off' => __( 'Off', 'urbanism' ),
                    'label_on' => __( 'On', 'urbanism' ),
                    'return_value' => '1',
                    'condition' => array(
                        'type' => array('default', 'classic', 'modern', 'alter')
                    )
                )
            );


            $element->end_controls_section();
        }
    }
}

// Add/Remove params to the existings sections: use templates as Tab content
if (!function_exists('urbanism_elm_add_params_new_set')) {
	add_action( 'elementor/element/before_section_end', 'urbanism_elm_add_params_new_set', 10, 3 );
	function urbanism_elm_add_params_new_set($element, $section_id, $args) {

		if ( ! is_object($element) ) return;
		$el_name = $element->get_name();

		// Add template selector
		if ( $el_name == 'trx_sc_button' && $section_id == 'section_sc_button' ) {
			$control   = $element->get_controls( 'buttons' );
			$fields    = $control['fields'];
			$default   = $control['default'];
			if ( is_array( $default ) ) {
				for( $i=0; $i < count($default); $i++ ) {
					$default[$i]['shadow'] = 0;
				}
			}
			$fields['shadow'] = array(
				'name' => 'shadow',
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label'        => esc_html__( 'Shadow', 'urbanism' ),
				'label_block'  => false,
				'label_off'    => esc_html__( 'Off', 'urbanism' ),
				'label_on'     => esc_html__( 'On', 'urbanism' ),
				'condition'    => array(
					'type' => array('default', 'decoration', 'hover')
				)
			);
			$element->update_control( 'buttons', array(
					'default' => $default,
					'fields' => $fields
				)
			);
		}

		if ( $el_name == 'trx_sc_price' && $section_id == 'section_sc_price' ) {
			$control   = $element->get_controls( 'prices' );
			$fields    = $control['fields'];
			$default   = $control['default'];
			if ( is_array( $default ) ) {
				for( $i=0; $i < count($default); $i++ ) {
					$default[$i]['price_active'] = 0;
				}
			}
			$fields['price_active'] = array(
				'name' => 'price_active',
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label'        => esc_html__( 'Price Active', 'urbanism' ),
				'label_block'  => false,
				'label_off'    => esc_html__( 'Off', 'urbanism' ),
				'label_on'     => esc_html__( 'On', 'urbanism' ),
			);
			$element->update_control( 'prices', array(
					'default' => $default,
					'fields' => $fields
				)
			);
		}

		if ( $section_id == 'section_sc_title' ) {
			$element->add_control( 'sc_button_shadow', array(
				'label_block'  => false,
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label' => esc_html__("Shadow", 'urbanism'),
				'label_on' => esc_html__( 'On', 'urbanism' ),
				'label_off' => esc_html__( 'Off', 'urbanism' ),
				'condition'    => array(
					'link_style' => array('default', 'decoration', 'hover')
				)
			) );
		}

        if ('trx_sc_skills' == $el_name && $section_id == 'section_sc_skills') {
            $element->add_control(
                'show_divider', array(
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label' => esc_html__('Skills divider', 'urbanism'),
                    'label_on' => esc_html__( 'On', 'urbanism' ),
                    'label_off' => esc_html__( 'Off', 'urbanism' ),
                    'return_value' => '1',
                    'condition' => array(
                        'type' => array('alter', 'simple')
                    )
                )
            );
        }

        if ('trx_sc_services' == $el_name && $section_id == 'section_sc_services') {
            $element->update_control(
                'featured', array(
                    'description' => wp_kses_data( __('Please note: some options might be incompatible with certain layouts.', 'urbanism') ),
                    'condition' => [
                        'type' => ['default', 'panel', 'alter', 'extra', 'price', 'price2', 'modern', 'breezy', 'cool', 'creative', 'shine', 'motley', 'classic', 'fashion', 'backward', 'accent', 'unusual', 'strong', 'minimal', 'callouts', 'hover', 'light', 'list', 'iconed', 'tabs', 'tabs_simple']
                    ],
                )
            );
            $element->update_control(
                'featured_position', array(
                    'description' => '',
                    'condition' => [
                        'type' => ['default', 'modern', 'callouts', 'light', 'list', 'iconed', 'tabs', 'tabs_simple']
                    ],
                )
            );
            $element->update_responsive_control(
                'columns', array(
                    'condition' => [
                        'type' => ['default', 'panel', 'alter', 'extra', 'price', 'price2', 'modern', 'breezy', 'cool', 'creative', 'shine', 'motley', 'classic', 'fashion', 'backward', 'accent', 'strange', 'unusual', 'strong', 'minimal', 'callouts', 'light', 'list', 'iconed', 'hover', 'chess']
                    ],
                )
            );

        }

        if ('trx_sc_services' == $el_name && $section_id == 'section_slider_params') {
            $element->update_control(
                'slider', array(
                    'condition' => [
                        'type' => ['default', 'alter', 'extra', 'price', 'price2', 'modern', 'breezy', 'cool', 'creative', 'shine', 'motley', 'classic', 'fashion', 'backward', 'accent', 'strange', 'unusual', 'strong', 'minimal', 'callouts', 'light', 'list', 'iconed', 'hover', 'chess']
                    ],
                )
            );
        }
        if ('trx_sc_services' == $el_name && $section_id == 'section_sc_services_details') {
            $element->update_control(
                'more_text', array(
                    'condition' => [
                        'type' => ['default', 'panel', 'alter', 'extra', 'price', 'price2', 'modern', 'shine', 'motley', 'classic', 'backward', 'accent', 'strange', 'unusual', 'cool', 'strong', 'minimal', 'chess', 'callouts', 'light', 'list', 'iconed', 'tabs', 'tabs_simple', 'timeline']
                    ],
                )
            );
            $element->update_control(
                'hide_bg_image', array(
                    'description' => '',
                    'condition' => [
                        'type' => ['shine', 'motley', 'breezy', 'cool', 'creative', 'hover', 'classic', 'fashion', 'extra', 'strong', 'minimal']
                    ],
                )
            );
        }
        /* Add control for filter blogger */
        if ( 'trx_sc_blogger' == $el_name  && 'section_sc_blogger' === $section_id ) {
            $element->add_control(
                'filter_style', array(
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'label' => esc_html__( "Filter style", 'urbanism' ),
                    'label_block' => false,
                    'options' => array(
                        'default' => esc_html__('Default', 'urbanism'),
                        'toggle' => esc_html__('Toggle', 'urbanism'),
                    ),
                    'default' => 'default',
                    'prefix_class' => 'sc_style_',
                    'condition' => ['filters_tabs_position' => 'top'],
                )
            );
        }

        if ('trx_sc_layouts' == $el_name && $section_id == 'section_sc_layouts') {
            $element->update_control(
                'popup_id', array(
                    'condition' => array(
                        'type' => array('popup', 'panel', 'panel-menu')
                    )
                )
            );

            $element->add_control(
                'panel_menu_style', array(
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'label' => esc_html__( 'Select panel menu style', 'urbanism' ),
                    'label_block' => false,
                    'options' => array(
                        'fullscreen' => esc_html__('Fullscreen', 'urbanism'),
                        'narrow' => esc_html__('Narrow', 'urbanism'),
                    ),
                    'default' => 'fullscreen',
                    'condition' => array(
                         'type' => array('panel-menu')
                    )
                )
            );
            $element->add_control(
                'vertical_menu_style', array(
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'label' => esc_html__( 'Select vertical menu style', 'urbanism' ),
                    'description' => esc_html__( 'If the vertical menu(dropdown) in the "Panel menu" is used, then some styles are applied to it', 'urbanism' ),
                    'label_block' => false,
                    'options' => array(
                        'default' => esc_html__('Default', 'urbanism'),
                        'extra' => esc_html__('Extra', 'urbanism'),
                    ),
                    'default' => 'default',
                    'condition' => array(
                        'type' => array('panel-menu')
                    )
                )
            );
        }
        //Search controls & dependencies
        if ('trx_sc_layouts_search' == $element->get_name() && 'section_sc_layouts_search' == $section_id) {

            $element->update_control(
                'style',
                [
                    'condition' => [
                        'type' => ['default'],
                    ]
                ]
            );

            $element->add_control(
                'logo_search', array(
                    'label' => esc_html__( 'Logo', 'urbanism' ),
                    'description' => esc_html__( "Select or upload image for site's logo. If empty - theme-specific logo is used", 'urbanism'),
                    'type' => \Elementor\Controls_Manager::MEDIA,
                    'default' => array(
                        'url' => ''
                    ),
                    'condition' => array(
                        'type' => array('modern')
                    )
                )
            );

            $element->add_control(
                'logo_search_retina', array(
                    'label' => esc_html__( 'Logo Retina', 'urbanism' ),
                    'description' => esc_html__( "Select or upload image for site's logo on the Retina displays", 'urbanism'),
                    'type' => \Elementor\Controls_Manager::MEDIA,
                    'default' => array(
                        'url' => ''
                    ),
                    'condition' => array(
                        'type' => array('modern')
                    )
                )
            );

            $element->add_control(
                'scheme_search', array(
                    'type'         => \Elementor\Controls_Manager::SELECT,
                    'label'        => esc_html__( 'Search Color scheme', 'urbanism' ),
                    'label_block'  => false,
                    'options'      => urbanism_array_merge( array( '' => esc_html__( 'Inherit', 'urbanism' ) ), urbanism_get_list_schemes() ),
                    'render_type'  => 'template',	// ( none | ui | template ) - reload template after parameter is changed
                    'default'      => '',
                    'condition' => array(
                        'type' => array('modern')
                    )
                )
            );


        }

		/* categories list */
		if ('trx_widget_categories_list' == $el_name && $section_id == 'section_sc_categories_list') {
			$element->update_control(
				'show_thumbs', array(
					'condition' => [
						'style' => [1, '1', '2', '3']
					],
				)
			);
			$element->update_control(
				'columns', array(
					'condition' => [
						'style' => [1, '1', '2', '3', '4', '5', '6']
					],
				)
			);
		}

        /* Portfolio Fill Hide Columns */
        if ('trx_sc_portfolio' == $el_name && $section_id == 'section_sc_portfolio') {
            $element->update_control(
                'columns', array(
                    'condition' => [
                        'type' => ['default', 'eclipse', 'band', 'extra']
                    ],
                )
            );
            $element->update_control(
                'more_text', array(
                    'condition' => [
                        'type' => ['band']
                    ],
                )
            );
        }
        /* Hide style 'List' in Trx Booked Calendar layout */
        if ('trx_sc_booked_calendar' == $el_name && $section_id == 'section_sc_booked') {
            $element->update_control(
                'style', array(
                    'options' => [
                        'calendar' => esc_html__('Calendar', 'urbanism'),
                    ],
                )
            );
        }

        /* Columns gap dependencies */
        if ('trx_widget_instagram' == $el_name && $section_id == 'section_sc_instagram') {
            $element->update_control(
                'columns_gap', array(
                    'condition' => [
                        'type' => ['default', 'simple']
                    ],
                )
            );
        }
        /*
        if ('trx_widget_slider' == $el_name && $section_id == 'section_sc_slider_controller' ) {
            $element->update_control(
                'controller_height', array(
                    'label' => wp_kses_data( __('Min. height of the TOC', 'urbanism') ),
                )
            );
        }
        if ('trx_widget_slider' == $el_name && $section_id == 'section_sc_slider_controller' ) {
            $element->update_control(
                'controller_effect', array(
                    'description' => wp_kses_data( __('Please note: some effects might be incompatible with multiple items per view.', 'urbanism') ),
                )
            );
        }
        if ('trx_widget_controller' == $el_name && $section_id == 'section_sc_slider_controller' ) {
            $element->update_control(
                'effect', array(
                    'description' => wp_kses_data( __('Please note: some effects might be incompatible with multiple items per view.', 'urbanism') ),
                )
            );
        }
        */
  	}
}

// Substitute tab content with layout
if (!function_exists('urbanism_elm_add_params_class_new_set')) {
	add_filter( 'elementor/widget/render_content', 'urbanism_elm_add_params_class_new_set', 10, 2 );
	function urbanism_elm_add_params_class_new_set($html, $element) {
		if ( is_object($element) ) {
			$el_name = $element->get_name();
			$settings = $element->get_settings();
			if ( $el_name == 'trx_sc_button' ) {
				if ( is_array( $settings['buttons'] ) ) {
					foreach( $settings['buttons'] as $k => $tab ) {
						if ( ! empty( $tab['shadow'] ) && ($tab['type'] == 'default' || $tab['type'] == 'decoration' || $tab['type'] == 'hover') ) {
							$parts = explode( 'class="sc_button ', $html );
							$parts[ $k + 1 ] = 'sc_button_shadow ' . $parts[ $k + 1 ];
							$html = join( 'class="sc_button ', $parts );
						}
					}
				}
			}

			if ( $el_name == 'trx_sc_price' ) {
				if ( is_array( $settings['prices'] ) ) {
					foreach( $settings['prices'] as $k => $tab ) {
						if ( ! empty( $tab['price_active'] ) ) {
							$parts = explode( 'class="sc_price_item ', $html );
							$parts[ $k + 1 ] = 'sc_price_active ' . $parts[ $k + 1 ];
							$html = join( 'class="sc_price_item ', $parts );
						}
					}
				}
			}

			$settings = $element->get_settings();
			if ( ! empty( $settings['sc_button_shadow'] ) ) {
				$html = preg_replace('/(class="sc_button sc_button_)(default|hover|decoration) /', '$1$2 sc_button_shadow ', $html);
			}

		}
		return $html;
	}
}
// Enqueue script tilt for some Shortcodes
if ( ! function_exists( 'urbanism_skin_filter_trx_addons_sc_output' ) ) {
    add_filter('trx_addons_sc_output', 'urbanism_skin_filter_trx_addons_sc_output', 10, 4);
    function urbanism_skin_filter_trx_addons_sc_output($output, $sc, $atts, $content)   {
        if (
        	( 'trx_sc_services' == $sc && ( 'hover' == $atts['type'] || 'creative' == $atts['type'] ) )
		  	|| ( 'trx_sc_team' == $sc && ( '3d' == $atts['type'] || '3d-simple' == $atts['type'] ) )
		) {
            wp_enqueue_script('tilt', urbanism_get_file_url('js/tilt/vanilla-tilt.min.js'), array('jquery'), null, true);
        }
        // Change Output Panel Menu
        if  ( 'trx_sc_layouts' == $sc && 'panel-menu' == $atts['type'] ) {
            trx_addons_add_inline_html($output);
            return '';
        }

        return $output;
    }
}

// Add parameter to the list controls styles
if ( ! function_exists( 'urbanism_skin_filter_get_list_sc_slider_controls_styles' ) ) {
	add_filter( 'trx_addons_filter_get_list_sc_slider_controls_styles', 'urbanism_skin_filter_get_list_sc_slider_controls_styles', 10, 2 );
	function urbanism_skin_filter_get_list_sc_slider_controls_styles( $list ) {
		$list['light'] = esc_html__( 'Light', 'urbanism' );
		$list['alter'] = esc_html__( 'Alter', 'urbanism' );
		return $list;
	}
}
// Add parameter to the list controls styles
if ( ! function_exists( 'urbanism_skin_filter_get_list_sc_slider_paginations_types' ) ) {
	//add_filter( 'trx_addons_filter_get_list_sc_slider_paginations_types', 'urbanism_skin_filter_get_list_sc_slider_paginations_types', 10 );
	add_filter( 'trx_addons_filter_get_list_sc_slider_controls_paginations_types', 'urbanism_skin_filter_get_list_sc_slider_paginations_types', 10 );
	function urbanism_skin_filter_get_list_sc_slider_paginations_types( $list ) {
		$list['title'] = esc_html__( 'Title', 'urbanism' );
		return $list;
	}
}


// Add parameter to the list layouts type
if ( ! function_exists( 'urbanism_skin_filter_get_list_sc_layouts_type' ) ) {
    add_filter( 'trx_addons_filter_get_list_sc_layouts_type', 'urbanism_skin_filter_get_list_sc_layouts_type', 10, 2 );
    function urbanism_skin_filter_get_list_sc_layouts_type( $list ) {
        $list['panel-menu'] = esc_html__( 'Panel Menu', 'urbanism' );
        return $list;
    }
}

// Add parameter to the list Extend background
if ( ! function_exists( 'urbanism_skin_filter_get_list_sc_content_extra_bg' ) ) {
	add_filter( 'trx_addons_filter_get_list_sc_content_extra_bg', 'urbanism_skin_filter_get_list_sc_content_extra_bg', 10, 2 );
	function urbanism_skin_filter_get_list_sc_content_extra_bg( $list ) {
		$list['large_left'] = esc_html__( 'Large Left', 'urbanism' );
		$list['extra_left'] = esc_html__( 'Extra Left', 'urbanism' );
		$list['large_right'] = esc_html__( 'Large Right', 'urbanism' );
		return $list;
	}
}
// Remove 'Bottom' item from list Services
if ( ! function_exists( 'urbanism_skin_filter_get_list_sc_services_featured_positions' ) ) {
    add_filter( 'trx_addons_filter_get_list_sc_services_featured_positions', 'urbanism_skin_filter_get_list_sc_services_featured_positions', 10, 2 );
    function urbanism_skin_filter_get_list_sc_services_featured_positions( $list ) {
        unset( $list['bottom'] );
        return $list;
    }
}

// Show post link 'Read more' in the blog posts
if ( ! function_exists( 'urbanism_show_post_more_link' ) ) {
	function urbanism_show_post_more_link( $args = array(), $otag='', $ctag='' ) {
		if ( ! isset( $args['more_button'] ) || $args['more_button'] ) {
			urbanism_show_layout(
				'<a class="post-more-link" href="' . esc_url( get_permalink() ) . '"><span class="link-text">'
				. ( ! empty( $args['more_text'] )
					? esc_html( $args['more_text'] )
					: esc_html__( 'Read More', 'urbanism' )
				)
				. '</span><span class="more-link-icon"></span></a>',
				$otag,
				$ctag
			);
		}
	}
}


if (!function_exists('urbanism_elm_add_script')) {
	add_filter( 'elementor/frontend/widget/before_render', 'urbanism_elm_add_script', 10, 2 );
	function urbanism_elm_add_script($content, $widget=null) {
			$setting_class = $content->get_settings('_css_classes');
			$cheack = strpos($setting_class, 'VanillaTiltHover');    
			if(isset($cheack) && $cheack !== false) {
				wp_enqueue_script('tilt', urbanism_get_file_url('js/tilt/vanilla-tilt.min.js'), array('jquery'), null, true);
			}
		return $content;
	}
}


// Add default prefix in Blogger toggle filter
if (!function_exists('urbanism_localize_scripts_skin')) {
    add_filter( 'urbanism_filter_localize_script', 'urbanism_localize_scripts_skin', 2 );
    function urbanism_localize_scripts_skin($arg) {
        $arg['toggle_title'] = esc_html__( "Filter by ", 'urbanism' );
        return $arg;
    }
}


// Add cat_sep in meta single
if (!function_exists('urbanism_filter_post_meta_args_single')) {
	add_filter( 'urbanism_filter_post_meta_args', 'urbanism_filter_post_meta_args_single', 2, 2 );
	function urbanism_filter_post_meta_args_single($arg, $type) {
		if('single' == $type)
			$arg['cat_sep'] = false;
		return $arg;
	}
}


// cpt_team -> wrap contact form fns info des
if ( !function_exists( 'urbanism_cpt_team_contact_form_after_article_before' ) ) {
	add_action('trx_addons_action_after_article', 'urbanism_cpt_team_contact_form_after_article_before', 49, 2);
	function urbanism_cpt_team_contact_form_after_article_before( $mode, $out='' ) {
		if ($mode == 'team.single') {
			$class = "comments_close";
			if ( comments_open() || get_comments_number() ) {
				$class = "comments_open";
			}
			urbanism_show_layout('<section class="team_page_wrap_info '.esc_attr($class).'"><div class="team_page_wrap_info_over">'.$out);
		}
	}
}
if ( !function_exists( 'urbanism_cpt_team_contact_form_after_article_after' ) ) {
	add_action('trx_addons_action_after_article', 'urbanism_cpt_team_contact_form_after_article_after', 51, 1);
	function urbanism_cpt_team_contact_form_after_article_after( $mode ) {
		if ($mode == 'team.single') {
			echo '</div></section>';
		}
	}
}
if ( !function_exists( 'urbanism_cpt_team_contact_form_posts_title' ) ) {
	add_filter('trx_addons_filter_team_posts_title', 'urbanism_cpt_team_contact_form_posts_title');
	function urbanism_cpt_team_contact_form_posts_title() {
		return esc_html__( "Contact Form", 'urbanism' );
	}
}

// Return tag SVG from specified file
if (!function_exists('urbanism_get_svg_from_file')) {
	function urbanism_get_svg_from_file($svg) {
		$content = urbanism_fgc($svg);
		preg_match("#<\s*?svg\b[^>]*>(.*?)</svg\b[^>]*>#s", $content, $matches);
		return !empty($matches[0]) ? str_replace(array("\r", "\n"), array('', ' '), $matches[0]) : '';
	}
}

// Modified Scroll To Top
if (!function_exists('urbanism_skin_filter_scroll_to_top')) {
    add_filter('trx_addons_filter_scroll_to_top', 'urbanism_skin_filter_scroll_to_top');
    function urbanism_skin_filter_scroll_to_top( $output ) {
        if ( urbanism_get_theme_option( 'scroll_to_top_style') == 'modern' )  {
            $output = '<a href="#" class="trx_addons_scroll_to_top scroll_to_top_style_' . esc_attr(urbanism_get_theme_option( 'scroll_to_top_style')) . esc_attr(urbanism_is_on(urbanism_get_theme_option('scroll_to_top_scheme_watchers')) ? ' watch_scheme' : '') . '" title="' . esc_attr__('Scroll to top', 'urbanism') . '">'
                      . '<span class="scroll_to_top_text">' . esc_html__('Go to Top', 'urbanism') . '</span>'
                      . '<span class="scroll_to_top_icon"></span>'
                      . '</a>';

        } else {
            $output = '<a href="#" class="trx_addons_scroll_to_top trx_addons_icon-up scroll_to_top_style_' . esc_attr(urbanism_get_theme_option( 'scroll_to_top_style')) . '" title="' . esc_attr__('Scroll to top', 'urbanism') . '">'
                      . ( ! empty( $type )
                          ? '<span class="trx_addons_scroll_progress trx_addons_scroll_progress_type_' . esc_attr( $type ) . '"></span>'
                          : ''
                        )
                      . '</a>';
        }
        return $output;
    }
}

// Add sticky socials
if ( !function_exists( 'urbanism_skin_wp_footer' ) ) {
    add_action('wp_footer', 'urbanism_skin_wp_footer');
    function urbanism_skin_wp_footer() {

        if (( urbanism_exists_trx_addons() && trx_addons_get_socials_links() != '') && urbanism_is_on( urbanism_get_theme_option( 'sticky_socials' ) ) ) {

            $wrap_start = '<div class="sticky_socials_wrap sticky_socials_' . esc_attr( urbanism_get_theme_option( 'sticky_socials_style' ) ) . esc_attr( urbanism_is_on( urbanism_get_theme_option( 'sticky_socials_scheme_watchers' ) ) ? ' watch_scheme' : '') . '">';
            $wrap_end   = '</div>';

            if ( urbanism_get_theme_option( 'sticky_socials_style' ) == 'modern' ) {
                // Social icons
                urbanism_show_layout(trx_addons_get_socials_links($style = 'icons', $show = 'icons_names'),
                    $wrap_start, $wrap_end);
            } else {
                urbanism_show_layout(trx_addons_get_socials_links($style = 'icons', $show = 'icons'),
                    $wrap_start, $wrap_end);
            }
        }
    }
}


// Detect blog mode 404
if (!function_exists('urbanism_filter_detect_blog_mode_404')) {
	add_filter( 'urbanism_filter_detect_blog_mode', 'urbanism_filter_detect_blog_mode_404' );
	function urbanism_filter_detect_blog_mode_404($mode) {
		return is_404() ? '404' : $mode;
	}
}

// TweenMax library for 404
if (!function_exists('trx_addons_filter_load_tweenmax_404')) {
	add_filter('trx_addons_filter_load_tweenmax', 'trx_addons_filter_load_tweenmax_404');
	function trx_addons_filter_load_tweenmax_404($status) {
		return is_404() ? true : $status;
	}
}
// Add single portfolio navigation
if ( !function_exists( 'urbanism_single_portfolio_navigation' ) ) {
    add_filter('trx_addons_action_after_article', 'urbanism_single_portfolio_navigation');
    function urbanism_single_portfolio_navigation( $args ) {
        if( urbanism_get_theme_option( 'cpt_navigation_portfolio' ) && 'portfolio.single' == $args ) {
            $post_nav = get_the_post_navigation( array(
                'next_text' => '<span class="meta-nav" aria-hidden="true">' . esc_html__('Next Project', 'urbanism') . '</span> ',
                'prev_text' => '<span class="meta-nav" aria-hidden="true">' . esc_html__('Prev Project', 'urbanism') . '</span> ',
            ) );
            urbanism_show_layout($post_nav);
        }
    }
}
// Display begin of the slider layout for some shortcodes
if (!function_exists('urbanism_skin_filter_sc_show_slider_args')) {
    add_filter( 'trx_addons_filter_sc_show_slider_args', 'urbanism_skin_filter_sc_show_slider_args' );
    function urbanism_skin_filter_sc_show_slider_args( $args = array() ) {
        if ('sc_events' == $args['sc']) {
            $args['args']['slides_min_width'] = 220;
        }
        if ('sc_portfolio' == $args['sc']) {
            $args['args']['slides_min_width'] = 220;
        }
        return  $args;
    }
}

// Remove input hover effects
if ( !function_exists( 'urbanism_skin_filter_get_list_input_hover' ) ) {
    add_filter( 'trx_addons_filter_get_list_input_hover', 'urbanism_skin_filter_get_list_input_hover');
    function urbanism_skin_filter_get_list_input_hover($list) {
        unset($list['accent']);
        unset($list['path']);
        unset($list['jump']);
        unset($list['underline']);
        unset($list['iconed']);
        return $list;
    }
}

// Add new image's hovers
if ( ! function_exists( 'urbanism_skin_filter_get_list_hovers' ) ) {
	add_filter(	'urbanism_filter_list_hovers', 'urbanism_skin_filter_get_list_hovers' );
	function urbanism_skin_filter_get_list_hovers( $list ) {
		$list['link'] = esc_html__( 'Link', 'urbanism' );
		return $list;
	}
}

// New Functions
//--------------------------------------------------
if ( ! function_exists( 'urbanism_skin_theme_specific_setup9' ) ) {
    add_action( 'after_setup_theme', 'urbanism_skin_theme_specific_setup9', 9 );
    function urbanism_skin_theme_specific_setup9() {
        if ( urbanism_exists_trx_addons() ) {
            remove_action( 'trx_addons_action_before_single_post_video', 'trx_addons_cpt_post_before_video_sticky' );
        }
    }
}
// Open wrapper around single post video
if (!function_exists('urbanism_skin_trx_addons_cpt_post_before_video_sticky')) {
    add_action( 'trx_addons_action_before_single_post_video', 'urbanism_skin_trx_addons_cpt_post_before_video_sticky', 10, 1 );
    function urbanism_skin_trx_addons_cpt_post_before_video_sticky( $args = array() ) {
        if ( ! empty( $args['singular'] ) || ! empty( $args['singular_extra'] ) ) {
            $post_meta = get_post_meta( get_the_ID(), 'trx_addons_options', true );
            if ( ! empty( $post_meta['video_sticky'] ) ) {
                ?>
                <div class="trx_addons_video_sticky">
                <div class="trx_addons_video_sticky_inner">
                <h5 class="trx_addons_video_sticky_title">
                    <?php echo esc_html(get_the_title(get_the_ID())); ?></h5>
                <?php
                $GLOBALS['TRX_ADDONS_STORAGE']['video_sticky_opened'] = true;
            }
        }
    }
}

// Display prices with tags in ALL places
if ( false && ! function_exists( 'urbanism_skin_trx_addons_filter_custom_meta_value_strip_tags_new' ) ) {
    add_filter( 'trx_addons_filter_custom_meta_value_strip_tags', 'urbanism_skin_trx_addons_filter_custom_meta_value_strip_tags_new', 11, 3 );
    function urbanism_skin_trx_addons_filter_custom_meta_value_strip_tags_new( $arr, $key, $value ) {
		foreach ($arr as $k => $v) 
    		if ($v === 'price') unset($arr[$k]);
        return $arr;
    }
}

// Change "load more" button text 
if ( ! function_exists( 'urbanism_skin_load_more_text_new' ) ) {
    add_filter( 'urbanism_filter_load_more_text', 'urbanism_skin_load_more_text_new' );
    function urbanism_skin_load_more_text_new() {
		$text = esc_html__('Load More', 'urbanism');
        return $text;
    }
}

// Change option 'Not selected' for all tag select
if ( ! function_exists( 'urbanism_skin_not_selected_mask' ) ) {
    add_filter( 'trx_addons_filter_not_selected_mask', 'urbanism_skin_not_selected_mask' );
    function urbanism_skin_not_selected_mask() {
        return __( '%s', 'urbanism' );
    }
}

// Activation methods
if ( ! function_exists( 'urbanism_skin_filter_activation_methods' ) ) {
    add_filter( 'trx_addons_filter_activation_methods', 'urbanism_skin_filter_activation_methods', 10, 1 );
    function urbanism_skin_filter_activation_methods( $args ) {
        $args['elements_key'] = false;
        return $args;
    }
}