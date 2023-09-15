<?php
/**
 * @author  RadiusTheme
 * @since   1.0.0
 * @version 1.1.0
 */

if ( ! isset( $content_width ) ) {
	$content_width = 1240;
}

add_action( 'after_setup_theme', 'cl_classified_load_textdomain' );
function cl_classified_load_textdomain() {
	load_theme_textdomain( 'cl-classified', get_template_directory() . '/languages' );
}

define( 'CL_CLASSIFIED_VERSION', '1.1.1' );

require_once 'lib/updater/theme-updater.php';
require_once 'lib/class-tgm-plugin-activation.php';
require_once 'inc/init.php';
require_once 'inc/Customizer/sanitization.php';

do_action( 'cl_classified_theme_init' );