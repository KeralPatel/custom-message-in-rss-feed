<?php
add_action('admin_menu', 'rss_create_menu');

function rss_create_menu() {
	add_options_page('Custom Message In RSS Feed', 'Message In Rss Feed', 'administrator', __FILE__, 'rss_settings_page');
	add_action('admin_init', 'register_rsssettings');
}

function register_rsssettings() {
	register_setting('rss-settings', 'rss_custom_message');
	register_setting('rss-settings', 'rss_message_position');
}

function rss_settings_page() {
	$rss_custom_message = get_option('rss_custom_message');
	if (empty($rss_custom_message)){
		update_option('rss_custom_message', 'CUSTOM MESSAGE GOES HERE');
		$rss_custom_message = get_option('rss_custom_message');
	}
	$rss_message_position = get_option('rss_message_position');
?>
<div class="wrap">
<h2>Custom RSS Message Settings</h2>
<p><cite>Custom RSS Message</cite> allows you to append or prepend any text or HTML in your feed.
<br />
You can even insert a small logo or icon of your blog to make your feeds look more beautiful.</p>
<form method="post" action="options.php">
<?php settings_fields( 'rss-settings' ); ?>
<table class="form-table">
<tr valign="top">
<th scope="row">Your Custom Message</th>
<td>
<input type="text" name="rss_custom_message" value="<?php echo $rss_custom_message; ?>">
</td>
</tr>
<tr>
<td>Message Position in Feed</td>
<td>
At Start <input type="radio" name="rss_message_position" value="Start" <?php if ($rss_message_position == "Start") { echo "checked"; } ?>>
<br />
At the End <input type="radio" name="rss_message_position" value="End" <?php if ($rss_message_position == "End") { echo "checked"; } ?>>
</td>
</tr>
</table>
<p class="submit">
<input type="submit" name="submit-bpu" class="button-primary" value="<?php _e('Save Changes') ?>" />
</p>
</form>
</div>
<?php } ?>