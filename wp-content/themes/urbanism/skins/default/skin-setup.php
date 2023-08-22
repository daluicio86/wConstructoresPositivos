<?php
/**
 * Skin Setup
 *
 * @package URBANISM
 * @since URBANISM 1.76.0
 */


//--------------------------------------------
// SKIN DEFAULTS
//--------------------------------------------

// Return theme's (skin's) default value for the specified parameter
if ( ! function_exists( 'urbanism_theme_defaults' ) ) {
	function urbanism_theme_defaults( $name='', $value='' ) {
		$defaults = array(
			'page_width'          => 1290,
			'page_boxed_extra'  => 60,
			'page_fullwide_max' => 1920,
			'page_fullwide_extra' => 130,
			'sidebar_width'       => 410,
			'sidebar_gap'       => 40,
			'grid_gap'          => 30,
			'rad'               => 0,
		);
		if ( empty( $name ) ) {
			return $defaults;
		} else {
			if ( empty( $value ) && isset( $defaults[ $name ] ) ) {
				$value = $defaults[ $name ];
			}
			return $value;
		}
	}
}



// Theme init priorities:
// Action 'after_setup_theme'
// 1 - register filters to add/remove lists items in the Theme Options
// 2 - create Theme Options
// 3 - add/remove Theme Options elements
// 5 - load Theme Options. Attention! After this step you can use only basic options (not overriden)
// 9 - register other filters (for installer, etc.)
//10 - standard Theme init procedures (not ordered)
// Action 'wp_loaded'
// 1 - detect override mode. Attention! Only after this step you can use overriden options (separate values for the shop, courses, etc.)


//--------------------------------------------
// SKIN SETTINGS
//--------------------------------------------
if ( ! function_exists( 'urbanism_skin_setup' ) ) {
	add_action( 'after_setup_theme', 'urbanism_skin_setup', 1 );
	function urbanism_skin_setup() {

		$GLOBALS['URBANISM_STORAGE'] = array_merge( $GLOBALS['URBANISM_STORAGE'], array(

			// Key validator: market[env|loc]-vendor[axiom|ancora|themerex]
			'theme_pro_key'       => 'env-axiom',

			'theme_doc_url'       => '//urbanism.axiomthemes.com/doc',

			'theme_demofiles_url' => '//demofiles.axiomthemes.com/urbanism/',
			
			'theme_rate_url'      => '//themeforest.net/download',

			'theme_custom_url'    => '//themerex.net/offers/?utm_source=offers&utm_medium=click&utm_campaign=themeinstall',

			'theme_support_url'   => '//themerex.net/support/',

			'theme_download_url'  => '//themeforest.net/item/urbanism-multipurpose-business-wordpress-theme/29678687',        // Axiom

			'theme_video_url'     => '//www.youtube.com/channel/UCdIjRh7-lPVHqTTKpaf8PLA',   // Axiom

			'theme_privacy_url'   => '//axiomthemes.com/privacy-policy/',                   // Axiom

			'portfolio_url'       => '//themeforest.net/user/axiomthemes/portfolio',        // Axiom

			// Comma separated slugs of theme-specific categories (for get relevant news in the dashboard widget)
			// (i.e. 'children,kindergarten')
			'theme_categories'    => '',
		) );
	}
}


// Add/remove/change Theme Settings
if ( ! function_exists( 'urbanism_skin_setup_settings' ) ) {
	add_action( 'after_setup_theme', 'urbanism_skin_setup_settings', 1 );
	function urbanism_skin_setup_settings() {
		// Example: enable (true) / disable (false) thumbs in the prev/next navigation
		urbanism_storage_set_array( 'settings', 'thumbs_in_navigation', false );
	}
}



