<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RadiusTheme\ClassifiedLite\Customizer\Settings;

use RadiusTheme\ClassifiedLite\Customizer\Controls\Separator;
use RadiusTheme\ClassifiedLite\Customizer\Controls\Switcher;
use RadiusTheme\ClassifiedLite\Customizer\Customizer;
use RadiusTheme\ClassifiedLite\Helper;
use WP_Customize_Media_Control;

/**
 * Adds the individual sections, settings, and controls to the theme customizer
 */
class General extends Customizer {

	public function __construct() {
		parent::instance();
		$this->populated_default_data();
		// Add Controls
		add_action( 'customize_register', [ $this, 'register_general_controls' ] );
	}

	public function register_general_controls( $wp_customize ) {
		// Main Logo
		$wp_customize->add_setting( 'logo',
			[
				'default'           => $this->defaults['logo'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'absint',
			]
		);
		$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'logo',
			[
				'label'         => esc_html__( 'Main Logo', 'cl-classified' ),
				'description'   => esc_html__( 'Add site main logo', 'cl-classified' ),
				'section'       => 'general_section',
				'mime_type'     => 'image',
				'button_labels' => [
					'select'       => esc_html__( 'Select Logo', 'cl-classified' ),
					'change'       => esc_html__( 'Change Logo', 'cl-classified' ),
					'default'      => esc_html__( 'Default', 'cl-classified' ),
					'remove'       => esc_html__( 'Remove', 'cl-classified' ),
					'placeholder'  => esc_html__( 'No file selected', 'cl-classified' ),
					'frame_title'  => esc_html__( 'Select File', 'cl-classified' ),
					'frame_button' => esc_html__( 'Choose File', 'cl-classified' ),
				],
			]
		) );

		$wp_customize->selective_refresh->add_partial( 'logo', [
			'selector'        => '.site-logo',
			'render_callback' => '__return_false',
		] );

		// White logo
		$wp_customize->add_setting( 'logo_light',
			[
				'default'           => $this->defaults['logo_light'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'absint',
			]
		);
		$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'logo_light',
			[
				'label'         => esc_html__( 'Light Logo', 'cl-classified' ),
				'description'   => esc_html__( 'Add logo for transparent header', 'cl-classified' ),
				'section'       => 'general_section',
				'mime_type'     => 'image',
				'button_labels' => [
					'select'       => esc_html__( 'Select Logo', 'cl-classified' ),
					'change'       => esc_html__( 'Change Logo', 'cl-classified' ),
					'default'      => esc_html__( 'Default', 'cl-classified' ),
					'remove'       => esc_html__( 'Remove', 'cl-classified' ),
					'placeholder'  => esc_html__( 'No file selected', 'cl-classified' ),
					'frame_title'  => esc_html__( 'Select File', 'cl-classified' ),
					'frame_button' => esc_html__( 'Choose File', 'cl-classified' ),
				],
			]
		) );

		// Mobile Logo
		$wp_customize->add_setting( 'mobile_logo',
			[
				'default'           => $this->defaults['mobile_logo'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'absint',
			]
		);
		$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'mobile_logo',
			[
				'label'         => esc_html__( 'Mobile Logo', 'cl-classified' ),
				'description'   => esc_html__( 'Add logo for mobile header', 'cl-classified' ),
				'section'       => 'general_section',
				'mime_type'     => 'image',
				'button_labels' => [
					'select'       => esc_html__( 'Select Logo', 'cl-classified' ),
					'change'       => esc_html__( 'Change Logo', 'cl-classified' ),
					'default'      => esc_html__( 'Default', 'cl-classified' ),
					'remove'       => esc_html__( 'Remove', 'cl-classified' ),
					'placeholder'  => esc_html__( 'No file selected', 'cl-classified' ),
					'frame_title'  => esc_html__( 'Select File', 'cl-classified' ),
					'frame_button' => esc_html__( 'Choose File', 'cl-classified' ),
				],
			]
		) );

		// Logo Width
		$wp_customize->add_setting( 'logo_width',
			[
				'default'           => $this->defaults['logo_width'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_text_sanitization',
			]
		);
		$wp_customize->add_control( 'logo_width',
			[
				'label'           => esc_html__( 'Logo max width', 'cl-classified' ),
				'section'         => 'general_section',
				'type'            => 'text',
				'description'     => esc_html__( 'Enter logo width. Eg: 200px', 'cl-classified' ),
				'input_attrs'     => [
					'placeholder' => esc_html__( '200px', 'cl-classified' ),
				],
			]
		);

		// Separator
		$wp_customize->add_setting( 'separator_general1', [
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		] );
		$wp_customize->add_control( new Separator( $wp_customize, 'separator_general1', [
			'settings' => 'separator_general1',
			'section'  => 'general_section',
		] ) );

		// Banner Image
		$wp_customize->add_setting( 'banner_image',
			[
				'default'           => $this->defaults['banner_image'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'absint',
			]
		);
		$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'banner_image',
			[
				'label'         => esc_html__( 'Banner Image', 'cl-classified' ),
				'description'   => esc_html__( 'Add banner image to change default image', 'cl-classified' ),
				'section'       => 'general_section',
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

		// Back to top
		$wp_customize->add_setting( 'back_to_top',
			[
				'default'           => $this->defaults['back_to_top'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_switch_sanitization',
			]
		);
		$wp_customize->add_control( new Switcher( $wp_customize, 'back_to_top',
			[
				'label'   => esc_html__( 'Back to Top', 'cl-classified' ),
				'section' => 'general_section',
			]
		) );


		// Hide admin bar
		$wp_customize->add_setting( 'remove_admin_bar',
			[
				'default'           => $this->defaults['remove_admin_bar'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_switch_sanitization',
			]
		);
		$wp_customize->add_control( new Switcher( $wp_customize, 'remove_admin_bar',
			[
				'label'       => esc_html__( 'Remove Admin Bar', 'cl-classified' ),
				'section'     => 'general_section',
				'description' => esc_html__( 'This option not work for administrator users.', 'cl-classified' ),
			]
		) );

	}

}
