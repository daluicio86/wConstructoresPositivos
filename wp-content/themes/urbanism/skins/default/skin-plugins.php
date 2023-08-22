<?php
/**
 * Required plugins
 *
 * @package URBANISM
 * @since URBANISM 1.76.0
 */

// THEME-SUPPORTED PLUGINS
// If plugin not need - remove its settings from next array
//----------------------------------------------------------
$urbanism_theme_required_plugins_groups = array(
	'core'          => esc_html__( 'Core', 'urbanism' ),
	'page_builders' => esc_html__( 'Page Builders', 'urbanism' ),
	'ecommerce'     => esc_html__( 'E-Commerce & Donations', 'urbanism' ),
	'socials'       => esc_html__( 'Socials and Communities', 'urbanism' ),
	'events'        => esc_html__( 'Events and Appointments', 'urbanism' ),
	'content'       => esc_html__( 'Content', 'urbanism' ),
	'other'         => esc_html__( 'Other', 'urbanism' ),
);
$urbanism_theme_required_plugins        = array(
	'trx_addons'                 => array(
		'title'       => esc_html__( 'ThemeREX Addons', 'urbanism' ),
		'description' => esc_html__( "Will allow you to install recommended plugins, demo content, and improve the theme's functionality overall with multiple theme options", 'urbanism' ),
		'required'    => true,
		'logo'        => 'trx_addons.png',
		'group'       => $urbanism_theme_required_plugins_groups['core'],
	),
	'elementor'                  => array(
		'title'       => esc_html__( 'Elementor', 'urbanism' ),
		'description' => esc_html__( "Is a beautiful PageBuilder, even the free version of which allows you to create great pages using a variety of modules.", 'urbanism' ),
		'required'    => false,
		'logo'        => 'elementor.png',
		'group'       => $urbanism_theme_required_plugins_groups['page_builders'],
	),
	'gutenberg'                  => array(
		'title'       => esc_html__( 'Gutenberg', 'urbanism' ),
		'description' => esc_html__( "It's a posts editor coming in place of the classic TinyMCE. Can be installed and used in parallel with Elementor", 'urbanism' ),
		'required'    => false,
		'install'     => false,          // Do not offer installation of the plugin in the Theme Dashboard and TGMPA
		'logo'        => 'gutenberg.png',
		'group'       => $urbanism_theme_required_plugins_groups['page_builders'],
	),
	'js_composer'                => array(
		'title'       => esc_html__( 'WPBakery PageBuilder', 'urbanism' ),
		'description' => esc_html__( "Popular PageBuilder which allows you to create excellent pages", 'urbanism' ),
		'required'    => false,
		'install'     => false,          // Do not offer installation of the plugin in the Theme Dashboard and TGMPA
		'logo'        => 'js_composer.jpg',
		'group'       => $urbanism_theme_required_plugins_groups['page_builders'],
	),
	'woocommerce'                => array(
		'title'       => esc_html__( 'WooCommerce', 'urbanism' ),
		'description' => esc_html__( "Connect the store to your website and start selling now", 'urbanism' ),
		'required'    => false,
		'logo'        => 'woocommerce.png',
		'group'       => $urbanism_theme_required_plugins_groups['ecommerce'],
	),
	'elegro-payment'             => array(
		'title'       => esc_html__( 'Elegro Crypto Payment', 'urbanism' ),
		'description' => esc_html__( "Extends WooCommerce Payment Gateways with an elegro Crypto Payment", 'urbanism' ),
		'required'    => false,
		'logo'        => 'elegro-payment.png',
		'group'       => $urbanism_theme_required_plugins_groups['ecommerce'],
	),
	'instagram-feed'             => array(
		'title'       => esc_html__( 'Instagram Feed', 'urbanism' ),
		'description' => esc_html__( "Displays the latest photos from your profile on Instagram", 'urbanism' ),
		'required'    => false,
		'logo'        => 'instagram-feed.png',
		'group'       => $urbanism_theme_required_plugins_groups['socials'],
	),
	'mailchimp-for-wp'           => array(
		'title'       => esc_html__( 'MailChimp for WP', 'urbanism' ),
		'description' => esc_html__( "Allows visitors to subscribe to newsletters", 'urbanism' ),
		'required'    => false,
		'logo'        => 'mailchimp-for-wp.png',
		'group'       => $urbanism_theme_required_plugins_groups['socials'],
	),
	'booked'                     => array(
		'title'       => esc_html__( 'Booked Appointments', 'urbanism' ),
		'description' => '',
		'required'    => false,
		'install'     => false,
		'logo'        => 'booked.png',
		'group'       => $urbanism_theme_required_plugins_groups['events'],
	),
	'the-events-calendar'        => array(
		'title'       => esc_html__( 'The Events Calendar', 'urbanism' ),
		'description' => '',
		'required'    => false,
		'install'     => false,
		'logo'        => 'the-events-calendar.png',
		'group'       => $urbanism_theme_required_plugins_groups['events'],
	),
	'contact-form-7'             => array(
		'title'       => esc_html__( 'Contact Form 7', 'urbanism' ),
		'description' => esc_html__( "CF7 allows you to create an unlimited number of contact forms", 'urbanism' ),
		'required'    => false,
		'logo'        => 'contact-form-7.png',
		'group'       => $urbanism_theme_required_plugins_groups['content'],
	),

	'latepoint'                  => array(
		'title'       => esc_html__( 'LatePoint', 'urbanism' ),
		'description' => '',
		'install'     => false,
		'required'    => false,
		'logo'        => urbanism_get_file_url( 'plugins/latepoint/latepoint.png' ),
		'group'       => $urbanism_theme_required_plugins_groups['events'],
	),
	'advanced-popups'                  => array(
		'title'       => esc_html__( 'Advanced Popups', 'urbanism' ),
		'description' => '',
		'required'    => false,
		'logo'        => urbanism_get_file_url( 'plugins/advanced-popups/advanced-popups.jpg' ),
		'group'       => $urbanism_theme_required_plugins_groups['content'],
	),
	'devvn-image-hotspot'                  => array(
		'title'       => esc_html__( 'Image Hotspot by DevVN', 'urbanism' ),
		'description' => '',
		'required'    => false,
		'install'     => false,
		'logo'        => urbanism_get_file_url( 'plugins/devvn-image-hotspot/devvn-image-hotspot.png' ),
		'group'       => $urbanism_theme_required_plugins_groups['content'],
	),
	'ti-woocommerce-wishlist'                  => array(
		'title'       => esc_html__( 'TI WooCommerce Wishlist', 'urbanism' ),
		'description' => '',
		'required'    => false,
		'logo'        => urbanism_get_file_url( 'plugins/ti-woocommerce-wishlist/ti-woocommerce-wishlist.png' ),
		'group'       => $urbanism_theme_required_plugins_groups['ecommerce'],
	),
	'woo-smart-quick-view'                  => array(
		'title'       => esc_html__( 'WPC Smart Quick View for WooCommerce', 'urbanism' ),
		'description' => '',
		'required'    => false,
		'install'     => false,
		'logo'        => urbanism_get_file_url( 'plugins/woo-smart-quick-view/woo-smart-quick-view.png' ),
		'group'       => $urbanism_theme_required_plugins_groups['ecommerce'],
	),
	'twenty20'                  => array(
		'title'       => esc_html__( 'Twenty20 Image Before-After', 'urbanism' ),
		'description' => '',
		'required'    => false,
		'install'     => false,
		'logo'        => urbanism_get_file_url( 'plugins/twenty20/twenty20.png' ),
		'group'       => $urbanism_theme_required_plugins_groups['content'],
	),
	'essential-grid'             => array(
		'title'       => esc_html__( 'Essential Grid', 'urbanism' ),
		'description' => '',
		'required'    => false,
		'install'     => false,
		'logo'        => 'essential-grid.png',
		'group'       => $urbanism_theme_required_plugins_groups['content'],
	),
	'revslider'                  => array(
		'title'       => esc_html__( 'Revolution Slider', 'urbanism' ),
		'description' => '',
		'required'    => false,
		'logo'        => 'revslider.png',
		'group'       => $urbanism_theme_required_plugins_groups['content'],
	),
	'sitepress-multilingual-cms' => array(
		'title'       => esc_html__( 'WPML - Sitepress Multilingual CMS', 'urbanism' ),
		'description' => esc_html__( "Allows you to make your website multilingual", 'urbanism' ),
		'required'    => false,
		'install'     => false,      // Do not offer installation of the plugin in the Theme Dashboard and TGMPA
		'logo'        => 'sitepress-multilingual-cms.png',
		'group'       => $urbanism_theme_required_plugins_groups['content'],
	),
	'wp-gdpr-compliance'         => array(
		'title'       => esc_html__( 'Cookie Information', 'urbanism' ),
		'description' => esc_html__( "Allow visitors to decide for themselves what personal data they want to store on your site", 'urbanism' ),
		'required'    => false,
		'logo'        => 'wp-gdpr-compliance.png',
		'group'       => $urbanism_theme_required_plugins_groups['other'],
	),
	'trx_updater'                => array(
		'title'       => esc_html__( 'ThemeREX Updater', 'urbanism' ),
		'description' => esc_html__( "Update theme and theme-specific plugins from developer's upgrade server.", 'urbanism' ),
		'required'    => false,
		'logo'        => 'trx_updater.png',
		'group'       => $urbanism_theme_required_plugins_groups['other'],
	),
);

if ( URBANISM_THEME_FREE ) {
	unset( $urbanism_theme_required_plugins['js_composer'] );
	unset( $urbanism_theme_required_plugins['booked'] );
	unset( $urbanism_theme_required_plugins['the-events-calendar'] );
	unset( $urbanism_theme_required_plugins['calculated-fields-form'] );
	unset( $urbanism_theme_required_plugins['essential-grid'] );
	unset( $urbanism_theme_required_plugins['revslider'] );
	unset( $urbanism_theme_required_plugins['sitepress-multilingual-cms'] );
	unset( $urbanism_theme_required_plugins['trx_updater'] );
	unset( $urbanism_theme_required_plugins['trx_popup'] );
}

// Add plugins list to the global storage
urbanism_storage_set( 'required_plugins', $urbanism_theme_required_plugins );
