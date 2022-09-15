<?php

/**
 * Fired during plugin activation
 *
 * @link       https://www.expresstechsoftwares.com
 * @since      1.0.0
 *
 * @package    Connect_Badgeos_To_Discord
 * @subpackage Connect_Badgeos_To_Discord/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Connect_Badgeos_To_Discord
 * @subpackage Connect_Badgeos_To_Discord/includes
 * @author     ExpressTech Softwares Solutions Pvt Ltd <contact@expresstechsoftwares.com>
 */
class Connect_Badgeos_To_Discord_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		update_option( 'ets_badgeos_discord_send_welcome_dm', true );
		update_option( 'ets_badgeos_discord_welcome_message', 'Hi [BADGE_USER_NAME] ([BADGE_USER_EMAIL]), Welcome, Your ranks [BADGE_RANKS] at [SITE_URL] Thanks, Kind Regards, [BLOG_NAME]' );
		update_option( 'ets_badgeos_discord_send_award_rank_dm', true );
		update_option( 'ets_badgeos_discord_award_rank_message', 'Congratulations [BADGE_USER_NAME]! You reached the [BADGE_RANK_TYPE] [BADGE_RANK] by completing the following requirements: [BADGE_RANK_REQUIREMENTS] , Regards, [SITE_URL], [BLOG_NAME]' );
		update_option( 'ets_badgeos_discord_send_earned_achievement_dm', true );
		update_option( 'ets_badgeos_discord_earned_achievement_message', 'Congratulations [BADGE_USER_NAME]! You have earned a new achievement i.e. "[BADGE_ACHIEVEMENT_TITLE]" , Regards, [SITE_URL], [BLOG_NAME]' );
		update_option( 'ets_badgeos_discord_send_award_user_points_dm', true );
		update_option( 'ets_badgeos_discord_award_user_points_message', 'Congratulations [BADGE_USER_NAME]( [BADGE_USER_EMAIL] ), You unlocked the [BADGE_ACHIEVEMENT_TYPE] [BADGE_ACHIEVEMENT] by completing the following steps: [BADGE_ACHIEVEMENT_STEPS], Points Awarded : [BADGE_POINTS], [SITE_URL], [BLOG_NAME]' );
		update_option( 'ets_badgeos_discord_retry_failed_api', true );
		update_option( 'ets_badgeos_discord_connect_button_bg_color', '#7bbc36' );
		update_option( 'ets_badgeos_discord_disconnect_button_bg_color', '#ff0000' );
		update_option( 'ets_badgeos_discord_loggedin_button_text', 'Connect With Discord' );
		update_option( 'ets_badgeos_discord_non_login_button_text', 'Login With Discord' );
		update_option( 'ets_badgeos_discord_disconnect_button_text', 'Disconnect From Discord' );
		update_option( 'ets_badgeos_discord_kick_upon_disconnect', false );
		update_option( 'ets_badgeos_discord_retry_api_count', 5 );
		update_option( 'ets_badgeos_discord_job_queue_concurrency', 1 );
		update_option( 'ets_badgeos_discord_job_queue_batch_size', 6 );
		update_option( 'ets_badgeos_discord_log_api_response', false );
		update_option( 'ets_badgeos_discord_uuid_file_name', wp_generate_uuid4() );

	}

}
