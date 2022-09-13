<?php
/**
 *
 * Common functions file.
 */

/**
 * To check settings values saved or not
 *
 * @param NONE
 * @return BOOL $status
 */
function badgeos_discord_check_saved_settings_status() {
	$ets_badgeos_discord_client_id     = sanitize_text_field( trim( get_option( 'ets_badgeos_discord_client_id' ) ) );
	$ets_badgeos_discord_client_secret = sanitize_text_field( trim( get_option( 'ets_badgeos_discord_client_secret' ) ) );
	$ets_badgeos_discord_bot_token     = sanitize_text_field( trim( get_option( 'ets_badgeos_discord_bot_token' ) ) );
	$ets_badgeos_discord_redirect_url  = sanitize_text_field( trim( get_option( 'ets_badgeos_discord_redirect_url' ) ) );
	$ets_badgeos_discord_server_id     = sanitize_text_field( trim( get_option( 'ets_badgeos_discord_server_id' ) ) );

	if ( $ets_badgeos_discord_client_id && $ets_badgeos_discord_client_secret && $ets_badgeos_discord_bot_token && $ets_badgeos_discord_redirect_url && $ets_badgeos_discord_server_id ) {
		$status = true;
	} else {
		$status = false;
	}

	return $status;
}

/**
 * Get current screen URL
 *
 * @param NONE
 * @return STRING $url
 */
function ets_badgeos_discord_get_current_screen_url() {
	$parts       = parse_url( home_url() );
	$current_uri = "{$parts['scheme']}://{$parts['host']}" . ( isset( $parts['port'] ) ? ':' . $parts['port'] : '' ) . add_query_arg( null, null );

		return $current_uri;
}

 /**
  * Get WP Pages list
  *
  * @param INT $ets_badgeos_discord_redirect_page_id
  * @return STRING $options
  */
function ets_badgeos_discord_pages_list( $ets_badgeos_discord_redirect_page_id ) {
	$args    = array(
		'sort_order'   => 'asc',
		'sort_column'  => 'post_title',
		'hierarchical' => 1,
		'exclude'      => '',
		'include'      => '',
		'meta_key'     => '',
		'meta_value'   => '',
		'exclude_tree' => '',
		'number'       => '',
		'offset'       => 0,
		'post_type'    => 'page',
		'post_status'  => 'publish',
	);
	$pages   = get_pages( $args );
	$options = '<option value="">-</option>';
	foreach ( $pages as $page ) {
		$selected = ( esc_attr( $page->ID ) === $ets_badgeos_discord_redirect_page_id ) ? ' selected="selected"' : '';
		$options .= '<option data-page-url="' . ets_get_badgeos_discord_formated_discord_redirect_url( $page->ID ) . '" value="' . esc_attr( $page->ID ) . '" ' . $selected . '> ' . $page->post_title . ' </option>';
	}

	return $options;
}

/**
 * function to get formated redirect url
 *
 * @param INT $page_id
 * @return STRING $url
 */
function ets_get_badgeos_discord_formated_discord_redirect_url( $page_id ) {
	$url = esc_url( get_permalink( $page_id ) );

	$parsed = parse_url( $url, PHP_URL_QUERY );
	if ( $parsed === null ) {
		return $url .= '?via=connect-badgeos-discord-addon';
	} else {
		if ( stristr( $url, 'via=connect-badgeos-discord-addon' ) !== false ) {
			return $url;
		} else {
			return $url .= '&via=connect-badgeos-discord-addon';
		}
	}
}

 /**
  * Get BOT name
  *
  * @param NONE
  * @return NONE
  */
function ets_badgeos_discord_update_bot_name_option() {

	$guild_id          = sanitize_text_field( trim( get_option( 'ets_badgeos_discord_server_id' ) ) );
	$discord_bot_token = sanitize_text_field( trim( get_option( 'ets_badgeos_discord_bot_token' ) ) );
	if ( $guild_id && $discord_bot_token ) {

				$discod_current_user_api = CONNECT_BADGEOS_TO_DISCORD_API_URL . 'users/@me';

		$app_args = array(
			'method'  => 'GET',
			'headers' => array(
				'Content-Type'  => 'application/json',
				'Authorization' => 'Bot ' . $discord_bot_token,
			),
		);

		$app_response = wp_remote_post( $discod_current_user_api, $app_args );

		$response_arr = json_decode( wp_remote_retrieve_body( $app_response ), true );

		if ( is_array( $response_arr ) && array_key_exists( 'username', $response_arr ) ) {

			update_option( 'ets_badgeos_discord_connected_bot_name', $response_arr ['username'] );
		} else {
			delete_option( 'ets_badgeos_discord_connected_bot_name' );
		}
	}

}

/**
 * Get Action data from table `actionscheduler_actions`
 *
 * @param INT $action_id
 */
function ets_badgeos_discord_as_get_action_data( $action_id ) {
	global $wpdb;
	$result = $wpdb->get_results( $wpdb->prepare( 'SELECT aa.hook, aa.status, aa.args, ag.slug AS as_group FROM ' . $wpdb->prefix . 'actionscheduler_actions as aa INNER JOIN ' . $wpdb->prefix . 'actionscheduler_groups as ag ON aa.group_id=ag.group_id WHERE `action_id`=%d AND ag.slug=%s', $action_id, BADGEOS_DISCORD_AS_GROUP_NAME ), ARRAY_A );

	if ( ! empty( $result ) ) {
		return $result[0];
	} else {
		return false;
	}
}

/**
 * Get how many times a hook is failed in a particular day.
 *
 * @param STRING $hook
 */
