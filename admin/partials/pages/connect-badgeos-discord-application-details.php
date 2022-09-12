<?php
$ets_badgeos_discord_client_id          = sanitize_text_field( trim( get_option( 'ets_badgeos_discord_client_id' ) ) );
$ets_badgeos_discord_client_secret      = sanitize_text_field( trim( get_option( 'ets_badgeos_discord_client_secret' ) ) );
$ets_badgeos_discord_bot_token          = sanitize_text_field( trim( get_option( 'ets_badgeos_discord_bot_token' ) ) );
$ets_badgeos_discord_redirect_url       = sanitize_text_field( trim( get_option( 'ets_badgeos_discord_redirect_url' ) ) );
$ets_badgeos_discord_roles              = sanitize_text_field( trim( get_option( 'ets_badgeos_discord_role_mapping' ) ) );
$ets_badgeos_discord_server_id          = sanitize_text_field( trim( get_option( 'ets_badgeos_discord_server_id' ) ) );
$ets_badgeos_discord_connected_bot_name = sanitize_text_field( trim( get_option( 'ets_badgeos_discord_connected_bot_name' ) ) );
$ets_badgeos_discord_redirect_page_id   = sanitize_text_field( trim( get_option( 'ets_badgeos_discord_redirect_page_id' ) ) );
?>
<form method="post" action="<?php echo esc_url( get_site_url() ) . '/wp-admin/admin-post.php'; ?>">
  <input type="hidden" name="action" value="badgeos_discord_application_settings">
  <input type="hidden" name="current_url" value="<?php echo esc_url( ets_badgeos_discord_get_current_screen_url() ); ?>">   
	<?php wp_nonce_field( 'save_badgeos_discord_general_settings', 'ets_badgeos_discord_save_settings' ); ?>
  <div class="ets-input-group">
	<label><?php esc_html_e( 'Client ID', 'connect-badgeos-to-discord' ); ?> :</label>
	<input type="text" class="ets-input" name="ets_badgeos_discord_client_id" value="
	<?php
	if ( isset( $ets_badgeos_discord_client_id ) ) {
		echo esc_attr( $ets_badgeos_discord_client_id ); }
	?>
	" required placeholder="Discord Client ID">
  </div>
	<div class="ets-input-group">
	  <label><?php esc_html_e( 'Client Secret', 'connect-badgeos-to-discord' ); ?> :</label>
		<input type="text" class="ets-input" name="ets_badgeos_discord_client_secret" value="
		<?php
		if ( isset( $ets_badgeos_discord_client_secret ) ) {
			echo esc_attr( $ets_badgeos_discord_client_secret ); }
		?>
	" required placeholder="Discord Client Secret">
	</div>
	<div class="ets-input-group">
	<label><?php esc_html_e( 'Redirect URL', 'connect-badgeos-to-discord' ); ?> :</label>

	<p class="redirect-url"><b><?php echo esc_url( $ets_badgeos_discord_redirect_url ); ?></b></p>
		<select class= "ets-input ets_badgeos_discord_redirect_url" id="ets_badgeos_discord_redirect_url" name="ets_badgeos_discord_redirect_url" style="max-width: 100%" required>
		<?php _e( ets_badgeos_discord_pages_list( wp_kses( $ets_badgeos_discord_redirect_page_id, array( 'option' => array( 'data-page-url' => array() ) ) ) ) ); ?>
		</select>                
				
		<p class="description"><?php esc_html_e( 'Registered discord app url', 'connect-badgeos-to-discord' ); ?><span class="spinner"></span></p>
				<p class="description ets-discord-update-message"><?php _e( sprintf( wp_kses( __( 'Redirect URL updated, kindly add/update the same in your discord.com application link <a href="https://discord.com/developers/applications/%s/oauth2/general">https://discord.com/developers</a>', 'connect-badgeos-to-discord' ), array( 'a' => array( 'href' => array() ) ) ), $ets_badgeos_discord_client_id ) ); ?></p>                
	</div>
	<div class="ets-input-group">
			<label><?php esc_html_e( 'Admin Redirect URL Connect to bot', 'connect-badgeos-to-discord' ); ?> :</label>
			<input type="text" class="ets-input" name="ets_badgeos_discord_admin_redirect_url" value="<?php echo esc_url( get_admin_url( '', 'admin.php' ) ) . '?page=connect-badgeos-to-discord&via=badgeos-discord-bot'; ?>" readonly required />
		</div>   
	<div class="ets-input-group">
			<?php
			if ( isset( $ets_badgeos_discord_connected_bot_name ) && ! empty( $ets_badgeos_discord_connected_bot_name ) ) {
				_e(
					sprintf(
						wp_kses(
							__( '<p class="description">Make sure the Bot %1$s <span class="discord-bot"><b>BOT</b></span>have the high priority than the roles it has to manage. Open <a href="https://discord.com/channels/%2$s">Discord Server</a></p>', 'connect-badgeos-to-discord' ),
							array(
								'p'    => array( 'class' => array() ),
								'a'    => array( 'href' => array() ),
								'span' => array( 'class' => array() ),
								'b'    => array(),
							)
						),
						$ets_badgeos_discord_connected_bot_name,
						$ets_badgeos_discord_server_id
					)
				);
			}
			?>
						
	  <label><?php esc_html_e( 'Bot Token', 'connect-badgeos-to-discord' ); ?> :</label>
		  <input type="password" class="ets-input" name="ets_badgeos_discord_bot_token" value="
		  <?php
			if ( isset( $ets_badgeos_discord_bot_token ) ) {
				echo esc_attr( $ets_badgeos_discord_bot_token ); }
			?>
		" required placeholder="Discord Bot Token">
	</div>
	<div class="ets-input-group">
	  <label><?php esc_html_e( 'Server ID', 'connect-badgeos-to-discord' ); ?> :</label>
		<input type="text" class="ets-input" name="ets_badgeos_discord_server_id"
		placeholder="Discord Server Id" value="
		<?php
		if ( isset( $ets_badgeos_discord_server_id ) ) {
			echo esc_attr( $ets_badgeos_discord_server_id ); }
		?>
		" required>
	</div>
	<?php if ( empty( $ets_badgeos_discord_client_id ) || empty( $ets_badgeos_discord_client_secret ) || empty( $ets_badgeos_discord_bot_token ) || empty( $ets_badgeos_discord_redirect_url ) || empty( $ets_badgeos_discord_server_id ) ) { ?>
	  <p class="ets-danger-text description">
		<?php esc_html_e( 'Please save your form', 'connect-badgeos-to-discord' ); ?>
	  </p>
	<?php } ?>
	<p>
	  <button type="submit" name="submit" value="ets_discord_submit" class="ets-submit ets-btn-submit ets-bg-green">
		<?php esc_html_e( 'Save Settings', 'connect-badgeos-to-discord' ); ?>
	  </button>
	  <?php if ( sanitize_text_field( get_option( 'ets_badgeos_discord_client_id' ) ) ) : ?>
			<a href="?action=badgeos-discord-connect-to-bot" class="ets-btn badgeos-btn-connect-to-bot" id="badgeos-connect-discord-bot"><?php esc_html_e( 'Connect your Bot', 'connect-badgeos-to-discord' ) . Connect_Badgeos_To_Discord::get_discord_logo_white(); ?> </a>
	  <?php endif; ?>
	</p>
</form>
