<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RadiusTheme\CL_Classified_Core;

use \FW_Ext_Backups_Demo;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Demo_Importer {

	public function __construct() {
		add_filter( 'plugin_action_links_rt-demo-importer/rt-demo-importer.php', [
			$this,
			'add_action_links'
		] ); // Link from plugins page
		add_filter( 'rt_demo_installer_warning', [ $this, 'data_loss_warning' ] );
		add_filter( 'fw:ext:backups-demo:demos', [ $this, 'demo_config' ] );
		add_action( 'fw:ext:backups:tasks:success:id:demo-content-install', [ $this, 'after_demo_install' ] );
	}

	public function add_action_links( $links ) {
		$mylinks = [
			'<a href="' . esc_url( admin_url( 'tools.php?page=fw-backups-demo-content' ) ) . '">' . __( 'Install Demo Contents', 'cl-classified-core' ) . '</a>',
		];

		return array_merge( $links, $mylinks );
	}

	public function data_loss_warning( $links ) {
		$html = '<div style="margin-top:20px;color:#f00;font-size:20px;line-height:1.3;font-weight:600;margin-bottom:40px;border-color: #f00;border-style: dashed;border-width: 1px 0;padding:10px 0;">';
		$html .= __( 'Warning: All your old data will be lost if you install One Click demo data from here, so it is suitable only for a new website.', 'cl-classified-core' );
		$html .= '</div>';

		return $html;
	}

	public function demo_config( $demos ) {
		$demos_array = [
			'demo1' => [
				'title'        => __( 'Home', 'cl-classified-core' ),
				'screenshot'   => plugins_url( 'screenshots/screenshot1.png', dirname( __FILE__ ) ),
				'preview_link' => 'https://www.radiustheme.net/publicdemo/cl-classified/',
			]
		];

		$download_url = 'http://radiustheme.net/publicdemo/demo-content/cl-classified/';

		foreach ( $demos_array as $id => $data ) {
			$demo = new FW_Ext_Backups_Demo( $id, 'piecemeal', [
				'url'     => $download_url,
				'file_id' => $id,
			] );
			$demo->set_title( $data['title'] );
			$demo->set_screenshot( $data['screenshot'] );
			$demo->set_preview_link( $data['preview_link'] );

			$demos[ $demo->get_id() ] = $demo;

			unset( $demo );
		}

		return $demos;
	}

	public function after_demo_install( $collection ) {
		// Update front page id
		$demos = [
			'demo1' => 2399
		];

		$data = $collection->to_array();

		foreach ( $data['tasks'] as $task ) {
			if ( $task['id'] == 'demo:demo-download' ) {
				$demo_id = $task['args']['demo_id'];
				$page_id = $demos[ $demo_id ];
				update_option( 'page_on_front', $page_id );
				flush_rewrite_rules();
				break;
			}
		}

		// Update post author id
		global $wpdb;
		$id    = get_current_user_id();
		$query = "UPDATE $wpdb->posts SET post_author = $id";
		$wpdb->query( $query );
	}
}

new Demo_Importer;