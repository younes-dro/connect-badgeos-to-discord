<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://www.expresstechsoftwares.com
 * @since      1.0.0
 *
 * @package    Connect_Badgeos_To_Discord
 * @subpackage Connect_Badgeos_To_Discord/admin/partials
 */
?>
<?php
if ( isset( $_GET['save_settings_msg'] ) ) {
	?>
	<div class="notice notice-success is-dismissible support-success-msg">
		<p><?php echo esc_html( $_GET['save_settings_msg'] ); ?></p>
	</div>
	<?php
}
?>
<h1><?php esc_html_e( 'BadgeOS Discord Add On Settings', 'connect-badgeos-to-discord' ); ?></h1>
		<div id="badgeos-discord-outer" class="skltbs-theme-light" data-skeletabs='{ "startIndex": 0 }'>
			<ul class="skltbs-tab-group">
				<li class="skltbs-tab-item">
				<button class="skltbs-tab" data-identity="settings" ><?php esc_html_e( 'Application Details', 'connect-badgeos-to-discord' ); ?><span class="initialtab spinner"></span></button>
				</li>
				<li class="skltbs-tab-item">
				<?php if ( badgeos_discord_check_saved_settings_status() ) : ?>
				<button class="skltbs-tab" data-identity="level-mapping" ><?php esc_html_e( 'Role Mappings', 'connect-badgeos-to-discord' ); ?></button>
				<?php endif; ?>
				</li>
				<li class="skltbs-tab-item">
				<button class="skltbs-tab" data-identity="advanced" ><?php esc_html_e( 'Advanced', 'connect-badgeos-to-discord' ); ?>	
				</button>
				</li>
				<li class="skltbs-tab-item">
				<button class="skltbs-tab" data-identity="appearance" ><?php esc_html_e( 'Appearance', 'connect-badgeos-to-discord' ); ?>	
				</button>
				</li>                                
				<li class="skltbs-tab-item">
				<button class="skltbs-tab" data-identity="logs" ><?php esc_html_e( 'Logs', 'connect-badgeos-to-discord' ); ?>	
				</button>
				</li>
				<li class="skltbs-tab-item">
				<button class="skltbs-tab" data-identity="documentation" ><?php esc_html_e( 'Documentation', 'connect-badgeos-to-discord' ); ?>	
				</button>
				</li> 
				<li class="skltbs-tab-item">
				<button class="skltbs-tab" data-identity="support" ><?php esc_html_e( 'Support', 'connect-badgeos-to-discord' ); ?>	
				</button>
				</li>								
			</ul>
			<div class="skltbs-panel-group">
				<div id="ets_badgeos_application_details" class="badgeos-discord-tab-conetent skltbs-panel">
				<?php require_once CONNECT_BADGEOS_TO_DISCORD_PLUGIN_DIR_PATH . 'admin/partials/pages/connect-badgeos-discord-application-details.php'; ?>
				</div>
				<?php if ( badgeos_discord_check_saved_settings_status() ) : ?>      
				<div id="ets_badgeos_discord_role_mapping" class="badgeos-discord-tab-conetent skltbs-panel">
					<?php require_once CONNECT_BADGEOS_TO_DISCORD_PLUGIN_DIR_PATH . 'admin/partials/pages/connect-badgeos-discord-role-mapping.php'; ?>
				</div>
				<?php endif; ?>
				<div id='ets_badgeos_discord_advanced' class="badgeos-discord-tab-conetent skltbs-panel">
				<?php require_once CONNECT_BADGEOS_TO_DISCORD_PLUGIN_DIR_PATH . 'admin/partials/pages/connect-badgeos-discord-advanced.php'; ?>
				</div>
				<div id='ets_badgeos_discord_appearance' class="badgeos-discord-tab-conetent skltbs-panel">
				<?php require_once CONNECT_BADGEOS_TO_DISCORD_PLUGIN_DIR_PATH . 'admin/partials/pages/connect-badgeos-discord-appearance.php'; ?>
				</div>                            
				<div id='ets_badgeos_discord_logs' class="badgeos-discord-tab-conetent skltbs-panel">
				<?php require_once CONNECT_BADGEOS_TO_DISCORD_PLUGIN_DIR_PATH . 'admin/partials/pages/connect-badgeos-discord-error-log.php'; ?>
				</div>   
				<div id='ets_badgeos_discord_documentation' class="badgeos-discord-tab-conetent skltbs-panel">
				<?php require_once CONNECT_BADGEOS_TO_DISCORD_PLUGIN_DIR_PATH . 'admin/partials/pages/connect-badgeos-discord-documentation.php'; ?>
				</div>
				<div id='ets_badgeos_discord_support' class="badgeos-discord-tab-conetent skltbs-panel">
				<?php require_once CONNECT_BADGEOS_TO_DISCORD_PLUGIN_DIR_PATH . 'admin/partials/pages/connect-badgeos-discord-support.php'; ?>
				</div>								                         
			</div>  
		</div>



