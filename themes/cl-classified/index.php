<?php
/**
 * @author  RadiusTheme
 * @since   1.0.0
 * @version 1.0.0
 */

use RadiusTheme\ClassifiedLite\Helper;
use RadiusTheme\ClassifiedLite\Options;

get_header();

$is_blog_style_2 = ( is_home() || is_archive() ) && Options::$options['blog_style'] == 'style2';
$grid_style      = $is_blog_style_2 ? 'style2' : 'style1';
?>
    <main id="primary" class="site-main content-area <?php echo esc_attr( $grid_style ); ?>">
        <div class="container">
            <div class="row">
				<?php
				if ( Options::$layout == 'left-sidebar' ) {
					get_sidebar();
				}
				?>
                <div class="<?php Helper::the_layout_class(); ?>">
                    <div class="main-content">
						<?php if ( have_posts() ): ?>
							<?php
							if ( $is_blog_style_2 ) {
								?>
                                <div class="row">
									<?php
									while ( have_posts() ) : the_post();
										get_template_part( 'template-parts/content-alt' );
									endwhile;
									?>
                                </div>
								<?php
							} else {
								while ( have_posts() ): the_post();
									get_template_part( 'template-parts/content' );
								endwhile;
							}
							?>
						<?php else: ?>
							<?php get_template_part( 'template-parts/content', 'none' ); ?>
						<?php endif; ?>
                    </div>
					<?php get_template_part( 'template-parts/pagination' ); ?>
                </div>
				<?php
				if ( Options::$layout == 'right-sidebar' ) {
					get_sidebar();
				}
				?>
            </div>
        </div>
    </main>

<?php get_footer(); ?>