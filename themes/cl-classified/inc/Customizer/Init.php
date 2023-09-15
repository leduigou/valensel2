<?php

namespace RadiusTheme\ClassifiedLite\Customizer;

use RadiusTheme\ClassifiedLite\Customizer\Settings\Blog;
use RadiusTheme\ClassifiedLite\Customizer\Settings\Blog_Layout;
use RadiusTheme\ClassifiedLite\Customizer\Settings\Color;
use RadiusTheme\ClassifiedLite\Customizer\Settings\Contact_Info;
use RadiusTheme\ClassifiedLite\Customizer\Settings\Error;
use RadiusTheme\ClassifiedLite\Customizer\Settings\Error_Layout;
use RadiusTheme\ClassifiedLite\Customizer\Settings\General;
use RadiusTheme\ClassifiedLite\Customizer\Settings\Header;
use RadiusTheme\ClassifiedLite\Customizer\Settings\Footer;
use RadiusTheme\ClassifiedLite\Customizer\Settings\Listing_Archive_Layout;
use RadiusTheme\ClassifiedLite\Customizer\Settings\Listing_Single_Layout;
use RadiusTheme\ClassifiedLite\Customizer\Settings\Listings;
use RadiusTheme\ClassifiedLite\Customizer\Settings\Page_Layout;
use RadiusTheme\ClassifiedLite\Customizer\Settings\Post;
use RadiusTheme\ClassifiedLite\Customizer\Settings\Post_Layout;
use RadiusTheme\ClassifiedLite\Customizer\Typography\Typography;

class Init {
	protected static $instance = null;

	/**
	 * Create an inaccessible constructor.
	 */
	private function __construct() {
		$this->includes();
	}

	public static function instance() {
		if ( null == self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	private function includes() {
		new General();
		new Header();
		new Footer();
		new Blog();
		new Post();
		new Error();
		new Contact_Info();
		new Typography();
		new Color();
		// Layout
		new Blog_Layout();
		new Post_Layout();
		new Page_Layout();
		new Error_Layout();
		// Listings
		if ( class_exists( 'Rtcl' ) ) {
			new Listings();
			new Listing_Archive_Layout();
			new Listing_Single_Layout();
		}
	}
}