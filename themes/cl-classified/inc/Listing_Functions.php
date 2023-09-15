<?php
/**
 * @author  RadiusTheme
 * @since   1.0.0
 * @version 1.0.0
 */

namespace RadiusTheme\ClassifiedLite;

use Rtcl\Controllers\Hooks\TemplateHooks;
use Rtcl\Helpers\Functions;
use RtclStore\Controllers\Hooks\TemplateHooks as StoreHooks;

class Listing_Functions {

	protected static $instance = null;

	public function __construct() {
		add_action( 'after_setup_theme', [ $this, 'theme_support' ] );
		add_action( 'init', [ $this, 'rtcl_action_hook' ] );
		add_action( 'init', [ $this, 'rtcl_filter_hook' ] );
	}

	public static function instance() {
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	public function theme_support() {
		add_theme_support( 'rtcl' );
	}

	public function rtcl_action_hook() {
		if ( isset( $_GET['view'] ) && in_array( $_GET['view'], [ 'grid', 'list' ], true ) ) {
			$view = esc_attr( $_GET['view'] );
		} else {
			$view = Functions::get_option_item( 'rtcl_general_settings', 'default_view', 'list' );
		}
		// remove action
		remove_action( 'rtcl_before_main_content', [ TemplateHooks::class, 'breadcrumb' ], 6 );
		remove_action( 'rtcl_listing_loop_item', [ TemplateHooks::class, 'loop_item_excerpt' ], 70 );
		remove_action( 'rtcl_single_listing_content', [ TemplateHooks::class, 'add_single_listing_gallery' ], 30 );
		remove_action( 'rtcl_single_listing_inner_sidebar', [
			TemplateHooks::class,
			'add_single_listing_inner_sidebar_custom_field'
		], 10 );
		remove_action( 'rtcl_single_listing_inner_sidebar', [
			TemplateHooks::class,
			'add_single_listing_inner_sidebar_action'
		], 20 );
		if ( class_exists( 'RtclStore' ) ) {
			remove_action( 'rtcl_single_store_information', [ StoreHooks::class, 'store_social_media' ], 40 );
			add_action( 'rtcl_single_store_information', [ StoreHooks::class, 'store_social_media' ], 60 );
		}
		// add action
		if ( 'list' === $view ) {
			remove_action( 'rtcl_listing_loop_item', [ TemplateHooks::class, 'listing_price' ], 80 );
			add_action( 'rtcl_listing_loop_item', [ __CLASS__, 'loop_item_category_price' ], 15 );
			add_action( 'rtcl_listing_loop_item', [ TemplateHooks::class, 'loop_item_excerpt' ], 45 );
		}
	}

	public function rtcl_filter_hook() {
		add_filter( 'rtcl_listing_the_excerpt', function ( $excerpt ) {
			return wp_trim_words( $excerpt, 25 );
		} );
		// Override Related Listing Item Number
		add_filter( 'rtcl_related_slider_options', function ( $slider_options ) {
			$slider_options = [
				"loop"         => false,
				"autoplay"     => [
					"delay"                => 3000,
					"disableOnInteraction" => false,
					"pauseOnMouseEnter"    => true
				],
				"speed"        => 1000,
				"spaceBetween" => 20,
				"breakpoints"  => [
					0    => [
						"slidesPerView" => 1
					],
					500  => [
						"slidesPerView" => 2
					],
					1200 => [
						"slidesPerView" => 3
					]
				]
			];

			return $slider_options;
		} );
	}

	public static function loop_item_category_price() {
		global $listing;
		if ( $listing->has_category() && $listing->can_show_category() ) {
			$category = $listing->get_categories();
			$category = end( $category );
			?>
            <div class="listing-cat-price">
                <a class="listing-categories" href="<?php echo esc_url( get_term_link( $category ) ); ?>">
					<?php echo esc_html( $category->name ); ?>
                </a>
				<?php Functions::get_template( 'listing/loop/price' ); ?>
            </div>
			<?php
		}
	}

}