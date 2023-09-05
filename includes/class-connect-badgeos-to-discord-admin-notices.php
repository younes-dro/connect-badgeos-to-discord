<?php



 defined( 'ABSPATH' ) || exit;

 /**
  * Connect_Badgeos_To_Discord_Admin_Notices
  *
  * @since 1.0.10
  */
class Connect_Badgeos_To_Discord_Admin_Notices {

	/**
	 * Static constructor
	 *
	 * @return void
	 */
	public static function init() {

		add_action( 'admin_notices', array( __CLASS__, 'ets_badgeos_discord_display_notification' ) );
	}

	/**
	 * Display the review notification
	 *
	 * @return void
	 */
	public static function ets_badgeos_discord_display_notification() {

		$screen = get_current_screen();

		if ( $screen && $screen->id === 'badgeos_page_connect-badgeos-to-discord' ) {

			$dismissed = get_user_meta( get_current_user_id(), '_ets_badgeos_discord_dismissed_notification', true );
			if ( ! $dismissed ) {
				ob_start();
				require_once CONNECT_BADGEOS_TO_DISCORD_PLUGIN_DIR_PATH . 'includes/template/notification/review/review.php';
				$notification_content = ob_get_clean();
				echo wp_kses( $notification_content, self::ets_badgeos_discord_allowed_html() );
			}
		}
	}

	/**
	 * Get allowed_html
	 *
	 * @return ARRAY
	 */
	public static function ets_badgeos_discord_allowed_html() {
		$allowed_html = array(
			'div' => array(
				'class' => array(),
			),
			'p'   => array(
				'class' => array(),
			),
			'a'   => array(
				'id'           => array(),
				'data-user-id' => array(),
				'href'         => array(),
				'class'        => array(),
				'style'        => array(),
			),

			'img' => array(
				'src'   => array(),
				'class' => array(),
			),
		);

		return $allowed_html;
	}

}

Connect_Badgeos_To_Discord_Admin_Notices::init();
