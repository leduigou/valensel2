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

/**
 * Adds the individual sections, settings, and controls to the theme customizer
 */
class Listings extends Customizer {

	public function __construct() {
		parent::instance();
		$this->populated_default_data();
		// Register Page Controls
		add_action( 'customize_register', [ $this, 'register_listings_controls' ] );
	}

	public function register_listings_controls( $wp_customize ) {

		// Show or Hide Listing sidebar
		$wp_customize->add_setting(
			'listing_detail_sidebar',
			[
				'default'           => $this->defaults['listing_detail_sidebar'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_switch_sanitization',
			]
		);
		$wp_customize->add_control(
			new Switcher( $wp_customize, 'listing_detail_sidebar',
				[
					'label'   => esc_html__( 'Listing Sidebar Visibility', 'cl-classified' ),
					'section' => 'listings_section',
				]
			)
		);

		// Separator
		$wp_customize->add_setting( 'separator_listing1', [
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		] );
		$wp_customize->add_control( new Separator( $wp_customize, 'separator_listing1', [
			'settings' => 'separator_listing1',
			'section'  => 'listings_section',
		] ) );

		// Banner Search
		$wp_customize->add_setting(
			'banner_search',
			[
				'default'           => $this->defaults['banner_search'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_switch_sanitization',
			]
		);
		$wp_customize->add_control(
			new Switcher( $wp_customize, 'banner_search',
				[
					'label'   => esc_html__( 'Banner Search Visibility', 'cl-classified' ),
					'section' => 'listings_section',
				]
			)
		);

		// Banner Search Type
		$wp_customize->add_setting(
			'banner_search_type',
			[
				'default'           => $this->defaults['banner_search_type'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_switch_sanitization',
			]
		);
		$wp_customize->add_control(
			new Switcher( $wp_customize, 'banner_search_type',
				[
					'label'   => esc_html__( 'Search by Type', 'cl-classified' ),
					'section' => 'listings_section',
				]
			)
		);

		// Banner Search Location
		$wp_customize->add_setting(
			'banner_search_location',
			[
				'default'           => $this->defaults['banner_search_location'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_switch_sanitization',
			]
		);
		$wp_customize->add_control(
			new Switcher( $wp_customize, 'banner_search_location',
				[
					'label'   => esc_html__( 'Search by Location', 'cl-classified' ),
					'section' => 'listings_section',
				]
			)
		);

		// Banner Search Radius
		$wp_customize->add_setting(
			'banner_search_radius',
			[
				'default'           => $this->defaults['banner_search_radius'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_switch_sanitization',
			]
		);
		$wp_customize->add_control(
			new Switcher( $wp_customize, 'banner_search_radius',
				[
					'label'   => esc_html__( 'Search by Radius', 'cl-classified' ),
					'section' => 'listings_section',
				]
			)
		);

		// Banner Search Category
		$wp_customize->add_setting(
			'banner_search_category',
			[
				'default'           => $this->defaults['banner_search_category'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_switch_sanitization',
			]
		);
		$wp_customize->add_control(
			new Switcher( $wp_customize, 'banner_search_category',
				[
					'label'   => esc_html__( 'Search by Category', 'cl-classified' ),
					'section' => 'listings_section',
				]
			)
		);

		// Banner Search Keyword
		$wp_customize->add_setting(
			'banner_search_keyword',
			[
				'default'           => $this->defaults['banner_search_keyword'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_switch_sanitization',
			]
		);
		$wp_customize->add_control(
			new Switcher( $wp_customize, 'banner_search_keyword',
				[
					'label'   => esc_html__( 'Search by keyword', 'cl-classified' ),
					'section' => 'listings_section',
				]
			)
		);

		// Search Style
		$wp_customize->add_setting( 'listing_search_style', [
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'rttheme_text_sanitization',
			'default'           => $this->defaults['listing_search_style'],
		] );

		$wp_customize->add_control( 'listing_search_style', [
			'type'    => 'select',
			'section' => 'listings_section', // Add a default or your own section
			'label'   => esc_html__( 'Search Style', 'cl-classified' ),
			'choices' => Helper::get_search_form_style(),
		] );

		// Separator
		$wp_customize->add_setting( 'separator_listing2', [
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		] );
		$wp_customize->add_control( new Separator( $wp_customize, 'separator_listing2', [
			'settings' => 'separator_listing2',
			'section'  => 'listings_section',
		] ) );

		// Listing Archive Title
		$wp_customize->add_setting(
			'listing_archive_title',
			[
				'default'           => $this->defaults['listing_archive_title'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_switch_sanitization',
			]
		);
		$wp_customize->add_control(
			new Switcher( $wp_customize, 'listing_archive_title',
				[
					'label'   => esc_html__( 'Listing Archive Title Visibility', 'cl-classified' ),
					'section' => 'listings_section',
				]
			)
		);

		// Related Listing
		$wp_customize->add_setting(
			'listing_related',
			[
				'default'           => $this->defaults['listing_related'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_switch_sanitization',
			]
		);
		$wp_customize->add_control(
			new Switcher( $wp_customize, 'listing_related',
				[
					'label'   => esc_html__( 'Related Listing', 'cl-classified' ),
					'section' => 'listings_section',
				]
			)
		);
	}
}