<?php
/**
 * @author  RadiusTheme
 * @since   1.0.0
 * @version 1.0.0
 */

use RadiusTheme\ClassifiedLite\Helper;
use RadiusTheme\ClassifiedLite\Options;

$has_top_info = Options::$options['contact_address'] || Options::$options['contact_phone'] || Options::$options['contact_email'];
$socials      = Helper::socials();

if ( ! $has_top_info || ! $socials ) {
	return;
}
$header_container = 'container';
if ( 'fullwidth' == Options::$header_width ) {
	$header_container = 'container-fluid';
}
?>

<div id="top-header" class="top-header">
    <div class="<?php echo esc_attr( $header_container ); ?>">
        <div class="top-header-inner">
			<?php if ( $has_top_info ): ?>
                <div class="tophead-left">
                    <ul class="tophead-info">
						<?php if ( Options::$options['contact_address'] ): ?>
                            <li>
                                <i class="fas fa-map-marker-alt"></i>
                                <span><?php echo esc_html( Options::$options['contact_address'] ); ?></span>
                            </li>
						<?php endif; ?>
						<?php if ( Options::$options['contact_phone'] ): ?>
                            <li>
                                <i class="fas fa-phone"></i>
                                <span><?php echo esc_html( Options::$options['contact_phone'] ); ?></span>
                            </li>
						<?php endif; ?>
						<?php if ( Options::$options['contact_email'] ): ?>
                            <li>
                                <i class="fas fa-envelope"></i>
                                <span><?php echo esc_html( Options::$options['contact_email'] ); ?></span>
                            </li>
						<?php endif; ?>
                    </ul>
                </div>
			<?php endif; ?>
			<?php if ( $socials ): ?>
                <div class="tophead-right">
                    <ul class="tophead-social">
						<?php if ( $socials ): ?>
							<?php foreach ( $socials as $social ): ?>
                                <li>
                                    <a target="_blank" href="<?php echo esc_url( $social['url'] ); ?>">
                                        <i class="<?php echo esc_attr( $social['icon'] ); ?>"></i>
                                    </a>
                                </li>
							<?php endforeach; ?>
						<?php endif; ?>
                    </ul>
                </div>
			<?php endif; ?>
        </div>
    </div>
</div>