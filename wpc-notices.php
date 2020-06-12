<?php
/**
 * Abstraction for WordPress admin notices.
 *
 * An easy class to handle WordPress notices in the backend.
 *
 * @class       WPC_Notices
 * @version     1.0.0
 * @package     WPC/Notices
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * WPC_Notices
 */
class WPC_Notices {

	/**
	 * Store notices for display.
	 *
	 * @var array $notices
	 */
	private $notices = array();

	/**
	 * __construct
	 *
	 * @return void
	 */
	public function __construct() {
		add_action( 'admin_notices', array( $this, 'display_notice' ) );
	}

	/**
	 * Display admin notices.
	 *
	 * @return void
	 */
	public function display_notice() {
		if ( count( $this->notices ) >= 1 ) {
			foreach ( $this->notices as $notice ) {
				if ( $notice['is_dismissible'] ) {
					$dismissible = 'is-dismissible';
				} else {
					$dismissible = '';
				}

				echo "<div class='notice notice-" . esc_attr( $notice['type'] ) . " {$dismissible}'><p>" . esc_html( $notice['message'] ) . '</p></div>';
			}
		}
	}

	/**
	 * Add notice
	 *
	 * @param mixed $message
	 * @param mixed $type
	 * @param mixed $is_dismissible
	 * @return void
	 */
	public function notice( $message, $type = 'success', $is_dismissible = false ) {
		$this->notices[] = array(
			'message'        => $message,
			'type'           => $type,
			'is_dismissible' => $is_dismissible,
		);
	}

	/**
	 * __call
	 *
	 * @param mixed $name
	 * @param mixed $args
	 * @return void
	 */
	public function __call( $name, $args ) {
		switch ( $name ) {
			case 'success':
				$this->notice( $args[0], $name );
				return $this;

			case 'info':
				$this->notice( $args[0], $name );
				return $this;

			case 'warning':
				$this->notice( $args[0], $name );
				return $this;

			case 'error':
				$this->notice( $args[0], $name );
				return $this;

			case 'dismissible':
				$this->notices[ count( $this->notices ) - 1 ]['is_dismissible'] = true;
		}
	}
}
