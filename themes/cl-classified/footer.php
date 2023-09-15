<?php
/**
 * @author  RadiusTheme
 * @since   1.0.0
 * @version 1.0.0
 */

use RadiusTheme\ClassifiedLite\Options;

?>
</div><!-- #content -->
<?php
$footer_style = Options::$footer_style ? Options::$footer_style : 1;
get_template_part( 'template-parts/footer/footer', $footer_style ); ?>
</div><!-- #page -->
<?php wp_footer(); ?>
</body>
</html>