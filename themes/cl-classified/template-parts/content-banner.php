<?php
/**
 * @author  RadiusTheme
 * @since   1.0.0
 * @version 1.0.0
 */

use RadiusTheme\ClassifiedLite\Helper;
use RadiusTheme\ClassifiedLite\Options;

?>
<?php if ( Options::$has_banner_search ): ?>
    <section class="banner-search">
        <div class="container">
            <div class="rtcl cl-classified-listing-search">
				<?php Helper::get_custom_listing_template( 'listing-search' ); ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php
if ( Options::$has_breadcrumb ):
	do_action( 'cl_classified_breadcrumb' );
endif;