<?php

namespace Rtcl\Controllers\Blocks;

use Rtcl\Helpers\Functions;
use Rtcl\Helpers\Pagination;
use Rtcl\Models\Listing;
use Rtcl\Resources\Options;
use RtclPro\Helpers\Fns;
use RtclPro\Controllers\Hooks\TemplateHooks;

class ListingsAjaxController
{
	protected $settings = [];

	public function __construct()
	{
		add_action('wp_ajax_rtcl_gb_listings_ajax', [$this, 'rtcl_gb_listings_ajax']);
		//add_filter( 'excerpt_length', array( $this, 'excerpt_limit' ) );
		add_filter('excerpt_more', '__return_empty_string');
	}

	public static function rtcl_gb_listing_args($settings)
	{
		$meta_queries = [];
		$settings['cats']             = !empty($settings['cats']) ? wp_list_pluck($settings['cats'], 'value') : [];
		$settings['locations']        = !empty($settings['locations']) ? wp_list_pluck($settings['locations'], 'value') : [];
		$settings['promotion_in']     = !empty($settings['promotion_in']) ? wp_list_pluck($settings['promotion_in'], 'value') : [];
		$settings['promotion_not_in'] = !empty($settings['promotion_not_in']) ? wp_list_pluck($settings['promotion_not_in'], 'value') : [];
		$listing_type             = !empty($settings['listing_type']) ? sanitize_text_field($settings['listing_type']) : 'all';
		$orderby                  = !empty($settings['orderby']) ? sanitize_text_field($settings['orderby']) : 'date';
		$order                    = !empty($settings['sortby']) ? sanitize_text_field($settings['sortby']) : 'desc';
		$settings['perPage']          = isset($settings['perPage']) ? intval($settings['perPage']) : 8;

		$args = [
			'post_type'      => 'rtcl_listing',
			'post_status'    => 'publish',
			'posts_per_page' => intval($settings['perPage']),
			//'offset' => $offset,
			'tax_query'      => [
				'relation' => 'AND',
			],
		];

		$args['paged'] = Pagination::get_page_number();

		if (!empty($order) && !empty($orderby)) {
			switch ($orderby) {
				case 'price':
					$args['meta_key'] = $orderby;
					$args['orderby']  = 'meta_value_num';
					$args['order']    = $order;
					break;
				case 'views':
					$args['meta_key'] = '_views';
					$args['orderby']  = 'meta_value_num';
					$args['order']    = $order;
					break;
				case 'rand':
					$args['orderby'] = $orderby;
					break;
				default:
					$args['orderby'] = $orderby;
					$args['order']   = $order;
			}
		}

		// Taxonomy
		if (!empty($settings['cats'])) {
			$args['tax_query'][] = [
				'taxonomy' => 'rtcl_category',
				'field'    => 'term_id',
				'terms'    => $settings['cats'],
			];
		}
		if (!empty($settings['locations'])) {
			$args['tax_query'][] = [
				'taxonomy' => 'rtcl_location',
				'field'    => 'term_id',
				'terms'    => $settings['locations'],
			];
		}

		$promotion_common = array_intersect($settings['promotion_in'], $settings['promotion_not_in']);
		$promotion_in     = array_diff($settings['promotion_in'], $promotion_common);
		$promotion_not_in = array_merge($promotion_common, array_diff($settings['promotion_not_in'], $promotion_common));

		if (!empty($promotion_in) && is_array($promotion_in)) {
			$promotions = array_keys(Options::get_listing_promotions());
			foreach ($promotion_in as $promotion) {
				if (is_string($promotion) && in_array($promotion, $promotions)) {
					$meta_queries[] = [
						'key'     => $promotion,
						'compare' => '=',
						'value'   => 1,
					];
				}
			}
		}

		if (!empty($promotion_not_in) && is_array($promotion_not_in)) {
			$promotions = array_keys(Options::get_listing_promotions());
			foreach ($promotion_not_in as $promotion) {
				if (is_string($promotion) && in_array($promotion, $promotions)) {
					$meta_queries[] = [
						'relation' => 'OR',
						[
							'key'     => $promotion,
							'compare' => '!=',
							'value'   => 1,
						],
						[
							'key'     => $promotion,
							'compare' => 'NOT EXISTS',
						],
					];
				}
			}
		}

		if ($listing_type && in_array($listing_type, array_keys(Functions::get_listing_types())) && !Functions::is_ad_type_disabled()) {
			$meta_queries[] = [
				'key'     => 'ad_type',
				'value'   => $listing_type,
				'compare' => '=',
			];
		}

		$count_meta_queries = count($meta_queries);
		if ($count_meta_queries) {
			$args['meta_query'] = ($count_meta_queries > 1) ? array_merge(['relation' => 'AND'], $meta_queries) : $meta_queries;
		}
		return apply_filters('rtcl_listing_ads_args', $args);
	}

