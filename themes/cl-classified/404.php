<?php
/**
 * @author  RadiusTheme
 * @since   1.0.0
 * @version 1.0.0
 */

use RadiusTheme\ClassifiedLite\Helper;
use RadiusTheme\ClassifiedLite\Options;

$callback404 = [ Helper::get_img( '404.png' ), 866, 529 ];
$options404  = Options::$options['error_bodybanner'] ? wp_get_attachment_image_src( Options::$options['error_bodybanner'], 'full' ) : null;

$rdtheme_error_img = ! empty( $options404 ) ? $options404 : $callback404;
?>
<?php get_header(); ?>
    <div id="primary" class="content-area">
        <div class="container">
            <div class="error-page">
                <img src="<?php echo esc_url( $rdtheme_error_img[0] ); ?>"
                     width="<?php echo esc_attr( $rdtheme_error_img[1] ); ?>"
                     height="<?php echo esc_attr( $rdtheme_error_img[2] ); ?>"
                     alt="<?php esc_attr_e( '404', 'cl-classified' ); ?>"
                     data-position="50"
                     class="follow-with-mouse image-404">
                <h2><?php echo esc_html( Options::$options['error_text'] ); ?></h2>
                <p class="error-subtitle"><?php echo esc_html( Options::$options['error_subtitle'] ); ?></p>
                <a class="error-btn"
                   href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo esc_html( Options::$options['error_buttontext'] ); ?></a>
            </div>
        </div>
    </div>
<?php get_footer(); ?>