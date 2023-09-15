<?php
/**
 * @author  RadiusTheme
 * @since   1.0.0
 * @version 1.0.0
 */

namespace RadiusTheme\ClassifiedLite\Customizer\Settings;

use RadiusTheme\ClassifiedLite\Customizer\Controls\Image_Radio;
use RadiusTheme\ClassifiedLite\Customizer\Controls\Separator;
use RadiusTheme\ClassifiedLite\Customizer\Controls\Switcher;
use RadiusTheme\ClassifiedLite\Customizer\Customizer;
use RadiusTheme\ClassifiedLite\Helper;
use WP_Customize_Media_Control;

/**
 * Adds the individual sections, settings, and controls to the theme customizer
 */
class Footer extends Customizer {

	public function __construct() {
		parent::instance();
		$this->populated_default_data();
		// Add Controls
		add_action( 'customize_register', [ $this, 'register_footer_controls' ] );
	}

	public function register_footer_controls( $wp_customize ) {
		// Footer Style
		$wp_customize->add_setting( 'footer_style',
			[
				'default'           => $this->defaults['footer_style'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_radio_sanitization',
			]
		);
		$wp_customize->add_control( new Image_Radio( $wp_customize, 'footer_style',
			[
				'label'       => esc_html__( 'Footer Layout', 'cl-classified' ),
				'description' => esc_html__( 'Select the header style', 'cl-classified' ),
				'section'     => 'footer_section',
				'choices'     => Helper::get_footer_list( 'footer' ),
			]
		) );

		// Copyright Area Control
		$wp_customize->add_setting( 'copyright_area',
			[
				'default'           => $this->defaults['copyright_area'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_switch_sanitization',
			]
		);
		$wp_customize->add_control( new Switcher( $wp_customize, 'copyright_area',
			[
				'label'   => esc_html__( 'Display Copyright Area', 'cl-classified' ),
				'section' => 'footer_section',
			]
		) );

		// Copyright Text
		$wp_customize->add_setting( 'copyright_text',
			[
				'default'           => $this->defaults['copyright_text'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_textarea_field',
			]
		);
		$wp_customize->add_control( 'copyright_text',
			[
				'label'           => esc_html__( 'Copyright Text', 'cl-classified' ),
				'section'         => 'footer_section',
				'type'            => 'textarea',
				'active_callback' => [ '\RadiusTheme\ClassifiedLite\Helper', 'is_copyright_area_enabled' ],
			]
		);

		// Separator
		$wp_customize->add_setting( 'separator_footer1', [
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		] );
		$wp_customize->add_control( new Separator( $wp_customize, 'separator_footer1', [
			'settings' => 'separator_footer1',
			'section'  => 'footer_section',
		] ) );

		// App Store Image
		$wp_customize->add_setting( 'app_store_image',
			[
				'default'           => $this->defaults['app_store_image'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'absint',
			]
		);
		$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'app_store_image',
			[
				'label'         => esc_html__( 'App Store Image', 'cl-classified' ),
				'description'   => esc_html__( 'This image will show on Footer.', 'cl-classified' ),
				'section'       => 'footer_section',
				'mime_type'     => 'image',
				'button_labels' => [
					'select'       => esc_html__( 'Select Image', 'cl-classified' ),
					'change'       => esc_html__( 'Change Image', 'cl-classified' ),
					'default'      => esc_html__( 'Default', 'cl-classified' ),
					'remove'       => esc_html__( 'Remove', 'cl-classified' ),
					'placeholder'  => esc_html__( 'No file selected', 'cl-classified' ),
					'frame_title'  => esc_html__( 'Select File', 'cl-classified' ),
					'frame_button' => esc_html__( 'Choose File', 'cl-classified' ),
				],
			]
		) );

		// App Store URL
		$wp_customize->add_setting( 'app_store_url',
			[
				'default'           => $this->defaults['app_store_url'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_url_sanitization',
			]
		);
		$wp_customize->add_control( 'app_store_url',
			[
				'label'   => esc_html__( 'App Store Link', 'cl-classified' ),
				'section' => 'footer_section',
				'type'    => 'url',
			]
		);

		// Separator
		$wp_customize->add_setting( 'separator_footer2', [
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		] );
		$wp_customize->add_control( new Separator( $wp_customize, 'separator_footer2', [
			'settings' => 'separator_footer2',
			'section'  => 'footer_section',
		] ) );

		// Play Store Image
		$wp_customize->add_setting( 'play_store_image',
			[
				'default'           => $this->defaults['play_store_image'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'absint',
			]
		);
		$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'play_store_image',
			[
				'label'         => esc_html__( 'Play Store Image', 'cl-classified' ),
				'description'   => esc_html__( 'This image will show on Footer.', 'cl-classified' ),
				'section'       => 'footer_section',
				'mime_type'     => 'image',
				'button_labels' => [
					'select'       => esc_html__( 'Select Image', 'cl-classified' ),
					'change'       => esc_html__( 'Change Image', 'cl-classified' ),
					'default'      => esc_html__( 'Default', 'cl-classified' ),
					'remove'       => esc_html__( 'Remove', 'cl-classified' ),
					'placeholder'  => esc_html__( 'No file selected', 'cl-classified' ),
					'frame_title'  => esc_html__( 'Select File', 'cl-classified' ),
					'frame_button' => esc_html__( 'Choose File', 'cl-classified' ),
				],
			]
		) );

		// Play Store URL
		$wp_customize->add_setting( 'play_store_url',
			[
				'default'           => $this->defaults['play_store_url'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_url_sanitization',
			]
		);
		$wp_customize->add_control( 'play_store_url',
			[
				'label'   => esc_html__( 'Play Store Link', 'cl-classified' ),
				'section' => 'footer_section',
				'type'    => 'url',
			]
		);
	}
}