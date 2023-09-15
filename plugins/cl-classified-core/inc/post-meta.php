<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RadiusTheme\CL_Classified_Core;

use RadiusTheme\ClassifiedLite\Helper;
use \RT_Postmeta;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'RT_Postmeta' ) ) {
	return;
}

$Postmeta = RT_Postmeta::getInstance();

$prefix = CL_CLASSIFIED_CORE_THEME_PREFIX;

/*-------------------------------------
#. Layout Settings
---------------------------------------*/
$nav_menus = wp_get_nav_menus( [ 'fields' => 'id=>name' ] );
$nav_menus = [ 'default' => esc_html__( 'Default', 'cl-classified-core' ) ] + $nav_menus;
$sidebars  = [ 'default' => esc_html__( 'Default', 'cl-classified-core' ) ] + Helper::custom_sidebar_fields();

$Postmeta->add_meta_box( "{$prefix}_page_settings", esc_html__( 'Layout Settings', 'cl-classified-core' ), [
	'page',
	'post'
], '', '', 'high', [
	'fields' => [
		"{$prefix}_layout_settings" => [
			'label' => esc_html__( 'Layouts', 'cl-classified-core' ),
			'type'  => 'group',
			'value' => [
				'layout'        => [
					'label'   => esc_html__( 'Layout', 'cl-classified-core' ),
					'type'    => 'select',
					'options' => [
						'default'       => esc_html__( 'Default', 'cl-classified-core' ),
						'full-width'    => esc_html__( 'Full Width', 'cl-classified-core' ),
						'left-sidebar'  => esc_html__( 'Left Sidebar', 'cl-classified-core' ),
						'right-sidebar' => esc_html__( 'Right Sidebar', 'cl-classified-core' ),
					],
					'default' => 'default',
				],
				'sidebar'       => [
					'label'   => esc_html__( 'Custom Sidebar', 'cl-classified-core' ),
					'type'    => 'select',
					'options' => $sidebars,
					'default' => 'default',
				],
				'tr_header'     => [
					'label'   => esc_html__( 'Transparent Header', 'cl-classified-core' ),
					'type'    => 'select',
					'options' => [
						'default' => esc_html__( 'Default', 'cl-classified-core' ),
						'on'      => esc_html__( 'Enable', 'cl-classified-core' ),
						'off'     => esc_html__( 'Disable', 'cl-classified-core' ),
					],
					'default' => 'default',
				],
				'top_bar'       => [
					'label'   => esc_html__( 'Top Bar', 'cl-classified-core' ),
					'type'    => 'select',
					'options' => [
						'default' => esc_html__( 'Default', 'cl-classified-core' ),
						'on'      => esc_html__( 'Enable', 'cl-classified-core' ),
						'off'     => esc_html__( 'Disable', 'cl-classified-core' ),
					],
					'default' => 'default',
				],
				'header_style'  => [
					'label'   => esc_html__( 'Header Layout', 'cl-classified-core' ),
					'type'    => 'select',
					'options' => Helper::get_header_list(),
					'default' => 'default',
				],
				'footer_style'  => [
					'label'   => esc_html__( 'Footer Style', 'cl-classified-core' ),
					'type'    => 'select',
					'options' => Helper::get_footer_list(),
					'default' => 'default',
				],
				'banner'        => [
					'label'   => esc_html__( 'Banner', 'cl-classified-core' ),
					'type'    => 'select',
					'options' => [
						'default' => esc_html__( 'Default', 'cl-classified-core' ),
						'on'      => esc_html__( 'Enable', 'cl-classified-core' ),
						'off'     => esc_html__( 'Disable', 'cl-classified-core' ),
					],
					'default' => 'default',
				],
				'breadcrumb'    => [
					'label'   => esc_html__( 'Breadcrumb', 'cl-classified-core' ),
					'type'    => 'select',
					'options' => [
						'default' => esc_html__( 'Default', 'cl-classified-core' ),
						'on'      => esc_html__( 'Enable', 'cl-classified-core' ),
						'off'     => esc_html__( 'Disable', 'cl-classified-core' ),
					],
					'default' => 'default',
				],
				'banner_search' => [
					'label'   => esc_html__( 'Banner Search', 'cl-classified-core' ),
					'type'    => 'select',
					'options' => [
						'default' => esc_html__( 'Default', 'cl-classified-core' ),
						'on'      => esc_html__( 'Enabled', 'cl-classified-core' ),
						'off'     => esc_html__( 'Disabled', 'cl-classified-core' ),
					],
					'default' => 'default',
				],
				'bgimg'         => [
					'label' => esc_html__( 'Banner Search Background Image', 'cl-classified-core' ),
					'type'  => 'image',
					'desc'  => esc_html__( 'If not selected, default will be used', 'cl-classified-core' ),
				],
			]
		]
	]
] );