//--------------------------------------------
// SKIN FONTS
//--------------------------------------------
if ( ! function_exists( 'urbanism_skin_setup_fonts' ) ) {
	add_action( 'after_setup_theme', 'urbanism_skin_setup_fonts', 1 );
	function urbanism_skin_setup_fonts() {
		// Fonts to load when theme start
		// It can be:
		// - Google fonts (specify name, family and styles)
		// - Adobe fonts (specify name, family and link URL)
		// - uploaded fonts (specify name, family), placed in the folder css/font-face/font-name inside the skin folder
		// Attention! Font's folder must have name equal to the font's name, with spaces replaced on the dash '-'
		// example: font name 'TeX Gyre Termes', folder 'TeX-Gyre-Termes'
		urbanism_storage_set(
			'load_fonts', array(
				array(
					'name'   => 'DM Sans',
					'family' => 'sans-serif',
					'link'   => '',
					'styles' => 'ital,wght@0,400;0,500;0,700;1,400;1,500;1,700'
				),
				array(
					'name'   => 'termina',
					'family' => 'sans-serif',
					'link'   => 'https://use.typekit.net/zau2ogq.css',
					'styles' => ''
				),
			)
		);

		// Characters subset for the Google fonts. Available values are: latin,latin-ext,cyrillic,cyrillic-ext,greek,greek-ext,vietnamese
		urbanism_storage_set( 'load_fonts_subset', 'latin,latin-ext' );

		// Settings of the main tags.
		// Default value of 'font-family' may be specified as reference to the array $load_fonts (see above)
		// or as comma-separated string.
		// In the second case (if 'font-family' is specified manually as comma-separated string):
		//    1) Font name with spaces in the parameter 'font-family' will be enclosed in the quotes and no spaces after comma!
		//    2) If font-family inherit a value from the 'Main text' - specify 'inherit' as a value
		// example:
		// Correct:   'font-family' => basekit_get_load_fonts_family_string( $load_fonts[0] )
		// Correct:   'font-family' => 'Roboto,sans-serif'
		// Correct:   'font-family' => '"PT Serif",sans-serif'
		// Incorrect: 'font-family' => 'Roboto, sans-serif'
		// Incorrect: 'font-family' => 'PT Serif,sans-serif'

		$font_description = esc_html__( 'Font settings for the %s of the site. To ensure that the elements scale properly on mobile devices, please use only the following units: "rem", "em" or "ex"', 'urbanism' );

		urbanism_storage_set(
			'theme_fonts', array(
				'p'       => array(
					'title'           => esc_html__( 'Main text', 'urbanism' ),
					'description'     => sprintf( $font_description, esc_html__( 'main text', 'urbanism' ) ),
					'font-family'     => '"DM Sans",sans-serif',
					'font-size'       => '1rem',
					'font-weight'     => '400',
					'font-style'      => 'normal',
					'line-height'     => '1.647em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0px',
					'margin-top'      => '0em',
					'margin-bottom'   => '1.65em',
				),
				'post'    => array(
					'title'           => esc_html__( 'Article text', 'urbanism' ),
					'description'     => sprintf( $font_description, esc_html__( 'article text', 'urbanism' ) ),
					'font-family'     => '',			// Example: '"PR Serif",serif',
					'font-size'       => '',			// Example: '1.286rem',
					'font-weight'     => '',			// Example: '400',
					'font-style'      => '',			// Example: 'normal',
					'line-height'     => '',			// Example: '1.75em',
					'text-decoration' => '',			// Example: 'none',
					'text-transform'  => '',			// Example: 'none',
					'letter-spacing'  => '',			// Example: '',
					'margin-top'      => '',			// Example: '0em',
					'margin-bottom'   => '',			// Example: '1.4em',
				),
				'h1'      => array(
					'title'           => esc_html__( 'Heading 1', 'urbanism' ),
					'description'     => sprintf( $font_description, esc_html__( 'tag H1', 'urbanism' ) ),
					'font-family'     => 'termina,sans-serif',
					'font-size'       => '3.353rem',
					'font-weight'     => '600',
					'font-style'      => 'normal',
					'line-height'     => '1em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => 'normal',
					'margin-top'      => '1.1em',
					'margin-bottom'   => '0.43em',
				),
				'h2'      => array(
					'title'           => esc_html__( 'Heading 2', 'urbanism' ),
					'description'     => sprintf( $font_description, esc_html__( 'tag H2', 'urbanism' ) ),
					'font-family'     => 'termina,sans-serif',
					'font-size'       => '2.765rem',
					'font-weight'     => '600',
					'font-style'      => 'normal',
					'line-height'     => '1.021em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => 'normal',
					'margin-top'      => '0.76em',
					'margin-bottom'   => '0.48em',
				),
				'h3'      => array(
					'title'           => esc_html__( 'Heading 3', 'urbanism' ),
					'description'     => sprintf( $font_description, esc_html__( 'tag H3', 'urbanism' ) ),
					'font-family'     => 'termina,sans-serif',
					'font-size'       => '2.059rem',
					'font-weight'     => '600',
					'font-style'      => 'normal',
					'line-height'     => '1.086em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => 'normal',
					'margin-top'      => '1.12em',
					'margin-bottom'   => '0.65em',
				),
				'h4'      => array(
					'title'           => esc_html__( 'Heading 4', 'urbanism' ),
					'description'     => sprintf( $font_description, esc_html__( 'tag H4', 'urbanism' ) ),
					'font-family'     => 'termina,sans-serif',
					'font-size'       => '1.647rem',
					'font-weight'     => '600',
					'font-style'      => 'normal',
					'line-height'     => '1.214em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => 'normal',
					'margin-top'      => '1.15em',
					'margin-bottom'   => '0.83em',
				),
				'h5'      => array(
					'title'           => esc_html__( 'Heading 5', 'urbanism' ),
					'description'     => sprintf( $font_description, esc_html__( 'tag H5', 'urbanism' ) ),
					'font-family'     => 'termina,sans-serif',
					'font-size'       => '1.412rem',
					'font-weight'     => '600',
					'font-style'      => 'normal',
					'line-height'     => '1.208em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => 'normal',
					'margin-top'      => '1.3em',
					'margin-bottom'   => '0.84em',
				),
				'h6'      => array(
					'title'           => esc_html__( 'Heading 6', 'urbanism' ),
					'description'     => sprintf( $font_description, esc_html__( 'tag H6', 'urbanism' ) ),
					'font-family'     => 'termina,sans-serif',
					'font-size'       => '1.118rem',
					'font-weight'     => '600',
					'font-style'      => 'normal',
					'line-height'     => '1.474em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => 'normal',
					'margin-top'      => '1.75em',
					'margin-bottom'   => '1.1em',
				),
				'logo'    => array(
					'title'           => esc_html__( 'Logo text', 'urbanism' ),
					'description'     => sprintf( $font_description, esc_html__( 'text of the logo', 'urbanism' ) ),
					'font-family'     => 'termina,sans-serif',
					'font-size'       => '1.7rem',
					'font-weight'     => '600',
					'font-style'      => 'normal',
					'line-height'     => '1.25em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0px',
				),
				'button'  => array(
					'title'           => esc_html__( 'Buttons', 'urbanism' ),
					'description'     => sprintf( $font_description, esc_html__( 'buttons', 'urbanism' ) ),
					'font-family'     => 'termina,sans-serif',
					'font-size'       => '15px',
					'font-weight'     => '500',
					'font-style'      => 'normal',
					'line-height'     => '20px',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0px',
				),
				'input'   => array(
					'title'           => esc_html__( 'Input fields', 'urbanism' ),
					'description'     => sprintf( $font_description, esc_html__( 'input fields, dropdowns and textareas', 'urbanism' ) ),
					'font-family'     => 'inherit',
					'font-size'       => '16px',
					'font-weight'     => '400',
					'font-style'      => 'normal',
					'line-height'     => '1.5em',     // Attention! Firefox don't allow line-height less then 1.5em in the select
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0px',
				),
				'info'    => array(
					'title'           => esc_html__( 'Post meta', 'urbanism' ),
					'description'     => sprintf( $font_description, esc_html__( 'post meta (author, categories, publish date, counters, share, etc.)', 'urbanism' ) ),
					'font-family'     => 'inherit',
					'font-size'       => '14px',  // Old value '13px' don't allow using 'font zoom' in the custom blog items
					'font-weight'     => '400',
					'font-style'      => 'normal',
					'line-height'     => '1.5em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0px',
					'margin-top'      => '0.4em',
					'margin-bottom'   => '',
				),
				'menu'    => array(
					'title'           => esc_html__( 'Main menu', 'urbanism' ),
					'description'     => sprintf( $font_description, esc_html__( 'main menu items', 'urbanism' ) ),
					'font-family'     => 'termina,sans-serif',
					'font-size'       => '14px',
					'font-weight'     => '600',
					'font-style'      => 'normal',
					'line-height'     => '1.5em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0px',
				),
				'submenu' => array(
					'title'           => esc_html__( 'Dropdown menu', 'urbanism' ),
					'description'     => sprintf( $font_description, esc_html__( 'dropdown menu items', 'urbanism' ) ),
					'font-family'     => '"DM Sans",sans-serif',
					'font-size'       => '15px',
					'font-weight'     => '400',
					'font-style'      => 'normal',
					'line-height'     => '1.5em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0px',
				),
				'other' => array(
					'title'           => esc_html__( 'Other', 'urbanism' ),
					'description'     => sprintf( $font_description, esc_html__( 'specific elements', 'urbanism' ) ),
					'font-family'     => '"DM Sans",sans-serif',
				),
			)
		);

		// Font presets
		urbanism_storage_set(
			'font_presets', array(
				'karla' => array(
								'title'  => esc_html__( 'Karla', 'urbanism' ),
								'load_fonts' => array(
													// Google font
													array(
														'name'   => 'Dancing Script',
														'family' => 'fantasy',
														'link'   => '',
														'styles' => '300,400,700',
													),
													// Google font
													array(
														'name'   => 'Sansita Swashed',
														'family' => 'fantasy',
														'link'   => '',
														'styles' => '300,400,700',
													),
												),
								'theme_fonts' => array(
													'p'       => array(
														'font-family'     => '"Dancing Script",fantasy',
														'font-size'       => '1.25rem',
													),
													'post'    => array(
														'font-family'     => '',
													),
													'h1'      => array(
														'font-family'     => '"Sansita Swashed",fantasy',
														'font-size'       => '4em',
													),
													'h2'      => array(
														'font-family'     => '"Sansita Swashed",fantasy',
													),
													'h3'      => array(
														'font-family'     => '"Sansita Swashed",fantasy',
													),
													'h4'      => array(
														'font-family'     => '"Sansita Swashed",fantasy',
													),
													'h5'      => array(
														'font-family'     => '"Sansita Swashed",fantasy',
													),
													'h6'      => array(
														'font-family'     => '"Sansita Swashed",fantasy',
													),
													'logo'    => array(
														'font-family'     => '"Sansita Swashed",fantasy',
													),
													'button'  => array(
														'font-family'     => '"Sansita Swashed",fantasy',
													),
													'input'   => array(
														'font-family'     => 'inherit',
													),
													'info'    => array(
														'font-family'     => 'inherit',
													),
													'menu'    => array(
														'font-family'     => '"Sansita Swashed",fantasy',
													),
													'submenu' => array(
														'font-family'     => '"Sansita Swashed",fantasy',
													),
												),
							),
				'roboto' => array(
								'title'  => esc_html__( 'Roboto', 'urbanism' ),
								'load_fonts' => array(
													// Google font
													array(
														'name'   => 'Noto Sans JP',
														'family' => 'serif',
														'link'   => '',
														'styles' => '300,300italic,400,400italic,700,700italic',
													),
													// Google font
													array(
														'name'   => 'Merriweather',
														'family' => 'sans-serif',
														'link'   => '',
														'styles' => '300,300italic,400,400italic,700,700italic',
													),
												),
								'theme_fonts' => array(
													'p'       => array(
														'font-family'     => '"Noto Sans JP",serif',
													),
													'post'    => array(
														'font-family'     => '',
													),
													'h1'      => array(
														'font-family'     => 'Merriweather,sans-serif',
													),
													'h2'      => array(
														'font-family'     => 'Merriweather,sans-serif',
													),
													'h3'      => array(
														'font-family'     => 'Merriweather,sans-serif',
													),
													'h4'      => array(
														'font-family'     => 'Merriweather,sans-serif',
													),
													'h5'      => array(
														'font-family'     => 'Merriweather,sans-serif',
													),
													'h6'      => array(
														'font-family'     => 'Merriweather,sans-serif',
													),
													'logo'    => array(
														'font-family'     => 'Merriweather,sans-serif',
													),
													'button'  => array(
														'font-family'     => 'Merriweather,sans-serif',
													),
													'input'   => array(
														'font-family'     => 'inherit',
													),
													'info'    => array(
														'font-family'     => 'inherit',
													),
													'menu'    => array(
														'font-family'     => 'Merriweather,sans-serif',
													),
													'submenu' => array(
														'font-family'     => 'Merriweather,sans-serif',
													),
												),
							),
				'garamond' => array(
								'title'  => esc_html__( 'Garamond', 'urbanism' ),
								'load_fonts' => array(
													// Adobe font
													array(
														'name'   => 'Europe',
														'family' => 'sans-serif',
														'link'   => 'https://use.typekit.net/qmj1tmx.css',
														'styles' => '',
													),
													// Adobe font
													array(
														'name'   => 'Sofia Pro',
														'family' => 'sans-serif',
														'link'   => 'https://use.typekit.net/qmj1tmx.css',
														'styles' => '',
													),
												),
								'theme_fonts' => array(
													'p'       => array(
														'font-family'     => '"Sofia Pro",sans-serif',
													),
													'post'    => array(
														'font-family'     => '',
													),
													'h1'      => array(
														'font-family'     => 'Europe,sans-serif',
													),
													'h2'      => array(
														'font-family'     => 'Europe,sans-serif',
													),
													'h3'      => array(
														'font-family'     => 'Europe,sans-serif',
													),
													'h4'      => array(
														'font-family'     => 'Europe,sans-serif',
													),
													'h5'      => array(
														'font-family'     => 'Europe,sans-serif',
													),
													'h6'      => array(
														'font-family'     => 'Europe,sans-serif',
													),
													'logo'    => array(
														'font-family'     => 'Europe,sans-serif',
													),
													'button'  => array(
														'font-family'     => 'Europe,sans-serif',
													),
													'input'   => array(
														'font-family'     => 'inherit',
													),
													'info'    => array(
														'font-family'     => 'inherit',
													),
													'menu'    => array(
														'font-family'     => 'Europe,sans-serif',
													),
													'submenu' => array(
														'font-family'     => 'Europe,sans-serif',
													),
												),
							),
			)
		);
	}
}


