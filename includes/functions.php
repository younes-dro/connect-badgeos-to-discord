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

/*
 * function to get formated redirect url
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
