<?php
/*
Plugin Name: CL Classified Core
Plugin URI: https://www.radiustheme.com
Description: CL Classified Core Plugin for Classified Theme
Version: 1.0.2
Author: RadiusTheme
Author URI: https://www.radiustheme.com
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'CL_CLASSIFIED_CORE' ) ) {
	$plugin_data = get_file_data( __FILE__, [ 'version' => 'Version' ] );
	define( 'CL_CLASSIFIED_CORE', $plugin_data['version'] );
	define( 'CL_CLASSIFIED_CORE_THEME_PREFIX', 'cl_classified' );
	define( 'CL_CLASSIFIED_CORE_BASE_DIR', plugin_dir_path( __FILE__ ) );
}

class CL_Classified_Core {

	public $plugin = 'cl-classified-core';
	public $action = 'cl_classified_theme_init';
	protected static $instance;

	public function __construct() {
		add_action( 'plugins_loaded', [ $this, 'demo_importer' ], 17 );
		add_action( 'plugins_loaded', [ $this, 'load_textdomain' ], 20 );
		add_action( $this->action, [ $this, 'after_theme_loaded' ] );
	}

	public static function instance() {
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	public function after_theme_loaded() {
		require_once CL_CLASSIFIED_CORE_BASE_DIR . 'lib/wp-svg/init.php'; // SVG support

		if ( defined( 'RT_FRAMEWORK_VERSION' ) ) {
			require_once CL_CLASSIFIED_CORE_BASE_DIR . 'inc/post-meta.php'; // Post Meta
			require_once CL_CLASSIFIED_CORE_BASE_DIR . 'widgets/init.php'; // Widgets
		}

		if ( did_action( 'elementor/loaded' ) ) {
			require_once CL_CLASSIFIED_CORE_BASE_DIR . 'elementor/init.php'; // Elementor
		}
	}

	public function demo_importer() {
		require_once CL_CLASSIFIED_CORE_BASE_DIR . 'inc/demo-importer.php';
	}

	public function load_textdomain() {
		load_plugin_textdomain( $this->plugin, false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
	}

	public static function social_share( $sharer = [] ) {
		include CL_CLASSIFIED_CORE_BASE_DIR . 'inc/social-share.php';
	}
}

CL_Classified_Core::instance();