<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.expresstechsoftwares.com
 * @since      1.0.0
 *
 * @package    Connect_Badgeos_To_Discord
 * @subpackage Connect_Badgeos_To_Discord/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Connect_Badgeos_To_Discord
 * @subpackage Connect_Badgeos_To_Discord/admin
 * @author     ExpressTech Softwares Solutions Pvt Ltd <contact@expresstechsoftwares.com>
 */
class Connect_Badgeos_To_Discord_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string $plugin_name       The name of this plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Connect_Badgeos_To_Discord_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Connect_Badgeos_To_Discord_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/connect-badgeos-to-discord-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Connect_Badgeos_To_Discord_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Connect_Badgeos_To_Discord_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/connect-badgeos-to-discord-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Method to add discord setting sub-menu under top level menu of BadgeOS
	 *
	 * @since    1.0.0
	 */
	public function ets_badgeos_discord_add_settings_menu() {
		add_submenu_page( 'badgeos_badgeos', __( 'Discord Settings', 'connect-badgeos-to-discord' ), __( 'Discord Settings', 'connect-badgeos-to-discord' ), 'manage_options', 'connect-badgeos-to-discord', array( $this, 'ets_badgeos_discord_setting_page' ) );
	}

	/**
	 * Callback to Display settings page
	 *
	 * @since    1.0.0
	 */
	public function ets_badgeos_discord_setting_page() {
		if ( ! current_user_can( 'administrator' ) ) {
			wp_send_json_error( 'You do not have sufficient rights', 403 );
			exit();
		}
		wp_enqueue_style( $this->plugin_name );
		wp_enqueue_script( $this->plugin_name );
		require_once CONNECT_BADGEOS_TO_DISCORD_PLUGIN_DIR_PATH . 'admin/partials/connect-badgeos-to-discord-admin-display.php';
	}

}
