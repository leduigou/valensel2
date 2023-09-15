<?php
/**
 * @author  RadiusTheme
 * @since   1.0.0
 * @version 1.0.0
 */

namespace RadiusTheme\ClassifiedLite;

use RtclPro\Helpers\Fns;

class Helper {

	public static function has_sidebar() {
		return ( self::has_full_width() ) ? false : true;
	}

	public static function has_full_width() {
		$theme_option_full_width = Options::$layout == 'full-width';
		$not_active_sidebar      = ! is_active_sidebar( 'sidebar' );
		$bool                    = $theme_option_full_width || $not_active_sidebar;

		return $bool;
	}

	public static function the_layout_class() {
		$fullwidth_col = ( Options::$options['blog_style'] == 'style1' && is_home() ) ? 'col-sm-10 offset-sm-1 col-12' : 'col-sm-12 col-12';

		$layout_class = self::has_sidebar() ? 'col-lg-8 col-sm-12 col-12' : $fullwidth_col;
		if ( Options::$layout == 'left-sidebar' ) {
			$layout_class .= ' order-lg-2';
		}

		echo apply_filters( 'cl_classified_layout_class', $layout_class );
	}

	public static function the_sidebar_class() {
		$sidebar_class = self::has_sidebar() ? 'col-lg-4 col-sm-12 sidebar-break-lg' : 'col-sm-12 col-12';
		echo apply_filters( 'cl_classified_sidebar_class', $sidebar_class );
	}

	public static function comments_callback( $comment, $args, $depth ) {
		$args2 = get_defined_vars();
		Helper::get_template_part( 'template-parts/comments-callback', $args2 );
	}

	public static function nav_menu_args() {
		$nav_menu_args = [ 'theme_location' => 'primary', 'container' => 'nav', 'fallback_cb' => false ];

		return $nav_menu_args;
	}

	public static function requires( $filename, $dir = false ) {
		if ( $dir ) {
			$child_file = get_stylesheet_directory() . '/' . $dir . '/' . $filename;

			if ( file_exists( $child_file ) ) {
				$file = $child_file;
			} else {
				$file = get_template_directory() . '/' . $dir . '/' . $filename;
			}
		} else {
			$child_file = get_stylesheet_directory() . '/inc/' . $filename;

			if ( file_exists( $child_file ) ) {
				$file = $child_file;
			} else {
				$file = Constants::$theme_inc_dir . $filename;
			}
		}
		if ( file_exists( $file ) ) {
			require_once $file;
		} else {
			return false;
		}
	}

	public static function get_file( $path ) {
		$file = get_stylesheet_directory_uri() . $path;
		if ( ! file_exists( $file ) ) {
			$file = get_template_directory_uri() . $path;
		}

		return $file;
	}

	public static function get_img( $filename ) {
		$path = '/assets/img/' . $filename;

		return self::get_file( $path );
	}

	public static function get_css( $filename ) {
		$path = '/assets/css/' . $filename . '.css';

		return self::get_file( $path );
	}

	public static function get_maybe_rtl_css( $filename ) {
		if ( is_rtl() ) {
			$path = '/assets/css-rtl/' . $filename . '.css';

			return self::get_file( $path );
		} else {
			return self::get_css( $filename );
		}
	}

	public static function get_rtl_css( $filename ) {
		$path = '/assets/css-rtl/' . $filename . '.css';

		return self::get_file( $path );
	}

	public static function get_js( $filename ) {
		$path = '/assets/js/' . $filename . '.js';

		return self::get_file( $path );
	}

	public static function get_template_part( $template, $args = [] ) {
		extract( $args );

		$template = '/' . $template . '.php';

		if ( file_exists( get_stylesheet_directory() . $template ) ) {
			$file = get_stylesheet_directory() . $template;
		} else {
			$file = get_template_directory() . $template;
		}
		if ( file_exists( $file ) ) {
			require $file;
		} else {
			return false;
		}
	}

	/**
	 * Get all sidebar list
	 *
	 * @return array
	 */
	public static function custom_sidebar_fields() {
		$base                                   = 'cl_classified';
		$sidebar_fields                         = [];
		$sidebar_fields['sidebar']              = esc_html__( 'Sidebar', 'cl-classified' );
		$sidebar_fields['rtcl-archive-sidebar'] = esc_html__( 'Listing Archive Sidebar', 'cl-classified' );
		$sidebar_fields['rtcl-single-sidebar']  = esc_html__( 'Listing Single Sidebar', 'cl-classified' );
		$sidebars                               = get_option( "{$base}_custom_sidebars", [] );

		if ( $sidebars ) {
			foreach ( $sidebars as $sidebar ) {
				$sidebar_fields[ $sidebar['id'] ] = $sidebar['name'];
			}
		}

		return $sidebar_fields;
	}

	/**
	 * Get site header list
	 *
	 * @param string $return_type
	 *
	 * @return array
	 */
	public static function get_header_list( $return_type = '' ) {
		if ( 'header' === $return_type ) {
			return [
				'1' => [
					'image' => trailingslashit( get_template_directory_uri() ) . 'assets/img/header-1.png',
					'name'  => esc_html__( 'Style 1', 'cl-classified' )
				]
			];
		} else {
			return [
				'default' => esc_html__( 'Default', 'cl-classified' ),
				'1'       => esc_html__( 'Layout 1', 'cl-classified' )
			];
		}
	}

