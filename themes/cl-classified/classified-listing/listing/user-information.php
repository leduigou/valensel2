<?php
/**
 * @author        RadiusTheme
 * @package       classified-listing/templates
 * @version       1.0.0
 *
 * @var Listing $listing
 */

use Rtcl\Models\Listing;

?>
<div class="rtcl-listing-user-info">
    <div class="rtcl-listing-side-title">
        <h3><?php esc_html_e("Information", 'cl-classified'); ?></h3>
    </div>
    <div class="list-group">
	    <?php if ( $listing->can_show_user() ): ?>
            <div class="list-group-item rtin-author d-flex align-items-center">
                <?php
                $pp_id = absint( get_user_meta( $listing->get_owner_id(), '_rtcl_pp_id', true ) );
                if ( $listing->can_add_user_link() ): ?>
                    <a href="<?php echo esc_url($listing->get_the_author_url()); ?>"><?php echo( $pp_id ? wp_get_attachment_image( $pp_id, [40, 40]) : get_avatar( $listing->get_author_id(), 40 ) ); ?></a>
                <?php else:
	                echo( $pp_id ? wp_get_attachment_image( $pp_id, [40, 40]) : get_avatar( $listing->get_author_id(), 40 ) );
                endif;
                ?>
                <h4 class="rtin-name"><?php $listing->the_author(); ?></h4>
			    <?php do_action('rtcl_after_author_meta', $listing->get_owner_id() ); ?>
            </div>
	    <?php endif; ?>
        <?php do_action('rtcl_listing_seller_information', $listing); ?>
    </div>
</div>