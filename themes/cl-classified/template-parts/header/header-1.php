<?php
/**
 * @author  RadiusTheme
 * @since   1.0.0
 * @version 1.0.0
 */

use RadiusTheme\ClassifiedLite\Options;

$header_container = 'container';
if ( 'fullwidth' == Options::$header_width ) {
	$header_container = 'container-fluid';
}
?>
<div class="main-header">
    <div class="<?php echo esc_attr( $header_container ); ?>">
	    <?php get_template_part( 'template-parts/header/part-1' ); ?>
    </div>
</div>