//--------------------------------------------
// COLOR SCHEMES
//--------------------------------------------
if ( ! function_exists( 'urbanism_skin_setup_schemes' ) ) {
	add_action( 'after_setup_theme', 'urbanism_skin_setup_schemes', 1 );
	function urbanism_skin_setup_schemes() {

		// Theme colors for customizer
		// Attention! Inner scheme must be last in the array below
		urbanism_storage_set(
			'scheme_color_groups', array(
				'main'    => array(
					'title'       => esc_html__( 'Main', 'urbanism' ),
					'description' => esc_html__( 'Colors of the main content area', 'urbanism' ),
				),
				'alter'   => array(
					'title'       => esc_html__( 'Alter', 'urbanism' ),
					'description' => esc_html__( 'Colors of the alternative blocks (sidebars, etc.)', 'urbanism' ),
				),
				'extra'   => array(
					'title'       => esc_html__( 'Extra', 'urbanism' ),
					'description' => esc_html__( 'Colors of the extra blocks (dropdowns, price blocks, table headers, etc.)', 'urbanism' ),
				),
				'inverse' => array(
					'title'       => esc_html__( 'Inverse', 'urbanism' ),
					'description' => esc_html__( 'Colors of the inverse blocks - when link color used as background of the block (dropdowns, blockquotes, etc.)', 'urbanism' ),
				),
				'input'   => array(
					'title'       => esc_html__( 'Input', 'urbanism' ),
					'description' => esc_html__( 'Colors of the form fields (text field, textarea, select, etc.)', 'urbanism' ),
				),
			)
		);

		urbanism_storage_set(
			'scheme_color_names', array(
				'bg_color'    => array(
					'title'       => esc_html__( 'Background color', 'urbanism' ),
					'description' => esc_html__( 'Background color of this block in the normal state', 'urbanism' ),
				),
				'bg_hover'    => array(
					'title'       => esc_html__( 'Background hover', 'urbanism' ),
					'description' => esc_html__( 'Background color of this block in the hovered state', 'urbanism' ),
				),
				'bd_color'    => array(
					'title'       => esc_html__( 'Border color', 'urbanism' ),
					'description' => esc_html__( 'Border color of this block in the normal state', 'urbanism' ),
				),
				'bd_hover'    => array(
					'title'       => esc_html__( 'Border hover', 'urbanism' ),
					'description' => esc_html__( 'Border color of this block in the hovered state', 'urbanism' ),
				),
				'text'        => array(
					'title'       => esc_html__( 'Text', 'urbanism' ),
					'description' => esc_html__( 'Color of the text inside this block', 'urbanism' ),
				),
				'text_dark'   => array(
					'title'       => esc_html__( 'Text dark', 'urbanism' ),
					'description' => esc_html__( 'Color of the dark text (bold, header, etc.) inside this block', 'urbanism' ),
				),
				'text_light'  => array(
					'title'       => esc_html__( 'Text light', 'urbanism' ),
					'description' => esc_html__( 'Color of the light text (post meta, etc.) inside this block', 'urbanism' ),
				),
				'text_link'   => array(
					'title'       => esc_html__( 'Link', 'urbanism' ),
					'description' => esc_html__( 'Color of the links inside this block', 'urbanism' ),
				),
				'text_hover'  => array(
					'title'       => esc_html__( 'Link hover', 'urbanism' ),
					'description' => esc_html__( 'Color of the hovered state of links inside this block', 'urbanism' ),
				),
				'text_link2'  => array(
					'title'       => esc_html__( 'Accent 2', 'urbanism' ),
					'description' => esc_html__( 'Color of the accented texts (areas) inside this block', 'urbanism' ),
				),
				'text_hover2' => array(
					'title'       => esc_html__( 'Accent 2 hover', 'urbanism' ),
					'description' => esc_html__( 'Color of the hovered state of accented texts (areas) inside this block', 'urbanism' ),
				),
				'text_link3'  => array(
					'title'       => esc_html__( 'Accent 3', 'urbanism' ),
					'description' => esc_html__( 'Color of the other accented texts (buttons) inside this block', 'urbanism' ),
				),
				'text_hover3' => array(
					'title'       => esc_html__( 'Accent 3 hover', 'urbanism' ),
					'description' => esc_html__( 'Color of the hovered state of other accented texts (buttons) inside this block', 'urbanism' ),
				),
			)
		);

		// Default values for each color scheme
		$schemes = array(

			// Color scheme: 'default'
			'default' => array(
				'title'    => esc_html__( 'Default', 'urbanism' ),
				'internal' => true,
				'colors'   => array(

					// Whole block border and background
					'bg_color'         => '#F2EFE9', // ok
					'bd_color'         => '#D5D0C7', // ok

					// Text and links colors
					'text'             => '#6F6D6D', // ok
					'text_light'       => '#868483', // ok
					'text_dark'        => '#262320', // ok
					'text_link'        => '#D14119', // ok
					'text_hover'       => '#AD2D0A', // ok
					'text_link2'       => '#917E67', // ok
					'text_hover2'      => '#715D46', // ok
					'text_link3'       => '#918E67', // ok
					'text_hover3'      => '#797651', // ok

					// Alternative blocks (sidebar, tabs, alternative blocks, etc.)
					'alter_bg_color'   => '#ffffff', //
					'alter_bg_hover'   => '#F9F9F9', //
					'alter_bd_color'   => '#D5D0C7', // ok
					'alter_bd_hover'   => '#DCDCDC', //
					'alter_text'       => '#6F6D6D', //
					'alter_light'      => '#868483', // ok
					'alter_dark'       => '#262320', // ok
					'alter_link'       => '#D14119', // ok
					'alter_hover'      => '#AD2D0A', //
					'alter_link2'      => '#917E67', // ok
					'alter_hover2'     => '#715D46', // ok
					'alter_link3'      => '#918E67', // ok
					'alter_hover3'     => '#797651', // ok

					// Extra blocks (submenu, tabs, color blocks, etc.)
					'extra_bg_color'   => '#000912', // ok
					'extra_bg_hover'   => '#3f3d47',
					'extra_bd_color'   => '#3E3E3E',
					'extra_bd_hover'   => '#575757',
					'extra_text'       => '#929598', // ok
					'extra_light'      => '#7B7F80',
					'extra_dark'       => '#FDFDFD', //
					'extra_link'       => '#D14119', // ok
					'extra_hover'      => '#ffffff', //
					'extra_link2'      => '#80d572',
					'extra_hover2'     => '#8be77c',
					'extra_link3'      => '#ddb837',
					'extra_hover3'     => '#eec432',

					// Input fields (form's fields and textarea)
					'input_bg_color'   => 'transparent', //
					'input_bg_hover'   => 'transparent', //
					'input_bd_color'   => '#D5D0C7', // ok
					'input_bd_hover'   => '#262320', // ok
					'input_text'       => '#868483', // ok
					'input_light'      => '#868483', // ok
					'input_dark'       => '#262320', // ok

					// Inverse blocks (text and links on the 'text_link' background)
					'inverse_bd_color' => '#67bcc1',
					'inverse_bd_hover' => '#5aa4a9',
					'inverse_text'     => '#1d1d1d',
					'inverse_light'    => '#333333',
					'inverse_dark'     => '#1A1A1A', // ok
					'inverse_link'     => '#ffffff', //
					'inverse_hover'    => '#ffffff', //

					// Additional (skin-specific) colors.
					// Attention! Set of colors must be equal in all color schemes.
					//---> For example:
					//---> 'new_color1'         => '#rrggbb',
					//---> 'alter_new_color1'   => '#rrggbb',
					//---> 'inverse_new_color1' => '#rrggbb',
				),
			),

			// Color scheme: 'dark'
			'dark'    => array(
				'title'    => esc_html__( 'Dark', 'urbanism' ),
				'internal' => true,
				'colors'   => array(

					// Whole block border and background
					'bg_color'         => '#1A1A1A', // ok
					'bd_color'         => '#3E3E3E', // ok

					// Text and links colors
					'text'             => '#929598', // ok
					'text_light'       => '#7B7F80', // ok
					'text_dark'        => '#FDFDFD', // ok
					'text_link'        => '#D14119', // ok
					'text_hover'       => '#AD2D0A', // ok
					'text_link2'       => '#917E67', // ok
					'text_hover2'      => '#715D46', // ok
					'text_link3'       => '#918E67', // ok
					'text_hover3'      => '#797651', // ok

					// Alternative blocks (sidebar, tabs, alternative blocks, etc.)
					'alter_bg_color'   => '#252525', // ok
					'alter_bg_hover'   => '#2C313D', //
					'alter_bd_color'   => '#3E3E3E', // ok
					'alter_bd_hover'   => '#3E3E3E', // 
					'alter_text'       => '#929598', // ok
					'alter_light'      => '#7B7F80', // ok
					'alter_dark'       => '#FDFDFD', // ok
					'alter_link'       => '#D14119', // ok
					'alter_hover'      => '#AD2D0A', // ok
					'alter_link2'      => '#917E67', // ok
					'alter_hover2'     => '#715D46', // ok
					'alter_link3'      => '#918E67', // ok
					'alter_hover3'     => '#797651', // ok

					// Extra blocks (submenu, tabs, color blocks, etc.)
					'extra_bg_color'   => '#000912', // ok
					'extra_bg_hover'   => '#3f3d47',
					'extra_bd_color'   => '#313131',
					'extra_bd_hover'   => '#575757',
					'extra_text'       => '#929598', //ok
					'extra_light'      => '#7B7F80',
					'extra_dark'       => '#FDFDFD',
					'extra_link'       => '#D14119', // ok
					'extra_hover'      => '#ffffff',
					'extra_link2'      => '#80d572',
					'extra_hover2'     => '#8be77c',
					'extra_link3'      => '#ddb837',
					'extra_hover3'     => '#eec432',

					// Input fields (form's fields and textarea)
					'input_bg_color'   => 'transparent', //
					'input_bg_hover'   => 'transparent', //
					'input_bd_color'   => '#3c3d51', // ok
					'input_bd_hover'   => '#ffffff', // ok
					'input_text'       => '#929598', // ok
					'input_light'      => '#929598', // ok
					'input_dark'       => '#ffffff',

					// Inverse blocks (text and links on the 'text_link' background)
					'inverse_bd_color' => '#e36650',
					'inverse_bd_hover' => '#cb5b47',
					'inverse_text'     => '#FDFDFD', // ok
					'inverse_light'    => '#6f6f6f',
					'inverse_dark'     => '#262320', // ok
					'inverse_link'     => '#ffffff', //
					'inverse_hover'    => '#262320', // ok

					// Additional (skin-specific) colors.
					// Attention! Set of colors must be equal in all color schemes.
					//---> For example:
					//---> 'new_color1'         => '#rrggbb',
					//---> 'alter_new_color1'   => '#rrggbb',
					//---> 'inverse_new_color1' => '#rrggbb',
				),
			),

			// Color scheme: 'default'
			'light' => array(
				'title'    => esc_html__( 'Light', 'urbanism' ),
				'internal' => true,
				'colors'   => array(

					// Whole block border and background
					'bg_color'         => '#ffffff', //
					'bd_color'         => '#D5D0C7', // ok

					// Text and links colors
					'text'             => '#6F6D6D', // ok
					'text_light'       => '#868483', // ok
					'text_dark'        => '#262320', // ok
					'text_link'        => '#D14119', // ok
					'text_hover'       => '#AD2D0A', // ok
					'text_link2'       => '#917E67', // ok
					'text_hover2'      => '#715D46', // ok
					'text_link3'       => '#918E67', // ok
					'text_hover3'      => '#797651', // ok

					// Alternative blocks (sidebar, tabs, alternative blocks, etc.)
					'alter_bg_color'   => '#F2EFE9', // ok
					'alter_bg_hover'   => '#ffffff', //
					'alter_bd_color'   => '#D5D0C7', // ok
					'alter_bd_hover'   => '#DCDCDC', //
					'alter_text'       => '#6F6D6D', //
					'alter_light'      => '#868483', // ok
					'alter_dark'       => '#262320', // ok
					'alter_link'       => '#D14119', // ok
					'alter_hover'      => '#AD2D0A', // ok
					'alter_link2'      => '#917E67', // ok
					'alter_hover2'     => '#715D46', // ok
					'alter_link3'      => '#918E67', // ok
					'alter_hover3'     => '#797651', // ok

					// Extra blocks (submenu, tabs, color blocks, etc.)
					'extra_bg_color'   => '#000912', // ok
					'extra_bg_hover'   => '#3f3d47',
					'extra_bd_color'   => '#3E3E3E',
					'extra_bd_hover'   => '#575757',
					'extra_text'       => '#929598', // ok
					'extra_light'      => '#7B7F80',
					'extra_dark'       => '#FDFDFD', //
					'extra_link'       => '#D14119', // ok
					'extra_hover'      => '#ffffff', //
					'extra_link2'      => '#80d572',
					'extra_hover2'     => '#8be77c',
					'extra_link3'      => '#ddb837',
					'extra_hover3'     => '#eec432',

					// Input fields (form's fields and textarea)
					'input_bg_color'   => 'transparent', //
					'input_bg_hover'   => 'transparent', //
					'input_bd_color'   => '#D5D0C7', // ok
					'input_bd_hover'   => '#262320', // ok
					'input_text'       => '#868483', // ok
					'input_light'      => '#868483', // ok
					'input_dark'       => '#262320', // ok

					// Inverse blocks (text and links on the 'text_link' background)
					'inverse_bd_color' => '#67bcc1',
					'inverse_bd_hover' => '#5aa4a9',
					'inverse_text'     => '#1d1d1d',
					'inverse_light'    => '#333333',
					'inverse_dark'     => '#262320', // ok
					'inverse_link'     => '#ffffff', //
					'inverse_hover'    => '#ffffff', //

					// Additional (skin-specific) colors.
					// Attention! Set of colors must be equal in all color schemes.
					//---> For example:
					//---> 'new_color1'         => '#rrggbb',
					//---> 'alter_new_color1'   => '#rrggbb',
					//---> 'inverse_new_color1' => '#rrggbb',
				),
			),
		);
		urbanism_storage_set( 'schemes', $schemes );
		urbanism_storage_set( 'schemes_original', $schemes );

		// Add names of additional colors
		//---> For example:
		//---> urbanism_storage_set_array( 'scheme_color_names', 'new_color1', array(
		//---> 	'title'       => __( 'New color 1', 'urbanism' ),
		//---> 	'description' => __( 'Description of the new color 1', 'urbanism' ),
		//---> ) );


		// Additional colors for each scheme
		// Parameters:	'color' - name of the color from the scheme that should be used as source for the transformation
		//				'alpha' - to make color transparent (0.0 - 1.0)
		//				'hue', 'saturation', 'brightness' - inc/dec value for each color's component
		urbanism_storage_set(
			'scheme_colors_add', array(
				'bg_color_0'        => array(
					'color' => 'bg_color',
					'alpha' => 0,
				),
				'bg_color_02'       => array(
					'color' => 'bg_color',
					'alpha' => 0.2,
				),
				'bg_color_07'       => array(
					'color' => 'bg_color',
					'alpha' => 0.7,
				),
				'bg_color_08'       => array(
					'color' => 'bg_color',
					'alpha' => 0.8,
				),
				'bg_color_09'       => array(
					'color' => 'bg_color',
					'alpha' => 0.9,
				),
				'alter_bg_color_07' => array(
					'color' => 'alter_bg_color',
					'alpha' => 0.7,
				),
				'alter_bg_color_04' => array(
					'color' => 'alter_bg_color',
					'alpha' => 0.4,
				),
				'alter_bg_color_00' => array(
					'color' => 'alter_bg_color',
					'alpha' => 0,
				),
				'alter_bg_color_02' => array(
					'color' => 'alter_bg_color',
					'alpha' => 0.2,
				),
				'alter_bd_color_02' => array(
					'color' => 'alter_bd_color',
					'alpha' => 0.2,
				),
                'alter_dark_015'     => array(
                    'color' => 'alter_dark',
                    'alpha' => 0.15,
                ),
                'alter_dark_02'     => array(
                    'color' => 'alter_dark',
                    'alpha' => 0.2,
                ),
                'alter_dark_05'     => array(
                    'color' => 'alter_dark',
                    'alpha' => 0.5,
                ),
                'alter_dark_08'     => array(
                    'color' => 'alter_dark',
                    'alpha' => 0.8,
                ),
				'alter_link_02'     => array(
					'color' => 'alter_link',
					'alpha' => 0.2,
				),
				'alter_link_07'     => array(
					'color' => 'alter_link',
					'alpha' => 0.7,
				),
				'extra_bg_color_05' => array(
					'color' => 'extra_bg_color',
					'alpha' => 0.5,
				),
				'extra_bg_color_07' => array(
					'color' => 'extra_bg_color',
					'alpha' => 0.7,
				),
				'extra_link_02'     => array(
					'color' => 'extra_link',
					'alpha' => 0.2,
				),
				'extra_link_07'     => array(
					'color' => 'extra_link',
					'alpha' => 0.7,
				),
                'text_dark_003'      => array(
                    'color' => 'text_dark',
                    'alpha' => 0.03,
                ),
                'text_dark_005'      => array(
                    'color' => 'text_dark',
                    'alpha' => 0.05,
                ),
                'text_dark_008'      => array(
                    'color' => 'text_dark',
                    'alpha' => 0.08,
                ),
				'text_dark_015'      => array(
					'color' => 'text_dark',
					'alpha' => 0.15,
				),
				'text_dark_02'      => array(
					'color' => 'text_dark',
					'alpha' => 0.2,
				),
                'text_dark_03'      => array(
                    'color' => 'text_dark',
                    'alpha' => 0.3,
                ),
                'text_dark_05'      => array(
                    'color' => 'text_dark',
                    'alpha' => 0.5,
                ),
				'text_dark_07'      => array(
					'color' => 'text_dark',
					'alpha' => 0.7,
				),
                'text_dark_08'      => array(
                    'color' => 'text_dark',
                    'alpha' => 0.8,
                ),
                'text_link_007'      => array(
                    'color' => 'text_link',
                    'alpha' => 0.07,
                ),
				'text_link_02'      => array(
					'color' => 'text_link',
					'alpha' => 0.2,
				),
                'text_link_03'      => array(
                    'color' => 'text_link',
                    'alpha' => 0.3,
                ),
				'text_link_04'      => array(
					'color' => 'text_link',
					'alpha' => 0.4,
				),
				'text_link_07'      => array(
					'color' => 'text_link',
					'alpha' => 0.7,
				),
				'text_link2_08'      => array(
                    'color' => 'text_link2',
                    'alpha' => 0.8,
                ),
                'text_link2_007'      => array(
                    'color' => 'text_link2',
                    'alpha' => 0.07,
                ),
				'text_link2_02'      => array(
					'color' => 'text_link2',
					'alpha' => 0.2,
				),
                'text_link2_03'      => array(
                    'color' => 'text_link2',
                    'alpha' => 0.3,
                ),
				'text_link2_05'      => array(
					'color' => 'text_link2',
					'alpha' => 0.5,
				),
                'text_link3_007'      => array(
                    'color' => 'text_link3',
                    'alpha' => 0.07,
                ),
				'text_link3_02'      => array(
					'color' => 'text_link3',
					'alpha' => 0.2,
				),
                'text_link3_03'      => array(
                    'color' => 'text_link3',
                    'alpha' => 0.3,
                ),
                'inverse_text_03'      => array(
                    'color' => 'inverse_text',
                    'alpha' => 0.3,
                ),
                'inverse_link_08'      => array(
                    'color' => 'inverse_link',
                    'alpha' => 0.8,
                ),
                'inverse_hover_08'      => array(
                    'color' => 'inverse_hover',
                    'alpha' => 0.8,
                ),
				'text_dark_blend'   => array(
					'color'      => 'text_dark',
					'hue'        => 2,
					'saturation' => -5,
					'brightness' => 5,
				),
				'text_link_blend'   => array(
					'color'      => 'text_link',
					'hue'        => 2,
					'saturation' => -5,
					'brightness' => 5,
				),
				'alter_link_blend'  => array(
					'color'      => 'alter_link',
					'hue'        => 2,
					'saturation' => -5,
					'brightness' => 5,
				),
			)
		);

		// Simple scheme editor: lists the colors to edit in the "Simple" mode.
		// For each color you can set the array of 'slave' colors and brightness factors that are used to generate new values,
		// when 'main' color is changed
		// Leave 'slave' arrays empty if your scheme does not have a color dependency
		urbanism_storage_set(
			'schemes_simple', array(
				'text_link'        => array(),
				'text_hover'       => array(),
				'text_link2'       => array(),
				'text_hover2'      => array(),
				'text_link3'       => array(),
				'text_hover3'      => array(),
				'alter_link'       => array(),
				'alter_hover'      => array(),
				'alter_link2'      => array(),
				'alter_hover2'     => array(),
				'alter_link3'      => array(),
				'alter_hover3'     => array(),
				'extra_link'       => array(),
				'extra_hover'      => array(),
				'extra_link2'      => array(),
				'extra_hover2'     => array(),
				'extra_link3'      => array(),
				'extra_hover3'     => array(),
			)
		);

		// Parameters to set order of schemes in the css
		urbanism_storage_set(
			'schemes_sorted', array(
				'color_scheme',
				'header_scheme',
				'menu_scheme',
				'sidebar_scheme',
				'footer_scheme',
			)
		);

		// Color presets
		urbanism_storage_set(
			'color_presets', array(
				'autumn' => array(
								'title'  => esc_html__( 'Autumn', 'urbanism' ),
								'colors' => array(
												'default' => array(
																	'text_link'  => '#d83938',
																	'text_hover' => '#f2b232',
																	),
												'dark' => array(
																	'text_link'  => '#d83938',
																	'text_hover' => '#f2b232',
																	)
												)
							),
				'green' => array(
								'title'  => esc_html__( 'Natural Green', 'urbanism' ),
								'colors' => array(
												'default' => array(
																	'text_link'  => '#75ac78',
																	'text_hover' => '#378e6d',
																	),
												'dark' => array(
																	'text_link'  => '#75ac78',
																	'text_hover' => '#378e6d',
																	)
												)
							),
			)
		);
	}
}

