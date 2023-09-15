<?php
/**
 * @author  RadiusTheme
 * @since   1.0.1
 * @version 1.0.1
 */

// Includes the files needed for the theme updater
if ( !class_exists( 'EDD_Theme_Updater_Admin' ) ) {
	include( dirname( __FILE__ ) . '/theme-updater-admin.php' );
}

add_action( 'after_setup_theme', 'rdtheme_edd_theme_updater', 20 );

function rdtheme_edd_theme_updater(){
	$theme_data = wp_get_theme( get_template() );

	// Config settings
	$config = array(
		'remote_api_url' => 'https://www.radiustheme.com', // Site where EDD is hosted
		'item_id'        => 199375, // ID of item in site where EDD is hosted
		'theme_slug'     => '_rt_cl-classified', // Theme slug
		'version'        => $theme_data->get( 'Version' ), // The current version of this theme
		'author'         => $theme_data->get( 'Author' ), // The author of this theme
		'download_id'    => '', // Optional, used for generating a license renewal link
		'renew_url'      => '' // Optional, allows for a custom license renewal link
	);

	// Strings
	$strings = array(
		'theme-license'             => __( 'Theme License', 'cl-classified' ),
		'enter-key'                 => __( 'Enter your theme license key.', 'cl-classified' ),
		'license-key'               => __( 'License Key', 'cl-classified' ),
		'license-action'            => __( 'License Action', 'cl-classified' ),
		'deactivate-license'        => __( 'Deactivate License', 'cl-classified' ),
		'activate-license'          => __( 'Activate License', 'cl-classified' ),
		'status-unknown'            => __( 'License status is unknown.', 'cl-classified' ),
		'renew'                     => __( 'Renew?', 'cl-classified' ),
		'unlimited'                 => __( 'unlimited', 'cl-classified' ),
		'license-key-is-active'     => __( 'License key is active.', 'cl-classified' ),
		'expires%s'                 => __( 'Expires %s.', 'cl-classified' ),
		'%1$s/%2$-sites'            => __( 'You have %1$s / %2$s sites activated.', 'cl-classified' ),
		'license-key-expired-%s'    => __( 'License key expired %s.', 'cl-classified' ),
		'license-key-expired'       => __( 'License key has expired.', 'cl-classified' ),
		'license-keys-do-not-match' => __( 'License keys do not match.', 'cl-classified' ),
		'license-is-inactive'       => __( 'License is inactive.', 'cl-classified' ),
		'license-key-is-disabled'   => __( 'License key is disabled.', 'cl-classified' ),
		'site-is-inactive'          => __( 'Site is inactive.', 'cl-classified' ),
		'license-status-unknown'    => __( 'License status is unknown.', 'cl-classified' ),
		'update-notice'             => __( "Updating this theme will lose any customizations you have made. 'Cancel' to stop, 'OK' to update.", 'cl-classified' ),
		'update-available'          => __('<strong>%1$s %2$s</strong> is available. <a href="%3$s" class="thickbox" title="%4s">Check out what\'s new</a> or <a href="%5$s"%6$s>update now</a>.', 'cl-classified' )
	);

	// Loads the updater classes
	$updater = new EDD_Theme_Updater_Admin( $config, $strings );
}