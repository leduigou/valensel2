<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RadiusTheme\CL_Classified_Core;

use Elementor\Plugin;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class Custom_Widget_Init {

	public function __construct() {
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'init' ] );
		add_action( 'elementor/elements/categories_registered', [ $this, 'widget_categoty' ] );
	}

	public function init() {
		require_once __DIR__ . '/base.php';

		$widgets = [
			'post' => 'Post',
		];

		foreach ( $widgets as $dirname => $class ) {
			$template_name = '/elementor-custom/' . $dirname . '/class.php';
			if ( file_exists( STYLESHEETPATH . $template_name ) ) {
				$file = STYLESHEETPATH . $template_name;
			} elseif ( file_exists( TEMPLATEPATH . $template_name ) ) {
				$file = TEMPLATEPATH . $template_name;
			} else {
				$file = __DIR__ . '/' . $dirname . '/class.php';
			}

			require_once $file;

			$classname = __NAMESPACE__ . '\\' . $class;
			Plugin::instance()->widgets_manager->register_widget_type( new $classname );
		}
	}

	public function widget_categoty( $class ) {
		$id         = CL_CLASSIFIED_CORE_THEME_PREFIX . '-widgets'; // Category /@dev
		$properties = [
			'title' => __( 'RadiusTheme Elements', 'cl-classified-core' ),
		];

		Plugin::$instance->elements_manager->add_category( $id, $properties );
	}

}

new Custom_Widget_Init();