<?php

namespace EditLinksACFRelationshipField;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Plugin
 *
 * @since 1.0.0
 * @package EditLinksACFRelationshipField
 */
class Plugin {

	public $version = '1.0.0';

	public $edit_link_class = 'edit-link-acf-relationship-field';

	public function __construct() {
		add_action( 'init', [ $this, 'init' ] );
	}

	public function init() {

		// Only support ACF version 5+.
		if ( ! function_exists( 'acf_get_setting' ) ) {
			return;
		}

		add_filter( 'acf/fields/relationship/result', [ $this, 'add_edit_link' ], 10, 3 );
		add_filter( 'acf/input/admin_head', [ $this, 'output_css' ], 10, 3 );
		add_filter( 'acf/input/admin_head', [ $this, 'output_js' ], 10, 3 );
	}

	public function add_edit_link( $title, $post, $field ) {
		if ( ! current_user_can( 'edit_post', $post->ID ) ) {
			return $title;
		}

		$edit_url = get_edit_post_link( $post );

		if ( empty( $edit_url ) ) {
			return $title;
		}

		$title .= sprintf(
			' (<a class="%s" href="%s" target="_blank">%s</a>)',
			esc_attr( $this->edit_link_class ),
			esc_url( $edit_url ),
			esc_html__( 'Edit' )
		);

		return $title;
	}

	public function output_css() {
		?>
		<style type="text/css">
			.acf-field-relationship .<?php echo esc_html( $this->edit_link_class ); ?>,
			.acf-field.field_type-relationship .<?php echo esc_html( $this->edit_link_class ); ?> {
				-webkit-transition: none;
				transition: none;
			}

			.acf-field-relationship .acf-rel-item:not( .disabled ):hover .<?php echo esc_html( $this->edit_link_class ); ?>,
			.acf-field.field_type-relationship .acf-relationship-item:not( .disabled ):hover .<?php echo esc_html( $this->edit_link_class ); ?> {
				color: #fff;
			}
		</style>
		<?php
	}

	public function output_js() {
		?>
		<script type="text/javascript">
			( function( $ ) {
				if ( 'function' !== typeof acf.add_action ) {
					return;
				}

				var callback = function( element ) {
					element.on( 'click touchend', '.<?php echo esc_html( $this->edit_link_class ); ?>', function( e ) {
						e.stopPropagation();
					});
				};

				acf.add_action( 'ready', callback );
				acf.add_action( 'append', callback );

			} )( jQuery );
		</script>
		<?php
	}
}
