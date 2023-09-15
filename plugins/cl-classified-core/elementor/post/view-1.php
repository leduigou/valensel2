<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RadiusTheme\CL_Classified_Core;

use \WP_Query;

$thumb_size = 'rdtheme-size2';

$args = [
	'posts_per_page'      => 3,
	'ignore_sticky_posts' => true,
	'cat'                 => (int) $data['cat'],
	'orderby'             => $data['orderby'],
];

switch ( $data['orderby'] ) {
	case 'title':
	case 'menu_order':
		$args['order'] = 'ASC';
		break;
}

$query = new WP_Query( $args );
?>
<div class="rt-el-post">
	<?php if ( $query->have_posts() ) : ?>
        <div class="row">
			<?php while ( $query->have_posts() ) : $query->the_post(); ?>
                <div class="col-md-4 col-12">
                    <div class="rtin-each">
						<?php if ( has_post_thumbnail() ): ?>
                            <div class="post-thumbnail">
                                <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( $thumb_size ); ?></a>
                            </div>
						<?php endif; ?>

                        <div class="rtin-content-area">
                            <ul class="post-meta">
                                <li class="date"><?php the_time( get_option( 'date_format' ) ); ?></li>
								<?php if ( $data['author'] ): ?>
                                    <li class="author"><?php esc_html_e( 'by ', 'cl-classified0core' ); ?><?php the_author_posts_link(); ?></li>
								<?php endif; ?>
                            </ul>
                            <h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        </div>

                    </div>
                </div>
			<?php endwhile; ?>
        </div>

	<?php endif; ?>
	<?php wp_reset_postdata(); ?>
</div>