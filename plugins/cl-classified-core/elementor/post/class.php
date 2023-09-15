<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RadiusTheme\CL_Classified_Core;

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Post extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = __( 'Post', 'cl-classified-core' );
		$this->rt_base = 'rt-post';
		parent::__construct( $data, $args );
	}

	public function rt_fields() {
		$categories        = get_categories();
		$category_dropdown = [ '0' => __( 'All Categories', 'cl-classified-core' ) ];

		foreach ( $categories as $category ) {
			$category_dropdown[ $category->term_id ] = $category->name;
		}

		$fields = [
			[
				'mode'  => 'section_start',
				'id'    => 'sec_general',
				'label' => __( 'General', 'cl-classified-core' ),
			],
			[
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'cat',
				'label'   => __( 'Categories', 'cl-classified-core' ),
				'options' => $category_dropdown,
				'default' => '0',
			],
			[
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'orderby',
				'label'   => __( 'Order By', 'cl-classified-core' ),
				'options' => [
					'date'  => __( 'Date (Recents comes first)', 'cl-classified-core' ),
					'title' => __( 'Title', 'cl-classified-core' ),
				],
				'default' => 'date',
			],
			[
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'author',
				'label'       => __( 'Author Display', 'cl-classified-core' ),
				'label_on'    => __( 'On', 'cl-classified-core' ),
				'label_off'   => __( 'Off', 'cl-classified-core' ),
				'default'     => 'yes',
				'description' => __( 'Show or hide author name', 'cl-classified-core' ),
			],
			[
				'mode' => 'section_end',
			],

			// Style Tab
			[
				'mode'  => 'section_start',
				'id'    => 'sec_style_color',
				'tab'   => Controls_Manager::TAB_STYLE,
				'label' => __( 'Color', 'cl-classified-core' ),
			],
			[
				'type'      => Controls_Manager::COLOR,
				'id'        => 'bgcolor',
				'label'     => __( 'Background', 'cl-classified-core' ),
				'selectors' => [ '{{WRAPPER}} .rtin-each' => 'background-color: {{VALUE}}' ],
			],
			[
				'type'      => Controls_Manager::COLOR,
				'id'        => 'title_color',
				'label'     => __( 'Title', 'cl-classified-core' ),
				'selectors' => [ '{{WRAPPER}} .post-title a' => 'color: {{VALUE}}' ],
			],
			[
				'type'      => Controls_Manager::COLOR,
				'id'        => 'meta_color',
				'label'     => __( 'Meta', 'cl-classified-core' ),
				'selectors' => [ '{{WRAPPER}} .post-meta li, {{WRAPPER}} .post-meta li a, {{WRAPPER}} .post-date' => 'color: {{VALUE}}' ],
			],
			[
				'type'      => Controls_Manager::COLOR,
				'id'        => 'author_color',
				'label'     => __( 'Author', 'cl-classified-core' ),
				'selectors' => [ '{{WRAPPER}} .post-meta .author-name a' => 'color: {{VALUE}}' ],
				'condition' => [ 'style' => [ '1' ] ],
			],
			[
				'mode' => 'section_end',
			],
			[
				'mode'  => 'section_start',
				'id'    => 'sec_style_type',
				'tab'   => Controls_Manager::TAB_STYLE,
				'label' => __( 'Typography', 'cl-classified-core' ),
			],
			[
				'mode'     => 'group',
				'type'     => \Elementor\Group_Control_Typography::get_type(),
				'id'       => 'title_typo',
				'label'    => __( 'Title', 'cl-classified-core' ),
				'selector' => '{{WRAPPER}} .post-title',
			],
			[
				'mode'     => 'group',
				'type'     => \Elementor\Group_Control_Typography::get_type(),
				'id'       => 'meta_typo',
				'label'    => __( 'Meta', 'cl-classified-core' ),
				'selector' => '{{WRAPPER}} .post-meta li, {{WRAPPER}} .post-meta li a, {{WRAPPER}} .post-date',
			],
			[
				'mode'      => 'group',
				'type'      => \Elementor\Group_Control_Typography::get_type(),
				'id'        => 'author_typo',
				'label'     => __( 'Author', 'cl-classified-core' ),
				'selector'  => '{{WRAPPER}} .post-meta .author-name a',
				'condition' => [ 'style' => [ '1' ] ],
			],
			[
				'mode' => 'section_end',
			],
		];

		return $fields;
	}

	protected function render() {
		$data = $this->get_settings();

		$template = 'view-1';

		return $this->rt_template( $template, $data );
	}
}