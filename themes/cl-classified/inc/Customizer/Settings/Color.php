<?php
/**
 * @author  RadiusTheme
 * @since   1.0.0
 * @version 1.0.0
 */

namespace RadiusTheme\ClassifiedLite\Customizer\Settings;

use RadiusTheme\ClassifiedLite\Customizer\Customizer;
use WP_Customize_Color_Control;

/**
 * Adds the individual sections, settings, and controls to the theme customizer
 */
class Color extends Customizer {

	public function __construct() {
		parent::instance();
		$this->populated_default_data();
		// Add Controls
		add_action( 'customize_register', [ $this, 'register_color_controls' ] );
	}

	public function register_color_controls( $wp_customize ) {
		// Primary Color
		$wp_customize->add_setting( 'primary_color',
			[
				'default'           => $this->defaults['primary_color'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			]
		);
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'primary_color',
			[
				'label'   => esc_html__( 'Primary Color', 'cl-classified' ),
				'section' => 'site_color_section',
			]
		) );
		// Primary Lite Color
		$wp_customize->add_setting( 'lite_primary_color',
			[
				'default'           => $this->defaults['lite_primary_color'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			]
		);
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'lite_primary_color',
			[
				'label'   => esc_html__( 'Primary Lite Color', 'cl-classified' ),
				'section' => 'site_color_section',
			]
		) );
		// Secondary Color
		$wp_customize->add_setting( 'secondary_color',
			[
				'default'           => $this->defaults['secondary_color'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			]
		);
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'secondary_color',
			[
				'label'   => esc_html__( 'Secondary Color', 'cl-classified' ),
				'section' => 'site_color_section',
			]
		) );
		// Top Listing Background
		$wp_customize->add_setting( 'top_listing_bg',
			[
				'default'           => $this->defaults['top_listing_bg'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			]
		);
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'top_listing_bg',
			[
				'label'   => esc_html__( 'Top Listing Background Color', 'cl-classified' ),
				'section' => 'site_color_section',
			]
		) );
	}
}