	/**
	 * Get site footer list
	 *
	 * @param string $return_type
	 *
	 * @return array
	 */
	public static function get_footer_list( $return_type = '' ) {
		if ( 'footer' === $return_type ) {
			$layout = [
				'1' => [
					'image' => trailingslashit( get_template_directory_uri() ) . 'assets/img/footer-1.png',
					'name'  => esc_html__( 'Layout 1', 'cl-classified' )
				]
			];
		} else {
			$layout = [
				'default' => esc_html__( 'Default', 'cl-classified' ),
				'1'       => esc_html__( 'Layout 1', 'cl-classified' )
			];
		}

		return apply_filters( 'cl_classified_footer_layout', $layout );
	}

	/**
	 * Get site search style
	 *
	 * @return array
	 */

	public static function get_search_form_style() {
		$style = [
			'standard' => esc_html__( 'Standard', 'cl-classified' ),
		];

		if ( class_exists( 'RtclPro' ) ) {
			$style = array_merge( $style, [
				'popup'      => esc_html__( 'Popup', 'cl-classified' ),
				'suggestion' => esc_html__( 'Auto Suggestion', 'cl-classified' ),
				'dependency' => esc_html__( 'Dependency Selection', 'cl-classified' ),
			] );
		}

		return $style;
	}

	public static function get_custom_listing_template( $template, $echo = true, $args = [], $path = 'custom/' ) {
		$template = 'classified-listing/' . $path . $template;
		if ( $echo ) {
			self::get_template_part( $template, $args );
		} else {
			$template .= '.php';

			return $template;
		}
	}

	public static function get_custom_store_template( $template, $echo = true, $args = [] ) {
		$template = 'classified-listing/store/custom/' . $template;
		if ( $echo ) {
			self::get_template_part( $template, $args );
		} else {
			$template .= '.php';

			return $template;
		}
	}

	public static function is_chat_enabled() {
		if ( Options::$options['header_chat_icon'] && class_exists( 'Rtcl' ) && class_exists( 'RtclPro' ) ) {
			if ( Fns::is_enable_chat() ) {
				return true;
			}
		}

		return false;
	}

	public static function get_primary_color() {
		return apply_filters( 'rdtheme_primary_color', Options::$options['primary_color'] );
	}

	public static function get_secondary_color() {
		return apply_filters( 'rdtheme_secondary_color', Options::$options['secondary_color'] );
	}

	public static function get_top_bg_color() {
		return apply_filters( 'rdtheme_top_bg_color', Options::$options['top_listing_bg'] );
	}

	public static function get_lite_primary_color() {
		return apply_filters( 'rdtheme_lite_primary_color', Options::$options['lite_primary_color'] );
	}

	public static function is_header_btn_enabled() {
		$btn_flag = get_theme_mod( 'header_btn' );
		if ( empty( $btn_flag ) ) {
			return false;
		}

		return true;
	}

	public static function is_trheader_enable() {
		$tr_header = get_theme_mod( 'tr_header' );
		if ( empty( $tr_header ) ) {
			return false;
		}

		return true;
	}

	public static function is_copyright_area_enabled() {
		$flag = get_theme_mod( 'copyright_area' );
		if ( empty( $flag ) ) {
			return false;
		}

		return true;
	}

	public static function is_login_btn_enabled() {
		$btn_flag = get_theme_mod( 'header_login_icon' );
		if ( empty( $btn_flag ) ) {
			return false;
		}

		return true;
	}

	public static function wp_set_temp_query( $query ) {
		global $wp_query;
		$temp     = $wp_query;
		$wp_query = $query;

		return $temp;
	}

	public static function wp_reset_temp_query( $temp ) {
		global $wp_query;
		$wp_query = $temp;
		wp_reset_postdata();
	}

	public static function hex2rgb( $hex ) {
		$hex = str_replace( "#", "", $hex );
		if ( strlen( $hex ) == 3 ) {
			$r = hexdec( substr( $hex, 0, 1 ) . substr( $hex, 0, 1 ) );
			$g = hexdec( substr( $hex, 1, 1 ) . substr( $hex, 1, 1 ) );
			$b = hexdec( substr( $hex, 2, 1 ) . substr( $hex, 2, 1 ) );
		} else {
			$r = hexdec( substr( $hex, 0, 2 ) );
			$g = hexdec( substr( $hex, 2, 2 ) );
			$b = hexdec( substr( $hex, 4, 2 ) );
		}
		$rgb = "$r, $g, $b";

		return $rgb;
	}

	public static function socials() {
		$rdtheme_socials = [
			'facebook'  => [
				'icon' => 'fab fa-facebook-square',
				'url'  => Options::$options['facebook'],
			],
			'twitter'   => [
				'icon' => 'fab fa-twitter',
				'url'  => Options::$options['twitter'],
			],
			'linkedin'  => [
				'icon' => 'fab fa-linkedin-in',
				'url'  => Options::$options['linkedin'],
			],
			'youtube'   => [
				'icon' => 'fab fa-youtube',
				'url'  => Options::$options['youtube'],
			],
			'pinterest' => [
				'icon' => 'fab fa-pinterest',
				'url'  => Options::$options['pinterest'],
			],
			'instagram' => [
				'icon' => 'fab fa-instagram',
				'url'  => Options::$options['instagram'],
			],
			'skype'     => [
				'icon' => 'fab fa-skype',
				'url'  => Options::$options['skype'],
			],
		];

		return array_filter( $rdtheme_socials, [ __CLASS__, 'filter_social' ] );
	}

	public static function filter_social( $args ) {
		return ( $args['url'] != '' );
	}
}