function ets_badgeos_discord_count_of_hooks_failures( $hook ) {
	global $wpdb;
	$result = $wpdb->get_results( $wpdb->prepare( 'SELECT count(last_attempt_gmt) as hook_failed_count FROM ' . $wpdb->prefix . 'actionscheduler_actions WHERE `hook`=%s AND status="failed" AND DATE(last_attempt_gmt) = %s', $hook, date( 'Y-m-d' ) ), ARRAY_A );

	if ( ! empty( $result ) ) {
		return $result['0']['hook_failed_count'];
	} else {
		return false;
	}
}

/**
 * Get randon integer between a predefined range.
 *
 * @param INT $add_upon
 */
function ets_badgeos_discord_get_random_timestamp( $add_upon = '' ) {
	if ( $add_upon != '' && $add_upon !== false ) {
		return $add_upon + random_int( 5, 15 );
	} else {
		return strtotime( 'now' ) + random_int( 5, 15 );
	}
}

/**
 * Get the highest available last attempt schedule time
 */

function ets_badgeos_discord_get_highest_last_attempt_timestamp() {
	global $wpdb;
	$result = $wpdb->get_results( $wpdb->prepare( 'SELECT aa.last_attempt_gmt FROM ' . $wpdb->prefix . 'actionscheduler_actions as aa INNER JOIN ' . $wpdb->prefix . 'actionscheduler_groups as ag ON aa.group_id = ag.group_id WHERE ag.slug = %s ORDER BY aa.last_attempt_gmt DESC limit 1', BADGEOS_DISCORD_AS_GROUP_NAME ), ARRAY_A );

	if ( ! empty( $result ) ) {
		return strtotime( $result['0']['last_attempt_gmt'] );
	} else {
		return false;
	}
}

/**
 * Get pending jobs
 */
function ets_badgeos_discord_get_all_pending_actions() {
	global $wpdb;
	$result = $wpdb->get_results( $wpdb->prepare( 'SELECT aa.* FROM ' . $wpdb->prefix . 'actionscheduler_actions as aa INNER JOIN ' . $wpdb->prefix . 'actionscheduler_groups as ag ON aa.group_id = ag.group_id WHERE ag.slug = %s AND aa.status="pending" ', BADGEOS_DISCORD_AS_GROUP_NAME ), ARRAY_A );

	if ( ! empty( $result ) ) {
		return $result['0'];
	} else {
		return false;
	}
}

/**
 * Get User' ranks
 *
 * @param INT $suer_id The user's ID.
 * @return ARRAY|NULL
 */
function ets_badgeos_discord_get_user_ranks_ids( $user_id ) {

	$ets_badgeos_user_ranks_ids = array();

	$ranks_user = badgeos_get_user_ranks( array( 'user_id' => $user_id ) );

	if ( is_array( $ranks_user ) && count( $ranks_user ) > 0 ) {

		foreach ( $ranks_user as $rank_user ) {
			array_push( $ets_badgeos_user_ranks_ids, $rank_user->rank_id );

		}

		return $ets_badgeos_user_ranks_ids;
	} else {

		return null;
	}

}

/**
 * Return the discord user avatar.
 *
 * @param INT    $discord_user_id The discord usr ID.
 * @param STRING $user_avatar Discord avatar hash value.
 * @param STRING $restrictcontent_discord The html.
 *
 * @return STRING
 */
function ets_badgeos_discord_get_user_avatar( $discord_user_id, $user_avatar, $restrictcontent_discord ) {
	if ( $user_avatar ) {
		$avatar_url               = '<img class="ets-badgeos-user-avatar" src="https://cdn.discordapp.com/avatars/' . $discord_user_id . '/' . $user_avatar . '.png" />';
		$restrictcontent_discord .= $avatar_url;
	}
	return $restrictcontent_discord;
}

/**
 * Get message for what role is assigned to the member.
 *
 * @param STRING $mapped_role_name
 * @param STRING $default_role_name
 * @param STRING $restrictcontent_discord
 */
function ets_badgeos_discord_roles_assigned_message( $mapped_role_name, $default_role_name, $restrictcontent_discord ) {

	if ( $mapped_role_name ) {
		$restrictcontent_discord .= '<p class="ets_assigned_role">';

		$restrictcontent_discord .= esc_html__( 'Following Roles will be assigned to you in Discord: ', 'connect-badgeos-to-discord' );
		$restrictcontent_discord .= $mapped_role_name;
		if ( $default_role_name ) {
			$restrictcontent_discord .= $default_role_name;

		}

		$restrictcontent_discord .= '</p>';
	} elseif ( $default_role_name ) {
		$restrictcontent_discord .= '<p class="ets_assigned_role">';

		$restrictcontent_discord .= esc_html__( 'Following Role will be assigned to you in Discord: ', 'connect-badgeos-to-discord' );
		$restrictcontent_discord .= $default_role_name;

		$restrictcontent_discord .= '</p>';

	}
	return $restrictcontent_discord;
}

/**
 * Get allowed html using WordPress API function wp_kses
 *
 * @return STRING $html_message
 */
function ets_badgeos_discord_allowed_html() {
	$allowed_html = array(
		'div'    => array(
			'class' => array(),
		),
		'p'      => array(
			'class' => array(),
		),
		'a'      => array(
			'id'           => array(),
			'data-user-id' => array(),
			'href'         => array(),
			'class'        => array(),
			'style'        => array(),
		),
		'label'  => array(
			'class' => array(),
		),
		'h3'     => array(),
		'span'   => array(
			'class' => array(),
		),
		'i'      => array(
			'style' => array(),
			'class' => array(),
		),
		'button' => array(
			'class'        => array(),
			'data-user-id' => array(),
			'id'           => array(),
		),
		'img'    => array(
			'src'   => array(),
			'class' => array(),
		),
		'h2'     => array(),
	);

	return $allowed_html;
}
