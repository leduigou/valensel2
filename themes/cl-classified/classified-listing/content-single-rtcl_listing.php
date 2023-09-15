<?php
/**
 * The template for displaying product content in the single-rtcl_listing.php template
 *
 * This template can be overridden by copying it to yourtheme/classified-listing/content-single-rtcl_listing.php.
 *
 * @package ClassifiedListing/Templates
 * @version 2.2.25
 */

use Rtcl\Controllers\BusinessHoursController;
use Rtcl\Helpers\Functions;

defined( 'ABSPATH' ) || exit;

global $listing;

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.

	return;
}
$sidebar_position = Functions::get_option_item( 'rtcl_moderation_settings', 'detail_page_sidebar_position', 'right' );
$sidebar_class    = [
	'col-md-3',
	'order-2'
];
$content_class    = [
	'col-md-9',
	'order-1',
	'listing-content'
];
if ( $sidebar_position == "left" ) {
	$sidebar_class   = array_diff( $sidebar_class, [ 'order-2' ] );
	$sidebar_class[] = 'order-1';
	$content_class   = array_diff( $content_class, [ 'order-1' ] );
	$content_class[] = 'order-2';
} else if ( $sidebar_position == "bottom" ) {
	$content_class   = array_diff( $content_class, [ 'col-md-9' ] );
	$sidebar_class   = array_diff( $sidebar_class, [ 'col-md-3' ] );
	$content_class[] = 'col-sm-12';
	$sidebar_class[] = 'rtcl-listing-bottom-sidebar';
}
/**
 * Hook: rtcl_before_single_product.
 *
 * @hooked rtcl_print_notices - 10
 */
do_action( 'rtcl_before_single_listing' );

?>
    <div id="rtcl-listing-<?php the_ID(); ?>" <?php Functions::listing_class( '', $listing ); ?>>

        <div class="row">
            <!-- Main content -->
            <div class="<?php echo esc_attr( implode( ' ', $content_class ) ); ?>">
                <!-- Gallery/Image -->
				<?php $listing->the_gallery(); ?>

                <div class="rtcl-single-listing-details">
					<?php do_action( 'rtcl_single_listing_content' ); ?>
                    <div class="rtcl-main-content-wrapper">
                        <!-- Price -->
						<?php if ( $listing->can_show_price() ): ?>
                            <div class="rtcl-price-wrap price-in-mobile">
								<?php echo $listing->get_price_html(); ?>
                            </div>
						<?php endif; ?>

                        <!-- Description -->
                        <div class="rtcl-listing-description"><?php $listing->the_content(); ?></div>

						<?php if ( $sidebar_position === "bottom" ) : ?>
                            <!-- Sidebar -->
							<?php do_action( 'rtcl_single_listing_sidebar' ); ?>
						<?php endif; ?>
                        <!--  Inner Sidebar -->
						<?php do_action( 'rtcl_single_listing_inner_sidebar', $listing ); ?>
						<?php $listing->the_custom_fields(); ?>
                        <div class="rtcl-single-actions">
							<?php $listing->the_actions(); ?>
                        </div>
                    </div>
                </div>

                <!-- MAP  -->
				<?php do_action( 'rtcl_single_listing_content_end', $listing ); ?>

                <!-- Business Hours  -->
				<?php if ( Functions::is_enable_business_hours() && ! empty( BusinessHoursController::get_business_hours( $listing->get_id() ) ) ): ?>
                    <div class="content-block-gap"></div>
                    <div class="site-content-block classified-single-business-hour">
                        <div class="main-content">
                            <h3 class="main-title"><?php esc_html_e( 'Business Hours', 'cl-classified' ); ?></h3>
							<?php do_action( 'rtcl_single_listing_business_hours' ); ?>
                        </div>
                    </div>
				<?php endif; ?>

                <!-- Social Profile  -->
				<?php do_action( 'rtcl_single_listing_social_profiles' ) ?>

                <!-- Related Listing -->
				<?php $listing->the_related_listings(); ?>

                <!-- Review  -->
				<?php do_action( 'rtcl_single_listing_review' ) ?>
            </div>

			<?php if ( in_array( $sidebar_position, [ 'left', 'right' ] ) ) : ?>
                <!-- Sidebar -->
				<?php do_action( 'rtcl_single_listing_sidebar' ); ?>
			<?php endif; ?>
        </div>
    </div>

<?php do_action( 'rtcl_after_single_listing' ); ?>