<?php
/**
 * @author  RadiusTheme
 * @since   1.0.0
 * @version 1.1.0
 */

namespace RadiusTheme\ClassifiedLite;

use Rtcl\Helpers\Breadcrumb;

class General {

	protected static $instance = null;

	public function __construct() {
		add_action( 'after_setup_theme', [ $this, 'theme_setup' ] );
		add_action( 'widgets_init', [ $this, 'register_sidebars' ], 99 );
		add_action( 'cl_classified_breadcrumb', [ $this, 'breadcrumb' ] );
		add_filter( 'body_class', [ $this, 'body_classes' ] );
		add_action( 'wp_head', [ $this, 'pingback' ] );
		add_action( 'wp_footer', [ $this, 'scroll_to_top_html' ], 1 );
		add_filter( 'get_search_form', [ $this, 'search_form' ] );
		add_filter( 'post_class', [ $this, 'hentry_config' ] );
		add_filter( 'wp_list_categories', [ $this, 'add_span_cat_count' ] );
		add_filter( 'get_archives_link', [ $this, 'add_span_archive_count' ] );
		add_filter( 'widget_text', 'do_shortcode' );
		// Restrict Admin Area
		add_action( 'after_setup_theme', [ $this, 'restrict_admin_area' ] );
		// Disable Gutenberg widget block
		add_filter( 'gutenberg_use_widgets_block_editor', '__return_false' );// Disables the block editor from managing widgets in the Gutenberg plugin.
		add_filter( 'use_widgets_block_editor', '__return_false' ); // Disables the block editor from managing widgets.
	}

	// disable wp responsive images
	function disable_wp_responsive_images() {
		return 1;
	}

