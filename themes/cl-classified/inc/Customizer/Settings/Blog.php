<?php
/**
 * @author  RadiusTheme
 * @since   1.0.0
 * @version 1.0.0
 */

namespace RadiusTheme\ClassifiedLite\Customizer\Settings;

use RadiusTheme\ClassifiedLite\Customizer\Controls\Image_Radio;
use RadiusTheme\ClassifiedLite\Customizer\Controls\Switcher;
use RadiusTheme\ClassifiedLite\Customizer\Customizer;

/**
 * Adds the individual sections, settings, and controls to the theme customizer
 */
class Blog extends Customizer {

	public function __construct() {
		parent::instance();
		$this->populated_default_data();
		// Add Controls
		add_action( 'customize_register', [ $this, 'register_blog_archive_controls' ] );
	}

	/**
	 * Blog Archive Controls
	 */
	public function register_blog_archive_controls( $wp_customize ) {
		// Blog Style
		$wp_customize->add_setting( 'blog_style',
			[
				'default'           => $this->defaults['blog_style'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_radio_sanitization',
			]
		);
		$wp_customize->add_control( new Image_Radio( $wp_customize, 'blog_style',
			[
				'label'       => esc_html__( 'Blog Layout', 'cl-classified' ),
				'description' => esc_html__( 'Select the blog style', 'cl-classified' ),
				'section'     => 'blog_archive_section',
				'choices'     => [
					'style1' => [
						'image' => trailingslashit( get_template_directory_uri() ) . 'assets/img/blog1.jpg',
						'name'  => esc_html__( 'List', 'cl-classified' ),
					],
					'style2' => [
						'image' => trailingslashit( get_template_directory_uri() ) . 'assets/img/blog2.jpg',
						'name'  => esc_html__( 'Grid', 'cl-classified' ),
					],
				],
			]
		) );

		$wp_customize->add_setting( 'blog_date',
			[
				'default'           => $this->defaults['blog_date'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_switch_sanitization',
			]
		);
		$wp_customize->add_control( new Switcher( $wp_customize, 'blog_date',
			[
				'label'   => esc_html__( 'Display Date', 'cl-classified' ),
				'section' => 'blog_archive_section',
			]
		) );

		$wp_customize->add_setting( 'blog_author_name',
			[
				'default'           => $this->defaults['blog_author_name'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_switch_sanitization',
			]
		);
		$wp_customize->add_control( new Switcher( $wp_customize, 'blog_author_name',
			[
				'label'   => esc_html__( 'Display Author Name', 'cl-classified' ),
				'section' => 'blog_archive_section',
			]
		) );

		// Blog Cat Visibility
		$wp_customize->add_setting( 'blog_cat_visibility',
			[
				'default'           => $this->defaults['blog_cat_visibility'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_switch_sanitization',
			]
		);
		$wp_customize->add_control( new Switcher( $wp_customize, 'blog_cat_visibility',
			[
				'label'   => esc_html__( 'Display Category', 'cl-classified' ),
				'section' => 'blog_archive_section',
			]
		) );

		// Blog Button
		$wp_customize->add_setting( 'blog_button',
			[
				'default'           => $this->defaults['blog_button'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_switch_sanitization',
			]
		);
		$wp_customize->add_control( new Switcher( $wp_customize, 'blog_button',
			[
				'label'   => esc_html__( 'Display Button', 'cl-classified' ),
				'section' => 'blog_archive_section',
			]
		) );

		// Blog Comment Visibility
		$wp_customize->add_setting( 'blog_comment_num',
			[
				'default'           => $this->defaults['blog_comment_num'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_switch_sanitization',
			]
		);
		$wp_customize->add_control( new Switcher( $wp_customize, 'blog_comment_num',
			[
				'label'   => esc_html__( 'Display Comment Count', 'cl-classified' ),
				'section' => 'blog_archive_section',
			]
		) );

		$wp_customize->add_setting( 'excerpt_length',
			[
				'default'           => $this->defaults['excerpt_length'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_sanitize_integer',
			]
		);
		$wp_customize->add_control( 'excerpt_length',
			[
				'label'   => esc_html__( 'Excerpt Length', 'cl-classified' ),
				'section' => 'blog_archive_section',
				'type'    => 'number',
			]
		);
	}
}