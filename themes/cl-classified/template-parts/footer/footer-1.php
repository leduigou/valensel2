<?php
/**
 * @author  RadiusTheme
 * @since   1.0.0
 * @version 1.0.0
 */

use RadiusTheme\ClassifiedLite\Options;

if ( function_exists( 'elementor_theme_do_location' ) && elementor_theme_do_location( 'footer' ) ) {
	return;
}

$footer_columns = 0;

foreach ( range( 1, 4 ) as $i ) {
	if ( is_active_sidebar( 'footer-' . $i ) ) {
		$footer_columns ++;
	}
}

switch ( $footer_columns ) {
	case '1':
		$footer_class = 'col-sm-12 col-12';
		break;
	case '2':
		$footer_class = 'col-sm-6 col-12';
		break;
	case '3':
		$footer_class = 'col-md-4 col-sm-12 col-12';
		break;
	default:
		$footer_class = 'col-lg-3 col-sm-6 col-12';
}
?>
<footer id="site-footer" class="site-footer footer-wrap footer-style-1">
	<?php if ( $footer_columns ): ?>
        <div class="main-footer">
            <div class="container">
                <div class="row">
					<?php
					foreach ( range( 1, 4 ) as $i ) {
						if ( ! is_active_sidebar( 'footer-' . $i ) ) {
							continue;
						}
						echo '<div class="' . esc_attr( $footer_class ) . '">';
						dynamic_sidebar( 'footer-' . $i );
						echo '</div>';
					}
					?>
                </div>
            </div>
        </div>
	<?php endif; ?>
	<?php if ( Options::$options['copyright_area'] ): ?>
        <div class="footer-bottom">
            <div class="container">
                <div class="row justify-content-between align-items-center">
                    <div class="col-auto footer-copyright-area">
                        <p class="footer-copyright">
							<?php
							echo wp_kses( Options::$options['copyright_text'], [
								'a'      => [
									'href'  => [],
									'title' => [],
								],
								'br'     => [],
								'em'     => [],
								'strong' => [],
							] );
							?>
                        </p>
                    </div>
					<?php
					$play_store = ( isset( Options::$options['play_store_image'] ) && 0 != Options::$options['play_store_image'] ) ? wp_get_attachment_image_src( Options::$options['play_store_image'], 'full' ) : '';
					$app_store  = ( isset( Options::$options['app_store_image'] ) && 0 != Options::$options['app_store_image'] ) ? wp_get_attachment_image_src( Options::$options['app_store_image'], 'full' ) : '';

					if ( ! empty( $play_store ) || ! empty( $app_store ) ): ?>
                        <div class="col-auto">
                            <div class="cl-app-wrap text-lg-end">
								<?php if ( ! empty( $play_store ) ): ?>
                                    <a class="cl-play-store-app"
                                       href="<?php echo esc_url( Options::$options['play_store_url'] ); ?>">
                                        <img src="<?php echo esc_url( $play_store[0] ); ?>"
                                             width="<?php echo esc_attr( $play_store[1] ); ?>"
                                             height="<?php echo esc_attr( $play_store[2] ); ?>"
                                             alt="<?php esc_attr_e( 'App Link', 'cl-classified' ); ?>"
                                        >
                                    </a>
								<?php endif; ?>
								<?php if ( ! empty( $app_store ) ): ?>
                                    <a class="cl-app-store-app"
                                       href="<?php echo esc_url( Options::$options['app_store_url'] ); ?>">
                                        <img src="<?php echo esc_url( $app_store[0] ); ?>"
                                             width="<?php echo esc_attr( $app_store[1] ); ?>"
                                             height="<?php echo esc_attr( $app_store[2] ); ?>"
                                             alt="<?php esc_attr_e( 'App Link', 'cl-classified' ); ?>"
                                        >
                                    </a>
								<?php endif; ?>
                            </div>
                        </div>
					<?php endif; ?>
                </div>
            </div>
        </div>
	<?php endif; ?>
</footer>