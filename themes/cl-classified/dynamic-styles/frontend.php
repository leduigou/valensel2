<?php
/**
 * @author  RadiusTheme
 * @since   1.0.0
 * @version 1.0.0
 */

use RadiusTheme\ClassifiedLite\Helper;
use RadiusTheme\ClassifiedLite\Options;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

Helper::requires( 'common.php', 'dynamic-styles' );

$header_transparent_color = Options::$options['header_transparent_color'];
$logo_max_width           = Options::$options['logo_width'];

$primary_color   = Helper::get_primary_color();
$lite_primary    = Helper::get_lite_primary_color();
$secondary_color = Helper::get_secondary_color();
$top_bg          = Helper::get_top_bg_color();

$primary_rgb   = Helper::hex2rgb( $primary_color );
$secondary_rgb = Helper::hex2rgb( $secondary_color );
?>
<?php
/*-------------------------------------
#. Defaults
---------------------------------------*/
?>
:root {
--rtcl-primary-color: <?php echo esc_html( $primary_color ? $primary_color : '#f9423a' ); ?>;
--rtcl-secondary-color: <?php echo esc_html( $secondary_color ? $secondary_color : '#ef1c13' ); ?>;
--rtcl-top-bg-color: <?php echo esc_html( $top_bg ? $top_bg : '#dff0f3' ); ?>;
--rtcl-link-hover-color: <?php echo esc_html( $secondary_color ? $secondary_color : '#ef1c13' ); ?>;
--rtcl-lite-primary-color: <?php echo esc_html( $lite_primary ? $lite_primary : '#feeceb' ); ?>;
}
<?php
/*-------------------------------------
#. Header
---------------------------------------*/
?>
.trheader .main-header {
background-color: <?php echo esc_html( $header_transparent_color ); ?>;
}
.main-header .site-branding {
max-width: <?php echo esc_html( $logo_max_width ); ?>;
}
