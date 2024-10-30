<?php

/**
 * Plugin Name: Mailcastr Bot
 * Plugin URI: https://mailcastr.com/
 * Version: 1.0.1
 * Author: Mailcastr
 * Description: Allows you to integrate Mailcastr Bot your WordPress blog
 */

class MailcastrBot
{
	public function __construct()
	{
		$this->settings = new stdClass;

		$this->plugin = new stdClass;
		$this->plugin->name = 'mailcastr-bot';
		$this->plugin->apiKey = '';
		$this->plugin->displayName = 'Mailcastr Bot';

		add_action('wp_head', array(&$this, 'insertBotScript'));
		add_action('admin_menu', array(&$this, 'registerAdminMenu'));
	}

	function registerSettings()
	{
		register_setting($this->plugin->name, 'mcbot_api_key', 'trim');
	}

	function insertBotScript()
	{
		$api_key = get_option('api_key');
		if (empty($api_key))
			return;

		echo "<script>
				var h=document.getElementsByTagName('head')[0];
				var s=document.createElement('script');
				s.type='text/javascript';
				s.setAttribute('data-key', '{$api_key}');
				s.src='https://widgets.mailcastr.com/release/bot/v1/mcbot.min.js';
				h.appendChild(s);
			</script>";
	}

	/**
	 * Register settings panel
	 */
	function registerAdminMenu()
	{
		add_submenu_page('options-general.php', $this->plugin->displayName, $this->plugin->displayName, 'manage_options', $this->plugin->name, array(&$this, 'botSettings'));
	}

	function botSettings()
	{
		if (!current_user_can('administrator')) {
			echo '<p>Sorry, you are not allowed to access this page.</p>';
			return;
		}

		if (isset($_REQUEST['submit'])) {
			if (!isset($_REQUEST[$this->plugin->name . '_nonce'])) {
				// Missing nonce
				$this->errorMessage = 'Missing nonce field. Settings NOT saved.';
			} elseif (!wp_verify_nonce($_REQUEST[$this->plugin->name . '_nonce'], $this->plugin->name)) {
				// Invalid nonce
				$this->errorMessage = 'Invalid nonce. Settings NOT saved.';
			} else {
				$input = sanitize_text_field($_REQUEST['api_key']);
				update_option('api_key', $input);
				$this->message = 'Settings Saved.';
			}
		}
		$this->plugin->apiKey = get_option('api_key');
		include_once(plugin_dir_path(__FILE__) . '/settings.php');
	}
}

$mcbot = new MailcastrBot();
