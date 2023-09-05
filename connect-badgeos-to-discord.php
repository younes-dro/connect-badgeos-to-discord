<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.expresstechsoftwares.com
 * @since             1.0.0
 * @package           Connect_Badgeos_To_Discord
 *
 * @wordpress-plugin
 * Plugin Name:       Connect BadgeOS to Discord
 * Plugin URI:        https://www.expresstechsoftwares.com/connect-badgeos-to-discord
 * Description:       Create a community of your users by connecting your BadgeOS Website to your Discord server.
 * Version:           1.0.3
 * Author:            ExpressTech Softwares Solutions Pvt Ltd
 * Author URI:        https://www.expresstechsoftwares.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       connect-badgeos-to-discord
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'CONNECT_BADGEOS_TO_DISCORD_VERSION', '1.0.3' );

/**
 * Define plugin directory path
 */
define( 'CONNECT_BADGEOS_TO_DISCORD_PLUGIN_DIR_PATH', plugin_dir_path( __FILE__ ) );

/**
 * Define plugin url
 */
define( 'CONNECT_BADGEOS_TO_DISCORD_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

/**
 * Discord API call scopes
 */
define( 'CONNECT_BADGEOS_TO_DISCORD_OAUTH_SCOPES', 'identify email guilds guilds.join' );

/**
 * Discord API url.
 */
define( 'CONNECT_BADGEOS_TO_DISCORD_API_URL', 'https://discord.com/api/v10/' );

/**
 * Define group name for action scheduler actions
 */
define( 'BADGEOS_DISCORD_AS_GROUP_NAME', 'ets-badgeos-discord' );

/**
 * Discord BOT Permissions
 */
define( 'BADGEOS_DISCORD_BOT_PERMISSIONS', 8 );

/**
 * Follwing response codes not cosider for re-try API calls.
 */
define( 'BADGEOS_DISCORD_DONOT_RETRY_THESE_API_CODES', array( 0, 10003, 50033, 10004, 50025, 10013, 10011 ) );

/**
 * Define plugin directory url
 */
define( 'BADGEOS_DISCORD_DONOT_RETRY_HTTP_CODES', array( 400, 401, 403, 404, 405, 502 ) );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-connect-badgeos-to-discord-activator.php
 */
function activate_connect_badgeos_to_discord() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-connect-badgeos-to-discord-activator.php';
	Connect_Badgeos_To_Discord_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-connect-badgeos-to-discord-deactivator.php
 */
function deactivate_connect_badgeos_to_discord() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-connect-badgeos-to-discord-deactivator.php';
	Connect_Badgeos_To_Discord_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_connect_badgeos_to_discord' );
register_deactivation_hook( __FILE__, 'deactivate_connect_badgeos_to_discord' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-connect-badgeos-to-discord.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_connect_badgeos_to_discord() {

	$plugin = new Connect_Badgeos_To_Discord();
	$plugin->run();

}
run_connect_badgeos_to_discord();