// Enqueue clone specific style
if ( ! function_exists( 'urbanism_clone_frontend_scripts' ) ) {
	add_action( 'wp_enqueue_scripts', 'urbanism_clone_frontend_scripts', 2150 );
	function urbanism_clone_frontend_scripts() {
		$urbanism_url = urbanism_get_file_url( urbanism_skins_get_current_skin_dir() . 'extra-styles.css' );
		if ( '' != $urbanism_url ) {
			wp_enqueue_style( 'urbanism-extra-styles-' . esc_attr( urbanism_skins_get_current_skin_name() ), $urbanism_url, array(), null );
		}
	}
}

// Custom styles
$urbanism_clone_style_path = urbanism_get_file_dir( urbanism_skins_get_current_skin_dir() . 'extra-styles.php' );
if ( ! empty( $urbanism_clone_style_path ) ) {
	require_once $urbanism_clone_style_path;
}

// Activation methods
if ( ! function_exists( 'urbanism_skin_filter_activation_methods' ) ) {
    add_filter( 'trx_addons_filter_activation_methods', 'urbanism_skin_filter_activation_methods', 10, 1 );
    function urbanism_skin_filter_activation_methods( $args ) {
        $args['elements_key'] = true;
        return $args;
    }
}

// Theme init priorities:
// 3 - add/remove Theme Options elements
if ( ! function_exists( 'urbanism_clone_skin_theme_setup3' ) ) {
	add_action( 'after_setup_theme', 'urbanism_clone_skin_theme_setup3', 3 );
	function urbanism_clone_skin_theme_setup3() {
		urbanism_storage_set_array_after( 'options', 'remove_margins', array(
			'extra_bg_image' => array(
				"title" => esc_html__('Extra background image', 'urbanism'),
				"desc" => wp_kses_data( __('Select or upload background-image to display it in the page. Does not work for boxed body style.', 'urbanism') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'urbanism')
				),
				'dependency' => array(
					'body_style' => array( 'wide', 'fullwide', 'fullscreen' ),
				),
				"std" => '',
				'pro_only'   => URBANISM_THEME_FREE,
				"type" => "image"
			),
			'extra_bg_image_size' => array(
				"title" => esc_html__('Extra background image size', 'urbanism'),
				"desc" => wp_kses_data( __('Use size contain (cover original).', 'urbanism') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'urbanism')
				),
				'dependency' => array(
					'body_style' => array( 'wide', 'fullwide', 'fullscreen' ),
				),
				"std" => 0,
				'pro_only'   => URBANISM_THEME_FREE,
				"type" => "switch"
			),
			)
		);		
	}
}

if ( ! function_exists( 'urbanism_skin_filter_page_wrap_class' ) ) {
    add_action('urbanism_filter_page_wrap_class', 'urbanism_skin_filter_page_wrap_class');
    function urbanism_skin_filter_page_wrap_class($class) {
        $extra_bg_image = urbanism_get_theme_option('extra_bg_image');
        $extra_bg_image_size = urbanism_is_on(urbanism_get_theme_option('extra_bg_image_size'));
        $body_boxed_style = urbanism_get_theme_option( 'body_style' ) == 'boxed';
        if (!empty( $extra_bg_image ) && !$body_boxed_style ) {
            $custom_bg = ' ' . 'with_bg' .($extra_bg_image_size ? ' contain_size' : ''). ' ' . urbanism_add_inline_css_class('background-image: url(' . esc_url($extra_bg_image) . ');');
            $class = $class . $custom_bg;
        }
        return $class;
    }
}