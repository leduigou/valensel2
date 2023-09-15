<?php
$post_id             = get_the_id();
$current_post        = [ $post_id ];
$related_post_number = apply_filters( 'cl_classified_related_post_number', 2 );

$args = [
	'post__not_in'        => $current_post,
	'posts_per_page'      => $related_post_number,
	'no_found_rows'       => true,
	'post_status'         => 'publish',
	'ignore_sticky_posts' => true,
];

$category_ids = [];
$categories   = get_the_category( $post_id );

foreach ( $categories as $category ) {
	$category_ids[] = $category->term_id;
}

$args['category__in'] = $category_ids;

# Get the posts ----------
$related_query = new \WP_Query( $args );

$count_post = $related_query->post_count;

if ( ! $count_post ) {
	return;
}

?>
<div class="content-block-gap"></div>
<div class="site-content-block">
    <div class="main-title-block">
        <h3 class="main-title">
			<?php esc_html_e( 'Related Post', 'cl-classified' ); ?>
        </h3>
    </div>
    <div class="related-content row">
		<?php
		while ( $related_query->have_posts() ) {
			$related_query->the_post();
			get_template_part( 'template-parts/content', 'alt' );
		}
		wp_reset_postdata();
		?>
    </div>
</div>