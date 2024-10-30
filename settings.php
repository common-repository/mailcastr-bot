<div class="wrap">
	<h2><?php echo $this->plugin->displayName; ?> Settings</h2>
	<?php
	if (isset($this->message)) {
	?>
		<div class="updated fade">
			<p><?php echo $this->message; ?></p>
		</div>
	<?php
	}
	if (isset($this->errorMessage)) {
	?>
		<div class="error fade">
			<p><?php echo $this->errorMessage; ?></p>
		</div>
	<?php
	}
	?>

	<div id="poststuff">
		<div id="post-body" class="metabox-holder columns-2">
			<!-- Content -->
			<div id="post-body-content">
				<div id="normal-sortables" class="meta-box-sortables ui-sortable">
					<div class="postbox">
						<h3>Settings</h3>
						<div class="inside">
							<form action="options-general.php?page=<?php echo $this->plugin->name; ?>" method="post">
								<table class="form-table" role="presentation">
									<tbody>
										<tr>
											<th scope="row">
												<label for="mcstr_api_key">API Key</label>
											</th>
											<td>
												<input id="mcstr_api_key" class="regular-text" type="text" name="api_key" required="true" value="<?php echo $this->plugin->apiKey; ?>" />
											</td>
										</tr>
									</tbody>
								</table>
								<?php wp_nonce_field($this->plugin->name, $this->plugin->name . '_nonce'); ?>
								<p>
									<input name="submit" type="submit" name="Save" class="button button-primary" value="Save" />
								</p>
							</form>
						</div>
					</div>
				</div>
			</div>

			<div id="postbox-container-1" class="postbox-container">
				<div class="postbox">
					<h3 class="hndle">
						<span>How to get API key?</span>
					</h3>
					<div class="inside">
						<p>
							Please visit <a href="https://mailcastr.com" target="_blank">mailcastr.com</a> and log into your account.
						</p>
						<p>
						You can find more info about setting up wordpress plugin <a href="https://mailcastr.freshdesk.com/support/solutions/articles/29000035512-install-mailcastr-bot-on-wordpress-site" target="_blank">here</a>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>