	public static function rtcl_gb_listings_query($settings)
	{
		$results      = [];
		$args = self::rtcl_gb_listing_args($settings);
		$loop_obj = new \WP_Query($args);

		while ($loop_obj->have_posts()) :
			$loop_obj->the_post();
			$_id          = get_the_ID();
			$listing      = new Listing($_id);
			$liting_class = Functions::get_listing_class(['rtcl-widget-listing-item', 'listing-item'], $_id);
			$phone        = get_post_meta($_id, 'phone', true);
			$compare      = $quick_view = $sold_item = $custom_fields = '';

			if (rtcl()->has_pro()) {
				ob_start();
				TemplateHooks::loop_item_listable_fields();
				$custom_fields = ob_get_clean();
			}

			ob_start();
			do_action('rtcl_listing_badges', $listing);
			$badge = ob_get_contents();
			ob_end_clean();

			if (rtcl()->has_pro()) {
				if ($listing && Fns::is_enable_mark_as_sold() && Fns::is_mark_as_sold($listing->get_id())) {
					$sold_item = '<span class="rtcl-sold-out">' . apply_filters('rtcl_sold_out_banner_text', esc_html__("Sold Out", 'classified-listing')) . '</span>';
				}
			}

			if (rtcl()->has_pro()) {
				if (Fns::is_enable_compare()) {
					$compare_ids    = !empty($_SESSION['rtcl_compare_ids']) ? $_SESSION['rtcl_compare_ids'] : [];
					$selected_class = '';
					if (is_array($compare_ids) && in_array($_id, $compare_ids)) {
						$selected_class = ' selected';
					}
					$compare = sprintf(
						'<a class="rtcl-compare %s" href="#" data-listing_id="%s"><i class="rtcl-icon rtcl-icon-retweet"></i><span class="compare-label">%s</span></a>',
						$selected_class,
						absint($_id),
						esc_html__("Compare", "classified-listing")
					);
				}
			}

			if (rtcl()->has_pro()) {
				if (Fns::is_enable_quick_view()) {
					$quick_view = sprintf(
						'<a class="rtcl-quick-view" href="#" data-listing_id="%s"><i class="rtcl-icon rtcl-icon-zoom-in"></i><span class="quick-label">%s</span></a>',
						absint($_id),
						esc_html__("Quick View", "classified-listing")
					);
				}
			}

			$pp_id        = absint(get_user_meta($listing->get_owner_id(), '_rtcl_pp_id', true));
			$author_image = $pp_id ? wp_get_attachment_image($pp_id, [40, 40]) : get_avatar($_id, 40);

			//image size
			$image_size = isset($settings['image_size']) ? $settings['image_size'] : 'rtcl-thumbnail';
			if ('custom' == $image_size) {
				if (isset($settings['custom_image_width']) && isset($settings['custom_image_height'])) {
					$image_size = [
						$settings['custom_image_width'],
						$settings['custom_image_height'],
					];
				}
			}

			$results[] = [
				"ID"             => $_id,
				"title"          => get_the_title(),
				"thumbnail"      => $listing->get_the_thumbnail($image_size),
				"locations"      => $listing->the_locations(false),
				"categories"     => $listing->the_categories(false, true),
				"price"          => $listing->get_price_html(),
				"excerpt"        => get_the_excerpt($_id),
				"time"           => $listing->get_the_time(),
				"badges"         => $badge,
				"views"          => absint(get_post_meta(get_the_ID(), '_views', true)),
				"author"         => get_the_author(),
				"classes"        => $liting_class,
				"post_link"      => get_post_permalink(),
				"listing_type"   => $listing->get_ad_type(),
				"favourite_link" => Functions::get_favourites_link($_id),
				"compare"        => $compare,
				"quick_view"     => $quick_view,
				"phone"          => $phone,
				"author_image"   => $author_image,
				"sold"           => $sold_item,
				"custom_field"   => $custom_fields
			];

		endwhile; ?>
		<?php wp_reset_postdata(); ?>

		<?php return [
			"total_post" => $loop_obj->found_posts,
			"total_page" => $loop_obj->max_num_pages,
			"posts"      => $results,
			"query_obj"  => $loop_obj
		];
	}

	public function rtcl_gb_listings_ajax()
	{
		if (!wp_verify_nonce($_POST['rtcl_nonce'], 'rtcl-nonce')) {
			wp_send_json_error(esc_html__('Session Expired!!', 'classified-listing'));
		}

		$settings =  isset($_POST['attributes']) ? map_deep(wp_unslash($_POST['attributes']), 'sanitize_text_field') : [];
		$this->settings = $settings;
		//$offset = $_POST['offset'];

		$listings = self::rtcl_gb_listings_query($settings);

		if (!empty($listings["posts"])) {
			wp_send_json_success($listings);
		} else {
			wp_send_json_error("no post found");
		}
	}
}
