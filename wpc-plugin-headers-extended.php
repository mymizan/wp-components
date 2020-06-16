<?php
/**
 * Extends WordPress plugin header fields
 *
 * Extends WordPress plugin header fields to add new features.
 *
 * @class       WPC_Headers_Extended
 * @version     1.0.0
 * @package     WPC/WPC_Headers_Extended
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * WPC_Headers_Extended
 */
class WPC_Headers_Extended {

	private $extra_headers = array(
		'Co-Author'     => 'Co-Author',
		'Co-Author URL' => 'Co-Author URL',
	);

	/**
	 * __construct
	 *
	 * @return void
	 */
	public function __construct() {
		add_filter( 'extra_plugin_headers', array( $this, 'add_extra_headers' ), 10, 1 );
		add_filter( 'plugin_row_meta', array( $this, 'show_extra_headers_in_plugin_row' ), 10, 2 );
	}

	public function add_extra_headers() {
		return $this->extra_headers;
	}

	public function show_extra_headers_in_plugin_row( $links, $file ) {
		$headers = $this->get_plugin_data();

		foreach ( $headers as $key => $value ) {
			if ( array_key_exists( $key, $this->extra_headers ) ) {
				$links[] = $headers[ $key ];
			}
		}

		return $links;
	}

	public function get_plugin_data() {
		return get_plugin_data( __DIR__ . '/wp-components.php', false, false );
	}
}
