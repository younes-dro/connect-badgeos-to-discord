
<div class="contact-form ">
	<form method="post" action="<?php echo esc_attr( get_site_url() ) . '/wp-admin/admin-post.php'; ?>">
		<input type="hidden" name="action" value="ets_badgeos_discord_send_support_mail">
		<input type="hidden" name="current_url" value="<?php echo esc_url( ets_badgeos_discord_get_current_screen_url() ); ?>">   
	  <div class="ets-container">
		<div class="top-logo-title">
		  <img src="<?php echo CONNECT_BADGEOS_TO_DISCORD_PLUGIN_URL . 'admin/images/ets-logo.png'; ?>" class="img-fluid company-logo" alt="">
		  <h1><?php esc_html_e( 'ExpressTech Softwares Solutions Pvt. Ltd.', 'connect-badgeos-to-discord' ); ?></h1>
		  <p><?php esc_html_e( 'ExpressTech Software Solution Pvt. Ltd. is the leading Enterprise WordPress development company.', 'connect-badgeos-to-discord' ); ?><br>
		  <?php esc_html_e( 'Contact us for any WordPress Related development projects.', 'connect-badgeos-to-discord' ); ?></p>
		</div>

		<ul style="text-align: left;">
			<li class="mp-icon mp-icon-right-big"><?php esc_html_e( 'If you encounter any issues or errors, please report them on our support forum for Connect BadgeOS to Discord plugin. Our community will be happy to help you troubleshoot and resolve the issue.', 'connect-badgeos-to-discord' ); ?></li>
			<li class="mp-icon mp-icon-right-big">
			<?php
			echo wp_kses(
				'<a target="_blank" href="https://wordpress.org/support/plugin/connect-badgeos-to-discord/">Support » Plugin: Connect BadgeOS to Discord</a>',
				array(
					'a' => array(
						'href'   => array(),
						'target' => array(),
					),
				)
			);
			?>
 </li>
		</ul>


	  </div>
  </form>
</div>
