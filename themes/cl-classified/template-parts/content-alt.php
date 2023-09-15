<?php
/**
 * @author  RadiusTheme
 * @since   1.0.0
 * @version 1.0.0
 */

use RadiusTheme\ClassifiedLite\Helper;
use RadiusTheme\ClassifiedLite\Options;

$grid_class      = Helper::has_sidebar() ? 'col-lg-6 col-md-4 col-sm-2 col-12' : 'col-lg-4 col-md-6 col-sm-6 col-12';
$comments_number = get_comments_number();
$has_thumbnail   = has_post_thumbnail() ? 'has-thumbnail' : 'has-no-thumbnail';
$has_entry_meta  = ( Options::$options['blog_cat_visibility'] && has_category() ) || Options::$options['blog_author_name'] || Options::$options['blog_comment_num'] || Options::$options['blog_date'];
$comments_number = get_comments_number();
$comments_text   = sprintf( '(%s)', number_format_i18n( $comments_number ) );
$post_class      = $has_thumbnail . ' post-each post-each-alt';
$length          = Options::$options['excerpt_length'];
?>

<div class="<?php echo esc_attr( $grid_class ); ?>">
    <article id="post-<?php the_ID(); ?>" <?php post_class( $post_class ); ?>>

		<?php if ( has_post_thumbnail() ): ?>
            <div class="post-thumbnail">
                <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'rdtheme-size2' ); ?></a>
            </div>
		<?php endif; ?>

        <div class="post-content-area">

			<?php if ( $has_entry_meta ): ?>

                <ul class="post-meta">
	                <?php if ( Options::$options['blog_author_name'] ): ?>
                        <li><i class="fa fa-user" aria-hidden="true"></i><span class="vcard author"><a
                                        href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"
                                        class="fn"><?php the_author(); ?></a></span></li>
	                <?php endif; ?>

					<?php if ( Options::$options['blog_date'] ): ?>
                        <li><i class="fa fa-calendar" aria-hidden="true"></i><span
                                    class="updated published"><?php the_time( get_option( 'date_format' ) ); ?></span>
                        </li>
					<?php endif; ?>

					<?php if ( Options::$options['blog_comment_num'] ): ?>
                        <li><i class="fa fa-comments" aria-hidden="true"></i><?php echo esc_html( $comments_text ); ?>
                        </li>
					<?php endif; ?>

					<?php if ( Options::$options['blog_cat_visibility'] && has_category() ): ?>
                        <li><i class="fa fa-tags" aria-hidden="true"></i><?php the_category( ', ' ); ?></li>
					<?php endif; ?>
                </ul>

			<?php endif; ?>

            <h3 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>

            <p class="entry-summary"><?php echo wp_trim_words( get_the_excerpt(), $length ); ?></p>

			<?php if ( Options::$options['blog_button'] ): ?>
                <a class="rtin-button" href="<?php the_permalink(); ?>">
                    <?php esc_html_e( 'Read More', 'cl-classified' ); ?>
                    <i class="fa-solid fa-arrow-right rtin-button-icon"></i>
                </a>
			<?php endif; ?>

        </div>
    </article>
</div>