	public static function instance() {
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	public function theme_setup() {
		// Theme supports
		add_theme_support( 'title-tag' );
		add_theme_support( 'align-wide' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'html5', [ 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ] );
		add_theme_support( 'wp-block-styles' );
		add_theme_support( 'custom-logo' );
		add_theme_support( "custom-header" );
		add_theme_support( "custom-background" );
		add_theme_support( 'editor-styles' );

		// Image sizes
		$sizes = [
			'rdtheme-size1' => [ 1200, 650, true ], // When Full width
			'rdtheme-size2' => [ 450, 260, true ], // Listing Thumbnail Size and blog grid
		];

		$sizes = apply_filters( 'cl_classified_image_size', $sizes );

		foreach ( $sizes as $size => $value ) {
			add_image_size( $size, $value[0], $value[1], $value[2] );
		}

		// Register menus
		register_nav_menus(
			[
				'primary' => esc_html__( 'Primary', 'cl-classified' ),
			]
		);
	}

	public function register_sidebars() {

		register_sidebar(
			[
				'name'          => esc_html__( 'Sidebar', 'cl-classified' ),
				'id'            => 'sidebar',
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-heading">',
				'after_title'   => '</h3>',
			]
		);

		$footer_widget_titles = [
			'1' => esc_html__( 'Footer 1', 'cl-classified' ),
			'2' => esc_html__( 'Footer 2', 'cl-classified' ),
			'3' => esc_html__( 'Footer 3', 'cl-classified' ),
			'4' => esc_html__( 'Footer 4', 'cl-classified' ),
		];

		foreach ( $footer_widget_titles as $id => $name ) {
			register_sidebar(
				[
					'name'          => $name,
					'id'            => 'footer-' . $id,
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<h3 class="widgettitle">',
					'after_title'   => '</h3>',
				]
			);
		}
	}

	public function body_classes( $classes ) {
		// Theme Version
		$theme     = wp_get_theme();
		$classes[] = $theme->TextDomain . '-version-' . $theme->Version;
		$classes[] = 'theme-cl-classified';

		// Header
		$header_style = Options::$header_style ? Options::$header_style : 1;
		$classes[]    = 'header-style-' . $header_style;
		$classes[]    = 'header-' . Options::$header_width;

		if ( Options::$has_tr_header ) {
			$classes[] = 'trheader';
		} else {
			$classes[] = 'no-trheader';
		}

		if ( is_front_page() && ! is_home() ) {
			$classes[] = 'front-page';
		}

		if ( Helper::has_full_width() ) {
			$classes[] = 'is-full-width';
		}

		if ( Options::$layout === 'left-sidebar' ) {
			$classes[] = 'sidebar-in-left';
		}

		return $classes;
	}

	public function is_blog() {
		return ( is_archive() || is_author() || is_category() || is_home() || is_single() || is_tag() ) && 'post' == get_post_type();
	}

	public function pingback() {
		if ( is_singular() && pings_open() ) {
			printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
		}
	}

	public function wp_body_open() {
		do_action( 'wp_body_open' );
	}

	public function scroll_to_top_html() {
		// Back-to-top link
		if ( Options::$options['back_to_top'] ) {
			echo '<a href="#" class="scrollToTop" style=""><i class="fa-solid fa-angle-up"></i></a>';
		}
	}

	public function search_form() {
		$output = '
		<form method="get" class="custom-search-form" action="' . esc_url( home_url( '/' ) ) . '">
            <div class="search-box">
                    <div class="form-group mb-0">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="' . esc_attr__( 'Search here...', 'cl-classified' ) . '" value="' . get_search_query() . '" name="s" />
                            <button>
                                <span class="search-btn">
                                    <i class="fas fa-search"></i>
                                </span>
                            </button>
                        </div>
                    </div>
            </div>
		</form>
		';

		return $output;
	}

	public function restrict_admin_area() {
		if ( Options::$options['remove_admin_bar'] && ! current_user_can( 'administrator' ) ) {
			show_admin_bar( false );
		}
	}

	public function hentry_config( $classes ) {
		if ( is_search() || is_page() ) {
			$classes = array_diff( $classes, [ 'hentry' ] );
		}

		return $classes;
	}

	public function add_span_cat_count( $links ) {
		$links = str_replace( '</a> (', '<span>(', $links );
		$links = str_replace( ')', ')</span></a>', $links );

		return $links;
	}

	public function add_span_archive_count( $links ) {
		$links = str_replace( '</a>&nbsp;(', '<span>(', $links );
		$links = str_replace( ')', ')</span></a>', $links );

		return $links;
	}

	public function breadcrumb() {
		$args = [
			'delimiter'   => '<i class="delimiter">/</i>',
			'wrap_before' => '<nav class="rtcl-breadcrumb">',
			'wrap_after'  => '</nav>',
			'before'      => '',
			'after'       => '',
			'home'        => _x( 'Home', 'breadcrumb', 'cl-classified' ),
		];

		$breadcrumbs = new Breadcrumb();

		if ( ! empty( $args['home'] ) ) {
			$breadcrumbs->add_crumb( $args['home'], home_url() );
		}

		$args['breadcrumb'] = $breadcrumbs->generate();

		if ( ! empty( $args['breadcrumb'] ) ) {
			?>
            <section class="breadcrumbs-area">
                <div class="container">
					<?php
					printf( "%s", $args['wrap_before'] );
					foreach ( $args['breadcrumb'] as $key => $crumb ) {
						printf( "%s", $args['before'] );
						if ( ! empty( $crumb[1] ) && sizeof( $args['breadcrumb'] ) !== $key + 1 ) {
							echo '<a href="' . esc_url( $crumb[1] ) . '">' . esc_html( $crumb[0] ) . '</a>';
						} else {
							echo '<span>' . esc_html( $crumb[0] ) . '</span>';
						}
						printf( "%s", $args['after'] );
						if ( sizeof( $args['breadcrumb'] ) !== $key + 1 ) {
							printf( "%s", $args['delimiter'] );
						}
					}
					printf( "%s", $args['wrap_after'] );
					?>
                </div>
            </section>
			<?php
		}
	}
}