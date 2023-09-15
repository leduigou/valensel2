<?php
/**
 * @author  RadiusTheme
 * @since   1.0.0
 * @version 1.0.1
 */

namespace RadiusTheme\ClassifiedLite\Customizer;

class Default_Data {

	// Customizer Default Data

	public static function default_values() {
		$customizer_defaults = [

			// General
			'logo'                           => '',
			'logo_light'                     => '',
			'mobile_logo'                    => '',
			'logo_width'                     => '200px',
			'banner_image'                   => '',
			'back_to_top'                    => 1,
			'remove_admin_bar'               => 0,

			// Header
			'top_bar'                        => 0,
			'sticky_header'                  => 0,
			'header_btn'                     => 0,
			'header_btn_txt'                 => 'Add Listing',
			'header_btn_url'                 => '#',
			'breadcrumb'                     => 1,
			'header_login_icon'              => 1,
			'header_chat_icon'               => 0,
			'header_style'                   => '1',
			'header_width'                   => 'box-width',
			'menu_alignment'                 => 'menu-center',
			'tr_header'                      => 0,
			'header_transparent_color'       => 'rgba(255, 255, 255, .5)',

			// Blog Archive
			'blog_style'                     => 'style1',
			'blog_date'                      => 1,
			'blog_author_name'               => 1,
			'blog_cat_visibility'            => 1,
			'blog_comment_num'               => 1,
			'excerpt_length'                 => 40,
			'blog_button'                    => 1,

			// Single Post
			'post_date'                      => 1,
			'post_author_name'               => 1,
			'post_comment_num'               => 1,
			'post_cats'                      => 1,
			'post_details_related_section'   => 0,
			'post_tag'                       => 1,
			'post_social_icon'               => 0,

			// Error
			'error_bodybanner'               => '',
			'error_text'                     => 'ERROR PAGE!',
			'error_subtitle'                 => 'Sorry! This Page is Not Available!',
			'error_buttontext'               => 'Go Back To Home Page',

			// Footer
			'footer_style'                   => '1',
			'copyright_area'                 => 1,
			'copyright_text'                 => date( 'Y' ) . '© All right reserved by Radiustheme',
			'app_store_image'                => '',
			'app_store_url'                  => '#',
			'play_store_image'               => '',
			'play_store_url'                 => '#',

			// Listings Settings
			'listing_detail_sidebar'         => 1,
			'banner_search'                  => 0,
			'banner_search_type'             => 0,
			'banner_search_location'         => 1,
			'banner_search_radius'           => 0,
			'banner_search_category'         => 1,
			'banner_search_keyword'          => 1,
			'listing_search_style'           => 'standard',
			'listing_archive_title'          => 0,
			'listing_related'                => 1,

			// Blog Layout
			'blog_layout'                    => 'right-sidebar',
			'blog_sidebar'                   => 'sidebar',
			'blog_top_bar'                   => 'default',
			'blog_header_style'              => 'default',
			'blog_menu_alignment'            => 'default',
			'blog_header_width'              => 'default',
			'blog_tr_header'                 => 'default',
			'blog_breadcrumb'                => 'default',
			'blog_banner_search'             => 'default',
			'blog_padding_top'               => '',
			'blog_padding_bottom'            => '90px',
			'blog_footer_style'              => 'default',

			// Single Post Layout
			'single_post_layout'             => 'right-sidebar',
			'single_post_sidebar'            => 'sidebar',
			'single_post_top_bar'            => 'default',
			'single_post_header_style'       => 'default',
			'single_post_menu_alignment'     => 'default',
			'single_post_header_width'       => 'default',
			'single_post_tr_header'          => 'default',
			'single_post_breadcrumb'         => 'default',
			'single_post_banner_search'      => 'default',
			'single_post_padding_top'        => '',
			'single_post_padding_bottom'     => '',
			'single_post_footer_style'       => 'default',

			// Page Layout
			'page_layout'                    => 'full-width',
			'page_sidebar'                   => 'sidebar',
			'page_top_bar'                   => 'default',
			'page_header_style'              => 'default',
			'page_menu_alignment'            => 'default',
			'page_header_width'              => 'default',
			'page_tr_header'                 => 'default',
			'page_breadcrumb'                => 'default',
			'page_banner_search'             => 'default',
			'page_footer_style'              => 'default',
			'page_padding_top'               => '',
			'page_padding_bottom'            => '',

			// Error Layout
			'error_padding_top'              => '',
			'error_padding_bottom'           => '',
			'error_breadcrumb'               => 'default',
			'error_banner_search'            => 'default',
			'error_top_bar'                  => 'default',
			'error_header_style'             => 'default',
			'error_header_width'             => 'default',
			'error_menu_alignment'           => 'default',
			'error_tr_header'                => 'default',
			'error_footer_style'             => 'default',

			// Listing Archive Layout
			'listing_archive_layout'         => 'left-sidebar',
			'listing_archive_sidebar'        => 'rtcl-archive-sidebar',
			'listing_archive_breadcrumb'     => 'default',
			'listing_archive_banner_search'  => 'default',
			'listing_archive_top_bar'        => 'default',
			'listing_archive_header_style'   => 'default',
			'listing_archive_header_width'   => 'default',
			'listing_archive_menu_alignment' => 'default',
			'listing_archive_tr_header'      => 'default',
			'listing_archive_footer_style'   => 'default',
			'listing_archive_padding_top'    => '',
			'listing_archive_padding_bottom' => '',

			// Listing Single Layout
			'listing_single_header_style'    => 'default',
			'listing_single_header_width'    => 'default',
			'listing_single_menu_alignment'  => 'default',
			'listing_single_tr_header'       => 'default',
			'listing_single_breadcrumb'      => 'default',
			'listing_single_banner_search'   => 'default',
			'listing_single_top_bar'         => 'default',
			'listing_single_footer_style'    => 'default',
			'listing_single_padding_top'     => '',
			'listing_single_padding_bottom'  => '',

			// Color
			'primary_color'                  => '#f9423a',
			'lite_primary_color'             => '#feeceb',
			'secondary_color'                => '#ef1c13',
			'top_listing_bg'                 => '#dff0f3',

			// Contact Info
			'contact_address'                => '121 King St, Melbourne den 3000, Australia',
			'contact_phone'                  => '(+123) 596 000',
			'contact_email'                  => 'info@example.com',
			'facebook'                       => '#',
			'twitter'                        => '#',
			'instagram'                      => '#',
			'youtube'                        => '',
			'pinterest'                      => '',
			'linkedin'                       => '#',
			'skype'                          => '',

			// Body Typography
			'typo_body'                      => json_encode(
				[
					'font'          => 'Lato',
					'regularweight' => 'normal',
				]
			),
			'typo_body_size'                 => '16px',
			'typo_body_height'               => '24px',

			// Menu Typography
			'typo_menu'                      => json_encode(
				[
					'font'          => 'Nunito',
					'regularweight' => '700',
				]
			),
			'typo_menu_size'                 => '16px',
			'typo_menu_height'               => '24px',

			//Sub Menu Typography
			'typo_submenu_size'              => '16px',
			'typo_submenu_height'            => '24px',

			// Heading Typography
			'typo_heading'                   => json_encode(
				[
					'font'          => 'Nunito',
					'regularweight' => '700',
				]
			),
			'typo_h1'                        => json_encode(
				[
					'font'          => '',
					'regularweight' => '700',
				]
			),
			'typo_h1_size'                   => '36px',
			'typo_h1_height'                 => '1.5',

			'typo_h2'        => json_encode(
				[
					'font'          => '',
					'regularweight' => '700',

				]
			),
			'typo_h2_size'   => '30px',
			'typo_h2_height' => '1.5',

			'typo_h3'        => json_encode(
				[
					'font'          => '',
					'regularweight' => '700',

				]
			),
			'typo_h3_size'   => '24px',
			'typo_h3_height' => '1.5',

			'typo_h4'        => json_encode(
				[
					'font'          => '',
					'regularweight' => '700',

				]
			),
			'typo_h4_size'   => '20px',
			'typo_h4_height' => '30px',

			'typo_h5'        => json_encode(
				[
					'font'          => '',
					'regularweight' => '700',

				]
			),
			'typo_h5_size'   => '18px',
			'typo_h5_height' => '28px',

			'typo_h6'        => json_encode(
				[
					'font'          => '',
					'regularweight' => '700',

				]
			),
			'typo_h6_size'   => '16px',
			'typo_h6_height' => '26px',

		];

		return apply_filters( 'rttheme_customizer_defaults', $customizer_defaults );
	}
}