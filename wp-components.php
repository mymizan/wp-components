<?php
/*
 * Plugin Name: A Collection of WordPress Components
 * Plugin URI: http://yakub.xyz
 * Description: This is a collection of reusable components for WordPress plugin development.
 * Author: M Yakub Mizan & Imtiaz Bulbul
 * Co-Author: Imtiaz Bulbul
 * Version: 1.0.0
 * Author URI: http://yakub.xyz
*/

require dirname( __FILE__ ) . '/wpc-notices.php';

final class WP_COMPONENTS {
	public function __construct() {
		add_action( 'init', array( $this, 'init' ), PHP_INT_MAX, 0 );
	}

	public function init() {
		$notice = new WPC_Notices();
		$notice->error( 'This is a dismissible error' )->dismissible();
		$notice->warning( 'This is a dismissible warning.' )->dismissible();
		$notice->info( 'This is a dismissible info' )->dismissible();
		$notice->success( 'This is a success message.' );
	}
}

new WP_COMPONENTS();
