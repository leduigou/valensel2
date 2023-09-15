<?php

use RadiusTheme\ClassifiedLite\Helper;
use RadiusTheme\ClassifiedLite\Options;

$custom_logo_id    = get_theme_mod( 'custom_logo' );
$default_logo_name = Options::$has_tr_header ? "logo-white.png" : "logo.png";
$default_logo      = $custom_logo_id ? wp_get_attachment_image_src( $custom_logo_id, 'full' ) : [
	Helper::get_img( $default_logo_name ),
	196,
	41
];
$main_logo         = ( isset( Options::$options['logo'] ) && 0 != Options::$options['logo'] ) ? wp_get_attachment_image_src( Options::$options['logo'], 'full' ) : $default_logo;
$light_logo        = ( isset( Options::$options['logo_light'] ) && 0 != Options::$options['logo_light'] ) ? wp_get_attachment_image_src( Options::$options['logo_light'], 'full' )
	: $default_logo;

if ( ( isset( Options::$options['logo'] ) && 0 != Options::$options['logo'] ) && ! ( isset( Options::$options['logo_light'] ) && 0 != Options::$options['logo_light'] ) ) {
	$light_logo = $main_logo;
}

if ( ! ( isset( Options::$options['logo'] ) && 0 != Options::$options['logo'] ) && ( isset( Options::$options['logo_light'] ) && 0 != Options::$options['logo_light'] ) ) {
	$main_logo = $light_logo;
}

if ( Options::$has_tr_header ) {
	$logo = $light_logo;
} else {
	$logo = $main_logo;
}
?>
<div class="site-branding">
	<?php if ( ! empty( $logo ) ): ?>
        <a class="site-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
            <img src="<?php echo esc_url( $logo[0] ); ?>"
                 width="<?php echo esc_attr( $logo[1] ); ?>"
                 height="<?php echo esc_attr( $logo[2] ); ?>"
                 alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"
            >
        </a>
	<?php else: ?>
        <h1 class="site-title">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php esc_attr_e( 'Home', 'cl-classified' ); ?>"
               rel="home">
				<?php echo esc_html( get_bloginfo( 'name' ) ); ?>
            </a>
        </h1>
	<?php endif; ?>
</div>